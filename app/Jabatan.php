<?php
namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 
        'nama_jabatan', 
        'nama'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
