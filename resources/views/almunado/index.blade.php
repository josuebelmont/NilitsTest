@extends('layout')

@section('title', 'Gestionar Alumnos')

@section('content')
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1>NILITS</h1>
        <a class="btn btn-warning text-light" href="{{ route('/') }}">Volver al inicio</a>
    </div>
    <h2 class="mb-4 bg-warning text-light">Gestionar Alumnos</h2>

    <!-- Formulario de búsqueda -->
    <form action="{{ route('/buscar-alumno/restricted') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Buscar alumno por nombre" name="query">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </div>
        </div>
    </form>

    <!-- Estadísticas rápidas -->
    <div class="row mb-3">
        <div class="col-md-2 ml-5">
            <span>Total de registros: {{ $totalRegistros }}</span>
        </div>
        <div class="col-md-2">
            <span>Total de egresados: {{ $totalEgresados }}</span>
        </div>
        <div class="col-md-2">
            <span>Total de Activos: {{ $totalActivos }}</span>
        </div>
        <div class="col-md-2">
            <span>Total de Bajas: {{ $totalBajas }}</span>
        </div>
    </div>

    <!-- Tabla de alumnos -->
    <div class="table-responsive">
        <table class="table table-striped">
            <!-- Encabezados de la tabla -->
            <thead class="thead-light">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Estatus</th>
                    <th>Ultimo Dictamen</th>
                    <th>Tutor</th>
                    <th>Datos</th>
                </tr>
            </thead>
            <!-- Cuerpo de la tabla -->
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
                        <td>{{ $alumno->tutor }}</td>
                        <td>
                            <!-- Botón para activar el modal de edición -->
                            <i class="fas fa-edit" role="button" data-toggle="modal" data-target="#editAlumnoModal{{ $alumno->codigo }}"></i>
                            <!-- Modal de edición del alumno -->
                            <div class="modal fade" id="editAlumnoModal{{ $alumno->codigo }}" tabindex="-1" role="dialog" aria-labelledby="editAlumnoModalLabel" aria-hidden="true">
                                <!-- Contenido del modal -->
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editAlumnoModalLabel">Datos del alumno {{ $alumno->Nombre }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form>
                                            <div class="modal-body">
                                                <!-- Campos del formulario -->
                                                <input type="hidden" id="editCodigo" name="codigo" readonly>
                                                <div class="form-group">
                                                    <label for="codigo">Código</label>
                                                    <input type="text" class="form-control" id="codigo" name="codigo" value="{{ $alumno->codigo }}" required readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombre">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $alumno->Nombre }}" required readonly>
                                                </div>
                                                <!-- Más campos del formulario -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <!-- Agrega aquí más botones de acción si es necesario -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Paginación -->
    <div class="mb-5">
        {{ $alumnos->appends(request()->query())->links() }}
    </div>
@endsection
