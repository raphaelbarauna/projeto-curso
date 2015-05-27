@extends('app')

@section('content')
    
	<div class="container">
         <h1>Upload de Imagem</h1>
          	
			@if ($errors->any())
				<ul class="alert">
               @foreach($errors->all() as $error)
			   <li>{{ $error }}</li>
       		   @endforeach
				</ul>
				
			@endif
			
		{!! Form::open(['route'=>[ 'products.images.store', $product->id ], 'method'=>'post', 'enctype'=>"multipart/form-data"]) !!}
		   
		<div class="form-group">
		   {!! Form::label('image', 'Imagem :') !!}
		   {!! Form::file('image', null, ['class'=>'form-control']) !!}
		</div>
		          
		<div class="form-group">
	        {!! Form::submit('Upload', ['class'=>'btn btn-primary']) !!}
		  
		  <a href = "{{route('products', $product->id)}}"></a>
		   
		</div>
		{!! Form::close() !!}
		</div> 
	
@endsection
