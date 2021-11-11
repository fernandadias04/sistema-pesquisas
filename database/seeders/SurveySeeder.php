<?php

namespace Database\Seeders;

use App\Models\Survey;
use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Generator $faker */
        $faker = resolve(Generator::class);

        foreach (range(0, 100) as $i) {
            Survey::create([
                'name' => $faker->sentence()." ($i)",
                'user_id' => User::first()->id,
            ]);
        }
    }
}
