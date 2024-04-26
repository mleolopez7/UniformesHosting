<?php
include "Views/Templates/header.php"; ?>

<div class="card">
    <div class="card-header bg-dark text-white text-center fs-4">
        Inventario Producto Terminado
    </div>
    <div class="table-responsive">
        <table class="table table-light" id="tbl_inventario">
            <thead class="thead-dark">
                <tr>
                    <th>Id Inventario</th>
                    <th>Nombre Proveedor</th>
                    <th>Nombre Producto</th>
                    <th>Descripcion</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                    <th>Fecha Adquision</th>
                    <th>Ubicación Almacen</th>
                    <th>Categoria</th>
                    <th>Estado de Producto</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            </tbody>
            <tbody>
                <?php foreach ($data['productosPT'] as $producto) : ?>
                    <tr>
                        <td><?php echo $producto['inventario_id']; ?></td>
                        <td><?php echo $producto['proveedores_id']; ?></td>
                        <td><?php echo $producto['nombre_producto']; ?></td>
                        <td><?php echo $producto['descripcion']; ?></td>
                        <td><?php echo $producto['precio_compra']; ?></td>
                        <td><?php echo $producto['precio_venta']; ?></td>
                        <td><?php echo $producto['fecha_adquisicion']; ?></td>
                        <td><?php echo $producto['ubicacion_almacen']; ?></td>
                        <td><?php echo $producto['categoria']; ?></td>
                        <td><?php echo $producto['estado_producto']; ?></td>
                        <td><?php echo $producto['observaciones']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
<?php include "Views/Templates/footer.php"; ?>