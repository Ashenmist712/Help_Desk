<?php
include_once 'header.php';
if (isset($_SESSION['usuario']) && ($_SESSION['usuario']['rol'] == 1 || $_SESSION['usuario']['rol'] == 2)) {
    $idUsuario = $_SESSION['usuario']['id'];
?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-7 col-lg-6">
                <div class="card border-0 shadow-lg my-5 text-center">
                    <div class="card-body p-5">

                        <h1 class="fw-light mb-2">¡Bienvenido!</h1>
                        <h2 class="display-6 mb-4 text-capitalize"><?php echo $_SESSION['usuario']['nombre'] ?></h2>

                        <hr class="mb-4">

                        <div class="mb-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                class="img-fluid rounded-circle shadow-sm"
                                style="width: 140px; background-color: #f8f9fa; padding: 10px;"
                                alt="User Icon">
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-11">
                                <table class="table table-sm table-borderless mt-2">
                                    <tbody style="font-size: 1rem;">
                                        <tr>
                                            <td class="text-start text-muted" style="width: 45%;">Apellido Paterno:</td>
                                            <td class="text-end fw-bold" id="paterno"></td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="text-start text-muted">Apellido Materno:</td>
                                            <td class="text-end fw-bold" id="materno"></td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="text-start text-muted">Nombre(s):</td>
                                            <td class="text-end fw-bold" id="nombre"></td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="text-start text-muted">Teléfono:</td>
                                            <td class="text-end fw-bold text-primary" id="telefono"></td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="text-start text-muted">Correo:</td>
                                            <td class="text-end fw-bold" id="correo" style="word-break: break-all;"></td>
                                        </tr>
                                        <tr class="border-top">
                                            <td class="text-start text-muted">Fecha Nacimiento:</td>
                                            <td class="text-end fw-bold" id="edad"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-4 pt-2">
                            <div class="btn btn-sm btn-outline-info disabled rounded-pill px-4">
                                <i class="fas fa-shield-alt me-1"></i> Sesión:
                                <?php echo ($_SESSION['usuario']['rol'] == 2) ? "Administrador" : "Cliente"; ?>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <p class="text-muted small mb-1">¿Tu información es incorrecta?</p>
                            <button class="btn btn-warning btn-sm shadow-sm px-4 rounded-pill"
                                data-toggle="modal"
                                data-target="#modalActualizarDatosPersonales"
                                onclick="obtenerPersonalesInicio('<?php echo $idUsuario; ?>')">
                                <i class="fas fa-edit me-1"></i>
                                Editar mi perfil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once 'footer.php'; ?>

    <script src="../public/js/inicio/personales.js"></script>

    <script>
        $(document).ready(function() {
            let idUsuario = '<?php echo $idUsuario; ?>';
            datosPersonalesInicio(idUsuario);
        });
    </script>

<?php
} else {
    header('Location: ../index.html');
    exit();
}
?>