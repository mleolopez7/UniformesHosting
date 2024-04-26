<?php include "Views/Templates/header.php"; ?>

<div class="card">
    <div class="card-header bg-dark text-white text-center fs-4">
        Historial de entradas y salidas
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-light" id="tblKardex">
            <thead class="thead-dark">
                <tr>
                    <th>ID Kardex</th>
                    <th>ID Inventario</th>
                    <th>Proveedor</th>
                    <th>ID Producto</th>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Tipo Kardex</th>
                    <th>Fecha Entrada</th>
                    <th>Cantidad Entrada</th>
                    <th>Fecha Salida</th>
                    <th>Factura</th>
                    <th>Cantidad Salida</th>
                    <th>Motivo Salida</th>
                    <th>Precio Unitario</th>
                    <th>Costo Total</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</div>
<br>

<?php include "Views/Templates/footer.php"; ?>