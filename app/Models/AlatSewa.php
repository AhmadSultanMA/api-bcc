<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatSewa extends Model
{
    use HasFactory;

    protected $table = "alatsewa";
    protected $fillable = [
        'idLapangan',
        'idOwner',
        'namaAlat',
        'harga',
        'jumlah'
    ];

    public function Lapangan()
    {
        return $this->belongsTo(Lapangan::class,'idLapangan');
    }

    public function User()
    {
        return $this->belongsTo(User::class,'idOwner');
    }
}
