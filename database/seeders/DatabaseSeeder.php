<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RoleSeeder::class);
        $this->call(ResidenceSeeder::class);
        $this->call(ApartementSeeder::class);
        $this->call(HomeSliderSeeder::class);
        $this->call(TypeReclamationSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(DashFlutterEvent::class);
        $this->call(ChamPub::class);




        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
