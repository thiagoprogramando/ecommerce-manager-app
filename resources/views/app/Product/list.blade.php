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
    <a href="{{ route('adm.create-product') }}" class="btn btn-outline-primary">Criar Produto</a>
    <button type="button" class="btn btn-outline-primary" title="Excel"><i class="bi bi-list-check"></i></button>
    <button type="button" class="btn btn-outline-primary" title="PDF"><i class="bi bi-file-earmark-pdf"></i></button>
</div>

<section class="section">
    <div class="card p-5">
        <div class="card-body">
            <h5 class="card-title">Produtos</h5>

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
                                <span class="badge rounded-pill bg-primary">{{ \Illuminate\Support\Str::limit($product->description, 70) }}</span>
                            </td>
                            <td>R$ {{ number_format($product->value, 2, ',', '.') }} <br>
                                <span class="badge bg-dark">{{ $product->ean }}</span>
                            </td>
                            <td class="text-center">{{ $product->qtd }}</td>
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
</section>

@endsection