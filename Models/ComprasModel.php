<?php
class ComprasModel extends Query {
    public function __construct() 
    {
        parent::__construct();
    }


    public function getProveedores() 
{
    $sql = "SELECT * FROM proveedores WHERE estado = 1";
    $data = $this->selectAll($sql);
    return $data;
}



public function getMateriaPrima()
{
    $sql = "SELECT * FROM materia_prima WHERE estado = 1";
    $data = $this->selectAll($sql);
    return $data;
}

   public function getProveedor(int $proveedores_id)
    {
        $sql = "SELECT * FROM proveedores WHERE proveedores_id = $proveedores_id";
        $data = $this->select($sql);
        return $data;
    }

    public function getdetalleCompra()
    {
        $sql = "SELECT * FROM detalle_compra ORDER BY id DESC LIMIT 6";
        $data = $this->selectAll($sql);
        return $data;
    }



    public function registrarDetalle(int $usuario_id, string $proveedor, int $id_producto, string $producto, string $descripcion, int $cantidad, int $precio, int $sub_total)
    {
        $sql = "INSERT INTO detalle(usuario_id, proveedor, id_producto, producto, descripcion, cantidad, precio, sub_total) VALUES (?,?,?,?,?,?,?,?)";
        $datos = array($usuario_id, $proveedor, $id_producto, $producto, $descripcion, $cantidad, $precio, $sub_total);
        $filasAfectadas = $this->save($sql, $datos);
    
        if($filasAfectadas == 1){
            return array('status' => 'ok');
        } else {
            throw new Exception('Error al registrar detalle de compra');
        }
    }
    


public function getDetalle(int $id): array
{
    $sql = "SELECT d.*, p.proveedores_id, p.nombre_proveedor 
            FROM detalle d 
            INNER JOIN proveedores p ON d.proveedor = p.nombre_proveedor 
            WHERE d.usuario_id = $id";
    $data = $this->selectAll($sql);
    return $data;
}


public function calcularCompra(int $usuario_id): array
{
    $sql = "SELECT sub_total, SUM(sub_total) AS total FROM detalle WHERE usuario_id = $usuario_id";
    $data = $this->select($sql);
    return $data;
}




public function deleteDetalle(int $detalle_id)
{
    $sql = "DELETE FROM detalle WHERE detalle_id = ?";
    $datos = array($detalle_id);
    $data = $this->save($sql, $datos);
    if($data == 1){
        $res = "ok";
    } else {
        $res = "error";
    }
    return $res;
}

public function registrarCompra(string $factura, string $total, string $fecha)
{
    $sql = "INSERT INTO compras (factura, total, fecha) VALUES (?, ?, ?)";
    $datos = array($factura, $total, $fecha);

    $filasAfectadas = $this->save($sql, $datos);

    if ($filasAfectadas == 1) {
        return 'ok';
    } else {
        throw new Exception('Error al registrar compra');
    }
}



public function registrarKardex(string $proveedor, int $id_producto, string $producto, string $descripcion, string $fecha, string $factura, int $cantidad, int $precio)
{
    $tipo_kardex = 'entrada'; 
    $costo_total = $cantidad * $precio;

    $sql = "INSERT INTO kardex (proveedor, id_producto, producto, descripcion, tipo_kardex, fecha_entrada, factura, cantidad_entrada, precio_unitario, costo_total)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $datos = array($proveedor, $id_producto, $producto, $descripcion, $tipo_kardex, $fecha, $factura, $cantidad, $precio, $costo_total);
    
    $filasAfectadas = $this->save($sql, $datos);

    if ($filasAfectadas == 1) {
        return 'ok';
    } else {
        throw new Exception('Error al registrar en el kardex');
    }
}





public function id_compra() 
{
    $sql = "SELECT MAX(id) AS id FROM compras";
    $data = $this->select($sql);
    return $data;
    
}


public function registrarDetalleCompra(int $id_compra, string $proveedor, int $id_producto, string $producto, string $descripcion, int $cantidad, string $precio, string $sub_total)
    {
        $sql = "INSERT INTO detalle_compra (id_compra, proveedor, id_producto, producto, descripcion, cantidad, precio, sub_total) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $datos = array($id_compra, $proveedor, $id_producto, $producto, $descripcion, $cantidad, $precio, $sub_total);

        $data = $this->save($sql, $datos);

        if($data == 1){
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }


public function getEmpresa()
{
    $sql = "SELECT * FROM empresa";
    $data = $this->select($sql);
    return $data;

}


public function vaciarDetalle(int $usuario_id)
{
    $sql = "DELETE FROM detalle WHERE usuario_id = ?";
    $datos = array($usuario_id);

    $data = $this->save($sql, $datos);

    if($data == 1){
        $res = "ok";
    } else {
        $res = "error";
    }
    return $res;
}


public function getDetaCompra(int $id_compra)
{
    $sql = "SELECT dc.producto, dc.descripcion, dc.proveedor, dc.cantidad, dc.precio, dc.sub_total 
            FROM detalle_compra dc
            WHERE dc.id_compra = $id_compra";
            
    $data = $this->selectAll($sql);
    return $data;
}

public function getCompras($id_compra)
{
    $sql = "SELECT * FROM compras WHERE id = :id_compra";
    $params = array(':id_compra' => $id_compra);
    $data = $this->select($sql, $params);
    return $data;
}

public function getComprasRealizadas()
{
    $sql = "SELECT * FROM compras";
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

public function getRangoFechas(string $desde, string $hasta) 
{
    $sql = "SELECT * FROM compras WHERE fecha BETWEEN '$desde' AND '$hasta'";
    $data = $this->selectAll($sql);
    return $data;
}

}   