<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;
use App\Models\Tutor;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ClassesSeeder extends Seeder
{
    public function run()
    {
        $classes = [
            'K-Pop Hit Dance Cover',
            'Idol Groove Choreography',
            'Popular Dance Tutorial',
            'Star Dance Practice',
            'Urban K-Pop Dance Cover',
            'K-Wave Dance Workshop',
            'Trend Dance Class',
            'Energetic Dance Cover',
            'Pop Star Dance Tutorial',
            'Hot Dance Choreography',
            'Viral Dance Workshop',
            'Modern K-Pop Dance Practice',
            'Signature Dance Cover',
            'Hype Dance Tutorial',
            'Performance Dance Choreography'
        ];

        $levels = ['Beginner', 'Intermediate', 'Advanced'];

        $tutors = Tutor::all();

        foreach ($classes as $class) {
            Classes::create([
                'uuid' => Str::uuid(),
                'name' => $class,
                'start_at' => Carbon::now()->addDays(rand(1, 30))->setTime(rand(9, 20), 0),
                'quota' => rand(10, 30),
                'tutor_id' => $tutors->random()->uuid,
                'description' => $levels[array_rand($levels)] . ' level K-pop dance cover class',
                'duration' => rand(60, 120),
                'price' => rand(75000, 200000),
                'image_url' => 'https://source.unsplash.com/1600x900/?class'
            ]);
        }
    }
}
