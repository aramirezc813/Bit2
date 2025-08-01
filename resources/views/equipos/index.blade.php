@extends('template')
@section('title', 'Equipos')

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

    <!-- Alerta de éxito -->
    @if (session('success'))
        <script>
            let message = "{{ session('success') }}";
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

    <!-- Contenido principal -->
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Equipos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('perfilC') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Información</li>
        </ol>

        <div class="mb-4">
            <!-- Botón para añadir un nuevo equipo -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Añadir Equipo
            </button>
        </div>
    </div>

  <!-- Tabla de equipos -->
<div class="container-fluid px-3">
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Equipos
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Equipo</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipos as $equipo)
                            <tr id="tablaneutro">
                                <td>{{ $equipo->id_equipo }}</td>
                                <td>
                                

                                    <button type="button" title="Ver" class="btn btn-warning" data-toggle="modal" data-target="#verModal-{{$equipo->id_equipo}}" data-id-equipo="{{$equipo->id_equipo}}">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>


                                    
                                    <!-- Formulario para eliminar el equipo -->
                                    <form action="{{ route('equipos.destroy', $equipo->id_equipo) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Eliminar" class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                                

                            </tr>

 
                            
<!-- Modal para Mostrar Componentes -->
<div class="modal fade" id="verModal-{{$equipo->id_equipo}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-{{$equipo->id_equipo}}" aria-hidden="true">
    <div class="modal-dialog" role="document" aria-labelledby="exampleModalLabel-{{$equipo->id_equipo}}" aria-describedby="componentesList">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles del Equipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for=""><span class="fw-bolder">ID del Equipo:</span> {{$equipo->id_equipo}}</label>
                </div>
               
                <div id="componentesList-{{$equipo->id_equipo}}">
                    
                    <ul class="list-group">
                        @foreach ($consulta as $componente)
                            @if ($componente->id_equipo == $equipo->id_equipo)
                                
                                <li class="list-group-item">
                                    <strong>Componente:</strong> {{$componente->nombre_componente}} <br>
                                    <strong>Número de Serie:</strong> {{$componente->numeroserie}}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



            
    


                        @endforeach


                       {{--  --}}
                        



                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Equipo</th>
                            <th>Acción</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>




    <!-- Modal para añadir un equipo -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Añadir Equipo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('equipos.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-white bg-primary p-1 text-center">
                                Datos Generales
                            </div>
                            <div class="p-3 border border-3 success">
                                <div class="row">
                                    {{--  <select data-live-search="true" name="ip" id="ip" class="form-control selectpicker show-tick"> --}}
                                    <select data-live-search="true" name="equipos_id" title="Selecciona un componente" id="equipos_id" class="form-control selectpicker show-tick"  {{-- data-size="2" --}} >
                                        @foreach ($inventario as $item)
                                            <option value="{{ $item->id_inventario }}">{{ $item->numeroinventario . ' - ' . $item->descripcion }}</option>
                                        @endforeach
                                    </select>
                                    
                                    <div class="col-md-12 mb-2 text-end">
                                        <br>
                                        <button id="btn_agregar" class="btn btn-primary" type="button">Agregar Componente</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="tablaDetalle" class="table table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                     
                                    <th>#</th>
                                    <th>Componente</th>
                                    <th>    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se agregarán las filas dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 mb-2 text-center">
                        <br>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                     <div class="col-md-12 mb-2 text-lefr">
                        <br>
                        <button type="submit" class="btn btn-success">Guardarxdd</button>
                    </div>

                    
                </form>
            </div>
        </div>
    </div>
</div>








@endsection

@push('js')
    
@push('js')
<script>
    $(document).ready(function() {
        // Manejar el click del botón "Agregar Componente"
        $('#btn_agregar').click(function() {
            // Obtener el valor seleccionado
            var selectedComponente = $('#equipos_id').val();
            var selectedComponenteText = $('#equipos_id option:selected').text();
            
            // Validar si se ha seleccionado un componente
            if (selectedComponente) {
                // Crear una fila nueva en la tabla
                var newRow = `
                    <tr id="row-${selectedComponente}">
                        <td>#</td>
                        <td>${selectedComponenteText}</td>
                        <td>
                            <button type="button"  title='Eliminar' class="btn btn-danger btn-sm" onclick="removeRow('${selectedComponente}')"><i class="fa-solid fa-trash"></i></button>
                            <input type="hidden" name="componentes[]" value="${selectedComponente}">
                        </td>
                    </tr>
                `;
                
                // Agregar la nueva fila al tbody
                $('#tablaDetalle tbody').append(newRow);
                
                // Limpiar la selección del select
                $('#equipos_id').val('').selectpicker('refresh');
            } else {
                // Si no se seleccionó un componente, mostrar una alerta
                alert('Por favor, selecciona un componente para agregar.');
            }
        });

        // Función para eliminar una fila de la tabla
        window.removeRow = function(id) {
            $('#row-' + id).remove();
        };
    });
</script>
@endpush


<script>
    $(document).ready(function() {
    $('.selectpicker').selectpicker();
    });

</script>

<script>





        $(document).ready(function() {
            $('#datatablesSimple').DataTable();
        });
    </script>
@push('js')
    
{{-- 


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> --}}
<script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{asset('js/datatables-simple-demo.js')}}"></script> 
<script src="{{asset('js/menusitos.js')}}"></script> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


@endpush
