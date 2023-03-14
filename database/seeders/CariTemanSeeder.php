<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CariTeman;
use Carbon\Carbon;

class CariTemanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CariTeman::create([
            'idOwner' => 4,
            'idKota' => 1,
            'idKategori' => 1,
            'tanggalMain' => Carbon::create('2023','03','18'),
            'jam' => 7,
            'deskripsi' => 'Gas main dek'
        ]);
        
        CariTeman::create([
            'idOwner' => 5,
            'idKota' => 1,
            'idKategori' => 2,
            'tanggalMain' => Carbon::create('2023','03','17'),
            'jam' => 8,
            'deskripsi' => 'Gas main kak'
        ]);
    }
}
