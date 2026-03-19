<?php
include_once "../../configuracion/conexion.php";

if (isset($_POST['id_usuario']) && isset($_POST['id_persona'])) {
    $id_u = $_POST['id_usuario'];
    $id_p = $_POST['id_persona'];

    try {
        $conexion->beginTransaction();


        $sqlU = "DELETE FROM t_usuarios WHERE id_usuario = ?";
        $stmtU = $conexion->prepare($sqlU);
        $stmtU->execute([$id_u]);


        $sqlP = "DELETE FROM t_persona WHERE id_persona = ?";
        $stmtP = $conexion->prepare($sqlP);
        $stmtP->execute([$id_p]);

        $conexion->commit();
        echo 1;
    } catch (Exception $e) {
        $conexion->rollBack();
        echo 0;
    }
}
