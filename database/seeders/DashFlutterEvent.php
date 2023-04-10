<?php

namespace Database\Seeders;

use App\Models\DashFlutter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DashFlutterEvent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DashFlutter::create([
            'event' => 'event numero 1',
            'event_title' => 'event numero 1 ',
            
        ]);

        DashFlutter::create([
            'event' => 'event numero 2',
            'event_title' => 'event numero 2 ',
            
        ]);

        DashFlutter::create([
            'event' => 'event numero 3',
            'event_title' => 'event numero 3 ',
            
        ]);
    }
}
