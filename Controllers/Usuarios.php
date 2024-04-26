<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class Usuarios extends Controller
{
    public function __construct()
    {
        session_start();

        parent::__construct();
    }




    public function index()
    {

        //funcion que hay que cortar y pegar para los permisos
        $id_user = $_SESSION['id_usuario'];
        $model = new UsuariosModel();
        $verificar = $model->verificarPermiso($id_user, 'usuarios'); //aquí se cambia el nombre como está en la tabla detalle_permiso
        if (!empty($verificar) || $id_user == 1) {
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            } //validación de seguridad para no entrar sin logearse 
            $model = new UsuariosModel();
            $data['cajas'] = $model->getCajas();
            $data['roles'] = $model->getRoles();
            $this->views->getView('Usuarios', "index", $data);
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    }

    function listar()
    {
        $model = new UsuariosModel();
        $data = $model->getUsuarios();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success" style="color:green;">Activo</span>';
                if ($data[$i]['id'] == 1) {
                    $data[$i]["acciones"] = '<div>
                        <span class="badge bg-primary">Administrador</span>
                    </div>';
                } else {

                    $data[$i]["acciones"] = '<div>
                    <a class="btn btn-dark" href="' . base_url . 'Usuarios/permisos/' . $data[$i]['id'] . '"><i class ="fas fa-key"></i></a>
                    <!-- <button class="btn btn-primary" type="button" onclick="btnEditarUser(' . $data[$i]['id'] . ');"><i class ="fas fa-edit"></i></button> -->
                    <button class="btn btn-danger" type="button" onclick="btnEliminarUser(' . $data[$i]['id'] . ');" ><i class ="fas fa-trash-alt"></i></button>
                    </div>';
                }
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger" style="color:red;">Inactivo</span>';
                $data[$i]["acciones"] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarUser(' . $data[$i]['id'] . ');" ><i class ="fas fa-lock-open"></i></button>
                </div>';
            }
        }
        echo  json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    function validar()
    {
        // Comprobar si hay un registro de intentos en la sesión
        if (!isset($_SESSION['intentos'])) {
            $_SESSION['intentos'] = 0;
        }

        $maxIntentos = 5; // Número máximo de intentos permitidos

        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg = "Los campos están vacíos";
        } else {
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256", $clave);
            $model = new UsuariosModel();
            $data = $model->getUsuario($usuario, $hash);

            if ($data) {
                if ($data['estado'] == 1) {
                    $_SESSION['id_usuario'] = $data['id'];
                    $_SESSION['usuario'] = $data['usuario'];
                    $_SESSION['nombre'] = $data['nombre'];
                    $_SESSION['rol_usuario'] = $data['id_rol'];
                    $_SESSION['activo'] = true;
    
                    // Restablecer los intentos en caso de inicio de sesión exitoso
                    $_SESSION['intentos'] = 0;
    
                    $msg = "ok";
                } else {
                    $msg = "Usuario inactivo. Cambie su contraseña para activarla.";
                }
            } else {
                // Incrementar el contador de intentos
                $_SESSION['intentos']++;

                // Calcular los intentos restantes
                $intentosRestantes = $maxIntentos - $_SESSION['intentos'];

                // Verificar si se alcanzó el límite de intentos
                if ($_SESSION['intentos'] >= $maxIntentos) {
                    // Cambiar el estado del usuario a 0
                    $model->cambiarEstadoUsuario($usuario, 0);

                    // Reiniciar el contador de intentos
                    $_SESSION['intentos'] = 0;

                    $msg = "Cuenta bloqueada por exceso de intentos fallidos. Contacte al administrador.";
                } else {
                    $msg = "Usuario o Contraseña incorrecta. Intentos restantes: $intentosRestantes";
                }
            }
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }



    public function registrar()
    {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $correo = $_POST['correo'];
        $confirmar = $_POST['confirmar'];
        $rol = $_POST['rol'];
        $caja = $_POST['caja'];
        $id = $_POST['id'];
        $hash = hash("SHA256", $clave);
        $correo = $_POST['correo'];
        if (empty($usuario) || empty($nombre) || empty($clave) || empty($correo) ||  empty($confirmar)) {
            $msg = "Todos  los campos son obligatorios.";
        } else {
            if ($id == "") {
                if ($clave != $confirmar) {
                    $msg = "Las contraseñas no coinciden";
                } else {
                    $model = new UsuariosModel();
                    $data = $model->registrarUsuario($usuario, $nombre, $correo, $hash, $caja, $rol);

                    $mail = new PHPMailer(true);
                    $fecha = date('/YmdHis');
                    $token = md5($fecha);
                    try {
                        //Server settings
                        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;   
                        $mail->SMTPDebug = 0;                     //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = host_smpt;                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = user_smtp;                     //SMTP username
                        $mail->Password   = clave_smtp;                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = puerto_smtp;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    
                        //Recipients
                        $mail->setFrom('jevinvega@gmail.com', 'Uniformes del Atlantico');
                        $mail->addAddress($correo);     //Add a recipient
            
                        //Attachments
                        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                    
                        //Content
                        $mail->isHTML(true); 
                        $mail->CharSet = 'UTF-8';                                 //Set email format to HTML
                        $mail->Subject = 'Restablecer contraseña - ' . title;
                        $mail->Body    = 'Has creado un usuario en nuestro sistema de informacion de Uniformes del atlantico y 
                        debes cambiar tu contraseña para activar tu cuenta de usuario. <br>
                        Para cambiar <a href="'.base_url.'usuarios/reset/'.$token.'">Click aquí</a> ';
                    
                        $mail->send();
                        $model = new UsuariosModel();
                        $verificarToken = $model->registrarToken($token, $correo);
                        if($verificarToken == 1){
                            $res = array('msg' => 'Correo enviado con un token de seguridad', 'type' => 'success');
                        }else{
                            $res = array('msg' => 'Error al registrar el token', 'type' => 'error');
                        }
                    } catch (Exception $e) {
                        $res = array('msg' => 'Error al enviar el correo:' . $mail->ErrorInfo , 'type' => 'error');
                    }
                    if ($data == "ok") {
                        $msg = "si";
                    } else if ($data == "usuario_existe") {
                        $msg = "El usuario ya existe";
                    } else if ($data == "correo_existe") {
                        $msg = "El correo electrónico ya está registrado";
                    } else {
                        $msg = "Error al registrar el usuario";
                    }
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function cambiarClave()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);
        $nueva = ($datos['nueva']);
        $confirmar = ($datos['confirmar']);
        $token = ($datos['token']);
        if(empty($nueva) || empty($confirmar)){
            $res = array('msg' => 'Todos los campos son requeridos','type'=>'warning');
        }else{
            if($nueva != $confirmar){
                $res = array('msg' => 'Las contraseñas no coinciden','type'=>'warning');
            }else{
                $hash = hash("SHA256", $nueva);
                $model = new UsuariosModel();
                $data = $model->modificarClave($hash, $token);
                if($data == 1){
                    $res = array('msg' => 'Contraseña modificada','type'=>'success');
                }else{
                    $res = array('msg' => 'Error al modificar','type'=>'warning');
                }
            }
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function forgot()
    {   
        $data['title'] = 'Olvidastes tu contraseña';
        $this->views->getView('usuarios','forgot',  $data);
        
    }

    public function reset($token)
    {   
        $model = new UsuariosModel();
        $data['title'] = 'Restablecer contraseña';
        $data['seguridad'] = $model->verificarToken($token);
        if($data['seguridad']['token'] != $token || empty($token) || $data['seguridad']['token'] == null){
            header('Location:'. base_url);
            exit;
        }
        $this->views->getView('usuarios','resetotp',  $data);       
    }

    function modificarUsuario()
    {
        $rol = $_POST['rol'];
        $caja = $_POST['caja'];
        $id = $_POST['id'];
        if (empty($caja) || empty($rol)) {
            $msg = "Todos los campos de caja y rol son obligatorios.";
        } else {
            $model = new UsuariosModel();
            $data = $model->modificarUsuario($caja, $rol, $id);
            if ($data == "modificado") {
                $msg = "modificado";
            } else {
                $msg = "Error al modificar el usuario";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function editar(int $id)
    {
        $model = new UsuariosModel();
        $data = $model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id)
    {
        $model = new UsuariosModel();
        $data = $model->accionUser(0, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al eliminar el usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id)
    {
        $model = new UsuariosModel();
        $data = $model->accionUser(1, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al reingresar el usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function permisos($id)
    {
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        $model = new UsuariosModel();
        $data['datos'] = $model->getPermisos();
        $permisos = $model->getDetallePermisos($id);
        $data['asignados'] = array();
        foreach ($permisos as $permiso) {
            $data['asignados'][$permiso['id_permiso']] = true;
        }
        $data['id_usuario'] = $id;
        $this->views->getView('usuarios', "permisos", $data);
    }


    public function registrarPermiso()
    {
        $msg = '';
        $id_user = $_POST['id_usuario'];
        $model = new UsuariosModel();
        $eliminar = $model->eliminarPermisos($id_user);
        if ($eliminar == 'ok') {
            foreach ($_POST['permisos'] as $id_permiso) {
                $model = new UsuariosModel();
                $msg = $model->registrarPermiso($id_user, $id_permiso);
            }
            if ($msg == 'ok') {
                $msg = array('msg' => 'Permisos asignado', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al asignar los permisos', 'icono' => 'error');
            }
        } else {
            $msg = array('msg' => 'Error al eliminar los permisos anterirores', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    }


    function cambiarPass()
    {
        $actual = $_POST['clave_actual'];
        $nueva = $_POST['clave_nueva'];
        $confirmar = $_POST['confirmar_clave'];
        if (empty($actual) || empty($nueva) || empty($confirmar)) {
            $mensaje = array('msg' => 'Todos los campos son obligatorios', 'icono' => 'warning');
        } else {
            if ($nueva != $confirmar) {
                $mensaje = array('msg' => 'Las contraseñas no coinciden', 'icono' => 'warning');
            } else {
                $id = $_SESSION['id_usuario'];
                $hash = hash("SHA256", $actual);
                $model = new UsuariosModel();
                $data = $model->getPass($hash, $id);
                if (!empty($data)) {
                    $model = new UsuariosModel();
                    $verificar = $model->modificarPass(hash("SHA256", $nueva), $id);
                    if ($verificar == 1) {
                        $mensaje = array('msg' => 'Contraseña modificada con exito', 'icono' => 'success');
                    } else {
                        $mensaje = array('msg' => 'Error al modificar la contraseña', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => 'Contraseña incorrecta', 'icono' => 'error');
                }
            }
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function salir()
    {
        session_destroy();
        header("location:" . base_url);
    }
}
