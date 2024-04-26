<?php
class ClientesModel extends Query {
    private $ClienteID, $NombreCompleto, $identificacion, $telefono, $estado, $nombre_cliente;
    
    public function __construct() 
    {
        parent::__construct();
    }

    public function getClientes() 
{
    $sql = "SELECT * FROM clientes";
    $data = $this->selectAll($sql);
    return $data;
}


public function registrarCliente(string $nombre_cliente, string $identificacion, string $telefono)  
{
    $this->nombre_cliente = $nombre_cliente;
    $this->identificacion = $identificacion;
    $this->telefono = $telefono;

    $verificar = "SELECT * FROM clientes WHERE NombreCompleto = '$this->nombre_cliente'";
    $existe = $this->select($verificar);

    if (empty($existe)) {
        $sql = "INSERT INTO clientes(NombreCompleto, Identificacion, Telefono) VALUES (?, ?, ?)";
        $datos = array($this->nombre_cliente, $this->identificacion, $this->telefono);
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


public function editarCliente(int $ClienteID) {
    $sql = "SELECT * FROM clientes WHERE ClienteID = $ClienteID";
    $data = $this->select($sql);
    return $data;
}


public function modificarCliente(string $nombre_cliente, string $identificacion, string $telefono, int $ClienteID)  
{
    $this->nombre_cliente = $nombre_cliente;
    $this->telefono = $telefono;
    $this->identificacion = $identificacion;
    $this->ClienteID = $ClienteID;

    $sql = "UPDATE clientes SET NombreCompleto = ?, Identificacion = ?, Telefono = ? WHERE ClienteID = ?";
    $datos = array($this->nombre_cliente, $this->identificacion, $this->telefono, $this->ClienteID); // Corregido aquí
    $data = $this->save($sql, $datos);

    if ($data == 1) {
        $res = "modificado";
    } else {
        $res = "error";
    } 

    return $res;
}


public function accionCliente(int $estado, int $ClienteID) 
{
    $this->ClienteID = $ClienteID;
    $this->estado = $estado;
    $sql = "UPDATE clientes SET Estado = ? WHERE ClienteID = ?";
    $datos = array($this->estado, $this->ClienteID);
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
