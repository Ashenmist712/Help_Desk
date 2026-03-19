<?php
$servidor = "localhost";
$bd       = "helpdesk";
$usuario  = "root";
$password = "";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $usuario, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Error de conexión: " . $e->getMessage();
}
