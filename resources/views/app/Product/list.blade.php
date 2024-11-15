@extends('app.layout')
@section('title') Produtos @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Produtos</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Produtos</li>
        </ol>
    </nav>
</div>

<div class="btn-group mb-3" role="group" aria-label="Basic outlined example">
    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createProduct">Criar Produto</button>
    <button type="button" class="btn btn-outline-dark" title="Excel"><i class="bi bi-list-check"></i></button>
    <button type="button" class="btn btn-outline-dark" title="PDF"><i class="bi bi-file-earmark-pdf"></i></button>
</div>

<form action="{{ route('adm.created-product') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input name="license" type="hidden" value="{{ Auth::user()->api_key }}">
    <div class="modal fade" id="createProduct" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header container">
                    <h5 class="modal-title">Informações básicas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-8 offset-md-2 col-lg-8 offset-lg-2 row">
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" class="form-control" id="floatingName" placeholder="Nome:">
                                    <label for="floatingName">Título:</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-floating mb-3">
                                    <textarea name="description" class="form-control" placeholder="Descrição:" id="floatingDescription" style="height: 200px;"></textarea>
                                    <label for="floatingDescription">Descrição:</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-floating mb-3">
                                    <input name="file[]" class="form-control" id="floatingPhoto" type="file" accept="image/*" multiple>
                                    <label for="floatingPhoto">Anexe uma ou mais fotos:</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="text" name="value" class="form-control" id="floatingValue" placeholder="Preço:" oninput="mascaraReal(this)">
                                    <label for="floatingValue">Preço:</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="text" name="ean" class="form-control" id="floatingEan" placeholder="EAN:">
                                    <label for="floatingEan">EAN:</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="number" name="stock" class="form-control" id="floatingStock" placeholder="Estoque:">
                                    <label for="floatingStock">Estoque:</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer container d-flex align-items-center justify-content-center">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-dark">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<section class="section">
    <div class="card p-5">
        <div class="card-body">
            <h5 class="card-title">Produtos</h5>

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
        </div>
    </div>
</section>

@endsection