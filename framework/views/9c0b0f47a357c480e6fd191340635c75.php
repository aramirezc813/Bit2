
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
    <h1 class="mt-4 text-center">Editar Categoría</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="<?php echo e(route('panel.index')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo e(route('categorias.index')); ?>">Categorias</a></li>
            <li class="breadcrumb-item active">Editar Categoría</li>
        </ol>
    
</div>

<div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
     <form action="<?php echo e(route('categorias.update',['categoria'=> $categorias->id,$categorias->nombre,$categorias->descripcion ])); ?>" method="post">   
         <?php echo method_field('PATCH'); ?> 
        <?php echo csrf_field(); ?> 
        <div class="row g-3">
            <div class="col-md-12">   
                <label for="nombre" class="form-label"> Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control"value=<?php echo e(old('nombre' ,$categorias->nombre )); ?>>
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
                <textarea name="descripcion" id="descripcion" rows="3" class="form-control"><?php echo e(old('descripcion',$categorias->descripcion )); ?></textarea>
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
                <button type="submit" class="btn btn-primary"> Actualizar</button>
                <button type="reset" class="btn btn-secondary"> Restaurar</button>
            </div>

        </div>
     </form> 
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
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Bit2\resources\views/categorias/edit.blade.php ENDPATH**/ ?>