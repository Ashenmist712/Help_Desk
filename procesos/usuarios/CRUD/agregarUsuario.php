<?php
// Recolección de datos mediante POST
$datos = array(
    "paterno" => $_POST['paterno'],
    "nombre" => $_POST['nombre'],
    "materno" => $_POST['materno'],
    "fechaNacimiento" => $_POST['fechaNacimiento'],
    "sexo" => $_POST['sexo'],
    "telefono" => $_POST['telefono'],
    "correo" => $_POST['correo'],
    "usuario" => $_POST['usuario'],
    "password" => sha1($_POST['password']),
    "idRol" => $_POST['idRol'],
    "ubicacion" => $_POST['ubicacion']
);


include "../../../clases/Usuarios.php";
$usuario = new Usuarios();

echo $usuario->agregaNuevoUsuario($datos);
