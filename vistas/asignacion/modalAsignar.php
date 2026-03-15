<div class="modal fade" id="modalAsignarEquipo" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Asignar Equipo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6"> <label for="idPersona">Nombre de Persona</label>
                        <select name="idPersona" id="idPersona" class="form-control" required>
                            <option value="">Selecciona una persona</option>
                        </select>
                    </div>
                    <div class="col-sm-6"> <label for="idEquipo">Tipo de Equipo</label>
                        <select name="idEquipo" id="idEquipo" class="form-control" required>
                            <option value="">Selecciona un equipo</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col sm 4">
                        <label for="marca">Marca</label>
                        <input type="text" name="marca" id="marca" class="form-control">
                    </div>
                    <div class="col sm 4">
                        <label for="modelo">Modelo</label>
                        <input type="text" name="modelo" id="modelo" class="form-control">
                    </div>
                    <div class="col sm 4">
                        <label for="color">Color</label>
                        <input type="text" name="color" id="color" class="form-control">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Asignar</button>
            </div>

        </div>
    </div>
</div>