<?php include "Views/Templates/header.php"; ?>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active" style="color: #ffffff; font-family: 'Arial', sans-serif; font-size: 20px; text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);">
        Usuarios
    </li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmUsuario();">Nuevo Registro <i class="fas fa-plus"></i></button>
<div class="table-responsive">
    <table class="table table-light" id="tblUsuarios">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Correos</th>
                <th>Caja</th>
                <th>Roles</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        </tbody>
    </table>
</div>

<div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Usuario</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmUsuarios">
                    <div class="form-group" id="usuarios">
                        <label for="usuario">Usuario</label>
                        <input type="hidden" id="id" name="id">
                        <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario">
                    </div>
                    <span id='errorUsuario' class="text-danger"></span>

                    <div class="form-group" id="nombres">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del usuario">
                    </div>
                    <span id='errorNombre' class="text-danger"></span>

                    <div class="form-group" id="correos">
                        <label for="correo">Correo Eléctronico</label>
                        <input id="correo" class="form-control" type="text" name="correo" placeholder="Correo electrónico" required>
                    </div>
                    <span id='errorCorreo' class="text-danger"></span>

                    <div class="row" id="claves">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="clave">Contraseña</label>
                                <input id="clave" class="form-control" type="password" name="clave" placeholder="Contraseña">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirmar">Confirmar Contraseña</label>
                                <input id="confirmar" class="form-control" type="password" name="confirmar" placeholder="Confirmar contraseña">
                            </div>
                        </div>
                    </div>
                    <span id='errorClave' class="text-danger"></span>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="cajas">
                                <label for="caja">Caja</label>
                                <select id="caja" class="input-group-text" name="caja">
                                    <option selected> Seleccionar </option>
                                    <?php foreach ($data['cajas'] as $row) {  ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['caja']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" id="roles">
                                <label for="caja">Rol</label>
                                <select id="rol" class="input-group-text" name="rol">
                                    <option selected> Seleccionar </option>
                                    <?php foreach ($data['roles'] as $row) {  ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['rol']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                    </div>
                    <br>
                    <button class="btn btn-primary" type="submit" onclick="registrarUser(event);" id="btnAccion">Registrar</button>
                    <b-btn class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</b-btn>
            </div>
            </form>
        </div>
    </div>
</div>
</div>


<?php include "Views/Templates/footer.php"; ?>