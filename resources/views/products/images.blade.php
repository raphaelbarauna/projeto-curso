@extends('app')
@section('content')
<div class="container">
<h1>Imagens de {{ $product->name }}</h1>

<a href="{{ route ('products.images.create', $product->id)}}" class="btn btn-default">Nova Imagem</a>
<br>
<br>
<table class="table">
<tr>
   <th>ID</th>
   <th>Image</th>
   <th>Extension</th>
   <th>Action</th>
</tr>
  
    @foreach($product->images as $image)
        <tr>
            <td>{{$image->id}}</td>
            <td>
			    <img src="{{url('uploads/'.$image->id.'.'.$image->extension) }}" width="80">
			</td>
            <td>{{$image->extension}}</td>      
            <td>
    <a href="{{ route('products.images.destroy', ['id'=>$image->id]) }}">
           Delete
    </a>
            </td>


        </tr>
  
    @endforeach

        </table>
 <a href="{{ route('products', $product->id)}}" class="btn btn-default">Voltar</a>
    </div>

@endsection
