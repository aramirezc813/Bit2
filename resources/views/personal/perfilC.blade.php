@extends('template')

@section('title','Perfil')

@push('css')
<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.11/index.global.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.11/index.global.min.css" rel="stylesheet" />

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />

<!-- Tippy.js para tooltips bonitos -->
<link rel="stylesheet" href="https://unpkg.com/tippy.js@6/themes/light.css" />

<style>
    #descripcion {
        resize: none;
    }

    #calendar {
        max-width: 100%;
        height: 500px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Perfil</h1>
    <ol class="breadcrumb mb-4">
        {{-- <li class="breadcrumb-item active">Perfil</li> --}}
    </ol>

    <div class="d-flex flex-wrap">
        <div class="flex-fill me-4" style="min-width: 300px; max-width: 60%;">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Personal "CATGEM"
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Nombre</td><td>{{ Session('nombre') }}</td></tr>
                            <tr><td>Puesto</td><td>{{ Session('id_rol') }}</td></tr>
                            <tr><td>Estación</td><td>{{ Session('estacion') }}</td></tr>
                            <tr><td>Jornada Laboral</td><td>{{ Session('jlaborals') }}</td></tr>
                            <tr><td>Horario de Comida</td><td>{{ Session('hcomidas') }}</td></tr>
                            <tr><td>Horario de Descanso</td><td>{{ Session('hdescansos') }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Calendario -->
        <div class="flex-fill" style="min-width: 300px;">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-calendar-alt me-1"></i>
                    Calendario
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- FullCalendar -->
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.11/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.11/index.global.min.js"></script>

<!-- Tippy.js para tooltips bonitos -->
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>

<!-- DataTable init -->
<script>
    $(document).ready(function () {
        $('#datatablesSimple').DataTable();
    });
</script>

<!-- SweetAlert + FullCalendar con evento falso -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            title: `<strong>{{ Session('nombre') }}</strong>`,
            html: `
                <p><b>Estación:</b> {{ Session('estacion') }}</p>
                <p><b>Jornada Laboral:</b> {{ Session('jlaborals') }}</p>
            `,
            imageUrl: "{{ url('Storage/personal/' . Session('foto')) }}",
            imageWidth: 200,
            imageHeight: 200,
            imageAlt: 'Foto del perfil',
            showCloseButton: true,
        });

        const calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                height: 500,
                events: [
                    {
                        title: 'Capacitación',
                        start: new Date().toISOString().split('T')[0],
                        description: 'Capacitación en el Archivo',
                    },
                     {
                        title: 'Capacitación',
                        start: '2025-08-01',
                        description: 'Capacitación en el Archivo',
                    }
                     
                ],
                eventDidMount: function(info) {
                    // Modo simple con title:
                    // info.el.setAttribute('title', info.event.extendedProps.description);

                    // Modo estilizado con tippy.js:
                    tippy(info.el, {
                        content: info.event.extendedProps.description,
                        theme: 'light',
                        placement: 'top',
                    });
                }
            });
            calendar.render();
        }
    });
</script>

<!-- Script local -->
<script src="{{ asset('js/menusitos.js') }}"></script>
@endpush
