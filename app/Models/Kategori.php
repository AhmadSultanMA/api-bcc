<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable = [
        'namaKategori',
    ];

    public function lapangan()
    {
        return $this->hasMany(Lapangan::class);
    }

    public function cariTeman()
    {
        return $this->hasMany(CariTeman::class);
    }
}
