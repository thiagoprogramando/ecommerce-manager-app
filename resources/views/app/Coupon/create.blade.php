@extends('app.layout')
@section('title') Cadastro de Cupom @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Cadastro de Cupom</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Cadastro de Cupom</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="card p-5">
        <div class="card-body">
            <h5 class="card-title">Informações do Cupom</h5>
            <form action="{{ route('adm.created-coupon') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input name="license" type="hidden" value="{{ Auth::user()->api_key }}">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="floatingName" placeholder="Nome:" required>
                            <label for="floatingName">Nome:</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3 mt-2">
                        <div class="form-floating mb-3">
                            <input type="number" name="percentage" class="form-control" id="floatingPercentage" placeholder="Porcentagem:" required>
                            <label for="floatingPercentage">Porcentagem:</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3 mt-2">
                        <div class="form-floating mb-3">
                            <input type="number" name="qtd" class="form-control" id="floatingQtd" placeholder="Quantidade:">
                            <label for="floatingQtd">Quantidade:</label>
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
                            <a href="{{ route('adm.create-coupon') }}" class="btn btn-outline-danger">Limpar</a>
                            <button type="submit" class="btn btn-outline-success">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection