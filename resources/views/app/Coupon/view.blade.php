@extends('app.layout')
@section('title') Cupom {{ $coupon->name }} @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Cupom {{ $coupon->name }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Cupom {{ $coupon->name }}</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="card p-5">
        <div class="card-body">
            <h5 class="card-title">Informações do Cupom</h5>
            <form action="{{ route('adm.updated-coupon') }}" method="POST">
                @csrf
                <input name="id" type="hidden" value="{{ $coupon->id }}">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="floatingName" placeholder="Nome:" value="{{ $coupon->name }}">
                            <label for="floatingName">Nome:</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3 mt-2">
                        <div class="form-floating mb-3">
                            <input type="number" name="percentage" class="form-control" id="floatingPercentage" placeholder="Porcentagem:" value="{{ $coupon->percentage }}">
                            <label for="floatingPercentage">Valor:</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3 mt-2">
                        <div class="form-floating mb-3">
                            <input type="number" name="qtd" class="form-control" id="floatingQtd" placeholder="Quantidade:" value="{{ $coupon->qtd }}">
                            <label for="floatingQtd">Quantidade:</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 mt-1">
                        <div class="form-floating mb-3">
                            <textarea name="description" class="form-control" placeholder="Descrição:" id="floatingDescription" style="height: 100px;">{{ $coupon->description }}</textarea>
                            <label for="floatingDescription">Descrição:</label>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-3 offset-md-9 offset-lg-9 col-lg-3">
                        <div class="btn-group w-100" role="group" aria-label="Basic outlined example">
                            <a href="{{ route('adm.list-coupons') }}" class="btn btn-outline-danger">Cancelar</a>
                            <button type="submit" class="btn btn-dark">Atualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection