<?php
include '../../clases/conexion.php';
$con = new Conexion();
$conexion = $con->conectar();

$sql = "SELECT 
            usuarios.id_usuario AS id_usuario,
            usuarios.usuario AS nombreUsuario,
            roles.nombre AS rol,
            usuarios.id_rol AS idRol,
            usuarios.ubicacion AS ubicacion,
            usuarios.activo AS estatus,
            usuarios.id_persona AS idPersona,
            persona.nombre AS nombrePersona,
            persona.paterno AS paterno,
            persona.materno AS materno,
            persona.fecha_nacimiento AS fechaNacimiento,
            persona.sexo AS sexo,
            persona.correo AS correo,
            persona.telefono AS telefono
        FROM t_usuarios AS usuarios
        INNER JOIN t_cat_roles AS roles ON usuarios.id_rol = roles.id_rol
        INNER JOIN t_persona AS persona ON usuarios.id_persona = persona.id_persona";

$respuesta = mysqli_query($conexion, $sql);
?>

<div class="table-responsive">
    <table class="table table-sm table-striped table-bordered nowrap" id="tablaUsuariosDataTable" style="width:100%">
        <thead>
            <tr>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Nombre</th>
                <th>Fecha Nacimiento</th>
                <th>Sexo</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>Reset Password</th>
                <th>Cambiar Rol</th>
                <th>Ubicación</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($mostrar = mysqli_fetch_array($respuesta)) { ?>
                <tr>
                    <td><?php echo $mostrar['paterno']; ?></td>
                    <td><?php echo $mostrar['materno']; ?></td>
                    <td><?php echo $mostrar['nombrePersona']; ?></td>
                    <td><?php echo $mostrar['fechaNacimiento']; ?></td>
                    <td><?php echo $mostrar['sexo']; ?></td>
                    <td><?php echo $mostrar['telefono']; ?></td>
                    <td><?php echo $mostrar['correo']; ?></td>
                    <td><?php echo $mostrar['nombreUsuario']; ?></td>
                    <td>
                        <button class="btn btn-success btn-sm">
                            Cambiar Password
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm">
                            Cambiar Rol
                        </button>
                    </td>
                    <td><?php echo $mostrar['ubicacion']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm">
                            Editar
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm">
                            Eliminar
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#tablaUsuariosDataTable').DataTable({
            responsive: true,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });
    });
</script>