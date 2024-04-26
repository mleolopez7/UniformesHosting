<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active" style="color: #ffffff; font-family: 'Arial', sans-serif; font-size: 20px; text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);">
        Tipo de producto
    </li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmProducto();">Nuevo Producto <i class="fas fa-plus"></i></button>
<div class="table-responsive">
    <table class="table table-light" id="tblProductosb">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Codigo</th>
                <th>Tipo de Producto</th>
                <th>Descripción</th>
                <th>Nombre de Producto</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        </tbody>
    </table>
</div>

<div id="nuevo_producto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Producto</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmProducto">
                    <div class="form-group" id="Productos">
                        <label for="codigo">Código Producto</label>
                        <input type="hidden" id="id" name="id">
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Código del Producto">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="nombres">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del Producto">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipopb">Tipo</label>
                                <input id="tipopb" class="form-control" type="text" name="tipopb" placeholder="Tipo del Producto">
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="descripcion">
                        <label for="descripcion">Descripción</label>
                        <input id="descripcion" class="form-control" type="text" name="descripcion" placeholder="Descripción del producto">
                    </div>

                    <br>
                    <button class="btn btn-primary" type="button" onclick="registrarProb(event);" id="btnAccion">Registrar</button>
                    <b-btn class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</b-btn>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php include "Views/Templates/footer.php"; ?>