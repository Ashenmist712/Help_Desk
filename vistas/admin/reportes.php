<?php
session_start();
include_once "../../configuracion/conexion.php";
include_once "../../componentes/header.php";

// Seguridad: Solo admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../../index.php");
    exit();
}

// Consulta para ver TODOS los reportes de TODOS los usuarios
$sql = "SELECT r.id_reporte, 
               p.nombre, p.paterno, 
               e.nombre AS equipo, 
               r.descripcion_problema, 
               r.estatus, 
               r.fecha
        FROM t_reportes AS r
        INNER JOIN t_usuarios AS u ON r.id_usuario = u.id_usuario
        INNER JOIN t_persona AS p ON u.id_persona = p.id_persona
        INNER JOIN t_cat_equipo AS e ON r.id_equipo = e.id_equipo
        ORDER BY r.fecha DESC";
$stmt = $conexion->prepare($sql);
$stmt->execute();
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
        padding: 40px 20px;
        max-width: 1300px;
        margin: 0 auto;
    }

    /* 3. TARJETA DE CRISTAL OSCURA */
    .contenedor-tabla {
        background: rgba(13, 17, 23, 0.9) !important;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(46, 204, 113, 0.4) !important;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.9);
    }

    /* 4. TÍTULOS */
    .titulo-verde {
        color: #2ecc71 !important;
        text-shadow: 0 0 10px rgba(46, 204, 113, 0.5);
    }

    /* 5. ESTATUS NEÓN */
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

    /* 6. ESTILOS DE TABLA */
    table.dataTable thead th {
        color: #2ecc71 !important;
        border-bottom: 2px solid #2ecc71 !important;
        background: rgba(0, 0, 0, 0.3) !important;
    }

    table.dataTable tbody td {
        color: #e6edf3 !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        padding: 15px !important;
    }

    /* 7. BOTONES DE ACCIÓN */
    .btn-action {
        background: none;
        border: none;
        font-size: 1.3rem;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-action:hover {
        transform: scale(1.2);
    }

    /* Botones de acción en tablas */
    .btn-tabla-edit {
        background: rgba(52, 152, 219, 0.1) !important;
        color: #3498db !important;
        border: 1px solid #3498db !important;
        padding: 6px 10px;
        border-radius: 8px;
        transition: 0.3s;
    }

    .btn-tabla-edit:hover {
        background: #3498db !important;
        color: #000 !important;
        box-shadow: 0 0 15px rgba(52, 152, 219, 0.6);
    }

    .btn-tabla-delete {
        background: rgba(231, 76, 60, 0.1) !important;
        color: #e74c3c !important;
        border: 1px solid #e74c3c !important;
        padding: 6px 10px;
        border-radius: 8px;
        transition: 0.3s;
    }

    .btn-tabla-delete:hover {
        background: #e74c3c !important;
        color: #fff !important;
        box-shadow: 0 0 15px rgba(231, 76, 60, 0.6);
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

<main>
    <div style="margin-bottom: 30px;">
        <h1 class="titulo-verde"><i class="fa-solid fa-headset"></i> Panel de Soporte Técnico</h1>
        <p style="color: #8b949e; margin: 0;">Gestión global de incidencias y soluciones de Tryhtech H-K.</p>
    </div>

    <div class="contenedor-tabla">
        <table id="tablaReportesAdmin" class="display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Equipo</th>
                    <th>Falla</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reportes as $rep): ?>
                    <tr>
                        <td>
                            <strong style="color: #fff;"><?php echo $rep['nombre'] . " " . $rep['paterno']; ?></strong>
                        </td>
                        <td><i class="fa-solid fa-laptop" style="color: #2ecc71;"></i> <?php echo $rep['equipo']; ?></td>
                        <td style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            <?php echo $rep['descripcion_problema']; ?>
                        </td>
                        <td><?php echo date("d/m/Y H:i", strtotime($rep['fecha'])); ?></td>
                        <td>
                            <?php if ($rep['estatus'] == 1): ?>
                                <span class="status-pendiente"><i class="fa-solid fa-clock"></i> Pendiente</span>
                            <?php else: ?>
                                <span class="status-solucionado"><i class="fa-solid fa-check-double"></i> Solucionado</span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center;">
                            <button class="btn-action" onclick="obtenerDatosSolucion(<?php echo $rep['id_reporte']; ?>)"
                                style="color: #3498db;" title="Dar Solución">
                                <i class="fa-solid fa-comment-medical"></i>
                            </button>
                            <button class="btn-action" onclick="eliminarReporte(<?php echo $rep['id_reporte']; ?>)"
                                style="color: #e74c3c; margin-left: 10px;" title="Eliminar">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php
include_once "../../componentes/modalSolucion.php";
include_once "../../componentes/footer.php";
?>
<script src="../../recursos/js/reportesAdmin.js"></script>