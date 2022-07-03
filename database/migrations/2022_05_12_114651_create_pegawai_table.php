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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nrp')->unique();
            $table->text('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->text('nik')->unique(20)->nullable();
            $table->text('no_kk')->nullable();
            $table->text('alamat')->nullable();
            $table->tinyInteger('status_perkawinan')->comment('1 = belum kawin, 2 = kawin, 3 = cerai hidup, 4 = cerai mati')->nullable();
            $table->tinyInteger('jumlah_anak')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('gelar')->nullable();
            $table->string('agama')->nullable();
            $table->string('no_wa')->nullable();
            $table->string('nama_ibu_kandung')->nullable();
            $table->string('nama_ayah_kandung')->nullable();
            $table->string('nama_ibu_mertua')->nullable();
            $table->string('nama_ayah_mertua')->nullable();
            $table->string('jabatan');
            $table->string('jenjang_kepangkatan')->nullable();
            $table->string('npwp')->nullable();
            $table->string('nidn')->nullable();
            $table->date('tgl_kontrak_pkwt_1')->nullable();
            $table->date('tgl_kontrak_pkwt_2')->nullable();
            $table->date('tgl_sk_tetap')->nullable();
            $table->string('no_bpjs_ketenagakerjaan')->nullable();
            $table->string('no_bpjs_kesehatan')->nullable();
            $table->string('dokter_paskes_tingkat_1')->nullable();
            $table->string('bank')->nullable();
            $table->string('an')->nullable();
            $table->string('no_rekening')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};
