<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKedatanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kedatangan', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor');
            $table->date('tanggal');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('asal_desa');
            $table->string('asal_kecamatan');
            $table->string('asal_kabupaten')->nullable();
            $table->string('asal_provinsi')->nullable();
            $table->string('tujuan_desa');
            $table->integer('jumlah_keluarga')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kedatangan');
    }
}
