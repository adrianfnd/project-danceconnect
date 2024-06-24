<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tutor;
use Illuminate\Support\Str;

class TutorSeeder extends Seeder
{
    public function run()
    {
        $tutors = [
            'Ayu Lestari',
            'Budi Santoso',
            'Citra Dewi',
            'Doni Pratama',
            'Eka Putri',
            'Fajar Hidayat',
            'Gita Ananda',
            'Hendra Wijaya',
            'Indah Wulandari',
            'Joko Saputra'
        ];

        foreach ($tutors as $tutor) {
            Tutor::create([
                'uuid' => Str::uuid(),
                'name' => $tutor,
                'bio' => "Instruktur tari berpengalaman di Indonesia yang mengkhususkan diri dalam koreografi modern dan pertunjukan gaya idol.",
                'image_url' => 'https://source.unsplash.com/1600x900/?tutor'
            ]);
        }
    }
}
