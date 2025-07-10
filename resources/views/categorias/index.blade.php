@extends('template')
@section('title','Categoria')

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
    <h1 class="mt-4 text-center">Categorías</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('perfilC')}}">Inicio</a></li>
        <li class="breadcrumb-item active">Categorías</li>
    </ol>
    <div class="mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            Añadir una Categoría
        </button> 
    </div>
</div>

<div class="container-fluid px-3">
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Categorías
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-striped">  
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $cat)
                            @if($cat->id_estado == 2)
                                <tr id="tablaazul">
                            @else
                                <tr id="tablaneutro">
                            @endif   
                                <td>{{$cat->nombre}}</td>
                                <td>{{$cat->descripcion}}</td>
                                <td>
                                    @if($cat->id_estado == 2)
                                        <span class="span-fijo fw-bolder p-1 rounded bg-primary text-white">Activo</span>                              
                                    @else
                                        <span class="span-fijo fw-bolder p-1 rounded bg-secondary text-white">Desactivado</span>   
                                    @endif
                                </td>   
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">   
                                        <form action="{{ route('categorias.edit', ['categoria' => $cat->id, $cat->nombre, $cat->descripcion]) }}" method="GET">   
                                            @csrf
                                            <button type="submit" title ='Editar'class="btn btn-btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>
                                        </form> 
                                        @if($cat->id_estado == 2)
                                            <button type="button" class="btn btn-danger" title='Eliminar' data-bs-toggle="modal" data-bs-target="#confirmacionModal-{{$cat->id}}-{{$cat->id_estado}}"><i class="fa-solid fa-trash"></i></button>
                                        @else
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmacionModal-{{$cat->id}}-{{$cat->id_estado}}">Restaurar</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal para eliminar Categoria -->
                            <div class="modal fade" id="confirmacionModal-{{$cat->id}}-{{$cat->id_estado}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                           <strong>{{$cat->id_estado == 2 ? '¿Está seguro de eliminar esta categoría?' : '¿Está seguro de restaurar esta categoría?'}}</strong> 
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <form action="{{route('categorias.destroy', ['categoria' => $cat->id, $cat->id_estado]) }}" method="post"> 
                                                 @method('DELETE')  
                                                 @csrf
                                                <button type="submit" class="btn btn-primary">Confirmar</button>
                                            </form> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach  
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>                                       
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>    

<!-- Modal para Añadir una Categoría -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Crear Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('categorias.store')}}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nombre" class="form-label"> Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre')}}">
                            @error('nombre')
                                <small class="text-danger">{{'*'.$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="descripcion" class="form-label"> Descripcion</label>
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control">{{old('descripcion')}}</textarea>
                            @error('descripcion')
                                <small class="text-danger">{{'*'.$message}}</small>
                            @enderror
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

@endsection 

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
 <script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{asset('js/datatables-simple-demo.js')}}"></script> 
<script src="{{asset('js/menusitos.js')}}"></script> 
@endpush
