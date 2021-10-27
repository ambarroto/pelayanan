<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmLpjBumdesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pm_lpj_bumdes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_seksi');
            $table->string('nama');
            $table->string('tahun');
            $table->unsignedBigInteger('id_desa');
            $table->tinyInteger('status')->default(1)->nullable();
            $table->timestamps();

            $table->foreign('id_seksi')->references('id')->on('seksi');
            $table->foreign('id_desa')->references('id')->on('desa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pm_lpj_bumdes');
    }
}
