<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CariTeman extends Model
{
    use HasFactory;

    protected $table = "cariteman";
    protected $fillable = [
        'idOwner',
        'idKota',
        'idKategori',
        'tanggalMain',
        'jam',
        'deskripsi'
    ];

    public function setTanggalMain($value)
    {
        $this->attributes['tanggalMain'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }

    public function getTanggalMain()
    {
        return Carbon::createFromFormat('Y-m-d',$this->attributes['tanggalMain'])->format('m/d/Y');
    }
    
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
}
