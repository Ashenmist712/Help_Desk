<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../public/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="../public/css/plantilla.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.10/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../public/fontawesome/css/all.css">
    <title>Help Desk</title>
</head>

<body>
    <!-- Navigation -->
    <nav
        class="navbar navbar-expand-lg navbar-light bg-light static-top mb-5 shadow">
        <div class="container">
            <a class="navbar-brand" href="#">Help Desk</a>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarResponsive"
                aria-controls="navbarResponsive"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="inicio.php">Inicio</a>
                    </li>
                    <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="misDispositivos.php">Mis dispositivos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="misReportes.php">Reportes Soporte</a>
                        </li>
                    <?php } elseif (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] == 2) { ?>

                        <li class="nav-item">
                            <a class="nav-link" href="usuarios.php">Usuario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="asignacionEquipos.php">Asiganacion de equipos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reportes.php">Reportes</a>
                        </li>
                    <?php } ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" style="color:blue;">
                            <?php echo $_SESSION['usuario']['nombre'] ?>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Editar Datos</a>
                            <a class="dropdown-item" href="../procesos/usuarios/login/salir.php">Salir</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>