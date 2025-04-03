

<?php $__env->startSection('title','Contraseñas'); ?>
<?php $__env->startPush('css'); ?>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    #descripcion{
    resize: none;
    }
    

</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>




<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Perfil</h1>
        <ol class="breadcrumb mb-4">
             <li class="breadcrumb-item "><a href="<?php echo e(route('perfilC')); ?>">Inicio</a></li>         
            <li class="breadcrumb-item active">Contraseñas </li>
        </ol>
   
    
</div>

<div class="container-fluid px-4">
   <div class="card mb-4">
       <div class="card-header">
           <i class="fas fa-table me-1"></i>
           Personal "CATGEM"
       </div>
       <div class="card-body">
           <table id="datatablesSimple" class="table table-striped">
               <thead>
                   <tr>
                       <th>Sistema</th>
                       <th>Usuario</th>
                       <th>Contraseña</th>
                   </tr>
               </thead>
               <tbody>
                   <!-- Fila 1 -->
                   <tr >
                       <td>CRM-CATGEM</td>
                       <td>DROMEROL</td>
                       <td>DROMEROL</td>
                   </tr>
                   <!-- Fila 2 -->
                   <tr>
                       <td>FALLAS</td>
                       <td>DROMEROL</td>
                       <td>DROMEROL</td>
                   </tr>
                   <!-- Fila 3 -->
                   <tr>
                       <td>AVAYA AURA CALL CENTER ELITE MULTICHANNEL (AACCEM)</td>
                       <td>63073</td>
                       <td>63073</td>
                   </tr>
                   <!-- Fila 4 -->
                   <tr>
                       <td>EQUIPO DE COMPUTO</td>
                       <td>E63107</td>
                       <td>EpHxQSKE</td>
                   </tr>
               </tbody>
             
           </table>
       </div>
   </div>
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
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Bit2\resources\views/personal/password.blade.php ENDPATH**/ ?>