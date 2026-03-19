<div id="modalReporte" style="display:none; position:fixed; top:15%; left:30%; width:40%; background:white; border:2px solid #2c3e50; padding:20px; z-index:1000; box-shadow: 0 4px 20px rgba(0,0,0,0.5); border-radius: 10px; font-family: sans-serif;">

    <h3 style="margin-top:0; color: #2c3e50;">
        <i class="fa-solid fa-circle-exclamation" style="color: #e67e22;"></i> Levantar Nuevo Reporte
    </h3>
    <hr>

    <form action="../../modulos/reportes/crearReporte.php" method="POST">

        <label><strong>¿Qué equipo falla?</strong></label><br>
        <input type="text" name="equipo_escrito" placeholder="Ej. Laptop HP, Mouse, etc." required style="width:100%; padding:8px; margin:10px 0; border: 1px solid #ccc; border-radius: 4px;">

        <br>
        <label><strong>Descripción del problema:</strong></label><br>
        <textarea name="problema" rows="4" required style="width:100%; padding:8px; margin:10px 0; border: 1px solid #ccc; border-radius: 4px; resize: none;"></textarea>

        <br><br>

        <div style="text-align: right;">
            <button type="button" onclick="cerrarModalReporte()" style="padding: 10px 15px; background: #95a5a6; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">
                Cancelar
            </button>
            <button type="submit" style="padding: 10px 20px; background: #27ae60; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                Enviar Reporte
            </button>
        </div>
    </form>
</div>

<div id="fondoModalReporte" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:999;" onclick="cerrarModalReporte()"></div>

<script>
    function abrirModalReporte() {
        document.getElementById('modalReporte').style.display = 'block';
        document.getElementById('fondoModalReporte').style.display = 'block';
    }

    function cerrarModalReporte() {
        document.getElementById('modalReporte').style.display = 'none';
        document.getElementById('fondoModalReporte').style.display = 'none';
    }
</script>