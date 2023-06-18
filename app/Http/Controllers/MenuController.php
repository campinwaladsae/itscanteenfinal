<?php

namespace App\Http\Controllers;

use App\Http\Traits\Response;
use App\Models\Menu;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    use Response;

    public function index()
    {
        $data = Menu::with('kategori')->where('user_id', Auth::user()->id)->get();
        return $this->success($data);
    }

    public function indexAll()
    {
        $data = Menu::with('kategori', 'user')->get();
        return $this->success($data);
    }

    public function show($id)
    {
        $data = Menu::with('user')->find($id);
        $userLogin = User::find(Auth::user()->id);
        $retData = [
            "data" => $data,
            "user" => $userLogin
        ];

        return $this->success($retData);
    }




    public function favoriteMenu()
    {

        try {
            $favorite = json_decode(Auth::user()->favorites);
            $data = [];
            if ($favorite != null) {
                foreach ($favorite as $key => $value) {
                    array_push($data, Menu::with('user')->find($value));
                }
            }

            return $this->success($data);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage());
        }
    }

    public function addFavorite($id)
    {
        try {
            // $favorite = [];

            DB::beginTransaction();
            $listFav = [];
            $user = User::find(Auth::user()->id);
            if ($user->favorites == null || $user->favorites == '[]' || $user->favorites == '') {
                array_push($listFav, $id);
                $fav = json_encode($listFav);
                $user->update([
                    'favorites' => $fav
                ]);
            } else {
                $favorite = json_decode($user->favorites);

                if (in_array($id, $favorite)) {
                    unset($favorite[array_search($id, $favorite)]);
                } else {
                    array_push($favorite, $id);
                }

                $fav2 = json_encode($favorite);
                $user->update([
                    'favorites' => $fav2
                ]);
            }
            DB::commit();
            return $this->success($listFav, "Berhasil difavoritkan");
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return $this->error("gagal disimpan");
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $foto = [];
            foreach ($request->file('gambars') as $key => $value) {
                # code...
                $filename = $value->getClientOriginalName();
                $value->storeAs('/menu', $filename, 'public');
                array_push($foto, $filename);
            }

            $fotos = json_encode($foto);

            $request["gambar"] = $fotos;
            // dd($request->all());
            $request['user_id'] = Auth::user()->id;
            $data = Menu::create($request->all());

            DB::commit();
            return $this->success($data);
            // $data = Menu::create();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();
            $menu = Menu::find($id);
            // dd($menu);
            $foto = [];
            if ($request->gambars) {
                # code...
                $fotoNew = json_decode($menu->gambar);
                foreach ($request->file('gambars') as $key => $value) {
                    # code...
                    $filename = $value->getClientOriginalName();
                    $value->storeAs('/menu', $filename, 'public');
                    array_push($fotoNew, $filename);
                }

                // $fotos = $foto + $fotoNew;

                // dd($fotoNew);
                $request["gambar"] = $fotoNew;
            }



            $menu->update([
                'kategori_id' => $request->kategori_id,
                'gambar' => $request->gambar ?? $menu->gambar,
                'nama' => $request->nama,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi
            ]);

            DB::commit();
            return $this->success($menu);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
            //throw $th;
        }
    }
}
