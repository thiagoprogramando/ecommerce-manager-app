@extends('app.layout')
@section('title') Banners @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Banners</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Banners</li>
        </ol>
    </nav>
</div>

<div class="btn-group mb-3" role="group" aria-label="Basic outlined example">
    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createProduct">Criar Banner</button>
    <button type="button" class="btn btn-outline-dark" title="Excel"><i class="bi bi-list-check"></i></button>
    <button type="button" class="btn btn-outline-dark" title="PDF"><i class="bi bi-file-earmark-pdf"></i></button>
</div>

<form action="{{ route('adm.created-banner') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input name="license" type="hidden" value="{{ Auth::user()->api_key }}">
    <div class="modal fade" id="createProduct" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header container">
                    <h5 class="modal-title">Comece com as informações básicas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-8 offset-md-2 col-lg-8 offset-lg-2 row">
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                                <div class="form-floating mb-3">
                                    <input type="text" name="title" class="form-control" id="floatingTitle" placeholder="Nome:">
                                    <label for="floatingTitle">Título:</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-floating mb-3">
                                    <textarea name="description" class="form-control" placeholder="Descrição:" id="floatingDescription" style="height: 100px;"></textarea>
                                    <label for="floatingDescription">Descrição:</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-floating mb-3">
                                    <input name="file" class="form-control" id="floatingPhoto" type="file" accept="image/*" multiple>
                                    <label for="floatingPhoto">Banner: <span class="badge bg-dark">Recomendado 3000px X 1000px</span></label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="text" name="url" class="form-control" id="floatingUrl" placeholder="URL:">
                                    <label for="floatingUrl">Link:</label>
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
            <h5 class="card-title">Banners</h5>
            <hr>

            <div class="row">
                @foreach ($banners as $banner)
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-3">
                        <div class="card">
                            <img src="{{ asset('storage/' . $banner->file) }}" class="card-img-top" alt="{{ $banner->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $banner->title }}</h5>
                                <p class="card-text">
                                    {{ $banner->description }}
                                </p>
                                <form action="{{ route('adm.deleted-banner') }}" method="POST" class="delete">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $banner->id }}">
                                    <button type="submit" class="btn btn-outline-dark w-100" title="Excluir Banner"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection