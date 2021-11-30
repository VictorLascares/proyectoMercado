@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h2 class="card-title">Product</h2>
                </div>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
                </div>
            </div>


            <div class="card-body">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $product->name }}
                </div>
                <div class="form-group">
                    <strong>Existence:</strong>
                    {{ $product->existencia }}
                </div>
                <div class="form-group">
                    <strong>Price:</strong>
                    {{ $product->price }}
                </div>
                <div class="form-group">
                    <strong>Category:</strong>
                    {{ $category['name'] }}
                </div>
                @auth
                    @if (Auth::user()->rol  == 'Cliente' && Auth::user()->estado == 'Comprador')
                        <form action="{{ route('questions.store') }}" method="POST">
                            @csrf
                            <div class="d-flex flex-column">
                                <label for="product_question">Do you have a question?</label>
                                <input type="text" name="question" id="product_question" placeholder="Question">
                            </div>
                            <div class="d-none">
                                <input type="text" name="product_id" value="{{ $product->id }}" id="product_question" placeholder="Question">
                            </div>
                            <div class="d-flex justify-content-end mt-2">
                                <input class="btn btn-primary" type="submit" value="Send">
                            </div>
                        </form>

                        <input id="btnComprar" type="button" value="Pagar">
                        <div class="forma-pago mt-2" style="display: none">
                            <button id="pago-linea" class="btn btn-success">En Linea</button>
                            <button id="pago-banco" class="btn btn-success">Banco</button>
                        </div>
                        @if ($product->existencia >= 1)
                            <form id="metodo-pago" class="mt-4" id="accionesCliente" method="POST" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="en-linea" style="display: none">
                                    <input type="number" max="{{$product->existencia}}"  min="1" placeholder="Cantidad" name="cantidadLinea">
                                    <button type="submit">Aceptar</button>
                                </div>
                                <div class="banco" style="display: none">
                                    <div class="input-group form-group">
                                        <input type="file" class="form-control" id="ticket" name="ticket">
                                        <input type="number" max="{{$product->existencia}}"  min="1" placeholder="Cantidad" name="cantidad">
                                        <button type="submit">Aceptar</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endif

                    @can('consignar', $product)
                            <button id="consignar"  class="btn btn-success">CONCESIONAR</button>
                            <button id="noConsignar" class="btn btn-danger">NO CONCESIONAR</button>
                            <form id="#overlay" class="row-reverse" method="POST" action="/product/{{$product->id}}/consignar">
                                @method('PUT')
                                @csrf
                            </form>
                        @endcan
                @endauth
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h2 class="card-title">Preguntas</h2>
            </div>
            <div class="card-body">
                @foreach ($questions as $question)
                    @if ($question->answer == '')
                    <p>{{ $question->question }}</p>
                    @auth
                        @if (Auth::user()->rol  == 'Cliente' && Auth::user()->estado == 'Vendedor')
                            <form method="POST" action="{{ route('questions.update',$question->id)}}">
                                @method('PUT')
                                @csrf
                                <div class="d-flex flex-column">

                                    <input type="text" name="answer" placeholder="Responder">
                                </div>

                                <div class="d-flex justify-content-end mt-2">
                                    <input class="btn btn-primary btn-answer" type="submit" value="Send">
                                </div>
                            </form>
                        @endif
                    @endauth
                    @else
                    <div class="d-flex flex-column">
                        <label for="{{$question->id}}">{{ $question->question }}</label>
                        <input type="text" name="answer" id="{{$question->id}}" disabled value="{{$question->answer}}">
                    </div>
                    @endif
                @endforeach
            </div>


        </div>
        @auth
            @if (Auth::user()->rol == 'Supervisor')
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">#</th>
                                    <th scope="col">Vendedor</th>
                                    <th scope="col">Porcentaje</th>
                                    <th scope="col">Comprador</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Fecha de creacion</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($compras as $compra)
                                    <th scope="row">{{ $l++ }}</th>
                                    <td>
                                        {{Auth::user()->nombre($product->user_id)}}
                                    </td>
                                    <td>
                                        {{$product->porcentaje}}%
                                    </td>
                                    <td>{{Auth::user()->nombre($compra->user_id)}}</td>
                                    <td>{{$compra->cantidad}}</td>
                                    <td>{{$compra->estado}}</td>
                                    <td>{{$compra->created_at}}</td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endauth
    </div>
</div>
<script type="text/javascript" >
    const overlay = document.getElementById('#overlay');
    if(overlay!==null){
        const consignar = document.querySelector('#consignar')
        const noConsignar = document.querySelector('#noConsignar')
        const entrada = document.createElement("INPUT");
        const submit = document.createElement("INPUT");
        submit.type = 'submit'
        submit.classList.add = 'btn'
        submit.classList.add = 'btn-primary'
        submit.value = 'Agregar';
        overlay.appendChild(submit);
        overlay.style.display = "none";

        consignar.addEventListener('click', function(e) {
            e.preventDefault();
            mostrarInputNumber();
        })
        noConsignar.addEventListener('click', function(e) {
            e.preventDefault();
            mostrarInputText();
        })
        function mostrarInputNumber(){
            noConsignar.disabled = false;
            consignar.disabled = true;
            entrada.type = "number";
            entrada.name = "porcentaje";
            entrada.placeholder = "Porcentaje";
            overlay.appendChild(entrada);
            overlay.style.display = "flex";
            overlay.style.flexDirection = "row-reverse"
        }
        function mostrarInputText(){
            consignar.disabled = false;
            noConsignar.disabled = true;
            entrada.type = "text";
            entrada.name = "motivo";
            overlay.appendChild(entrada);
            entrada.placeholder = "Motivo";
            overlay.appendChild(entrada);
            overlay.style.display = "flex";
            overlay.style.flexDirection = "row-reverse"
        }
    }
    const comprar = document.querySelector('#btnComprar')
    const form = document.querySelector('#accionesCliente')
    const formaPago = document.querySelector('.forma-pago')
    const enLinea = document.querySelector('.en-linea')
    const banco = document.querySelector('.banco')
    const pagoLinea = document.querySelector('#pago-linea')
    const pagoBanco = document.querySelector('#pago-banco')
    const metodo = document.querySelector('#metodo-pago')

    comprar.addEventListener('click', function(e) {
        comprarProducto(e);
    })
    pagoLinea.addEventListener('click', function(e) {
        banco.style.display = "none"
        e.preventDefault()
        pagarEnLinea()
    })
    pagoBanco.addEventListener('click', function(e) {
        e.preventDefault()
        enLinea.style.display = "none"
        pagarEnBanco()
    })
    function comprarProducto(e){
        formaPago.style.display = "block"

    }

    function pagarEnLinea() {
        enLinea.style.display = "block"
        metodo.action= "{{url('comprar/linea',$product->id)}}"
    }
    function pagarEnBanco() {
        banco.style.display = "block"
        metodo.action= "{{url('comprar/banco',$product->id)}}"
    }
</script>
@endsection
