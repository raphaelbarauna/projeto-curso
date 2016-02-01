<?php namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'user_id',
        'total',
        'status'

];

   //acessando todos os itens referente a ordem
	public function items()
    {
        return $this->hasMany('CodeCommerce\OrderItem');
    }
    public function users()
    {
        return $this->belongsTo('CodeCommerce\User');
    }
}
