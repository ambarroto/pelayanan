<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePmLaporanDanaAlokasiDesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pm_laporan_alokasi_dana_desa', function (Blueprint $table) {
            $table->dropForeign(['id_seksi']);
        });
        Schema::table('pm_laporan_alokasi_dana_desa', function (Blueprint $table) {
            $table->bigInteger('id_seksi')->nullable()->change();
            $table->decimal('anggaran', 20, 2)->change();
            $table->decimal('realisasi', 20, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pm_laporan_alokasi_dana_desa', function (Blueprint $table) {
            $table->decimal('anggaran')->change();
            $table->decimal('realisasi')->change();
            $table->unsignedBigInteger('id_seksi')->nullable(false)->change();
            $table->foreign('id_seksi')->references('id')->on('seksi');
        });
    }
}
