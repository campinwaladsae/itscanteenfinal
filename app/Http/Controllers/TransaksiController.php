<?php

namespace App\Http\Controllers;

use App\Http\Traits\Response;
use App\Models\Menu;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    //
    use Response;
    public function index()
    {
        $user = Auth::user()->id;
        $data = Transaksi::with('menu.user')->where('user_id', $user)->get();
        return $this->success($data);
    }

    public function pesanan()
    {
        # code...
        $data = Menu::where('user_id', Auth::user()->id)->get();
        $dataRet = [];
        // dd($data);
        $id = [];
        foreach ($data as $idx => $v) {
            array_push($id, $v->id);
        }

        foreach ($id as $key => $value) {
            $data =  Transaksi::with('user', 'menu')->where('menu_id', $value)->where('status', '<>', 'cart')->get();
            foreach ($data as $k => $val) {
                # code...
                array_push($dataRet, $val);
            }
        }
        // dd($dataRet);
        return $this->success($dataRet);
    }

    public function showCart($id)
    {
        $data = Transaksi::with('user', 'menu.user')->where('order_id', $id)->first();
        return $this->success($data);
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request['user_id'] = Auth::user()->id;
            $request['order_id'] = date_format(now(), 'YmdHis');
            if ($request['status'] == null) {
                # code...
                $request['status'] = 'cart';
            }
            // dd($request->all());
            $data = Transaksi::create($request->all());

            DB::commit();
            return $this->success($data);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }
    }


    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $request['user_id'] = Auth::user()->id;
            $tr = Transaksi::where('order_id', $id)->first();
            $tr->update([
                'total' => $request->total,
                'qty' => $request->qty,
                'status' => $request->status
            ]);
            // dd($tr);

            DB::commit();
            return $this->success($tr);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
            //throw $th;
        }
    }


    public function dashboardOwner()
    {
        $user = Auth::user();
        $pesanan = DB::select('SELECT count(transaksi.id) as pesanan, sum(transaksi.total) as total FROM transaksi LEFT JOIN menu on menu.id = transaksi.menu_id LEFT JOIN users ON menu.user_id = users.id WHERE transaksi.status <> "cart" AND users.id = ' . $user->id);
        $dataRet = [
            'user' => $user,
            'pesanan' => $pesanan[0]
        ];
        // dd($dataRet);
        return $this->success($dataRet);
    }


    public function pemasukan()
    {
        # code...
        $user = Auth::user();
        $data =  DB::select('SELECT count(transaksi.id) as pesanan, sum(transaksi.total) as total FROM transaksi LEFT JOIN menu on menu.id = transaksi.menu_id LEFT JOIN users ON menu.user_id = users.id WHERE transaksi.status != "cart" AND users.id= ' . $user->id);
        $psn =  DB::select('SELECT  transaksi.total as harga, transaksi.updated_at as waktu, transaksi.qty as qty FROM transaksi LEFT JOIN menu on menu.id = transaksi.menu_id LEFT JOIN users ON menu.user_id = users.id WHERE transaksi.status != "cart" AND users.id= ' . $user->id);
        $dataRet = [
            'data' => $data,
            'pesanan' => $psn
        ];
        // dd($dataRet);
        return $this->success($dataRet);
    }
}
