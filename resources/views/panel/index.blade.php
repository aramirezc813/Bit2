@extends('template')

@section('title', 'Panel')

@push('css')
<link href="{{ asset('css/menusitos.css') }}" rel="stylesheet" />
@endpush

@section('content')
@php
$areas = [
    ['nombre' => 'STAFF', 'estaciones' => ['AnalistaB2', 'AnalistaB1', 'DG', 'RH', 'Subdireccion', 'JDACEFD', 'Catgem']],
    ['nombre' => 'ATI', 'estaciones' => ['STI1', 'TTI-3', 'RTI1', 'TTI']],
    ['nombre' => 'Planta Baja', 'estaciones' => ['E63100','E63119','E63101','E63118','E63102','E63117','E63103','E63116','E63104','E63115','E63105','E63114','E63106','E63113','E63107','E63112','E63108','E63111','E63109','E63110']],
    ['nombre' => 'Planta Alta', 'estaciones' => ['E63200','E63209','E63201','E63208','E63202','E63207','E63203','E63206','E63204','E63205']],
    ['nombre' => 'Recepcion', 'estaciones' => ['Recepcion']],
];
@endphp

@if(session('success'))
<div class="alert alert-success text-center">{{ session('success') }}</div>
@endif

<form action="{{ route('panel.store') }}" method="POST">
  @csrf

  <div class="tabs">
    <div class="tab-container">
      @foreach ($areas as $area)
        <div id="tab{{ $loop->iteration }}" class="tab">
          <a href="#tab{{ $loop->iteration }}"> {{ $area['nombre'] }} </a>
          <div class="tab-content">
            <h2>{{ $area['nombre'] }}</h2>

            {{-- Planta Baja con Isla 1 y Isla 2 --}}
            @if ($area['nombre'] === 'Planta Baja')
              <div class="row">
                @foreach (array_chunk($area['estaciones'], ceil(count($area['estaciones']) / 2)) as $index => $columna)
                  <div class="col">
                    <h5 class="text-center mb-2">{{ $index === 0 ? 'Isla 1' : 'Isla 2' }}</h5>
                    <div class="grid">
                      @foreach ($columna as $estacion)
                        <div class="grid-item card shadow m-2 p-2"
                            data-estacion="{{ $estacion }}"
                            data-area="{{ $area['nombre'] }}"
                            ondragover="onDragOver(event);"
                            ondrop="onDrop(event);">
                          {{ $estacion }}
                        </div>
                      @endforeach
                    </div>
                  </div>
                @endforeach
              </div>
      {{-- Planta Alta con 2 columnas de 5 estaciones --}}
            @elseif ($area['nombre'] === 'Planta Alta')
               <div class="row ">
                
                @foreach (array_chunk($area['estaciones'], 10) as $columna)
                  <div class="col">
                    <div class="grid">
                      @foreach ($columna as $estacion)
                        <div class="grid-item card shadow m-2 p-2 "
                            data-estacion="{{ $estacion }}"
                            data-area="{{ $area['nombre'] }}"
                            ondragover="onDragOver(event);"
                            ondrop="onDrop(event);">
                          {{ $estacion }}
                        </div>
                      @endforeach
                    </div>
                  </div>
                @endforeach
              </div>

            {{-- Resto de áreas en 2 columnas automáticas --}}
            @else
              <div class="row">
                @foreach (array_chunk($area['estaciones'], ceil(count($area['estaciones']) / 2)) as $columna)
                  <div class="col">
                    <div class="grid">
                      @foreach ($columna as $estacion)
                        <div class="grid-item card shadow m-2 p-2"
                            data-estacion="{{ $estacion }}"
                            data-area="{{ $area['nombre'] }}"
                            ondragover="onDragOver(event);"
                            ondrop="onDrop(event);">
                          {{ $estacion }}
                        </div>
                      @endforeach
                    </div>
                  </div>
                @endforeach
              </div>
            @endif

          </div>
        </div>
      @endforeach
    </div>

    {{-- Personal --}}
    <div class="example-origin">
      <div class="container text-center">Personal</div>
      @foreach ($personal as $persona)
        @php
          $id = 'draggable-' . Str::slug($persona->nombre, '_');
          $asignacion = $asignaciones[$persona->id_persona] ?? null;
        @endphp
        <button id="{{ $id }}"
                class="example-draggable btn btn-primary m-2 shadow"
                draggable="true"
                ondragstart="onDragStart(event);"
                aria-grabbed="true"
                data-nombre="{{ $persona->nombre }}"
                data-id="{{ $persona->id_usuarios }}"
                data-jlaboral="{{ $persona->jlaborals }}"
                data-dias="{{ $persona->dias }}"
                @if ($asignacion)
                  data-estacion-asignada="{{ $asignacion->estacion }}"
                @endif>
          {{ $persona->nombre }}
          <span class="tooltip-text">Jornada Laboral: {{ $persona->jlaborals }}</span>
        </button>
      @endforeach
    </div>

    {{-- Inputs ocultos --}}
    <div id="asignaciones-container"></div>

    {{-- Botones --}}
    <div class="text-center mt-3">
      <button type="submit" class="btn btn-success">Guardar Nueva Asignación</button>
      <button type="button" class="btn btn-danger" onclick="limpiarAsignaciones()">Limpiar</button>
    </div>
  </div>
</form>

<!-- Modal de advertencia -->
<div class="modal fade" id="modalJornadaRepetida" tabindex="-1" aria-labelledby="modalJornadaRepetidaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header  text-dark">
        <h5 class="modal-title">Asignación no permitida</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body" id="modalJornadaMensaje">
        <!-- Aquí se mostrará el mensaje dinámico -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Entendido</button>
      </div>
    </div>
  </div>
</div>


<script>
  document.addEventListener("DOMContentLoaded", () => {
    if (!window.location.hash) {
      window.location.hash = "#tab1";
    }

    // Cargar asignaciones previas
    document.querySelectorAll('.example-draggable').forEach(persona => {
      const estacionAsignada = persona.dataset.estacionAsignada;
      if (estacionAsignada) {
        const estacion = document.querySelector(`[data-estacion="${estacionAsignada}"]`);
        if (estacion) {
          estacion.appendChild(persona);
          const input = document.createElement('input');
          input.type = 'hidden';
          input.name = 'asignaciones[]';
          input.value = `${persona.dataset.id}|${estacion.dataset.estacion}|${estacion.dataset.area}`;
          document.getElementById('asignaciones-container').appendChild(input);
        }
      }
    });
  });

  function onDragStart(event) {
    event.dataTransfer.setData('text/plain', event.target.id);
  }

  function onDragOver(event) {
    event.preventDefault();
  }

  

    </script>

    <script>
  function onDrop(event) {
    event.preventDefault();

    const id = event.dataTransfer.getData('text');
    const persona = document.getElementById(id);
    const estacion = event.currentTarget;

    const personaId = persona.dataset.id;
    const estacionNombre = estacion.dataset.estacion;
    const areaNombre = estacion.dataset.area;
    const jlaboral = persona.dataset.jlaboral; 
    const diasNuevo = persona.dataset.dias.split(','); 

    // Función para convertir "HH:mm" a minutos
    function horaStringAMinutos(horaStr) {
      const [horas, minutos] = horaStr.split(':').map(Number);
      return horas * 60 + minutos;
    }

    const [inicioNuevo, finNuevo] = jlaboral.split(' - ').map(horaStringAMinutos);

    const yaAsignados = estacion.querySelectorAll('.example-draggable');
    for (const asignado of yaAsignados) {
      const diasAsignado = asignado.dataset.dias;

      // Verifica días en común
      const diasEnComun = diasNuevo.filter(d => diasAsignado.includes(d));
      if (diasEnComun.length === 0) {
        console.log(`✅ Sin días en común con ${asignado.dataset.nombre}, se permite.`);
        continue; // Sin días en común, no hay problema
      }

      const [inicioAsig, finAsig] = asignado.dataset.jlaboral.split(' - ').map(horaStringAMinutos);

      // Validar traslape de horarios
      const traslape = inicioAsig < finNuevo && inicioNuevo < finAsig;

      console.log(`Comparando: Nuevo [${jlaboral}] días [${diasNuevo.join(',')}] con Asignado [${asignado.dataset.jlaboral}] días [${diasAsignado}] → ${traslape ? '❌ Conflicto' : '✅ Sin conflicto'}`);

      if (traslape) {
        const nombrePersona = persona.dataset.nombre;

        

        const mensaje = `No se puede asignar a <strong>${nombrePersona}</strong> porque hay conflicto de horario.`;

        document.getElementById('modalJornadaMensaje').innerHTML = mensaje;
        const modal = new bootstrap.Modal(document.getElementById('modalJornadaRepetida'));
        modal.show();

        return; // Sale sin asignar
      }
    }

    // Eliminar asignación anterior si existe
    document.querySelectorAll('input[name="asignaciones[]"]').forEach(input => {
      if (input.value.startsWith(`${personaId}|`)) input.remove();
    });

    // Asignar persona a estación
    estacion.appendChild(persona);

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'asignaciones[]';
    input.value = `${personaId}|${estacionNombre}|${areaNombre}`;
    document.getElementById('asignaciones-container').appendChild(input);

    console.log(`✅ Asignado: Persona ID ${personaId}, Estación "${estacionNombre}", Área "${areaNombre}", Jornada "${jlaboral}", Días [${diasNuevo.join(',')}]`);

    event.dataTransfer.clearData();
  }

  function limpiarAsignaciones() {
    document.querySelectorAll('.example-draggable').forEach(btn => {
      document.querySelector('.example-origin').appendChild(btn);
    });
    document.getElementById('asignaciones-container').innerHTML = '';
  }
</script>

@endsection
