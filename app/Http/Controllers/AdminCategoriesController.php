<?php namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminCategoriesController extends Controller {
    
	private $categoryModel;
	
	public function __construct(Category $categoryModel)
	{
		 $this->categoryModel = $categoryModel;
	}
	
	public function index()
	{
		$categories = $this->categoryModel->paginate(10);
		return view('categories.index', compact('categories'));
		
	}
	
    public function create()
	{
		return view('categories.create');
	}
	
	//Adicionar os dados ao CategoryModel
	public function store(Requests\CategoryRequest $request)
	{
	 $input = $request->all(); // recebendo todos os dados da request
	 
	 $category = $this->categoryModel->fill($input);  //passar os dados preenchidos
	 
	 $category->save(); // salvar os dados no banco.
	 
	 return redirect()->route('categories');
	 }	
		
		public function edit($id)
		{
		 $category = $this->categoryModel->find($id);
          return view('categories.edit', compact('category'));		 
		}
		
		public function update(Requests\CategoryRequest $request, $id)
		{
			$this->categoryModel->find($id)->update($request->all());
		    return redirect()->route('categories');
		}
		
		public function destroy($id)
		{
			$this->categoryModel->find($id)->delete();
			return redirect()->route('categories');
		}
}
