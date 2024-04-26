<?php
class Kardex extends Controller{
    public function __construct(){
        session_start();
        parent::__construct();
    }
    public function index() 
    {
        $id_user = $_SESSION['id_usuario'];
        $model = new KardexModel();
        $verificar = $model->verificarPermiso($id_user, 'kardex'); //aquí se cambia el nombre como está en la tabla detalle_permiso
        if(!empty( $verificar ) || $id_user == 1){
            if (empty($_SESSION['activo'])) {
                header("location: ".base_url);
            } //validación de seguridad para no entrar sin logearse 
            $this->views->getView('Kardex', "index");
        }else{
            header('Location: '. base_url .'Errors/permisos');
        }
    }

    public function listar() 
{
    $model = new KardexModel();
    $data = $model->getKardex();

    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(array('error' => 'No se encontraron datos'), JSON_UNESCAPED_UNICODE);
    }

    die();
}

    function validar()  
    {
        if (empty($_POST['usuario']) || empty($_POST['clave'])){
            $msg = "Los campos estan vacios";
        }else{
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256", $clave);
            $model = new KardexModel();
            $data = $model->getUsuario($usuario, $hash);
            if($data){
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['activo'] = true;
                $msg = "ok";
            }else{
                $msg = "Usuario o Contraseña incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE );
        die();
    }

    public function registrar()
    {   
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $correo = $_POST['correo'];
        $confirmar = $_POST['confirmar'];
        $caja = $_POST['caja'];
        $id = $_POST['id'];
        $hash = hash("SHA256", $clave);
        //$hashC = hash( "SHA256", $correo); testeo para luego de correo encriptado
        if (empty ($usuario) || empty($nombre) || empty($correo) ||empty($caja)) {
            $msg = "Todos  los campos son obligatorios.";

        } else {
            if ($id == "") {
                if ($clave != $confirmar) {
                    $msg = "Las contraseñas no coinciden";
                }else{
                    $model = new KardexModel();
                    $data = $model->registrarUsuario($usuario, $nombre,$correo, $hash,$caja);
                    if ($data == "ok") {
                        $msg = "si";
                    }else if ($data == "existe"){
                        $msg = "El usuario ya existe";
                    }else{
                        $msg = "Error al registrar el usuario";
                    }
                }
            }else{
                $model = new KardexModel();
                $data = $model->modificarUsuario($usuario, $nombre,$correo, $caja, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                }else{
                    $msg = "Error al modificar el usuario";
                }
            }

        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id) 
    {
        $model = new KardexModel();
        $data = $model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id) 
    {
        $model = new KardexModel();
        $data = $model->accionUser(0, $id);
        if ($data == 1){
            $msg = "ok";
        }else{
            $msg = "Error al eliminar el usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id) 
    {
        $model = new KardexModel();
        $data = $model->accionUser(1, $id);
        if ($data == 1){
            $msg = "ok";
        }else{
            $msg = "Error al reingresar el usuario";
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


