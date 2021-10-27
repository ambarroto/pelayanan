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

Route::group(['prefix' => 'administrasi'], function() {
    Route::group(['prefix' => 'pegawai'], function () {
        Route::get('/', 'Administrasi\PegawaiController@daftarPegawai')->name('administrasi_pegawai');
        Route::get('/tambah', 'Administrasi\PegawaiController@tambahPegawai')->name('administrasi_tambah_pegawai');
        Route::post('/tambah', 'Administrasi\PegawaiController@simpanPegawai')->name('administrasi_simpan_pegawai');
    });

    Route::group(['prefix' => 'desa'], function () {
        Route::get('', 'Administrasi\DesaController@daftarDesa')->name('administrasi_desa');
        Route::get('tambah', 'Administrasi\DesaController@tambahDesa')->name('administrasi_tambah_desa');
        Route::post('tambah', 'Administrasi\DesaController@simpanDesa')->name('administrasi_simpan_desa');
    });

    Route::group(['prefix' => 'seksi'], function () {
        Route::get('', 'Administrasi\SeksiController@daftarSeksi')->name('administrasi_seksi');
        Route::get('tambah', 'Administrasi\SeksiController@tambahSeksi')->name('administrasi_tambah_seksi');
        Route::post('tambah', 'Administrasi\SeksiController@simpanSeksi')->name('administrasi_simpan_seksi');
    });
});

Route::group(['prefix' => 'arsip'], function () {
    Route::group(['prefix' => 'pelayanan-publik'], function () {
        Route::group(['prefix' => 'dispensiasi-nikah'], function () {
            Route::get('/', 'Arsip\PP\DispensiasiNikahController@daftarDispensiasiNikah')->name('arsip_dispensiasi_nikah');
            Route::get('/tambah', 'Arsip\PP\DispensiasiNikahController@tambahDispensiasiNikah')->name('tambah_arsip_dispensiasi_nikah');
            Route::post('/tambah', 'Arsip\PP\DispensiasiNikahController@simpanDispensiasiNikah')->name('simpan_arsip_dispensiasi_nikah');
        });

        Route::group(['prefix' => 'pelayanan-ktp'], function () {
            Route::get('/', 'Arsip\PP\PelayananKTPController@daftarPelayananKTP')->name('arsip_pelayanan_ktp');
            Route::get('/tambah', 'Arsip\PP\PelayananKTPController@tambahPelayananKTP')->name('tambah_arsip_pelayanan_ktp');
            Route::post('/tambah', 'Arsip\PP\PelayananKTPController@simpanPelayananKTP')->name('simpan_arsip_pelayanan_ktp');
        });

        Route::group(['prefix' => 'skm'], function () {
            Route::get('/', 'Arsip\PP\SKMController@daftarArsipSKM')->name('arsip_skm');
            Route::get('/tambah', 'Arsip\PP\SKMController@tambahArsipSKM')->name('tambah_arsip_skm');
            Route::post('/tambah', 'Arsip\PP\SKMController@simpanArsipSKM')->name('simpan_arsip_skm');
        });
    });

    Route::group(['prefix' => 'kepegawaian'], function () {
        Route::group(['prefix' => 'sk-cpns'], function () {
            Route::get('/', 'Arsip\Kepegawaian\SkCpnsController@daftarSkCpns')->name('arsip_sk_cpns');
            Route::get('/tambah', 'Arsip\Kepegawaian\SkCpnsController@tambahSkCpns')->name('tambah_arsip_sk_cpns');
            Route::post('/tambah', 'Arsip\Kepegawaian\SkCpnsController@simpanSkCpns')->name('simpan_arsip_sk_cpns');
        });

        Route::group(['prefix' => 'sk-pns'], function () {
            Route::get('/', 'Arsip\Kepegawaian\SkPnsController@daftarSkPns')->name('arsip_sk_pns');
            Route::get('/tambah', 'Arsip\Kepegawaian\SkPnsController@tambahSkPns')->name('tambah_arsip_sk_pns');
            Route::post('/tambah', 'Arsip\Kepegawaian\SkPnsController@simpanSkPns')->name('simpan_arsip_sk_pns');
        });

        Route::group(['prefix' => 'pendidikan'], function () {
            Route::get('/', 'Arsip\Kepegawaian\PendidikanController@daftarPendidikan')->name('arsip_pendidikan');
            Route::get('/tambah', 'Arsip\Kepegawaian\PendidikanController@tambahPendidikan')->name('tambah_arsip_pendidikan');
            Route::post('/tambah', 'Arsip\Kepegawaian\PendidikanController@simpanPendidikan')->name('simpan_arsip_pendidikan');
        });

        Route::group(['prefix' => 'kenaikan-pangkat'], function () {
            Route::get('/', 'Arsip\Kepegawaian\PangkatController@daftarPangkat')->name('arsip_pangkat');
            Route::get('/tambah', 'Arsip\Kepegawaian\PangkatController@tambahPangkat')->name('tambah_arsip_pangkat');
            Route::post('/tambah', 'Arsip\Kepegawaian\PangkatController@simpanPangkat')->name('simpan_arsip_pangkat');
        });

        Route::group(['prefix' => 'skp'], function () {
            Route::get('/', 'Arsip\Kepegawaian\SKPController@daftarSKP')->name('arsip_skp');
            Route::get('/tambah', 'Arsip\Kepegawaian\SKPController@tambahSKP')->name('tambah_arsip_skp');
            Route::post('/tambah', 'Arsip\Kepegawaian\SKPController@simpanSKP')->name('simpan_arsip_skp');
        });
    });

    Route::group(['prefix' => 'pemberdayaan-masyarakat'], function () {
        Route::group(['prefix' => 'laporan-realisasi-apbdes'], function () {
            Route::get('/', 'Arsip\PM\LaporanRealisasiAPBDesController@daftarLaporanRealisasiAPBDes')->name('arsip_laporan_realisasi_apbdes');
            Route::get('/tambah', 'Arsip\PM\LaporanRealisasiAPBDesController@tambahLaporanRealisasiAPBDes')->name('tambah_arsip_laporan_realisasi_apbdes');
            Route::post('/tambah', 'Arsip\PM\LaporanRealisasiAPBDesController@simpanLaporanRealisasiAPBDes')->name('simpan_arsip_laporan_realisasi_apbdes');
        });

        Route::group(['prefix' => 'lpj-bumdes'], function () {
            Route::get('/', 'Arsip\PM\LPJBumdesController@daftarLPJBumdes')->name('arsip_lpj_bumdes');
            Route::get('/tambah', 'Arsip\PM\LPJBumdesController@tambahLPJBumdes')->name('tambah_arsip_lpj_bumdes');
            Route::post('/tambah', 'Arsip\PM\LPJBumdesController@simpanLPJBumdes')->name('simpan_arsip_lpj_bumdes');
        });

        Route::group(['prefix' => 'laporan-realisasi-dana-desa'], function () {
            Route::get('/', 'Arsip\PM\LaporanDanaDesaController@daftarLaporanDanaDesa')->name('arsip_laporan_dana_desa');
            Route::get('/tambah', 'Arsip\PM\LaporanDanaDesaController@tambahLaporanDanaDesa')->name('tambah_arsip_laporan_dana_desa');
            Route::post('/tambah', 'Arsip\PM\LaporanDanaDesaController@simpanLaporanDanaDesa')->name('simpan_arsip_laporan_dana_desa');
        });

        Route::group(['prefix' => 'administrasi-desa'], function () {
            Route::get('/', 'Arsip\PM\AdministrasiDesaController@daftarAdministrasiDesa')->name('arsip_administrasi_desa');
            Route::get('/tambah', 'Arsip\PM\AdministrasiDesaController@tambahAdministrasiDesa')->name('tambah_arsip_administrasi_desa');
            Route::post('/tambah', 'Arsip\PM\AdministrasiDesaController@simpanAdministrasiDesa')->name('simpan_arsip_administrasi_desa');
        });

        Route::group(['prefix' => 'laporan-alokasi-dana-desa'], function () {
            Route::get('/', 'Arsip\PM\LaporanAlokasiDanaDesaController@daftarLaporanAlokasiDanaDesa')->name('arsip_laporan_alokasi_dana_desa');
            Route::get('/tambah', 'Arsip\PM\LaporanAlokasiDanaDesaController@tambahLaporanAlokasiDanaDesa')->name('tambah_arsip_laporan_alokasi_dana_desa');
            Route::post('/tambah', 'Arsip\PM\LaporanAlokasiDanaDesaController@simpanLaporanAlokasiDanaDesa')->name('simpan_arsip_laporan_alokasi_dana_desa');
        });

        Route::group(['prefix' => 'rekap-data'], function () {
            Route::get('/', 'Arsip\PM\RekapDataController@daftarRekapData')->name('arsip_rekap_data');
            Route::get('/tambah', 'Arsip\PM\RekapDataController@tambahRekapData')->name('tambah_arsip_rekap_data');
            Route::post('/tambah', 'Arsip\PM\RekapDataController@simpanRekapData')->name('simpan_arsip_rekap_data');
        });
    });
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