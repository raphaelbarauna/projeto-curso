@extends('app')
@section('content')
<div class="container">
<h1>Tags</h1>


<a href="{{ route ('tags.create')}}" class="btn btn-default">Nova tag</a>
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
   <td>{{$tag->id}}</td>
   <td>{{$tag->name}}</td>
   </td>
      
   <td> 
	 <a href="{{ route('tags.destroy',['id'=>$tag->id]) }}">Deletar</a>
      |  
	<a href="{{ route('tags.edit',['id'=>$tag->id]) }}">Editar</a>  
	   |
   </td>
</tr>
  @endforeach

  </table>
  {!! $tags->render() !!}
</div>


@endsection
