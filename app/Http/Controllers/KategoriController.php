<?php

namespace App\Http\Controllers;

use App\Http\Traits\Response;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    //
    use Response;

    public function index()
    {
        $data = Kategori::all();
        return $this->success($data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request['user_id'] = Auth::user()->id;
            $data = Kategori::create($request->all());

            DB::commit();
            return $this->success($data);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }

    public function show($id)
    {
        $data = Kategori::find($id);
        return $this->success($data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = Kategori::find($id);

            if ($request->file('gambar')) {
                $filename = $request->file('gambar')->getClientOriginalName();
                $request->file('gambar')->storeAs('/gambar', $filename, 'public');
            }

            $data->update($request->all());
            DB::commit();
            return $this->success($data);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Kategori::find($id)->delete();

            DB::commit();
            return $this->success('', "berhasil dihapu");
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage());
        }
    }
}
