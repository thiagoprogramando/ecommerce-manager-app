@extends('app.layout')
@section('title') Recebivéis @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Recebivéis</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Recebivéis</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="row">
        <div class="col-xxl-12 col-md-12">
            <div class="card p-5">

                <div class="btn-group mb-3 w-25" role="group">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#transferModal">Filtrar</button>
                    <button type="button" id="gerarExcel" class="btn btn-outline-dark">Excel</button>
                </div>

                <div class="modal fade" id="transferModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('adm.receivables') }}" method="GET">
                                <div class="modal-header">
                                    <h5 class="modal-title">Informe os dados para pesquisa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6 mb-1">
                                            <div class="form-floating">
                                                <input type="date" name="startDate" class="form-control" id="floatingstartDate" placeholder="Data Inicial:">
                                                <label for="floatingstartDate">Data Inicial (Vencimento):</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 mb-1">
                                            <div class="form-floating">
                                                <input type="date" name="finishDate" class="form-control" id="floatingfinishDate" placeholder="Data Final:">
                                                <label for="floatingfinishDate">Data Final (Vencimento):</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-12 mb-1">
                                            <div class="form-floating">
                                                <input type="text" name="externalReference" class="form-control" id="floatingexternalReference" placeholder="Identificador da Venda:">
                                                <label for="floatingexternalReference">Identificador da Venda:</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-dark">Filtrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <h5 class="card-title">Cobranças</h5>

                <div class="table-responsive">
                    <table class="table table-responsive table-hover" id="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Data Cadastro</th>
                                <th>Data Vencimento</th>
                                <th>Valor</th>
                                <th class="text-justify">Tipo</th>
                                <th class="text-justify">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($receivables as $receivable)
                                <tr>
                                    <td>{{ $receivable['id'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($receivable['dateCreated'])->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($receivable['dueDate'])->format('d/m/Y') }}</td>
                                    <td class="text-justify">R$ {{ number_format($receivable['value'], 2, ',', '.') }}</td>
                                    <td>
                                        @switch($receivable['billingType'])
                                            @case('BOLETO')
                                                Boleto Bancário
                                                @break
                                            @case('CREDIT_CARD')
                                                Cartão de crédito
                                                @break
                                            @case('UNDEFINED')
                                                Cliente escolhe
                                                @break
                                            @case('DEBIT_CARD')
                                                Cartão de Débito
                                                @break
                                            @case('TRANSFER')
                                                Transferência
                                                @break
                                            @case('PIX')
                                                PIX
                                                @break
                                            @default
                                                Cliente escolhe
                                                @break
                                        @endswitch
                                    </td>
                                    <td>{{ $receivable['status'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection