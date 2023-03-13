<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AlatSewa;


class AlatSewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       AlatSewa::create([
        'idLapangan' => 1,
        'idOwner' => 2,
        'namaAlat' => 'Bola',
        'harga' => 10000,
        'jumlah' => 10
       ]);

       AlatSewa::create([
        'idLapangan' => 2,
        'idOwner' => 2,
        'namaAlat' => 'Kok',
        'harga' => 10000,
        'jumlah' => 10
       ]);
    }
}
