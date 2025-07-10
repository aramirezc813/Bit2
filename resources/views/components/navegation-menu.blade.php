<style>


</style>




<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                @can('panel')
                <div class="sb-sidenav-menu-heading" id="usuarioHeading">
                    Distribución del Personal
                    <span class="expand-icon"><i class="fa-solid fa-caret-down"></i></span>
                </div>
                <div class="submenu">
                <a class="nav-link" href="{{route('panel.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Panel
                </a>    
                <a class="nav-link" href="{{route('panel.index')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-border-none"></i></div>
                    Propuesta 
                </a>   

                 </div>  
                               
                @endcan




                <!-- Sección de usuarios con menú desplegable -->
                @can('perfilpersonal')
                <div class="sb-sidenav-menu-heading" id="usuarioHeading">
                    Usuario
                    <span class="expand-icon"><i class="fa-solid fa-caret-down"></i></span>
                </div>
                <div class="submenu">
                    <a class="nav-link" href="{{route('perfilC')}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-address-card"></i></div>
                        Perfil
                    </a>
                    @can('perfilpasw')
                    <a class="nav-link" href="{{route('password')}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-key"></i></div>
                        Contraseñas
                    </a>
                    @endcan
                </div>
                @endcan

                <!-- Sección de información con menú desplegable -->
               
                <div class="sb-sidenav-menu-heading" id="informacionHeading">
                    Información
                    <span class="expand-icon"><i class="fa-solid fa-caret-down"></i></span>
                </div>
               
                <div class="submenu">
                    @can('inventario')
                    <a class="nav-link" href="{{route('inventario.index')}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-folder-open"></i></div>
                        Inventario
                    </a>
                    @endcan

                    @can('categorias')
                
                    <a class="nav-link" href="{{route('categorias.index')}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-tag"></i></div>
                        Categorias 
                    </a>
                    @endcan

                </div>
               
                
                
                
               



               


                <!-- Sección de componentes con menú desplegable -->
                @can('componentes')
                <div class="sb-sidenav-menu-heading" id="componentesHeading">
                    Componentes
                    <span class="expand-icon"><i class="fa-solid fa-caret-down"></i></i></span>
                </div>
                <div class="submenu">
                    <a class="nav-link" href="{{route('componentes.index')}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard"></i></div>
                        Componentes
                    </a>
                    <a class="nav-link" href="{{route('ip.index')}}">
                        <div class="sb-nav-link-icon"><i class="fa-duotone fa-solid fa-chart-diagram"></i></div>
                        Ip
                    </a>
                    <a class="nav-link" href="{{route('area.index')}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-people-line"></i></div>
                        Areas
                    </a>
                    <a class="nav-link" href="{{route('roles.index')}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-person-circle-question"></i></div>
                        Roles
                    </a>
                    <a class="nav-link" href="{{route('equipos.index')}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-computer"></i></div>
                        Equipos
                    </a>
                    <a class="nav-link" href="{{route('estaciones.index')}}"> 
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users-between-lines"></i></div>
                        Estaciones
                    </a>
                </div>
                @endcan

                <!-- Sección de personal con menú desplegable -->
                @can('panel')
                <div class="sb-sidenav-menu-heading" id="personalHeading">
                    Personal
                    <span class="expand-icon"><i class="fa-solid fa-caret-down"></i></span>
                </div>
                <div class="submenu">
                    <a class="nav-link" href=" {{route('personal.index')}} ">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-person"></i></div>
                        Personal
                    </a>
                    <a class="nav-link" href=" {{route('horarios.index')}} ">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-clock"></i></div>
                        Horarios
                    </a>
                </div>
                @endcan

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Bienvenido:</div>
            {{Session('nombre')}}
        </div>
    </nav>
</div>




<script>
 document.addEventListener("DOMContentLoaded", function () {
    // Encuentra todos los elementos que contienen el título de los menús
    const menuHeadings = document.querySelectorAll('.sb-sidenav-menu-heading');

    menuHeadings.forEach(function (heading) {
        heading.addEventListener('click', function() {
            const submenu = this.nextElementSibling; // Encuentra el submenú correspondiente
            const icon = this.querySelector('.expand-icon'); // Encuentra el span que contiene la flecha

            if (submenu) {
                submenu.classList.toggle('open'); // Alterna la visibilidad del submenú
                icon.classList.toggle('open'); // Alterna la clase 'open' en el ícono para rotarlo
            }
        });
    });
});


</script>