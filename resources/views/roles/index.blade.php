@extends('template')
@section('title','roles')

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
    title: "Rol creada correctamente "
    });
    </script>
@endif



<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Tipos de roles CATGEM</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="{{route('panel.index')}}">Inicio</a></li>
            <li class="breadcrumb-item active">Información</li>
        </ol>
     <div class="mb-4">
        {{-- <a href="{{route('personal.create')}}"><button type="button" class="btn btn-primary">Añadir Personal</button></a> --}}
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            Añadir Rol
        </button> 

    </div> 
    
</div>
<div class="container-fluid px-4">
<div class="card mb-4 " >
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Personal adscrito al CATGEM
    </div>
    <div class="card-body">

         <table id="datatablesSimple" class="table table-striped">  
            <thead>
                <tr>
                   <th>Rol</th>
                   <th>Acción</th>
                   
                </tr>
            </thead>
            @foreach ( $rol as $roles)
            
             <tr id="tablaazul" >
             
             
                    
                    <td>{{$roles->name}} </td>
                  
                    <td> 
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" title='Eliminar' class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        
                            <button type="button" title='Editar'class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></button>
                          </div>
                   
                    </td>
                 <!-- Modal -->
               {{--  <div class="modal fade" id="verModal-{{$roles->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                           <label for=""><span class="fw-bolder"> Nombre: </span>{{$persona->nombre}}</label> 
                        </div>
                        <div class="row mb-3">
                            <div>
                                
                                @if($persona->foto != null )
                                <img src="{{Storage::url('public/personal/'.$persona->foto)}}"  class="img-fluid .img-thumbnail" alt="xddd">
                                
                                @else

                                @endif
                            </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        
                        </div>
                    </div>
                    </div>
                </div>  --}}
                        

                </tr>
                
            @endforeach 
            <tfoot>
                <tr>
                    <th>Rol</th>
                   <th>Acción</th>
                </tr>
            </tfoot>

            <tbody>
                
                
               
               
            </tbody>
        </table>
    </div>
</div>
</div>    

 

<!-- INICIO Modal para AÑADIR personal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Añadir Rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario dentro del modal -->
               
                <form   action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <!-- Campo Nombre -->
                        <div class="col-md-12">
                            <label for="nombre" class="form-label"required><i class="fa-solid fa-person-circle-question"></i> Nombre del Rol: </label> 
                            <input type="text" name="name"  class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                           <!-- Campo Permiso -->
                           <div class="col-md-12">
                            <label for="nombre" class="form-label" required><i class="fa-solid fa-key"></i> Permisos para Rol: </label>
                            @foreach ($permisos as $item)
                            <div class="form-check mb-2">
                                <input type="checkbox" name="permission[]" id="{{$item->name}}" class="form-check-input" value="{{$item->name}}"
                                @if($item->name == 'perfilpersonal' || $item->name == 'perfilpasw' ) checked @endif>
                                <label for="{{$item->name}}" class="form-check-label"> {{$item->name}} </label>
                            </div>
                             @endforeach
                        
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