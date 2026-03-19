<div id="modalAsignacion" style="display:none; position:fixed; top:5%; left:20%; width:60%; background:white; border:2px solid #27ae60; padding:25px; z-index:1000; box-shadow: 0 4px 25px rgba(0,0,0,0.6); border-radius: 12px; font-family: 'Segoe UI', sans-serif; max-height: 90vh; overflow-y: auto;">

    <h3 style="margin-top:0; color: #2c3e50;">
        <i class="fa-solid fa-link" style="color: #27ae60;"></i> Asignar Nuevo Equipo
    </h3>
    <p style="color: #7f8c8d; font-size: 0.9em;">Vincula un dispositivo del inventario a un usuario específico.</p>
    <hr style="border: 0; border-top: 1px solid #eee; margin: 15px 0;">

    <form action="../../modulos/asignacion/guardarAsignacion.php" method="POST">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
            <div>
                <label style="display:block; margin-bottom: 5px; font-weight: bold;">Persona:</label>
                <select name="id_persona" required class="input-form">
                    <option value="" disabled selected>Selecciona una persona</option>
                    <?php
                    $resP = $conexion->query("SELECT id_persona, nombre, paterno FROM t_persona");
                    while ($p = $resP->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$p['id_persona']}'>{$p['nombre']} {$p['paterno']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label style="display:block; margin-bottom: 5px; font-weight: bold;">Tipo de Equipo:</label>
                <select name="id_equipo" required class="input-form">
                    <option value="" disabled selected>Selecciona tipo</option>
                    <?php
                    $resE = $conexion->query("SELECT id_equipo, nombre FROM t_cat_equipo");
                    while ($e = $resE->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$e['id_equipo']}'>{$e['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
            <div>
                <label style="display:block; margin-bottom: 5px; font-weight: bold;">Marca:</label>
                <input type="text" name="marca" placeholder="Ej. HP, Dell..." required class="input-form">
            </div>
            <div>
                <label style="display:block; margin-bottom: 5px; font-weight: bold;">Modelo:</label>
                <input type="text" name="modelo" placeholder="Ej. ProBook G9" required class="input-form">
            </div>
            <div>
                <label style="display:block; margin-bottom: 5px; font-weight: bold;">Color:</label>
                <input type="text" name="color" placeholder="Ej. Negro, Plata" class="input-form">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
            <div>
                <label style="display:block; margin-bottom: 5px; font-weight: bold;">Memoria:</label>
                <input type="text" name="memoria" placeholder="Ej. 16GB RAM" class="input-form">
            </div>
            <div>
                <label style="display:block; margin-bottom: 5px; font-weight: bold;">Disco Duro:</label>
                <input type="text" name="disco_duro" placeholder="Ej. 512GB SSD" class="input-form">
            </div>
            <div>
                <label style="display:block; margin-bottom: 5px; font-weight: bold;">Procesador:</label>
                <input type="text" name="procesador" placeholder="Ej. Ryzen 5" class="input-form">
            </div>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; margin-bottom: 5px; font-weight: bold;">Descripción Adicional / Serie:</label>
            <textarea name="descripcion" class="input-form" rows="3" style="resize: none;" placeholder="Ingresa el número de serie o detalles del estado del equipo..."></textarea>
        </div>

        <div style="text-align: right; margin-top: 25px;">
            <button type="button" onclick="cerrarModalAsignacion()" style="padding: 10px 20px; background: #95a5a6; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">
                Cancelar
            </button>
            <button type="submit" style="padding: 10px 25px; background: #27ae60; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                <i class="fa-solid fa-save"></i> Guardar Asignación
            </button>
        </div>
    </form>
</div>

<div id="fondoAsig" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:999;" onclick="cerrarModalAsignacion()"></div>

<style>

</style>