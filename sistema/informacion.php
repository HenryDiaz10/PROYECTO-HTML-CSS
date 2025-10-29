<?php
session_start();
require "conexion.php";
if (!isset($_SESSION['DNI'])) {
    header("Location: index.php");
}

$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Henry Diaz" />
    <title>Información</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="principal.php">Sistema web</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <?php echo $nombre; ?> <i class="fas fa-user fa-fw"> </i></a>
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
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <?php if ($tipo_usuario == 1 or 2) { ?>
                            <div class="sb-sidenav-menu-heading">Info:</div>
                            <a class="nav-link" href="informacion.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Información
                            </a>
                            <a class="nav-link" href="sobreElCurso.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Sobre el curso
                            </a>
                        <?php } ?>
                        <?php if ($tipo_usuario == 1) { ?>
                            <div class="sb-sidenav-menu-heading">Se cambió:</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Op. de admin
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="verUsuarios.php">Ver Usuarios</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Proyectos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Mis proyectos
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
                    <div class="small">Hecho por:</div>
                    Henry Diaz Tasayco - TB2
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 text-center"><i class="fas fa-info-circle me-2"></i>Información del Sistema</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Información</li>
                    </ol>

                    <div class="card mb-4 border-0">
                        <div class="card-body">
                            <p class="fs-6">
                                Esta página y las demás secciones del sistema fueron desarrolladas por
                                <strong>Henry Díaz</strong> como parte del curso de
                                <strong>Desarrollo Web</strong>.
                            </p>
                            <p>
                                El sistema fue diseñado para gestionar información y procesos de manera eficiente,
                                distribuyendo los permisos entre distintos tipos de usuarios según su rol.
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Tarjeta del Administrador -->
                        <div class="col-lg-6 mb-4">
                            <div class="card border-0">
                                <div class="card-header bg-primary text-white d-flex align-items-center">
                                    <i class="fas fa-user-shield me-2"></i>
                                    Usuario Administrador
                                </div>
                                <div class="card-body">
                                    <p>
                                        El <strong>Administrador</strong> es el usuario principal del sistema.
                                        Tiene acceso completo a todas las funcionalidades y opciones.
                                    </p>
                                    <h6 class="text-primary"><strong>Accesos:</strong></h6>
                                    <ul>
                                        <li>Dashboard</li>
                                        <li>Opciones de Administrador (ver usuarios)</li>
                                        <li>Proyectos</li>
                                        <li>Información</li>
                                        <li>Sobre el curso</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta del Usuario Estándar -->
                        <div class="col-lg-6 mb-4">
                            <div class="card border-0">
                                <div class="card-header bg-success text-white d-flex align-items-center">
                                    <i class="fas fa-user me-2"></i>
                                    Usuario Estándar
                                </div>
                                <div class="card-body">
                                    <p>
                                        El <strong>Usuario Estándar</strong> es un usuario común del sistema.
                                        Se le restringen algunos accesos, y todo usuario registrado obtiene este rol por
                                        defecto.
                                    </p>
                                    <h6 class="text-success"><strong>Accesos:</strong></h6>
                                    <ul>
                                        <li>Dashboard</li>
                                        <li>Información</li>
                                        <li>Sobre el curso</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-center">
                        <div class="text-muted text-center">
                            Todos los Derechos Reservados - Henry Diaz &copy; 2025
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="assets/demo/chart-pie-demo.js"></script>
</body>

</html>