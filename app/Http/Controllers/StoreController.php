<?php namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Tag;
use Illuminate\Http\Request;
use CodeCommerce\Category;
use CodeCommerce\Product;

class StoreController extends Controller {

        public function index()
		{
			$pFeatured = Product::featured()->get();
			$pRecommend = Product::recommend()->get();
			
			$categories = Category::all();
			
			return view('store.index', compact('categories', 'pFeatured', 'pRecommend'));
		}

        public function category($id)
		{
			
			$categories = Category::all();
			$category = Category::find($id);
			$products = Product::ofCategory($id)->get(); //pegar o produto da categoria com pelo id
			
			return view('store.category', compact('categories', 'products', 'category'));
		}		
		 //detalhes do produto
         public function product($id)
		{
			
			$categories = Category::all();

			$product = Product::find($id);

			//$productsWithTag = $this->showProductByTag($id);			
			return view('store.product', compact('categories', 'product'));
		}
		public function showProductByTag($id)
		{
    	$productsWithTag = Tag::find($id)->products()->get();
    	dd($productsWithTag);
		}
		public function tag($id)
    	{
        $categories = Category::all();
        
        $tag = Tag::find($id);

        $products = $tag->products;

        return view('store.tag' , compact('categories', 'products', 'tag'));
    	}
}
