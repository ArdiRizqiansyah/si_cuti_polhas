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
        Schema::create('izin', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('permohonan')->comment('1 = Izin, 2 = Cuti');
            $table->string('jenis');
            $table->date('tgl_mulai');
            $table->date('tgl_akhir');
            $table->tinyInteger('status')->comment('1 = Disetujui, 2 = Ditolak, 3 = Menunggu');
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
        Schema::dropIfExists('izin');
    }
};
