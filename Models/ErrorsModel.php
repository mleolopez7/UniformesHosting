<?php
class ErrorsModel extends Query {
    private $inventario_id, $proveedores_id, $nombre_producto, $descripcion, $precio_compra, $precio_venta, $fecha_adquisicion, $ubicacion_almacen, $categoria, $estado_producto, $observaciones;
    
    public function __construct() 
    {
        parent::__construct();
    }

    public function getAllMP() 
    {
        $sql = "SELECT * FROM tbl_inventario WHERE categoria = 'Materia Prima'";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getAllPT() 
    {
        $sql = "SELECT * FROM tbl_inventario WHERE categoria = 'Producto Terminado'";
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
}

?>
