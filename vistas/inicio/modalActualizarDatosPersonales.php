<form id="frmActualizarDatosPersonales" method="POST" onsubmit="return actualizarDatosPersonales()">
    <div class="modal fade" id="modalActualizarDatosPersonales" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog shadow-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fas fa-user-edit me-2"></i> Actualizar Datos Personales
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idUsuarioInicio" name="idUsuarioInicio">

                    <div class="form-group mb-2">
                        <label for="paternoInicio">Apellido Paterno</label>
                        <input type="text" class="form-control" id="paternoInicio" name="paternoInicio" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="maternoInicio">Apellido Materno</label>
                        <input type="text" class="form-control" id="maternoInicio" name="maternoInicio" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="nombreInicio">Nombre(s)</label>
                        <input type="text" class="form-control" id="nombreInicio" name="nombreInicio" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="telefonoInicio">Teléfono</label>
                        <input type="text" class="form-control" id="telefonoInicio" name="telefonoInicio" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="correoInicio">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correoInicio" name="correoInicio" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="fechaInicio">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary shadow-sm" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-warning shadow-sm font-weight-bold">
                        <i class="fas fa-save me-1"></i> Actualizar Información
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>