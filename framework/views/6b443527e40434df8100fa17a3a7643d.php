<?php
session_start();
?>


<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Bit" />
        <meta name="author" content="" />
        <title>Bit2 <?php echo $__env->yieldContent('title'); ?></title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="<?php echo e(asset('css/template.css')); ?>" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <?php echo $__env->yieldPushContent('css'); ?>
       
    </head>

<?php if(auth()->guard()->check()): ?>
<body class="sb-nav-fixed">

    <?php if (isset($component)) { $__componentOriginal42ac64488b9d0b8aab59d5c3be91c958 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42ac64488b9d0b8aab59d5c3be91c958 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navegation-header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navegation-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42ac64488b9d0b8aab59d5c3be91c958)): ?>
<?php $attributes = $__attributesOriginal42ac64488b9d0b8aab59d5c3be91c958; ?>
<?php unset($__attributesOriginal42ac64488b9d0b8aab59d5c3be91c958); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42ac64488b9d0b8aab59d5c3be91c958)): ?>
<?php $component = $__componentOriginal42ac64488b9d0b8aab59d5c3be91c958; ?>
<?php unset($__componentOriginal42ac64488b9d0b8aab59d5c3be91c958); ?>
<?php endif; ?>
    
            <div id="layoutSidenav">
                <?php if (isset($component)) { $__componentOriginal846827eb125a4f294fe995b795fa5275 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal846827eb125a4f294fe995b795fa5275 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navegation-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navegation-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal846827eb125a4f294fe995b795fa5275)): ?>
<?php $attributes = $__attributesOriginal846827eb125a4f294fe995b795fa5275; ?>
<?php unset($__attributesOriginal846827eb125a4f294fe995b795fa5275); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal846827eb125a4f294fe995b795fa5275)): ?>
<?php $component = $__componentOriginal846827eb125a4f294fe995b795fa5275; ?>
<?php unset($__componentOriginal846827eb125a4f294fe995b795fa5275); ?>
<?php endif; ?>
                
                <div id="layoutSidenav_content">
                    <main>
                        <?php echo $__env->yieldContent('content'); ?>
                       
                    </main>
    <?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
                </div>
            </div>
            <?php echo $__env->yieldPushContent('js'); ?>
             
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="<?php echo e(asset('js/scripts.js')); ?>"></script>
       
        </body>
<?php endif; ?>
<?php if(auth()->guard()->guest()): ?>
     <?php echo $__env->make('pages.401', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

</html>
<?php /**PATH C:\xampp\htdocs\Bit2\resources\views/template.blade.php ENDPATH**/ ?>