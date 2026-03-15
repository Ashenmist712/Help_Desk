<?php
include_once "../../clases/conexion.php";
include_once "../../clases/asignacion.php";

if (isset($_POST['idAsignacion'])) {
    $idAsignacion = $_POST['idAsignacion'];
    $Asignacion = new asignacion();
    echo $Asignacion->eliminarAsignacion($idAsignacion);
} else {
    echo "No se recibió el ID";
}
