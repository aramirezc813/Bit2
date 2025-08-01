<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>404 Error - Bit</title>
        <link href="{{asset('css/template.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="layoutError">
            <div id="layoutError_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center mt-4">
                                    <h1 class="display-1">401</h1>
                                    <p class="lead">No autorizado</p>
                                    <p>No tienepermiso para acceder a este recurso.</p>
                                    <a href="{{route('login')}}">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        Iniciar Sesión
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutError_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"> CATGEM</div>
                            <div>
                                <a href="https://chat2.edomex.gob.mx/catgemchat/Files/AvisoPrivacidadCATGEM.pdf">Aviso de Privacidad</a>
                                &middot;
                                <a  href="https://dgi.edomex.gob.mx/sites/dgi.edomex.gob.mx/files/images/POLITICA%20DE%20CALIDAD%20para%20sitio%20webpng_Page1.png" > Política de Calidad</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('js/scripts.js')}}"></script>
    </body>
</html>
