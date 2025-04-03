
<?php $__env->startSection('title','Categoria'); ?>

<?php $__env->startPush('css'); ?>
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
            let message="<?php echo e(session('success')); ?>"  
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
                title: message
            });
        </script>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <script>
        let message="<?php echo e(session('error')); ?>"  
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
            icon: "error",
            title: message
        });
    </script>
    <?php endif; ?>   

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Categorías</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="<?php echo e(route('perfilC')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Categorías</li>
    </ol>
    <div class="mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            Añadir una Categoría
        </button> 
    </div>
</div>

<div class="container-fluid px-3">
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Categorías
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-striped">  
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($cat->id_estado == 2): ?>
                                <tr id="tablaazul">
                            <?php else: ?>
                                <tr id="tablaneutro">
                            <?php endif; ?>   
                                <td><?php echo e($cat->nombre); ?></td>
                                <td><?php echo e($cat->descripcion); ?></td>
                                <td>
                                    <?php if($cat->id_estado == 2): ?>
                                        <span class="span-fijo fw-bolder p-1 rounded bg-primary text-white">Activo</span>                              
                                    <?php else: ?>
                                        <span class="span-fijo fw-bolder p-1 rounded bg-secondary text-white">Desactivado</span>   
                                    <?php endif; ?>
                                </td>   
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">   
                                        <form action="<?php echo e(route('categorias.edit', ['categoria' => $cat->id, $cat->nombre, $cat->descripcion])); ?>" method="GET">   
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" title ='Editar'class="btn btn-btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>
                                        </form> 
                                        <?php if($cat->id_estado == 2): ?>
                                            <button type="button" class="btn btn-danger" title='Eliminar' data-bs-toggle="modal" data-bs-target="#confirmacionModal-<?php echo e($cat->id); ?>-<?php echo e($cat->id_estado); ?>"><i class="fa-solid fa-trash"></i></button>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmacionModal-<?php echo e($cat->id); ?>-<?php echo e($cat->id_estado); ?>">Restaurar</button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal para eliminar Categoria -->
                            <div class="modal fade" id="confirmacionModal-<?php echo e($cat->id); ?>-<?php echo e($cat->id_estado); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                           <strong><?php echo e($cat->id_estado == 2 ? '¿Está seguro de eliminar esta categoría?' : '¿Está seguro de restaurar esta categoría?'); ?></strong> 
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <form action="<?php echo e(route('categorias.destroy', ['categoria' => $cat->id, $cat->id_estado])); ?>" method="post"> 
                                                 <?php echo method_field('DELETE'); ?>  
                                                 <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-primary">Confirmar</button>
                                            </form> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>                                       
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>    

<!-- Modal para Añadir una Categoría -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Crear Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('categorias.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nombre" class="form-label"> Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo e(old('nombre')); ?>">
                            <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e('*'.$message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-12">
                            <label for="descripcion" class="form-label"> Descripcion</label>
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control"><?php echo e(old('descripcion')); ?></textarea>
                            <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e('*'.$message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary"> Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
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

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Bit2\resources\views/categorias/index.blade.php ENDPATH**/ ?>