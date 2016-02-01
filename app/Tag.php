<?php namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

<<<<<<< HEAD
	protected $fillable = [	'name' ];

	public function produts()
	{
		return $this->belongsToMany('CodeCommerce\Product');
	}
=======
	//
>>>>>>> 7850dfbae568228e3284e1c63ea44cf339998bb0

}
