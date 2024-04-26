<?php
class InventarioModel extends Query {
    private $id_inventario, $proveedor, $id_producto, $producto, $descripcion, $cantidad, $fecha_entrada, $almacen;
    
    public function __construct() 
    {
        parent::__construct();
    }

    public function getInventario() 
    {
        $sql = "SELECT * FROM inventario"; // Cambia 'tallas' por 'inventario'
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
