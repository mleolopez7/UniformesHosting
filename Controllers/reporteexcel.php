<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> <!--Importante--->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargar</title>
</head>
<body>
    
<?php
include('config.php');
date_default_timezone_set("America/Bogota");
$fecha = date("d/m/Y");

header("Content-Type: text/html;charset=utf-8");
header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");
$filename = "ReporteExcel_" .$fecha. ".xls";
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename=" . $filename . "");


$listinventario = ("SELECT * FROM tbl_inventario WHERE categoria = 'Materia Prima'");
$Datainventario = mysqli_query($con, $listinventario);

?>


<table style="text-align: center;" border='1' cellpadding=1 cellspacing=1>
<thead>
    <tr style="background: #D0CDCD;">
    <th>#</th>
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
<?php
$i =1;
    while ($inventario = mysqli_fetch_array($Datainventario)) { ?>
    <tbody>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $inventario['inventario_id']; ?></td>
            <td><?php echo $inventario['proveedores_id']; ?></td>
            <td><?php echo $inventario['nombre_producto']; ?></td>
            <td><?php echo $inventario['descripcion']; ?></td>
            <td><?php echo $inventario['precio_compra']; ?></td>
            <td><?php echo $inventario['precio_venta']; ?></td>
            <td><?php echo $inventario['fecha_adquisicion']; ?></td>
            <td><?php echo $inventario['ubicacion_almacen']; ?></td>
            <td><?php echo $inventario['categoria']; ?></td>
            <td><?php echo $inventario['estado_producto']; ?></td>
            <td><?php echo $inventario['observaciones']; ?></td>
        </tr>
    </tbody>
    
<?php } ?>
</table>

</body>
</html>