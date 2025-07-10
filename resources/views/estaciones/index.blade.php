@extends('template')
@section('title','Estaciones')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">

<!-- jQuery (requerido para DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>

<style>
    
    .modal-content {
      background-color: white;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%; /* Ancho del modal */
      max-width: 600px; /* Máximo ancho */
    }
  
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
  
    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  
    pre {
      white-space: pre-wrap; 
    }
  </style>

@endpush

@section('content')
    @if (session('success'))
        <script>
            let message = "{{ session('success') }}"
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
            let message = "{{ session('error') }}"
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
        <h1 class="mt-4 text-center">Estaciones</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="{{ route('perfilC') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Estaciones</li>
        </ol>
        
        <div class="mb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Añadir una Estación
                
            </button>
        </div>
    </div>

    <div class="container-fluid px-3">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Estaciones
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Descripción</th>
                                <th>Área</th>
                                <th>IP</th>
                                <th>Asignado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estaciones as $estacion)
                                @switch($estacion->asignado)
                                    @case(2)
                                        <tr id="tablaazul">
                                            @break
                                    @case(1)
                                        <tr id="tablaneutro">
                                            @break
                                    @case(3)
                                        <tr id="tablaverde">
                                            @break
                                @endswitch

                                <td>{{ $estacion->descripcion }}</td>
                                <td>{{ $estacion->area_descripcion }}</td>
                                <td>10.40.130.{{ $estacion->ip_descripcion }}</td>
                                <td>
                                    @switch($estacion->asignado)
                                        @case(1)
                                            <span class="span-fijo fw-bolder p-1 rounded bg-secondary text-white">Desactivado</span>
                                            @break
                                        @case(2)
                                            <span class="span-fijo fw-bolder p-1 rounded bg-primary text-white">Activo</span>
                                            @break
                                        @case(3)
                                            <span class="span-fijo fw-bolder p-1 rounded bg-success text-white">Uso</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <form action="{{ route('estaciones.edit', ['estaciones' => $estacion->id, $estacion->id_ip]) }}" method="GET">
                                            @csrf
                                            <button type="submit" title="Editar" class="btn btn-btn btn-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </form>

                                        @switch($estacion->asignado)
                                            @case(2)
                                                <button type="button" class="btn btn-danger" title="Eliminar" data-bs-toggle="modal" data-bs-target="#confirmacionModal--{{ $estacion->id }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                @break

                                            @case(1)
                                                <button type="button" class="btn btn-secondary" title="Restaurar" data-bs-toggle="modal" data-bs-target="#confirmacionModal--{{ $estacion->id }}">
                                                    <i class="fa-solid fa-user-plus"></i>
                                                </button>
                                                @break

                                            @case(3)
                                                <button type="button" class="btn btn-success" title="Liberar" data-bs-toggle="modal" data-bs-target="#confirmacionModal--{{ $estacion->id }}">
                                                    <i class="fa-solid fa-unlock"></i>
                                                </button>
                                                @break

                                            @default
                                        @endswitch
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal para manejar todas las acciones de la estación -->
                            <div class="modal fade" id="confirmacionModal--{{ $estacion->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                           

                                            


                                            @switch($estacion->asignado)
                                            @case(2)
                                                <strong id="modalMessage--{{ $estacion->id }}">
                                                    ¿Está seguro de Desactivar esta estación? 
                                                    <br>
                                                    <span class="nota">NOTA: Al hacerlo todos los componentes serán desvinculados de la misma, INCLUYENDO USUARIOS.</span>
                                                </strong>
                                                @break
                                        
                                            @case(1)
                                                <strong id="modalMessage--{{ $estacion->id }}">
                                                    ¿Está seguro de reactivar esta estación?
                                                </strong>
                                                @break
                                        
                                            @case(3)
                                                <strong id="modalMessage--{{ $estacion->id }}">
                                                    ¿Está seguro de liberar esta estación? 
                                                    <br>
                                                    <span class="nota">NOTA: Al hacerlo todos los componentes serán desvinculados de la misma, INCLUYENDO USUARIOS.</span>
                                                </strong>
                                                @break
                                        
                                            @default
                                                <strong id="modalMessage--{{ $estacion->id }}">Acción desconocida para esta estación.</strong>
                                        @endswitch
                                        

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <!-- Formulario que pasa la acción al controlador -->
                                            <form id="formAction" action="{{ route('estaciones.cambios', ['estacione' => $estacion->id,$estacion->id_ip,$estacion->asignado]) }}" method="POST">
                                           
                                                @csrf
                                                <!-- Campo oculto para pasar el tipo de acción (desactivar, activar, liberar) -->
                                                <input type="hidden" name="action_type" id="action_type--{{ $estacion->id }}">
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
                                <th>Descripción</th>
                                <th>Área</th>
                                <th>IP</th>
                                <th>Asignado</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
<!-- Modal para Añadir una Estación -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Añadir Estación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('estaciones.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
                            @error('nombre')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <!-- IP -->
                        <div class="col-md-12">
                            <label for="ip" class="form-label">
                                <i class="fas fa-laptop-house"></i> IP designada a la Estación:
                            </label>
                            <select data-live-search="true" name="ip" id="ip" class="form-control selectpicker show-tick">
                                <option value="2"><b>Sin argumento</b></option>
                                @foreach ($ip as $ob)
                                    <option value="{{ $ob->id }}">10.40.130.{{ $ob->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Área -->
                        <div class="col-md-12">
                            <label for="area" class="form-label">
                                <i class="fas fa-building"></i> Área designada a la Estación:
                            </label>
                            <select data-live-search="true" name="area" id="area" class="form-control selectpicker show-tick">
                                <option value="2"><b>Sin argumento</b></option>
                                @foreach ($area as $ob)
                                    <option value="{{ $ob->id }}">{{ $ob->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Silla -->
                        <div class="col-md-12">
                            <label for="silla" class="form-label">
                                <i class="fas fa-chair"></i> Silla designada a la Estación:
                            </label>
                            <select data-live-search="true" name="silla" id="silla" class="form-control selectpicker show-tick">
                                <option value="2"><b>Sin argumento</b></option>
                                @foreach ($silla as $ob)
                                    <option value="{{ $ob->id_inventario }}">{{ $ob->numeroinventario . ' - ' . $ob->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Archivero -->
                        <div class="col-md-12">
                            <label for="archivero" class="form-label">
                                <i class="fas fa-archive"></i> Archivero designado a la Estación:
                            </label>
                            <select data-live-search="true" name="archivero" id="archivero" class="form-control selectpicker show-tick">
                                <option value="2"><b>Sin argumento</b></option>
                                @foreach ($archivero as $ob)
                                    <option value="{{ $ob->id_inventario }}">{{ $ob->numeroinventario . ' - ' . $ob->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        
    
                        <div class="col-md-12">
                            <label for="archivero" class="form-label">
                                <i class="fa-solid fa-computer"></i> Equipo designado a la Estación:
                            </label>
                            <div class="input-group">
                                <select data-live-search="true" name="equipos" id="equipos" class="form-control selectpicker show-tick">
                                    <option value="2"><b>Sin argumento</b></option>
                                    @foreach ($equipos as $ob)
                                        <option value="{{ $ob->id_equipo }}">{{ $ob->id_equipo }}</option>
                                    @endforeach
                                </select>
                                <!-- Botón junto al select para ver detalles -->
                                <button type="button" id="botonAgregar" title="Ver" class="btn btn-warning">
                                    <i class="fa-solid fa-eye"></i> 
                                </button>
                            </div>
                        </div>

                         
                    </div>
                 <br>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div id="modalDetalles" class="modal">
    <div class="modal-content">
      <span id="closeModal" class="close">&times;</span>
      <h2>Detalles del Componente</h2>
      <pre id="modalText"></pre>
    </div>
  </div>
  
  <!-- Estilos para el modal -->
  
  


</script>

















@endsection



@push('js')

 {{-- Modal que dije que no se podia pero al final si paraa mostrar los componentes --}}
<script>
    var componentes = @json($componentes_equipos);

    document.getElementById('botonAgregar').addEventListener('click', function() {
        // Obtenemos el valor seleccionado del select
        var selectedComponente = document.getElementById('equipos').value;
        var found = false;
        var detallesComponente = '';  // Variable para almacenar los detalles del componente

        // Verificamos si se ha seleccionado algún equipo
        if (!selectedComponente) {
            alert("Por favor, seleccione un equipo.");
            return; // Si no se seleccionó ningún equipo, salimos de la función
        }

        // Recorremos los componentes
        componentes.forEach(function(componente) {
            if (selectedComponente == componente.id_equipo) {
                // Si hay coincidencia, concatenamos la información
                detallesComponente += 
                    "Componente: " + componente.nombre_componente + "\n" +
                    "Número de Serie: " + componente.numeroserie + "\n" +
                    "ID Inventario: " + componente.id_inventario + "\n\n";
                found = true;
            }
        });

        // Si se encuentra el componente, mostramos el modal
        if (found) {
            // Coloca los detalles en el modal
            document.getElementById('modalText').textContent = detallesComponente;
            // Muestra el modal
            document.getElementById('modalDetalles').style.display = "block";
        } else {
            alert("No se encontró el componente correspondiente.");
        }
    });

    // Cerrar el modal cuando se hace clic en el 'X'
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('modalDetalles').style.display = "none";
    });

    // Cerrar el modal si se hace clic fuera del contenido del modal
    window.addEventListener('click', function(event) {
        if (event.target === document.getElementById('modalDetalles')) {
            document.getElementById('modalDetalles').style.display = "none";
        }
    });
</script>


    






  





    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/datatables-simple-demo.js')}}"></script> 
    <script src="{{asset('js/menusitos.js')}}"></script> 

@endpush
