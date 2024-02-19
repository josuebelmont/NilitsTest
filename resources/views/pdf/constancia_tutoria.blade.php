<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Constancia</title>
    <style>
        .col-md-6 {
            width: 50%; /* Ancho fijo para cada columna */
            float: left; /* Flota cada columna a la izquierda */
            box-sizing: border-box; /* Asegura que el padding y border estén incluidos en el ancho */
            text-align: center;
        }
        .clear-fix {
            clear: both; /* Asegura que no haya elementos flotantes después de estos elementos */
        }
        /* Estilos adicionales para la visualización de los textos */
        .col-md-6 p {
            margin: 0; /* Elimina el margen predeterminado de los párrafos */
            padding: 10px;
             /* Añade algo de padding para evitar que el texto toque los bordes del `div` */
        }
        .col-md-6:first-child {
            /* Fondo azul para la primera columna */
            color: black; /* Texto blanco para la primera columna */
        }
        .col-md-6:last-child {
            /* Fondo gris para la segunda columna */
            color: black; /* Texto negro para la segunda columna */
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .header,
        .footer {
            text-align: center;
        }
        .title {
            font-weight: bold;

        }
        .content {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .signature {
            margin-top: 40px;
            text-align: center;
        }
        .page-break {
            page-break-after: avoid;
        }
    </style>
</head>
<body>
    <div class="header" >
        <img src="{{ asset('imgs/logo.png') }}" alt="Logo" style="width: 100%; height: 15%;"> <!-- Asegúrate de ajustar la ruta a tu logo -->

    </div>

    <div class="content " >
        <div class="d-flex align-items-center justify-content-center text-center" style="height: 100vh; text-align: center;">
            <div>
                <h2 class="title">SE OTORGA LA PRESENTE</h2>
                <h3>CONSTANCIA</h3>
                <p>A:</p>
                <p><strong>{{$maestro->grado}} {{$maestro->Nombre}} {{$maestro->Apellido}}</strong></p>
            </div>
        </div>








        <p>Por haber impartido tutoría académica y permanente de 18 alumnos del Programa de Noviciado en la Licenciatura en Trabajo Social:</p>

        <div style="display: flex; width: 100%;">
            {{-- Primera mitad de tutorados --}}
            <table style="width: 50%; font-size:80%; margin-right: 10px; float: left;">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tutorados->take($half) as $tutorado)
                    <tr >
                        <td>{{ $tutorado->codigo }}</td>
                        <td>{{ $tutorado->Nombre }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Segunda mitad de tutorados --}}
            <table style="width: 50%; font-size:80%; float: left;">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tutorados->skip($half) as $tutorado)
                    <tr>
                        <td>{{ $tutorado->codigo }}</td>
                        <td>{{ $tutorado->Nombre }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>




        <div class="signature">
            <p style="clear: both; text-align: left;" >Durante el ciclo escolar 2023 B, periodo comprendido del 16 julio de 2023 al 15 de enero de 2024, según consta en informe presentado en tiempo y forma.</p>
            <p>Atentamente</p>
            <p>"Piensa y Trabaja"</p>
            <p>Año del Legado de Frey Antonio Alcalde en Guadalajara</p>
            <p>Guadalajara, Jal., a 3 de febrero de 2024</p>


        </div>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-md-6">
            <p>Dr. Ricardo Fletes Corona</p>
            <p>Jefe del Departamento de Desarrollo Social</p>
        </div>
        <div class="col-md-6">
            <p>Dra. María Rosas Moreno</p>
            <p>Coordinadora de Carrera de la NILITS</p>
        </div>
        <div class="clear-fix"></div> <!-- Clear fix para asegurarnos de que el flujo del documento continúa normalmente después de los elementos flotantes -->
    </div>

    <div class="footer page-break">
        <p>Coordinadora de Tutorías de la NILITS</p>
        <p>Av. de los Maestros y Alcalde, Edificio "N" 2da. planta, Col. La Normal</p>
        <p>Guadalajara, Jal., México</p>
    </div>
</body>
</html>
