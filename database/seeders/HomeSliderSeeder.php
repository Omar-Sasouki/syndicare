<?php

namespace Database\Seeders;

use App\Models\HomeSlide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HomeSlide::create([
            'title' => 'I will give you Best Product in the shortest time.ss',
            'short_title' => 'Syndiccore Syndiccore Syndiccore',
            'video_url' => 'superadmin',
        ]);
    }
}
