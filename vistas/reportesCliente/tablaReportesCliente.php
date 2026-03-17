<?php
session_start();
include '../../clases/conexion.php';
$con = new Conexion();
$conexion = $con->conectar();
$idUsuario = $_SESSION['usuario']['id'];
$contador = 1;

// SQL Corregido
$sql = "SELECT 
            reporte.id_reporte AS idReporte,
            CONCAT(persona.paterno, ' ', persona.materno, ' ', persona.nombre) AS nombrePersona,
            equipo.nombre AS nombreEquipo,
            reporte.descripcion_problema AS problema,
            reporte.estatus AS estatus,
            reporte.solucion_problema AS solucion,
            reporte.fecha AS fecha
        FROM
            t_reportes AS reporte
            INNER JOIN t_usuarios AS usuario ON reporte.id_usuario = usuario.id_usuario
            INNER JOIN t_cat_equipo AS equipo ON reporte.id_equipo = equipo.id_equipo
            INNER JOIN t_persona AS persona ON usuario.id_persona = persona.id_persona 
        WHERE reporte.id_usuario = '$idUsuario'";

$respuesta = mysqli_query($conexion, $sql);
?>

<table class="table table-sm dt-responsive nowrap" style="width: 100%" id="tablaReportesClienteDataTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Persona</th>
            <th>Dispositivos</th>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Estatus</th>
            <th>Solución</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($mostrar = mysqli_fetch_array($respuesta)) { ?>
            <tr>
                <td><?php echo $contador++; ?></td>
                <td><?php echo $mostrar['nombrePersona']; ?></td>
                <td><?php echo $mostrar['nombreEquipo']; ?></td>
                <td><?php echo $mostrar['fecha']; ?></td>
                <td><?php echo $mostrar['problema']; ?></td>
                <td>
                    <?php
                    $estatus = $mostrar['estatus'];
                    if ($estatus == 1) {
                        echo '<span class="badge badge-success">Abierto</span>';
                    } else {
                        echo '<span class="badge badge-danger">Cerrado</span>';
                    }
                    ?>
                </td>
                <td><?php echo $mostrar['solucion']; ?></td>
                <td>
                    <?php if ($mostrar['solucion'] == "") { ?>
                        <button class="btn btn-danger btn-sm"
                            onclick="eliminarReporteCliente('<?php echo $mostrar['idReporte']; ?>')">
                            <span class="fas fa-trash-alt"></span>
                        </button>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#tablaReportesClienteDataTable').DataTable({
            destroy: true,
            responsive: true,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            },
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>