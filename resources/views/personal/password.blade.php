@extends('template')

@section('title','Contraseñas')
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


<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Perfil</h1>
        <ol class="breadcrumb mb-4">
             <li class="breadcrumb-item "><a href="{{route('perfilC')}}">Inicio</a></li>         
            <li class="breadcrumb-item active">Contraseñas </li>
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
                       <th>Sistema</th>
                       <th>Usuario</th>
                       <th>Contraseña</th>
                   </tr>
               </thead>
               <tbody>
                   <!-- Fila 1 -->
                   <tr >
                       <td>CRM-CATGEM</td>
                       <td>DROMEROL</td>
                       <td>DROMEROL</td>
                   </tr>
                   <!-- Fila 2 -->
                   <tr>
                       <td>FALLAS</td>
                       <td>DROMEROL</td>
                       <td>DROMEROL</td>
                   </tr>
                   <!-- Fila 3 -->
                   <tr>
                       <td>AVAYA AURA CALL CENTER ELITE MULTICHANNEL (AACCEM)</td>
                       <td>63073</td>
                       <td>63073</td>
                   </tr>
                   <!-- Fila 4 -->
                   <tr>
                       <td>EQUIPO DE COMPUTO</td>
                       <td>E63107</td>
                       <td>EpHxQSKE</td>
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