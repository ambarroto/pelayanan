<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpDispensiasiNikahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_dispensiasi_nikah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_seksi');
            $table->string('nomor');
            $table->date('tanggal');
            $table->tinyInteger('status')->default(1)->nullable();
            $table->timestamps();

            $table->foreign('id_seksi')->references('id')->on('seksi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pp_dispensiasi_nikah');
    }
}
