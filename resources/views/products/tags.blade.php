@extends('app')
@section('content')
<div class="container">
<h1>Tags</h1>

<br>
<br>
<table class="table">
<tr>
   <th>ID</th>
   <th>Name</th>
   <th>Action</th>

</tr>
  
  @foreach($tags as $tag)
<tr>
   <td>{{$tag->tag_id}}</td>
   <td>{{$tag->name}}</td>
   </td>
      
   <td> 
	 <a href="{{ route('products.tags.destroy',['id'=>$tag->tag_id]) }}">Deletar</a>

   </td>
</tr>
  @endforeach

  </table>
 
</div>


@endsection
