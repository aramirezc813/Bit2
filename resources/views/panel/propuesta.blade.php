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



  <div class="tabs">
    <div class="tab-container">
      @foreach ($areas as $area)
        <div id="tab{{ $loop->iteration }}" class="tab">
          <a href="#tab{{ $loop->iteration }}"> {{ $area['nombre'] }} </a>
          <div class="tab-content">
            <h2>{{ $area['nombre'] }}</h2>

            {{-- Layout por tipo de área --}}
            @php
              $columnas = ($area['nombre'] === 'Planta Alta') ? array_chunk($area['estaciones'], 10)
                        : ($area['nombre'] === 'Planta Baja' ? array_chunk($area['estaciones'], ceil(count($area['estaciones']) / 2))
                        : array_chunk($area['estaciones'], ceil(count($area['estaciones']) / 2)));
            @endphp

            <div class="row">
              @foreach ($columnas as $index => $columna)
                <div class="col">
                  @if ($area['nombre'] === 'Planta Baja')
                    <h5 class="text-center mb-2">{{ $index === 0 ? 'Isla 1' : 'Isla 2' }}</h5>
                  @endif
                  <div class="grid">
                    @foreach ($columna as $estacion)
                      <div class="grid-item card shadow m-2 p-2"
                          data-estacion="{{ $estacion }}"
                          data-area="{{ $area['nombre'] }}">
                        <strong>{{ $estacion }}</strong>

                        @php
                          $personas = collect($asignaciones)->filter(function($asignacion) use ($estacion) {
                              return $asignacion->id_estacion === $estacion;
                          });
                        @endphp

                        @foreach ($personas as $persona)
                          <div class="btn btn-primary m-2 shadow w-100">
                            {{ $persona->nombre }}
                            <br><small>{{ $persona->jlaborals }}</small>
                          </div>
                        @endforeach
                      </div>
                    @endforeach
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="text-center mt-2 ">
      <button type="submit" class="btn btn-success">Aceptar Asignación Nueva</button>

     

      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#createModal">
            Rechazar Asignación Nueva
        </button>
       
    </div>
  </div>



<!-- INICIO Modal Rechazar Asignación -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Rechazo de Propuesta de Asignación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario dentro del modal -->
                <form action="{{ route('panel.correoRechazo',1) }}" method="POST">   
                    @csrf
                    
                    <input type="hidden" name="asignacion_id" id="asignacion_id" value="{{ old('asignacion_id') }}">

                    <div class="row g-3">
                       

                        <!-- Motivo del rechazo -->
                        <div class="col-md-12">
                            <label for="motivo" class="form-label txt-gray">
                                <i class="fa-solid fa-comment-dots"></i> Motivo del rechazo:
                            </label>
                            <textarea name="motivo" id="motivo" rows="4" class="form-control" placeholder="Explique brevemente por qué se rechaza esta asignación..." required></textarea>
                        </div>

                        <!-- Botón de guardar -->
                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-danger">Guardar Rechazo</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>   
<!-- FIN Modal Rechazar Asignación -->































@endsection
