@extends('template')
@section('title','Inventario')

@push('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

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
            let message="{{session('success')}}"  
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
        let message="{{session('error')}}"  
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
        <h1 class="mt-4 text-center">Inventario</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "> <a href="{{route('perfilC')}}"> Inicio</a></li>
            <li class="breadcrumb-item active">Inventario</li>
        </ol>
        <div class="mb-4"> 
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Añadir Bien
            </button> 
        </div>
    </div> 

    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Inventario
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-striped">   
                        <thead>
                            <tr>
                                <th>Numero de Inventario</th>
                                <th>Numero de Serie</th>
                                <th>Tipo de Componente</th>
                                <th>Categoria</th>
                                <th>Estado</th>
                                <th>Asignado</th>                                                                                       
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventario as $inv)
                                 @if($inv->estado == "Uso")
                                    <tr id="tablaverde">
                                @elseif($inv->estado == "Resguardo")
                                    <tr id="tablaamarillo">
                                @elseif($inv->estado == "Baja")
                                    <tr id="tablarojo">
                                @endif  
                                    <td> {{$inv->numeroinventario}} </td>
                                    <td> {{$inv->numeroserie}}   </td>
                                    <td>{{$inv->componente }}  </td>
                                    <td> {{$inv->categoria}}  </td>
                                    <td>
                                         @if($inv->estado=="Uso")
                                            <span class="span-fijo fw-bolder p-1 rounded bg-success text-white">{{$inv->estado}}</span>                              
                                        @elseif ($inv->estado=="Resguardo")
                                            <span class="span-fijo fw-bolder p-1 rounded bg-warning text-white">{{$inv->estado}}</span>   
                                        @else
                                            <span class="span-fijo fw-bolder p-1 rounded bg-danger text-white">{{$inv->estado}}</span>  
                                        @endif 
                                    </td>   
                                    <th>
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">   
                                             <form action="{{ route('inventario.edit', ['inventario' => $inv->id_inventario]) }}" method="GET">   
                                                @csrf
                                                <button type="submit" title='Editar' class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>
                                            </form> 
                                            @if($inv->estado != "Baja")
                                                <button type="button" class="btn btn-danger" title='Eliminar' data-bs-toggle="modal" data-bs-target="#confirmacionModal-{{$inv->id_inventario}}-{{$inv->estado}}"> <i class="fa-solid fa-trash"></i></button>
                                            @else
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmacionModal-{{$inv->id_inventario}}-{{$inv->estado}}">Restaurar</button>
                                            @endif
                                        </div>
                                    </th>
                                </tr>
                            @endforeach   
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Numero de Inventario</th>
                                <th>Numero de Serie</th>
                                <th>Tipo de Componente</th>
                                <th>Categoria</th>
                                <th>Estado</th>
                                <th>Asignado</th>   
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>    
    </div>

    <!-- Modal para añadir un bien -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Añadir Bien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('inventario.store') }}" method="POST"> 
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="numInventario" class="form-label">Numero de Inventario:</label>
                                <input type="text" name="numeroInventario" id="numeroInventario" class="form-control"  required />
                                 
                            </div>
                            <div class="col-md-12">
                                <label for="numSerie" class="form-label">Numero de Serie:</label>
                                <input type="text" name="numeroSerie" id="numeroSerie" class="form-control"   required />
                                
                            </div>
                            <div class="col-md-12">
                                <label for="nombre" class="form-label">Categoria del bien:</label>
                                <select data-live-search="true" name="tipoCat" class="form-control show-tick selectpicker" id="documentSelect">    
                                    <optgroup label="Selecciona la categoria:">
                                        <option value="2"><b>Sin argumento</b></option>
                                    </optgroup>
                                    @foreach ($cat as $ob)
                                        <option value="{{ $ob->id }}">{{ $ob->nombre }}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-md-12"> 
                                <select name="tipoComp" class="form-control" id="sel2" style="display:none;">
                                    <option value="2"><b>Componente.</b></option>
                                </select>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>   
@endsection 

@push('js')
    <script>
        $(document).ready(function(){
            // Initializes the selectpicker
            $('.selectpicker').selectpicker();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const selectDocumentos = document.getElementById('documentSelect');
            const subcategoriaSelect = document.getElementById('sel2');

            selectDocumentos.addEventListener('change', async function() {
                const idDocumento = selectDocumentos.value;

                if (idDocumento === "0") {
                    subcategoriaSelect.style.display = 'none';
                } else {
                    subcategoriaSelect.style.display = 'block';
                    try {
                        const response = await fetch("{{ route('realizarconsulta') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ id: idDocumento })
                        });

                        if (!response.ok) {
                            throw new Error('Hubo un problema al enviar los datos.');
                        }

                        const data = await response.json();
                        if (data != null && data.uaS) {
                            subcategoriaSelect.innerHTML = "<option value='1'>Seleccione el tipo de Componente </option>";
                            data.uaS.forEach(element => {
                                subcategoriaSelect.innerHTML += `<option value='${element.id}'>${element.descripcion}</option>`;
                            });
                        } else {
                            subcategoriaSelect.style.display = "none";
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        subcategoriaSelect.style.display = "none";
                    }
                }
            });
        });
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{asset('js/datatables-simple-demo.js')}}"></script> 
<script src="{{asset('js/menusitos.js')}}"></script>   
    
@endpush

