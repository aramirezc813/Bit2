
<?php $__env->startSection('title','personal'); ?>

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
    <h1 class="mt-4 text-center">Personal adscrito al CATGEM</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="<?php echo e(route('perfilC')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Información</li>
        </ol>
    <div class="mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            Añadir Personal
        </button> 

       
              

    </div> 
     

    
</div>
<div class="container-fluid px-4">
<div class="card mb-4 " >
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        PERSONAL CATGEM
    </div>
    <div class="card-body">
    <div class="table-responsive">
         <table id="datatablesSimple" class="table table-striped">  
            <thead>
                <tr>
                   <th>Nombre</th>
                   <th>Puesto</th>
                   <th>Estacion de Trabajo</th>
                   <th>Horario Laboral</th>
                   <th> Horario de Comida</th>
                   <th> Horario de Descanso</th>
                   <th> Estado</th>
                   <th> Opciones</th>
                </tr>
            </thead>
             <?php $__currentLoopData = $personal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $persona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php if($persona->id_estado==2): ?>
             <tr id="tablaverde" >
             <?php else: ?>
             <tr id="tablaneutro" >
             <?php endif; ?> 
                    
                    <td><?php echo e($persona->nombre); ?> </td>
                    <td> <?php echo e($persona->id_rol); ?>  </td>
                    <td><?php echo e($persona->estacion); ?> </td>
                    <td><?php echo e($persona->jlaborals); ?> </td>
                    <td><?php echo e($persona->hcomidas); ?> </td>
                    <td><?php echo e($persona->hdescansos); ?> </td>
                     <td>
                    <?php if($persona->estado=="Activo"): ?>
                   
                    <span class="span-fijo fw-bolder p-1 rounded bg-success text-white"><?php echo e($persona->estado); ?></span> 
                    <?php else: ?>  
                    <span class="span-fijo fw-bolder p-1 rounded bg-secondary text-white"><?php echo e($persona->estado); ?></span>   

                    </td>
                    
                    <?php endif; ?>
                    <td> 
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                            <?php if($persona->estado=="Activo"): ?>
                                <form action="<?php echo e(route('personal.edit', ['personal' => $persona->id_persona])); ?>" method="GET">   
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" title ='Editar'class="btn btn-btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>
                                </form>

                                <button type="button"  title="Baja" class="btn btn-danger "data-bs-toggle="modal" data-bs-target="#confirmacionModal-<?php echo e($persona->id_usuarios); ?>"><i class="fa-solid fa-user-xmark"></i></button>
                            <?php else: ?>
                                <button type="button" title='Restaurar'class="btn btn-success "data-bs-toggle="modal" data-bs-target="#confirmacionModal-<?php echo e($persona->id_persona); ?>"><i class="fa-solid fa-user-plus"></i></button>

                            <?php endif; ?>

                            <button type="button"  title="Ver " class="btn btn-warning"data-toggle="modal" data-target="#verModal-<?php echo e($persona->id_persona); ?>"><i class="fa-solid fa-eye"></i></button>
                            
                            <form action="<?php echo e(route('createpassword', ['personal' => $persona->id_persona])); ?>" method="GET">   
                               <?php echo csrf_field(); ?>
                                <button type="submit" title='Contraseñas' class="btn btn-btn btn-primary"><i class="fa-solid fa-key"></i></button>

                              





                            </form> 




                          </div>
                   
                    </td>

                     <!-- Modal para eliminar Categoria -->
                     <div class="modal fade" id="confirmacionModal-<?php echo e($persona->id_usuarios); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                               <strong><?php echo e($persona->estado=="Activo" ? '¿Está seguro de eliminar el registro de esta persona? ':'¿Está seguro de restaurar el registro de esta persona?'); ?></strong> 
                               
                            
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <form action="<?php echo e(route('personal.destroy', ['personal' => $persona->id_usuarios])); ?>" method="post"> 
                                 <?php echo method_field('DELETE'); ?>  
                                 <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-primary">Confirmar</button>
                             </form> 
                            </div>
                        </div>
                        </div>
                    </div>

                 <!-- Modal  mostrar personal -->
                <div class="modal fade" id="verModal-<?php echo e($persona->id_persona); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalles del Personal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <div class="row mb-3" >
                           <label for=""><span class="fw-bolder"> Nombre: </span><?php echo e($persona->nombre); ?></label> 
                        </div>
                        <div class="row mb-3">
                            <div>
                                
                                <?php if($persona->foto != null ): ?>
                                <img src="<?php echo e(url('Storage/personal/'.$persona->foto)); ?>"  class="img-fluid .img-thumbnail" alt="xddd">
                                
                                <?php else: ?>

                                <?php endif; ?>
                            </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        
                        </div>
                    </div>
                    </div>
                </div> 
                        

                </tr>
                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Puesto</th>
                    <th>Estacion de Trabajo</th>
                    <th>Horario Laboral</th>
                    <th> Horario de Comida</th>
                    <th> Horario de Descanso</th>
                    <th> Estado</th>
                    <th> Opciones</th>
                </tr>
            </tfoot>

            <tbody>
                
                
               
               
            </tbody>
        </table>
    </div>

</div>
    
</div>

<div class="mb-4 ">
      
         <form action="<?php echo e(route('vistaformato')); ?>" method="post" autocomplete="off" target="_blank">
        <?php echo csrf_field(); ?>
     
        <button type="submit" class="btn btn-success" >
            Imprimir Personal
        </button>
    </form>
</div> 
</div>    



<!-- INICIO Modal para AÑADIR personal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Añadir Personal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario dentro del modal -->
               
                <form action="<?php echo e(route('personal.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <!-- Campo Nombre -->
                        <div class="col-md-12">
                            <label for="nombre" class="form-label"required><i class="fa-solid fa-user-tie"></i> Nombre: </label> 
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
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-envelope txt-gray"></span>
                            <label for="validationDefault01" class="form-label txt-gray"><i class="fa-solid fa-envelope"></i> Correo: </span></label>
                            <input type="text" name="email"  class="form-control" id="validationDefault01" required />
                                            
                        </div>
                         
                        <div class="col-md-12">
                           <span class="glyphicon glyphicon-lock txt-gray"></span>
                           <label for="validationDefault01" class="form-label txt-gray"> <i class="fa-solid fa-lock"></i> Clave asignada para ingresar a la plataforma Bit2: </label>
                           <input type="text" name="password" value="<?php echo e($pwd); ?>" class="form-control" id="validationDefault01" readonly required />
                            
                        </div>
                
                        <!-- Campos Rol y Estación -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="rol" class="form-label"><i class="fa-solid fa-briefcase"></i> Rol:</label>
                                    <select data-live-search="true" name="rol" id="rol" class="form-control selectpicker show-tick">
                                        <optgroup label="Selecciona el Rol:">
                                            <option value="2"><b>Sin argumento</b></option>
                                        </optgroup>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($ob->name); ?>"><?php echo e($ob->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                
                                <div class="col-md-6">
                                    <label for="estacion" class="form-label">Estación:</label>
                                    <select data-size="8" data-live-search="true" name="estacion" id="estacion" class="form-control selectpicker show-tick">
                                        <optgroup label="Selecciona la Estación:">
                                            <option value="2"><b>Sin argumento</b></option>
                                        </optgroup>
                                        <?php $__currentLoopData = $estacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($ob->id); ?>"><b><?php echo e($ob->descripcion); ?></b></option>
                                            
                                            <option disabled>Área: <?php echo e($ob->area); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                
                        <!-- Campos Jornada Laboral y Horario de Comida -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="jlaboral" class="form-label"><i class="fa-solid fa-briefcase"></i> Jornada Laboral:</label>
                                    <select  data-live-search="true" name="jlaboral" id="jlaboral" class="form-control selectpicker show-tick">
                                        <optgroup label="Selecciona la Jornada Laboral:">
                                            <option value="2"><b>Sin argumento</b></option>
                                        </optgroup>
                                        <?php $__currentLoopData = $jlaborals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($ob->id); ?>"><?php echo e($ob->entrada); ?>-<?php echo e($ob->salida); ?></option>
                                            <option disabled>Días: <?php echo e($ob->descripcion); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                
                                <div class="col-md-6">
                                    <label for="hcomida" class="form-label"><i class="fa-solid fa-utensils"></i> Horario de Comida:</label>
                                    <select data-live-search="true" name="hcomida" id="hcomida" class="form-control selectpicker show-tick">
                                        <optgroup label="Selecciona el Horario de Comida:">
                                            <option value="2"><b>Sin argumento</b></option>
                                        </optgroup>
                                        <?php $__currentLoopData = $hcomidas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($ob->id); ?>"><?php echo e($ob->entrada); ?>-<?php echo e($ob->salida); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                
                        <!-- Campo Horario de Descanso -->
                        <div class="col-md-12">
                            <div class="row">
                                <!-- Campo Horario de Descanso -->
                                <div class="col-md-6">
                                    <label for="hdescanso" class="form-label"><i class="fa-solid fa-bed"></i> Horario de Descanso:</label>
                                    <select data-live-search="true" name="hdescanso" id="hdescanso" class="form-control selectpicker show-tick">
                                        <optgroup label="Selecciona el Horario de Descanso:">
                                            <option value="2"><b>Sin argumento</b></option>
                                        </optgroup>
                                        <?php $__currentLoopData = $hdescansos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($ob->id); ?>"><?php echo e($ob->entrada); ?> - <?php echo e($ob->salida); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                        
                                <!-- Campo Imagen con Vista Previa -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="w-100">
                                        <input type="file" name="imagen" id="imagen" accept="image/*" required class="form-control">
                                        <!-- Contenedor para la vista previa de la imagen -->
                                        <div id="vista-previa" style="margin-top: 10px; text-align: center;">
                                            <img id="imagen-previa" src="#" alt="Vista previa" style="max-width: 200px; display: none;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        
                            <div class="col-12 ">
                                <div class="form-check form-switch">
                                    <!-- Campo oculto para el estado del checkbox -->
                                    <input type="hidden" name="checkbox" value="false">  
                                              
                                    <!-- Checkbox (switch) -->
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="checkbox" value="true" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Enviar Credenciales </label>
                                </div>
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
    // Obtén el elemento de entrada de archivo y el contenedor de vista previa
    const inputImagen = document.getElementById('imagen');
    const vistaPrevia = document.getElementById('vista-previa');
    const imagenPrevia = document.getElementById('imagen-previa');

    // Agrega un evento para manejar el cambio en el campo de archivo
    inputImagen.addEventListener('change', function(event) {
        const archivo = event.target.files[0];

        if (archivo) {
            // Crea un objeto FileReader para leer la imagen
            const reader = new FileReader();

            // Define lo que sucede cuando la imagen es cargada
            reader.onload = function(e) {
                // Muestra la imagen cargada en el contenedor
                imagenPrevia.src = e.target.result;
                imagenPrevia.style.display = 'block';  // Mostrar la miniatura
            };

            // Lee la imagen seleccionada como URL de datos
            reader.readAsDataURL(archivo);
        }
    });
</script>





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
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Bit2\resources\views/personal/index.blade.php ENDPATH**/ ?>