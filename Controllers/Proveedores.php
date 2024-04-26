<?php
class Proveedores extends Controller {
    public function __construct(){
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }

    public function index() {
        $id_user = $_SESSION['id_usuario'];
        $model = new ProveedoresModel();
        $verificar = $model->verificarPermiso($id_user, 'proveedores'); //aquí se cambia el nombre como está en la tabla detalle_permiso
        if(!empty( $verificar ) || $id_user == 1){
            if (empty($_SESSION['activo'])) {
                header("location: ".base_url);
            } //validación de seguridad para no entrar sin logearse 
            $this->views->getView('Proveedores', "index");
        }else{
            header('Location: '. base_url .'Errors/permisos');
        }
    }

    public function listar() 
{
    $model = new ProveedoresModel(); 
    $data = $model->getProveedores(); 

    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]['estado'] == 1) {
            $data[$i]['estado'] = '<span class="badge badge-success" style="color:green;">Activo</span>';
            $data[$i]["acciones"] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarProveedor('.$data[$i]['proveedores_id'].');"><i class ="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarProveedor('.$data[$i]['proveedores_id'].');" ><i class ="fas fa-trash-alt"></i></button>
            </div>';
        } else {
            $data[$i]['estado'] = '<span class="badge badge-danger" style="color:red;">Inactivo</span>';
            $data[$i]["acciones"] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarProveedor('.$data[$i]['proveedores_id'].');" ><i class ="fas fa-lock-open"></i></button>
            </div>';
        }
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
}


    

    public function registrar() {
        $nombre = $_POST['nombre_proveedor'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $condiciones = $_POST['condiciones_pago'];
        $plazo = $_POST['plazo_entrega'];
        $id = $_POST['proveedores_id'];

        if (empty($nombre) || empty($direccion) || empty($telefono) || empty($condiciones) || empty($plazo)) {
            $msg = "Todos los campos son obligatorios.";
        } else {
            $model = new ProveedoresModel();
            if (empty($id)) {
                $data = $model->registrarProveedor($nombre, $direccion, $telefono, $condiciones, $plazo);
                $msg = ($data == "ok") ? "si" : (($data == "existe") ? "El Proveedor ya existe" : "Error al registrar el Proveedor");
            } else {
                $data = $model->modificarProveedor($nombre, $direccion, $telefono, $condiciones, $plazo, $id);
                $msg = ($data == "modificado") ? "modificado" : "Error al modificar el proveedor";
            }
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $proveedores_id) {
        $model = new ProveedoresModel();
        $data = $model->editarProveedor($proveedores_id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $proveedores_id) 
{
    $model = new ProveedoresModel(); 
    $data = $model->accionProveedor(0, $proveedores_id);
    if ($data == 1){
        $msg = "ok";
    } else {
        $msg = "Error al eliminar el proveedor";
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}

public function reingresar(int $proveedores_id) 
{
    $model = new ProveedoresModel(); 
    $data = $model->accionProveedor(1, $proveedores_id);
    if ($data == 1){
        $msg = "ok";
    } else {
        $msg = "Error al reingresar el proveedor";
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}

public function salir()
{
    session_destroy();
    header("location:".base_url);
}

}
?>
