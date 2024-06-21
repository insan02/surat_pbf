<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameSuratkeluarToTransaksisurat extends Migration
{
    public function up()
    {
        Schema::rename('suratkeluar', 'transaksi_surat');
    }

    public function down()
    {
        Schema::rename('transaksi_surat', 'suratkeluar');
    }
}
