<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id')->nullable()->after('user_id');
            $table->unsignedBigInteger('kepala_id')->nullable()->after('unit_id');

            $table->foreign('unit_id')->references('id')->on('unit')->onDelete('set null');
            $table->foreign('kepala_id')->references('id')->on('unit')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
            $table->dropForeign(['kepala_id']);
            $table->dropColumn('unit_id');
            $table->dropColumn('kepala_id');
        });
    }
};
