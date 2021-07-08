<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisi_surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->integer('id_surat_masuk');
            $table->string('surat_dari');
            $table->date('tanggal_surat');
            $table->string('nomor_surat');
            $table->string('perihal');
            $table->date('tanggal_terima');
            $table->string('nomor_agenda')->nullable();
            $table->string('tembusan')->nullable();
            $table->text('isi_disposisi')->nullable();
            $table->tinyInteger('status');
            $table->text('read_by')->nullable();
            $table->integer('created_id')->nullable();
            $table->integer('updated_id')->nullable();
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
        Schema::dropIfExists('disposisi');
    }
}
