<?php include "Views/Templates/header.php"; ?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active" style="color: #ffffff; font-family: 'Arial', sans-serif; font-size: 20px; text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);">
        Materia Prima
    </li>
</ol>

<button class="btn btn-primary mb-2" type="button" onclick="frmMateriaPrima();">Nuevo Registro <i class="fas fa-plus"></i></button>

<table class="table table-light" id="tblMateriaPrima">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<div id="nuevo_materia_prima" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nueva Materia Prima</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmMateriaPrima">
                    <div class="form-group">
                        <label for="materia_prima_id"></label>
                        <input id="materia_prima_id" class="form-control" type="hidden" name="materia_prima_id" placeholder="ID materia prima">
                    </div>

                    <div class="form-group">
                        <label for="producto">Producto</label>
                        <input id="producto" class="form-control" type="text" name="producto" placeholder="Nombre del Producto">
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input id="descripcion" class="form-control" type="text" name="descripcion" placeholder="Descripción">
                    </div>

                    <button class="btn btn-primary" type="button" onclick="registrarMateriaPrima(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>
