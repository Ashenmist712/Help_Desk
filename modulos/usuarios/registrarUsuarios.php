<?php
session_start();
include_once "../../configuracion/conexion.php";

if ($_POST) {

    $nombre    = $_POST['nombre'];
    $paterno   = $_POST['paterno'];
    $materno   = $_POST['materno'];
    $correo    = $_POST['correo'];
    $telefono  = $_POST['telefono'];
    $fecha_nac = $_POST['fecha_nac'];


    $usuario  = $_POST['usuario'];
    $password = $_POST['password'];
    $id_rol   = $_POST['id_rol'];

    try {

        $conexion->beginTransaction();


        $sqlPersona = "INSERT INTO t_persona (nombre, paterno, materno, correo, telefono, fecha_nacimiento) 
                       VALUES (?, ?, ?, ?, ?, ?)";
        $stmtP = $conexion->prepare($sqlPersona);
        $stmtP->execute([$nombre, $paterno, $materno, $correo, $telefono, $fecha_nac]);


        $id_persona_recien_creado = $conexion->lastInsertId();


        $sqlUsuario = "INSERT INTO t_usuarios (id_rol, id_persona, usuario, password) 
                       VALUES (?, ?, ?, ?)";
        $stmtU = $conexion->prepare($sqlUsuario);
        $stmtU->execute([$id_rol, $id_persona_recien_creado, $usuario, $password]);


        $conexion->commit();

        echo "<script>
                alert('¡Usuario registrado con éxito!');
                window.location.href='../../vistas/admin/usuarios.php';
              </script>";
    } catch (Exception $e) {

        $conexion->rollBack();
        echo "Error al registrar: " . $e->getMessage();
    }
}
