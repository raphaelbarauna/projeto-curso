<?php namespace CodeCommerce;


class Cart  {
     
	 private $items;
	 //metodo para inializar array de itens
   	public function __construct()
	{
		$this->items = [ ];
	}
	
    public function add($id, $name, $price)
	{
		$this->items += [
		    $id => [
			     //verificar a quantidade e somar se n tiver so adicionar 1
			    'qtd' => isset($this->items[$id]['qtd']) ? $this->items[$id]['qtd']++ : 1,
				'price' => $price,
				'name' => $name
			]
		];
        return $this->items;
	}	
	public function remove($id)
	{
		unset($this->items[$id]);	
	}
	public function all()
	{
		return $this->items;
	}
	public function getTotal()
	{
		$total = 0;
		foreach($this->items as $items){
		    $total += $items['qtd'] * $items['price'];
		}	
		return $total;
	}
}
