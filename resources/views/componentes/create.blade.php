@extends('template')

@section('title','Crear Tipo de Componente')
@push('css')
<style>
    #descripcion{
    resize: none;
    }
    

</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Tipo de Componente</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="{{route('panel.index')}}">Inicio</a></li>
            <li class="breadcrumb-item "><a href="{{route('categorias.index')}}">Componentes</a></li>
            <li class="breadcrumb-item active">Crear Tipo de Componente</li>
        </ol>
   
    
</div>

<div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
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





@endsection

@push('js')
    
@endpush