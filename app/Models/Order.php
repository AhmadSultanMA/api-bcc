<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'order_id',
        'idOwner',
        'idLapangan',
        'idAlat',
        'jmlJam',
        'jamMulai',
        'jamSelesai',
        'harga',
        'tanggalBooking',
        'status',
    ];
    function generateOrderId() {
        $number = mt_rand(1000000000, 9999999999);

        if ($this->OrderIdExists($number)) {
            return generateOrderId();
        }

        $this->attributes['order_id'] = $number;
    }
    
    function OrderIdExists($number) {
        return Order::where('order_id',$number)->exists();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'idOwner');
    }

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class,'idLapangan');
    }

    public function setTanggalMain($value)
    {
        $this->attributes['tanggalBooking'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }

    public function getTanggalMain()
    {
        return Carbon::createFromFormat('Y-m-d',$this->attributes['tanggalBooking'])->format('m/d/Y');
    }
}
