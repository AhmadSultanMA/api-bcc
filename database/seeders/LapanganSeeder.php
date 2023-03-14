<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lapangan;

class LapanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lapangan::create([
            'idKategori' => 1,
            'idKota' => 1,
            'idOwner' => 2,
            'namaLapangan' => 'Futsal Lapangan',
            'lokasi' => 'Sigura-gura',
            'deskripsi' => 'lorem ipsum dolor sit amet',
            'harga' => 50000,
            'gambar' => 'https://res.cloudinary.com/dfkoknpii/image/upload/v1646532385/lastproject/account_jzb2mv.png',
            'jamBuka' => 7,
            'jamTutup' => 17,
            'statusToko' => 1,
            'nomor' => '08128441412',
        ]);

        Lapangan::create([
            'idKategori' => 1,
            'idKota' => 1,
            'idOwner' => 2,
            'namaLapangan' => 'Futsal Lapangan 2',
            'lokasi' => 'Rampal',
            'deskripsi' => 'lorem ipsum dolor sit amet',
            'harga' => 55000,
            'gambar' => 'https://res.cloudinary.com/dfkoknpii/image/upload/v1646532385/lastproject/account_jzb2mv.png',
            'jamBuka' => 6,
            'jamTutup' => 15,
            'statusToko' => 1,
            'nomor' => '0812816412',
        ]);

        Lapangan::create([
            'idKategori' => 2,
            'idKota' => 1,
            'idOwner' => 2,
            'namaLapangan' => 'Badminton Lapangan',
            'lokasi' => 'Soekarno Hatta',
            'deskripsi' => 'lorem ipsum dolor sit amet',
            'harga' => 55000,
            'gambar' => 'https://res.cloudinary.com/dfkoknpii/image/upload/v1646532385/lastproject/account_jzb2mv.png',
            'jamBuka' => 6,
            'jamTutup' => 15,
            'statusToko' => 1,
            'nomor' => '081281231412',
            ]);
    }
}
