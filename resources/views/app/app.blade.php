@extends('app.layout')
@section('title') Dashboard @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="row">

        @if($products->count() > 0)
            <div class="col-12 col-sm-12 col-md-7 col-lg-7 row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Vendas</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-basket"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $sale->count() }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="card info-card wallet-card">
                                <div class="card-body">
                                    <h5 class="card-title">Pedidos</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $order->count() }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Enviados</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $sent->count() }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($products->count() > 0)
                            <div class="col-12 mt-3">
                                <div class="card p-3">
                                    <h5 class="card-title">Produtos mais visitados</h5>
                                    
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-hover" id="table">
                                            <thead>
                                                <tr>
                                                    <th>Produto</th>
                                                    <th class="text-center">Visitas</th>
                                                    <th>EAN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td>{{ $product->name }}</td>
                                                        <td class="text-center">{{ $product->views }}</td>
                                                        <td>{{ $product->ean }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else 
            <div class="col-12 mt-3">
                <div class="alert alert-dark bg-dark text-light border-0 alert-dismissible fade show" role="alert">
                    Bem-vindo(a)! É hora de <a href="{{ route('adm.list-product') }}" class="text-danger">Criar seus primeiros Produtos</a>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="col-12 col-sm-12 col-md-5 col-lg-5 row">
            <div class="col-12 mb-3">
                <div class="card bg-dark mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8 d-flex flex-column justify-content-center py-4">
                                <p class="text-left text-white">Este é o seu catálogo digital</p>
                                <p class="card-text text-white">{{ Auth::user()->url }}</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 text-center d-flex flex-column align-items-center justify-content-center py-4">
                                <div id="qrcode"></div>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="{{ Auth::user()->url }}" class="card-link text-white" id="copyLink">Copiar link <i class="bx bx-copy"></i></a>
                                <a href="{{ Auth::user()->url }}" target="_blank" class="card-link text-white">Acessar meu catálogo <i class="bi bi-arrow-right-square"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Visitas ao seu catálogo</h5>
      
                        <canvas id="lineChart" style="max-height: 400px; display: block; box-sizing: border-box; height: 207px; width: 415px;" width="831" height="415"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new Chart(document.querySelector('#lineChart'), {
                                type: 'line',
                                data: {
                                    labels: @json($labels),
                                    datasets: [{
                                        label: 'Visualizações',
                                        data: @json($data),
                                        fill: false,
                                        borderColor: '#212529',
                                        tension: 0.1
                                    }]
                                },
                                options: {
                                    scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                    }
                                }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div> 
        </div>

        {{-- <div class="col-12 col-sm-12 col-md-7 col-lg-7 row">
            <div class="card">
                <div class="card-body pb-0">
                    <h5 class="card-title">Novidades &amp; Atualizações <span>| Recentes</span></h5>
                    
                    <div class="news">
                        <div class="post-item clearfix">
                            <img src="{{ asset('dashboard/img/assets/logo.png') }}" alt="">
                            <h4><a href="#"><i>Autor e Ceo</i> Thiago César</a></h4>
                            <p>Lança E-book "Solidão", performando o dia-a-dia do empreendedor brasileiro...</p>
                        </div>
        
                        <div class="post-item clearfix">
                            <img src="{{ asset('dashboard/img/assets/logo.png') }}" alt="">
                            <h4><a href="#"><i>Express da IFUTURE</i> franquia de SAAS</a></h4>
                            <p>É um bom vendedor ou precisa de um software com suporte dedicado conheça os SAAS...</p>
                        </div>
        
                        <div class="post-item clearfix">
                            <img src="{{ asset('dashboard/img/assets/logo.png') }}" alt="">
                            <h4><a href="#"><i>O plano de UI/Designer</i> mais vantajoso que plano de saúde</a></h4>
                            <p>IFUTURE lança designer por assinatura e meta, facilitando o empreendedor de acres...</p>
                        </div>
        
                        <div class="post-item clearfix">
                            <img src="{{ asset('dashboard/img/assets/logo.png') }}" alt="">
                            <h4><a href="#"><i>Sua rotina precisa</i> mais da sua atenção</a></h4>
                            <p>Com o APP health express você organiza a sua rotina e recebe benefícios por...</p>
                        </div>
        
                        <div class="post-item clearfix mb-3">
                            <img src="{{ asset('dashboard/img/assets/logo.png') }}" alt="">
                            <h4><a href="#"><i>Tudo começa pelo financeiro</i>, conheça o Buddy</a></h4>
                            <p>Gerenciador de cobraças, contas, tarefas e muito mais...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>
    document.getElementById('copyLink').addEventListener('click', function(event) {
        event.preventDefault();
        const link = this.href;

        navigator.clipboard.writeText(link).then(function() {
            Swal.fire({
                title: 'Sucesso!',
                text: 'Link copiado para sua área de trabalho!',
                icon: 'success',
                timer: 2000
            })
        }, function(err) {
            Swal.fire({
                title: 'Erro!',
                text: 'Não foi possível concluir essa operação!',
                icon: 'error',
                timer: 2000
            })
        });
    });

    document.addEventListener('DOMContentLoaded', function() {

        const qrCodeUrl = '{{ Auth::user()->url }}';

        const qrcode = new QRCode(document.getElementById("qrcode"), {
            text: qrCodeUrl,
            width: 100,
            height: 100,
            colorDark : "#ffffff",
            colorLight : "#212529",
            correctLevel : QRCode.CorrectLevel.L
        });
    });
</script>

@endsection