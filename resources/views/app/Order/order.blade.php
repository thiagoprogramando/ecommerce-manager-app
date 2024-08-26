@extends('app.layout')
@section('title') Pedidos @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Pedidos</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Pedidos</li>
        </ol>
    </nav>
</div>

<div class="btn-group mb-3" role="group" aria-label="Basic outlined example">
    <a href="{{ route('adm.pdv') }}" class="btn btn-dark">Criar Pedido</a>
    <button type="button" class="btn btn-outline-dark" title="Excel"><i class="bi bi-list-check"></i></button>
    <button type="button" class="btn btn-outline-dark" title="PDF"><i class="bi bi-file-earmark-pdf"></i></button>
</div>

<section class="section">
    <div class="card p-5">
        <div class="card-body">
            <h5 class="card-title">Pedidos</h5>

            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pedido</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Status</th>
                            <th scope="col">Data</th>
                            <th scope="col" class="text-center">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{$order->id }}</th>
                                <td>{{ $order->name }} <br>
                                    <small> 
                                        @foreach ($order->carts as $key => $cart)
                                            <span class="badge rounded-pill bg-dark">{{ $cart->qtd }}x {{ $cart->name }}</span>
                                            @if(($key + 1) % 3 == 0)
                                                <br>
                                            @endif
                                        @endforeach
                                    </small>
                                </td>
                                <td><b>R$ {{ number_format($order->value, 2, ',', '.') }}</b><br>
                                    <a href="{{ $order->payment_url }}" target="_blank" class="text-danger">Link de Pagamento</a>
                                </td>
                                <td>{{ $order->labelStatus() }}</td>
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('adm.remove-order') }}" method="POST" class="delete">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <button type="submit" class="btn btn-outline-dark" title="Excluir Cupom"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>

@endsection