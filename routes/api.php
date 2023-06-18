<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logoutWeb'])->middleware('jwt:owner,user');


// Route::prefix("menu")->group(function () {
//     Route::post('/', [MenuController::class, 'store']);
// });
Route::prefix('transaksi')->group(function () {
    Route::post('/', [TransaksiController::class, 'store'])->middleware('jwt:user');
    Route::get('/', [TransaksiController::class, 'index'])->middleware('jwt:user');
    Route::get('/pesanan', [TransaksiController::class, 'pesanan'])->middleware('jwt:owner');
    Route::get('/pemasukan', [TransaksiController::class, 'pemasukan'])->middleware('jwt:owner');
    Route::get('/{id}', [TransaksiController::class, 'showCart'])->middleware('jwt:user');
    Route::put('/{id}', [TransaksiController::class, 'update'])->middleware('jwt:user');
});


Route::prefix('menu')->group(function () {
    Route::get('/all', [MenuController::class, 'indexAll'])->middleware('jwt:user');
    Route::get('/favorite', [MenuController::class, 'favoriteMenu'])->middleware('jwt:user');
    Route::put('/favorite/{id}', [MenuController::class, 'addFavorite'])->middleware('jwt:user');
    Route::get('/{id}', [MenuController::class, 'show'])->middleware('jwt:user,owner');
});




Route::middleware('jwt:owner')->group(function () {
    # code...
    Route::get('/dashboard', [TransaksiController::class, 'dashboardOwner']);

    Route::prefix("kategori")->group(function () {
        Route::get('/', [KategoriController::class, 'index']);
        Route::post('/', [KategoriController::class, 'store']);
        Route::get('/{id}', [KategoriController::class, 'show']);
        Route::post('/{id}', [KategoriController::class, 'update']);
        Route::delete('/{id}', [KategoriController::class, 'delete']);
    });

    Route::prefix("menu")->group(function () {
        Route::get('/', [MenuController::class, 'index']);
        Route::post('/', [MenuController::class, 'store']);
        Route::post('/{id}', [MenuController::class, 'update']);
        Route::delete('/{id}', [MenuController::class, 'delete']);
    });
});
