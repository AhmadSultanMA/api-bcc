<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AlatSewaSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(KotaSeeder::class);
        $this->call(LapanganSeeder::class);
        $this->call(CariTemanSeeder::class);
        $this->call(AccTemanSeeder::class);
        $this->call(KursusSeeder::class);
    }
}
