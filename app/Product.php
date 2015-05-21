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
	   public function tags()
	{
		    return $this->belongsToMany('CodeCommerce\Tag');
	}		
	 public function getTagListAttribute()
	{
		   return $this->tags->lists('name');
			
			return implode (',', $tags);
	}	
	public function getNameDescriptionAttribute()
	{
		return $this->name." - ".$this->description;
	}
		
	public function scopeFeatured($query)
	{
		    return $query->where('featured','=', 1);
	}		
	public function scopeRecommend($query)
	{
		    return $query->where('recommend','=', 1);
	}
     // função para especificar o escopo	
	public function scopeOfCategory($query, $type)
	{
		    return $query->where('category_id','=', $type);
	}
}
