<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active" style="color: #ffffff; font-family: 'Arial', sans-serif; font-size: 20px; text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);">
        Proveedores
    </li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmProveedor();">Nuevo Registro <i class="fas fa-plus"></i></button>
<div class="table-responsive">
    <table class="table table-light" id="tblProveedores">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre del proveedor</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Condiciones de pago</th>
                <th>Plazo de entrega</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        </tbody>
    </table>
</div>


<div id="nuevo_proveedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Proveedor</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmProveedores">


                    <div class="form-group">
                        <label for="proveedores_id"></label>
                        <input id="proveedores_id" class="form-control" type="hidden" name="proveedores_id" placeholder="ID proveedor">
                    </div>

                    <div class="form-group">
                        <label for="nombre_proveedor">Nombre del Proveedor</label>
                        <input id="nombre_proveedor" class="form-control" type="text" name="nombre_proveedor" placeholder="Nombre del Proveedor">
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Dirección">
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Teléfono">
                    </div>

                    <div class="form-group">
                        <label for="condiciones_pago">Condiciones de pago</label>
                        <input id="condiciones_pago" class="form-control" type="text" name="condiciones_pago" placeholder="Condiciones de pago">
                    </div>

                    <div class="form-group">
                        <label for="plazo_entrega">Plazo de entrega</label>
                        <input id="plazo_entrega" class="form-control" type="text" name="plazo_entrega" placeholder="Plazo de entrega">
                    </div>

                    <button class="btn btn-primary" type="button" onclick="registrarProv(event);" id="btnAccion">Registrar</button>
                    <b-btn class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</b-btn>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>