@extends('app.layout')
@section('title') Pesquisa: {{ $search }} @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Pesquisa: {{ $search }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Pesquisa: {{ $search }}</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="card p-5">
        <div class="card-body">

            @if($orders->count() > 0)
                <h5 class="card-title">Vendas: {{ $search }}</h5>

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
            @endif

            @if($products->count() > 0)
                <h5 class="card-title">Produtos: {{ $search }}</h5>

                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Descrição </th>
                                <th scope="col">Detalhes</th>
                                <th scope="col" class="text-center">Estoque</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row"><a href="#"><img src="assets/img/product-1.jpg" alt=""></a></th>
                                    <td>{{ $product->name }} <br>
                                        <span class="badge rounded-pill bg-dark">{{ \Illuminate\Support\Str::limit($product->description, 70) }}</span>
                                    </td>
                                    <td>R$ {{ number_format($product->value, 2, ',', '.') }} <br>
                                        <span class="badge bg-dark">{{ $product->ean }}</span>
                                    </td>
                                    <td class="text-center">{{ $product->stock }}</td>
                                    <td class="text-center">{{ $product->labelStatus() }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('adm.deleted-product') }}" method="POST" class="delete">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a href="{{ route('adm.copy-product', ['id' => $product->id]) }}" class="btn btn-outline-dark" title="Duplicar produto"><i class="bi bi-front"></i></a>
                                                <button type="submit" class="btn btn-outline-dark" title="Excluir produto"><i class="bi bi-trash"></i></button>
                                                <a href="{{ route('adm.view-product', ['id' => $product->id]) }}" class="btn btn-outline-dark" title="Editar produto"><i class="bi bi-pen"></i></a>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            @if($users->count() > 0)
                <h5 class="card-title">Usuários: {{ $search }}</h5>

                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome </th>
                                <th scope="col">Detalhes</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }} <br>
                                        <span class="badge rounded-pill bg-dark">{{ $user->cpfcnpj }}</span>
                                    </td>
                                    <td>{{ $user->email }} <br>
                                        <span class="badge rounded-pill bg-dark">{{ $user->phone }}</span>
                                    </td>
                                    <td>{{ $user->labelStatus() }} <br>
                                        <span class="badge rounded-pill bg-dark">{{ $user->labelType() }}</span>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('adm.deleted-user') }}" method="POST" class="delete">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <button type="submit" class="btn btn-outline-dark"><i class="bi bi-trash"></i></button>
                                                <a href="{{ route('adm.view-user', ['id' => $user->id]) }}" class="btn btn-outline-dark"><i class="bi bi-pen"></i></a>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection