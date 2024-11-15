<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>@yield('title') - {{ env('APP_NAME') }}</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <link href="{{ asset('dashboard/img/logo.png') }}" rel="icon">

        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <link href="{{ asset('dashboard/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard/vendor/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard/vendor/simple-datatables/style.css') }}" rel="stylesheet">
        <link href="{{ asset('dashboard/css/style.css') }}" rel="stylesheet">

        <script src="{{ asset('dashboard/js/chart.js')}}"></script>
        <script src="{{ asset('dashboard/js/sweetalert.js')}}"></script>
        <script src="{{ asset('dashboard/js/jquery.js') }}"></script>
    </head>

    <body>

        <header id="header" class="header fixed-top d-flex align-items-center">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('adm.app') }}" class="logo d-flex align-items-center">
                    <img src="{{ asset('dashboard/img/logo.png') }}">
                    <span class="d-none d-lg-block">{{ env('APP_NAME') }}</span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div>

            <div class="search-bar">
                <form class="search-form d-flex align-items-center" method="GET" action="{{ route('adm.search') }}">
                    <input type="text" name="search" placeholder="Pesquisar" title="Pesquisar">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">

                    <li class="nav-item d-block d-lg-none">
                        <a class="nav-link nav-icon search-bar-toggle " href="#"><i class="bi bi-search"></i></a>
                    </li>

                    <li class="nav-item dropdown">
                        {{-- <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="badge bg-danger badge-number">4</span>
                        </a> --}}

                        {{-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                            <li class="dropdown-header"> Você possui 4 notificações </li>
                            <li><hr class="dropdown-divider"></li>

                            @foreach ($notifications as $notification)
                                <a href="{{ route('view-notification', ['id' => $notification->id]) }}">
                                    <li class="notification-item">
                                        @if($notification->type == 1)
                                            <i class="bi bi-check-circle text-success"></i>
                                        @elseif ($notification->type == 2)
                                            <i class="bi bi-exclamation-circle text-warning"></i>
                                        @else
                                            <i class="bi bi-exclamation-diamond text-danger"></i>
                                        @endif
                                        <div>
                                            <h4>{{ $notification->name }}</h4>
                                            <p>{{ $notification->description }}</p>
                                        </div>
                                    </li>
                                </a>
                                <li> <hr class="dropdown-divider"> </li>
                            @endforeach
                            <li class="dropdown-footer"> <a href="#">Não há mais nada aqui.</a> </li>
                        </ul> --}}
                    </li>

                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            @if(Auth::user()->photo)
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Perfil" class="rounded-circle">
                            @else
                                <img src="{{ asset('dashboard/img/assets/profile.png') }}" alt="Perfil" class="rounded-circle">
                            @endif
                            <span class="dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6>{{ Auth::user()->name }}</h6>
                                <span>{{ Auth::user()->description }}</span>
                            </li>
                            <li> <hr class="dropdown-divider"> </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('adm.profile') }}">
                                    <i class="bi bi-person"></i>
                                    <span>Perfil</span>
                                </a>
                            </li>
                            <li> <hr class="dropdown-divider"> </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('adm.logout') }}">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sair</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>

        <aside id="sidebar" class="sidebar">

            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('adm.app') }}"> <i class="bi bi-grid"></i> <span>Dashboard</span> </a>
                </li>
                
                @if(Auth::user()->wallet)
                    <li class="nav-heading">Financeiro</li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ route('adm.wallet') }}"> <i class="bi bi-wallet2"></i> <span>Carteira</span> </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#forms-finan" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-bank"></i><span>Operações</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="forms-finan" class="nav-content collapse " data-bs-parent="#sidebar-nav">  
                            <li><a href="{{ route('adm.transfers') }}"> <i class="bi bi-circle"></i><span>Transferências</span> </a></li>
                            <li><a href="{{ route('adm.receivables') }}"> <i class="bi bi-circle"></i><span>Recebíveis</span> </a></li>
                            <li><a href="{{ route('adm.payments') }}"> <i class="bi bi-circle"></i><span>Pagamentos</span> </a></li>
                        </ul>
                    </li>
                @endif
                
                <li class="nav-heading">Gestão de Pedidos</li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#forms-sale" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-bag"></i><span>Vendas</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="forms-sale" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('adm.list-orders') }}"> <i class="bi bi-circle"></i><span>Vendas</span> </a>
                        </li>
                        <li>
                            <a href="{{ route('adm.list-coupons') }}"> <i class="bi bi-circle"></i><span>Cupons</span> </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#forms-marketing" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-camera2"></i><span>Marketing</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="forms-marketing" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('adm.list-banners') }}"> <i class="bi bi-circle"></i><span>Banners</span> </a>
                        </li>
                        <li>
                            <a href="{{ route('adm.list-links') }}"> <i class="bi bi-circle"></i><span>Links</span> </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-heading">Gestão de Estoque</li>
                
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#forms-product" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-box"></i><span>Produtos</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="forms-product" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('adm.list-product') }}"> <i class="bi bi-circle"></i><span>Produtos</span> </a>
                        </li>
                        <li>
                            <a href="{{ route('adm.list-categories') }}"> <i class="bi bi-circle"></i><span>Categorias</span> </a>
                        </li>
                    </ul>
                </li>

                @if (Auth::user()->type == 1)
                    <li class="nav-heading">Gestão de Pessoas</li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#forms-users" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-file-earmark-person"></i><span>Usuários</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="forms-users" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li> <a href="{{ route('adm.list-users', ['type' => 1]) }}"><i class="bi bi-circle"></i><span>Administradores</span></a> </li>
                            <li> <a href="{{ route('adm.list-users', ['type' => 3]) }}"><i class="bi bi-circle"></i><span>Colaboradores</span></a> </li>
                            <li> <a href="{{ route('adm.list-users', ['type' => 4]) }}"><i class="bi bi-circle"></i><span>Clientes</span></a> </li>
                        </ul>
                    </li>
                @endif
            </ul>

        </aside>

        <main id="main" class="main">
            @yield('conteudo')
        </main>

        <footer id="footer" class="footer">
            <div class="copyright"> &copy; Copyright <strong><span>{{ env('APP_NAME') }}</span></strong>. Todos os direitos reservados </div>
            <div class="credits"> Desenvolvido por <a href="https://ifuture.cloud/">IFUTURE CLOUD</a> </div>
        </footer>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/main.js') }}"></script>
        <script src="{{ asset('dashboard/js/mask.js') }}"></script>
        <script>
            @if(session('error'))
                Swal.fire({
                    title: 'Erro!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    timer: 5000
                })
            @endif
            
            @if(session('success'))
                Swal.fire({
                    title: 'Sucesso!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    timer: 5000
                })
            @endif

            document.addEventListener('DOMContentLoaded', function () {
                
                const deleteForms = document.querySelectorAll('form.delete');
                deleteForms.forEach(form => {
                    form.addEventListener('submit', function (event) {
                        
                        event.preventDefault();
                        Swal.fire({
                            title: 'Tem certeza?',
                            text: 'Você realmente deseja excluir este registro?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Sim',
                            confirmButtonColor: '#008000',
                            cancelButtonText: 'Não',
                            cancelButtonColor: '#FF0000',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
                
                var links = document.querySelectorAll('.confirm');
                links.forEach(function(link) {
                    link.addEventListener('click', function(event) {

                        event.preventDefault();
                        var message = this.getAttribute('data-message') || 'Tem certeza?';
                        
                        Swal.fire({
                            title: 'Tem certeza?',
                            text: 'Você realmente deseja executar esta ação?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Sim',
                            confirmButtonColor: '#008000',
                            cancelButtonText: 'Não',
                            cancelButtonColor: '#FF0000',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = link.href;
                            }
                        });
                    });
                });
            });
        </script>

    </body>
</html>