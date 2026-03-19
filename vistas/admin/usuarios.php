<?php
session_start();
include_once "../../configuracion/conexion.php";

// Validación de sesión
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../../index.php");
    exit();
}

include_once "../../componentes/header.php";

// Consulta para traer a los usuarios con sus datos personales y roles
$sql = "SELECT u.id_usuario, 
               p.nombre, p.paterno, p.materno, p.telefono, p.correo, p.fecha_nacimiento,
               r.nombre AS rol,
               u.usuario, u.id_persona
        FROM t_usuarios AS u 
        INNER JOIN t_persona AS p ON u.id_persona = p.id_persona
        INNER JOIN t_cat_roles AS r ON u.id_rol = r.id_rol";
$stmt = $conexion->query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    /* 1. FONDO OFICIAL */
    body {
        background: url('../../recursos/img/fondoHelpDesk.webp') no-repeat center center fixed !important;
        background-size: cover !important;
        color: white;
    }

    /* 2. CONTENEDOR PRINCIPAL */
    main {
        display: block !important;
        padding: 40px 20px;
        max-width: 1300px;
        margin: 0 auto;
    }

    /* 3. TARJETA DE CRISTAL OSCURA */
    .contenedor-tabla {
        background: rgba(13, 17, 23, 0.9) !important;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(46, 204, 113, 0.4) !important;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.9);
    }

    /* 4. TÍTULOS Y BADGES */
    .titulo-verde {
        color: #2ecc71 !important;
        text-shadow: 0 0 10px rgba(46, 204, 113, 0.5);
    }

    .badge-rol {
        background: rgba(46, 204, 113, 0.1);
        border: 1px solid #2ecc71;
        color: #2ecc71;
        padding: 3px 10px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: bold;
    }

    /* 5. ESTILO DE LA TABLA DATATABLE */
    table.dataTable thead th {
        color: #2ecc71 !important;
        border-bottom: 2px solid #2ecc71 !important;
        background: rgba(0, 0, 0, 0.3) !important;
        padding: 15px !important;
    }

    table.dataTable tbody td {
        color: #e6edf3 !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        padding: 15px !important;
        vertical-align: middle;
    }

    /* 6. BOTONES DE ACCIÓN */
    .btn-editar,
    .btn-eliminar {
        border: none;
        padding: 8px 12px;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
        font-size: 1.1rem;
    }

    .btn-editar {
        background: rgba(52, 152, 219, 0.1);
        color: #3498db;
        border: 1px solid #3498db;
    }

    .btn-editar:hover {
        background: #3498db;
        color: white;
        box-shadow: 0 0 15px rgba(52, 152, 219, 0.5);
    }

    .btn-eliminar {
        background: rgba(231, 76, 60, 0.1);
        color: #e74c3c;
        border: 1px solid #e74c3c;
    }

    .btn-eliminar:hover {
        background: #e74c3c;
        color: white;
        box-shadow: 0 0 15px rgba(231, 76, 60, 0.5);
    }
</style>

<main>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 20px;">
        <div>
            <h1 class="titulo-verde"><i class="fa-solid fa-users-gear"></i> Gestión de Usuarios</h1>
            <p style="color: #8b949e; margin: 0;">Panel de administración de credenciales y personal.</p>
        </div>

        <button class="btn-nuevo" onclick="abrirModalUsuario()">
            <i class="fa-solid fa-user-plus"></i> REGISTRAR NUEVO USUARIO
        </button>
    </div>

    <div class="contenedor-tabla">
        <div class="table-responsive">
            <table id="tablaUsuarios" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Datos Contacto</th>
                        <th>Usuario / Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td>
                                <div style="font-weight: bold; color: #fff;">
                                    <?php echo $u['paterno'] . " " . $u['materno'] . " " . $u['nombre']; ?>
                                </div>
                                <small style="color: #2ecc71;"><i class="fa-solid fa-cake-candles"></i> <?php echo $u['fecha_nacimiento']; ?></small>
                            </td>
                            <td>
                                <i class="fa-solid fa-phone" style="font-size: 0.8rem; color: #2ecc71;"></i> <?php echo $u['telefono']; ?><br>
                                <i class="fa-solid fa-envelope" style="font-size: 0.8rem; color: #2ecc71;"></i> <?php echo $u['correo']; ?>
                            </td>
                            <td>
                                <span class="badge-rol"><?php echo $u['usuario']; ?></span><br>
                                <small style="color: #3498db; font-weight: bold;"><i class="fa-solid fa-shield-halved"></i> <?php echo $u['rol']; ?></small>
                            </td>
                            <td>
                                <span style="color: #2ecc71;"><i class="fa-solid fa-circle-check"></i> Activo</span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 10px;">
                                    <button class="btn-editar" title="Editar" onclick="obtenerDatosUsuario('<?php echo $u['id_usuario']; ?>')">
                                        <i class="fa-solid fa-user-pen"></i>
                                    </button>
                                    <button class="btn-eliminar" title="Eliminar" onclick="eliminarUsuario('<?php echo $u['id_usuario']; ?>', '<?php echo $u['id_persona']; ?>')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
include_once "../../componentes/modalUsuario.php";
include_once "../../componentes/footer.php";
?>

<script src="../../recursos/js/usuario.js"></script>