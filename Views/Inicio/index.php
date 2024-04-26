<?php include "Views/Templates/header.php"; ?>
<div class="d-flex justify-content-between">
    
    <button class="btn btn-primary mb-2" type="button" onclick="IngresarRegistro();">Ingresar Registro <i class="fas fa-chart-bar" style="margin-left: 5px;"></i></button>
    <button class="btn btn-primary mb-2" type="button" onclick="generarPDF();">Generar PFD <i class="fas fa-chart-bar" style="margin-left: 5px;"></i></button>
</div>
    <div class="card">
        <div class="card-header bg-dark text-white text-center fs-4">
            Inventario
        </div>
        <table class="table table-light" id="tblInventario">
    <thead class="thead-dark">
        <tr>
            <th>Id Inventario</th>
            <th>Productos ID</th>
            <th>Tipo Kardex</th>
            <th>Fecha Entrada</th>
            <th>Cantidad Entrada</th>
            <th>Fecha Salida</th>
            <th>Numero de Factura</th>
            <th>Cantidad Salida</th>
            <th>Motivo Salida</th>
            <th>Costo Unitario</th>
            <th>Costo Total</th>
            <th>Acciones</th>
        </tr>
    </thead>
    </tbody>
 </table>
    </div>
 <?php include "Views/Templates/footer.php"; ?>