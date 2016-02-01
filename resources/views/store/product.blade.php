
  @extends('store.store')
  
  @section('categories')
      @include('store.partial.categories')
  @stop
  
  @section('content')
   <div class="col-sm-9 padding-right">
        <div class="product-details">
		    <div class="col-sm-5">
			    <div class="view-product">
				
				    @if(count($product->images))
				<img src="{{url('uploads/'.$product->images->first()->id.'.'.$product->images->first()->extension)}}" alt="" width="200" />

                <!-- <img src="{{url('https://s3-us-west-2.amazonaws.com/barauna/'.$product->images->first()->id.'.'.$product->images->first()->extension)}}" alt="" width="200" /> amazon -->

                    @else
					<img src="{{ url('images/no-img.jpg')}}" alt=""/>	
					@endif
					
				</div>
            <div id="similar-product" class="carousel slide" data-ride="carousel">
                
				<!-- Wrapper for slides -->
				
				<div class="carousel-inner">
				    <div class="item active">
					    @foreach($product->images as $images)

                         <a href="#"><img src="{{ url('uploads/'.$images->id.'.'.$images->extension)}}" alt="" width="80"></a>

                       <!--  <a href="#"><img src="{{ url('https://s3-us-west-2.amazonaws.com/barauna/'.$images->id.'.'.$images->extension)}}" alt="" width="80"></a> -->
                        @endforeach
			        </div>
				</div>
			</div>
		</div>
		
        <!-- product information -->
		<div class="col-sm-7">
            <div class="product-information">

			    <h2>{{ $product->category->name }} :: {{ $product->name }}</h2>
				
				<p>{{ $product->description }}</p>
				
				    <span>
					    <span>R$ {{ number_format($product->price,2,",",".")}}</span>
						    <a href="{{ route('cart.add', ['id'=>$product->id]) }}" class="btn btn-default cart">
							<i class="fa fa-shopping-cart"></i>
						</a>
                    </span>
                </div>					
			</div>
		</div>	
	</div>		   
  @stop