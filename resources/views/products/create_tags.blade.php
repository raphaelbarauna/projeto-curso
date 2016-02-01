@extends('app')

@section('content')
    
	<div class="container">
         <h1>Create Tag</h1>
          	
			@if ($errors->any())
				<ul class="alert">
               @foreach($errors->all() as $error)
			   <li>{{ $error }}</li>
       		   @endforeach
				</ul>				
			@endif

		  {!! Form::open(['route'=>['products.tags.store', $product->id] ,'method'=>'post' ]) !!}
		   
		   <div class="form-group">
		   {!! Form::label('name', 'Name :') !!}
		   {!! Form::textarea('name', null, ['class'=>'form-control','placeholder'=>'Separe as tags por virgula..']) !!}
		   </div>

		  <div class="form-group">
		   {!! Form::submit('Add Tag', ['class'=>'btn btn-primary form-control']) !!}
		  </div>
		  {!! Form::close() !!}
		</div> 
	
@endsection
