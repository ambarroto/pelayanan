<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor');
            $table->date('tanggal_terima');
            $table->text('alamat_surat');
            $table->date('tanggal_surat');
            $table->string('nomor_surat');
            $table->text('perihal_surat');
            $table->dateTime('waktu_kegiatan')->nullable();
            $table->string('tempat_kegiatan')->nullable();
            $table->string('catatan')->nullable();
            $table->string('keterangan')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('surat_masuk');
    }
}
