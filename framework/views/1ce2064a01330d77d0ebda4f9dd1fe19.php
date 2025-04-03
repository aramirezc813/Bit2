
<?php $__env->startSection('title','Componentes'); ?>

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







<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Tipos de Componentes</h1>
        <ol class="breadcrumb mb-4">
             <li class="breadcrumb-item "><a href="<?php echo e(route('perfilC')); ?>">Inicio</a></li> 
            <li class="breadcrumb-item active">Componentes</li>
        </ol>
    <div class="mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            Añadir Tipo de Componente
        </button> 

    </div>
</div>
<div class="container-fluid px-4">
<div class="card mb-4 " >
    <div class="card-header"   >
        <i class="fas fa-table me-1"></i>
        Tipo de Componentes
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table id="datatablesSimple" class="table table-striped">
            <thead >
                <tr >
                   
                   
                   <th>Descripcion</th>
                   <th>Categoria</th>     
                   <th>Estado</th>
                   <th>Acciones</th>
                   
                   
                </tr>
            </thead>
                <?php $__currentLoopData = $componentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $com): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                        <?php if($com->id_estado==2): ?>
                        <tr id="tablaazul" >
                        <?php else: ?>
                        <tr id="tablaneutro" >
                        <?php endif; ?>   
                           
                                                     
                            <td><?php echo e($com->descripcion); ?></td>
                            <td><?php echo e($com->categoria); ?></td>
                            <td>
                             <?php if($com->id_estado==2): ?>
                            <span class="span-fijo fw-bolder p-1 rounded bg-primary text-white" >Activo</span>                              
                            <?php else: ?>
                            <span class="span-fijo fw-bolder p-1 rounded bg-secondary text-white">Desactivado</span>   
                            <?php endif; ?> 
                            
                        </td>   

                            <th>
                                
                               

                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">   
                                        <form action="<?php echo e(route('componentes.edit', ['componente' => $com->id ,$com->descripcion,$com->categoria])); ?>" method="GET">  
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" title='Editar' class="btn btn-btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i></button>
                                        </form> 
                                        <?php if($com->id_estado==2): ?>
                                        <button type="button" class="btn btn-danger" title='Eliminar'data-bs-toggle="modal" data-bs-target="#confirmacionModal-<?php echo e($com->id); ?>-<?php echo e($com->id_estado); ?>"><i class="fa-solid fa-trash"></i></button>
                                        <?php else: ?>
                                        <button type="button" class="btn btn-success" title='Restaurar'data-bs-toggle="modal" data-bs-target="#confirmacionModal-<?php echo e($com->id); ?>-<?php echo e($com->id_estado); ?>"><i class="fa-solid fa-trash-arrow-up"></i></button>

                                        <?php endif; ?>

                                    </div> 
                                
                                
                             </th>
                            
                              </tr>
                             <!-- Modal -->
                           <div class="modal fade" id="confirmacionModal-<?php echo e($com->id); ?>-<?php echo e($com->id_estado); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <strong>  <?php echo e($com->id_estado==2 ? '¿Esta seguro de eliminar esta categoria?':'¿Esta seguro de restaurar esta categoria?'); ?></strong>
                                       
                                    
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <form action="<?php echo e(route('componentes.destroy', ['componente' => $com->id ,$com->id_estado])); ?>" method="post">  
                                         <?php echo method_field('DELETE'); ?>  
                                         <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-primary">Confirmar</button>
                                         </form>  
                                    </div>
                                </div>
                                </div>
                            </div> 
                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
            <tfoot>
                <tr>
                    
                    <th>Descripcion</th>  
                    <th>Categoria</th>                                           
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>

            <tbody>
                
                
               
               
            </tbody>
        </table>
    </div>
</div>

</div>
</div>    

<!-- INICIO Modal para AÑADIR una Categoria  -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Crear Componente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('componentes.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                       
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
                        <div class="col-md-12">
                            <label for="nombre" class="form-label"> Categoria:</label>
                            <select name="categoria" class="form-control" id="sel1">
                                <optgroup label="Selecciona la Categoria:">
                                     <option value="2" selected readonly><b>Sin argumento</b></option>                        
                                </optgroup>
                                 <?php $__currentLoopData = $categoria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                        <option value="<?php echo e($cat->id); ?>"> <?php echo e($cat->nombre); ?></option>
                                        
                                   
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            </select>
            
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

<!-- FIN  Modal para añadir una Categoria  -->



  




<?php $__env->stopSection(); ?> 

<?php $__env->startPush('js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('assets/demo/chart-area-demo.js')); ?>"></script>
<script src="<?php echo e(asset('assets/demo/chart-bar-demo.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('js/datatables-simple-demo.js')); ?>"></script> 
<script src="<?php echo e(asset('js/menusitos.js')); ?>"></script> 


<?php $__env->stopPush(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Bit2\resources\views/componentes/index.blade.php ENDPATH**/ ?>