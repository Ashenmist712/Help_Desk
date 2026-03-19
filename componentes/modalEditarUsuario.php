<div id="modalEditarUsuario" style="display:none; position:fixed; top:5%; left:25%; width:50%; background:white; border:2px solid #3498db; padding:20px; z-index:1000; box-shadow: 0 4px 25px rgba(0,0,0,0.6); border-radius: 10px; font-family: sans-serif; max-height: 90vh; overflow-y: auto;">

    <h3 style="margin-top:0; color: #2c3e50;">
        <i class="fa-solid fa-user-pen" style="color: #3498db;"></i> Editar Información de Usuario
    </h3>
    <p style="color: #7f8c8d; font-size: 0.9em;">Modifica los datos necesarios y guarda los cambios.</p>
    <hr>

    <form action="../../modulos/usuarios/actualizarUsuario.php" method="POST">
        <input type="hidden" id="id_usuario_u" name="id_usuario">
        <input type="hidden" id="id_persona_u" name="id_persona">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
            <div>
                <label><strong>Nombre(s):</strong></label>
                <input type="text" id="nombre_u" name="nombre" class="input-form" required>
            </div>
            <div>
                <label><strong>Apellido Paterno:</strong></label>
                <input type="text" id="paterno_u" name="paterno" class="input-form" required>
            </div>
            <div>
                <label><strong>Apellido Materno:</strong></label>
                <input type="text" id="materno_u" name="materno" class="input-form">
            </div>
            <div>
                <label><strong>Nombre de Usuario:</strong></label>
                <input type="text" id="usuario_u" name="usuario" class="input-form" required>
            </div>
            <div>
                <label><strong>Rol de Acceso:</strong></label>
                <select id="id_rol_u" name="id_rol" class="input-form" required>
                    <option value="1">Administrador</option>
                    <option value="2">Cliente</option>
                </select>
            </div>
        </div>

        <div style="text-align: right; margin-top: 25px;">
            <button type="button" onclick="cerrarModalEditar()" style="padding: 10px 20px; background: #95a5a6; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">
                Cancelar
            </button>
            <button type="submit" style="padding: 10px 25px; background: #f39c12; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                <i class="fa-solid fa-rotate"></i> Actualizar Datos
            </button>
        </div>
    </form>
</div>

<div id="fondoModalEditar" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:999;" onclick="cerrarModalEditar()"></div>

<script>
    function abrirModalEditar() {
        document.getElementById('modalEditarUsuario').style.display = 'block';
        document.getElementById('fondoModalEditar').style.display = 'block';
    }

    function cerrarModalEditar() {
        document.getElementById('modalEditarUsuario').style.display = 'none';
        document.getElementById('fondoModalEditar').style.display = 'none';
    }
</script>