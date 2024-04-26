<?php
class Roles extends Controller{
    public function __construct(){
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: ".base_url);
        }
        parent::__construct();
    }
    public function index() 
    {
        $id_user = $_SESSION['id_usuario'];
        $model = new RolesModel();
        $verificar = $model->verificarPermiso($id_user, 'roles'); 
        if(!empty( $verificar ) || $id_user == 1){
            $this->views->getView('Roles', "index");
        }else{
            header('Location: '. base_url .'Errors/permisos');
        }
    }

    function listar() 
    {
        //<button class="btn btn-primary" type="button" onclick="btnEditarRol('.$data[$i]['id'].');"><i class ="fas fa-edit"></i></button>
        $model = new RolesModel();
        $data = $model->_getRoles();
        for ($i=0; $i < count($data); $i++){
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success" style="color:green;">Activo</span>';
                $data[$i]["acciones"] = '<div>      
            <button class="btn btn-danger" type="button" onclick="btnEliminarRol('.$data[$i]['id'].');" ><i class ="fas fa-trash-alt"></i></button>
            </div>';
            }else{
                $data[$i]['estado'] = '<span class="badge badge-danger" style="color:red;">Inactivo</span>';
                $data[$i]["acciones"] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarRol('.$data[$i]['id'].');" ><i class ="fas fa-lock-open"></i></button>
                </div>';
            }

        }
        echo  json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {   
        $rol = $_POST['rol'];
        $id = $_POST['id'];
        if (empty($rol)) {
            $msg = "Todos  los campos son obligatorios.";
        } else {
            if ($id == "") {
                    $model = new RolesModel();
                    $data = $model->registrarRoles($rol);
                    if ($data == "ok") {
                        $msg = "si";
                    }else if ($data == "existe"){
                        $msg = "Error el rol ya existe";
                    }else{
                        $msg = "Error al registrar el rol";
                    }           
            }else{
                $model = new RolesModel();
                $data = $model->modificarRoles($rol, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                }else{
                    $msg = "Error al modificar el rol";
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id) 
    {
        $model = new RolesModel();
        $data = $model->editarRoles($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id) 
    {
        $model = new RolesModel();
        $data = $model->accionRol(0, $id);
        if ($data == 1){
            $msg = "ok";
        }else{
            $msg = "Error al eliminar el rol";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id) 
    {
        $model = new RolesModel();
        $data = $model->accionRol(1, $id);
        if ($data == 1){
            $msg = "ok";
        }else{
            $msg = "Error al reingresar el Rol";
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





