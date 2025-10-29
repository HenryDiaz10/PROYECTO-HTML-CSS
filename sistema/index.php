<?php
require "conexion.php";
session_start();
$error = "";
//COMENTARIO
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $sql = "SELECT DNI, password, nombre, tipo_usuario FROM usuario WHERE usuario='$usuario'";
    $resultado = $mysqli->query($sql);
    $num = $resultado->num_rows;

    if ($num > 0) {
        $row = $resultado->fetch_assoc();
        $password_bd = $row['password'];
        $pass_c = sha1($password);

        if ($password_bd == $pass_c) {
            $_SESSION['DNI'] = $row['DNI'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
            header("Location: principal.php");
            exit;
        } else {
            $error = "⚠️ La contraseña no coincide.";
        }
    } else {
        $error = "⚠️ El usuario no existe.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema Web - Iniciar Sesión</title>
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

        .container-login {
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

        /* Panel izquierdo: formulario */
        .login-form {
            flex: 1;
            padding: 50px;
            min-width: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form h1 {
            text-align: center;
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 2rem;
            color: #4f46e5;
        }

        .login-form p {
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

        .btn-login {
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

        .btn-login:hover {
            background-color: #4f46e5;
        }

        .alerta {
            color: #f87171;
            font-size: 0.9rem;
            text-align: center;
            margin-top: 15px;
        }

        .register-text {
            margin-top: 25px;
            text-align: center;
            font-size: 0.9rem;
        }

        .register-text a {
            color: #818cf8;
            text-decoration: none;
        }

        .register-text a:hover {
            text-decoration: underline;
        }

        /* Imagen lateral derecha */
        .image-side {
            flex: 1;
            background: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1200&q=80') no-repeat center center;
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
            .container-login {
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
    <div class="container-login">
        <div class="login-form">
            <h1>Sistema Web</h1>
            <p>Inicia sesión para continuar</p>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="usuario" class="form-control" placeholder="Ingresa tu usuario" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required>
                </div>

                <?php if (!empty($error)) : ?>
                    <div class="alerta"><?= $error ?></div>
                <?php endif; ?>

                <button type="submit" class="btn-login">Iniciar sesión</button>

                <div class="register-text">
                    ¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a>
                </div>
            </form>
        </div>
        <div class="image-side"></div>
    </div>
</body>

</html>