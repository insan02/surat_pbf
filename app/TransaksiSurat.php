<?php

// app/TransaksiSurat.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiSurat extends Model
{
    protected $table = 'transaksisurat';

    protected $fillable = [
        'user_id', // Add any other attributes that are mass assignable
        'kategori_id',
        'dokumen_id',
        'penerima',
        'balasan',
        'keterangan',
    ];

    // TransaksiSurat model relationships
public function user()
{
    return $this->belongsTo(User::class, 'user_id'); // Relationship with sender (assuming user_id is sender's id)
}

public function penerimaUser()
{
    return $this->belongsTo(User::class, 'penerima'); // Relationship with recipient (assuming penerima is recipient's id)
}


    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class, 'dokumen_id');
    }
}

