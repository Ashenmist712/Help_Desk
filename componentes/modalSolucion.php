<div id="modalSolucion" style="display:none; position:fixed; top:10%; left:25%; width:50%; background:white; padding:25px; z-index:1000; border-radius:12px; box-shadow: 0 5px 20px rgba(0,0,0,0.5);">
    <h3 style="color: #2c3e50;"><i class="fa-solid fa-tools"></i> Registrar Solución</h3>
    <hr>
    <form action="../../modulos/reportes/guardarSolucion.php" method="POST">
        <input type="hidden" id="id_reporte_s" name="id_reporte">

        <label><strong>Descripción de la solución:</strong></label>
        <textarea name="solucion" id="solucion_s" class="input-form" rows="5" required placeholder="Describe qué reparaste..."></textarea>

        <div style="text-align: right; margin-top: 20px;">
            <button type="button" onclick="cerrarModalSolucion()" style="padding:10px 20px; border-radius:5px; border:none; background:#95a5a6; color:white; cursor:pointer;">Cancelar</button>
            <button type="submit" style="padding:10px 20px; border-radius:5px; border:none; background:#27ae60; color:white; cursor:pointer; font-weight:bold;">Finalizar Reporte</button>
        </div>
    </form>
</div>
<div id="fondoSolucion" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:999;" onclick="cerrarModalSolucion()"></div>

<script>
    function cerrarModalSolucion() {
        document.getElementById('modalSolucion').style.display = 'none';
        document.getElementById('fondoSolucion').style.display = 'none';
    }
</script>