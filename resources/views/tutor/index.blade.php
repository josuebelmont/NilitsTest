@if (Auth::check())
    @extends('layouts.layout')

    @section('title', 'Tutorados')

    @section('content')
        <div class="container mt-5">
            <!-- Encabezado con el título y la opción de cerrar sesión -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">NILITS</h1>
                <form method="POST" class="btn btn-danger mt-3" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn text-light" type="submit">Cerrar Sesión</button>
                </form>
            </div>
            <h2 class="mb-4 bg-warning text-light">Gestión de tutorados</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Estatus</th>
                            <th>Último Dictamen</th>
                            <th>Listado de dictámenes</th>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('.modal').on('shown.bs.modal', function() {
                    $(this).find('.select2').select2({
                        theme: 'bootstrap4'
                    });
                });
            });
        </script>
    @endsection
@endif
