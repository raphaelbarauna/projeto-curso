<?php namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {


	protected $fillable = [	'name' ];

	public function produts()
	{
		return $this->belongsToMany('CodeCommerce\Product');
	}


}
