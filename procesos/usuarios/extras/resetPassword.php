<?php
include '../../../clases/Usuarios.php';
$Usuarios = new Usuarios();

$datos = array(
    "password" => $_POST['passwordReset'],
    "idUsuario" => $_POST['idUsuarioReset']
);

echo $Usuarios->resetPassword($datos);
