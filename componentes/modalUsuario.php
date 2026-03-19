<div id="modalUsuario" style="display:none; position:fixed; top:5%; left:25%; width:50%; background:white; border:2px solid #2c3e50; padding:20px; z-index:1000; box-shadow: 0 4px 25px rgba(0,0,0,0.6); border-radius: 10px; font-family: sans-serif; max-height: 90vh; overflow-y: auto;">

    <h3 style="margin-top:0; color: #2c3e50;">
        <i class="fa-solid fa-user-plus" style="color: #3498db;"></i> Registrar Nuevo Usuario
    </h3>
    <p style="color: #7f8c8d; font-size: 0.9em;">Completa todos los campos para dar de alta a un nuevo integrante.</p>
    <hr>

    <form action="../../modulos/usuarios/registrarUsuarios.php" method="POST">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
            <div>
                <label><strong>Nombre(s):</strong></label>
                <input type="text" name="nombre" class="input-form" required placeholder="Ej. Juan">
            </div>
            <div>
                <label><strong>Apellido Paterno:</strong></label>
                <input type="text" name="paterno" class="input-form" required placeholder="Ej. Perez">
            </div>
            <div>
                <label><strong>Apellido Materno:</strong></label>
                <input type="text" name="materno" class="input-form" placeholder="Ej. Lopez">
            </div>
            <div>
                <label><strong>Correo Electrónico:</strong></label>
                <input type="email" name="correo" class="input-form" required placeholder="correo@ejemplo.com">
            </div>
            <div>
                <label><strong>Teléfono:</strong></label>
                <input type="text" name="telefono" class="input-form" placeholder="5512345678">
            </div>
            <div>
                <label><strong>Fecha de Nacimiento:</strong></label>
                <input type="date" name="fecha_nac" class="input-form" required>
            </div>
        </div>

        <h4 style="margin-bottom: 10px; color: #34495e; border-bottom: 1px solid #eee; padding-bottom: 5px;">
            <i class="fa-solid fa-key"></i> Datos de Acceso
        </h4>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div>
                <label><strong>Nombre de Usuario:</strong></label>
                <input type="text" name="usuario" class="input-form" required placeholder="Ej. jperez">
            </div>
            <div>
                <label><strong>Contraseña:</strong></label>
                <input type="password" name="password" class="input-form" required placeholder="********">
            </div>
            <div>
                <label><strong>Asignar Rol:</strong></label>
                <select name="id_rol" class="input-form" required>
                    <option value="" disabled selected>Selecciona un rol</option>
                    <option value="1">Administrador</option>
                    <option value="2">Cliente</option>
                </select>
            </div>
        </div>

        <div style="text-align: right; margin-top: 25px;">
            <button type="button" onclick="cerrarModalUsuario()" style="padding: 10px 20px; background: #95a5a6; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">
                Cancelar
            </button>
            <button type="submit" style="padding: 10px 25px; background: #2980b9; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                <i class="fa-solid fa-save"></i> Guardar Usuario
            </button>
        </div>
    </form>
</div>

<div id="fondoModalUsuario" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:999;" onclick="cerrarModalUsuario()"></div>

<style>
    .input-form {
        width: 100%;
        padding: 8px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;

    }
</style>

<script>
    function abrirModalUsuario() {
        document.getElementById('modalUsuario').style.display = 'block';
        document.getElementById('fondoModalUsuario').style.display = 'block';
    }

    function cerrarModalUsuario() {
        document.getElementById('modalUsuario').style.display = 'none';
        document.getElementById('fondoModalUsuario').style.display = 'none';
    }
</script>