<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kota;


class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kota::create([
            'namaKota' => 'malang',
        ]);
    }
}
