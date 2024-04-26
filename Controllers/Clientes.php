<?php
class Clientes extends Controller {
    public function __construct(){
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $this->model = new ClientesModel();
    }

    public function index() {
        $id_user = $_SESSION['id_usuario'];
        $model = new ClientesModel(); 
        $verificar = $model->verificarPermiso($id_user, 'clientes'); 
        if(!empty($verificar) || $id_user == 1){
            if (empty($_SESSION['activo'])) {
                header("location: ".base_url);
            } 
            $this->views->getView('Clientes', "index"); 
        } else {
            header('Location: '. base_url .'Errors/permisos');
        }
    }


    public function listar() 
{
    $model = new ClientesModel(); 
    $data = $model->getClientes(); 

    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]['Estado'] == 1) {
            $data[$i]['Estado'] = '<span class="badge badge-success" style="color:green;">Activo</span>';
            $data[$i]["acciones"] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarCliente('.$data[$i]['ClienteID'].');"><i class ="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarCliente('.$data[$i]['ClienteID'].');" ><i class ="fas fa-trash-alt"></i></button>
            </div>';
        } else {
            $data[$i]['Estado'] = '<span class="badge badge-danger" style="color:red;">Inactivo</span>';
            $data[$i]["acciones"] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarCliente('.$data[$i]['ClienteID'].');" ><i class ="fas fa-lock-open"></i></button>
            </div>';
        }
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
}

public function registrar() {
    $nombre = $_POST['nombre_cliente'];
    $identificacion = $_POST['identificacion'];
    $telefono = $_POST['telefono'];
    $id = $_POST['clientes_id'];

    if (empty($nombre) || empty($identificacion) || empty($telefono)) {
        $msg = "Todos los campos son obligatorios.";
    } else {
        $model = new ClientesModel(); // Asegúrate de tener un modelo llamado ClientesModel para la gestión de clientes
        if (empty($id)) {
            $data = $model->registrarCliente($nombre, $identificacion, $telefono);
            $msg = ($data == "ok") ? "si" : (($data == "existe") ? "El Cliente ya existe" : "Error al registrar el Cliente");
        } else {
            $data = $model->modificarCliente($nombre, $identificacion, $telefono, $id);
            $msg = ($data == "modificado") ? "modificado" : "Error al modificar el cliente";
        }
    }

    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}


public function editar(int $clientes_id) {
    $model = new ClientesModel();
    $data = $model->editarCliente($clientes_id);

    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode("error", JSON_UNESCAPED_UNICODE);
    }

    die();
}


public function eliminar(int $clientes_id) 
{
    $model = new ClientesModel();
    $data = $model->accionCliente(0, $clientes_id);

    if ($data == "ok"){
        $msg = "ok";
    } else {
        $msg = "Error al eliminar el cliente";
    }

    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}

public function reingresar(int $clientes_id) 
{
    $model = new ClientesModel(); 
    $data = $model->accionCliente(1, $clientes_id);

    if ($data == "ok"){
        $msg = "ok";
    } else {
        $msg = "Error al reingresar el cliente";
    }

    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}


}
?>