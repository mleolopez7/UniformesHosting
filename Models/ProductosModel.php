<?php
class ProductosModel extends Query {
    private $codigo, $nombre, $descripcion, $tipopb, $id, $estado;
    public function __construct() 
    {
        parent::__construct();
    }

    public function getProductos() 
    {
        $sql = "SELECT * FROM productos_base p";
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
    
    public function registrarProducto(string $codigo, string $nombre,string $descripcion, string $tipopb)  
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->tipopb = $tipopb;
        $verificar = "SELECT * FROM productos_base WHERE codigo_productob = '$this->codigo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO productos_base(codigo_productob, nombrepb, descripcionpb, tipo_productob) VALUES (?,?,?,?)";
            $datos = array($this->codigo, $this->nombre,$this->descripcion, $this->tipopb);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            }else{
                $res = "error";
            } 
        }else{
            $res = "existe";
        }

        return $res;
    }   
    public function editarProb(int $id_productob){
        $sql = "SELECT * FROM productos_base WHERE id_productob = $id_productob";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarProducto(string $codigo, string $nombre,string $descripcion, string $tipopb, int $id)  
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->tipopb = $tipopb;
        $this->id = $id;
            $sql = "UPDATE productos_base SET codigo_productob = ?, nombrepb = ?, descripcionpb = ?, tipo_productob = ? WHERE id_productob = ?";
            $datos = array($this->codigo, $this->nombre,$this->descripcion, $this->tipopb, $this->id);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "modificado";
            }else{
                $res = "error";
            } 

        return $res;
    }  

    public function accionProd(int $estado, int $id) 
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE productos_base SET estadopb = ? WHERE id_productob = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function getPermisos() 
    {
        $sql = "SELECT * FROM permisos";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarPermiso(int $id_user, int $id_permiso) 
    {
        $sql = "INSERT INTO detalle_permisos(id_Producto, id_permiso) VALUES (?,?)";
        $datos = array($id_user, $id_permiso);
        $data = $this->save($sql, $datos);
        if($data == 1){
            $res =  "ok";
        }else{
            $res =  "error";
        }
        return $res;
    }

    public function eliminarPermisos(int $id_user) 
    {
        $sql = "DELETE FROM detalle_permisos WHERE id_Producto = ?";
        $datos = array($id_user);
        $data = $this->save($sql, $datos);
        if($data == 1){
            $res =  "ok";
        }else{
            $res =  "error";
        }
        return $res;
    }

    public function getDetallePermisos(int $id_user) 
    {
        $sql = "SELECT * FROM detalle_permisos WHERE id_Producto = $id_user";
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