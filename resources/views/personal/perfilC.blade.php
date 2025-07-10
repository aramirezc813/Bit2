@extends('template')

@section('title','Perfil')
@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    #descripcion{
    resize: none;
    }
    

</style>
@endpush

@section('content')

{{--  {{ $user->name }}  --}}
<script>
    Swal.fire({
         title: `<strong>{{Session('nombre')}}</strong>`,
         html: `
             <p><b>Estación:</b> {{Session('estacion')}}</p>
             <p><b>Jornada Laboral:</b> {{Session('jlaborals')}}</p>            
         `,
         imageUrl: "{{ url('Storage/personal/' . Session('foto')) }}",  <!-- Ruta a la imagen -->
         imageWidth: 200,  <!-- Ajusta el ancho de la imagen -->
         imageHeight: 200,  <!-- Ajusta el alto de la imagen -->
         imageAlt: 'Foto del perfil',
         showCloseButton: true,
     });
 </script>

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Perfil</h1>
        <ol class="breadcrumb mb-4">
            {{-- <li class="breadcrumb-item "><a href="{{route('panel.index')}}">Inicio</a></li>     --}}       
            <li class="breadcrumb-item active">Perfil </li>
        </ol>
   
    
</div>

<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Personal "CATGEM"
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>  </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nombre</td>
                        <td>{{Session('nombre')}}</td>
                    </tr>
                    <tr>
                        <td>Puesto</td>
                        <td> {{Session('id_rol')}}</td>
                    </tr>
                    <tr>
                        <td>Estación</td>
                        <td>{{Session('estacion')}}  {{Session('estacion')}}</td>
                    </tr>
                    <tr>
                        <td>Jornada Laboral</td>
                        <td> {{Session('jlaborals')}} </td>
                    </tr>
                    <tr>
                        <td>Horario de Comida</td>
                        <td> {{Session('hcomidas')}}  </td>
                    </tr>
                    <tr>
                        <td>Horario de Descanso</td>
                        <td>{{Session('hdescansos')}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
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