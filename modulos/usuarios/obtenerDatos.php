<?php
include_once "../../configuracion/conexion.php";

$id_u = $_POST['id_usuario'];

$sql = "SELECT u.id_usuario, u.id_persona, u.usuario, u.id_rol,
               p.nombre, p.paterno, p.materno, p.correo
        FROM t_usuarios AS u
        INNER JOIN t_persona AS p ON u.id_persona = p.id_persona
        WHERE u.id_usuario = ?";

$stmt = $conexion->prepare($sql);
$stmt->execute([$id_u]);
$datos = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($datos);
