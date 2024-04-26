<?php
class CatalogoModel extends Query
{
    private $id, $id_venta, $tipo_producto, $descripcion, $cantidad, $precio, $talla, $color, $color_letra,
        $logo_izquierdo, $logo_derecho, $logo_delantero, $logo_trasero, $estado, $img, $foto;
    public function __construct()
    {
        parent::__construct();
    }

    public function getCatalogo()
    {
        $sql = "SELECT * FROM ventas WHERE estado = 2";
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

    public function verificarPermiso(int $id_user, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p 
        INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }


    public function registrarFoto(string $foto)
    {
        $this->foto = $foto;

        $sql = "INSERT INTO ventas(foto) VALUES (?)";
        $datos = array($this->foto);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }

        return $res;
    }

    public function editarCatalogoFoto(int $id)
    {
        $sql = "SELECT foto FROM ventas WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }


    public function modificarFoto(string $name, int $id)
    {
        $this->foto = $name;
        $this->id = $id;

        $sql = "UPDATE ventas SET foto = ? WHERE id = ?";
        $datos = array($this->foto,$this->id); // Corregido aquí
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }

        return $res;
    }

    // public function editarCatalogoFoto(int $id, string $foto) {
    //     $sql = "UPDATE detalle_venta SET foto = ? WHERE id = ?";
    //     $datos = array($foto, $id);
    //     $data = $this->save($sql, $datos);
    //     return $data == 1 ? "ok" : "error";
    // }


    // public function modificarFoto(string $codigo, string $img, int $id)  
    // {
    //     //$this->codigo = $codigo;
    //     $this->img = $img;
    //     $this->id = $id;
    //         $sql = "UPDATE detalle_venta SET codigo_productob = ?, foto = ? WHERE id = ?";
    //         $datos = array($this->img, $this->id);
    //         $data = $this->save($sql, $datos);
    //         if ($data == 1) {
    //             $res = "modificado";
    //         }else{
    //             $res = "error";
    //         } 

    //     return $res;
    // }  




}
