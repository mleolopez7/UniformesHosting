<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active" style="color: #ffffff; font-family: 'Arial', sans-serif; font-size: 20px; text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);">
        Roles
    </li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmRol();">Nuevo Registro <i class="fas fa-plus"></i></button>
<div class="table-responsive">
    <table class="table table-light" id="tblRoles">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Roles</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        </tbody>
    </table>
</div>

<div id="nuevo_rol" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Rol</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmRol">
                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <input type="hidden" id="rol" name="rol">
                        <input id="rol" class="form-control" type="text" name="rol" placeholder="Rol">
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registrarRol(event);" id="btnAccionRol">Registrar</button>
                    <b-btn class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</b-btn>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php include "Views/Templates/footer.php"; ?>