<?php

namespace Database\Seeders;

use App\Models\TypeReclamation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeReclamationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeReclamation::create(['name' => 'STEG']);
        TypeReclamation::create(['name' => 'SONED']);
        TypeReclamation::create(['name' => 'TELECOME']);
    }
}
