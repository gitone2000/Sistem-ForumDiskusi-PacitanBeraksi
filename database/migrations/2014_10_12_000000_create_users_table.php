<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('whatsapp');
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
            $table->text('alamat')->nullable();
            $table->string('bidang');
            $table->string('perguruan');
            $table->string('kota_perguruan');
            $table->string('jenjang');
            $table->string('program_studi');
            $table->string('tahun_masuk')->nullable();
            $table->string('foto_diri')->nullable();
            $table->string('ktm')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('portofolio')->nullable();
            $table->string('ig')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
