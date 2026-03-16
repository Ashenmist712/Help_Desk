<?php
$idReporte = $_POST['idReporte'];
include '../../clases/Reportes.php';
$reportes = new Reportes();
echo $reportes->eliminarReporteCliente($idReporte);
