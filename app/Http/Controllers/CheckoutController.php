<?php namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;


use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use CodeCommerce\User;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller {


    public function place(Order $orderModel, OrderItem $orderItem)
    {
        if(!Session::has('cart')){
            return false;
        }

        $cart = Session::get('cart');

        if($cart->getTotal()> 0){
            //Criar a Ordem
           $order = $orderModel->create(['user_id' => 1, 'total' => $cart->getTotal()]);

           foreach($cart->all() as $k => $item) {
            //adicionar todos os itens na ordem
            $order->items()->create(['product_id' => $k, 'price' => $item['price'], 'qtd' => $item['qtd']]);
           }

            dd($order);
        }

    }

}
