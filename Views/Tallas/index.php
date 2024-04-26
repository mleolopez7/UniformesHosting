<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active" style="color: #ffffff; font-family: 'Arial', sans-serif; font-size: 20px; text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);">
        Tallas
    </li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmTallas();">Nuevo Registro <i class="fas fa-plus"></i></button>
<table class="table table-light" id="tblTallas">
    <thead class="thead-dark">
        <tr>
            <th>TallasID</th>
            <th>TipoTallas</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    </tbody> 
</table>

<div id="nuevo_talla" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nueva Talla</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmTallas">
                    <div class="form-group">
                        <label for="TallasID"></label>
                        <input id="TallasID" class="form-control" type="hidden" name="TallasID" placeholder="ID Tallas">
                    </div>

                    <div class="form-group">
                        <label for="TipoTalla">Tipo de talla</label>
                        <input id="TipoTalla" class="form-control" type="text" name="TipoTalla" placeholder="Tipo de talla">
                    </div>

                    <button class="btn btn-primary" type="button" onclick="registrarTallas(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>

