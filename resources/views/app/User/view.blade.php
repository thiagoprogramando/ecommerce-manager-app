@extends('app.layout')
@section('title') Usuário: {{ $user->name }} @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Usuário: {{ $user->name }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Usuário: {{ $user->name }}</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="card p-5">
        <div class="card-body">
            <h5 class="card-title">Informações do Usuário</h5>
            <form action="{{ route('adm.update-user') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4 mb-1">
                        <div class="form-floating">
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" id="floatingName" placeholder="Nome:">
                            <label for="floatingName">Nome:</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 col-lg-2 mb-1">
                        <div class="form-floating">
                            <input type="text" name="cpfcnpj" value="{{ Auth::user()->cpfcnpj }}" class="form-control" id="floatingCpfcnpj" placeholder="CPF ou CNPJ:">
                            <label for="floatingCpfcnpj">CPF ou CNPJ:</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 mb-1">
                        <div class="form-floating">
                            <input type="text" name="description" value="{{ Auth::user()->description }}" class="form-control" id="floatingDescription" placeholder="Descrição:">
                            <label for="floatingDescription">Descrição:</label>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4 col-lg-4 mb-1">
                        <div class="form-floating">
                            <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" id="floatingEmail" placeholder="Email:">
                            <label for="floatingEmail">Email:</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 col-lg-2 mb-1">
                        <div class="form-floating">
                            <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control" id="floatingPhone" placeholder="Telefone:">
                            <label for="floatingPhone">Telefone:</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 mb-1">
                        <div class="form-floating">
                            <input type="text" name="address" value="{{ Auth::user()->address }}" class="form-control" id="floatingPostalCode" placeholder="Endereço:">
                            <label for="floatingPostalCode">Endereço:</label>
                        </div>
                    </div>
    
                    <div class="col-12 col-md-4 col-lg-4 mb-1">
                        <div class="form-floating">
                            <input type="text" name="wallet" value="{{ Auth::user()->wallet }}" class="form-control" id="floatingWallet" placeholder="Wallet:">
                            <label for="floatingWallet">Wallet:</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2">
                        <div class="form-floating mb-3">
                            <select name="type" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option disabled>Tipos</option>
                                <option value="1" @if($user->type == 1) selected @endif>Administrador</option>
                                <option value="2" @if($user->type == 2) selected @endif>Colaborador</option>
                            </select>
                            <label for="floatingSelect">Tipo</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 mb-1">
                        <div class="form-floating">
                            <input type="text" value="{{ Auth::user()->api_key }}" class="form-control" id="floatingApi" placeholder="KEY:" disabled>
                            <label for="floatingApi">KEY:</label>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-3 offset-md-9 offset-lg-9 col-lg-3">
                        <div class="btn-group w-100" role="group" aria-label="Basic outlined example">
                            <a href="{{ route('adm.list-users', ['type' => $user->type]) }}" class="btn btn-outline-danger">Cancelar</a>
                            <button type="submit" class="btn btn-outline-success">Atualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection