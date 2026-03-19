<?php
include_once "../../configuracion/conexion.php";
$id = $_POST['id_asignacion'];
$sql = "DELETE FROM t_asignacion WHERE id_asignacion = ?";
if ($conexion->prepare($sql)->execute([$id])) echo 1;
else echo 0;
