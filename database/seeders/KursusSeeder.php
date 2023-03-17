<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KursusPelatih;

class KursusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KursusPelatih::create([
            'idKategori' => 1,
            'idKota' => 1,
            'idPelatih' => 3,
            'harga' => 50000,
            'deskripsi' => 'Bagus banget cog',
            'sesi' => 8,
            'target' => 'Yang jago main futsal',
           ]);
    }
}
