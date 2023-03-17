<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusPelatih extends Model
{
    use HasFactory;

    protected $table = 'kursuspelatih';

    protected $fillable = [
        'idKategori',
        'idKota',
        'idPelatih',
        'deskripsi',
        'harga',
        'sesi',
        'target'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'idPelatih');
    }
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'idKategori');
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class,'idKota');
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
