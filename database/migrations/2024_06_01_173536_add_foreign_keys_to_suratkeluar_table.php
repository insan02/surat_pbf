<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSuratkeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suratkeluar', function (Blueprint $table) {

        // Tambahkan kolom untuk foreign key dari tabel dokumen
        $table->unsignedBigInteger('dokumen_id');
        $table->foreign('dokumen_id')->references('id')->on('dokumen')->onDelete('cascade');

        // Tambahkan kolom untuk foreign key dari tabel kategori
        $table->unsignedInteger('kategori_id');
        $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suratkeluar', function (Blueprint $table) {
        $table->dropForeign(['dokumen_id']);
        $table->dropForeign(['kategori_id']);

        // Hapus kolom
        $table->dropColumn(['user_id', 'dokumen_id', 'kategori_id']);
    });
    }
}
