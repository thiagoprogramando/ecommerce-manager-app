@extends('app.layout')
@section('title') Pagamentos @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Pagamentos</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Pagamentos</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="row">
        <div class="col-xxl-12 col-md-12">
            <div class="card p-5">

                <div class="btn-group mb-3 w-25" role="group">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transferModal">Filtrar</button>
                    <button type="button" id="gerarExcel" class="btn btn-outline-primary">Excel</button>
                </div>

                <div class="modal fade" id="transferModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('adm.transfers') }}" method="GET">
                                <div class="modal-header">
                                    <h5 class="modal-title">Informe os dados para pesquisa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6 mb-1">
                                            <div class="form-floating">
                                                <input type="date" name="startDate" class="form-control" id="floatingstartDate" placeholder="Data Inicial:">
                                                <label for="floatingstartDate">Data Inicial:</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 mb-1">
                                            <div class="form-floating">
                                                <input type="date" name="finishDate" class="form-control" id="floatingfinishDate" placeholder="Data Final:">
                                                <label for="floatingfinishDate">Data Final:</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-success">Filtrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <h5 class="card-title">Extrato</h5>

                <div class="table-responsive">
                    <table class="table table-responsive table-hover" id="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th class="text-justify">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transfers as $transfer)
                                <tr>
                                    <td>{{ $transfer['id'] }}</td>
                                    <td>
                                        @if($transfer['value'] < 0)
                                            Saída
                                        @else
                                            Entrada
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($transfer['date'])->format('d/m/Y') }}</td>
                                    <td>{{ $transfer['description'] }}</td>
                                    <td class="text-justify">R$ {{ number_format($transfer['value'], 2, ',', '.') }}</td>
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