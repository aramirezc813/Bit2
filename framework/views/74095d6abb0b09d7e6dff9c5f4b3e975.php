<?php $__env->startComponent('mail::message'); ?>

    

    
       
            Sistema Bit2
            
            Asignacion de Credenciales

            
            Estimado(a): <?php echo e($datos['nombre']); ?>


            Se envian las credenciales para accesar al sistema.

            
            Usuario: <?php echo e($datos['email']); ?>

            Contraseña: <?php echo e($datos['password']); ?>


            
            Sin más por el momento reciba un cordial saludo de parte del 
            Area de Telefonía Informática del CATGEM.

            
       
    



<?php $__env->startComponent('mail::button', ['url' => 'https://catgem.edomex.gob.mx/Bit2/public/login']); ?> 
Bit2
<?php echo $__env->renderComponent(); ?> 
 


<?php echo $__env->renderComponent(); ?><?php /**PATH C:\xampp\htdocs\Bit2\resources\views/correo/bienvenido_md.blade.php ENDPATH**/ ?>