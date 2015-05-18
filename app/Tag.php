<?php namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	protected $fillable = [ 'name' ];

	
	public function product()
	{
		return $this->belongsTo('CodeCommerce\Product');
	}
	
}
