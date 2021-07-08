<?php

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

Route::get('/', 'DashboardController@index')->name('home');
Route::get('/peta', 'PetaController@index')->name('peta');
Route::get('/map', function () {

})->name('map');

Route::group(['prefix' => 'surat-masuk'], function () {
    Route::get('/', 'SuratMasukController@index')->name('surat_masuk');
    Route::get('/tambah', 'SuratMasukController@tambah')->name('tambah_surat_masuk');
    Route::post('/tambah', 'SuratMasukController@input')->name('input_surat_masuk');
    Route::get('/{id}/edit', 'SuratMasukController@edit')->name('edit_surat_masuk');
    Route::put('/{id}/edit', 'SuratMasukController@update')->name('update_surat_masuk');
    Route::get('/{id}', 'SuratMasukController@view')->name('detail_surat_masuk');
    Route::post('/export-pdf', 'SuratMasukController@exportPdf')->name('export_pdf_surat_masuk');
});

Route::group(['prefix' => 'surat-keluar'], function () {
    Route::get('/', 'SuratKeluarController@index')->name('surat_keluar');
    Route::get('/tambah', 'SuratKeluarController@tambah')->name('tambah_surat_keluar');
    Route::post('/tambah', 'SuratKeluarController@input')->name('input_surat_keluar');
    Route::get('/{id}', 'SuratKeluarController@view')->name('detail_surat_keluar');
});

Route::group(['prefix' => 'skck'], function () {
    Route::get('/', 'SkckController@index')->name('skck');
    Route::get('/tambah', 'SkckController@tambah')->name('tambah_skck');
    Route::post('/tambah', 'SkckController@input')->name('input_skck');
});

Route::group(['prefix' => 'kedatangan'], function () {
    Route::get('/', 'KedatanganController@index')->name('kedatangan');
    Route::get('/tambah', 'KedatanganController@tambah')->name('tambah_kedatangan');
    Route::post('/tambah', 'KedatanganController@input')->name('input_kedatangan');
});

Route::group(['prefix' => 'imb'], function () {
    Route::get('/', 'ImbController@index')->name('imb');
    Route::get('/tambah', 'ImbController@tambah')->name('tambah_imb');
    Route::post('/tambah', 'ImbController@input')->name('input_imb');
});

Route::group(['prefix' => 'ijin-keramaian'], function () {
    Route::get('/', 'IjinKeramaianController@index')->name('ijin_keramaian');
    Route::get('/tambah', 'IjinKeramaianController@tambah')->name('tambah_ijin_keramaian');
    Route::post('/tambah', 'IjinKeramaianController@input')->name('input_ijin_keramaian');
});

Route::group(['prefix' => 'surat-keterangan'], function () {
    Route::get('/', 'SuratKeteranganController@index')->name('surat_keterangan');
    Route::get('/tambah', 'SuratKeteranganController@tambah')->name('tambah_surat_keterangan');
    Route::post('/tambah', 'SuratKeteranganController@input')->name('input_surat_keterangan');
});

Route::group(['prefix' => 'dispensiasi-nikah'], function () {
    Route::get('/', 'DispensiasiNikahController@index')->name('dispensiasi_nikah');
    Route::get('/tambah', 'DispensiasiNikahController@tambah')->name('tambah_dispensiasi_nikah');
    Route::post('/tambah', 'DispensiasiNikahController@input')->name('input_dispensiasi_nikah');
});