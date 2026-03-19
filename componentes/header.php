<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Variables de sesión seguras
$rol = $_SESSION['rol'] ?? 'cliente';
$nombre_usuario = $_SESSION['usuario'] ?? 'Usuario';
$id_persona = $_SESSION['id_persona'] ?? 0;

$notificaciones = 0;
$notificaciones_admin = 0;

// 1. Notificaciones para CLIENTE (Reportes solucionados no leídos)
if (isset($conexion) && $rol == 'cliente' && $id_persona > 0) {
    $sql_notif = "SELECT COUNT(*) as total FROM t_reportes AS r 
                  INNER JOIN t_usuarios AS u ON r.id_usuario = u.id_usuario 
                  WHERE u.id_persona = ? AND r.estatus = 2 AND r.leido = 0";
    $stmt_n = $conexion->prepare($sql_notif);
    $stmt_n->execute([$id_persona]);
    $res_n = $stmt_n->fetch(PDO::FETCH_ASSOC);
    $notificaciones = $res_n['total'] ?? 0;
}

// 2. Notificaciones para ADMIN (Reportes nuevos/pendientes)
if (isset($conexion) && $rol == 'admin') {
    $sql_admin = "SELECT COUNT(*) as total FROM t_reportes WHERE estatus = 1";
    $res_a = $conexion->query($sql_admin)->fetch(PDO::FETCH_ASSOC);
    $notificaciones_admin = $res_a['total'] ?? 0;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HelpDesk - Tryhtech H-K</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../recursos/css/navbar_custom.css">

    <style>
        body {
            background-color: #0d1117 !important;
            color: white !important;
        }

        /* Estilo para la campana de notificaciones */
        .badge-notif {
            background-color: #2ecc71 !important;
            color: #000 !important;
            font-weight: bold;
            font-size: 10px;
            position: absolute;
            top: -5px;
            right: -10px;
            padding: 2px 6px;
            border-radius: 50%;
        }

        .nav-link {
            color: white !important;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #2ecc71 !important;
            text-shadow: 0 0 8px rgba(46, 204, 113, 0.6);
        }

        /* Dropdown Estilo Oscuro */
        .dropdown-menu {
            background-color: #161b22 !important;
            border: 1px solid #2ecc71 !important;
        }

        .dropdown-item {
            color: white !important;
        }

        .dropdown-item:hover {
            background-color: rgba(46, 204, 113, 0.2) !important;
        }

        /* Modales estilo Dark Tryhtech */
        .modal-content {
            background-color: #0d1117 !important;
            border: 1px solid #2ecc71 !important;
            border-radius: 15px !important;
            color: white !important;
        }

        .modal-header {
            border-bottom: 1px solid rgba(46, 204, 113, 0.3) !important;
        }

        .modal-footer {
            border-top: 1px solid rgba(46, 204, 113, 0.3) !important;
        }

        .form-control,
        .form-select {
            background-color: rgba(0, 0, 0, 0.5) !important;
            border: 1px solid #30363d !important;
            color: white !important;
        }

        .form-control:focus {
            border-color: #2ecc71 !important;
            box-shadow: 0 0 8px rgba(46, 204, 113, 0.4) !important;
        }
    </style>
</head>

<body>

    <nav style="background-color: #0b1423; padding: 10px 25px; border-bottom: 2px solid #2ecc71;">
        <div style="display: flex; justify-content: space-between; align-items: center;">

            <div class="logo-container">
                <a href="inicio.php" style="text-decoration: none; display: flex; align-items: center; gap: 10px;">
                    <img src="../../recursos/img/logo_tryhtech.png" alt="Logo" class="nav-logo" style="height: 35px;">
                    <span style="color: white; font-weight: bold; font-size: 1.2rem; letter-spacing: 0.5px;">
                        Tryhtech <span style="color: #2ecc71;">H-K</span>
                    </span>
                </a>
            </div>

            <div style="display: flex; align-items: center; gap: 20px;">
                <a href="inicio.php" class="nav-link"><i class="fa-solid fa-house"></i> Inicio</a>

                <?php if ($rol == 'admin'): ?>
                    <a href="usuarios.php" class="nav-link"><i class="fa-solid fa-users"></i> Usuarios</a>
                    <a href="asignacion.php" class="nav-link"><i class="fa-solid fa-link"></i> Asignación</a>
                    <a href="reportes.php" class="nav-link"><i class="fa-solid fa-file-invoice"></i> Reportes</a>

                    <div class="dropdown" style="position: relative;">
                        <span class="dropdown-toggle" id="notifAdmin" data-bs-toggle="dropdown" style="color: white; cursor: pointer; padding: 5px;">
                            <i class="fa-solid fa-bell"></i>
                            <?php if ($notificaciones_admin > 0): ?>
                                <span class="badge-notif"><?php echo $notificaciones_admin; ?></span>
                            <?php endif; ?>
                        </span>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li class="p-2 text-success fw-bold border-bottom border-secondary">Nuevos Reportes</li>
                            <?php if ($notificaciones_admin > 0): ?>
                                <li><a class="dropdown-item" href="reportes.php">Tienes <?php echo $notificaciones_admin; ?> pendientes</a></li>
                            <?php else: ?>
                                <li><span class="dropdown-item">Sin novedades</span></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                <?php else: ?>
                    <a href="misDispositivos.php" class="nav-link"><i class="fa-solid fa-laptop"></i> Mis Equipos</a>
                    <a href="misReportes.php" class="nav-link"><i class="fa-solid fa-clipboard-list"></i> Mis Reportes</a>

                    <span style="cursor: pointer; position: relative; color: white;">
                        <i class="fa-solid fa-bell"></i>
                        <?php if ($notificaciones > 0): ?>
                            <span class="badge-notif"><?php echo $notificaciones; ?></span>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>

                <div class="dropdown">
                    <a class="dropdown-toggle text-white fw-bold" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-circle-user" style="font-size: 1.5rem; color: #2ecc71;"></i>
                        <span><?php echo $nombre_usuario; ?></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="#" onclick="abrirModalEditarPerfil()"><i class="fa-solid fa-user-gear"></i> Editar Perfil</a></li>
                        <li>
                            <hr class="dropdown-divider" style="background-color: #2ecc71;">
                        </li>
                        <li><a class="dropdown-item" href="../../modulos/login/cerrarSesion.php" style="color: #e74c3c !important;"><i class="fa-solid fa-power-off"></i> Salir</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>

    <?php include_once "modalEditarPerfil.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>