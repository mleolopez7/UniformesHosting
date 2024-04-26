<?php include "Views/Templates/header.php"; ?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active" style="color: #ffffff; font-family: 'Arial', sans-serif; font-size: 20px; text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);">
        Clientes
    </li>
</ol>

<button class="btn btn-primary mb-2" type="button" onclick="frmCliente();">Nuevo Registro <i class="fas fa-plus"></i></button>

<table class="table table-light" id="tblClientes">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Identificacion</th>
            <th>Teléfono</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Cliente</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmClientes">
                    <div class="form-group">
                        <label for="clientes_id"></label>
                        <input id="clientes_id" class="form-control" type="hidden" name="clientes_id" placeholder="ID cliente">
                    </div>

                    <div class="form-group">
                        <label for="nombre_cliente">Nombre del Cliente</label>
                        <input id="nombre_cliente" class="form-control" type="text" name="nombre_cliente" placeholder="Nombre del Cliente">
                    </div>

                    <div class="form-group">
                        <label for="identificacion">Identificacion</label>
                        <input id="identificacion" class="form-control" type="text" name="identificacion" placeholder="Identificacion">
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Teléfono">
                    </div>

                    <button class="btn btn-primary" type="button" onclick="registrarCliente(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>