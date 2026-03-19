<?php
session_start();
include_once "../../componentes/header.php";

if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'cliente') {
    header("Location: ../../index.php");
    exit();
}

include_once "../../configuracion/conexion.php";

$id_persona = $_SESSION['id_persona'];

$sql = "SELECT a.id_asignacion, a.marca, a.modelo, a.color, a.descripcion,
               a.memoria, a.disco_duro, a.procesador, e.nombre AS tipo_equipo
        FROM t_asignacion AS a
        INNER JOIN t_cat_equipo AS e ON a.id_equipo = e.id_equipo
        WHERE a.id_persona = ?";

$stmt = $conexion->prepare($sql);
$stmt->execute([$id_persona]);
$dispositivos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    /* 1. FONDO GENERAL */
    body {
        background: url('../../recursos/img/fondoHelpDesk.webp') no-repeat center center fixed !important;
        background-size: cover !important;
        color: white;
    }

    /* 2. CONTENEDOR PRINCIPAL */
    .container-devices {
        padding: 40px 20px;
        max-width: 1200px;
        margin: 0 auto;
        text-align: center;
    }

    /* 3. TARJETAS DE DISPOSITIVOS (GLASSMORPHISM) */
    .device-card {
        background: rgba(13, 17, 23, 0.8) !important;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(46, 204, 113, 0.3) !important;
        border-radius: 20px;
        width: 300px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        transition: 0.3s;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .device-card:hover {
        transform: translateY(-10px);
        border-color: #2ecc71 !important;
        box-shadow: 0 0 20px rgba(46, 204, 113, 0.2);
    }

    .device-icon {
        font-size: 3.5rem;
        color: #2ecc71;
        margin-bottom: 15px;
        text-shadow: 0 0 15px rgba(46, 204, 113, 0.4);
    }

    .device-title {
        color: #2ecc71;
        text-transform: uppercase;
        font-weight: 800;
        letter-spacing: 1px;
        margin-bottom: 15px;
        border-bottom: 1px solid rgba(46, 204, 113, 0.3);
        width: 100%;
        padding-bottom: 10px;
    }

    .device-info {
        text-align: left;
        width: 100%;
        font-size: 0.9rem;
    }

    .device-info p {
        margin: 8px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        padding-bottom: 4px;
    }

    .device-info strong {
        color: #2ecc71;
    }

    /* 4. MENSAJE VACÍO */
    .no-devices {
        background: rgba(13, 17, 23, 0.8);
        padding: 50px;
        border-radius: 20px;
        border: 2px dashed rgba(46, 204, 113, 0.3);
        display: inline-block;
        margin-top: 50px;
    }
</style>

<div class="container-devices">
    <h1 class="titulo-verde"><i class="fa-solid fa-microchip"></i> Mis Dispositivos Asignados</h1>
    <p style="color: #8b949e; margin-bottom: 40px;">Control de activos tecnológicos bajo tu responsabilidad.</p>

    <?php if (count($dispositivos) > 0): ?>
        <div style="display: flex; flex-wrap: wrap; gap: 30px; justify-content: center;">

            <?php foreach ($dispositivos as $equipo):
                // Lógica de iconos
                $icono = "fa-desktop";
                $tipo = strtolower($equipo['tipo_equipo']);
                if (strpos($tipo, 'laptop') !== false || strpos($tipo, 'portatil') !== false) {
                    $icono = "fa-laptop";
                } elseif (strpos($tipo, 'celular') !== false || strpos($tipo, 'telefono') !== false) {
                    $icono = "fa-mobile-screen-button";
                } elseif (strpos($tipo, 'tablet') !== false) {
                    $icono = "fa-tablet-screen-button";
                } elseif (strpos($tipo, 'impresora') !== false) {
                    $icono = "fa-print";
                }
            ?>

                <div class="device-card">
                    <i class="fa-solid <?php echo $icono; ?> device-icon"></i>
                    <div class="device-title"><?php echo $equipo['tipo_equipo']; ?></div>

                    <div class="device-info">
                        <p><strong>Marca:</strong> <?php echo $equipo['marca']; ?></p>
                        <p><strong>Modelo:</strong> <?php echo $equipo['modelo']; ?></p>
                        <p><strong>Color:</strong> <?php echo $equipo['color']; ?></p>

                        <?php if (!empty($equipo['procesador'])): ?>
                            <p><strong><i class="fa-solid fa-microchip" style="font-size: 0.8rem;"></i> CPU:</strong> <?php echo $equipo['procesador']; ?></p>
                        <?php endif; ?>

                        <?php if (!empty($equipo['memoria'])): ?>
                            <p><strong><i class="fa-solid fa-memory" style="font-size: 0.8rem;"></i> RAM:</strong> <?php echo $equipo['memoria']; ?></p>
                        <?php endif; ?>

                        <?php if (!empty($equipo['disco_duro'])): ?>
                            <p><strong><i class="fa-solid fa-hard-drive" style="font-size: 0.8rem;"></i> Disco:</strong> <?php echo $equipo['disco_duro']; ?></p>
                        <?php endif; ?>

                        <div style="margin-top: 15px; font-style: italic; color: #8b949e; font-size: 0.8rem;">
                            <i class="fa-solid fa-circle-info"></i> <?php echo $equipo['descripcion']; ?>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <div class="no-devices">
            <i class="fa-solid fa-box-open" style="font-size: 4rem; color: #484f58; margin-bottom: 20px;"></i>
            <h3 style="color: #8b949e;">Sin equipos asignados</h3>
            <p style="color: #484f58;">Contacta a soporte si crees que falta algo.</p>
        </div>
    <?php endif; ?>
</div>

<?php include_once "../../componentes/footer.php"; ?>