@extends('app.layout')
@section('title') Cadastro de Categoria @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Cadastro de Categoria</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Cadastro de Categoria</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="card p-5">
        <div class="card-body">
            <h5 class="card-title">Informações da Categoria</h5>
            <form action="{{ route('adm.created-category') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input name="license" type="hidden" value="{{ Auth::user()->api_key }}">
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-7 mt-2">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="floatingName" placeholder="Nome:">
                            <label for="floatingName">Nome:</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5 mt-2">
                        <div class="form-floating mb-3">
                            <input type="file" name="file" class="form-control" id="floatingImage" placeholder="Imagem:" accept="image/*">
                            <label for="floatingImage">Imagem:</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 mt-1">
                        <div class="form-floating mb-3">
                            <textarea name="description" class="form-control" placeholder="Descrição:" id="floatingDescription" style="height: 100px;"></textarea>
                            <label for="floatingDescription">Descrição:</label>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-3 offset-md-9 offset-lg-9 col-lg-3">
                        <div class="btn-group w-100" role="group" aria-label="Basic outlined example">
                            <a href="{{ route('adm.create-category') }}" class="btn btn-outline-danger">Limpar</a>
                            <button type="submit" class="btn btn-outline-success">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection