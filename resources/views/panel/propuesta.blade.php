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

    <div class="text-center mt-4">
      <button type="submit" class="btn btn-success">Aceptar Asignación Nueva</button>
      <button type="button" class="btn btn-danger">Rechazar Asignación Nueva</button>
    </div>
  </div>
</form>
@endsection
