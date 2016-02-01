<?php namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Product;
use CodeCommerce\ProductImage;

use CodeCommerce\ProductTag;
use CodeCommerce\Tag;


use CodeCommerce\Http\Requests\ProuctImageRequest;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;


use DB;



use Guzzle\Tests\Common\Cache\NullCacheAdapterTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;



class AdminProductsController extends Controller {
    
	private $productModel;
	

	public function __construct(Product $productModel, ProductTag $productTagModel)
	{
        $this->productModel = $productModel;
        $this->productTagModel = $productTagModel;
	}
	
	public function index()
	{
		$products = $this->productModel->paginate(10);
		return view('products.index', compact('products'));
		

	}
	
    public function create(Category $category)
	{
        $categories = $category->lists('name', 'id');
        
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

            $image = ProductImage::where('product_id','=',$id);

            if($image->count()){

                foreach($image->get() as $valor) {

                        if (file_exists(public_path() . '/uploads/' . $valor['id'] . '.' . $valor['extension']))
                        {
                            Storage::disk('public_local')->delete($valor['id'] . '.' . $valor['extension']);

                        ProductImage::where('id', '=', $valor['id'])->delete();

                    }
                }
            }


            Product::find($id)->delete();

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


    public function storeImage(Requests\ProductImageRequest $request, $id, ProductImage $productImage)
		{

            $file = $request->file('image');
			
			$extension = $file->getClientOriginalExtension();
			//cria imagem no banco de dados
			$image = $productImage::create(['product_id'=>$id, 'extension'=>$extension]);
			//informa o local da imagem
			Storage::disk('public_local')->put($image->id.'.'.$extension, File::get($file));
			
			return redirect()->route('products.images', ['id'=>$id]);
		}

    public function destroyImage(ProductImage $productImage, $id)
    {
        $image = $productImage->find($id);

        if(file_exists(public_path() .'/uploads/'.$image->id.'.'.$image->extension)) {

            Storage::disk('public_local')->delete($image->id . '.' . $image->extension);
        }

        $product = $image->product;

        $image->delete();


        return redirect()->route('products.images', ['id'=>$product->id]);

    }

    public function tags($id)
	{
			$tags = \DB::select('SELECT p.tag_id,t.name FROM PRODUCT_TAG as p INNER JOIN tags as t ON (t.id = p.tag_id) WHERE p.product_id = ?',[$id]);
			
			$product = $this->productModel->find($id);

			return view('products.tags', compact('tags','product'));
	}
    public function createTag($id)
	{
		$product = $this->productModel->find($id);
		
		return view('products.create_tags', compact('product'));
	}
	public function storeTag(Requests\tagRequest $request,$id , ProductTag $productTag)
	{

	 	$input = $request->all(); // recebendo todos os dados da request
	 
	 	$result = explode(',', $input['name']);
	 	
	 		for($i=0; $i < count($result);$i++)
	 		{
 		
	 			if(!DB::table('tags')->where('name', '=' ,$result[$i])->get())
	 			{

				$tag = new Tag();    //passar os dados preenchidos
	 			
	 			$tag->name = $result[$i];

	 			$tag->save(); // salvar os dados no banco.
	 			
				}
			}

			for($i=0; $i < count($result);$i++)
	 		{
	 			$consulta[] = DB::table('tags')->where('name', '=' ,$result[$i])->get();
	 		}
 			
 			for($i=0; $i < count($consulta);$i++)
	 		{
	 			$productTag::create(['product_id'=>$id, 'tag_id'=>$consulta[$i]['0']->id]);	
	 		}
								 
	 return redirect()->route('products');

	}		

	public function destroyTag($id)
	{

		$this->productTagModel->find($id)->delete();
	
		return redirect()->route('products');
	}

	}
	
  

