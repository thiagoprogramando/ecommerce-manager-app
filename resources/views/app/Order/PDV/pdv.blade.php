@extends('app.layout')
@section('title') PDV @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>PDV</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">PDV</li>
        </ol>
    </nav>
</div>

<div class="btn-group mb-3" role="group" aria-label="Basic outlined example">
    <button type="button" class="btn btn-dark" title="Tela cheio">Precione F11 para tela cheia</button>
    <button type="button" class="btn btn-outline-dark" title="+Zoom" id="zoomInBtn"><i class="bi bi-zoom-in"></i></button>
    <button type="button" class="btn btn-outline-dark" title="-Zoom" id="zoomOutBtn"><i class="bi bi-zoom-out"></i></button>
</div>

<section class="section">
    <div class="card p-5">
        <div class="card-body">
            <h4 class="display-4">PDV</h4>
            <hr>

            @if(!$client)
                <form action="{{ route('adm.pdv') }}" method="GET" class="row">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="form-floating mb-3">
                            <select name="client" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option value="" selected>Escolha um cliente</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Clientes</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 gap-2">
                        <button type="submit" class="btn btn-lg btn-dark w-100 mt-1">INICIAR</button>
                    </div>
                </form>
            @else

                <div class="row">
                    <div class="col-12 mb-3">
                        <span class="badge bg-dark">{{ $client->name }}</span>
                    </div>
                    <div class="col-12 mb-3">
                        <form action="{{ route('adm.add-pdv') }}" method="POST" class="row">
                            @csrf
                            <input type="hidden" name="client_id" value="{{ $client->id }}">

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-floating mb-3">
                                    <select name="product_id" class="form-select" id="floatingProduct" aria-label="Floating label select example">
                                        <option value="" selected>Escolha um Produto</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->ean }} {{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingProduct">Produtos</label>
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                                <div class="form-floating mb-3">
                                    <input type="number" name="qtd" class="form-control" id="floatingQtd" placeholder="Quantidade:" value="1">
                                    <label for="floatingQtd">Quantidade:</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 gap-2">
                                <button type="submit" class="btn btn-lg btn-dark w-100 mt-1">Adicionar</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-8">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col" class="text-center">qtd</th>
                                        <th scope="col" class="text-center">Preço</th>
                                        <th scope="col" class="text-center">Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($itens as $item)
                                        <tr>
                                            <td>{{ $item->product->name }} <br>
                                                <span class="badge rounded-pill bg-dark">{{ \Illuminate\Support\Str::limit($item->product->description, 40) }}</span>
                                            </td>
                                            <td class="text-center">{{ $item->qtd }}</td>
                                            <td class="text-center"> <b>R$ {{ number_format($item->value, 2, ',', '.') }}</b> </td>
                                            <td class="text-center">
                                                <form action="{{ route('adm.remove-pdv') }}" method="POST" class="delete">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <button type="submit" class="btn btn-dark" title="Excluir item"><i class="bi bi-trash"></i></button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="card p-5">
                            <h6 class="display-6">Total</h6>
                            <hr>
                            <p>
                                <b>Produtos:</b> R$ {{ number_format($itens->sum('value'), 2, ',', '.') }} <br>
                                <b>Total: R$ {{ number_format($itens->sum('value'), 2, ',', '.') }} </b>
                            </p>
            
                            <form action="{{ route('adm.create-order') }}" method="POST">
                                @csrf
                                <input type="hidden" name="name" value="PEDIDO{{ date('d') }}{{ date('m') }}{{ date('Y') }}">
                                <input type="hidden" name="value" value="{{ $itens->sum('value') }}">
                                <input type="hidden" name="customer_id" value="{{ $client->id }}">
                                <div class="input-group mb-3">
                                    <select name="method" class="form-select" id="paymentMethod">
                                        <option value="PIX" selected>Forma</option>
                                        <option value="PIX">PIX</option>
                                        <option value="CREDIT_CARD">Cartão de Crédito</option>
                                    </select>
                                    <select name="installments" class="form-select" id="installments">
                                        <option value="1" selected>Parcelas</option>
                                        <option value="1">1x</option>
                                        <option value="2">2x</option>
                                        <option value="3">3x</option>
                                        <option value="4">4x</option>
                                        <option value="5">5x</option>
                                        <option value="6">6x</option>
                                        <option value="7">7x</option>
                                        <option value="8">8x</option>
                                        <option value="9">9x</option>
                                        <option value="10">10x</option>
                                        <option value="11">11x</option>
                                        <option value="12">12x</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-dark w-100">FINALIZAR</button>
                            </form>
                        </div>
                    </div>
                </div>

                
            @endif
        </div>
    </div>
</section>

<script>
    function adjustZoom(zoomLevel) {
        document.body.style.zoom = zoomLevel;
        localStorage.setItem('zoomLevel', zoomLevel);
    }

    window.onload = function() {
        let savedZoom = localStorage.getItem('zoomLevel');
        if (savedZoom) {
            document.body.style.zoom = savedZoom;
            currentZoom = parseFloat(savedZoom);
        }
    }

    let currentZoom = 1;

    document.getElementById('zoomInBtn').addEventListener('click', function () {
        currentZoom += 0.1;
        adjustZoom(currentZoom);
    });

    document.getElementById('zoomOutBtn').addEventListener('click', function () {
        if (currentZoom > 0.1) {
            currentZoom -= 0.1;
            adjustZoom(currentZoom);
        }
    });
</script>

@endsection