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
                        <td class="price">Quantidade</td>
                        <td class="price">Total</td>

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
                               {{ $item['qtd'] }}
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