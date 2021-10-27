<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePmAdministrasiDesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pm_administrasi_desa', function (Blueprint $table) {
            $table->dropForeign(['id_seksi']);
        });
        Schema::table('pm_administrasi_desa', function (Blueprint $table) {
            $table->bigInteger('id_seksi')->nullable()->change();
            $table->string('nama')->nullable()->change();
            $table->string('peruntukan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pm_administrasi_desa', function (Blueprint $table) {
            $table->string('nama')->nullable(false)->change();
            $table->string('peruntukan')->nullable(false)->change();
            $table->unsignedBigInteger('id_seksi')->nullable(false)->change();
            $table->foreign('id_seksi')->references('id')->on('seksi');
        });
    }
}
