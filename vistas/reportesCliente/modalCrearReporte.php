<form id="frmNuevoReporte" method="POST" onsubmit="return agregarNuevoReporte();">
    <div class="modal fade" id="modalCrearReporte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Reporte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="idEquipo">Mis Dispositivos</label>
                    <select name="idEquipo" id="idEquipo" class="form-control" required>
                        <option value="">Selecciona un Dispositivo</option>
                    </select>
                    <label for="problema">Describe tu Problema</label>
                    <textarea name="problema" id="problema" class="form-control" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-danger">Crear</button>
                </div>
            </div>
        </div>
    </div>
</form>