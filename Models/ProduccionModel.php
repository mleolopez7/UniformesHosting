<?php
class ProduccionModel extends Query {
    private $id, $id_venta, $tipo_producto, $descripcion, $cantidad, $precio, $talla, $color, $color_letra, $logo_izquierdo, $logo_derecho, $logo_delantero, $logo_trasero, $estado;

    public function __construct() 
    {
        parent::__construct();
    }

    public function getVenta() 
    {
        $sql = "SELECT * FROM ventas WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }


public function registrarDetalleSalida(int $usuario_id, int $id_producto, string $producto, int $cantidad, string $motivo_salida)
{
    $sql = "INSERT INTO detalle_salida (usuario_id,id_producto, producto, cantidad, motivo_salida, fecha) VALUES (?,?,?,?,?,NOW())";
    
    $datos = array($usuario_id, $id_producto, $producto, $cantidad, $motivo_salida);
    
    try {
        $filasAfectadas = $this->save($sql, $datos);

        if ($filasAfectadas == 1) {
            return array('status' => 'ok');
        } else {
            error_log('Error al registrar detalle de salida. Filas afectadas: ' . $filasAfectadas);
            throw new Exception('Error al registrar detalle de salida');
        }
    } catch (Exception $e) {
        error_log('Excepción al registrar detalle de salida: ' . $e->getMessage());
        throw $e;
    }
}


public function getDetalleSalida(int $id): array
{
    $sql = "SELECT * FROM detalle_salida WHERE usuario_id = $id";
    $data = $this->selectAll($sql);
    return $data;
}


public function deleteDetalleSalida(int $id)
{
    $sql = "DELETE FROM detalle_salida WHERE id = ?";
    $datos = array($id);
    $data = $this->save($sql, $datos);

    if ($data == 1) {
        $res = "ok";
    } else {
        $res = "error";
    }

    return $res;
}



public function registrarKardexSalida(int $id_producto, string $producto, int $cantidad, string $motivo_salida, string $fecha)
{
    $tipo_kardex = 'salida'; 
    $factura = '';
    $precio = 0;
    $costo_total = 0;

    $sql = "INSERT INTO kardex (id_producto, producto, tipo_kardex, fecha_salida, factura, cantidad_salida, motivo_salida, precio_unitario, costo_total)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $datos = array($id_producto, $producto, $tipo_kardex, $fecha, $factura, $cantidad, $motivo_salida, $precio, $costo_total);
    
    $filasAfectadas = $this->save($sql, $datos);

    if ($filasAfectadas == 1) {
        return 'ok';
    } else {
        throw new Exception('Error al registrar en el kardex de salida');
    }
}



public function vaciarDetalleSalida(int $usuario_id)
{
    $sql = "DELETE FROM detalle_salida WHERE usuario_id = ?";
    $datos = array($usuario_id);

    $data = $this->save($sql, $datos);

    if ($data == 1) {
        $res = "ok";
    } else {
        $res = "error";
    }
    return $res;
}

public function VentaInactivo(int $estado, int $id) 
{
    $this->estado = $estado;
    $this->id = $id;
    $sql = "UPDATE ventas SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
    $data = $this->save($sql, $datos);
     
    return $data;
}




    public function verificarPermiso(int $id_user, string $nombre) 
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p 
        INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }


}
?>
