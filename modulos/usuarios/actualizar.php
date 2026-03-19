<?php
include_once "../../configuracion/conexion.php";

if ($_POST) {

    $id    = $_POST['id_persona'];
    $nom   = $_POST['nombre'];
    $pat   = $_POST['paterno'];
    $mat   = $_POST['materno'];
    $fecha = $_POST['fecha_nacimiento'];
    $tel   = $_POST['telefono'];
    $cor   = $_POST['correo'];


    $sql = "UPDATE t_persona 
            SET nombre=?, paterno=?, materno=?, fecha_nacimiento=?, telefono=?, correo=? 
            WHERE id_persona=?";

    $stmt = $conexion->prepare($sql);


    if ($stmt->execute([$nom, $pat, $mat, $fecha, $tel, $cor, $id])) {


        $pagina_origen = $_SERVER['HTTP_REFERER'] ?? '../../index.php';

        echo "<script>
                alert('¡Datos actualizados correctamente, Axel!');
                window.location.href='" . $pagina_origen . "';
              </script>";
    } else {
        echo "Error al actualizar";
    }
}
