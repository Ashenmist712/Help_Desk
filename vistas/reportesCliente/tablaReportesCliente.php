<?php
session_start();
include '../../clases/conexion.php';
$con = new Conexion();
$conexion = $con->conectar();
$idUsuario = $_SESSION['usuario']['id'];
$contador = 1;
$sql = "SELECT 
            reporte.id_reporte AS idReporte,
            reporte.id_usuario AS idUsuario,
            CONCAT(persona.paterno,
                    '',
                    persona.materno,
                    '',
                    persona.nombre) AS nombrePersona,
            equipo.id_equipo AS idEquipo,
            equipo.nombre AS nombreEquipo,
            reporte.descripcion_problema AS problema,
            reporte.estatus AS estatus,
            reporte.solucion_problema AS solucion,
            reporte.fecha AS fecha
        FROM
            t_reportes AS reporte
                INNER JOIN
            t_usuarios AS usuario ON reporte.id_usuario = usuario.id_usuario
                INNER JOIN
            t_cat_equipo AS equipo ON reporte.id_equipo = equipo.id_equipo
                INNER JOIN
            t_persona AS persona ON usuario.id_persona = persona.id_persona = '$idUsuario'";
$respuesta = mysqli_query($conexion, $sql);
?>
<table class="table table-sm dt-responsive nowrap" style="width: 100%" id="tablaAsignacionDataTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Persona</th>
            <th>Dispositivos</th>
            <th>Fecha</th>
            <th>Descripcion</th>
            <th>Estatus</th>
            <th>Solucion</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($mostrar = mysqli_fetch_array($respuesta)) { ?>
            <tr>
                <td><?php $contador++ ?></td>
                <td><?php echo $mostrar['nombrePersona']; ?></td>
                <td><?php echo $mostrar['nombreEquipo']; ?></td>
                <td><?php echo $mostrar['fecha']; ?></td>
                <td><?php echo $mostrar['problema']; ?></td>
                <td>
                    <?php
                    $estatus = $mostrar['estatus'];
                    $cadenaEstatus = '<div class="alert alert-success" role="alert">
                                            Abierto
                                    </div>';
                    if ($estatus == 0) {
                        '<div class="alert alert-danger" role="alert">
                            Cerrado
                        </div>';
                    }
                    echo $cadenaEstatus;
                    ?>
                </td>
                <td><?php echo $mostrar['solucion']; ?></td>
                <td>
                    <button class="btn btn-danger btn-sm"></button>
                </td>
                <td><?php echo $mostrar['solucion']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#tablaReportesClienteDataTable').DataTable();
    });
</script>