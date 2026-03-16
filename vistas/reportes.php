<?php
include_once 'header.php';
if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] == 2) {
?>
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="fw-light">Gestión de Reportes de Usuario</h1>
                <hr>
                <div id="tablaReporteAdminLoad"></div>
            </div>
        </div>
    </div>

    <?php
    include 'reportesAdmin/modalAgregarSolucion.php';
    include_once 'footer.php'; ?>
    <script src="../public/js/reportesAdmin/reportesAdmin.js"></script>
<?php
} else {
    header('Location: ../index.html');
    exit();
}
?>