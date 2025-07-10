 <html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Tabla de Personal</title>
    <style>
        /* Asegurarse de que las tablas tienen bordes visibles */
        table {
            width: 100%;
           /*  height: 3000px; */
           border-collapse: collapse;  /* Elimina el espacio entre los bordes */
        }

        /* Bordes visibles en las celdas */
        th, td {
            padding: 5px;
            text-align: left;
            border: 1px solid rgb(159,34,65); /* Borde entre celdas */
        }

        /* Fondo de la cabecera de la tabla */
        .cabecera {
            background-color: rgba(159,34,65);
            color: white;
            text-align: center;
        }

        /* Estilo de pie de página */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background-color: rgba(159,34,65);
            text-align: center;
            line-height: 20px;
            font-size: 12px;
            color: white;
        }

        /* Estilo de encabezado */
        header {
            text-align: center;
            /* margin: 5px 0; */
        }

        header h1 {
            font-size: 18px;
            color: rgba(159,34,65);
        }

        .content {
            margin-top: 10px; /* Ajuste para que no se sobreponga con el header */
            
           overflow-y: auto;  
           
        }

   

    </style>
</head>

<body>

    <header>
        <h1>Información de Personal - Centro de Atención Telefónica</h1>
    </header>

    <main>
        <div class="content container mt-5">
            <table id="datatablesSimple" class="table table-striped">
                <thead class="cabecera">
                    <tr>
                        <th>Nombre</th>
                        <th>Puesto</th>
                        <th>Estación de Trabajo</th>
                        <th>Horario Laboral</th>
                        <th>Horario de Comida</th>
                        <th>Horario de Descanso</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personal as $persona)
                        <tr>
                            <td>{{ $persona->nombre }}</td>
                            <td>{{ $persona->id_rol }}</td>
                            <td>{{ $persona->estacion }}</td>
                            <td>{{ $persona->jlaborals }}</td>
                            <td>{{ $persona->hcomidas }}</td>
                            <td>{{ $persona->hdescansos }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <p>Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y') }} | Personal Adscrito - Centro de Atención Telefónica del Gobierno del Estado de México</p>
    </footer>

</body>
</html>
