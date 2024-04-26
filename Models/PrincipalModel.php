<?php 
class PrincipalModel extends Query{
    public function __construct(){
        parent::__construct();
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