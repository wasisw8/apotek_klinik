<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\MasterDistributorController;
use App\Http\Controllers\Master\MasterGudangController;
use App\Http\Controllers\Master\MasterJenisObatController;
use App\Http\Controllers\Master\MasterKategoriObatController;
use App\Http\Controllers\Master\MasterObatController;
use App\Http\Controllers\Master\MasterSatuanObatController;
use App\Http\Controllers\Master\MasterSediaanObatController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::group(['prefix' => 'master'], function () {
        // distributor
        Route::get('distributor', [MasterDistributorController::class, 'index'])->name('master.distributor');
        Route::post('distributor/load', [MasterDistributorController::class, 'load'])->name('master.distributor.load');
        Route::post('distributor/dataEdit', [MasterDistributorController::class, 'dataEdit'])->name('master.distributor.dataEdit');
        Route::post('distributor/save', [MasterDistributorController::class, 'save'])->name('master.distributor.save');
        Route::post('distributor/update', [MasterDistributorController::class, 'update'])->name('master.distributor.update');
        Route::post('distributor/delete', [MasterDistributorController::class, 'delete'])->name('master.distributor.delete');
        Route::post('distributor/getData', [MasterDistributorController::class, 'getData'])->name('master.distributor.getData');
        // Sediaan obat
        Route::get('sediaan-obat', [MasterSediaanObatController::class, 'index'])->name('master.sediaan-obat');
        Route::post('sediaan-obat/load', [MasterSediaanObatController::class, 'load'])->name('master.sediaan-obat.load');
        Route::post('sediaan-obat/dataEdit', [MasterSediaanObatController::class, 'dataEdit'])->name('master.sediaan-obat.dataEdit');
        Route::post('sediaan-obat/save', [MasterSediaanObatController::class, 'save'])->name('master.sediaan-obat.save');
        Route::post('sediaan-obat/update', [MasterSediaanObatController::class, 'update'])->name('master.sediaan-obat.update');
        Route::post('sediaan-obat/delete', [MasterSediaanObatController::class, 'delete'])->name('master.sediaan-obat.delete');
        Route::post('sediaan-obat/getData', [MasterSediaanObatController::class, 'getData'])->name('master.sediaan-obat.getData');
        // satuan obat
        Route::get('satuan-obat', [MasterSatuanObatController::class, 'index'])->name('master.satuan-obat');
        Route::post('satuan-obat/load', [MasterSatuanObatController::class, 'load'])->name('master.satuan-obat.load');
        Route::post('satuan-obat/dataEdit', [MasterSatuanObatController::class, 'dataEdit'])->name('master.satuan-obat.dataEdit');
        Route::post('satuan-obat/save', [MasterSatuanObatController::class, 'save'])->name('master.satuan-obat.save');
        Route::post('satuan-obat/update', [MasterSatuanObatController::class, 'update'])->name('master.satuan-obat.update');
        Route::post('satuan-obat/delete', [MasterSatuanObatController::class, 'delete'])->name('master.satuan-obat.delete');
        Route::post('satuan-obat/getData', [MasterSatuanObatController::class, 'getData'])->name('master.satuan-obat.getData');
        // Kategori obat
        Route::get('kategori-obat', [MasterKategoriObatController::class, 'index'])->name('master.kategori-obat');
        Route::post('kategori-obat/load', [MasterKategoriObatController::class, 'load'])->name('master.kategori-obat.load');
        Route::post('kategori-obat/dataEdit', [MasterKategoriObatController::class, 'dataEdit'])->name('master.kategori-obat.dataEdit');
        Route::post('kategori-obat/save', [MasterKategoriObatController::class, 'save'])->name('master.kategori-obat.save');
        Route::post('kategori-obat/update', [MasterKategoriObatController::class, 'update'])->name('master.kategori-obat.update');
        Route::post('kategori-obat/delete', [MasterKategoriObatController::class, 'delete'])->name('master.kategori-obat.delete');
        Route::post('kategori-obat/getData', [MasterKategoriObatController::class, 'getData'])->name('master.kategori-obat.getData');
        // Jenis obat
        Route::get('jenis-obat', [MasterJenisObatController::class, 'index'])->name('master.jenis-obat');
        Route::post('jenis-obat/load', [MasterJenisObatController::class, 'load'])->name('master.jenis-obat.load');
        Route::post('jenis-obat/dataEdit', [MasterJenisObatController::class, 'dataEdit'])->name('master.jenis-obat.dataEdit');
        Route::post('jenis-obat/save', [MasterJenisObatController::class, 'save'])->name('master.jenis-obat.save');
        Route::post('jenis-obat/update', [MasterJenisObatController::class, 'update'])->name('master.jenis-obat.update');
        Route::post('jenis-obat/delete', [MasterJenisObatController::class, 'delete'])->name('master.jenis-obat.delete');
        Route::post('jenis-obat/getData', [MasterJenisObatController::class, 'getData'])->name('master.jenis-obat.getData');
        // Gudang
        Route::post('gudang/getData', [MasterGudangController::class, 'getData'])->name('master.gudang.getData');
        // Jenis obat
        Route::get('obat', [MasterObatController::class, 'index'])->name('master.obat');
        Route::post('obat/load', [MasterObatController::class, 'load'])->name('master.obat.load');
        Route::post('obat/dataEdit', [MasterObatController::class, 'dataEdit'])->name('master.obat.dataEdit');
        Route::post('obat/save', [MasterObatController::class, 'save'])->name('master.obat.save');
        Route::post('obat/update', [MasterObatController::class, 'update'])->name('master.obat.update');
        Route::post('obat/delete', [MasterObatController::class, 'delete'])->name('master.obat.delete');
        Route::post('obat/getData', [MasterObatController::class, 'getData'])->name('master.obat.getData');
    });
    // Pembelian
        Route::get('pembelian', [PembelianController::class, 'index'])->name('pembelian');
        Route::post('pembelian/load', [PembelianController::class, 'load'])->name('pembelian.load');
        Route::post('pembelian/dataEdit', [PembelianController::class, 'dataEdit'])->name('pembelian.dataEdit');
        Route::post('pembelian/save', [PembelianController::class, 'save'])->name('pembelian.save');
        Route::post('pembelian/update', [PembelianController::class, 'update'])->name('pembelian.update');
        Route::post('pembelian/delete', [PembelianController::class, 'delete'])->name('pembelian.delete');
        Route::post('pembelian/getData', [PembelianController::class, 'getData'])->name('pembelian.getData');

});

require __DIR__.'/auth.php';
