<form id="frmActualizarAsignacion" method="POST" onsubmit="return actualizarAsignacion();">
    <div class="modal fade" id="modalActualizarAsignacion" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Actualizar Asignación</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="idAsignacion" id="idAsignacion">

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="idPersonaU">Nombre de Persona</label>
                            <?php
                            $sql = "SELECT 
                                        persona.id_persona,
                                        CONCAT_WS(' ', persona.paterno, persona.materno, persona.nombre) AS nombre
                                    FROM
                                        t_persona AS persona
                                        INNER JOIN t_usuarios AS usuario ON persona.id_persona = usuario.id_persona
                                    WHERE usuario.id_rol = 1
                                    ORDER BY persona.nombre ASC";
                            $respuesta = mysqli_query($conexion, $sql);
                            ?>
                            <select name="idPersonaU" id="idPersonaU" class="form-control" required>
                                <option value="">Selecciona una persona</option>
                                <?php while ($mostrar = mysqli_fetch_array($respuesta)) { ?>
                                    <option value="<?php echo $mostrar['id_persona']; ?>">
                                        <?php echo $mostrar['nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="idEquipoU">Tipo de Equipo</label>
                            <?php
                            $sql = "SELECT * FROM t_cat_equipo ORDER BY nombre ASC";
                            $respuesta = mysqli_query($conexion, $sql);
                            ?>
                            <select name="idEquipoU" id="idEquipoU" class="form-control" required>
                                <option value="">Selecciona un equipo</option>
                                <?php while ($mostrar = mysqli_fetch_array($respuesta)) { ?>
                                    <option value="<?php echo $mostrar['id_equipo']; ?>">
                                        <?php echo $mostrar['nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <label for="marcaU">Marca</label>
                            <input type="text" name="marcaU" id="marcaU" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="modeloU">Modelo</label>
                            <input type="text" name="modeloU" id="modeloU" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="colorU">Color</label>
                            <input type="text" name="colorU" id="colorU" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <label for="descripcionU">Descripción</label>
                            <textarea name="descripcionU" id="descripcionU" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <label for="memoriaU">Memoria</label>
                            <input type="text" id="memoriaU" name="memoriaU" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="discoDuroU">Disco Duro</label>
                            <input type="text" id="discoDuroU" name="discoDuroU" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="procesadorU">Procesador</label>
                            <input type="text" id="procesadorU" name="procesadorU" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-warning text-white">Actualizar</button>
                </div>

            </div>
        </div>
    </div>
</form>