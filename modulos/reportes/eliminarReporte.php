<?php
include_once "../../configuracion/conexion.php";

if (isset($_POST['id_reporte'])) {
    $id_r = $_POST['id_reporte'];

    try {

        $sql = "DELETE FROM t_reportes WHERE id_reporte = ?";
        $stmt = $conexion->prepare($sql);

        if ($stmt->execute([$id_r])) {
            echo 1;
        } else {
            echo 0;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
