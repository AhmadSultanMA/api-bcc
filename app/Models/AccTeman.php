<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccTeman extends Model
{
    use HasFactory;

    protected $table = 'accteman';
    protected $fillable = [
        'idCariTeman',
        'idTeman',
        'idOwner',
        'status'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class,'idOwner');
    }

    public function teman()
    {
        return $this->belongsTo(User::class,'idTeman');
    }

    public function cariTeman()
    {
        return $this->belongsTo(CariTeman::class, 'idCariTeman');
    }
}
