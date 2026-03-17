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
    <!--     <link rel="stylesheet" href="../public/fontawesome/css/all.css">
    <link rel="stylesheet" href="../public/fontawesome/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../public/datatable/buttons.dataTables.min.css">
    <title>Help Desk</title>
</head>

<body>
    <nav
        class="navbar navbar-expand-lg navbar-light bg-light static-top mb-5 shadow">
        <div class="container">
            <a class="navbar-brand" href="inicio.php">
                <img src="../public/img/logo.png" alt="HelpDeskIcono" width="50px">
            </a>
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
                        <a class="nav-link" href="inicio.php">
                            <span class="fa-solid fa-house" style="color: rgb(31, 50, 82);"></span>
                            Inicio
                        </a>
                    </li>
                    <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="misDispositivos.php">
                                <span class="fa-solid fa-laptop-code" style="color: rgb(31, 50, 82);"></span>
                                Mis dispositivos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="misReportes.php">
                                <span class="fa-solid fa-newspaper" style="color: rgb(31, 50, 82);"></span>
                                Reportes Soporte
                            </a>
                        </li>
                    <?php } elseif (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] == 2) { ?>

                        <li class="nav-item">
                            <a class="nav-link" href="usuarios.php">
                                <i class="fa-solid fa-users" style="color: rgb(31, 50, 82);"></i>
                                Usuarios
                            </a>


                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="asignacionEquipos.php">
                                <span class="fa-solid fa-link" style="color: rgb(31, 50, 82);"></span>
                                Asiganacion de equipos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reportes.php">
                                <span class="fa-solid fa-file-invoice" style="color: rgb(31, 50, 82);"></span>
                                Reportes
                            </a>
                        </li>
                    <?php } ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" style="color:blue;">
                            <i class="fa-solid fa-user-astronaut" style="color: rgb(31, 50, 82);"></i>
                            <?php echo $_SESSION['usuario']['nombre'] ?>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item"
                                href="#"
                                data-toggle="modal" data-target="#modalActualizarDatosPersonales"
                                onclick=" return obtenerPersonalesInicio('<?php echo $_SESSION['usuario']['id']; ?>')">
                                <i class="fa-solid fa-user-pen" style="color: rgb(31, 50, 82);"></i>
                                Editar Datos
                            </a>
                            <a class="dropdown-item" href="../procesos/usuarios/login/salir.php">
                                <i class="fa-solid fa-person-through-window" style="color: rgb(31, 50, 82);"></i>
                                Salir
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    include 'inicio/modalActualizarDatosPersonales.php';
    ?>