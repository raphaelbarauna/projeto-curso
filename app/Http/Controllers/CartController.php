<?php namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Product;
use CodeCommerce\Cart;
use CodeCommerce\Http\Requests;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Collection;

 class CartController extends Controller {

     public function __construct(Cart $cart)
     {
         $this->cart = $cart;
     }

	public function index()
	{
        // colocando o objeto cart dentro de uma sessao
		if(!Session::has('cart')){

            Session::set('cart', $this->cart);
        }

        $k = null;

        return view('store.cart', ['cart' => Session::get('cart'),'k']);
	}
     // funcção para adicionar ao carrinho
     public function add($id)
     {
         //Verificar se existe um carrinho na sessao
         $cart = $this->getCart();
         // importando o produto
         $product = Product::find($id);
         // adicionando o produto ao carrinho
         $cart->add($id, $product->name, $product->price);

         Session::set('cart', $cart);

         return redirect()->route('cart');
    }

    public function  reduce($id)
    {
        $cart = $this->getCart();

        $product = Product::find($id);

        $cart->reduce($id);

        Session::set('cart', $cart);

        return redirect()->route('cart');
    }

    public function destroy($id)
      {
         $cart = $this->getCart();

         $cart->remove($id);

          Session::set('cart', $cart);

          return redirect()->route('cart');
      }


     /**
       * @return Cart
      */
     public function getCart()
     {
         if (Session::has('cart')) {
             $cart = Session::get('cart');
             return $cart;
         } else {
             $cart = $this->GetCart();
             return $cart;
         }
     }


 }
