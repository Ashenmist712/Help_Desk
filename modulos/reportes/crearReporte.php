<?php
session_start();
include_once "../../configuracion/conexion.php";

if ($_POST) {
    $id_usuario = $_SESSION['id_usuario'];
    $equipo_usuario = $_POST['equipo_escrito']; // Lo que escribió el cliente
    $problema = $_POST['problema'];

    // Juntamos todo en la columna descripcion_problema para que el técnico sepa qué equipo es
    $descripcion_completa = "EQUIPO: " . $equipo_usuario . " | FALLA: " . $problema;

    // Usamos el ID 1 de tu tabla como genérico
    $id_equipo_base = 1;

    $sql = "INSERT INTO t_reportes (id_usuario, id_equipo, descripcion_problema) 
            VALUES (?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    if ($stmt->execute([$id_usuario, $id_equipo_base, $descripcion_completa])) {
        echo "<script>
                alert('¡Reporte levantado con éxito, Axel!');
                // ESTA ES LA RUTA CORRECTA PARA EL CLIENTE:
                window.location.href='../../vistas/cliente/misReportes.php'; 
              </script>";
    } else {
        echo "Error al insertar el reporte.";
    }
}
