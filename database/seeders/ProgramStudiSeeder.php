<?php

namespace Database\Seeders;

use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;

class ProgramStudiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama'     => 'Teknik Informatika',
                'jenjang'  => 'S1',
                'fakultas' => 'Fakultas Teknik',
            ],
            [
                'nama'     => 'Sistem Informasi',
                'jenjang'  => 'S1',
                'fakultas' => 'Fakultas Teknik',
            ],
            [
                'nama'     => 'Manajemen Informatika',
                'jenjang'  => 'D3',
                'fakultas' => 'Fakultas Teknik',
            ],
            [
                'nama'     => 'Pendidikan Guru Sekolah Dasar',
                'jenjang'  => 'S1',
                'fakultas' => 'Fakultas Keguruan dan Ilmu Pendidikan',
            ],
            [
                'nama'     => 'Manajemen',
                'jenjang'  => 'S1',
                'fakultas' => 'Fakultas Ekonomi dan Bisnis',
            ],
        ];

        foreach ($data as $item) {
            ProgramStudi::create($item);
        }
    }
}
