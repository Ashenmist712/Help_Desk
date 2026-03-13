<form id="frmAgregarUsuario" method="POST" onsubmit="return agregarNuevoUsuario()">
    <div class="modal fade" id="modalAgregarUsuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarUsuarios">Agregar Nuevo Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mol-sm-4">
                            <label for="paterno">Apellido Paterno</label>
                            <input type="text" class="form-control" id="paterno" name="paterno">
                        </div>
                        <div class="mol-sm-4">
                            <label for="materno">Apellido Materno</label>
                            <input type="text" class="form-control" id="materno" name="materno">
                        </div>
                        <div class="mol-sm-4">
                            <label for="nombre">Nombre(s)</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mol-sm-4">
                            <label for="fechaNacimientp">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento">
                        </div>
                        <div class="mol-sm-4">
                            <label for="sexo">Sexo</label>
                            <select class="form-control" id="sexo" name="sexo">
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                        <div class="mol-sm-4">
                            <label for="telefono">Telefono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mol-sm-4">
                            <label for="paterno">Correo</label>
                            <input type="mail" class="form-control" id="" name="">
                        </div>
                        <div class="mol-sm-4">
                            <label for="paterno">Usuario</label>
                            <input type="text" class="form-control" id="paterno" name="paterno">
                        </div>
                        <div class="mol-sm-4">
                            <label for="paterno">Password</label>
                            <input type="text" class="form-control" id="paterno" name="paterno">
                        </div>
                        <div class="row">
                            <div class="col-sm--12">
                                <label for="idRol">Rol de Usuario</label>
                                <select name="idRol" id="form-control">
                                    <optio value="1">Cliente</optio>
                                    <optio value="2">Administrador</optio>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label for="ubicacion">Ubicacion</label>
                            <textarea name="ubicacion" id="ubicacion" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="btn btn-secondary" data-dismiss="modal">Cerrar</span>
                    <button class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</form>