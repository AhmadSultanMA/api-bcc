<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    KotaController,
    KategoriController,
    LapanganController
};


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
    // Authentication
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/registerPenjual', [AuthController::class, 'registerPenjual']);
    Route::post('/login',[AuthController::class, 'login']);
   
    // Kota
    Route::get('/showKota',[KotaController::class, 'showKota']);

    // Kategori
    Route::get('/showKategori',[KategoriController::class, 'showKategori']);

    // Lapangan
    Route::get('/showLapangan/{idKategori}/{idKota}',[LapanganController::class, 'showLapangan']);
    Route::get('/showId/{id}',[LapanganController::class, 'showById']);
    Route::get('/searchLapangan/{name}',[LapanganController::class, 'searchLapangan']);

Route::group(['middleware' => 'auth:sanctum'], function() {
    // Authentication
    Route::post('/logout',[AuthController::class, 'logout']);
    Route::get('/cariPartner/{idKota}/{idKategori}', [AuthController::class, 'findPartner']);
    Route::post('/editIdUser',[AuthController::class, 'editIdUser']);

    Route::group(['middleware' => ['role:admin|penjual']], function () {
        // Lapangan
        Route::post('/addLapangan',[LapanganController::class, 'addLapangan']);
        Route::get('/showOwnedLapangan/{idOwner}',[LapanganController::class, 'showOwnedLapangan']);
        Route::post('/deleteLapangan/{id}',[LapanganController::class, 'deleteLapangan']);
        Route::post('/updateLapangan',[LapanganController::class, 'updateLapangan']);
    });

    Route::group(['middleware' => ['role:admin']], function () {
        // Authentication
        Route::post('/registerAdmin', [AuthController::class, 'registerAdmin']);
        Route::get('/showUser',[AuthController::class, 'showUser']);
        Route::get('/searchUser/{name}',[AuthController::class, 'searchUser']);

        // Kota
        Route::post('/addKota',[KotaController::class, 'addKota']);
        Route::post('/deleteKota/{id}',[KotaController::class, 'deleteKota']);

        // Kategori
        Route::post('/addKategori',[KategoriController::class, 'addKategori']);
        Route::post('/deleteKategori/{id}',[KategoriController::class, 'deleteKategori']);
    });
});


