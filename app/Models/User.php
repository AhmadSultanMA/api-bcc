<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'deskirpsi',
        'nomor',
        'jenisKelamin',
        'pekerjaan',
        'umur',
        'email',
        'gambar',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function lapangan()
    {
        return $this->hasMany(Lapangan::class);
    }

    public function cariTeman()
    {
        return $this->hasMany(CariTeman::class);
    }

    public function alatSewa()
    {
        return $this->hasMany(AlatSewa::class);
    }

    public function accTeman()
    {
        return $this->hasMany(AccTeman::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
