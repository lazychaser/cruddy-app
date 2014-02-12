<?php

class ParameterSeeder extends Seeder {

    public function run()
    {
        Parameter::truncate();

        $faker = Faker\Factory::create();

        foreach (range(1, 30) as $index)
        {
            Parameter::create(
            [
                'name' => $faker->sentence(3),
            ]);
        }
    }
}