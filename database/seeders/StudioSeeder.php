<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Studio;
use Illuminate\Support\Str;

class StudioSeeder extends Seeder
{
    public function run()
    {
        $studios = [
            ['name' => 'Dance City Studio', 'price' => 150000],
            ['name' => 'Rhythm Nation Academy', 'price' => 200000],
            ['name' => 'Motion Dance Center', 'price' => 175000],
            ['name' => 'Groove Studio', 'price' => 160000],
            ['name' => 'Step Up Dance Room', 'price' => 180000],
        ];

        $cities = ['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Bali'];

        foreach ($studios as $studio) {
            Studio::create([
                'id' => Str::uuid(),
                'name' => $studio['name'],
                'location' => $cities[array_rand($cities)],
                'image_url' => 'https://source.unsplash.com/1600x900/?studio',
                'price' => $studio['price'],
                'owner' => 'PT. Dance Connect Indonesia',
                'description' => 'Studio tari modern dilengkapi dengan cermin, sistem suara, dan pendingin ruangan, sempurna untuk latihan tari K-pop.'
            ]);
        }
    }
}
