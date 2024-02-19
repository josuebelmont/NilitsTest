@if (Auth::check())


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>gestion de tutores</title>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>


    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1>NILITS</h1>
            <form method="POST" class="btn btn-danger mt-3" action="{{ route('logout') }}">
                @csrf
                <button class="btn text-light" type="submit">
                    Cerrar Sesión
                </button>
            </form>
        </div>

        <h2 class="mb-4 bg-warning text-light">Gestionar profesores</h2>

        <!-- Selector de Tutores -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="mb-5">
                    <select class="form-control" id="selectTutor">
                        <option value="">Selecciona un tutor</option>
                        @foreach ($maestros as $maestro)
                            <option value="{{ $maestro->codigo }}" data-nombre="{{ $maestro->Nombre }}"
                                data-carga-horaria="{{ $maestro->cargaHoraria }}"
                                data-numero-tutorados="{{ $maestro->NumeroTutorados }}"
                                data-grado="{{ $maestro->grado }}" data-nombramiento="{{ $maestro->nombramiento }}">
                                {{ $maestro->Nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div id="infoMaestro">
                    <h3>Información del Maestro</h3>
                    <p id="cargaHoraria">Carga Horaria: </p>
                    <p id="numeroTutorados">Número de Tutorados: </p>
                    <p id="grado">Grado: </p>
                    <p id="nombramiento">Nombramiento: </p>
                    <!-- Botones o links para generar documentos -->
                    <button id="btnOficioAsignacion" class="btn btn-primary" >Oficio de Asignación</button>
                    <button id="btnConstanciaTutoria" class="btn btn-secondary" >Constancia de Tutoría</button>

                    <button class="btn btn-primary" onclick="location.href='{{ url('/home') }}'">Volver al Menú</button>
                </div>






    <script>
        function aplicarAsignacion() {
            // Lógica para aplicar la asignación
        }

        function cerrarCiclo() {
            // Lógica para cerrar el ciclo
        }
    </script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery (necesario para los plugins de JavaScript de Bootstrap 4) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#selectTutor').change(function() {
                var selected = $(this).find('option:selected');
                var cargaHoraria = selected.data('carga-horaria') || 'No especificado';
                var numeroTutorados = selected.data('numero-tutorados') || 'No especificado';
                var grado = selected.data('grado') || 'No especificado';
                var nombramiento = selected.data('nombramiento') || 'No especificado';

                // Actualizar la información del maestro
                $('#cargaHoraria').text("Carga Horaria: " + cargaHoraria);
                $('#numeroTutorados').text("Número de Tutorados: " + numeroTutorados);
                $('#grado').text("Grado: " + grado);
                $('#nombramiento').text("Nombramiento: " + nombramiento);

                // Aquí puedes añadir lógica para mostrar u ocultar los botones basado en la información disponible
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            var tutoradosData = ''; // Almacena los datos de los tutorados aquí

            // Evento change del select
            $('#selectTutor').change(function() {
                var maestroId = $(this).val(); // Obtiene el ID del maestro seleccionado
                if (maestroId) {
                    $.ajax({
                        url: 'maestros/tutorados/' +
                        maestroId, // Asegúrate de que esta URL es correcta
                        type: 'GET',
                        success: function(data) {
                            tutoradosData = '<h5>Tutorados</h5>'; // Reinicia la variable
                            if (data.length > 0) {
                                data.forEach(function(tutorado) {
                                    // Ajusta esto según la estructura de tus datos
                                    tutoradosData += '<p>' + tutorado.Nombre + '</p>';
                                    //console.log(data);
                                });
                            } else {
                                tutoradosData = '<p>No hay tutorados asignados.</p>';
                            }
                            // No necesitas mostrar el modal aquí; se mostrará a través del botón ya configurado para ello
                        },
                        error: function(error) {
                            console.log(error);
                            tutoradosData = '<p>Error al cargar los tutorados.</p>';
                        }
                    });
                }
            });

            // Escucha el evento para abrir el modal
            $('#exampleModal').on('show.bs.modal', function() {
                if ($('#selectTutor').val()) {
                    $('#exampleModal .modal-body').html(tutoradosData);
                } else {
                    $('#exampleModal .modal-body').html(
                        '<p>Por favor, seleccione un maestro para ver sus tutorados.</p>');
                }
            });


        });
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btnConstanciaTutoria').addEventListener('click', function() {
            var selectTutor = document.getElementById('selectTutor');
            var codigoMaestro = selectTutor.value;

            if (codigoMaestro) {
                window.location.href = '{{ url('/generar-constancia-tutoria') }}' + '?codigo=' + codigoMaestro;
            } else {
                alert('Por favor, selecciona un tutor antes de generar la constancia.');
            }
        });
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btnOficioAsignacion').addEventListener('click', function() {
            var selectTutor = document.getElementById('selectTutor');
            var codigoMaestro = selectTutor.value;

            if (codigoMaestro) {
                window.location.href = '{{ url('/generar-oficio-asignacion') }}' + '?codigo=' + codigoMaestro;
            } else {
                alert('Por favor, selecciona un tutor antes de generar la constancia.');
            }
        });
    });
</script>




    <!-- Bootstrap JS and its dependencies -->

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.5/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</body>

</html>

@else
<script>
    window.location = "{{ url('/') }}";
</script>
@endif
