<?php
class TallasModel extends Query {
    private $TallasID, $TipoTalla, $estado;

    public function __construct() 
    {
        parent::__construct();
    }

    public function getTallas() 
    {
        $sql = "SELECT * FROM tallas"; 
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarTallas(string $TipoTalla)  
{
    $this->TipoTalla = $TipoTalla;

    $verificar = "SELECT * FROM tallas WHERE TipoTalla = '$this->TipoTalla'";
    $existe = $this->select($verificar);

    if (empty($existe)) {
        $sql = "INSERT INTO tallas(TipoTalla) VALUES (?)";
        $datos = array($this->TipoTalla);
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

public function EditarTallas(int $TallasID) {
    $sql = "SELECT * FROM tallas WHERE TallasID = $TallasID";
    $data = $this->select($sql);
    return $data;
}

public function ModificarTallas(string $TipoTalla, int $TallasID)  
{
    $this->TipoTalla = $TipoTalla;
    $this->TallasID = $TallasID; 

    $sql = "UPDATE tallas SET TipoTalla = ? WHERE TallasID = ?";
    $datos = array($this->TipoTalla, $this->TallasID);
    $data = $this->save($sql, $datos);

    if ($data == 1) {
        $res = "modificado";
    } else {
        $res = "error";
    } 

    return $res;
}

public function accionTallas(int $estado, int $TallasID) 
{
    $this->TallasID = $TallasID;
    $this->estado = $estado;
    $sql = "UPDATE tallas SET Estado = ? WHERE TallasID = ?";
    $datos = array($this->estado, $this->TallasID);
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
            INNER JOIN  detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'"; //cuando es un string hay que poner las comillas simples
            $data = $this->selectAll($sql);
            return $data;
    }

}
?>
