<?php

namespace Database\Seeders;

use App\Models\Appartement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Appartement::create(['number' => 1, 'residence_id'=>1 ]);
        Appartement::create(['number' => 2, 'residence_id'=>1 ]);
        Appartement::create(['number' => 3, 'residence_id'=>2 ]);
        Appartement::create(['number' => 4, 'residence_id'=>2 ]);
       

    }
}
