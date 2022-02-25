<?php

namespace Database\Seeders;

use App\Models\Cinema;
use App\Models\Film;
use Illuminate\Database\Seeder;

class CinemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cinemas = Cinema::factory()->count(10)->create();
        foreach ($cinemas as $cinema) {
            $films = Film::query()->inRandomOrder()->take(3)->pluck('id');
            $cinema->films()->sync($films);
        }
    }
}
