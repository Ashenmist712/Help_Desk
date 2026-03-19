<div id="modalEditarPerfil" style="display:none; position:fixed; top:15%; left:30%; width:40%; background:#161b22; border:2px solid #2ecc71; padding:25px; z-index:10001; box-shadow: 0 0 20px rgba(46, 204, 113, 0.3); border-radius: 12px; font-family: sans-serif;">

    <h3 style="margin-top:0; color: #2ecc71;">
        <i class="fa-solid fa-user-gear"></i> Configuración de Perfil
    </h3>
    <p style="color: #8b949e; font-size: 0.9em;">Actualiza tus credenciales de acceso al sistema.</p>
    <hr style="border-top: 1px solid #30363d;">

    <form action="../../modulos/usuarios/actualizarPerfil.php" method="POST">
        <div style="margin-bottom: 15px;">
            <label style="color: #e6edf3; display:block; margin-bottom: 5px;">Usuario Actual:</label>
            <input type="text" name="usuario" value="<?php echo $_SESSION['usuario']; ?>" class="input-form-verde" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="color: #e6edf3; display:block; margin-bottom: 5px;">Nueva Contraseña:</label>
            <input type="password" name="password" placeholder="Déjalo en blanco para no cambiarla" class="input-form-verde">
        </div>

        <div style="text-align: right; margin-top: 25px;">
            <button type="button" onclick="cerrarModalEditarPerfil()" style="padding: 10px 20px; background: #30363d; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">
                Cancelar
            </button>
            <button type="submit" class="btn-nuevo">
                <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios
            </button>
        </div>
    </form>
</div>

<div id="fondoPerfil" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.85); z-index:10000;" onclick="cerrarModalEditarPerfil()"></div>

<style>
    .input-form-verde {
        width: 100%;
        padding: 10px;
        background: #0d1117;
        border: 1px solid #30363d;
        border-radius: 6px;
        color: white;
        transition: 0.3s;
    }

    .input-form-verde:focus {
        border-color: #2ecc71;
        outline: none;
        box-shadow: 0 0 8px rgba(46, 204, 113, 0.2);
    }
</style>

<script>
    function abrirModalEditarPerfil() {
        document.getElementById('modalEditarPerfil').style.display = 'block';
        document.getElementById('fondoPerfil').style.display = 'block';
    }

    function cerrarModalEditarPerfil() {
        document.getElementById('modalEditarPerfil').style.display = 'none';
        document.getElementById('fondoPerfil').style.display = 'none';
    }
</script>