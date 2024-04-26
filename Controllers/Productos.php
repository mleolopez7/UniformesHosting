<?php
class Productos extends Controller{
    public function __construct(){
        session_start();

        parent::__construct();
    }
    public function index() 
    {
        //funcion que hay que cortar y pegar para los permisos
        $id_user = $_SESSION['id_usuario'];
        $model = new ProductosModel();
        $verificar = $model->verificarPermiso($id_user, 'productos'); //aquí se cambia el nombre como está en la tabla detalle_permiso
        if(!empty( $verificar ) || $id_user == 1){
            if (empty($_SESSION['activo'])) {
                header("location: ".base_url);
            } //validación de seguridad para no entrar sin logearse 
            $model = new ProductosModel();
            $data['cajas'] = $model->getCajas();
            $data['roles'] = $model->getRoles();
            $this->views->getView('Productos', "index", $data);
        }else{
            header('Location: '. base_url .'Errors/permisos');
        }
    }

    function listar() 
    {
        $model = new ProductosModel();
        $data = $model->getProductos();
        for ($i=0; $i < count($data); $i++){
            if ($data[$i]['estadopb'] == 1) {
                $data[$i]['estadopb'] = '<span class="badge badge-success" style="color:green;">Activo</span>';
                    $data[$i]["acciones"] = '<div>
                    <button class="btn btn-primary" type="button" onclick="btnEditarProb('.$data[$i]['id_productob'].');"><i class ="fas fa-edit"></i></button>
                    <button class="btn btn-danger" type="button" onclick="btnEliminarProb('.$data[$i]['id_productob'].');" ><i class ="fas fa-trash-alt"></i></button>
                    </div>';
            }else{
                $data[$i]['estadopb'] = '<span class="badge badge-danger" style="color:red;">Inactivo</span>';
                $data[$i]["acciones"] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarProb('.$data[$i]['id_productob'].');" ><i class ="fas fa-lock-open"></i></button>
                </div>';
            }
        }
        echo  json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {   
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $tipopb = $_POST['tipopb'];
        $id = $_POST['id'];
        if (empty($codigo) ||empty($nombre) ||empty($descripcion) ||empty($tipopb)) {
            $msg = "Todos  los campos son obligatorios.";
        } else {
            if ($id == "") {
                    $model = new ProductosModel();
                    $data = $model->registrarProducto($codigo, $nombre, $descripcion, $tipopb);
                    if ($data == "ok") {
                        $msg = "si";
                    }else if ($data == "existe"){
                        $msg = "El Producto ya existe";
                    }else{
                        $msg = "Error al registrar el Producto";
                    }
            }else{
                $model = new ProductosModel();
                $data = $model->modificarProducto($codigo, $nombre, $descripcion, $tipopb, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                }else{
                    $msg = "Error al modificar el Producto";
                }
            }

        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id_productob) 
    {
        $model = new ProductosModel();
        $data = $model->editarProb($id_productob);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id) 
    {
        $model = new ProductosModel();
        $data = $model->accionProd(0, $id);
        if ($data == 1){
            $msg = "ok";
        }else{
            $msg = "Error al eliminar el Producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id) 
    {
        $model = new ProductosModel();
        $data = $model->accionProd(1, $id);
        if ($data == 1){
            $msg = "ok";
        }else{
            $msg = "Error al reingresar el Producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function permisos($id) 
    {
        if (empty($_SESSION['activo'])) {
            header("location: ".base_url);
        } 
        $model = new ProductosModel();
        $data ['datos'] = $model->getPermisos();
        $permisos = $model->getDetallePermisos($id);
        $data ['asignados'] = array();
        foreach($permisos as $permiso){
            $data ['asignados'][$permiso['id_permiso']] = true;
        }
        $data ['id_Producto'] = $id;
        $this->views->getView($this, "permisos", $data);
    }


    public function registrarPermiso() 
    {
        $msg = '';
        $id_user = $_POST['id_Producto'];
        $model = new ProductosModel();
        $eliminar = $model->eliminarPermisos($id_user);
        if ($eliminar == 'ok'){
            foreach($_POST['permisos'] as $id_permiso){
                $model = new ProductosModel();
                $msg = $model->registrarPermiso($id_user, $id_permiso);
                }
                if($msg == 'ok'){
                    $msg = array('msg' => 'Permisos asignado' , 'icono' => 'success');
                }else{
                    $msg = array('msg' => 'Error al asignar los permisos' , 'icono' => 'error');
                }
                
        }else{
            $msg = array('msg' => 'Error al eliminar los permisos anterirores', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    }
    // public function salir()
    // {
    //     session_destroy();
    //     header("location:".base_url);
    // }
}

?>