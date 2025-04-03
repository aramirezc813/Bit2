
<?php $__env->startSection('title','Editar Categoria'); ?>

<?php $__env->startPush('css'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    
    <script>
        const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
    });
    Toast.fire({
    icon: "success",
    title: "Categoria creada correctamente "
    });
    </script>
<?php endif; ?>



<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Estaciones</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="<?php echo e(route('panel.index')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo e(route('estaciones.index')); ?>">Estaciones</a></li>
            <li class="breadcrumb-item active">Editar Categoría</li>
        </ol>
    
</div>

<div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
   
</div>

  

  




<?php $__env->stopSection(); ?> 

<?php $__env->startPush('js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('assets/demo/chart-area-demo.js')); ?>"></script>
<script src="<?php echo e(asset('assets/demo/chart-bar-demo.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('js/datatables-simple-demo.js')); ?>"></script> 
<script src="<?php echo e(asset('js/menusitos.js')); ?>"></script> 
<?php $__env->stopPush(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Bit2\resources\views/estaciones/edit.blade.php ENDPATH**/ ?>