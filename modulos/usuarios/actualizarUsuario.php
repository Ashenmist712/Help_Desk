<?php
include_once "../../configuracion/conexion.php";

if ($_POST) {
    $id_u    = $_POST['id_usuario'];
    $id_p    = $_POST['id_persona'];
    $nombre  = $_POST['nombre'];
    $paterno = $_POST['paterno'];
    $materno = $_POST['materno'];
    $usuario = $_POST['usuario'];
    $id_rol  = $_POST['id_rol'];

    try {
        $conexion->beginTransaction();


        $sqlP = "UPDATE t_persona SET nombre=?, paterno=?, materno=? WHERE id_persona=?";
        $conexion->prepare($sqlP)->execute([$nombre, $paterno, $materno, $id_p]);


        $sqlU = "UPDATE t_usuarios SET usuario=?, id_rol=? WHERE id_usuario=?";
        $conexion->prepare($sqlU)->execute([$usuario, $id_rol, $id_u]);

        $conexion->commit();
        echo "<script>
                alert('¡Datos actualizados correctamente!');
                window.location.href='../../vistas/admin/usuarios.php';
              </script>";
    } catch (Exception $e) {
        $conexion->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
