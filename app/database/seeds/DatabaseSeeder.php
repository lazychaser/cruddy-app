<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

		$this->call('UsersTableSeeder');
		$this->call('CategoriesTableSeeder');
		$this->call('ProductsTableSeeder');
		$this->call('ParameterSeeder');
		$this->call('ProductParameterSeeder');

		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}