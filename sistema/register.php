<?php
require "conexion.php";
session_start();
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dni = $_POST['DNI']; // Nuevo campo DNI
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $pass_c = sha1($password);

    // Verificar si el usuario ya existe
    $sql_check = "SELECT DNI FROM usuario WHERE usuario='$usuario'";
    $resultado_check = $mysqli->query($sql_check);

    if ($resultado_check->num_rows > 0) {
        $mensaje = "⚠️ El usuario ya existe. Intenta con otro nombre.";
    } else {
        // Insertar nuevo usuario incluyendo el DNI como PK
        $sql_insert = "INSERT INTO usuario (DNI, usuario, password, nombre, tipo_usuario) 
                       VALUES ('$dni', '$usuario', '$pass_c', '$usuario', 2)";
        if ($mysqli->query($sql_insert)) {
            $mensaje = "✅ Registro exitoso. Ahora puedes iniciar sesión.";
        } else {
            $mensaje = "❌ Error al registrar. Inténtalo de nuevo.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema Web - Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #0e0f12;
            color: #fff;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .container-register {
            display: flex;
            width: 100%;
            max-width: 950px;
            background-color: #14151a;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        }

        .form-control::placeholder {
            color: #9ca3af;
            opacity: 1;
        }

        .register-form {
            flex: 1;
            padding: 50px;
            min-width: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-form h1 {
            text-align: center;
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 2rem;
            color: #4f46e5;
        }

        .register-form p {
            text-align: center;
            color: #9ca3af;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 6px;
        }

        .form-control {
            background-color: #1e1f25;
            border: none;
            color: white;
            border-radius: 8px;
            padding: 12px;
        }

        .form-control:focus {
            background-color: #1e1f25;
            color: white;
            box-shadow: 0 0 0 2px #6366f1;
        }

        .btn-register {
            background-color: #6366f1;
            border: none;
            color: white;
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .btn-register:hover {
            background-color: #4f46e5;
        }

        .mensaje {
            text-align: center;
            font-size: 0.95rem;
            margin-top: 15px;
        }

        .mensaje.ok {
            color: #34d399;
        }

        .mensaje.error {
            color: #f87171;
        }

        .login-text {
            margin-top: 25px;
            text-align: center;
            font-size: 0.9rem;
        }

        .login-text a {
            color: #818cf8;
            text-decoration: none;
        }

        .login-text a:hover {
            text-decoration: underline;
        }

        .image-side {
            flex: 1;
            background: url('https://images.unsplash.com/photo-1531297484001-80022131f5a1?auto=format&fit=crop&w=1200&q=80') no-repeat center center;
            background-size: cover;
            position: relative;
        }

        .image-side::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(14, 15, 18, 0.4);
        }

        @media (max-width: 768px) {
            .container-register {
                flex-direction: column;
                max-width: 95%;
            }

            .image-side {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container-register">
        <div class="register-form">
            <h1>Crear Cuenta</h1>
            <p>Regístrate para acceder al sistema</p>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">DNI</label>
                    <input type="text" name="DNI" class="form-control" placeholder="Ingresa tu DNI" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="usuario" class="form-control" placeholder="Crea tu usuario" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="Crea tu contraseña" required>
                </div>

                <?php if (!empty($mensaje)) : ?>
                    <div class="mensaje <?= str_contains($mensaje, '✅') ? 'ok' : 'error' ?>"><?= $mensaje ?></div>
                <?php endif; ?>

                <button type="submit" class="btn-register">Registrarme</button>

                <div class="login-text">
                    ¿Ya tienes una cuenta? <a href="index.php">Inicia sesión</a>
                </div>
            </form>
        </div>
        <div class="image-side"></div>
    </div>
</body>

</html>