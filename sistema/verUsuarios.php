<?php session_start();
require "conexion.php";
if (!isset($_SESSION['DNI'])) {
    header("Location: index.php");
    exit();
}
$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];

// --- Editar usuario --- 
if (isset($_POST['editar'])) {
    $DNI = $_POST['DNI'];
    $nuevo_tipo = $_POST['tipo_usuario'];
    $sql = "UPDATE usuario SET tipo_usuario = '$nuevo_tipo' WHERE DNI = '$DNI'";
    $mysqli->query($sql);
    header("Location: verUsuarios.php");
    exit();
}

// --- Eliminar usuario --- 
if (isset($_POST['eliminar'])) {
    $DNI = $_POST['DNI'];
    $sql = "DELETE FROM usuario WHERE DNI = '$DNI'";
    $mysqli->query($sql);
    header("Location: verUsuarios.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Usuarios</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            color: white;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            margin-top: 10px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 55px rgba(0, 0, 0, 0.5);
        }

        h1 {
            color: #1e1f29;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            color: white;
            border-collapse: collapse;
            width: 100%;
        }

        table th,
        table td {
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 10px;
        }

        thead {
            background-color: #6366f1;
        }

        tbody tr:hover {
            background-color: rgba(99, 102, 241, 0.15);
            color: #ffffff;
        }

        .alerta {
            margin: 50px auto;
            padding: 30px;
            border-radius: 15px;
            max-width: 600px;
            text-align: center;
            background: #1e1f29;
            box-shadow: 0 8px 25px rgba(255, 0, 0, 0.25), 0 4px 10px rgba(0, 0, 0, 0.4);
        }

        .alerta h2 {
            color: #ff4d4d;
            margin-bottom: 20px;
        }

        .alerta p {
            color: #e5e7eb;
            font-size: 1.2rem;
        }

        .alerta a {
            color: #6366f1;
            text-decoration: none;
            font-weight: bold;
        }

        .alerta a:hover {
            text-decoration: underline;
        }

        tbody tr:hover td,
        tbody tr:hover th {
            color: #ffffff !important;
            font-weight: 500;
        }

        .btn-accion {
            border: none;
            border-radius: 6px;
            padding: 6px 10px;
            color: white;
            cursor: pointer;
        }

        .btn-editar {
            background-color: #3b82f6;
        }

        .btn-eliminar {
            background-color: #ef4444;
        }

        .btn-accion:hover {
            opacity: 0.85;
        }

        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.6);
        }

        table tbody tr td {
            color: #ffffff;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="principal.php">Sistema web</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $nombre; ?> <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Configuración</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Cerrar cesión</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Se dejó igual:</div>
                        <a class="nav-link" href="principal.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> Dashboard
                        </a>
                        <?php if ($tipo_usuario == 1 or 2) { ?>
                            <div class="sb-sidenav-menu-heading">Info:</div>
                            <a class="nav-link" href="informacion.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div> Información
                            </a>
                            <a class="nav-link" href="sobreElCurso.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div> Sobre el curso
                            </a>
                        <?php } ?>
                        <?php if ($tipo_usuario == 1) { ?>
                            <div class="sb-sidenav-menu-heading">Se cambió:</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div> Op. de admin
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"> <a class="nav-link" href="verUsuarios.php">Ver Usuarios</a> </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div> Proyectos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth"> Mis proyectos
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Maqueta</a>
                                            <a class="nav-link" href="register.html">Estilo 1</a>
                                            <a class="nav-link" href="password.html">Estilo 2</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Hecho por:</div> Henry Diaz Tasayco - TB2
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <?php if ($tipo_usuario == 1): ?>
                        <h1 class="mt-4 text-center"> <i class="fas fa-users me-2"></i>Usuarios Registrados </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Ver Usuarios</li>
                        </ol>
                        <div class="card mb-4 border-0" style="border-radius: 15px; background: #1e1f29; box-shadow: 0 8px 25px rgba(99, 102, 241, 0.25), 0 4px 10px rgba(0,0,0,0.4); transition: transform 0.2s ease, box-shadow 0.3s ease;">
                            <div class="card-body">
                                <p class="fs-5 text-light text-center mb-4"> A continuación se muestra el listado de usuarios registrados en el sistema. </p>
                                <div class="table-responsive">
                                    <table class="table table-hover text-center align-middle">
                                        <thead style="background-color:#6366f1; color:#fff;">
                                            <tr>
                                                <th>DNI</th>
                                                <th>Nombre</th>
                                                <th>Tipo de Usuario</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT DNI, nombre, tipo_usuario FROM usuario ORDER BY DNI ASC";
                                            $resultado = $mysqli->query($sql);
                                            if ($resultado && $resultado->num_rows > 0) {
                                                while ($fila = $resultado->fetch_assoc()) {
                                                    $tipo = ($fila['tipo_usuario'] == 1) ? "<span class='badge bg-primary px-3 py-2'>Administrador</span>" : "<span class='badge bg-success px-3 py-2'>Estándar</span>";
                                                    echo "<tr> 
                                                            <td>{$fila['DNI']}</td> 
                                                            <td>{$fila['nombre']}</td> 
                                                            <td>{$tipo}</td> 
                                                            <td> 
                                                                <button class='btn-accion btn-editar' onclick='editarUsuario(\"{$fila['DNI']}\", {$fila['tipo_usuario']})'><i class=\"fas fa-edit\"></i></button> 
                                                                <button class='btn-accion btn-eliminar' onclick='eliminarUsuario(\"{$fila['DNI']}\")'><i class=\"fas fa-trash\"></i></button> 
                                                            </td> 
                                                        </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='4'>No hay usuarios registrados.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center text-muted px-3 px-sm-5">
                            <p><strong>Nota:</strong></p>
                            <p>El <strong>Administrador</strong> posee todos los permisos del sistema.</p>
                            <p>El <strong>Usuario Estándar</strong> cuenta con permisos limitados - Hace referencia a cualquier usuario creado desde el login.</p>
                        </div>
                    <?php else: ?>
                        <div class="alerta">
                            <h2>Acceso denegado</h2>
                            <p>Solo los <strong>administradores</strong> tienen acceso a esta sección.<br> Por favor, inicia sesión como administrador para ver este contenido.</p>
                            <p><a href="principal.php">Volver al Dashboard</a></p>
                        </div>
                    <?php endif; ?>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4 text-center text-muted"> Todos los Derechos Reservados - Henry Díaz &copy; 2025 </div>
            </footer>
        </div>
    </div>
    <!-- Modal de edición -->
    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" class="modal-content bg-dark text-light p-3 rounded">
                <h5 class="text-center mb-3">Editar Tipo de Usuario</h5>
                <input type="hidden" name="DNI" id="editar_DNI">
                <div class="mb-3">
                    <label for="tipo_usuario" class="form-label">Tipo de Usuario:</label>
                    <select name="tipo_usuario" id="editar_tipo" class="form-select">
                        <option value="1">Administrador</option>
                        <option value="2">Estándar</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" name="editar" class="btn btn-success">Confirmar cambios</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" class="modal-content bg-dark text-light p-3 rounded">
                <h5 class="text-center mb-3 text-danger">¿Estás seguro de eliminar este usuario?</h5>
                <input type="hidden" name="DNI" id="eliminar_DNI">
                <div class="text-center">
                    <button type="submit" name="eliminar" class="btn btn-danger">Confirmar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editarUsuario(DNI, tipo) {
            document.getElementById('editar_DNI').value = DNI;
            document.getElementById('editar_tipo').value = tipo;
            var modal = new bootstrap.Modal(document.getElementById('modalEditar'));
            modal.show();
        }

        function eliminarUsuario(DNI) {
            document.getElementById('eliminar_DNI').value = DNI;
            var modal = new bootstrap.Modal(document.getElementById('modalEliminar'));
            modal.show();
        }
    </script>
</body>

</html>