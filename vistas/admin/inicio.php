<?php
session_start();
include_once "../../configuracion/conexion.php";

// 1. Validación de sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../index.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

// 2. Consulta de datos del Administrador
$sql = "SELECT p.*, r.nombre AS rol 
        FROM t_usuarios u
        INNER JOIN t_persona p ON u.id_persona = p.id_persona
        INNER JOIN t_cat_roles r ON u.id_rol = r.id_rol
        WHERE u.id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id_usuario]);
$persona = $stmt->fetch(PDO::FETCH_ASSOC);

// 3. Incluir el Header (Menú)
include_once "../../componentes/header.php";
?>

<style>
    /* --- ESTILOS DE ESTA VISTA --- */
    body {
        /* Tu nuevo fondo oficial */
        background: url('../../recursos/img/fondoHelpDesk.webp') no-repeat center center fixed !important;
        background-size: cover !important;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        font-family: 'Segoe UI', Roboto, sans-serif;
    }

    /* Contenedor que centra la tarjeta en pantalla */
    main {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        min-height: calc(100vh - 80px) !important;
        /* Descuenta el Nav */
        padding: 20px;
        box-sizing: border-box;
    }

    /* Tarjeta Efecto Cristal (Glassmorphism) */
    .card-bienvenida {
        background: rgba(13, 17, 23, 0.85) !important;
        backdrop-filter: blur(20px) !important;
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(46, 204, 113, 0.4) !important;
        border-radius: 25px !important;
        padding: 45px !important;
        width: 100%;
        max-width: 480px;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.9) !important;
        text-align: center;
        color: white;
        animation: easeIn 0.6s ease-out;
    }

    @keyframes easeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .titulo-neon {
        color: #2ecc71 !important;
        text-shadow: 0 0 15px rgba(46, 204, 113, 0.6);
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 5px;
    }

    .img-perfil-circulo {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 4px solid #2ecc71;
        margin: 20px 0;
        object-fit: cover;
        box-shadow: 0 0 25px rgba(46, 204, 113, 0.3);
    }

    /* Caja de información interna */
    .panel-info {
        text-align: left;
        background: rgba(0, 0, 0, 0.4);
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 25px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .panel-info p {
        margin: 12px 0;
        font-size: 14px;
        color: #e6edf3;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        padding-bottom: 6px;
    }

    .panel-info strong {
        color: #2ecc71;
        margin-right: 5px;
    }

    /* Botón con degradado verde */
    .btn-action-neon {
        background: linear-gradient(45deg, #2ecc71, #27ae60) !important;
        color: #000 !important;
        border: none !important;
        padding: 14px 30px !important;
        border-radius: 12px !important;
        font-weight: 800 !important;
        text-transform: uppercase;
        cursor: pointer;
        width: 100%;
        box-shadow: 0 0 15px rgba(46, 204, 113, 0.4);
        transition: 0.3s ease;
    }

    .btn-action-neon:hover {
        box-shadow: 0 0 25px rgba(46, 204, 113, 0.8);
        transform: scale(1.03);
    }
</style>

<main>
    <div class="card-bienvenida">
        <h1 class="titulo-neon">¡Bienvenido!</h1>
        <h2 style="margin: 0; font-weight: 300; font-size: 1.5rem;">
            <?php echo $persona['nombre'] . " " . $persona['paterno']; ?>
        </h2>

        <img src="../../recursos/img/avatar.png" class="img-perfil-circulo" alt="Avatar">

        <div class="panel-info">
            <p><strong><i class="fa-solid fa-address-card"></i> Apellido Paterno:</strong> <?php echo $persona['paterno']; ?></p>
            <p><strong><i class="fa-solid fa-address-card"></i> Apellido Materno:</strong> <?php echo $persona['materno']; ?></p>
            <p><strong><i class="fa-solid fa-phone"></i> Teléfono:</strong> <?php echo $persona['telefono'] ?? 'S/N'; ?></p>
            <p><strong><i class="fa-solid fa-envelope"></i> Correo:</strong> <?php echo $persona['correo']; ?></p>
            <p><strong><i class="fa-solid fa-user-shield"></i> Rol:</strong> <span style="color: #3498db; font-weight: bold;"><?php echo $persona['rol']; ?></span></p>
        </div>

        <button type="button" class="btn-action-neon" onclick="abrirModalEditarPerfil()">
            <i class="fa-solid fa-user-gear"></i> Editar Perfil Admin
        </button>
    </div>
</main>

<?php
// Incluir modales y footer
include_once "../componentes/modalEditarPerfil";
include_once "../../componentes/footer.php";
?>