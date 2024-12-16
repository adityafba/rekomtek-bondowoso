<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rekomtek_applications', function (Blueprint $table) {
            $table->id();
            // Step 1 - Data Pemohon
            $table->string('nama');
            $table->text('alamat');
            $table->string('instansi');
            $table->string('jabatan');
            $table->string('nik', 16);
            $table->string('no_hp', 15);
            $table->string('email');
            $table->enum('jenis_pemohon', ['baru', 'perpanjangan']);
            
            // Step 2 - Data Lokasi dan Teknis
            $table->enum('jenis_izin', ['pengusahaan', 'penggunaan'])->nullable();
            $table->string('sub_jenis_izin')->nullable();
            $table->string('nama_pekerjaan')->nullable();
            $table->text('lokasi_pekerjaan')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            
            // Data Teknis
            $table->text('tujuan')->nullable();
            $table->string('cara_pengambilan')->nullable();
            $table->decimal('volume_pengambilan', 10, 2)->nullable();
            $table->string('jenis_konstruksi')->nullable();
            $table->integer('jadwal_pelaksanaan')->nullable();
            $table->date('rencana_pelaksanaan_mulai')->nullable();
            $table->date('rencana_pelaksanaan_selesai')->nullable();
            
            // Status
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rekomtek_applications');
    }
};
