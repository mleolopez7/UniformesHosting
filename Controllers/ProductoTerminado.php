<?php
class ProductoTerminado extends Controller{
    public function __construct(){
        session_start();
        parent::__construct();
    }
    
    public function index() 
    {
        $id_user = $_SESSION['id_usuario'];
        $model = new ProductoTerminadoModel();
        $verificar = $model->verificarPermiso($id_user, 'producto terminado'); //aquí se cambia el nombre como está en la tabla detalle_permiso
        if(!empty( $verificar ) || $id_user == 1){
            if (empty($_SESSION['activo'])) {
                header("location: ".base_url);
            }
            $model = new ProductoTerminadoModel();
            $data['productosPT'] = $model->getAllPT();
            $this->views->getView('Productoterminado', "index", $data);    
        }else{
            header('Location: '. base_url .'Errors/permisos');
        }
    }
        
}

?>
