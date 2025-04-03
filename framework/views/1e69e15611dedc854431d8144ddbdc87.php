<style>


</style>




<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('panel')): ?>
                <div class="sb-sidenav-menu-heading" id="usuarioHeading">
                    Inicio
                    <span class="expand-icon"><i class="fa-solid fa-caret-down"></i></span>
                </div>
                <div class="submenu">
                <a class="nav-link" href="<?php echo e(route('panel.index')); ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Panel
                </a>    
                 </div>                
                <?php endif; ?>




                <!-- Sección de usuarios con menú desplegable -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('perfilpersonal')): ?>
                <div class="sb-sidenav-menu-heading" id="usuarioHeading">
                    Usuario
                    <span class="expand-icon"><i class="fa-solid fa-caret-down"></i></span>
                </div>
                <div class="submenu">
                    <a class="nav-link" href="<?php echo e(route('perfilC')); ?>">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-address-card"></i></div>
                        Perfil
                    </a>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('perfilpasw')): ?>
                    <a class="nav-link" href="<?php echo e(route('password')); ?>">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-key"></i></div>
                        Contraseñas
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- Sección de información con menú desplegable -->
               
                <div class="sb-sidenav-menu-heading" id="informacionHeading">
                    Información
                    <span class="expand-icon"><i class="fa-solid fa-caret-down"></i></span>
                </div>
               
                <div class="submenu">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventario')): ?>
                    <a class="nav-link" href="<?php echo e(route('inventario.index')); ?>">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-folder-open"></i></div>
                        Inventario
                    </a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('categorias')): ?>
                
                    <a class="nav-link" href="<?php echo e(route('categorias.index')); ?>">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-tag"></i></div>
                        Categorias 
                    </a>
                    <?php endif; ?>

                </div>
               
                
                
                
               



               


                <!-- Sección de componentes con menú desplegable -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('componentes')): ?>
                <div class="sb-sidenav-menu-heading" id="componentesHeading">
                    Componentes
                    <span class="expand-icon"><i class="fa-solid fa-caret-down"></i></i></span>
                </div>
                <div class="submenu">
                    <a class="nav-link" href="<?php echo e(route('componentes.index')); ?>">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard"></i></div>
                        Componentes
                    </a>
                    <a class="nav-link" href="<?php echo e(route('ip.index')); ?>">
                        <div class="sb-nav-link-icon"><i class="fa-duotone fa-solid fa-chart-diagram"></i></div>
                        Ip
                    </a>
                    <a class="nav-link" href="<?php echo e(route('area.index')); ?>">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-people-line"></i></div>
                        Areas
                    </a>
                    <a class="nav-link" href="<?php echo e(route('roles.index')); ?>">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-person-circle-question"></i></div>
                        Roles
                    </a>
                    <a class="nav-link" href="<?php echo e(route('equipos.index')); ?>">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-computer"></i></div>
                        Equipos
                    </a>
                    <a class="nav-link" href="<?php echo e(route('estaciones.index')); ?>"> 
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users-between-lines"></i></div>
                        Estaciones
                    </a>
                </div>
                <?php endif; ?>

                <!-- Sección de personal con menú desplegable -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('panel')): ?>
                <div class="sb-sidenav-menu-heading" id="personalHeading">
                    Personal
                    <span class="expand-icon"><i class="fa-solid fa-caret-down"></i></span>
                </div>
                <div class="submenu">
                    <a class="nav-link" href=" <?php echo e(route('personal.index')); ?> ">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-person"></i></div>
                        Personal
                    </a>
                    <a class="nav-link" href=" <?php echo e(route('horarios.index')); ?> ">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-clock"></i></div>
                        Horarios
                    </a>
                </div>
                <?php endif; ?>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Bienvenido:</div>
            <?php echo e(Session('nombre')); ?>

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


</script><?php /**PATH C:\xampp\htdocs\Bit2\resources\views/components/navegation-menu.blade.php ENDPATH**/ ?>