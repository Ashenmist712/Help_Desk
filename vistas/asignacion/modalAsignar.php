<form id="frmAsignarEquipo" method="POST" onsubmit="return asignarEquipo();">
    <div class="modal fade" id="modalAsignarEquipo" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Asignar Equipo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="idPersona">Nombre de Persona</label>
                            <?php $sql = "SELECT 
                                                persona.id_persona,
                                                CONCAT_WS(' ', persona.paterno, persona.materno, persona.nombre) AS nombre
                                            FROM
                                                t_persona AS persona
                                                INNER JOIN t_usuarios AS usuario ON persona.id_persona = usuario.id_persona
                                            WHERE usuario.id_rol = 1
                                            ORDER BY persona.nombre ASC";
                            $respuesta = mysqli_query($conexion,  $sql);
                            ?>
                            <select name="idPersona" id="idPersona" class="form-control" required>
                                <option value="">Selecciona una persona</option>
                                <?php while ($mostrar = mysqli_fetch_array($respuesta)) { ?>
                                    <option value="<?php echo $mostrar['id_persona']; ?>">
                                        <?php echo $mostrar['nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="idEquipo">Tipo de Equipo</label>

                            <?php $sql = "SELECT * FROM t_cat_equipo ORDER BY nombre ASC"; ?>
                            <?php $respuesta = mysqli_query($conexion, $sql); ?>

                            <select name="idEquipo" id="idEquipo" class="form-control" required>
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
                        <div class="col-sm-4"> <label for="marca">Marca</label>
                            <input type="text" name="marca" id="marca" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="modelo">Modelo</label>
                            <input type="text" name="modelo" id="modelo" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="color">Color</label>
                            <input type="text" name="color" id="color" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <label for="memoria">Memoria</label>
                            <input type="text" id="memoria" name="memoria" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="discoDuro">Disco Duro</label>
                            <input type="text" id="discoDuro" name="discoDuro" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="procesador">Procesador</label>
                            <input type="text" id="procesador" name="procesador" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary">Asignar</button>
                </div>

            </div>
        </div>
    </div>
</form>