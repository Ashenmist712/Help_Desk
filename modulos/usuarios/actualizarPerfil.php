<?php
include_once "../../configuracion/conexion.php";
session_start();

if ($_POST) {
    $nuevo_user = $_POST['usuario'];
    $pass = $_POST['password'];
    $id_u = $_SESSION['id_usuario'];

    try {
        if (!empty($pass)) {

            $pass_encriptada = sha1($pass);
            $sql = "UPDATE t_usuarios SET usuario = ?, password = ? WHERE id_usuario = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$nuevo_user, $pass_encriptada, $id_u]);
        } else {

            $sql = "UPDATE t_usuarios SET usuario = ? WHERE id_usuario = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$nuevo_user, $id_u]);
        }


        $_SESSION['usuario'] = $nuevo_user;

        echo "<script>
                alert('¡Perfil actualizado con éxito!');
                window.location.href='../../vistas/admin/inicio.php';
              </script>";
    } catch (Exception $e) {
        echo "Error al actualizar: " . $e->getMessage();
    }
}
