<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToInstansisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instansis', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->after('file'); // Menambahkan kolom user_id setelah kolom file
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Menambahkan foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instansis', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Menghapus foreign key constraint
            $table->dropColumn('user_id'); // Menghapus kolom user_id
        });
    }
}
