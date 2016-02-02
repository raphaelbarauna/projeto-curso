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
			{!! Form::radio('featured', 1 ,($product->featured)?true:false, ['class' => 'field']) !!} Yes
            {!! Form::radio('featured', 0 ,(!$product->featured)?true:false, ['class' => 'field']) !!} No
              
		   </div>
		  
		   <div class="form-group">
    		{!! Form::label('Recommend ?') !!}
			{!! Form::radio('recommend', 1,($product->recommend)?true:false, ['class' => 'field']) !!} Yes
            {!! Form::radio('recommend', 0,(!$product->recommend)?true:false, ['class' => 'field']) !!} No
		  </div>

		  <div class="form-group">
		   {!! Form::label('description', 'Description:') !!}
		   {!! Form::textarea('description', $product->description, ['class'=>'form-control']) !!}
		  </div>
		  <div class="form-group">
    		{!! Form::label('tags', 'Tags:') !!}
    		{!! Form::textarea('tags', $tags, ['class'=>'form-control']) !!}
			</div>
          
		  <div class="form-group">
		   {!! Form::submit('Salvar Category', ['class'=>'btn btn-primary form-control']) !!}
		  </div>
		  
		  {!! Form::close() !!}
		</div> 
	
@endsection
