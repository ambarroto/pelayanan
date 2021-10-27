<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePpSkmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pp_skm', function (Blueprint $table) {
            $table->dropForeign(['id_seksi']);
        });
        Schema::table('pp_skm', function (Blueprint $table) {
            $table->bigInteger('id_seksi')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pp_skm', function (Blueprint $table) {
            $table->unsignedBigInteger('id_seksi')->nullable(false)->change();
            $table->foreign('id_seksi')->references('id')->on('seksi');
        });
    }
}
