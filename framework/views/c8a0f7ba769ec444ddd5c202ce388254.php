
<?php $__env->startSection('title','Estaciones'); ?>

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
            let message = "<?php echo e(session('success')); ?>"
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
            let message = "<?php echo e(session('error')); ?>"
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
        <h1 class="mt-4 text-center">Estaciones</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="<?php echo e(route('perfilC')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Estaciones</li>
        </ol>
        <div class="mb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Añadir una Estación
            </button>
        </div>
    </div>

    <div class="container-fluid px-3">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Estaciones
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Descripción</th>
                                <th>Área</th>
                                <th>IP</th>
                                <th>Asignado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $estaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php switch($estacion->asignado):
                                    case (2): ?>
                                        <tr id="tablaazul">
                                            <?php break; ?>
                                    <?php case (1): ?>
                                        <tr id="tablaneutro">
                                            <?php break; ?>
                                    <?php case (3): ?>
                                        <tr id="tablaverde">
                                            <?php break; ?>
                                <?php endswitch; ?>

                                <td><?php echo e($estacion->descripcion); ?></td>
                                <td><?php echo e($estacion->area_descripcion); ?></td>
                                <td>10.40.130.<?php echo e($estacion->ip_descripcion); ?></td>
                                <td>
                                    <?php switch($estacion->asignado):
                                        case (1): ?>
                                            <span class="span-fijo fw-bolder p-1 rounded bg-secondary text-white">Desactivado</span>
                                            <?php break; ?>
                                        <?php case (2): ?>
                                            <span class="span-fijo fw-bolder p-1 rounded bg-primary text-white">Activo</span>
                                            <?php break; ?>
                                        <?php case (3): ?>
                                            <span class="span-fijo fw-bolder p-1 rounded bg-success text-white">Uso</span>
                                            <?php break; ?>
                                    <?php endswitch; ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <form action="<?php echo e(route('estaciones.edit', ['estaciones' => $estacion->id, $estacion->id_ip])); ?>" method="GET">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" title="Editar" class="btn btn-btn btn-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </form>

                                        <?php switch($estacion->asignado):
                                            case (2): ?>
                                                <button type="button" class="btn btn-danger" title="Eliminar" data-bs-toggle="modal" data-bs-target="#confirmacionModal--<?php echo e($estacion->id); ?>">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <?php break; ?>

                                            <?php case (1): ?>
                                                <button type="button" class="btn btn-secondary" title="Restaurar" data-bs-toggle="modal" data-bs-target="#confirmacionModal--<?php echo e($estacion->id); ?>">
                                                    <i class="fa-solid fa-user-plus"></i>
                                                </button>
                                                <?php break; ?>

                                            <?php case (3): ?>
                                                <button type="button" class="btn btn-success" title="Liberar" data-bs-toggle="modal" data-bs-target="#confirmacionModal--<?php echo e($estacion->id); ?>">
                                                    <i class="fa-solid fa-unlock"></i>
                                                </button>
                                                <?php break; ?>

                                            <?php default: ?>
                                        <?php endswitch; ?>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal para manejar todas las acciones de la estación -->
                            <div class="modal fade" id="confirmacionModal--<?php echo e($estacion->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                           

                                            


                                            <?php switch($estacion->asignado):
                                            case (2): ?>
                                                <strong id="modalMessage--<?php echo e($estacion->id); ?>">
                                                    ¿Está seguro de Desactivar esta estación? 
                                                    <br>
                                                    <span class="nota">NOTA: Al hacerlo todos los componentes serán desvinculados de la misma, INCLUYENDO USUARIOS.</span>
                                                </strong>
                                                <?php break; ?>
                                        
                                            <?php case (1): ?>
                                                <strong id="modalMessage--<?php echo e($estacion->id); ?>">
                                                    ¿Está seguro de reactivar esta estación?
                                                </strong>
                                                <?php break; ?>
                                        
                                            <?php case (3): ?>
                                                <strong id="modalMessage--<?php echo e($estacion->id); ?>">
                                                    ¿Está seguro de liberar esta estación? 
                                                    <br>
                                                    <span class="nota">NOTA: Al hacerlo todos los componentes serán desvinculados de la misma, INCLUYENDO USUARIOS.</span>
                                                </strong>
                                                <?php break; ?>
                                        
                                            <?php default: ?>
                                                <strong id="modalMessage--<?php echo e($estacion->id); ?>">Acción desconocida para esta estación.</strong>
                                        <?php endswitch; ?>
                                        

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <!-- Formulario que pasa la acción al controlador -->
                                            <form id="formAction" action="<?php echo e(route('estaciones.cambios', ['estacione' => $estacion->id,$estacion->id_ip,$estacion->asignado])); ?>" method="POST">
                                           
                                                <?php echo csrf_field(); ?>
                                                <!-- Campo oculto para pasar el tipo de acción (desactivar, activar, liberar) -->
                                                <input type="hidden" name="action_type" id="action_type--<?php echo e($estacion->id); ?>">
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
                                <th>Descripción</th>
                                <th>Área</th>
                                <th>IP</th>
                                <th>Asignado</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
<!-- Modal para Añadir una Estación -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Añadir Estación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('estaciones.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo e(old('nombre')); ?>">
                            <?php $__errorArgs = ['nombre'];
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
                        <!-- IP -->
                        <div class="col-md-12">
                            <label for="ip" class="form-label">
                                <i class="fas fa-laptop-house"></i> IP designada a la Estación:
                            </label>
                            <select data-live-search="true" name="ip" id="ip" class="form-control selectpicker show-tick">
                                <option value="2"><b>Sin argumento</b></option>
                                <?php $__currentLoopData = $ip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($ob->id); ?>">10.40.130.<?php echo e($ob->descripcion); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        
                        <!-- Área -->
                        <div class="col-md-12">
                            <label for="area" class="form-label">
                                <i class="fas fa-building"></i> Área designada a la Estación:
                            </label>
                            <select data-live-search="true" name="area" id="area" class="form-control selectpicker show-tick">
                                <option value="2"><b>Sin argumento</b></option>
                                <?php $__currentLoopData = $area; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($ob->id); ?>"><?php echo e($ob->descripcion); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Silla -->
                        <div class="col-md-12">
                            <label for="silla" class="form-label">
                                <i class="fas fa-chair"></i> Silla designada a la Estación:
                            </label>
                            <select data-live-search="true" name="silla" id="silla" class="form-control selectpicker show-tick">
                                <option value="2"><b>Sin argumento</b></option>
                                <?php $__currentLoopData = $silla; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($ob->id_inventario); ?>"><?php echo e($ob->numeroinventario . ' - ' . $ob->descripcion); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Archivero -->
                        <div class="col-md-12">
                            <label for="archivero" class="form-label">
                                <i class="fas fa-archive"></i> Archivero designado a la Estación:
                            </label>
                            <select data-live-search="true" name="archivero" id="archivero" class="form-control selectpicker show-tick">
                                <option value="2"><b>Sin argumento</b></option>
                                <?php $__currentLoopData = $archivero; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($ob->id_inventario); ?>"><?php echo e($ob->numeroinventario . ' - ' . $ob->descripcion); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
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

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Bit2\resources\views/estaciones/index.blade.php ENDPATH**/ ?>