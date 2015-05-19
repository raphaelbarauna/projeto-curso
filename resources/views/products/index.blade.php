@extends('app')
@section('content')
<div class="container">
<h1>Produtos</h1>


<a href="{{ route ('products.create')}}" class="btn btn-default">Novo Produto</a>
<br>
<br>
<table class="table">
<tr>
   <th>ID</th>
   <th>Name</th>
   <th>Description</th>
   <th>Price</th>
   <th>Category</th>
   <th>Featured</th>
   <th>Recommend</th>
   <th>Action</th>
</tr>
  
  @foreach($products as $product)
<tr>
   <td>{{$product->id}}</td>
   <td>{{$product->name}}</td>
   <td>{{$product->description}}</td>
   <td>{{$product->price}}</td>
   <td>{{$product->category->name}}</td>
   <td>{{($product->featured)?'Yes':'No'}}</td>
   <td>{{($product->recommend)?'Yes':'No'}}
   </td>
      
   <td> 
	 <a href="{{ route('products.destroy',['id'=>$product->id])}}">Deletar</a>
      |  
	<a href="{{ route('products.edit',['id'=>$product->id])}}">Editar</a>
	   |
	<a href="{{ route('products.images',['id'=>$product->id])}}">Imagem</a>   
	
   </td>
</tr>
  @endforeach

  </table>
  {!! $products->render() !!}
</div>


@endsection
