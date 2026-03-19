<div id="modalEditar" style="display:none; position:fixed; top:10%; left:30%; width:40%; background:white; border:2px solid #000; padding:20px; z-index:1000;">
    <h3>Editar Datos de Usuario</h3>
    <form action="../../modulos/usuarios/actualizar.php" method="POST">
        <input type="hidden" name="id_persona" id="edit_id_persona">

        <label>Nombre:</label><br>
        <input type="text" name="nombre" id="edit_nombre" required><br>

        <label>Apellido Paterno:</label><br>
        <input type="text" name="paterno" id="edit_paterno" required><br>

        <label>Apellido Materno:</label><br>
        <input type="text" name="materno" id="edit_materno" required><br>

        <label>Fecha de Nacimiento:</label><br>
        <input type="date" name="fecha_nacimiento" id="edit_fecha_nac" required><br>

        <label>Teléfono:</label><br>
        <input type="text" name="telefono" id="edit_telefono"><br>

        <label>Correo:</label><br>
        <input type="email" name="correo" id="edit_correo"><br><br>

        <button type="submit">Guardar Cambios</button>
        <button type="button" onclick="cerrarModal()">Cancelar</button>
    </form>
</div>