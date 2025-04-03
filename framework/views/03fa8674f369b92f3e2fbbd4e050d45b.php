
<?php $__env->startSection('title','Panel'); ?>
<?php $__env->startPush('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?php echo e(asset('css/menusitos.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

    
<?php $__env->startSection('content'); ?>
   
    <script>
      function onDragStart(event) {
      event
        .dataTransfer
        .setData('text/plain', event.target.id);
      event
      .currentTarget
      .style
      .backgroundColor ='blue';
    }
    
    function onDragOver(event) {
      event.preventDefault(); // Necesario para permitir el drop
    }
    
    function onDrop(event) {
      const id = event
        .dataTransfer
        .getData('text');
      const draggableElement = document.getElementById(id);
      const dropzone = event.target;
      dropzone.appendChild(draggableElement);
      event
      .dataTransfer
      .clearData();
    }

    </script>

 
   

<form action="<?php echo e(route('panel.store')); ?>" method="POST">
  <?php echo csrf_field(); ?> 
    <div class="tabs">
      <div class="tab-container">
    
        <div id="tab5" class="tab">
          <a href="#tab5"> STAFF</a>
          <div class="tab-content">
            <h2>STAFF</h2>
            <div class="example-parent">
      
              <div class="container text-center">
                      Estaciones de Trabajo
      
      
                  <div class="row row-cols-4">
                      
                      
                    <div class="col ">
                      
                      <div class="grid">
                       
                          
                          <div  name ="STI1"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> AnalistaB2 </div>
                          <div  name ="TTI-3"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> AnalistaB1</div>
                          <div  name ="DG"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> Diseño grafico</div>
                     
                        </div>   
                        
                    </div>

                    <div></div>
                    
                    <div class="col">
                      
                      <div class="grid">
                          <div  name ="RH"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> RH </div>
                          <div  name ="Svc"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> SVC </div>
                          <div  name ="JDACEFD"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> JDACEFD </div>
                          <div  name ="Catgem"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> Catgem </div>
                        
                        </div>                         
                    </div>
                    <div></div>              
                  </div>                  
                </div>         
          </div>      
          </div> 
        </div>   
        <div id="tab4" class="tab">
          <a href="#tab4"> ATI</a>
          <div class="tab-content">
            <h2>ATI</h2>
            <div class="example-parent">
      
              <div class="container text-center">
                      Estaciones de Trabajo
      
      
                  <div class="row row-cols-4">
                      
                      
                    <div class="col ">
                      
                      <div class="grid">
                       
                          
                          <div  name ="STI1"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> STI1 </div>
                          <div  name ="TTI-3"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> TTI-3</div>
                          <div  name ="RTI1"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> RTI1</div>
                         
                          
                        </div>   
                        
                    </div>

                    <div></div>
                    
                    <div class="col">
                      
                      <div class="grid">
                          <div  name ="TTI"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> TTI </div>
                          
                         
                         
                        </div>   
                      
                    </div>
                    
                    
                    
                  </div>
                </div>
               
          
          </div>
        
 
          </div> 
        </div>   
        <div id="tab3" class="tab"> 
          <a href="#tab3">Planta Baja</a>
          <div class="tab-content">
            <h2>Planta Baja</h2>
            <div class="example-parent">
      
              <div class="container text-center">
                      Estaciones de Trabajo
      
      
                  <div class="row row-cols-4">
                      
                      
                    <div class="col ">
                      
                      <div class="grid">
                       
                          
                          <div  name ="E63100"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63100  </div>
                          <div  name ="E63119"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63119</div>
                          <div  name ="E63101"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63101</div>
                          <div  name ="E63118"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63118</div>
                          <div  name ="E63102"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63102</div>
                          <div  name ="E63117"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63117</div>
                          <div  name ="E63103"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63103</div>
                          <div  name ="E63100"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63116</div>
                          <div  name ="E63100"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63104</div>
                          <div  name ="E63100"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63115</div>
                        </div>   
                    </div>
                    <div></div>
                    <div class="col">
                      
                      <div class="grid">
                          <div  name ="E63100"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63105 </div>
                          <div  name ="E63119"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63114</div>
                          <div  name ="E63101"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63106</div>
                          <div  name ="E63118"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63113</div>
                          <div  name ="E63102"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63107</div>
                          <div  name ="E63117"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63112</div>
                          <div  name ="E63103"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63108</div>
                          <div  name ="E63100"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63111</div>
                          <div  name ="E63100"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63109</div>
                          <div  name ="E63100"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63110</div>
                         
                         
                        </div>   
                      
                    </div>
                    
                    
                  </div>
                </div>
               
          
               </div>
          
         

          </div>
        
          
        </div>
        <div id="tab2" class="tab">
          <a href="#tab2">Planta Alta </a>
          <div class="tab-content">
            <h2>Planta Alta </h2>
            <div class="example-parent">
      
              <div class="container text-center">
                      Estaciones de Trabajo
      
      
                  <div class="row row-cols-4">
                      
                      
                    <div class="col ">
                      
                      <div class="grid">
                       
                          
                          <div  name ="E63100"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63200  </div>
                          <div  name ="E63119"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63209</div>
                          <div  name ="E63101"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63201</div>
                          <div  name ="E63118"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63208</div>
                          <div  name ="E63102"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63202</div>
                          <div  name ="E63117"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63207</div>
                          <div  name ="E63103"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63203</div>
                          <div  name ="E63100"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63206</div>
                          <div  name ="E63100"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63204</div>
                          <div  name ="E63100"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> E63205</div>
                        </div>   
                    </div>
                    <div></div>
                
                    
                    
                  </div>
                </div>
               
          
          </div>
 
          </div>
    
          
        </div> 
        <div id="tab1" class="tab">
          <a href="#tab1">  Recepcion</a>
          <div class="tab-content">
            <h2>Recepcion</h2>
            <div class="example-parent">
      
              <div class="container text-center">
                      Estaciones de Trabajo
      
      
                  <div class="row row-cols-4">
                      
                      
                    <div class="col ">
                      
                      <div class="grid">
                       
                          
                          <div  name ="Recepcion"class="grid-item card shadow " ondragover="onDragOver(event);" ondrop="onDrop(event);"> Recepción  </div>
                          
                        </div>   
                    </div>
                    <div></div>
                
                    
                    
                  </div>
                </div>
               
          
          </div>
  
          </div>
    
          
        </div> 
    
      </div>

      <div class="example-origin ">
        <div class="container text-center">
          Personal
          </div>
       
        <?php $__currentLoopData = $personal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $persona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>      
        <button id="draggable-<?php echo e($persona->nombre); ?>" class="example-draggable btn btn-primary m-2 shadow" draggable="true" ondragstart="onDragStart(event);" aria-grabbed="true">
          <?php echo e($persona->nombre); ?>

          <span class="tooltip-text"> Jornada Laboral: <?php echo e($persona->jlaborals); ?></span>
       </button>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
    



</div>

</div>
    <div class="col-12 text-center">
      <button type="submit" class="btn btn-success">Guardar Nueva Asignación</button>
    </div>

</form>

    

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo e(asset('assets/demo/chart-area-demo.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/demo/chart-bar-demo.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo e(asset('js/datatables-simple-demo.js')); ?>"></script> 
    <script src="<?php echo e(asset('js/menusitos.js')); ?>"></script> 
<?php $__env->stopPush(); ?>

</body>

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Bit2\resources\views/panel/index.blade.php ENDPATH**/ ?>