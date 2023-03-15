<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    protected $table = 'lapangan';

    protected $fillable = [
        'idKategori',
        'idKota',
        'idOwner',
        'namaLapangan',
        'lokasi',
        'deskripsi',
        'harga',
        'gambar',
        'jamBuka',
        'jamTutup',
        'statusToko',
        'nomor'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'idOwner');
    }
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'idKategori');
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class,'idKota');
    }

    public function alatSewa()
    {
        return $this->hasMany(AlatSewa::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
