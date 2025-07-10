{{-- @extends('template')

@section('title','Crear Bien')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
<style>
    #descripcion{
    resize: none;
    }
    

</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Añadir Bien</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="{{route('panel.index')}}">Inicio</a></li>
            <li class="breadcrumb-item "><a href="{{route('inventario.index')}}">Inventario</a></li>
            <li class="breadcrumb-item active">Crear Bien</li>
        </ol>
   
    
</div>

<div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
    <form action="{{route('inventario.store')}}" method="post">
        @csrf
        <div class="row g-3">
            <div class="col-md-12">
                <label for="nombre" class="form-label"> Numero de Inventario:</label>
                <input type="text" name="numInventario" id="numInventario" class="form-control"{{old('numInventario')}}>
                @error('numeroInventario')
                    <small class="text-danger">{{'*'.$message}}</small>
                @enderror 

            </div>
            <div class="col-md-12">
                <label for="nombre" class="form-label"> Numero de Serie:</label>
                <input type="text" name="numSerie" id="numSerie" class="form-control"{{old('numSerie')}} >
                @error('numeroSerie')
                    <small class="text-danger">{{'*'.$message}}</small>
                @enderror 

            </div>

            <div class="col-md-12">
                <label for="nombre" class="form-label">Categoria del bien:</label>
                <select name="tipoCat" class="form-control" id="documentSelect">
                    <optgroup label="Selecciona la categoria:">
                        <option value="2"><b>Sin argumento</b></option>
                    </optgroup>
                    @foreach ($inventario as $ob)
                        <option value="{{ $ob->id }}">{{ $ob->nombre }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-12">
                <select name="tipoComp" class="form-control" id="sel2" style="display:none;">
                    <option value=""><b>Componente.</b></option>
                </select>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const selectDocumentos = document.getElementById('documentSelect');
                    const subcategoriaSelect = document.getElementById('sel2'); // El segundo select
                    const idDocumento = selectDocumentos.value;
                            
                    selectDocumentos.addEventListener('change', async function() {
                        const idDocumento = selectDocumentos.value;
                        
            
                         // Si selecciona "Sin argumento" (valor 0), ocultamos el segundo select
                        if (idDocumento === "0") {
                            subcategoriaSelect.style.display = 'none';

                        } else {
                            subcategoriaSelect.style.display = 'block';
                           
                            
                           try {
                           
                                // Hacemos la consulta al servidor usando fetch
                                const response = await fetch("{{ route('realizarconsulta') }}", {
                                     method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        id: idDocumento
                                    }) 

                                });
                                console.log(idDocumento);
            
                                // Verificamos si la respuesta fue exitosa
                                if (!response.ok) {
                                    throw new Error('Hubo un problema al enviar los datosxDDD.');
                                } 
            
                                // Procesamos los datos recibidos
                                const data = await response.json();
                                console.log('Datos recibidos del servidor:', data);
            
                                if (data != null && data.uaS) {
                                    // Limpiamos y mostramos las opciones de la Unidad Administrativa
                                    subcategoriaSelect.innerHTML = "<option value='1'>Seleccione el tipo de Componente </option>";
                                    data.uaS.forEach(element => {
                                        subcategoriaSelect.innerHTML +=
                                            `<option value='${element.id}'>${element.descripcion}</option>`;
                                        console.log(element.nombre);
                                    });
                                } else {
                                    // Si no hay datos, ocultamos el select
                                    subcategoriaSelect.style.display = "none";
                                }  
                            } catch (error) {
                                console.error('Error:', error);
                                // Si hay un error, puedes ocultar el select también
                                subcategoriaSelect.style.display = "none";
                            }
                        }
                    }); 
                });
            </script>









            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary"> Guardar</button>
            </div>

        </div>
    </form>
</div>

@endsection

@push('js')

@endpush --}}

@extends('template') 

 @section('title','Perfil') 
@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectDocumentos = document.getElementById('documentSelect');
        const subcategoriaSelect = document.getElementById('sel2'); // El segundo select
        const idDocumento = selectDocumentos.value;
                
        selectDocumentos.addEventListener('change', async function() {
            const idDocumento = selectDocumentos.value;
            

             // Si selecciona "Sin argumento" (valor 0), ocultamos el segundo select
            if (idDocumento === "0") {
                subcategoriaSelect.style.display = 'none';

            } else {
                subcategoriaSelect.style.display = 'block';
               
                
               try {
               
                    // Hacemos la consulta al servidor usando fetch
                    const response = await fetch("{{ route('realizarconsulta') }}", {
                         method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id: idDocumento
                        }) 

                    });
                    console.log(idDocumento);

                    // Verificamos si la respuesta fue exitosa
                    if (!response.ok) {
                        throw new Error('Hubo un problema al enviar los datosxDDD.');
                    } 

                    // Procesamos los datos recibidos
                    const data = await response.json();
                    console.log('Datos recibidos del servidor:', data);

                    if (data != null && data.uaS) {
                        // Limpiamos y mostramos las opciones de la Unidad Administrativa
                        subcategoriaSelect.innerHTML = "<option value='1'>Seleccione el tipo de Componente </option>";
                        data.uaS.forEach(element => {
                            subcategoriaSelect.innerHTML +=
                                `<option value='${element.id}'>${element.descripcion}</option>`;
                            console.log(element.nombre);
                        });
                    } else {
                        // Si no hay datos, ocultamos el select
                        subcategoriaSelect.style.display = "none";
                    }  
                } catch (error) {
                    console.error('Error:', error);
                    // Si hay un error, puedes ocultar el select también
                    subcategoriaSelect.style.display = "none";
                }
            }
        }); 
    });
</script>
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
    title: `<strong>Añadir Bien </strong>`,
    html: `
            <form action="{{route('inventario.store')}}" method="post">
        @csrf
        <div class="row g-3">
            <div class="col-md-12">
                <label for="nombre" class="form-label"> Numero de Inventario:</label>
                <input type="text" name="numInventario" id="numInventario" class="form-control"{{old('numInventario')}}>
                @error('numeroInventario')
                    <small class="text-danger">{{'*'.$message}}</small>
                @enderror 

            </div>
            <div class="col-md-12">
                <label for="nombre" class="form-label"> Numero de Serie:</label>
                <input type="text" name="numSerie" id="numSerie" class="form-control"{{old('numSerie')}} >
                @error('numeroSerie')
                    <small class="text-danger">{{'*'.$message}}</small>
                @enderror 

            </div>

            <div class="col-md-12">
                <label for="nombre" class="form-label">Categoria del bien:</label>
                <select name="tipoCat" class="form-control" onclick="mc()" id="documentSelect">
                    
                        <option value="2"><b>Sin argumento</b></option>
                    </optgroup>
                
                </select>
            </div>
            
            <div class="col-md-12">
                <select name="tipoComp" class="form-control" id="sel2" style="display:none;">
                    <option value=""><b>Componente.</b></option>
                </select>
            </div>
            
        


            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary"> Guardar</button>
            </div>
            
        </div>
    </form>
</div>



        
    `,
    /* imageUrl: "{{ asset('assets/img/prueba.ico') }}",  */   
     showCloseButton: true, 
    
    
});
</script> 


@endsection


<script>
     
    document.addEventListener('DOMContentLoaded', function() {
        const selectDocumentos = document.getElementById('documentSelect');
        const subcategoriaSelect = document.getElementById('sel2');

        selectDocumentos.addEventListener('change', async function() {
            const idDocumento = selectDocumentos.value;
            
            // Si selecciona "Sin argumento" (valor 0), ocultamos el segundo select
            if (idDocumento === "0") {
                subcategoriaSelect.style.display = 'none';
            } else {
                subcategoriaSelect.style.display = 'block';
                
                try {
                    // Hacemos la consulta al servidor usando fetch
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
<script>
   async function mc() {
        const selectDocumentos = document.getElementById('documentSelect');
        
     /*    try {
            // Hacemos la consulta al servidor usando fetch sin enviar un cuerpo de solicitud
            const response = await fetch("{{route('mostrar_categoria')}}", {
                method: 'GET',  // Sending a POST request
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Ensuring CSRF token is sent
             }
            });

            if (!response.ok) {
                throw new Error('Hubo un problema al enviar los datos :c.',response);
            }

            const data = await response.json();
            
            console.log(data);  // Muestra los datos para depuración

            if (data != null && data.uaS && Array.isArray(data.uaS)) {
                // Limpiamos las opciones del select
                let optionsHTML = "<option value='1'>Seleccione la categoria </option>";

                // Llenamos el select con las opciones de uaS
                data.uaS.forEach(element => {
                    optionsHTML += `<option value='${element.id}'>${element.nombre}</option>`;
                });

                selectDocumentos.innerHTML = optionsHTML;
            } else {
                console.log('No se encontraron subcategorías (uaS) o la estructura es incorrecta.');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    } */


    selectDocumentos.addEventListener('click', async function() {
            const idDocumento = selectDocumentos.value;
            
            // Si selecciona "Sin argumento" (valor 0), ocultamos el segundo select
            
            try {
            // Hacemos la consulta al servidor usando fetch sin enviar un cuerpo de solicitud
            const response = await fetch("{{route('mostrar_categoria')}}", {
                method: 'GET',  // Sending a POST request
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Ensuring CSRF token is sent
             }
            });

            if (!response.ok) {
                throw new Error('Hubo un problema al enviar los datos :c.',response);
            }

            const data = await response.json();
            
            console.log(data);  // Muestra los datos para depuración

            if (data != null && data.uaS && Array.isArray(data.uaS)) {
                // Limpiamos las opciones del select
                let optionsHTML = "<option value='1'>Seleccione la categoria </option>";

                // Llenamos el select con las opciones de uaS
                data.uaS.forEach(element => {
                    optionsHTML += `<option value='${element.id}'>${element.nombre}</option>`;
                });

                selectDocumentos.innerHTML = optionsHTML;
            } else {
                console.log('No se encontraron subcategorías (uaS) o la estructura es incorrecta.');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    
        });
   



    }

                                
    </script>






@push('js')




<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{asset('js/datatables-simple-demo.js')}}"></script> 
<script src="{{asset('js/menusitos.js')}}"></script> 
@endpush