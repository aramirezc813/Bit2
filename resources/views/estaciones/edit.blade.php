@extends('template')
@section('title','Editar Categoria')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    title: "Categoria creada correctamente "
    });
    </script>
@endif



<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Estaciones</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="{{route('panel.index')}}">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="{{route('estaciones.index')}}">Estaciones</a></li>
            <li class="breadcrumb-item active">Editar Estacion</li>
        </ol>
    
</div>

<div class="container w-100 border border-3 border-primary rounded p-4 mt-3">


   {{--   <form action="{{route('categorias.update',['estaciones'=> $request->descripcion,$request->id ])}}" method="post">   
         @method('PATCH') 
        @csrf 
        <div class="row g-3">
            <div class="col-md-12">   
                <label for="nombre" class="form-label"> Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control"value={{old('nombre' ,$request->nombre )}}>
               

            </div>
            <div class="col-md-12">
                <label for="descripcion" class="form-label"> Descripcion</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="form-control">{{old('descripcion',$request->id )}}</textarea>
               

            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary"> Actualizar</button>
                <button type="reset" class="btn btn-secondary"> Restaurar</button>
            </div>

        </div>
     </form>  --}}
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