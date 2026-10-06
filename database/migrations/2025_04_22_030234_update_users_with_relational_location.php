<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersWithRelationalLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('kecamatan_id')->nullable()->after('alamat');
            $table->unsignedBigInteger('desa_id')->nullable()->after('kecamatan_id');
    
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('set null');
            $table->foreign('desa_id')->references('id')->on('desas')->onDelete('set null');
    
            // Optional: Drop kolom lama kalau yakin udah gak dipakai
            $table->dropColumn('kecamatan');
            $table->dropColumn('desa');
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
            $table->dropForeign(['kecamatan_id']);
            $table->dropForeign(['desa_id']);
            $table->dropColumn(['kecamatan_id', 'desa_id']);
    
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
        });
    }
}
