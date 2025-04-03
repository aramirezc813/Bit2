
<?php $__env->startSection('title','Inventario'); ?>

<?php $__env->startPush('css'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

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
        <h1 class="mt-4 text-center">Inventario</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "> <a href="<?php echo e(route('perfilC')); ?>"> Inicio</a></li>
            <li class="breadcrumb-item active">Inventario</li>
        </ol>
        <div class="mb-4"> 
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Añadir Bien
            </button> 
        </div>
    </div> 

    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Inventario
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-striped">   
                        <thead>
                            <tr>
                                <th>Numero de Inventario</th>
                                <th>Numero de Serie</th>
                                <th>Tipo de Componente</th>
                                <th>Categoria</th>
                                <th>Estado</th>
                                <th>Asignado</th>                                                                                       
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $inventario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php if($inv->estado == "Uso"): ?>
                                    <tr id="tablaverde">
                                <?php elseif($inv->estado == "Resguardo"): ?>
                                    <tr id="tablaamarillo">
                                <?php elseif($inv->estado == "Baja"): ?>
                                    <tr id="tablarojo">
                                <?php endif; ?>  
                                    <td> <?php echo e($inv->numeroinventario); ?> </td>
                                    <td> <?php echo e($inv->numeroserie); ?>   </td>
                                    <td><?php echo e($inv->componente); ?>  </td>
                                    <td> <?php echo e($inv->categoria); ?>  </td>
                                    <td>
                                         <?php if($inv->estado=="Uso"): ?>
                                            <span class="span-fijo fw-bolder p-1 rounded bg-success text-white"><?php echo e($inv->estado); ?></span>                              
                                        <?php elseif($inv->estado=="Resguardo"): ?>
                                            <span class="span-fijo fw-bolder p-1 rounded bg-warning text-white"><?php echo e($inv->estado); ?></span>   
                                        <?php else: ?>
                                            <span class="span-fijo fw-bolder p-1 rounded bg-danger text-white"><?php echo e($inv->estado); ?></span>  
                                        <?php endif; ?> 
                                    </td>   
                                    <th>
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">   
                                             <form action="<?php echo e(route('inventario.edit', ['inventario' => $inv->id_inventario])); ?>" method="GET">   
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" title='Editar' class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>
                                            </form> 
                                            <?php if($inv->estado != "Baja"): ?>
                                                <button type="button" class="btn btn-danger" title='Eliminar' data-bs-toggle="modal" data-bs-target="#confirmacionModal-<?php echo e($inv->id_inventario); ?>-<?php echo e($inv->estado); ?>"> <i class="fa-solid fa-trash"></i></button>
                                            <?php else: ?>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmacionModal-<?php echo e($inv->id_inventario); ?>-<?php echo e($inv->estado); ?>">Restaurar</button>
                                            <?php endif; ?>
                                        </div>
                                    </th>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Numero de Inventario</th>
                                <th>Numero de Serie</th>
                                <th>Tipo de Componente</th>
                                <th>Categoria</th>
                                <th>Estado</th>
                                <th>Asignado</th>   
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>    
    </div>

    <!-- Modal para añadir un bien -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Añadir Bien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('inventario.store')); ?>" method="POST"> 
                        <?php echo csrf_field(); ?>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="numInventario" class="form-label">Numero de Inventario:</label>
                                <input type="text" name="numeroInventario" id="numeroInventario" class="form-control"  required />
                                 
                            </div>
                            <div class="col-md-12">
                                <label for="numSerie" class="form-label">Numero de Serie:</label>
                                <input type="text" name="numeroSerie" id="numeroSerie" class="form-control"   required />
                                
                            </div>
                            <div class="col-md-12">
                                <label for="nombre" class="form-label">Categoria del bien:</label>
                                <select data-live-search="true" name="tipoCat" class="form-control show-tick selectpicker" id="documentSelect">    
                                    <optgroup label="Selecciona la categoria:">
                                        <option value="2"><b>Sin argumento</b></option>
                                    </optgroup>
                                    <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ob->id); ?>"><?php echo e($ob->nombre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                </select>
                            </div>
                            <div class="col-md-12"> 
                                <select name="tipoComp" class="form-control" id="sel2" style="display:none;">
                                    <option value="2"><b>Componente.</b></option>
                                </select>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>   
<?php $__env->stopSection(); ?> 

<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function(){
            // Initializes the selectpicker
            $('.selectpicker').selectpicker();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const selectDocumentos = document.getElementById('documentSelect');
            const subcategoriaSelect = document.getElementById('sel2');

            selectDocumentos.addEventListener('change', async function() {
                const idDocumento = selectDocumentos.value;

                if (idDocumento === "0") {
                    subcategoriaSelect.style.display = 'none';
                } else {
                    subcategoriaSelect.style.display = 'block';
                    try {
                        const response = await fetch("<?php echo e(route('realizarconsulta')); ?>", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                            },
                            body: JSON.stringify({ id: idDocumento })
                        });

                        if (!response.ok) {
                            throw new Error('Hubo un problema al enviar los datos.');
                        }

                        const data = await response.json();
                        if (data != null && data.uaS) {
                            subcategoriaSelect.innerHTML = "<option value='1'>Seleccione el tipo de Componente </option>";
                            data.uaS.forEach(element => {
                                subcategoriaSelect.innerHTML += `<option value='${element.id}'>${element.descripcion}</option>`;
                            });
                        } else {
                            subcategoriaSelect.style.display = "none";
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        subcategoriaSelect.style.display = "none";
                    }
                }
            });
        });
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('assets/demo/chart-area-demo.js')); ?>"></script>
<script src="<?php echo e(asset('assets/demo/chart-bar-demo.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('js/datatables-simple-demo.js')); ?>"></script> 
<script src="<?php echo e(asset('js/menusitos.js')); ?>"></script>   
    
<?php $__env->stopPush(); ?>


<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Bit2\resources\views/inventario/index.blade.php ENDPATH**/ ?>