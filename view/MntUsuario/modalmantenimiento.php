<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="mdltitulo"></h4>
            </div>
            <form method="post" id="usuario_form">
                <div class="modal-body">
                    <input type="hidden" id="usu_id" name="usu_id">

                    <div class="form-group">
                        <label class="form-label" for="usu_nom">Nombre</label>
                        <input type="text" class="form-control" id="usu_nom" name="usu_nom" placeholder="Ingrese Nombre" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="usu_ap">Apellido</label>
                        <input type="text" class="form-control" id="usu_ap" name="usu_ap" placeholder="Ingrese Apellido" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="usu_correo">Correo Electrónico</label>
                        <input type="email" class="form-control" id="usu_correo" name="usu_correo" placeholder="Ingrese el correo electrónico" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="usu_telf">Teléfono</label>
                        <input type="text" class="form-control" id="usu_telf" name="usu_telf" placeholder="ej: +57 300..." required>
                    </div>

                    <div class="form-group">
                        <label class="form-label semibold" for="usu_dep">Departamento / Área</label>
                        <select id="usu_dep" name="usu_dep" class="form-control" style="width: 100%">
                            <option value ="">Seleccionar</option>
                            <option value="Ingenieria">Ingeniería</option>
                            <option value="Soporte">Soporte</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="usu_pass">Contraseña</label>
                        <input type="password" class="form-control" id="usu_pass" name="usu_pass" placeholder="**********">
                        <small class="text-muted" id="pass_help">Dejar en blanco para mantener la contraseña actual (Solo en edición).</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="rol_id">Rol</label>
                        <select class="form-control" id="rol_id" name="rol_id" style="width: 100%">
                            <option value="1">Usuario</option>
                            <option value="2">Soporte</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" value="add"class="btn btn-rounded btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>