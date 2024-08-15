@extends('app.layout')
@section('title') Categorias @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Categorias</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Categorias</li>
        </ol>
    </nav>
</div>

<div class="btn-group mb-3" role="group" aria-label="Basic outlined example">
    <a href="{{ route('adm.create-category') }}" class="btn btn-outline-primary">Criar Categoria</a>
    <button type="button" class="btn btn-outline-primary" title="Excel"><i class="bi bi-list-check"></i></button>
    <button type="button" class="btn btn-outline-primary" title="PDF"><i class="bi bi-file-earmark-pdf"></i></button>
</div>

<section class="section">
    <div class="card p-5">
        <div class="card-body">
            <h5 class="card-title">Categorias</h5>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Prévia </th>
                        <th scope="col">Detalhes</th>
                        <th scope="col" class="text-center">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td scope="row"><img src="{{ asset('storage/categories/images/' . $category->photo) }}" width="50"></td>
                            <td>{{ $category->name }} <br>
                                <span class="badge rounded-pill bg-primary">{{ \Illuminate\Support\Str::limit($category->description, 70) }}</span>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('adm.deleted-category') }}" method="POST" class="delete">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $category->id }}">
                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                        <button type="submit" class="btn btn-outline-dark"><i class="bi bi-trash"></i></button>
                                        <a href="{{ route('adm.view-category', ['id' => $category->id]) }}" class="btn btn-outline-dark"><i class="bi bi-pen"></i></a>
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