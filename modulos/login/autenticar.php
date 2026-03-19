<?php
// 1. Conexión y sesión
include_once "../../configuracion/conexion.php";
session_start();

if ($_POST) {
    $user = $_POST['usuario'];
    $pass = $_POST['password'];


    $sql = "SELECT u.id_usuario, r.nombre AS rol, p.nombre, p.paterno 
            FROM t_usuarios AS u 
            INNER JOIN t_cat_roles AS r ON u.id_rol = r.id_rol
            INNER JOIN t_persona AS p ON u.id_persona = p.id_persona
            WHERE u.usuario = ? AND u.password = ? AND u.activo = 1";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([$user, $pass]);
    $datos = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($datos) {

        $_SESSION['id_usuario'] = $datos['id_usuario'];
        $_SESSION['nombre']     = $datos['nombre'] . " " . $datos['paterno'];
        $_SESSION['rol']        = strtolower($datos['rol']);


        if ($_SESSION['rol'] == 'admin') {
            header("Location: ../../vistas/admin/inicio.php");
        } else {
            header("Location: ../../vistas/cliente/inicio.php");
        }
    } else {

        echo "<script>alert('Datos incorrectos'); window.location='../../index.php';</script>";
    }
}
