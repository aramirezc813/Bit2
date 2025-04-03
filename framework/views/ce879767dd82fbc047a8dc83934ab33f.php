
<?php $__env->startSection('title','roles'); ?>

<?php $__env->startPush('css'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">

<!-- jQuery (requerido para DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>

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
    title: "Rol creada correctamente "
    });
    </script>
<?php endif; ?>



<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Tipos de roles CATGEM</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="<?php echo e(route('panel.index')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Información</li>
        </ol>
     <div class="mb-4">
        
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            Añadir Rol
        </button> 

    </div> 
    
</div>
<div class="container-fluid px-4">
<div class="card mb-4 " >
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Personal adscrito al CATGEM
    </div>
    <div class="card-body">

         <table id="datatablesSimple" class="table table-striped">  
            <thead>
                <tr>
                   <th>Rol</th>
                   <th>Acción</th>
                   
                </tr>
            </thead>
            <?php $__currentLoopData = $rol; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roles): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
             <tr id="tablaazul" >
             
             
                    
                    <td><?php echo e($roles->name); ?> </td>
                  
                    <td> 
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" title='Eliminar' class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        
                            <button type="button" title='Editar'class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></button>
                          </div>
                   
                    </td>
                 <!-- Modal -->
               
                        

                </tr>
                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            <tfoot>
                <tr>
                    <th>Rol</th>
                   <th>Acción</th>
                </tr>
            </tfoot>

            <tbody>
                
                
               
               
            </tbody>
        </table>
    </div>
</div>
</div>    

 

<!-- INICIO Modal para AÑADIR personal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Añadir Rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario dentro del modal -->
               
                <form   action="<?php echo e(route('roles.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <!-- Campo Nombre -->
                        <div class="col-md-12">
                            <label for="nombre" class="form-label"required><i class="fa-solid fa-person-circle-question"></i> Nombre del Rol: </label> 
                            <input type="text" name="name"  class="form-control" value="<?php echo e(old('name')); ?>">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e('*' . $message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                           <!-- Campo Permiso -->
                           <div class="col-md-12">
                            <label for="nombre" class="form-label" required><i class="fa-solid fa-key"></i> Permisos para Rol: </label>
                            <?php $__currentLoopData = $permisos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-check mb-2">
                                <input type="checkbox" name="permission[]" id="<?php echo e($item->name); ?>" class="form-check-input" value="<?php echo e($item->name); ?>"
                                <?php if($item->name == 'perfilpersonal' || $item->name == 'perfilpasw' ): ?> checked <?php endif; ?>>
                                <label for="<?php echo e($item->name); ?>" class="form-check-label"> <?php echo e($item->name); ?> </label>
                            </div>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        </div>
                
                              
                        
                        <!-- Botón de guardar -->
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
                

               
            </div>
        </div>
    </div>
</div>   

<!-- FIN  Modal para añadir personal  -->

 
   




<?php $__env->stopSection(); ?> 

<?php $__env->startPush('js'); ?>







<script>
    $(document).ready(function(){
        // Initializes the selectpicker
        $('.selectpicker').selectpicker();
    });
</script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('assets/demo/chart-area-demo.js')); ?>"></script>
<script src="<?php echo e(asset('assets/demo/chart-bar-demo.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('js/datatables-simple-demo.js')); ?>"></script> 
<script src="<?php echo e(asset('js/menusitos.js')); ?>"></script> 
<?php $__env->stopPush(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Bit2\resources\views/roles/index.blade.php ENDPATH**/ ?>