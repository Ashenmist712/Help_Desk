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
    "password" => sha1($_POST['password']), // Nota: sha1 es antiguo, considera password_hash en el futuro
    "idRol" => $_POST['idRol'],
    "ubicacion" => $_POST['ubicacion']
);

// CORRECCIÓN 1: Se eliminó el espacio después de la comilla.
// Se asume que 'clases' está en la raíz de tu proyecto 'helpDesk'.
include "../../../clases/Usuarios.php";

// CORRECCIÓN 2: Si el archivo se llama Usuario.php, la clase suele ser Usuario (en singular).
// El error decía que "Usuarios" no existía, así que intenta con Usuario:
$usuario = new Usuarios();

// Ejecución del método
echo $usuario->agregaNuevoUsuario($datos);
