<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TryoutProgram;

class TryoutProgramSeeder extends Seeder
{
    public function run(): void
    {
        TryoutProgram::insert([
            [
                'code' => 'BIDAN',
                'name' => 'Tryout Bidan',
                'category' => 'Kesehatan',
                'participants' => '6,800+',
                'image' => 'assets/tryout/Banner TO Bidan.png',
                'description' => 'Simulasi soal UKOM kebidanan sesuai kompetensi: kehamilan, persalinan, nifas, neonatus, KB, dan gawat darurat maternal-neonatal.',
            ],
            [
                'code' => 'PERAWAT',
                'name' => 'Tryout Perawat',
                'category' => 'Kesehatan',
                'participants' => '9,200+',
                'image' => 'assets/tryout/Banner TO Prwt.png',
                'description' => 'Latihan soal UKOM keperawatan: medikal-bedah, gawat darurat, maternitas, anak, komunitas, dan manajemen keperawatan.',
            ],
        ]);
    }
}
