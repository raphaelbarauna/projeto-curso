<?php namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model {

    protected $fillable = [
        'product_id',
	    'tag_id'
	];	  
		
	public function product()
	{
		return $this->belongsTo('CodeCommerce\Product');
	}

}
