<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestionar Alumnos sin tutor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<style>
    svg {
   height: 20px; /* Oculta los SVG */

}
.pagination-info {
   display: none;
}


</style>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1>NILITS</h1>
            <form method="POST" class="btn btn-danger mt-3" action="{{ route('logout') }}">
                @csrf
                <button class="btn text-light" type="submit">
                    Cerrar Sesión
                </button>
            </form>
        </div>
        <h2 class="mb-4 bg-warning text-light">Gestionar Alumnos sin tutor</h2>

        <form action="{{ route('buscarAlumno') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Buscar alumno por nombre" name="query">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">Buscar</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Estatus</th>
                        <th>Ultimo Dictamen</th>
                        <th>Datos</th>
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


                            <!-- Botón para activar el modal -->
                            <td>


                                <i class="fas fa-edit" role="button" data-toggle="modal"
                                    data-target="#editAlumnoModal{{ $alumno->codigo }}"></i>
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
                                            <form method="POST"
                                                action="{{ route('/alumnos/asingnar/', $alumno->codigo) }}">
                                                {!! csrf_field() !!}
                                                {{ method_field('PUT') }}
                                                <div class="modal-body">
                                                    <!-- Campos del formulario -->
                                                    <input type="hidden" id="codigo" name="codigo">
                                                    <div class="form-group">
                                                        <label for="codigo">Código</label>
                                                        <input type="text" class="form-control" id="codigo"
                                                            name="codigo" value="{{ $alumno->codigo }}" required
                                                            readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nombre">Nombre</label>
                                                        <input type="text" class="form-control" id="nombre"
                                                            name="nombre" required value="{{ $alumno->Nombre }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="correo">Correo</label>
                                                        <input type="email" class="form-control" id="correo"
                                                            name="correo" value="{{ $alumno->correo }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telefono">Telefono</label>
                                                        <input type="text" class="form-control" id="telefono"
                                                            name="telefono" value="{{ $alumno->telefono }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ingreso">Calendario de Ingreso</label>
                                                        <input type="text" class="form-control" id="ingreso"
                                                            name="ingreso" value="{{ $alumno->ingreso }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="genero">Genero</label>
                                                        <select class="form-control" id="genero" name="genero">
                                                            <option value="Masculino">Masculino</option>
                                                            <option value="Femenino">Femenino</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="procedencia">Procedencia</label>
                                                        <select class="form-control" name="procedencia">
                                                            <option value="0">Aguascalientes</option>
                                                            <option value="1">Baja California</option>
                                                            <option value="2">Baja California Sur</option>
                                                            <option value="3">Campeche</option>
                                                            <option value="4">Chiapas</option>
                                                            <option value="5">Chihuahua</option>
                                                            <option value="6">Ciudad de México</option>
                                                            <option value="7">Coahuila</option>
                                                            <option value="8">Colima</option>
                                                            <option value="9">Durango</option>
                                                            <option value="10">Guanajuato</option>
                                                            <option value="11">Guerrero</option>
                                                            <option value="12">Hidalgo</option>
                                                            <option value="13">Jalisco</option>
                                                            <option value="14">México</option>
                                                            <option value="15">Michoacán</option>
                                                            <option value="16">Morelos</option>
                                                            <option value="17">Nayarit</option>
                                                            <option value="18">Nuevo León</option>
                                                            <option value="19">Oaxaca</option>
                                                            <option value="20">Puebla</option>
                                                            <option value="21">Querétaro</option>
                                                            <option value="22">Quintana Roo</option>
                                                            <option value="23">San Luis Potosí</option>
                                                            <option value="24">Sinaloa</option>
                                                            <option value="25">Sonora</option>
                                                            <option value="26">Tabasco</option>
                                                            <option value="27">Tamaulipas</option>
                                                            <option value="28">Tlaxcala</option>
                                                            <option value="29">Veracruz</option>
                                                            <option value="30">Yucatán</option>
                                                            <option value="31">Zacatecas</option>
                                                        </select>




                                                    </div>

                                                    <div class="form-group">
                                                        <label for="fechaNac">Fecha de Nacimiento</label>
                                                        <input type="date" class="form-control" id="fechaNac"
                                                            name="fechaNac" value="{{ $alumno->fechaNac }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="egreso">Calendario de Egreso</label>
                                                        <input type="text" class="form-control" id="egreso"
                                                            name="egreso"
                                                            value="{{ $alumno->calendarioTitulacion }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="opcionTitulacion">Opción de Titulacion</label>
                                                        <input type="text" class="form-control"
                                                            id="opcionTitulacion" name="opcionTitulacion"
                                                            value="{{ $alumno->tipoTitulacion }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fechaTitulacion">Fecha de titulacion</label>
                                                        <input type="date" class="form-control"
                                                            id="fechaTitulacion" name="fechaTitulacion">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="estatus">Estatus del Alumno</label>
                                                        <select class="form-control" id="estatus" name="estatus">
                                                            <option value="Activo">Activo</option>
                                                            <option value="Baja">Baja</option>
                                                            <option value="Titulado">Titulado</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="acta">Acta</label>
                                                        <input type="text" class="form-control" id="acta"
                                                            name="acta" value="{{ $alumno->acta }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="libro">Libro</label>
                                                        <input type="text" class="form-control" id="libro"
                                                            name="libro" value="{{ $alumno->libro }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="genero">tutor</label>
                                                        <select class="form-control" name="tutor" id="tutor">
                                                            @foreach ($tutores as $tutor)
                                                                <option value="{{ $tutor->codigo }}">
                                                                    {{ $tutor->Nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dictamen">Dictámenes</label>
                                                        <input type="text" class="form-control" id="dictamenInput"
                                                            placeholder="Añadir dictamen">
                                                        <div id="dictamenContainer"></div>
                                                        <input type="hidden" name="dictamen" id="dictamenHidden"
                                                            value="{{ $alumno->dictamen }}">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar
                                                        Cambios</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                            </td>
                        </tr>




                        </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="mb-5">
                {{ $alumnos->appends(request()->query())->links() }}
            </div>


        </div>
        <a href="{{ route('/home') }}" class="btn btn-secondary">Volver al menu</a>
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
