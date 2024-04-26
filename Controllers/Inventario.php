<?php
class Inventario extends Controller{
    public function __construct(){
        session_start();
        parent::__construct();
    }
    
    public function index() 
    {
        $id_user = $_SESSION['id_usuario'];
        $model = new InventarioModel();
        $verificar = $model->verificarPermiso($id_user, 'inventario'); //aquí se cambia el nombre como está en la tabla detalle_permiso
        if(!empty( $verificar ) || $id_user == 1){
            if (empty($_SESSION['activo'])) {
                header("location: ".base_url);
            } //validación de seguridad para no entrar sin logearse 
            $model = new InventarioModel();
            $data['productos'] = $model->getInventario();
            $this->views->getView('Inventario', "index", $data);
        }else{
            header('Location: '. base_url .'Errors/permisos');
        }
    }
    


    public function listar() 
{
    $model = new InventarioModel();
    $data = $model->getInventario();

    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(array('error' => 'No se encontraron datos'), JSON_UNESCAPED_UNICODE);
    }

    die();
}


    
}

?>
