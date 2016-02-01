<?php namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Tag;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use DB;

use Illuminate\Http\Request;

class AdminTagsController extends Controller {
    
	private $tagModel;
	
	public function __construct(Tag $tagModel)
	{
		 $this->tagModel = $tagModel;
	}
	
    public function create($id)
	{
		$product = $this->productModel->find($id);
		dd($product);
		return view('tags.create', compact('product'));
	}
	
	//Adicionar os dados ao CategoryModel
	public function store(Requests\tagRequest $request)
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

	 
	 return redirect()->route('tags');

	}		

	public function destroy($id)
	{

		$this->tagModel->find($id)->delete();

		return redirect()->route('tags');
	}
}
