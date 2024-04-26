<?php
class UsuariosModel extends Query {
    private $usuario, $nombre, $clave, $correo,$id, $id_caja, $estado, $id_rol;
    public function __construct() 
    {
        parent::__construct();
    }

    public function getUsuario(string $usuario, string $clave) 
    {
        $sql = "SELECT *FROM _usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
        $data = $this->select($sql);
        return $data;
    }

    public function getCajas() 
    {
        $sql = "SELECT * FROM caja WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function cambiarEstadoUsuario($usuario, $estado)
    {
        // Asegúrate de tener una conexión a la base de datos establecida antes de realizar la consulta.

        $sql = "UPDATE _usuarios SET estado = ? WHERE usuario = ?";
        $datos = array($estado, $usuario);

        // Suponiendo que tienes un método 'save' en tu modelo para ejecutar la consulta
        $data = $this->save($sql, $datos);

        return $data;
    }
    

    public function getUsuarios() 
    {
        $sql = "SELECT u.*, c.id as id_caja, c.caja, r.id as id_rol, r.rol
        FROM _usuarios u  
        INNER JOIN caja c ON u.id_caja = c.id
        INNER JOIN roles r ON u.id_rol = r.id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getRoles() 
    {
        $sql = "SELECT * FROM roles WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    
    public function registrarUsuario(string $usuario, string $nombre, string $correo, string $clave, int $id_caja, int $id_rol)  
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->correo = $correo;
        $this->id_caja = $id_caja;
        $this->id_rol = $id_rol;
    
        // Verificar existencia de usuario
        $verificarUsuario = "SELECT * FROM _usuarios WHERE usuario = '$this->usuario'";
        $existeUsuario = $this->select($verificarUsuario);
    
        // Verificar existencia de correo electrónico
        $verificarCorreo = "SELECT * FROM _usuarios WHERE correo = '$this->correo'";
        $existeCorreo = $this->select($verificarCorreo);
    
        if (empty($existeUsuario) && empty($existeCorreo)) {
            $sql = "INSERT INTO _usuarios(usuario, nombre, correo, clave, id_caja, id_rol) VALUES (?,?,?,?,?,?)";
            $datos = array($this->usuario, $this->nombre, $this->correo, $this->clave, $this->id_caja, $this->id_rol);
            $data = $this->save($sql, $datos);
    
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            } 
        } else {
            if (!empty($existeUsuario)) {
                $res = "usuario_existe";
            } elseif (!empty($existeCorreo)) {
                $res = "correo_existe";
            }
        }
        return $res;
    }
    
    public function editarUser(int $id){
        $sql = "SELECT * FROM _usuarios WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarUsuario(int $id_caja, int $id_rol, int $id)  
    {
        $this->id_caja = $id_caja;
        $this->id_rol = $id_rol;
        $this->id = $id;
            $sql = "UPDATE _usuarios SET id_caja = ?, id_rol = ? WHERE id = ?";
            $datos = array($this->id_caja, $this->id_rol, $this->id);
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

    public function getPermisos() 
    {
        $sql = "SELECT * FROM permisos";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarPermiso(int $id_user, int $id_permiso) 
    {
        $sql = "INSERT INTO detalle_permisos(id_usuario, id_permiso) VALUES (?,?)";
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
        $sql = "DELETE FROM detalle_permisos WHERE id_usuario = ?";
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
        $sql = "SELECT * FROM detalle_permisos WHERE id_usuario = $id_user";
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

    public function modificarPass(string $clave, int $id) 
    {
        $sql = "UPDATE _usuarios SET clave = ? WHERE id = ?";
        $datos = array($clave, $id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function getPass(string $clave, int $id){
        $sql = "SELECT * FROM _usuarios WHERE clave = '$clave' AND id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function verificarCorreo($correo)
    {
        $sql = "SELECT id FROM _usuarios WHERE correo = '$correo'";
        return $this->select($sql);
    }


    public function registrarToken($token, $correo){
        $sql = "UPDATE _usuarios SET token = ? WHERE correo = ?";
        $array = array($token, $correo);
        return $this->save($sql, $array);
    }

    public function registrarTokenValidar($token){
        $sql = "UPDATE _usuarios SET hash_ = ?";
        $array = array($token);
        return $this->save($sql, $array);
    }

    public function verificarToken($token)
    {
        $sql = "SELECT id, token FROM _usuarios WHERE token = '$token'";
        return $this->select($sql);
    }

    public function modificarClave($clave, $token)
    {
        $sql = "UPDATE _usuarios 
        SET clave = ?, 
            token = ?, 
            estado = 1 
            WHERE token = ?";
        $array = array($clave, null, $token);
        return $this->save($sql, $array);
    }

}



?>