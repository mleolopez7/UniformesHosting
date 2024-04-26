<?php include "Views/Templates/header.php"; ?>
<div class="card-header bg-dark text-white text-center fs-4">
    Producto terminado - Listo para entregar
</div>
<br>

<div class="table-responsive-sm">
    <table class="table table-sm table-light" id="tblEntregas">
        <thead class="thead-dark">
            <tr>
            <th>Nº Factura</th>
                <th>Cliente</th>
                <th>Identificacion</th>
                <th>Telefono</th>
                <th>Fecha Entrega</th>
                <th>Total Venta</th>
                <th>Debe</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <!-- Aquí van tus filas de datos -->
        </tbody>
    </table>
</div>

<?php include "Views/Templates/footer.php"; ?>