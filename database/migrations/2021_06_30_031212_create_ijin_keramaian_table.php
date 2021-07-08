<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIjinKeramaianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ijin_keramaian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nomor');
            $table->date('tanggal');
            $table->string('nama');
            $table->integer('umur')->default(0)->nullable();
            $table->string('agama');
            $table->string('alamat');
            $table->string('pekerjaan');
            $table->string('hajat');
            $table->integer('jumlah_undangan')->default(0)->nullable();
            $table->string('macam_hiburan')->nullable();
            $table->date('tanggal_keramaian');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('ijin_keramaian');
    }
}
