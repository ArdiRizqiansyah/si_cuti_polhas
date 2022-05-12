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
            $table->text('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('nik')->unique();
            $table->text('no_kk');
            $table->text('alamat');
            $table->tinyInteger('status_perkawinan')->comment('1 = belum kawin, 2 = kawin, 3 = cerai hidup, 4 = cerai mati');
            $table->tinyInteger('jumlah_anak');
            $table->string('pendidikan_terakhir');
            $table->string('gelar')->nullable();
            $table->string('agama');
            $table->string('no_wa');
            $table->string('nama_ibu_kandung');
            $table->string('nama_ayah_kandung');
            $table->string('nama_ibu_mertua');
            $table->string('nama_ayah_mertua');
            $table->string('jabatan');
            $table->string('jenjang_kepangkatan');
            $table->string('npwp');
            $table->string('nidn');
            $table->date('tgl_kontrak_pkwt_1')->nullable();
            $table->date('tgl_kontrak_pkwt_2')->nullable();
            $table->date('tgl_sk_tetap')->nullable();
            $table->string('no_bpjs_ketenagakerjaan')->nullable();
            $table->string('no_bpjs_kesehatan')->nullable();
            $table->string('dokter_paskes_tingkat_1')->nullable();
            $table->string('bank');
            $table->string('a/n');
            $table->string('no_rekening');
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
