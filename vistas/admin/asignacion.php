<?php
session_start();
include_once "../../configuracion/conexion.php";
include_once "../../componentes/header.php";

// Validación de sesión y rol admin
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../../index.php");
    exit();
}

// Consulta para traer las asignaciones con nombres de personas y tipos de equipo
$sql = "SELECT a.*, 
               p.nombre, p.paterno, p.materno,
               e.nombre AS tipo_equipo
        FROM t_asignacion AS a
        INNER JOIN t_persona AS p ON a.id_persona = p.id_persona
        INNER JOIN t_cat_equipo AS e ON a.id_equipo = e.id_equipo
        ORDER BY a.id_asignacion DESC";

$stmt = $conexion->query($sql);
$asignaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    /* 1. FONDO OFICIAL OSCURO */
    body {
        background: url('../../recursos/img/fondoHelpDesk.webp') no-repeat center center fixed !important;
        background-size: cover !important;
        color: white;
    }

    /* 2. CONTENEDOR PRINCIPAL AMPLIO */
    main {
        display: block !important;
        padding: 40px 20px;
        max-width: 1400px;
        /* Más ancho para que quepan todas las columnas */
        margin: 0 auto;
    }

    /* 3. TARJETA DE CRISTAL OSCURA */
    .contenedor-tabla {
        background: rgba(13, 17, 23, 0.9) !important;
        /* Más opaco para mejor lectura */
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
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* 5. ESTILO DE LA TABLA DATATABLE */
    table.dataTable thead th {
        color: #2ecc71 !important;
        border-bottom: 2px solid #2ecc71 !important;
        background: rgba(0, 0, 0, 0.3) !important;
        padding: 15px !important;
        font-size: 0.9rem;
    }

    table.dataTable tbody td {
        color: #e6edf3 !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        padding: 12px !important;
        font-size: 0.85rem;
        vertical-align: middle !important;
    }

    /* 6. BADGES DE HARDWARE */
    .badge-hw {
        background: rgba(52, 152, 219, 0.1);
        color: #3498db;
        border: 1px solid #3498db;
        padding: 2px 6px;
        border-radius: 5px;
        font-size: 0.75rem;
        font-weight: bold;
    }

    /* 7. BOTONES DE ACCIÓN */
    .btn-editar-sm {
        background: rgba(241, 196, 15, 0.1);
        color: #f1c40f;
        border: 1px solid #f1c40f;
        padding: 5px 10px;
        border-radius: 8px;
        transition: 0.3s;
    }

    .btn-editar-sm:hover {
        background: #f1c40f;
        color: black;
        box-shadow: 0 0 15px rgba(241, 196, 15, 0.5);
    }

    .btn-eliminar-sm {
        background: rgba(231, 76, 60, 0.1);
        color: #e74c3c;
        border: 1px solid #e74c3c;
        padding: 5px 10px;
        border-radius: 8px;
        transition: 0.3s;
    }

    .btn-eliminar-sm:hover {
        background: #e74c3c;
        color: white;
        box-shadow: 0 0 15px rgba(231, 76, 60, 0.5);
    }
</style>

<main>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 20px;">
        <div>
            <h1 class="titulo-verde"><i class="fa-solid fa-laptop-medical"></i> Asignación de Equipos</h1>
            <p style="color: #8b949e; margin: 0;">Vincula dispositivos físicos con el personal de Tryhtech.</p>
        </div>
        <button class="btn-nuevo" onclick="abrirModalAsignacion()">
            <i class="fa-solid fa-plus-circle"></i> NUEVA ASIGNACIÓN
        </button>
    </div>

    <div class="contenedor-tabla">
        <table id="tablaAsignaciones" class="display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Usuario Asignado</th>
                    <th>Tipo Equipo</th>
                    <th>Marca/Modelo</th>
                    <th>Hardware (RAM/CPU)</th>
                    <th>Disco</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($asignaciones as $a): ?>
                    <tr>
                        <td>
                            <div style="font-weight: bold; color: #fff;">
                                <?php echo $a['paterno'] . " " . $a['nombre']; ?>
                            </div>
                            <small style="color: #8b949e;"><i class="fa-solid fa-user-tag"></i> ID: <?php echo $a['id_persona']; ?></small>
                        </td>
                        <td>
                            <span style="color: #2ecc71;"><i class="fa-solid fa-microchip"></i> <?php echo $a['tipo_equipo']; ?></span>
                        </td>
                        <td>
                            <div><?php echo $a['marca']; ?></div>
                            <small style="color: #3498db;"><?php echo $a['modelo']; ?> (<?php echo $a['color']; ?>)</small>
                        </td>
                        <td>
                            <span class="badge-hw"><?php echo $a['memoria']; ?> RAM</span>
                            <span class="badge-hw"><?php echo $a['procesador']; ?></span>
                        </td>
                        <td>
                            <i class="fa-solid fa-hard-drive" style="color: #8b949e;"></i> <?php echo $a['disco_duro']; ?>
                        </td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <button class="btn-editar-sm" onclick="obtenerAsignacion('<?php echo $a['id_asignacion']; ?>')">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn-eliminar-sm" onclick="eliminarAsignacion('<?php echo $a['id_asignacion']; ?>')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php
include_once "../../componentes/modalAsignacion.php";
include_once "../../componentes/footer.php";
?>

<script src="../../recursos/js/asignacion.js"></script>