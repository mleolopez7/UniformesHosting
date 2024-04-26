<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class Principal extends Controller 
{
    
    public function __construct() {
        session_start();
        if (!empty($_SESSION['activo'])) {
            header("location:".base_url."Usuarios");
        }
        parent ::__construct();
    }  //validacion para dejarme en la página si ya estoy logeado
    public function index()
    {
        $this->views->getView('Principal', "index");
        
    }

    
    public function forgot()
    {   
        $data['title'] = 'Olvidastes tu contraseña';
        $this->views->getView('usuarios','forgot',  $data);
        
    }


    public function reset($token)
    {   
        $model = new PrincipalModel();
        $data['title'] = 'Restablecer contraseña';
        $data['seguridad'] = $model->verificarToken($token);
        if($data['seguridad']['token'] != $token || empty($token) || $data['seguridad']['token'] == null){
            header('Location:'. base_url);
            exit;
        }
        $this->views->getView('usuarios','reset',  $data);
        
    }

    public function enviarCorreo($correo){
        $model = new PrincipalModel();
        $verificar = $model->verificarCorreo($correo);
        if (!empty($verificar)) {
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
                $mail->Body    = 'Has pedido restablecer tu contraseña, si no has sido tu omite este mensaje <br>
                Para cambiar <a href="'.base_url.'principal/reset/'.$token.'">Click aquí</a> ';
            
                $mail->send();
                $model = new PrincipalModel();
                $verificarToken = $model->registrarToken($token, $correo);
                if($verificarToken == 1){
                    $res = array('msg' => 'Correo enviado con un token de seguridad', 'type' => 'success');
                }else{
                    $res = array('msg' => 'Error al registrar el token', 'type' => 'error');
                }
            } catch (Exception $e) {
                $res = array('msg' => 'Error al enviar el correo:' . $mail->ErrorInfo , 'type' => 'error');
            }
        }else{
            $res = array('msg' => 'El correo no está registrado', 'type' => 'warning');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();

    }

    public function enviarcorreoConfirmacion($correo){
        $model = new PrincipalModel();
        $verificar = $model->verificarCorreo($correo);
        if (!empty($verificar)) {
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
                $mail->Subject = 'Activar cuenta - ' . title;
                $mail->Body    = 'Has creado un usuario nuevo en el sistema de Uniformes del Atlantico <br>
                Tienes que activar tu cuenta con el token que se te envió a este correo. <br>
                El token es que necesitaras para la activacion es el siguiente: '.$token.'<br> 
                Copia este token para activar tu cuenta y poder usar nuestro sistema';
            
                $mail->send();
                $model = new PrincipalModel();
                $verificarToken = $model->registrarTokenValidar($token);
                if($verificarToken == 1){
                    $res = array('msg' => 'Correo enviado con un token de seguridad', 'type' => 'success');
                }else{
                    $res = array('msg' => 'Error al registrar el token', 'type' => 'error');
                }
            } catch (Exception $e) {
                $res = array('msg' => 'Error al enviar el correo:' . $mail->ErrorInfo , 'type' => 'error');
            }
        }else{
            $res = array('msg' => 'El correo no está registrado', 'type' => 'warning');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
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
                $model = new PrincipalModel();
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

}

?>