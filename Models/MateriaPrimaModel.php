<?php
class MateriaPrimaModel extends Query {
    private $id_producto, $producto, $descripcion, $estado;
    
    public function __construct() 
    {
        parent::__construct();
    }

    public function getMateriaPrima() 
    {
        $sql = "SELECT * FROM materia_prima";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarMateriaPrima(string $producto, string $descripcion)  
    {
        $this->producto = $producto;
        $this->descripcion = $descripcion;

        $verificar = "SELECT * FROM materia_prima WHERE producto = '$this->producto'";
        $existe = $this->select($verificar);

        if (empty($existe)) {
            $sql = "INSERT INTO materia_prima(producto, descripcion) VALUES (?, ?)";
            $datos = array($this->producto, $this->descripcion);
            $data = $this->save($sql, $datos);

            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            } 
        } else {
            $res = "existe";
        }

        return $res;
    }

    public function editarMateriaPrima(int $id_producto) 
    {
        $sql = "SELECT * FROM materia_prima WHERE id_producto = $id_producto";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarMateriaPrima(string $producto, string $descripcion, int $id_producto)  
    {
        $this->producto = $producto;
        $this->descripcion = $descripcion;
        $this->id_producto = $id_producto;

        $sql = "UPDATE materia_prima SET producto = ?, descripcion = ? WHERE id_producto = ?";
        $datos = array($this->producto, $this->descripcion, $this->id_producto);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        } 

        return $res;
    }

    public function accionMateriaPrima(int $estado, int $id_producto) 
    {
        $this->id_producto = $id_producto;
        $this->estado = $estado;
        $sql = "UPDATE materia_prima SET estado = ? WHERE id_producto = ?";
        $datos = array($this->estado, $this->id_producto);
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
            INNER JOIN  detalle_permisos d ON p.id = d.id_permiso 
            WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'";
    
    $data = $this->selectAll($sql);
    return $data;
}

}
?>
