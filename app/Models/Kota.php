<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    protected $table = "kota";
    protected $fillable = [
        'namaKota',
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
