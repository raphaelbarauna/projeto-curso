<?php namespace CodeCommerce\Http\Controllers;

 use CodeCommerce\Product;
 
class AdminProductsController extends Controller {

  

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	private $products;
	
	public function __construct(Product $product)
	{
		$this->middleware('guest');
		$this->products = $product;
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view ('welcome');
	}
	 public function produto()
		   {
			   $products = $this->products->all();
			 
			   return view('produto', compact('products'));
		   }
	}
         

