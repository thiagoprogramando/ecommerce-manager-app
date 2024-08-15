@extends('app.layout')
@section('title') Cupons @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Cupons</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Cupons</li>
        </ol>
    </nav>
</div>

<div class="btn-group mb-3" role="group" aria-label="Basic outlined example">
    <a href="{{ route('adm.create-coupon') }}" class="btn btn-outline-primary">Criar Cupom</a>
    <button type="button" class="btn btn-outline-primary" title="Excel"><i class="bi bi-list-check"></i></button>
    <button type="button" class="btn btn-outline-primary" title="PDF"><i class="bi bi-file-earmark-pdf"></i></button>
</div>

<section class="section">
    <div class="card p-5">
        <div class="card-body">
            <h5 class="card-title">Cupons</h5>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descrição </th>
                        <th scope="col">Detalhes</th>
                        <th scope="col" class="text-center">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                        <tr>
                            <th scope="row"><a href="#"><img src="assets/img/product-1.jpg" alt=""></a></th>
                            <td>{{ $coupon->name }} <br>
                                <span class="badge rounded-pill bg-primary">{{ \Illuminate\Support\Str::limit($coupon->description, 70) }}</span>
                            </td>
                            <td>{{ $coupon->percentage }}%<br>
                                <span class="badge bg-dark">Disponível: {{ $coupon->qtd }}</span>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('adm.deleted-coupon') }}" method="POST" class="delete">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $coupon->id }}">
                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                        <button type="submit" class="btn btn-outline-dark" title="Excluir Cupom"><i class="bi bi-trash"></i></button>
                                        <a href="{{ route('adm.view-coupon', ['id' => $coupon->id]) }}" class="btn btn-outline-dark" title="Editar Cupom"><i class="bi bi-pen"></i></a>
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