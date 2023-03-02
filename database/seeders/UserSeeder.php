<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('adminbolehlogin'),
            'gambar' => 'https://res.cloudinary.com/dfkoknpii/image/upload/v1646532385/lastproject/account_jzb2mv.png',
            'statusPartner' => 0,
        ]);
        $admin->assignRole('admin');

        $penjual = User::create([
            'name' => 'penjual',
            'email' => 'penjual@gmail.com',
            'password' => bcrypt('penjualbolehlogin'),
            'gambar' => 'https://res.cloudinary.com/dfkoknpii/image/upload/v1646532385/lastproject/account_jzb2mv.png',
            'statusPartner' => 0,
        ]);
        $penjual->assignRole('penjual');
    }
}
