@extends('app')

@section('content')
    
	<div class="container">
         <h1>Editing Tag: {{ $tag->name}}</h1>
          	
			@if ($errors->any())
				<ul class="alert">
               @foreach($errors->all() as $error)
			   <li>{{ $error }}</li>
       		   @endforeach
				</ul>
				
			@endif
			
		  {!! Form::open(['route'=>['tags.update', $tag->id], 'method'=>'put']) !!}
		   	    	   			
		   <div class="form-group">
		   {!! Form::label('name', 'Name:') !!}
		   {!! Form::text('name', $tag->name, ['class'=>'form-control']) !!}
		   </div>

		  <div class="form-group">
		   {!! Form::submit('Salvar Category', ['class'=>'btn btn-primary form-control']) !!}
		  </div>
		  
		  {!! Form::close() !!}
		</div> 
	
@endsection
