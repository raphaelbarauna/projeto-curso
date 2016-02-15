@extends('store.store')

@section('content')

    <section id="cart_items">
        <div class ="container">

            <div class="table-responsive cart_info">

                <table class="table table-condensed">
                    <thead>

                    <tr class="cart_menu">

                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Valor</td>
                        <td class="cart_quantity">Quantidade</td>
                        <td class="price">Total</td>
                        <td>Ação</td>
                    </tr>

                    </thead>

                    <tbody>

                    <!-- for each para mostrar os itens -->
                    @forelse($cart->all() as $k=>$item)
                       <tr>

                           <td class="cart_product">
                               <a href="{{ route('store.product', ['id'=>$k]) }}">
                                   Imagem
                               </a>
                           </td>

                           <td class="cart_description">
                               <h4><a href="{{ route('store.product', ['id'=>$k]) }}">{{ $item['name'] }}</a> </h4>

                               <p>Código: {{ $k }}</p>
                           </td>

                           <td class="cart_price">
                               R$ {{ $item['price'] }}
                           </td>
                           <td class="cart_quantity">
                              <div class="input-group" style="width: 120px">
                                {!! Form::text('qtd', $item['qtd'], ['class'=>'form-control', 'id'=>'qtd']) !!}
                                    <span class="input-group-btn">
                                    <button  id="enviar" class="btn btn-success text-right" type="submit">
                                    Alterar </button>  
                                    </span>
                              </div>     
                           </td>
                           <td class="cart_total">
                               <p class="cart_total_price"> R$ {{ $item['price'] * $item['qtd'] }}</p>
                           </td>

                           <td class="cart_delete">
                               <a href="{{ route('cart.destroy', ['id'=>$k]) }}"
                                  class="cart_quantity_delete">Delete</a>
                           </td>

                       </tr>
                    @empty
                        <tr>
                            <td class="" colspan="6">
                                <p>Nenhum Item Encontrado.</p>
                            </td>
                    @endforelse

                    <tr class="cart_menu">

                        <td colspan="6">
                            <div class="pull-right">

                            <span style="margin-right: 90px">

                                TOTAL: R$ {{ $cart->getTotal() }}

                            </span>

                            <a href="#" class="btn btn-sucess">Fechar a Conta</a>

                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>



    </section>
@stop
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

@if($k != null)

<script type="text/javascript">
$(document).ready(function(){ 

    $("#enviar").click(function(){
     
     if({!! $k !!}){
      alert('teste');
     }else{

      alert('teste2');
     }

      
      
           $.ajax({       
            type:"POST",            
            url:'cart/update',                  
            data:{
               id:   id,
               qtd: document.getElementById('qtd').value,
               _token: "{{ csrf_token() }}"
            }, 
            success: function(retorno){
            var json = retorno,

            obj =  $.parseJSON(json);
             
            if(obj.conexaoSAP = 0){

              window.location.reload();

            }
          },           
       
          }); 
       
      });           
  });
</script>
@endif