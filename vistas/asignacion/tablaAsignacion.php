<?php
include '../../clases/conexion.php';
$con = new Conexion();
$conexion = $con->conectar();
$sql = "SELECT 
                persona.id_persona AS idPersona,
                CONCAT_WS(' ', persona.paterno, persona.materno, persona.nombre) AS nombrePersona,
                equipo.id_equipo AS idEquipo,
                equipo.nombre AS nombreEquipo,
                asignacion.id_asignacion AS idAsignacion,
                asignacion.marca AS marca,
                asignacion.modelo AS modelo,
                asignacion.color AS color,
                asignacion.descripcion AS descripcion,
                asignacion.memoria AS memoria,
                asignacion.disco_duro AS discoDuro,
                asignacion.procesador AS procesador
            FROM
                t_asignacion AS asignacion
                    INNER JOIN
                t_persona AS persona ON asignacion.id_persona = persona.id_persona
                    INNER JOIN
                t_cat_equipo AS equipo ON asignacion.id_equipo = equipo.id_equipo";
$repuesta = mysqli_query($conexion, $sql);
?>
<table class="table table-sm dt-responsive nowrap" style="width: 100%" id="tablaAsignacionDataTable">
    <thead>
        <tr>
            <th>Persona</th>
            <th>Equipo</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Color</th>
            <th>Descripcion</th>
            <th>Memoria</th>
            <th>Disco Duro</th>
            <th>Procesador</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($mostrar = mysqli_fetch_array($repuesta)) { ?>
            <tr>
                <td><?php echo  $mostrar['nombrePersona'] ?></td>
                <td><?php echo  $mostrar['nombreEquipo'] ?></td>
                <td><?php echo  $mostrar['marca'] ?></td>
                <td><?php echo  $mostrar['modelo'] ?></td>
                <td><?php echo  $mostrar['color'] ?></td>
                <td><?php echo  $mostrar['descripcion'] ?></td>
                <td><?php echo  $mostrar['memoria'] ?></td>
                <td><?php echo  $mostrar['discoDuro'] ?></td>
                <td><?php echo  $mostrar['procesador'] ?></td>
                <td>
                    <button class="btn btn-danger btn-sm"
                        onclick="eliminarAsignacion('<?php echo $mostrar['idAsignacion'] ?>')">
                        <span class="fas fa-trash-alt"></span> eliminar
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>

</table>
<script>
    $(document).ready(function() {
        $('#tablaAsignacionDataTable').DataTable();
    });
</script>