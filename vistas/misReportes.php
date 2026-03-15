<?php
include_once 'header.php';


if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] == 1) {
    include '../clases/conexion.php';
    $con = new Conexion();
    $conexion = $con->conectar();
?>

    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="fw-light">Reportes de Cliente</h1>
                <div class="lead">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalCrearReporte">
                        Crear Reporte
                    </button>
                    <hr>
                    <div id="tablaReporteClienteLoad"></div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'reportesCliente/modalCrearReporte.php';
    include_once 'footer.php';
    ?>

    <script src="../public/js/reportesCliente/reportesCliente.js"></script>

<?php
} else {
    header('Location: ../index.html');
    exit();
}
?>