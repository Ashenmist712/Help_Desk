<?php
include_once "../../configuracion/conexion.php";

if ($_POST) {
    $id_r = $_POST['id_reporte'];
    $sol  = $_POST['solucion'];

    $sql = "UPDATE t_reportes SET solucion_problema = ?, estatus = 2, leido = 0 WHERE id_reporte = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt->execute([$sol, $id_r])) {
        echo "<script>alert('Reporte Solucionado'); window.location.href='../../vistas/admin/reportes.php';</script>";
    }
}
