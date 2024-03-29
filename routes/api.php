<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    KotaController,
    KategoriController,
    LapanganController,
    AlatSewaController,
    CariTemanController,
    AccTemanController,
    OrderController,
    KursusController
};


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|d
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    // Authentication
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/registerPenjual', [AuthController::class, 'registerPenjual']);
    Route::post('/registerPelatih', [AuthController::class, 'registerPelatih']);
    Route::post('/login',[AuthController::class, 'login']);
    
    Route::get('/showPelatih',[AuthController::class, 'showPelatih']);

    Route::post('/callback', [OrderController::class, 'callback']);

    // Kota
    Route::get('/showKota',[KotaController::class, 'showKota']);

    // Kategori
    Route::get('/showKategori',[KategoriController::class, 'showKategori']);

    // Cari Teman
    Route::get('/showSemuaTeman',[CariTemanController::class, 'showAllTeman']);

    // Lapangan
    Route::get('/showSemuaLapangan',[LapanganController::class, 'showAllLapangan']);
    Route::get('/showLapangan/{idKategori}/{idKota}',[LapanganController::class, 'showLapangan']);
    Route::get('/showLapanganTerendah/{idKategori}/{idKota}',[LapanganController::class, 'showLapanganTerendah']);
    Route::get('/showLapanganTertinggi/{idKategori}/{idKota}',[LapanganController::class, 'showLapanganTertinggi']);
    Route::get('/showLapanganById/{id}',[LapanganController::class, 'showLapanganById']);
    Route::get('/searchLapangan/{name}',[LapanganController::class, 'searchLapangan']);

Route::group(['middleware' => 'auth:sanctum'], function() {
    // Authentication
    Route::post('/logout',[AuthController::class, 'logout']);
    Route::get('/userId/{id}', [AuthController::class, 'showUserById']);
    Route::post('/editUser',[AuthController::class, 'editUser']);

    // Payment
    Route::post('/checkout', [OrderController::class, 'checkout']);
    Route::get('/showOrder/{idOwner}', [OrderController::class, 'showOrder']);
    Route::get('/showOrderById/{idOwner}/{id}', [OrderController::class, 'showOrderById']);
    Route::get('/showOrderIdLapangan/{idLapangan}', [OrderController::class, 'showOrderIdLapangan']);

    Route::post('/checkoutKursus', [OrderController::class, 'checkoutKursus']);
    Route::get('/showOrderKursus/{idOwner}', [OrderController::class, 'showOrderKursus']);
    Route::get('/showOrderKursusById/{idOwner}/{id}', [OrderController::class, 'showOrderKursusById']);
    Route::get('/showOrderIdKursus/{idKursus}', [OrderController::class, 'showOrderIdKursus']);
    
    Route::post('/getToken', [OrderController::class, 'getToken']);

    Route::get('/showAlat/{idLapangan}',[AlatSewaController::class, 'showAlat']);

    // Kursus
    Route::get('/showKursus/{idKategori}/{idKota}',[KursusController::class, 'showKursus']);
    Route::get('/showOwnedKursus/{idPelatih}',[KursusController::class, 'showOwnedKursus']);
    Route::post('/addKursus',[KursusController::class, 'addKursus']);
    Route::post('/editKursus',[KursusController::class, 'editKursus']);
    Route::post('/deleteKursus/{id}',[KursusController::class, 'deleteKursus']);

    // Cari Teman
    Route::post('/addCariTeman',[CariTemanController::class, 'addCariTeman']);
    Route::post('/updateCariTeman',[CariTemanController::class, 'updateCariTeman']);
    Route::get('/cariTeman/{idKategori}/{idKota}',[CariTemanController::class, 'showCariTeman']);
    Route::post('/deleteCariTeman/{id}',[CariTemanController::class, 'deleteCariTeman']);

    // Acceptance Teman
    Route::post('/addAccTeman',[AccTemanController::class, 'addAccTeman']);
    Route::get('/showAccTeman/{idCariTeman}/{idTeman}',[AccTemanController::class, 'showAccTeman']);
    Route::get('/showAccTemanById/{id}',[AccTemanController::class, 'showAccTemanById']);
    Route::get('/showOwnerTeman/{idCariTeman}/{idOwner}',[AccTemanController::class, 'showOwnerTeman']);
    Route::post('/editAccTeman',[AccTemanController::class, 'editAccTeman']);
    Route::post('/deleteAccTeman/{id}/{idOwner}',[AccTemanController::class, 'deleteAccTeman']);

    Route::group(['middleware' => ['role:admin|penjual']], function () {
        // Lapangan
        Route::post('/addLapangan',[LapanganController::class, 'addLapangan']);
        Route::get('/showOwnedLapangan/{idOwner}',[LapanganController::class, 'showOwnedLapangan']);
        Route::post('/deleteLapangan/{id}',[LapanganController::class, 'deleteLapangan']);
        Route::post('/updateLapangan',[LapanganController::class, 'updateLapangan']);

        // AlatSewa
        Route::post('/addAlat',[AlatSewaController::class, 'addAlat']);
        Route::post('/updateAlat',[AlatSewaController::class, 'updateAlat']);
        Route::post('/deleteAlat/{id}',[AlatSewaController::class, 'deleteAlat']);

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


