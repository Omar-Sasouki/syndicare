<?php

namespace Database\Seeders;

use App\Models\ChampPub;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChamPub extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChampPub::create([
            
            'pub_photo' => '',
            
        ]);
    }
}
