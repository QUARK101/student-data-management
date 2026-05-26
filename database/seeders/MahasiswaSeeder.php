<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'program_studi_id' => 1,
                'nama'             => 'Ahmad Fauzi',
                'nim'              => '2301101001',
                'email'            => 'ahmad.fauzi@student.ac.id',
                'no_hp'            => '081234567890',
                'angkatan'         => 2023,
                'status'           => 'Aktif',
                'alamat'           => 'Jl. Mawar No. 1, Madiun',
            ],
            [
                'program_studi_id' => 1,
                'nama'             => 'Budi Santoso',
                'nim'              => '2301101002',
                'email'            => 'budi.santoso@student.ac.id',
                'no_hp'            => '081234567891',
                'angkatan'         => 2023,
                'status'           => 'Aktif',
                'alamat'           => 'Jl. Melati No. 5, Madiun',
            ],
            [
                'program_studi_id' => 2,
                'nama'             => 'Citra Dewi',
                'nim'              => '2302101001',
                'email'            => 'citra.dewi@student.ac.id',
                'no_hp'            => '081234567892',
                'angkatan'         => 2023,
                'status'           => 'Aktif',
                'alamat'           => 'Jl. Anggrek No. 3, Madiun',
            ],
            [
                'program_studi_id' => 2,
                'nama'             => 'Dian Pratiwi',
                'nim'              => '2202101001',
                'email'            => 'dian.pratiwi@student.ac.id',
                'no_hp'            => '081234567893',
                'angkatan'         => 2022,
                'status'           => 'Cuti',
                'alamat'           => 'Jl. Dahlia No. 7, Ngawi',
            ],
            [
                'program_studi_id' => 3,
                'nama'             => 'Eka Prasetyo',
                'nim'              => '2103101001',
                'email'            => 'eka.prasetyo@student.ac.id',
                'no_hp'            => '081234567894',
                'angkatan'         => 2021,
                'status'           => 'Lulus',
                'alamat'           => 'Jl. Kenanga No. 2, Ponorogo',
            ],
            [
                'program_studi_id' => 1,
                'nama'             => 'Fajar Nugroho',
                'nim'              => '2001101001',
                'email'            => 'fajar.nugroho@student.ac.id',
                'no_hp'            => '081234567895',
                'angkatan'         => 2020,
                'status'           => 'Lulus',
                'alamat'           => 'Jl. Flamboyan No. 9, Madiun',
            ],
            [
                'program_studi_id' => 4,
                'nama'             => 'Gilang Ramadhan',
                'nim'              => '2304101001',
                'email'            => 'gilang.ramadhan@student.ac.id',
                'no_hp'            => '081234567896',
                'angkatan'         => 2023,
                'status'           => 'Aktif',
                'alamat'           => 'Jl. Gambir No. 4, Madiun',
            ],
            [
                'program_studi_id' => 5,
                'nama'             => 'Hesti Rahayu',
                'nim'              => '2205101001',
                'email'            => 'hesti.rahayu@student.ac.id',
                'no_hp'            => '081234567897',
                'angkatan'         => 2022,
                'status'           => 'Aktif',
                'alamat'           => 'Jl. Bougenville No. 6, Ngawi',
            ],
            [
                'program_studi_id' => 3,
                'nama'             => 'Irfan Maulana',
                'nim'              => '2103101002',
                'email'            => 'irfan.maulana@student.ac.id',
                'no_hp'            => '081234567898',
                'angkatan'         => 2021,
                'status'           => 'Keluar',
                'alamat'           => 'Jl. Cempaka No. 8, Magetan',
            ],
            [
                'program_studi_id' => 1,
                'nama'             => 'Muhammad Hafidz Rifai',
                'nim'              => '2305101077',
                'email'            => 'hafidz.rifai@student.ac.id',
                'no_hp'            => '081234567899',
                'angkatan'         => 2023,
                'status'           => 'Aktif',
                'alamat'           => 'Jl. Wilis No. 10, Madiun',
            ],
        ];

        foreach ($data as $item) {
            Mahasiswa::create($item);
        }
    }
}
