<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/', [AuthController::class, 'routeCheck']);

Route::get('/register', function () {
    return view('auth.register');
});

Route::prefix('user')->middleware('web:user')->group(function () {
    # code...;
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    });
    Route::get('/detail', function () {
        return view('pages.detail-menu');
    });

    Route::get('/checkout', function () {
        return view('pages.checkout');
    });

    Route::get('/rincian', function () {
        return view('pages.rincian');
    });
    Route::get('/review', function () {
        return view('pages.review');
    });

    Route::get('/cart', function () {
        return view('pages.list-co');
    });

    Route::get('/favorite', function () {
        return view('pages.favorit');
    });
});

Route::get('/{mode}/profile', function () {
    return view('pages.profile');
})->middleware('web:owner,user');


Route::prefix('owner')->middleware('web:owner')->group(function () {
    Route::get('/dashboard', function () {
        return view('owner.dashboard');
    });

    Route::get('/menu',  function () {
        return view('owner.menu');
    });

    Route::get('/tambah-menu',  function () {
        return view('owner.add-menu');
    });

    Route::get('/edit-menu',  function () {
        return view('owner.edit-menu');
    });

    Route::get('/tambah-kategori',  function () {
        return view('owner.add-kategori');
    });

    Route::get('/pemasukan', function () {
        return view('owner.pemasukan');
    });
    Route::get('/inbox', function () {
        return view('owner.kotak-masuk');
    });

    Route::get('/pesanan', function () {
        return view('owner.pesanan');
    });
});

Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');
