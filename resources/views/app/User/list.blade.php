@extends('app.layout')
@section('title') Usuários do sistema @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Usuários do sistema</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Usuários do sistema</li>
        </ol>
    </nav>
</div>

<div class="btn-group mb-3" role="group" aria-label="Basic outlined example">
    <a href="{{ route('adm.create-user') }}" class="btn btn-outline-primary">Criar Usuário</a>
    <button type="button" class="btn btn-outline-primary" title="Excel"><i class="bi bi-list-check"></i></button>
    <button type="button" class="btn btn-outline-primary" title="PDF"><i class="bi bi-file-earmark-pdf"></i></button>
</div>

<section class="section">
    <div class="card p-5">
        <div class="card-body">
            <h5 class="card-title">Usuários do sistema</h5>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome </th>
                        <th scope="col">Detalhes</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }} <br>
                                <span class="badge rounded-pill bg-primary">{{ $user->cpfcnpj }}</span>
                            </td>
                            <td>{{ $user->email }} <br>
                                <span class="badge rounded-pill bg-dark">{{ $user->phone }}</span>
                            </td>
                            <td>{{ $user->labelStatus() }}</td>
                            <td class="text-center">
                                <form action="{{ route('adm.deleted-user') }}" method="POST" class="delete">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                        <button type="submit" class="btn btn-outline-dark"><i class="bi bi-trash"></i></button>
                                        <a href="{{ route('adm.view-user', ['id' => $user->id]) }}" class="btn btn-outline-dark"><i class="bi bi-pen"></i></a>
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