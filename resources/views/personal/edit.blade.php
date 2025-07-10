@extends('template')
@section('title', 'Editar Personal')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            title: "Personal actualizado correctamente"
        });
    </script>
@endif

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Personal</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{ route('panel.index') }}">Inicio</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('personal.index') }}">Personal</a></li>
        <li class="breadcrumb-item active">Editar Personal</li>
    </ol>
</div>

<div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
    <form action="{{ route('personal.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
            <!-- Campo Nombre (No editable) -->
            <div class="col-md-6">
                <label for="nombre" class="form-label" required><i class="fa-solid fa-user-tie"></i> Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $personal[0]->nombre) }}" readonly>
            </div>

            <!-- Campo Rol (No editable) -->
            <div class="col-md-6">
                <label for="rol" class="form-label">Rol:</label>
                <!-- Mostrar el rol como texto sin permitir edición -->
                <input type="text" name="rol" id="rol" class="form-control" value="{{ old('rol', $personal[0]->id_rol) }}"  readonly>
            </div>

            <!-- Estación -->
            <div class="col-md-6">
                <label for="estacion" class="form-label">Estación:</label>
                <select name="estacion" id="estacion" class="form-control selectpicker show-tick">
                    @foreach ($estacion as $estaciones)
                        <option value="{{ $estaciones->id }}" {{ $estaciones->id == old('estacion', $personal[0]->id_estacion) ? 'selected' : '' }}>
                            <b>{{ $estaciones->descripcion }}</b>
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Jornada Laboral -->
            <div class="col-md-6">
                <label for="jlaboral" class="form-label">Jornada Laboral:</label>
                <select name="jlaboral" id="jlaboral" class="form-control selectpicker show-tick">
                    @foreach ($jlaborals as $jl)
                        <option value="{{ $jl->id }}" {{ $jl->id == old('jlaboral', $personal[0]->id_jlaboral) ? 'selected' : '' }}>
                            <b>{{ $jl->entrada }} - {{ $jl->salida }}</b>
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Horario de Comida -->
            <div class="col-md-6">
                <label for="hcomida" class="form-label">Horario de Comida:</label>
                <select name="hcomida" id="hcomida" class="form-control selectpicker show-tick">
                    @foreach ($hcomidas as $hc)
                        <option value="{{ $hc->id }}" {{ $hc->id == old('hcomida', $personal[0]->id_hcomida) ? 'selected' : '' }}>
                            <b>{{ $hc->entrada }} - {{ $hc->salida }}</b>
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Horario de Descanso -->
            <div class="col-md-6">
                <label for="hdescanso" class="form-label">Horario de Descanso:</label>
                <select name="hdescanso" id="hdescanso" class="form-control selectpicker show-tick">
                    @foreach ($hdescansos as $hd)
                        <option value="{{ $hd->id }}" {{ $hd->id == old('hdescanso', $personal[0]->id_hdescanso) ? 'selected' : '' }}>
                            <b>{{ $hd->entrada }} - {{ $hd->salida }}</b>
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botón de guardar -->
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{asset('js/datatables-simple-demo.js')}}"></script> 
<script src="{{asset('js/menusitos.js')}}"></script> 

@endpush
