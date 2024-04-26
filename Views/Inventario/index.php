<?php
include "Views/Templates/header.php"; ?>

<div class="card">
    <div class="card-header bg-dark text-white text-center fs-4">
        Inventario Materia Prima
    </div>

    <div class="table-responsive">
        <table class="table table-light" id="tblInventario">
            <thead class="thead-dark">
                <tr>
                    <th>ID Inventario</th>
                    <th>Proveedor</th>
                    <th>ID Producto</th>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Fecha Entrada</th>
                    <th>Almacén</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los datos se cargarán dinámicamente aquí usando DataTables -->
            </tbody>
        </table>
    </div>


    <?php include "Views/Templates/footer.php"; ?>