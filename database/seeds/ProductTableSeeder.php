<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\Product;
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder 
{
	
	public function run()
	{		
       DB::table('products')->delete();
	   
	   $faker = Faker::create();
	   
	    foreach(range(1,40) as $i){			
		Product::create([
		'name' => $faker->word(),
		'price' => $faker->randomNumber(2),
		'description' => $faker->sentence(),
		'featured' => $faker->numberBetween($min = 1, $max = 2),
		'recommend' =>$faker->numberBetween($min = 1, $max = 2),
		'category_id' => $faker->numberBetween(1,15)
		 ]);
	   }
	}

}
