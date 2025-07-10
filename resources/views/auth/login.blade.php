<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Bit2</title>
    <link href="{{ asset('css/template.css'  , true   ) }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" /> 

    <style type="text/css">
        body {
            background-image: url({{ url('assets/img/loginimg4.jpg' ) }});/* ,[],true */
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-color: rgb(204, 209, 209);
        }

        .form-floating {
            position: relative;
        }

        #inputPassword {
            padding-right: 40px; /* Deja espacio para el ícono */
        }

        #togglePassword {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

       
        




    </style>

</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Bit2</h3>
                                </div>

                                <!-- Error handling -->
                               {{--  @if ($errors->any())
                                <div role="alert">
                                    @foreach ($errors->all() as $item)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $item }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                
                                    @endforeach
                                </div> --}}

                                @if (session('msj'))
                                <div role="alert">
                                    
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{session('msj')}}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                
                                  
                                </div>


         
                                @endif
{{-- 
                                @if(session('msj'))
                                <div class="alert alert-danger text-center m-2">
                                  <span>{{session('msj')}}</span>
                                </div>
                                @endif --}}



                                <div class="card-body">
                                     <!-- <form action="/login" method="POST"> -->
                                        <form action="{{route('login')}}" method="post" autocomplete="off">
                                        {{--  <form action="{{route( 'login',[],true)}}" method="POST">  --}}
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" autocomplete="username" />
                                            <label for="inputEmail">Correo electrónico</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Contraseña" autocomplete="current-password" />
                                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                                            <label for="inputPassword">Contraseña</label>
                                        </div>

                                        <!-- JavaScript para mostrar/ocultar la contraseña -->
                                        <script>
                                            const togglePassword = document.querySelector('#togglePassword');
                                            const password = document.querySelector('#inputPassword');

                                            togglePassword.addEventListener('click', () => {
                                                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                                password.setAttribute('type', type);
                                                togglePassword.classList.toggle('bi-eye');
                                            });
                                        </script>

                                        <div class="d-flex justify-content-center mt-4 mb-2">
                                            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted"> CATGEM</div>
                        <div>
                            <a href="https://chat2.edomex.gob.mx/catgemchat/Files/AvisoPrivacidadCATGEM.pdf">Aviso de Privacidad</a>
                            &middot;
                            <a href="https://dgi.edomex.gob.mx/sites/dgi.edomex.gob.mx/files/images/POLITICA%20DE%20CALIDAD%20para%20sitio%20webpng_Page1.png">Política de Calidad</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
