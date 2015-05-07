<?php namespace CodeCommerce\Http\Controllers;

 use CodeCommerce\Category;
 
class WelcomeController extends Controller {

  

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
	private $categories;
	
	public function __construct(Category $category)
	{
		$this->middleware('guest');
		$this->categories = $category;
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');
	}
           public function exemplo()
		   {
			   $categories = $this->categories->all();
			 
			   return view('exemplo', compact('categories'));
		   }
}
