<?php namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $fillable = [
	'category_id',
	'name',
	'price',
	'description',
	'featured',
	'recommend'
	
		];
		
		public function images()
	{
		return $this->hasMany('CodeCommerce\ProductImage');
	}
		
      public function category()
	  {
		  return $this->belongsTo('CodeCommerce\Category');
	  }
}
