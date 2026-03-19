<?php
session_start();
include_once "../../configuracion/conexion.php";
include_once "../../componentes/header.php";

if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'cliente') {
    header("Location: ../../index.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT r.id_reporte, 
               r.descripcion_problema, 
               r.estatus, 
               r.fecha, 
               e.nombre AS equipo
        FROM t_reportes AS r
        INNER JOIN t_cat_equipo AS e ON r.id_equipo = e.id_equipo
        WHERE r.id_usuario = ?
        ORDER BY r.fecha DESC";

$stmt = $conexion->prepare($sql);
$stmt->execute([$id_usuario]);
$reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    /* 1. FONDO OFICIAL */
    body {
        background: url('../../recursos/img/fondoHelpDesk.webp') no-repeat center center fixed !important;
        background-size: cover !important;
        color: white;
    }

    /* 2. CONTENEDOR PRINCIPAL */
    main {
        display: block !important;
        /* Para que el título y la tabla bajen */
        padding: 40px 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* 3. TARJETA DE CRISTAL PARA LA TABLA */
    .contenedor-tabla {
        background: rgba(13, 17, 23, 0.85) !important;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(46, 204, 113, 0.4) !important;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.8);
    }

    /* 4. TÍTULOS */
    .titulo-verde {
        color: #2ecc71 !important;
        text-shadow: 0 0 10px rgba(46, 204, 113, 0.5);
    }

    /* 5. ESTATUS CON COLORES NEÓN */
    .status-pendiente {
        color: #f1c40f;
        background: rgba(241, 196, 15, 0.1);
        padding: 5px 12px;
        border-radius: 15px;
        border: 1px solid #f1c40f;
        font-size: 0.85rem;
    }

    .status-solucionado {
        color: #2ecc71;
        background: rgba(46, 204, 113, 0.1);
        padding: 5px 12px;
        border-radius: 15px;
        border: 1px solid #2ecc71;
        font-size: 0.85rem;
    }

    /* 6. TABLA DATATABLE */
    table.dataTable thead th {
        color: #2ecc71 !important;
        border-bottom: 2px solid #2ecc71 !important;
        background: transparent !important;
    }

    table.dataTable tbody td {
        color: #e6edf3 !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        padding: 15px !important;
    }
</style>

<main>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 20px;">
        <div>
            <h1 class="titulo-verde"><i class="fa-solid fa-clipboard-list"></i> Mis Reportes de Soporte</h1>
            <p style="color: #8b949e; margin: 0;">Historial de solicitudes técnicas de Tryhtech H-K.</p>
        </div>
        <button class="btn-nuevo" onclick="abrirModalReporte()">
            <i class="fa-solid fa-plus"></i> LEVANTAR REPORTE
        </button>
    </div>

    <div class="contenedor-tabla">
        <?php if (count($reportes) > 0): ?>
            <table id="tablaReportes" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th><i class="fa-solid fa-laptop"></i> Equipo</th>
                        <th><i class="fa-solid fa-bug"></i> Falla Reportada</th>
                        <th><i class="fa-solid fa-calendar"></i> Fecha</th>
                        <th><i class="fa-solid fa-signal"></i> Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reportes as $rep): ?>
                        <tr>
                            <td><strong style="color: #2ecc71;">#<?php echo $rep['id_reporte']; ?></strong></td>
                            <td><?php echo $rep['equipo']; ?></td>
                            <td style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                <?php echo $rep['descripcion_problema']; ?>
                            </td>
                            <td><?php echo date("d/m/Y H:i", strtotime($rep['fecha'])); ?></td>
                            <td>
                                <?php if ($rep['estatus'] == 1): ?>
                                    <span class="status-pendiente">
                                        <i class="fa-solid fa-clock"></i> Pendiente
                                    </span>
                                <?php else: ?>
                                    <span class="status-solucionado">
                                        <i class="fa-solid fa-check-double"></i> Solucionado
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div style="text-align: center; padding: 50px;">
                <i class="fa-solid fa-folder-open" style="font-size: 4rem; color: rgba(46, 204, 113, 0.2);"></i>
                <h3 style="color: #8b949e; margin-top: 20px;">Sin reportes registrados</h3>
                <p style="color: #484f58;">Usa el botón superior si necesitas ayuda técnica.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
include_once "../../componentes/modalReporte.php";
include_once "../../componentes/footer.php";
?>