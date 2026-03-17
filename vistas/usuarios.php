<?php
include_once 'header.php';
if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] == 2) {
?>

    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="fw-light">Administrar Usuarios</h1>
                <div class="lead">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuarios">
                        <i class="fa-solid fa-user-plus" style="color: rgb(31, 50, 82);"></i>
                    </button>
                    <hr>
                    <div id="tablaUsuariosLoad"></div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'usuarios/modalActualizar.php';
    include 'usuarios/modalAgregar.php';


    include 'footer.php';
    ?>

    <script src="../public/js/usuarios/usuarios.js"></script>

<?php
} else {
    header('Location: ../index.html');
    exit();
}
?>