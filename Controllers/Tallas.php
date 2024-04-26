<?php
class Tallas extends Controller {
    public function __construct(){
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }

    public function index() {
        $id_user = $_SESSION['id_usuario'];
        $model = new TallasModel(); // Cambia a la clase de modelo para Tallas
        $verificar = $model->verificarPermiso($id_user, 'tallas'); // Cambia el nombre de la tabla en la consulta
        if(!empty($verificar) || $id_user == 1){
            if (empty($_SESSION['activo'])) {
                header("location: ".base_url);
            } //validación de seguridad para no entrar sin logearse 
            $this->views->getView('Tallas', "index"); // Cambia a la vista para Tallas
        } else {
            header('Location: '. base_url .'Errors/permisos');
        }
    }


    public function listar() 
{
    $model = new TallasModel(); // Cambia a la clase de modelo para tallas
    $data = $model->getTallas(); // Cambia al método correspondiente para obtener Tallas

    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]['estado'] == 1) {
            $data[$i]['estado'] = '<span class="badge badge-success" style="color:green;">Activo</span>';
            $data[$i]["acciones"] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarTallas(' . $data[$i]['TallasID'] . ');"><i class ="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarTallas(' . $data[$i]['TallasID'] . ');" ><i class ="fas fa-trash-alt"></i></button>
            </div>';
        } else {
            $data[$i]['estado'] = '<span class="badge badge-danger" style="color:red;">Inactivo</span>';
            $data[$i]["acciones"] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarTallas(' . $data[$i]['TallasID'] . ');" ><i class ="fas fa-lock-open"></i></button>
            </div>';
        }
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
}

public function registrar() {
    $TipoTalla = $_POST['TipoTalla'];
    $id = $_POST['TallasID'];

    if (empty($TipoTalla)) {
        $msg = "Todos los campos son obligatorios.";
    } else {
        $model = new TallasModel(); // Asegúrate de tener un modelo llamado ClientesModel para la gestión de clientes
        if (empty($id)) {
            $data = $model->registrarTallas($TipoTalla);
            $msg = ($data == "ok") ? "si" : (($data == "existe") ? "La talla ya existe" : "Error al registrar la talla");
        } else {
            $data = $model->modificarTallas($TipoTalla, $id);
            $msg = ($data == "modificado") ? "modificado" : "Error al modificar la talla";
        }
    }

    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}


public function editar(int $TallasID) {
    $model = new TallasModel();
    $data = $model->editarTallas($TallasID);

    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode("error", JSON_UNESCAPED_UNICODE);
    }

    die();
}


public function eliminar(int $TallasID) 
{
    $model = new TallasModel();
    $data = $model->accionTallas(0, $TallasID);

    if ($data == "ok"){
        $msg = "ok";
    } else {
        $msg = "Error al eliminar la talla";
    }

    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}

public function reingresar(int $TallasID) 
{
    $model = new TallasModel(); 
    $data = $model->accionTallas(1, $TallasID);

    if ($data == "ok"){
        $msg = "ok";
    } else {
        $msg = "Error al reingresar la talla";
    }

    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}

}
?>
