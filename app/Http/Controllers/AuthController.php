<?php

namespace App\Http\Controllers;

use App\Http\Traits\Response;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    use Response;

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->error('Email atau password anda salah');
            }


            $return = [
                'token' => $token,
                'user' => User::where('email', $request->email)->first()
            ];


            return $this->success($return, 'Login success');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    public function register(Request $request)
    {
        try {
            DB::beginTransaction();
            // if (isset($request->validator) && $request->validator->fails()) {
            //     return $this->error($request->validator->errors());
            // }

            $user = User::create([
                'name' => $request->name,
                'role' => $request->role,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);




            $token = JWTAuth::fromUser($user);

            $return = [
                'token' => $token,
                'user' => $user
            ];

            DB::commit();

            return $this->success($return);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return $this->error($th->getMessage(), $th->getCode());
        }
    }

    public function logout(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->update([
            'remember_token' => null,
            'status' => 'tidak aktif'
        ]);
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function logoutWeb()
    {
        $user = User::find(Auth::user()->id)->update([
            'remember_token' => null,
            'status' => 'tidak aktif'
        ]);

        if (Cookie::get('admin_cookie')) {
            return response('berhasil logout')->withoutCookie('admin_cookie');
        } else if (Cookie::get('owner_cookie')) {
            return response('berhasil logout')->withoutCookie('owner_cookie');
        } else if (Cookie::get('user_cookie')) {
            return response('berhasil logout')->withoutCookie('user_cookie');
        }
    }

    public function routeCheck(Request $request)
    {

        if ($request->cookie('admin_cookie')) {
            return redirect('/admin');
        } else if ($request->cookie('owner_cookie')) {
            return redirect('/owner/dashboard');
        } else if ($request->cookie('user_cookie')) {
            return redirect('/user/dashboard');
        } else {
            return  view('auth.login');
        }
    }
}
