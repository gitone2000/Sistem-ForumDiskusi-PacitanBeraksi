<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom relasi baru
            $table->unsignedBigInteger('bidang_id')->nullable()->after('desa_id');
            $table->unsignedBigInteger('perguruan_id')->nullable()->after('bidang_id');
            $table->unsignedBigInteger('kota_perguruan_id')->nullable()->after('perguruan_id');

            // Hapus kolom lama
            $table->dropColumn(['bidang', 'perguruan', 'kota_perguruan']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kembali kolom lama jika rollback
            $table->string('bidang')->nullable();
            $table->string('perguruan')->nullable();
            $table->string('kota_perguruan')->nullable();

            // Hapus kolom relasi
            $table->dropColumn(['bidang_id', 'perguruan_id', 'kota_perguruan_id']);
        });
    }
}
