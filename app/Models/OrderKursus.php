<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OrderKursus extends Model
{
    use HasFactory;

    protected $table = 'orderkursus';

    protected $fillable = [
        'order_id',
        'idOwner',
        'idKursus',
        'jmlBulan',
        'harga',
        'tanggalBooking',
        'status',
    ];

    public function generateOrderId() {
        $number = mt_rand(1000000000, 9999999999);

        if ($this->OrderIdExists($number)) {
            return generateOrderId();
        }

        $this->attributes['order_id'] = "ko$number";
    }
    
    public function OrderIdExists($number) {
        return Order::where('order_id',$number)->exists();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'idOwner');
    }

    public function kursus()
    {
        return $this->belongsTo(KursusPelatih::class,'idKursus');
    }

    public function setTanggalKursus($value)
    {
        $this->attributes['tanggalBooking'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }

    public function getTanggalKursus()
    {
        return Carbon::createFromFormat('Y-m-d',$this->attributes['tanggalBooking'])->format('m/d/Y');
    }
}
