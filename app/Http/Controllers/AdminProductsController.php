<?php namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Product;
use CodeCommerce\Http\Requests;
use CodeCommerce\ProductImage;
use CodeCommerce\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminProductsController extends Controller {
    
	private $productModel;
	
	public function __construct(Product $productModel)
	{
		 $this->productModel = $productModel;
	}
	
	public function index()
	{
		$products = $this->productModel->paginate(10);
		return view('products.index', compact('products'));
		
	}
	
    public function create(Category $category)
	{
		$categories = $category->lists('name','id');
		return view('products.create', compact('categories'));
		
	}
	
	    public function store(Requests\ProductRequest $request)
	    {
	 $input = $request->all();
	 
	 $product = $this->productModel->fill($input);
	 
	 $product->save();
	 
	    return redirect()->route('products');
	    }	
		// Funçao para editr categoria
		
		public function edit($id, Category $category)
		{
            $categories = $category->lists('name','id');
		    $product = $this->productModel->find($id);
            return view('products.edit', compact('product', 'categories'));
		}
		// Função para dar update no banco
		public function update(Requests\ProductRequest $request, $id)
		{
			$this->productModel->find($id)->update($request->all());
		    return redirect()->route('products');
		}
		// Função para excluir categoria
		public function destroy($id)
		{
			$this->productModel->find($id)->delete();
			return redirect()->route('products');
		}
		// Função para receber as imagens
		public function images($id)
		{
			$product = $this->productModel->find($id);
			
			return view('products.images', compact('product'));
		}
		// Função para fazer upload da imagem
		public function createImage($id)
		{
			$product = $this->productModel->find($id);
			
			return view('products.create_images', compact('product'));
		}


    public function storeImage(Request $request, $id, ProductImage $productImage)
		{
			$file = $request->file('image');
			$extension = $file->getClientOrinalExtension();
			//cria imagem no banco de dados
			$image = $productImage::create(['product_id'=>$id, 'extension'=>$extension]);
			//informa o local da imagem
			Storage::disk('public_local')->put($image->id.'.'.$extension, File::get($file));
			
			return redirect()->route('products.images', ['id'=>$id]);
		}
}

