<?php
class EntregasModel extends Query {
    private $id, $id_venta, $tipo_producto, $descripcion, $cantidad, $precio, $talla, $color, $color_letra, 
    $logo_izquierdo, $logo_derecho, $logo_delantero, $logo_trasero, $estado, $img;
    public function __construct() 
    {
        parent::__construct();
    }

    public function getListas() 
    {
        $sql = "SELECT * FROM ventas WHERE estado = 0";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getCajas() 
    {
        $sql = "SELECT * FROM caja WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getRoles() 
    {
        $sql = "SELECT * FROM roles WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }


    public function VentaEntregado(int $estado, int $id) 
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
