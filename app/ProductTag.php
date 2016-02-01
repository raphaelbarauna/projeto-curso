<?php namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model {

	protected $primaryKey = 'tag_id';
	
    protected $fillable = [
        'product_id',
        'tag_id'
	];	  

	protected $table      = 'product_tag';

	public $timestamps  = false;

	public function product()
	{
		return $this->belongsTo('CodeCommerce\Product');
	}

}
