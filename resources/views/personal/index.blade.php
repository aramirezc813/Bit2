@extends('template')
@section('title','personal')

@push('css')
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

@endpush

@section('content')

@if (session('success'))
   
    <script>
        let message="{{session('success')}}"  
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
@endif

@if (session('error'))
    <script>
        let message="{{session('error')}}"  
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
    @endif   



<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Personal adscrito al CATGEM</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="{{route('perfilC')}}">Inicio</a></li>
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
             @foreach ( $personal as $persona)
             @if($persona->id_estado==2)
             <tr id="tablaverde" >
             @else
             <tr id="tablaneutro" >
             @endif 
                    
                    <td>{{$persona->nombre}} </td>
                    <td> {{$persona->id_rol}}  </td>
                    <td>{{$persona->estacion}} </td>
                    <td>{{$persona->jlaborals}} </td>
                    <td>{{$persona->hcomidas}} </td>
                    <td>{{$persona->hdescansos}} </td>
                     <td>
                    @if($persona->estado=="Activo")
                   
                    <span class="span-fijo fw-bolder p-1 rounded bg-success text-white">{{$persona->estado}}</span> 
                    @else  
                    <span class="span-fijo fw-bolder p-1 rounded bg-secondary text-white">{{$persona->estado}}</span>   

                    </td>
                    
                    @endif
                    <td> 
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                            @if($persona->estado=="Activo")
                                <form action="{{ route('personal.edit', ['personal' => $persona->id_persona]) }}" method="GET">   
                                    @csrf
                                    <button type="submit" title ='Editar'class="btn btn-btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>
                                </form>

                                <button type="button"  title="Baja" class="btn btn-danger "data-bs-toggle="modal" data-bs-target="#confirmacionModal-{{$persona->id_usuarios}}"><i class="fa-solid fa-user-xmark"></i></button>
                            @else
                                <button type="button" title='Restaurar'class="btn btn-success "data-bs-toggle="modal" data-bs-target="#confirmacionModal-{{$persona->id_persona}}"><i class="fa-solid fa-user-plus"></i></button>

                            @endif

                            <button type="button"  title="Ver " class="btn btn-warning"data-toggle="modal" data-target="#verModal-{{$persona->id_persona}}"><i class="fa-solid fa-eye"></i></button>
                       

                            <button type="button"  title='Contraseñas' class="btn btn-btn btn-primary" data-toggle="modal" data-target="#PwdModal-{{$persona->id_usuarios}}"><i class="fa-solid fa-key"></i></button>


                          </div>
                   
                    </td>

                     <!-- Modal para eliminar Categoria -->
                     <div class="modal fade" id="confirmacionModal-{{$persona->id_usuarios}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                               <strong>{{$persona->estado=="Activo" ? '¿Está seguro de eliminar el registro de esta persona? ':'¿Está seguro de restaurar el registro de esta persona?'}}</strong> 
                               
                            
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <form action="{{route('personal.destroy', ['personal' => $persona->id_usuarios]) }}" method="post"> 
                                 @method('DELETE')  
                                 @csrf
                                <button type="submit" class="btn btn-primary">Confirmar</button>
                             </form> 
                            </div>
                        </div>
                        </div>
                    </div>

                 <!-- Modal  mostrar personal -->
                <div class="modal fade" id="verModal-{{$persona->id_persona}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detalles del Personal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <label><span class="fw-bolder">Nombre:</span> {{$persona->nombre}}</label>
                                    </div>
                                    
                                    <div class="row mb-3 text-center">
                                        <div class="col">
                                            @if($persona->foto)
                                                <img src="{{ url('Storage/personal/'.$persona->foto) }}" class="img-fluid img-thumbnail" alt="Foto de {{$persona->nombre}}">
                                            @else
                                                <p>Sin fotografía registrada</p>
                                            @endif
                                        </div>
                                    </div>

                                    
                                        <div class="modal-footer">

                                            <form action="{{ route('personal.actualizarF') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id_usuarios" value="{{ $persona->id_usuarios }}">
                                                
                                                <input type="file" name="imagenA" id="imagenA" accept="image/*" required class="form-control">
                                                
                                                <div id="vista-previa" class="text-center mb-3">
                                                    <img id="imagen-previa" src="#" alt="Vista previa" style="max-width: 200px; display: none;">
                                                </div>

                                                <button type="submit" class="btn btn-warning">Actualizar Fotografía</button>
                                            </form> 

                                        </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>



                      <!-- Modal  Credenciales personal -->
                <div class="modal fade" id="PwdModal-{{$persona->id_usuarios}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detalles del Personal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <label><span class="fw-bolder">Nombre:</span> {{$persona->nombre}}</label>
                                    </div>
                                    
                                    
                                        <div class="modal-footer">

                                            <form action="{{ route('personal.actualizarF') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id_usuarios" value="{{ $persona->id_usuarios }}">
                                                
                                                <input type="file" name="imagenA" id="imagenA" accept="image/*" required class="form-control">
                                                
                                                <div id="vista-previa" class="text-center mb-3">
                                                    <img id="imagen-previa" src="#" alt="Vista previa" style="max-width: 200px; display: none;">
                                                </div>

                                                <button type="submit" class="btn btn-warning">Actualizar Fotografía</button>
                                            </form> 

                                        </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>

                        

                </tr>
                
            @endforeach 
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
     {{-- <form action="{{route('vistaformato')}}" method="post" autocomplete="off" class="row g-3" target="_blank">  // pa que se vea largotote--}} 
         <form action="{{route('vistaformato')}}" method="post" autocomplete="off" target="_blank">
        @csrf
     
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
               
                <form action="{{ route('personal.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <!-- Campo Nombre -->
                        <div class="col-md-12">
                            <label for="nombre" class="form-label"required><i class="fa-solid fa-user-tie"></i> Nombre: </label> 
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
                            @error('nombre')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-envelope txt-gray"></span>
                            <label for="validationDefault01" class="form-label txt-gray"><i class="fa-solid fa-envelope"></i> Correo: </span></label>
                            <input type="text" name="email"  class="form-control" id="validationDefault01" required />
                                            
                        </div>
                         
                        <div class="col-md-12">
                           <span class="glyphicon glyphicon-lock txt-gray"></span>
                           <label for="validationDefault01" class="form-label txt-gray"> <i class="fa-solid fa-lock"></i> Clave asignada para ingresar a la plataforma Bit2: </label>
                           <input type="text{{-- password --}}" name="password" value="{{$pwd}}" class="form-control" id="validationDefault01" readonly required />
                            
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
                                        @foreach ($roles as $ob)
                                            <option value="{{ $ob->name }}">{{ $ob->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                
                                <div class="col-md-6">
                                    <label for="estacion" class="form-label">Estación:</label>
                                    <select data-size="8" data-live-search="true" name="estacion" id="estacion" class="form-control selectpicker show-tick">
                                        <optgroup label="Selecciona la Estación:">
                                            <option value="2"><b>Sin argumento</b></option>
                                        </optgroup>
                                        @foreach ($estacion as $ob)
                                            <option value="{{ $ob->id }}"><b>{{ $ob->descripcion }}</b></option>
                                            
                                            <option disabled>Área: {{ $ob->area }}</option>
                                        @endforeach
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
                                        @foreach ($jlaborals as $ob)
                                            <option value="{{ $ob->id }}">{{ $ob->entrada}}-{{ $ob->salida}}</option>
                                            <option disabled>Días: {{ $ob->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                
                                <div class="col-md-6">
                                    <label for="hcomida" class="form-label"><i class="fa-solid fa-utensils"></i> Horario de Comida:</label>
                                    <select data-live-search="true" name="hcomida" id="hcomida" class="form-control selectpicker show-tick">
                                        <optgroup label="Selecciona el Horario de Comida:">
                                            <option value="2"><b>Sin argumento</b></option>
                                        </optgroup>
                                        @foreach ($hcomidas as $ob)
                                            <option value="{{ $ob->id }}">{{ $ob->entrada}}-{{ $ob->salida}}</option>
                                        @endforeach
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
                                        @foreach ($hdescansos as $ob)
                                            <option value="{{ $ob->id }}">{{ $ob->entrada }} - {{ $ob->salida }}</option>
                                        @endforeach
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


  




@endsection 

@push('js')

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
<script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{asset('js/datatables-simple-demo.js')}}"></script> 
<script src="{{asset('js/menusitos.js')}}"></script> 
@endpush