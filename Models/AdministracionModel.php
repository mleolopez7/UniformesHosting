<?php
class AdministracionModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getEmpresa()
    {
        $sql = "SELECT * FROM empresa";
        $data = $this->select($sql);
        return $data;
    }

    public function getDatos(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table";
        $data = $this->select($sql);
        return $data;
    }

    public function modificar(string $nombre, string $telefono, string $direccion, string $mensaje, int $id)
    {
        $sql = "UPDATE empresa SET nombre=?, telefono=?, direccion=?, mensaje=? WHERE id=?";
        $datos = array($nombre, $telefono, $direccion, $mensaje, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function verificarPermiso(int $id_user, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p 
            INNER JOIN  detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'"; //cuando es un string hay que poner las comillas simples
        $data = $this->selectAll($sql);
        return $data;
    }

    function getStockMinimo()
    {
        $sql = "SELECT * from inventario WHERE cantidad < 15 ORDER BY cantidad DESC LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }

    function getproductosComprados()
    {
        $sql = "SELECT d.id_inventario, d.cantidad, p.id, p.descripcion, SUM(d.cantidad) AS total FROM inventario d INNER JOIN detalle_compra p ON p.id = d.id_inventario GROUP BY d.id_inventario ORDER BY d.cantidad DESC LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }

    function getmaxEntrada()
    {
        $sql = "SELECT * from kardex WHERE cantidad_entrada > 10 ORDER BY cantidad_entrada DESC LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }

    function getMaxSalida()
    {       
        $sql = "SELECT producto, SUM(cantidad_salida) AS total_salida
                FROM kardex
                WHERE tipo_kardex = 'salida'
                GROUP BY producto
                ORDER BY total_salida DESC
                LIMIT 5";
                       
        $data = $this->selectAll($sql);
        return $data;
    }
    

    function calcularVentas($desde, $hasta)
    {

        $sql = "SELECT SUM(IF(MONTH(fecha_actual) = 1, total, 0)) AS ene, 
                       SUM(IF(MONTH(fecha_actual) = 2, total, 0)) AS feb, 
                       SUM(IF(MONTH(fecha_actual) = 3, total, 0)) AS mar, 
                       SUM(IF(MONTH(fecha_actual) = 4, total, 0)) AS abr, 
                       SUM(IF(MONTH(fecha_actual) = 5, total, 0)) AS may, 
                       SUM(IF(MONTH(fecha_actual) = 6, total, 0)) AS jun, 
                       SUM(IF(MONTH(fecha_actual) = 7, total, 0)) AS jul, 
                       SUM(IF(MONTH(fecha_actual) = 8, total, 0)) AS ago, 
                       SUM(IF(MONTH(fecha_actual) = 9, total, 0)) AS sep, 
                       SUM(IF(MONTH(fecha_actual) = 10, total, 0)) AS oct,
                       SUM(IF(MONTH(fecha_actual) = 11, total, 0)) AS nov, 
                       SUM(IF(MONTH(fecha_actual) = 12, total, 0)) AS dic 
                       FROM ventas WHERE fecha_actual BETWEEN '$desde' AND '$hasta'";
        $data = $this->select($sql);
        return $data;
    }

    function calcularCompras($desde, $hasta)
    {

        $sql = "SELECT SUM(IF(MONTH(fecha) = 1, total, 0)) AS ene, 
                       SUM(IF(MONTH(fecha) = 2, total, 0)) AS feb, 
                       SUM(IF(MONTH(fecha) = 3, total, 0)) AS mar, 
                       SUM(IF(MONTH(fecha) = 4, total, 0)) AS abr, 
                       SUM(IF(MONTH(fecha) = 5, total, 0)) AS may, 
                       SUM(IF(MONTH(fecha) = 6, total, 0)) AS jun, 
                       SUM(IF(MONTH(fecha) = 7, total, 0)) AS jul, 
                       SUM(IF(MONTH(fecha) = 8, total, 0)) AS ago, 
                       SUM(IF(MONTH(fecha) = 9, total, 0)) AS sep, 
                       SUM(IF(MONTH(fecha) = 10, total, 0)) AS oct,
                       SUM(IF(MONTH(fecha) = 11, total, 0)) AS nov, 
                       SUM(IF(MONTH(fecha) = 12, total, 0)) AS dic 
                       FROM compras WHERE fecha BETWEEN '$desde' AND '$hasta'";
        $data = $this->select($sql);
        return $data;
    }



    function totalVentasCompras($desde, $hasta)
    {
        $sql = "SELECT COUNT(*) AS total FROM ventas WHERE fecha_actual BETWEEN '$desde' AND '$hasta'";
        $data = $this->select($sql);
        return $data;
    }

    function totalComprasVentas($desde, $hasta)
    {
        $sql = "SELECT COUNT(*) AS total FROM compras WHERE fecha BETWEEN '$desde' AND '$hasta'";
        $data = $this->select($sql);
        return $data;
    }

    function nuevosProductos()
    {
        $sql = "SELECT * FROM detalle_compra ORDER BY id DESC LIMIT 6";
        $data = $this->selectAll($sql);
        return $data;
    }

    function calcularSaldos($desde, $hasta)
    {

        $sql = "SELECT SUM(IF(MONTH(fecha_actual) = 1, saldo, 0)) AS ene, 
                    SUM(IF(MONTH(fecha_actual) = 2, saldo, 0)) AS feb, 
                    SUM(IF(MONTH(fecha_actual) = 3, saldo, 0)) AS mar, 
                    SUM(IF(MONTH(fecha_actual) = 4, saldo, 0)) AS abr, 
                    SUM(IF(MONTH(fecha_actual) = 5, saldo, 0)) AS may, 
                    SUM(IF(MONTH(fecha_actual) = 6, saldo, 0)) AS jun, 
                    SUM(IF(MONTH(fecha_actual) = 7, saldo, 0)) AS jul, 
                    SUM(IF(MONTH(fecha_actual) = 8, saldo, 0)) AS ago, 
                    SUM(IF(MONTH(fecha_actual) = 9, saldo, 0)) AS sep, 
                    SUM(IF(MONTH(fecha_actual) = 10, saldo, 0)) AS oct,
                    SUM(IF(MONTH(fecha_actual) = 11, saldo, 0)) AS nov, 
                    SUM(IF(MONTH(fecha_actual) = 12, saldo, 0)) AS dic 
                FROM ventas WHERE fecha_actual BETWEEN '$desde' AND '$hasta'";
        $data = $this->select($sql);
        return $data;
    }


    function calcularAbonoClientes($desde, $hasta)
    {

        $sql = "SELECT SUM(IF(MONTH(fecha_actual) = 1, abono, 0)) AS ene, 
        SUM(IF(MONTH(fecha_actual) = 2, abono, 0)) AS feb, 
        SUM(IF(MONTH(fecha_actual) = 3, abono, 0)) AS mar, 
        SUM(IF(MONTH(fecha_actual) = 4, abono, 0)) AS abr, 
        SUM(IF(MONTH(fecha_actual) = 5, abono, 0)) AS may, 
        SUM(IF(MONTH(fecha_actual) = 6, abono, 0)) AS jun, 
        SUM(IF(MONTH(fecha_actual) = 7, abono, 0)) AS jul, 
        SUM(IF(MONTH(fecha_actual) = 8, abono, 0)) AS ago, 
        SUM(IF(MONTH(fecha_actual) = 9, abono, 0)) AS sep, 
        SUM(IF(MONTH(fecha_actual) = 10, abono, 0)) AS oct,
        SUM(IF(MONTH(fecha_actual) = 11, abono, 0)) AS nov, 
        SUM(IF(MONTH(fecha_actual) = 12, abono, 0)) AS dic 
        FROM ventas WHERE fecha_actual BETWEEN '$desde' AND '$hasta'";
        $data = $this->select($sql);
        return $data;
    }

    function calcularKardexSalida($desde, $hasta)
    {

        $sql = "SELECT SUM(IF(MONTH(fecha_salida) = 1, cantidad_salida, 0)) AS ene, 
        SUM(IF(MONTH(fecha_salida) = 2, cantidad_salida, 0)) AS feb, 
        SUM(IF(MONTH(fecha_salida) = 3, cantidad_salida, 0)) AS mar, 
        SUM(IF(MONTH(fecha_salida) = 4, cantidad_salida, 0)) AS abr, 
        SUM(IF(MONTH(fecha_salida) = 5, cantidad_salida, 0)) AS may, 
        SUM(IF(MONTH(fecha_salida) = 6, cantidad_salida, 0)) AS jun, 
        SUM(IF(MONTH(fecha_salida) = 7, cantidad_salida, 0)) AS jul, 
        SUM(IF(MONTH(fecha_salida) = 8, cantidad_salida, 0)) AS ago, 
        SUM(IF(MONTH(fecha_salida) = 9, cantidad_salida, 0)) AS sep, 
        SUM(IF(MONTH(fecha_salida) = 10, cantidad_salida, 0)) AS oct,
        SUM(IF(MONTH(fecha_salida) = 11, cantidad_salida, 0)) AS nov, 
        SUM(IF(MONTH(fecha_salida) = 12, cantidad_salida, 0)) AS dic 
        FROM kardex WHERE fecha_salida BETWEEN '$desde' AND '$hasta'";
        $data = $this->select($sql);
        return $data;
    }


    function calcularProductoVendido($desde, $hasta)
    {
        $sql = "SELECT 
        SUM(IF(MONTH(v.fecha_actual) = 1, dv.cantidad , 0)) AS ene, 
        SUM(IF(MONTH(v.fecha_actual) = 2, dv.cantidad , 0)) AS feb, 
        SUM(IF(MONTH(v.fecha_actual) = 3, dv.cantidad , 0)) AS mar, 
        SUM(IF(MONTH(v.fecha_actual) = 4, dv.cantidad , 0)) AS abr, 
        SUM(IF(MONTH(v.fecha_actual) = 5, dv.cantidad , 0)) AS may, 
        SUM(IF(MONTH(v.fecha_actual) = 6, dv.cantidad , 0)) AS jun, 
        SUM(IF(MONTH(v.fecha_actual) = 7, dv.cantidad , 0)) AS jul, 
        SUM(IF(MONTH(v.fecha_actual) = 8, dv.cantidad , 0)) AS ago, 
        SUM(IF(MONTH(v.fecha_actual) = 9, dv.cantidad , 0)) AS sep, 
        SUM(IF(MONTH(v.fecha_actual) = 10, dv.cantidad , 0)) AS oct,
        SUM(IF(MONTH(v.fecha_actual) = 11, dv.cantidad , 0)) AS nov, 
        SUM(IF(MONTH(v.fecha_actual) = 12, dv.cantidad , 0)) AS dic 
    FROM 
        ventas v
    INNER JOIN 
        detalle_venta dv ON v.id = dv.id_venta
    WHERE 
        v.fecha_actual BETWEEN '$desde' AND '$hasta'";
        $data = $this->select($sql);
        return $data;
    }

    function calcularKardexEntrada($desde, $hasta)
    {

        $sql = "SELECT SUM(IF(MONTH(fecha_entrada) = 1, cantidad_entrada, 0)) AS ene, 
        SUM(IF(MONTH(fecha_entrada) = 2, cantidad_entrada, 0)) AS feb, 
        SUM(IF(MONTH(fecha_entrada) = 3, cantidad_entrada, 0)) AS mar, 
        SUM(IF(MONTH(fecha_entrada) = 4, cantidad_entrada, 0)) AS abr, 
        SUM(IF(MONTH(fecha_entrada) = 5, cantidad_entrada, 0)) AS may, 
        SUM(IF(MONTH(fecha_entrada) = 6, cantidad_entrada, 0)) AS jun, 
        SUM(IF(MONTH(fecha_entrada) = 7, cantidad_entrada, 0)) AS jul, 
        SUM(IF(MONTH(fecha_entrada) = 8, cantidad_entrada, 0)) AS ago, 
        SUM(IF(MONTH(fecha_entrada) = 9, cantidad_entrada, 0)) AS sep, 
        SUM(IF(MONTH(fecha_entrada) = 10, cantidad_entrada, 0)) AS oct,
        SUM(IF(MONTH(fecha_entrada) = 11, cantidad_entrada, 0)) AS nov, 
        SUM(IF(MONTH(fecha_entrada) = 12, cantidad_entrada, 0)) AS dic 
        FROM kardex WHERE fecha_entrada BETWEEN '$desde' AND '$hasta'";
        $data = $this->select($sql);
        return $data;
    }
}
