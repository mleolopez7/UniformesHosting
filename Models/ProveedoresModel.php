<?php
class ProveedoresModel extends Query {
    private $proveedores_id, $nombre_proveedor, $direccion, $telefono, $condiciones_pago, $plazo_entrega, $estado;
    
    public function __construct() 
    {
        parent::__construct();
    }

    public function getProveedorPorNombre(string $nombre_proveedor) 
    {
        $sql = "SELECT * FROM proveedores WHERE nombre_proveedor = '$nombre_proveedor'";
        $data = $this->select($sql);
        return $data;
    }

    public function getProveedores() 
    {
        $sql = "SELECT * FROM proveedores";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarProveedor(string $nombre_proveedor, string $direccion, string $telefono, string $condiciones_pago, string $plazo_entrega)  
    {
        $this->nombre_proveedor = $nombre_proveedor;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->condiciones_pago = $condiciones_pago;
        $this->plazo_entrega = $plazo_entrega;

        $verificar = "SELECT * FROM proveedores WHERE nombre_proveedor = '$this->nombre_proveedor'";
        $existe = $this->select($verificar);

        if (empty($existe)) {
            $sql = "INSERT INTO proveedores(nombre_proveedor, direccion, telefono, condiciones_pago, plazo_entrega) VALUES (?,?,?,?,?)";
            $datos = array($this->nombre_proveedor, $this->direccion, $this->telefono, $this->condiciones_pago, $this->plazo_entrega);
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

    public function editarProveedor(int $proveedores_id){
        $sql = "SELECT * FROM proveedores WHERE proveedores_id = $proveedores_id";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarProveedor(string $nombre_proveedor, string $direccion, string $telefono, string $condiciones_pago, string $plazo_entrega, int $proveedores_id)  
    {
        $this->nombre_proveedor = $nombre_proveedor;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->condiciones_pago = $condiciones_pago;
        $this->plazo_entrega = $plazo_entrega;
        $this->proveedores_id = $proveedores_id;

        $sql = "UPDATE proveedores SET nombre_proveedor = ?, direccion = ?, telefono = ?, condiciones_pago = ?, plazo_entrega = ? WHERE proveedores_id = ?";
        $datos = array($this->nombre_proveedor, $this->direccion, $this->telefono, $this->condiciones_pago, $this->plazo_entrega, $this->proveedores_id);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        } 

        return $res;
    }

    public function accionProveedor(int $estado, int $proveedores_id) 
{
    $this->proveedores_id = $proveedores_id;
    $this->estado = $estado;
    $sql = "UPDATE proveedores SET estado = ? WHERE proveedores_id = ?";
    $datos = array($this->estado, $this->proveedores_id);
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
