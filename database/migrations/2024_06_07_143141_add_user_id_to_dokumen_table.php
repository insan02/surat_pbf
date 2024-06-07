<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToDokumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokumen', function (Blueprint $table) {

        // Tambahkan kolom untuk foreign key dari tabel dokumen
        $table->unsignedInteger('user_id');
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
        Schema::table('dokumen', function (Blueprint $table) {
        $table->dropForeign(['user_id']);

        // Hapus kolom
        $table->dropColumn(['user_id']);
    });
    }
}
