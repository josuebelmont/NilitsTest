<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
        }

        .login-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .login-container .btn {
            width: 100%;
            margin-bottom: 10px;
        }

        .form-control {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="text-center mb-4">
            <img src="{{ asset('imgs/LOGOfuenteNILITS.png') }}" alt="Logo" style="width: 150px;">
            <!-- Replace 'logo.png' with your actual logo path -->

        </div>
        <form method="POST" action="{{ route('login') }}">
             <!-- Directiva Blade para el token CSRF -->

             @csrf


            <div class="form-group">
                <label for="inputUsuario">Usuario</label>
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Usuario" required autofocus>
            </div>
            <div class="form-group">
                <label for="inputPassword">Contraseña</label>
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Contraseña" required>
            </div>
            <button class="btn btn-lg btn-warning btn-block text-light" type="submit">Iniciar Sesión</button>

            <!-- Resto del código -->
        </form>



            <button class="btn btn-lg btn-warning btn-block text-light" type="button" data-toggle="modal"
                data-target="#registroProfesorModal">Darme de Alta</button>



            <!-- Modal de Registro de Profesor -->
            <div class="modal fade" id="registroProfesorModal" tabindex="-1" role="dialog"aria-labelledby="modalRegistroLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalRegistroLabel">Darse de alta en el sistema</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="registroProfesorForm" method="POST" action="{{ route('registro') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="nombre">Código de profesor</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" name="pass" id="pass" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword">Confirma tu contraseña</label>
                                    <input type="password" class="form-control" name="pass2" id="pass2" required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn  btn-warning text-light" form="registroProfesorForm">Completar
                                Registro</button>
                        </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-lg btn-warning btn-block text-light" href="{{ route('alumnado') }}">Ver Alumnado</a>







    </div>



    <!-- Bootstrap JS and its dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
