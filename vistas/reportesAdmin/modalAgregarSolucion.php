<form id="frmAgregarSolucionReporte" method="POST" onsubmit=" return agregarSolucionReporte()">
    <div class="modal fade" id="modalAgregarSolucionReporte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Solucion:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="idReporte" name="idReporte" hidden>
                    <label for="solucion">Descripcion de la solucion</label>
                    <textarea name="solucion" id="solucion" class="form-control" required></textarea>
                    <label for="estatus">Esatus</label>
                    <select name="estatus" id="estatus" class="form-control">
                        <option value="1">Abierto</option>
                        <option value="0">Cerrado</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>