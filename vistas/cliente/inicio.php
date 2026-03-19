<?php
session_start();
include_once "../../configuracion/conexion.php";

// 1. Validar sesión y Rol de Cliente
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'cliente') {
    header("Location: ../../index.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT p.*, r.nombre AS rol 
        FROM t_usuarios u
        INNER JOIN t_persona p ON u.id_persona = p.id_persona
        INNER JOIN t_cat_roles r ON u.id_rol = r.id_rol
        WHERE u.id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id_usuario]);
$persona = $stmt->fetch(PDO::FETCH_ASSOC);

$_SESSION['id_persona'] = $persona['id_persona'];

include_once "../../componentes/header.php";
?>

<style>
    /* 1. FONDO PERSONALIZADO */
    body {
        background: url('../../recursos/img/fondoHelpDesk.webp') no-repeat center center fixed !important;
        background-size: cover !important;
        min-height: 100vh !important;
        margin: 0;
        color: white;
    }

    /* 2. CENTRADO DE LA TARJETA */
    main {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        min-height: calc(100vh - 120px) !important;
        padding: 20px;
    }

    /* 3. EFECTO DE CRISTAL (GLASSMORPHISM) */
    .card-bienvenida {
        background: rgba(13, 17, 23, 0.8) !important;
        backdrop-filter: blur(15px) !important;
        -webkit-backdrop-filter: blur(15px) !important;
        border: 1px solid rgba(46, 204, 113, 0.4) !important;
        border-radius: 20px !important;
        padding: 40px !important;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.8) !important;
        text-align: center;
        max-width: 450px;
        width: 100%;
    }

    .titulo-verde {
        color: #2ecc71 !important;
        text-shadow: 0 0 10px rgba(46, 204, 113, 0.5);
    }

    .info-usuario {
        text-align: left;
        background: rgba(0, 0, 0, 0.4);
        padding: 20px;
        border-radius: 12px;
        margin: 20px 0;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .info-usuario p {
        margin: 10px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        padding-bottom: 5px;
        font-size: 14px;
    }

    .info-usuario i {
        color: #2ecc71;
        margin-right: 8px;
    }

    .img-perfil {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid #2ecc71;
        margin: 15px 0;
        object-fit: cover;
    }

    /* 4. BOTÓN NEÓN */
    .btn-nuevo {
        background: linear-gradient(45deg, #2ecc71, #27ae60) !important;
        color: #000 !important;
        border: none !important;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: bold !important;
        box-shadow: 0 0 15px rgba(46, 204, 113, 0.5) !important;
        transition: 0.3s;
        width: 100%;
        cursor: pointer;
    }

    .btn-nuevo:hover {
        box-shadow: 0 0 25px rgba(46, 204, 113, 0.8) !important;
        transform: scale(1.02);
    }
</style>

<main>
    <div class="card-bienvenida">
        <h1 class="titulo-verde">¡Bienvenido, Cliente!</h1>
        <h2 class="nombre-usuario" style="color: white; margin: 0;"><?php echo $persona['nombre']; ?></h2>

        <img src="../../recursos/img/avatar.png" alt="Perfil" class="img-perfil">

        <div class="info-usuario">
            <p><strong><i class="fa-solid fa-user"></i> A. Paterno:</strong> <?php echo $persona['paterno']; ?></p>
            <p><strong><i class="fa-solid fa-user"></i> A. Materno:</strong> <?php echo $persona['materno']; ?></p>
            <p><strong><i class="fa-solid fa-phone"></i> Teléfono:</strong> <?php echo $persona['telefono'] ?? 'S/N'; ?></p>
            <p><strong><i class="fa-solid fa-envelope"></i> Correo:</strong> <?php echo $persona['correo']; ?></p>
            <p><strong><i class="fa-solid fa-calendar-check"></i> Registro:</strong> <?php echo date("d/m/Y", strtotime($persona['fecha_nacimiento'])); ?></p>
        </div>

        <p style="margin-top: 10px; color: #8b949e;"><small>¿Tus datos son incorrectos?</small></p>

        <button type="button" class="btn-nuevo"
            onclick="abrirEditar(
                '<?php echo $persona['id_persona']; ?>', 
                '<?php echo $persona['nombre']; ?>', 
                '<?php echo $persona['paterno']; ?>', 
                '<?php echo $persona['materno']; ?>', 
                '<?php echo $persona['telefono']; ?>', 
                '<?php echo $persona['correo']; ?>',
                '<?php echo $persona['fecha_nacimiento']; ?>'
            )">
            <i class="fa-solid fa-user-pen"></i> Editar Mi Perfil
        </button>
    </div>
</main>

<?php
include_once "../../componentes/modalEditar.php";
?>

<div id="fondoModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:999;"></div>

<script src="../../recursos/js/usuarios.js"></script>

<?php include_once "../../componentes/footer.php"; ?>