@extends('app.layout')
@section('title') Categoria {{ $category->name }} @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Categoria {{ $category->name }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Categoria {{ $category->name }}</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="card p-5">
        <div class="card-body">
            <h5 class="card-title">Informações da Categoria</h5>
            <form action="{{ route('adm.updated-category') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input name="id" type="hidden" value="{{ $category->id }}">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="floatingName" placeholder="Nome:" value="{{ $category->name }}">
                            <label for="floatingName">Nome:</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="form-floating mb-3">
                            <input type="file" name="file" class="form-control" id="floatingImage" placeholder="Imagem:">
                            <label for="floatingImage">Imagem:</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-floating mb-3">
                            <textarea name="description" class="form-control" placeholder="Descrição:" id="floatingDescription" style="height: 150px;">{{ $category->description }}</textarea>
                            <label for="floatingDescription">Descrição:</label>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-3 offset-md-9 offset-lg-9 col-lg-3">
                        <div class="btn-group w-100" role="group" aria-label="Basic outlined example">
                            <a href="{{ route('adm.list-categories') }}" class="btn btn-outline-danger">Cancelar</a>
                            <button type="submit" class="btn btn-dark">Atualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection