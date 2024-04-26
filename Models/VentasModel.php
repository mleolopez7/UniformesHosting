<?php
class VentasModel extends Query
{
    private $NoFactura;
    public function __construct()
    {
        parent::__construct();
    }


   

    public function getClientes()
    {
        $sql = "SELECT * FROM clientes WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }



    public function getTallas()
    {
        $sql = "SELECT * FROM tallas WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getProductoBase()
    {
        $sql = "SELECT * FROM productos_base WHERE estadopb = 1";
        $data = $this->selectAll($sql);
        return $data;
    }





    public function registrarDetallev(int $usuario_id, string $tipo_productob, string $descripcionpb, int $cantidad, int $precio, string $talla, string $color, string $color_letra, string $logo_izquierdo, string $logo_derecho, string $logo_delantero, string $logo_trasero, string $sub_total)
{
    $sql = "INSERT INTO detallev (usuario_id, tipo_productob, descripcionpb, cantidad, precio, talla, color, color_letra, logo_izquierdo, logo_derecho, logo_delantero, logo_trasero, sub_total) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
    $datos = array($usuario_id, $tipo_productob, $descripcionpb, $cantidad, $precio, $talla, $color, $color_letra, $logo_izquierdo, $logo_derecho, $logo_delantero, $logo_trasero, $sub_total);
    
    try {
        $filasAfectadas = $this->save($sql, $datos);

        if ($filasAfectadas == 1) {
            return array('status' => 'ok');
        } else {
            error_log('Error al registrar detalle de venta. Filas afectadas: ' . $filasAfectadas);
            throw new Exception('Error al registrar detalle de venta');
        }
    } catch (Exception $e) {
        error_log('Excepción al registrar detalle de venta: ' . $e->getMessage());
        throw $e;
    }
}



    public function getDetalleVenta(int $id): array
{
    $sql = "SELECT * FROM detallev WHERE usuario_id = $id";
    $data = $this->selectAll($sql);
    return $data;
}

public function calcularVenta(int $usuario_id): array
{
    $sql = "SELECT sub_total, SUM(sub_total) AS total FROM detallev WHERE usuario_id = $usuario_id";
    $data = $this->select($sql);
    return $data;
}

public function deleteDetalleVenta(int $id_detallev)
{
    $sql = "DELETE FROM detallev WHERE id_detallev = ?";
    $datos = array($id_detallev);
    $data = $this->save($sql, $datos);

    if ($data == 1) {
        $res = "ok";
    } else {
        $res = "error";
    }

    return $res;
}



public function registrarVenta(string $factura, string $cliente, string $telefono, string $Identificacion, string $fecha_actual, string $fecha_entrega, string $cajero, string $comentario, int $descuento, float $total, float $abono, float $saldo)
{
    $sql = "INSERT INTO ventas (factura, cliente, telefono, identificacion, fecha_actual, fecha_entrega, cajero, comentario, descuento, total, abono, saldo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $datos = array($factura, $cliente, $telefono, $Identificacion, $fecha_actual, $fecha_entrega, $cajero, $comentario, $descuento, $total, $abono, $saldo);

    $filasAfectadas = $this->save($sql, $datos);

    if ($filasAfectadas == 1) {
        return 'ok';
    } else {
        throw new Exception('Error al registrar venta');
    }
}


public function registrarDetalleVenta(int $id_venta, string $factura, string $tipo_productob, string $descripcionpb, int $cantidad, float $precio, string $talla, string $color, string $color_letra, string $logo_izquierdo, string $logo_derecho, string $logo_delantero, string $logo_trasero, float $sub_total)
{
    $sql = "INSERT INTO detalle_venta (id_venta, factura, tipo_productob, descripcionpb, cantidad, precio, talla, color, color_letra, logo_izquierdo, logo_derecho, logo_delantero, logo_trasero, sub_total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $datos = array($id_venta,$factura, $tipo_productob, $descripcionpb, $cantidad, $precio, $talla, $color, $color_letra, $logo_izquierdo, $logo_derecho, $logo_delantero, $logo_trasero, $sub_total);

    $filasAfectadas = $this->save($sql, $datos);

    if ($filasAfectadas == 1) {
        return 'ok';
    } else {
        throw new Exception('Error al registrar detalle de venta');
    }
}


public function vaciarDetallev(int $usuario_id)
{
    $sql = "DELETE FROM detallev WHERE usuario_id = ?";
    $datos = array($usuario_id);

    $filasAfectadas = $this->save($sql, $datos);

    if ($filasAfectadas >= 0) {
        return 'ok';
    } else {
        throw new Exception('Error al vaciar detalles de venta');
    }
}


public function id_venta() 
{
    $sql = "SELECT MAX(id) AS id FROM ventas";
    $data = $this->select($sql);
    return $data;
}



public function getEmpresa()
{
    $sql = "SELECT * FROM empresa";
    $data = $this->select($sql);
    return $data;

}


public function getDetaVenta(int $id_venta)
{
    $sql = "SELECT dv.tipo_productob, dv.descripcionpb, dv.cantidad, dv.precio, dv.talla, dv.color, dv.sub_total, dv.color_letra, dv.logo_izquierdo, dv.logo_derecho, dv.logo_delantero, dv.logo_trasero
            FROM detalle_venta dv
            WHERE dv.id_venta = $id_venta";
            
    $data = $this->selectAll($sql);
    return $data;
}

public function getVentas($id_venta)
{
    $sql = "SELECT * FROM ventas WHERE id = :id_venta";
    $params = array(':id_venta' => $id_venta);
    $data = $this->select($sql, $params);
    return $data;
}


public function getVentasRealizadas()
{
    $sql = "SELECT * FROM ventas";
    $data = $this->selectAll($sql);
    return $data;
}

public function getVentasRealizadasDESC()
{
    $sql = "SELECT * FROM detalle_venta ORDER BY id DESC LIMIT 6";
    $data = $this->selectAll($sql);
    return $data;
}


public function getRangoFechas(string $desde, string $hasta) 
{
    $sql = "SELECT * FROM ventas WHERE fecha_actual BETWEEN '$desde' AND '$hasta'";
    $data = $this->selectAll($sql);
    return $data;
}



    public function verificarPermiso(int $id_user, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p 
        INNER JOIN  detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'"; //cuando es un string hay que poner las comillas simples
        $data = $this->selectAll($sql);
        return $data;
    }



}?>
