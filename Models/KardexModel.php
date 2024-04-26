<?php
class KardexModel extends Query {
    private $id_kardex, $id_inventario, $proveedor, $id_producto, $producto, $descripcion, $tipo_kardex, $fecha_entrada, $cantidad_entrada, $fecha_salida, $factura, $cantidad_salida, $motivo_salida, $precio_unitario, $costo_total;
    public function __construct() 
    {
        parent::__construct();
    }

    public function getKardex() 
    {
        $sql = "SELECT * FROM kardex";
        $data = $this->selectAll($sql);
        return $data;
    }


    public function getCajas() 
    {
        $sql = "SELECT * FROM caja WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getUsuarios() 
    {
        $sql = "SELECT u.*, c.id as id_caja, c.caja FROM _usuarios u INNER JOIN caja c where u.id_caja = c.id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarUsuario(string $usuario, string $nombre,string $correo, string $clave, int $id_caja)  
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->correo = $correo;
        $this->id_caja = $id_caja;
        $verificar = "SELECT * FROM _usuarios WHERE usuario = '$this->usuario'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO _usuarios(usuario, nombre, correo, clave, id_caja) VALUES (?,?,?,?,?)";
            $datos = array($this->usuario, $this->nombre,$this->correo, $this->clave, $this->id_caja);
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
    public function editarUser(int $id){
        $sql = "SELECT * FROM _usuarios WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarUsuario(string $usuario, string $nombre, string $correo, int $id_caja, int $id)  
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->id_caja = $id_caja;
        $this->id = $id;
            $sql = "UPDATE _usuarios SET usuario = ?, nombre = ?, correo = ?, id_caja = ? WHERE id = ?";
            $datos = array($this->usuario, $this->nombre,$this->correo, $this->id_caja, $this->id);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "modificado";
            }else{
                $res = "error";
            } 

        return $res;
    }  

    public function accionUser(int $estado, int $id) 
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE _usuarios SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
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