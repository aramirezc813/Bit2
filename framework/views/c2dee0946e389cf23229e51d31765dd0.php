

<?php $__env->startSection('title','Crear Tipo de Componente'); ?>
<?php $__env->startPush('css'); ?>
<style>
    #descripcion{
    resize: none;
    }
    

</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Tipo de Componente</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="<?php echo e(route('panel.index')); ?>">Inicio</a></li>
            <li class="breadcrumb-item "><a href="<?php echo e(route('categorias.index')); ?>">Componentes</a></li>
            <li class="breadcrumb-item active">Crear Tipo de Componente</li>
        </ol>
   
    
</div>

<div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
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





<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    
<?php $__env->stopPush(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Bit2\resources\views/componentes/create.blade.php ENDPATH**/ ?>