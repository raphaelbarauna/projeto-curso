@extends('app')

@section('content')
    
	<div class="container">
         <h1>Editing Product: {{ $product->name}}</h1>
          	
			@if ($errors->any())
				<ul class="alert">
               @foreach($errors->all() as $error)
			   <li>{{ $error }}</li>
       		   @endforeach
				</ul>
				
			@endif
			
		  {!! Form::open(['route'=>['products.update', $product->id], 'method'=>'put']) !!}
		   	
		   <div class="form-group">
    		 {!! Form::label('category', 'Category:') !!}
    		 {!! Form::select('category_id', $categories, $product->category->id, ['class'=>'form-control']) !!}
    	  </div>
			
    	   			
		   <div class="form-group">
		   {!! Form::label('name', 'Name:') !!}
		   {!! Form::text('name', $product->name, ['class'=>'form-control']) !!}
		   </div>
		   
		    <div class="form-group">
		   {!! Form::label('price', 'Price:') !!}
		   {!! Form::text('price', $product->price, ['class'=>'form-control']) !!}
		   </div>	      
		  
		  <div class="form-group">
    		{!! Form::label('Featured ?') !!}
			{!! Form::radio('featured', 1 ,['class' => 'form-control']) !!} Yes
            {!! Form::radio('featured', 0 , ['class' => 'form-control']) !!} No
              
		   </div>
		  
		   <div class="form-group">
    		{!! Form::label('Recommend ?') !!}
			{!! Form::radio('recommend', $product->recommend, ['class' => 'form-control']) !!} Yes
            {!! Form::radio('recommend', $product->recommend, ['class' => 'form-control']) !!} No
		  </div>
		  
		  <div class="form-group">
		   {!! Form::label('description', 'Description:') !!}
		   {!! Form::textarea('description', $product->description, ['class'=>'form-control']) !!}
		  </div>
          
		  <div class="form-group">
		   {!! Form::submit('Salvar Category', ['class'=>'btn btn-primary form-control']) !!}
		  </div>
		  
		  {!! Form::close() !!}
		</div> 
	
@endsection
