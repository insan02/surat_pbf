<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{


    protected $table = 'dokumen';

    protected $fillable = [
        'event',
        'nama_dokumen',
        'user_id',
    ];
}

