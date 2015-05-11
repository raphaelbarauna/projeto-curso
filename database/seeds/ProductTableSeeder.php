<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\Product;
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder {

	
	public function run()
	{
		Model::unguard();
       DB::table('products')->truncate();
	   
	   $faker = Faker::create();
	   
	   foreach(range(1,10) as $i)
		// $this->call('UserTableSeeder');
		$this->call('ProductTableSeeder');
		 Product::create([
		  'name' => $faker->name(),
		  'price' => $faker->randomNumber(),
		  'description' => $faker->sentence()
		 ])
	}

}
