@extends('app.layout')
@section('title') Links @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Links</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Links</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Mantenha seus links atualizados.</h5>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <form action="{{ route('adm.created-link') }}" method="POST" class="row">
                        @csrf

                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">

                        <div class="col-12 col-md-12 col-lg-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="url_whatsapp" value="{{ $link->url_whatsapp ?? '' }}" class="form-control" id="floatingLinkWhatsapp" placeholder="Link WhatsApp:">
                                <label for="floatingLinkWhatsapp">Link WhatsApp:</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="url_instagram" value="{{ $link->url_instagram ?? '' }}" class="form-control" id="floatingLinkInstagram" placeholder="Link Instagram:">
                                <label for="floatingLinkInstagram">Link Instagram:</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="url_maps" value="{{ $link->url_maps ?? '' }}" class="form-control" id="floatingLinkMaps" placeholder="Link Maps:">
                                <label for="floatingLinkMaps">Link Maps:</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 col-lg-3 offset-md-9 offset-lg-9 d-grid gap-2 mb-2">
                            <button type="submit" class="btn btn-dark" type="button">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection