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
                                <th scope="row">{{ $order->id }}</th>
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
                                <td>R$ {{ number_format($order->value, 2, ',', '.') }} - {{ $order->labelMethod() }} {{ $order->payment_installments }}x<br>
                                    <a href="{{ $order->payment_url }}" target="_blank" class="text-danger">Link de Pagamento</a>
                                </td>
                                <td>{{ $order->labelStatus() }}</td>
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('adm.remove-order') }}" method="POST" class="delete">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <button type="submit" class="btn btn-outline-dark" title="Excluir Pedido"><i class="bi bi-trash"></i></button>
                                            <button type="button" class="btn btn-outline-dark" title="Editar Pedido" data-bs-toggle="modal" data-bs-target="#updateOrder{{ $order->id }}"><i class="bi bi-pen"></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>

                            <form action="{{ route('adm.update-order') }}" method="POST">
                                @csrf
                                <input name="order_id" type="hidden" value="{{ $order->id }}">
                                <div class="modal fade" id="updateOrder{{ $order->id }}" tabindex="-1" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header container">
                                                <h5 class="modal-title">Detalhes do Pedido:</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" id="floatingName" placeholder="Nome:" value="{{ $order->name }}" disabled>
                                                                <label for="floatingName">Pedido:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" id="floatingValue" placeholder="Valor:" value="{{ $order->value }}" disabled>
                                                                <label for="floatingValue">Valor:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" id="floatingToken" placeholder="Token de Pagamento:" value="{{ $order->payment_token }}" disabled>
                                                                <label for="floatingToken">Token de Pagamento:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                                                            <div class="form-floating">
                                                                <input type="text" name="tracking_code" class="form-control" id="floatingTrackingCode" placeholder="Código de Rastreamento:" value="{{ $order->tracking_code }}">
                                                                <label for="floatingTrackingCode">Código de Rastreamento:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
                                                            <div class="input-group">
                                                                <div class="form-floating">
                                                                    <select name="payment_method" class="form-select" id="paymentMethod">
                                                                        <option value="PIX" selected>Formas de pagamento</option>
                                                                        <option value="PIX" @selected($order->payment_method == 'PIX')>PIX</option>
                                                                        <option value="CREDIT_CARD" @selected($order->payment_method == 'CREDIT_CARD')>Cartão de Crédito</option>
                                                                        <option value="BOLETO" @selected($order->payment_method == 'BOLETO')>Boleto</option>
                                                                    </select>
                                                                    <label for="floatingStatus">Formas</label>
                                                                </div>
                                                                <div class="form-floating">
                                                                    <select name="payment_installments" class="form-select" id="installments">
                                                                        <option value="1" selected>Parcelas</option>
                                                                        <option value="1"  @selected($order->payment_installments == 1)>1x</option>
                                                                        <option value="2"  @selected($order->payment_installments == 2)>2x</option>
                                                                        <option value="3"  @selected($order->payment_installments == 3)>3x</option>
                                                                        <option value="4" @selected($order->payment_installments == 4)>4x</option>
                                                                        <option value="5" @selected($order->payment_installments == 5)>5x</option>
                                                                        <option value="6" @selected($order->payment_installments == 6)>6x</option>
                                                                        <option value="7" @selected($order->payment_installments == 7)>7x</option>
                                                                        <option value="8" @selected($order->payment_installments == 8)>8x</option>
                                                                        <option value="9" @selected($order->payment_installments == 9)>9x</option>
                                                                        <option value="10" @selected($order->payment_installments == 10)>10x</option>
                                                                        <option value="11" @selected($order->payment_installments == 11)>11x</option>
                                                                        <option value="12" @selected($order->payment_installments == 12)>12x</option>
                                                                    </select>
                                                                    <label for="floatingStatus">Parcelas</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
                                                            <div class="form-floating">
                                                                <select name="status" class="form-select" id="floatingStatus">
                                                                    <option value="00" selected>Status do Pedido</option>
                                                                    <option value="00" @selected($order->status == 0)>Pendente</option>
                                                                    <option value="1" @selected($order->status == 1)>Confirmado</option>
                                                                    <option value="2" @selected($order->status == 2)>Aprovado</option>
                                                                    <option value="3" @selected($order->status == 3)>Enviado</option>
                                                                    <option value="4" @selected($order->status == 4)>Cancelado</option>
                                                                </select>
                                                                <label for="floatingStatus">Status</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer btn-group">
                                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-dark">Atualizar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>

@endsection