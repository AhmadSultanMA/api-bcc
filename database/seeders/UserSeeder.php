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
            'nomor' => '6281210011825',
            'jenisKelamin' => 1,
            'umur' => 17,
            'pekerjaan' => 'Rahasia',
        ]);
        $admin->assignRole('admin');

        $penjual = User::create([
            'name' => 'penjual',
            'email' => 'penjual@gmail.com',
            'password' => bcrypt('penjualbolehlogin'),
            'gambar' => 'https://res.cloudinary.com/dfkoknpii/image/upload/v1646532385/lastproject/account_jzb2mv.png',
            'nomor' => '6281210011827',
            'jenisKelamin' => 1,
            'umur' => 17,
            'pekerjaan' => 'Rahasia',
        ]);
        $penjual->assignRole('penjual');

        $pelatih = User::create([
            'name' => 'pelatih',
            'email' => 'pelatih@gmail.com',
            'password' => bcrypt('pelatihbolehlogin'),
            'gambar' => 'https://res.cloudinary.com/dfkoknpii/image/upload/v1646532385/lastproject/account_jzb2mv.png',
            'nomor' => '6281210011824',
            'jenisKelamin' => 1,
            'umur' => 17,
            'pekerjaan' => 'Rahasia',
        ]);
        $pelatih->assignRole('pelatih');

        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('userbolehlogin'),
            'gambar' => 'https://res.cloudinary.com/dfkoknpii/image/upload/v1646532385/lastproject/account_jzb2mv.png',
            'nomor' => '6281210011754',
            'jenisKelamin' => 1,
            'umur' => 17,
            'pekerjaan' => 'Mahasiswa',
        ]);
        $user->assignRole('user');

        $user1 = User::create([
            'name' => 'user1',
            'email' => 'ahmadsultan12345@gmail.com',
            'password' => bcrypt('user1bolehlogin'),
            'gambar' => 'https://res.cloudinary.com/dfkoknpii/image/upload/v1646532385/lastproject/account_jzb2mv.png',
            'nomor' => '6281211111754',
            'jenisKelamin' => 1,
            'umur' => 17,
            'pekerjaan' => 'Mahasiswa',
        ]);
        $user1->assignRole('user');
        // d
    }
}
