@extends('app.layout')
@section('title') Cadastro de Usuário @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Cadastro de Usuário</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Cadastro de Usuário</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="card p-5">
        <div class="card-body">
            <h5 class="card-title">Informações do Usuário</h5>
            <form action="{{ route('adm.create-user') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="license" value="{{ Auth::user()->api_key }}">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4 mb-1">
                        <div class="form-floating">
                            <input type="text" name="name" class="form-control" id="floatingName" placeholder="Nome:" required>
                            <label for="floatingName">Nome:</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 col-lg-2 mb-1">
                        <div class="form-floating">
                            <input type="text" name="cpfcnpj" class="form-control" id="floatingCpfcnpj" placeholder="CPF ou CNPJ:" required>
                            <label for="floatingCpfcnpj">CPF ou CNPJ:</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 mb-1">
                        <div class="form-floating">
                            <input type="text" name="description" class="form-control" id="floatingDescription" placeholder="Descrição:">
                            <label for="floatingDescription">Descrição:</label>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4 col-lg-4 mb-1">
                        <div class="form-floating">
                            <input type="text" name="email" class="form-control" id="floatingEmail" placeholder="Email:" required>
                            <label for="floatingEmail">Email:</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 col-lg-2 mb-1">
                        <div class="form-floating">
                            <input type="text" name="phone" class="form-control" id="floatingPhone" placeholder="Telefone:">
                            <label for="floatingPhone">Telefone:</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 mb-1">
                        <div class="form-floating">
                            <input type="text" name="address" class="form-control" id="floatingPostalCode" placeholder="Endereço:">
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
                                <option value="1">Administrador</option>
                                <option value="2">Colaborador</option>
                            </select>
                            <label for="floatingSelect">Tipo</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 mb-1">
                        <div class="form-floating">
                            <input type="text" name="api_key" value="{{ Auth::user()->api_key }}" class="form-control" id="floatingApi" placeholder="KEY:">
                            <label for="floatingApi">KEY:</label>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-3 offset-md-9 offset-lg-9 col-lg-3">
                        <div class="btn-group w-100" role="group" aria-label="Basic outlined example">
                            <a href="{{ route('adm.create-user') }}" class="btn btn-outline-danger">Limpar</a>
                            <button type="submit" class="btn btn-outline-success">Atualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection