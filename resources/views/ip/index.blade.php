@extends('template')
@section('title','Ip')

@push('css')
    <!-- SweetAlert2 CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">

    <!-- jQuery (requerido para DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
@endpush

@section('content')

    <!-- Alerta de éxito cuando se realiza una acción con éxito -->
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

    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Gestión de IP</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('perfilC') }}">Inicio</a></li>
            <li class="breadcrumb-item active">IP</li>
        </ol>

        <!-- Botón para añadir una nueva IP -->
        <div class="mb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Añadir una IP
            </button>
        </div>
    </div>

    <div class="container-fluid px-3">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                IPs
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>IP</th>
                            <th>Disponibilidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ip as $ips)
                            <tr id="{{ $ips->asignado == 3 ? 'tablaneutro' : 'tablaazul' }}">
                                <td>10.40.130.{{ $ips->descripcion }}</td>
                                <td>
                                    @if ($ips->asignado == 3)
                                        <span class="span-fijo fw-bolder p-1 rounded bg-secondary text-white">En Uso</span>
                                    @else
                                        <span class="span-fijo fw-bolder p-1 rounded bg-primary text-white">Disponible</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>IP</th>
                            <th>Disponibilidad</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para añadir una IP -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Añadir IP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ip.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción (últimos octetos de la IP)</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                           {{--  @error('descripcion')
                                <small class="text-danger">{{ '* ' . $message }}</small>
                            @enderror --}}
                        </div>
                        <div class="mb-3">
                            <label for="asignado" class="form-label">Estado de Asignación</label>
                            <select name="asignado" id="asignado" class="form-select" required>
                                <option value="3">En Uso</option>
                                <option value="1">Disponible</option>
                            </select>
                            {{-- @error('asignado')
                                <small class="text-danger">{{ '* ' . $message }}</small>
                            @enderror --}}
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <!-- Chart.js (si se usa para alguna visualización) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>

    <!-- Scripts personalizados -->
    <script src="{{ asset('js/menusitos.js') }}"></script>
@endpush
