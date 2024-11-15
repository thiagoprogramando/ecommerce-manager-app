@extends('app.layout')
@section('title') Perfil @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Perfil</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Perfil</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Mantenha seus dados atualizados.</h5>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 mb-3 text-center">
                    <div class="profile-photo">
                        @if(Auth::user()->photo)
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Perfil" class="img-thumbnail w-50">
                        @else
                            <img src="{{ asset('dashboard/img/assets/profile.png') }}" alt="Perfil" class="img-thumbnail w-50">
                        @endif
                    </div>

                    <button class="btn btn-dark mt-3" id="change-photo-button">Trocar foto de perfil</button>

                    <form action="{{ route('adm.update-user') }}" method="POST" enctype="multipart/form-data" id="photo-upload-form" class="d-none">
                        @csrf
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <input type="file" name="photo" id="photo-input" accept="image/*" onchange="document.getElementById('photo-upload-form').submit();">
                    </form>
                </div>

                <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                    <form action="{{ route('adm.update-user') }}" method="POST" class="row">
                        @csrf
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <div class="col-12 col-md-4 col-lg-4 mb-2">
                            <div class="form-floating">
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" id="floatingName" placeholder="Nome:">
                                <label for="floatingName">Nome:</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-lg-3 mb-2">
                            <div class="form-floating">
                                <input type="text" name="cpfcnpj" value="{{ Auth::user()->cpfcnpj }}" class="form-control" id="floatingCpfcnpj" placeholder="CPF ou CNPJ:">
                                <label for="floatingCpfcnpj">CPF ou CNPJ:</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-5 col-lg-5 mb-2">
                            <div class="form-floating">
                                <input type="text" name="description" value="{{ Auth::user()->description }}" class="form-control" id="floatingDescription" placeholder="Descrição:">
                                <label for="floatingDescription">Descrição:</label>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-4 col-lg-4 mb-2">
                            <div class="form-floating">
                                <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" id="floatingEmail" placeholder="Email:">
                                <label for="floatingEmail">Email:</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-lg-3 mb-2">
                            <div class="form-floating">
                                <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control" id="floatingPhone" placeholder="Telefone:">
                                <label for="floatingPhone">Telefone:</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-5 col-lg-5 mb-2">
                            <div class="form-floating">
                                <input type="text" name="address" value="{{ Auth::user()->address }}" class="form-control" id="floatingPostalCode" placeholder="Endereço:">
                                <label for="floatingPostalCode">Endereço:</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-7 col-lg-7 mb-2">
                            <div class="form-floating">
                                <input type="text" value="{{ Auth::user()->api_key }}" class="form-control" id="floatingApi" placeholder="KEY:" disabled>
                                <label for="floatingApi">KEY:</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-5 col-lg-5 mb-2">
                            <div class="form-floating">
                                <input type="text" value="{{ Auth::user()->wallet }}" class="form-control" id="floatingWallet" placeholder="Wallet:" disabled>
                                <label for="floatingWallet">Wallet:</label>
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

<script>
    document.getElementById('change-photo-button').addEventListener('click', function() {
        document.getElementById('photo-input').click();
    });
</script>

@endsection