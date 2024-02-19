@if (Auth::check())
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Tutorados</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <body>



        <div class="container mt-5">
            <!-- Encabezado con el título y la opción de cerrar sesión -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">NILITS</h1>

                <form method="POST" class="btn btn-danger mt-3" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn text-light" type="submit">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
            <h2 class="mb-4 bg-warning text-light">Gestion de tutorados</h2>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Correo</th>

                            <th>Estatus</th>
                            <th>Ultimo Dictamen</th>
                            <th>Listado de dictamenes</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumnos as $alumno)
                            <tr>
                                <td>{{ $alumno->codigo }}</td>
                                <td>{{ $alumno->Nombre }}</td>
                                <td>{{ $alumno->correo }}</td>

                                <td>
                                    @if ($alumno->estatus == 1)
                                        Activo
                                    @elseif ($alumno->estatus == 3)
                                        Egresado
                                    @elseif ($alumno->estatus == 4)
                                        Baja
                                    @else
                                        Otro
                                    @endif
                                </td>

                                <td>
                                    @php
                                        $dictamenes = explode('.', $alumno->dictamen);
                                        natsort($dictamenes);
                                        $dictamenActual = end($dictamenes);
                                    @endphp
                                    {{ $dictamenActual }}
                                </td>
                                <td>
                                    <i class="fas fa-edit" role="button" data-toggle="modal"
                                        data-target="#editAlumnoModal{{ $alumno->codigo }}"></i>
                                </td>



                            </tr>

                            <div class="modal fade" id="editAlumnoModal{{ $alumno->codigo }}" tabindex="-1"
                                role="dialog" aria-labelledby="editAlumnoModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editAlumnoModalLabel">Editar Alumno
                                                {{ $alumno->Nombre }}</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('/alumnos/update/', $alumno->codigo) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <!-- Campos del formulario -->
                                                <input type="hidden" id="editCodigo" name="codigo" readonly>
                                                <div class="form-group">
                                                    <label for="codigo">Código</label>
                                                    <input type="text" class="form-control" id="codigo"
                                                        name="codigo" value="{{ $alumno->codigo }}" required readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombre">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre"
                                                        name="nombre" value="{{ $alumno->Nombre }}" required readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="correo">Correo</label>
                                                    <input type="email" class="form-control" id="correo"
                                                        value="{{ $alumno->correo }}" name="correo" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="telefono">Telefono</label>
                                                    <input type="text" class="form-control" id="telefono"
                                                        value="{{ $alumno->telefono }}" name="telefono" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="telefono">Calendario de ingreso</label>
                                                    <input type="text" class="form-control" name=""
                                                        id="" value="{{ $alumno->ingreso }}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="genero">Genero</label>
                                                    @if ($alumno->sexo == 1)
                                                        <input type="text" class="form-control" value="Femenino"
                                                            readonly>
                                                    @else
                                                        <input type="text" class="form-control" value="Masculino"
                                                            readonly>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="procedencia">Procedencia</label>
                                                    <input type="text" class="form-control" id="procedencia"
                                                        name="procedencia" value="{{ $alumno->nombre_estado }}"
                                                        readonly>


                                                </div>

                                                <div class="form-group">
                                                    <label for="fechaNac">Fecha de Nacimiento</label>
                                                    <input type="text" class="form-control" id="fechaNac"
                                                        name="fechaNac" value="{{ $alumno->fechaNac }}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="egreso">Calendario de Egreso</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $alumno->calendarioTitulacion }}" readonly>

                                                </div>
                                                <div class="form-group">
                                                    <label for="opcionTitulacion">Opción de Titulacion</label>
                                                    <input type="text" class="form-control" id="opcionTitulacion"
                                                        name="opcionTitulacion" value="{{ $alumno->tipoTitulacion }}"
                                                        readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fechaTitulacion">Fecha de titulacion</label>
                                                    <input type="text" class="form-control" id="fechaTitulacion"
                                                        name="fechaTitulacion" value="{{ $alumno->fechaTitulacion }}"
                                                        readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="estatus">Estatus del Alumno</label>
                                                    @if ($alumno->estatus == 1)
                                                        <input type="text" class="form-control" value="Activo"
                                                            readonly>
                                                    @elseif ($alumno->estatus == 4)
                                                        <input type="text" class="form-control" value="Baja"
                                                            readonly>
                                                    @elseif ($alumno->estatus == 3)
                                                        <input type="text" class="form-control" value="Egresado"
                                                            readonly>
                                                    @endif

                                                </div>
                                                <div class="form-group">
                                                    <label for="acta">Acta</label>
                                                    <input type="text" class="form-control" id="acta"
                                                        name="acta" value="{{ $alumno->acta }}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="libro">Libro</label>
                                                    <input type="text" class="form-control" id="libro"
                                                        name="libro" value="{{ $alumno->libro }}" readonly>
                                                </div>
                                                <div class="form-group">

                                                    <h4>Listado de dictamenes</h4>
                                                    @php
                                                        $dictamenes = explode('.', $alumno->dictamen);
                                                    @endphp
                                                    <ul>
                                                        @foreach ($dictamenes as $dictamen)
                                                            <input type="text" class="form-control"  value="{{ $dictamen }}" readonly>
                                                        @endforeach
                                                        <div id="dictamenContainer"></div>
                                                        <input type="hidden" name="dictamen" id="dictamenHidden">
                                                </div>




                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>




                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>



            <!-- Incluir Bootstrap JS y sus dependencias -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.5/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
                integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />
            <!-- Select2 CSS -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

            <!-- Select2 JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
                integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>



    </body>

    </html>

@endif
