<?php

class ProductParameterSeeder extends Seeder {

    public function run()
    {
        ProductParameter::truncate();

        $faker = Faker\Factory::create();

        $parameters = Parameter::lists('id');
        $products = Product::lists('id');

        foreach (range(1, 30) as $index)
        {
            ProductParameter::create(
            [
                'parameter_id' => $faker->randomElement($parameters),
                'product_id' => $faker->randomElement($products),
                'value' => $faker->sentence(3),
                'order' => $faker->randomNumber(0, 10),
            ]);
        }
    }
}