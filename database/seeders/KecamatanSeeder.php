<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Ambunten',
            'Arjasa',
            'Batang Batang',
            'Batuan',
            'Batuputih',
            'Bluto',
            'Dasuk',
            'Dungkek',
            'Ganding',
            'Gapura',
            'Gayam',
            'Giligenting',
            'Guluk-Guluk',
            'Kalianget',
            'Kangayan',
            'Kota Sumenep',
            'Lenteng',
            'Manding',
            'Masalembu',
            'Nonggunong',
            'Pasongsongan',
            'Pragaan',
            'Raas',
            'Rubaru',
            'Sapeken',
            'Saronggi',
            'Talango',
        ];

        foreach ($data as $nama) {
            DB::table('kecamatans')->insert([
                'nama_kecamatan' => $nama,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}