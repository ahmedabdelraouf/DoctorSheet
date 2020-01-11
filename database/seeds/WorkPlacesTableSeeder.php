<?php

use Illuminate\Database\Seeder;
use App\Models\WorkPlace;

class WorkPlacesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        WorkPlace::truncate();
        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            WorkPlace::create([
                'name' => $faker->company,
            ]);
        }
    }

}
