<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BimbelProgram;

class BimbelProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'code' => 'UKOM_BIDAN',
                'name' => 'Bimbel Persiapan UKOM Bidan',
                'category' => 'Kesehatan',
                'participants' => '6,800+',
                'image' => 'assets/major/Bidan.png',
                'description' => 'Program intensif persiapan Uji Kompetensi Bidan dengan materi lengkap, latihan soal, dan simulasi berbasis SKL terbaru.'
            ],
            [
                'code' => 'UKOM_PERAWAT',
                'name' => 'Bimbel Persiapan UKOM Perawat',
                'category' => 'Kesehatan',
                'participants' => '9,200+',
                'image' => 'assets/major/Perawat.png',
                'description' => 'Kelas persiapan Uji Kompetensi Perawat dengan pendalaman materi, bank soal UKOM, serta tryout untuk meningkatkan kelulusan.'
            ],
        ];

        foreach ($programs as $program) {
            BimbelProgram::create($program);
        }
    }
}
