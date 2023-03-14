<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AccTeman;


class AccTemanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccTeman::create([
            'idCariTeman' => 1,
            'idTeman' => 4,
            'idOwner' => 5,
            'status' => 0
        ]);

        AccTeman::create([
            'idCariTeman' => 2,
            'idTeman' => 5,
            'idOwner' => 4,
            'status' => 1
        ]);
    }
}
