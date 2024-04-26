<?php include "Views/Templates/header.php"; ?>
<div class="card-header bg-dark text-white text-center fs-4">
    Catálogo de productos vendidos
</div>
<br>

<div class="table-responsive-sm">
    <table class="table table-sm table-light" id="tblCatalogo">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Factura</th>
                <th>Cliente</th>
                <th>Fecha Orden</th>
                <th>Fecha Entrega</th>
                <th>Total Venta</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <!-- Aquí van tus filas de datos -->
        </tbody>
    </table>
</div>

<div id="foto_catalogo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Foto del Producto vendido</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCatalogo" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Seleccione la imagen</label>
                                <div class="card border-primary">
                                <div class="form-group">
                                        <label for="id_catalogo"></label>
                                        <input id="id_catalogo" class="form-control" type="hidden" name="id_catalogo" placeholder="id_catalogo">
                                    </div>
                                    <div class="card-body">
                                        <label for="imagen" id="icon-image" class="btn btn-primary"><i class="fas fa-image"></i></label>
                                        <span id="icon-cerrar"></span>
                                        <input id="imagen" class="d-none" type="file" name="imagen" onchange="preview(event)">
                                        <input type="hidden" id="foto_actual" name="foto_actual">
                                        <input type="hidden" id="foto_delete" name="foto_delete">
                                        <img class="img-thumbnail" id="img-preview">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <button class="btn btn-primary" type="submit" onclick="registrarImagen(event);" id="btnAccion">Subir Imagen</button>
                    <b-btn class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</b-btn>
            </div>
            </form>
        </div>
    </div>
</div>
</div>


<?php include "Views/Templates/footer.php"; ?>