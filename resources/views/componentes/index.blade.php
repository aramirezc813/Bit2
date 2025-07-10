@extends('template')
@section('title','Componentes')

@push('css')
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







<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Tipos de Componentes</h1>
        <ol class="breadcrumb mb-4">
             <li class="breadcrumb-item "><a href="{{route('perfilC')}}">Inicio</a></li> 
            <li class="breadcrumb-item active">Componentes</li>
        </ol>
    <div class="mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            Añadir Tipo de Componente
        </button> 

    </div>
</div>
<div class="container-fluid px-4">
<div class="card mb-4 " >
    <div class="card-header"   >
        <i class="fas fa-table me-1"></i>
        Tipo de Componentes
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table id="datatablesSimple" class="table table-striped">
            <thead >
                <tr >
                   
                   
                   <th>Descripcion</th>
                   <th>Categoria</th>     
                   <th>Estado</th>
                   <th>Acciones</th>
                   
                   
                </tr>
            </thead>
                @foreach ( $componentes as $com)
                
                        @if($com->id_estado==2)
                        <tr id="tablaazul" >
                        @else
                        <tr id="tablaneutro" >
                        @endif   
                           
                                                     
                            <td>{{$com->descripcion}}</td>
                            <td>{{$com->categoria}}</td>
                            <td>
                             @if($com->id_estado==2)
                            <span class="span-fijo fw-bolder p-1 rounded bg-primary text-white" >Activo</span>                              
                            @else
                            <span class="span-fijo fw-bolder p-1 rounded bg-secondary text-white">Desactivado</span>   
                            @endif 
                            
                        </td>   

                            <th>
                                
                               

                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">   
                                        <form action="{{ route('componentes.edit', ['componente' => $com->id ,$com->descripcion,$com->categoria]) }}" method="GET">  
                                            @csrf
                                            <button type="submit" title='Editar' class="btn btn-btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i></button>
                                        </form> 
                                        @if($com->id_estado==2)
                                        <button type="button" class="btn btn-danger" title='Eliminar'data-bs-toggle="modal" data-bs-target="#confirmacionModal-{{$com->id }}-{{$com->id_estado}}"><i class="fa-solid fa-trash"></i></button>
                                        @else
                                        <button type="button" class="btn btn-success" title='Restaurar'data-bs-toggle="modal" data-bs-target="#confirmacionModal-{{$com->id}}-{{$com->id_estado}}"><i class="fa-solid fa-trash-arrow-up"></i></button>

                                        @endif

                                    </div> 
                                
                                
                             </th>
                            
                              </tr>
                             <!-- Modal -->
                           <div class="modal fade" id="confirmacionModal-{{$com->id}}-{{$com->id_estado}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <strong>  {{$com->id_estado==2 ? '¿Esta seguro de eliminar esta categoria?':'¿Esta seguro de restaurar esta categoria?'}}</strong>
                                       
                                    
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <form action="{{route('componentes.destroy', ['componente' => $com->id ,$com->id_estado]) }}" method="post">  
                                         @method('DELETE')  
                                         @csrf
                                        <button type="submit" class="btn btn-primary">Confirmar</button>
                                         </form>  
                                    </div>
                                </div>
                                </div>
                            </div> 
                
            @endforeach    
            <tfoot>
                <tr>
                    
                    <th>Descripcion</th>  
                    <th>Categoria</th>                                           
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>

            <tbody>
                
                
               
               
            </tbody>
        </table>
    </div>
</div>

</div>
</div>    

<!-- INICIO Modal para AÑADIR una Categoria  -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Crear Componente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('componentes.store')}}" method="post">
                    @csrf
                    <div class="row g-3">
                       
                        <div class="col-md-12">
                            <label for="descripcion" class="form-label"> Descripcion</label>
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control">{{old('descripcion')}}</textarea>
                            @error('descripcion')
                                <small class="text-danger">{{'*'.$message}}</small>
                            @enderror
            
                        </div>
                        <div class="col-md-12">
                            <label for="nombre" class="form-label"> Categoria:</label>
                            <select name="categoria" class="form-control" id="sel1">
                                <optgroup label="Selecciona la Categoria:">
                                     <option value="2" selected readonly><b>Sin argumento</b></option>                        
                                </optgroup>
                                 @foreach ($categoria as $cat)
                                    
                                        <option value="{{ $cat->id }}"> {{ $cat->nombre}}</option>
                                        
                                   
                                @endforeach 
                            </select>
            
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary"> Guardar</button>
                        </div>
            
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>   

<!-- FIN  Modal para añadir una Categoria  -->



  




@endsection 

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{asset('js/datatables-simple-demo.js')}}"></script> 
<script src="{{asset('js/menusitos.js')}}"></script> 


@endpush