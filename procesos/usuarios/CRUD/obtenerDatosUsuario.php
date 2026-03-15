<?php

$idUsuario = $_POST['idUsuario'];
include "../../../clases/Usuarios.php";
$Usuario = new Usuarios();
$datos = $Usuario->obtenerDatosUsuario($idUsuario);
echo json_encode($datos);
