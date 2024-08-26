<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Gestão de Loja</title>
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
    </head>

    <body>
        <main>
            <div class="container">
                <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                                <div class="d-flex justify-content-center py-4">
                                    <a href="{{ route('adm.login') }}" class="logo d-flex align-items-center w-auto">
                                        <img src="{{ asset('dashboard/img/logo.png') }}" alt="">
                                        <span class="d-none d-lg-block">{{ env('APP_NAME') }}</span>
                                    </a>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="pt-4 pb-2">
                                            <h5 class="card-title text-center pb-0 fs-4">Faça login!</h5>
                                            <p class="text-center small">Para ter acesso aos benefícios da sua conta.</p>
                                        </div>

                                        <form action="{{ route('adm.logon') }}" method="POST" class="row g-3">

                                            @if (session('error'))
                                                <div class="alert alert-danger alert-dismissible" role="alert">
                                                    {{ session('error') }}
                                                </div>
                                            @endif

                                            @csrf
                                            <div class="col-12">
                                                <input type="text" name="email" class="form-control" placeholder="Email:" required>
                                            </div>
                                            <div class="col-12">
                                                <input type="password" name="password" class="form-control" placeholder="Senha:" required>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                                    <label class="form-check-label" for="rememberMe">Salvar dados</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-dark w-100" type="submit">Acessar</button>
                                            </div>
                                            <div class="col-12">
                                                <p class="small mb-0">Esqueceu algo? <a href="" class="text-danger">Recuperar conta</a></p>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="credits">
                                    Desenvolvido por <a href="https://ifuture.cloud/" class="text-danger">IFUTURE CLOUD</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('dashboard/vendor/quill/quill.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/main.js') }}"></script>
    </body>

</html>
