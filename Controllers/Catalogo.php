<?php
class Catalogo extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
        $this->model = new CatalogoModel();
    }


    public function index()
    {
        //funcion que hay que cortar y pegar para los permisos
        $id_user = $_SESSION['id_usuario'];
        $model = new CatalogoModel();
        $verificar = $model->verificarPermiso($id_user, 'catalogo'); //aquí se cambia el nombre como está en la tabla detalle_permiso
        if (!empty($verificar) || $id_user == 1) {
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            } //validación de seguridad para no entrar sin logearse 
            $model = new CatalogoModel();
            $data['cajas'] = $model->getCajas();
            $data['roles'] = $model->getRoles();
            $this->views->getView('Catalogo', "index", $data);
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    }

    function listar()
    {
        $model = new CatalogoModel();
        $data = $model->getCatalogo();
        if ($data) {
            // Modificar cada elemento del arreglo para agregar la propiedad 'acciones'
            foreach ($data as &$producto) {
                $producto['imagen'] = '<img class="img-thumbnail" src="' . base_url . "Assets/imagenes/" . $producto['foto'] . '" width="80">';
                $producto["acciones"] = '<div>
                <button class="btn btn-info" type="button" onclick="editarImagen(' . $producto['id'] . ');"><i class="fa-solid fa-camera-retro"></i></button>
                </div>';
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(array('error' => 'No se encontraron datos'), JSON_UNESCAPED_UNICODE);
        }
        exit;
    }


    public function registrar()
{
    $id = $_POST['id_catalogo'] ?? ''; // Usamos el operador de fusión de null para asignar una cadena vacía si $_POST['id_catalogo'] no está definido
    $img = $_FILES['imagen'];
    $name = $img['name'];
    $tmpname = $img['tmp_name'];
    $destino = "Assets/imagenes/" . $name;

    if (empty($name)) {
        $name = "default.jpg";
    }

    if (empty($id)) {
        $model = new CatalogoModel();
        $data = $model->registrarFoto($name);
        if ($data == "ok") {
            $msg = "ok";
            move_uploaded_file($tmpname, $destino);
        } else {
            $msg = "Error al subir la foto";
        }
    } else {
        if ($_POST['foto_actual'] != $_POST['foto_delete']) {
            $model = new CatalogoModel();
            // Verificamos que $id no esté vacío antes de llamar a modificarFoto()
            if (!empty($id)) {
                $data = $model->modificarFoto($name, $id);
                if ($data == "modificado") {
                    move_uploaded_file($tmpname, $destino);
                    $msg = "modificado";
                } else {
                    $msg = "Error al subir la foto";
                }
            } else {
                $msg = "ID del catálogo no válido";
            }
        }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}





    public function editar(int $id)
    {
        $model = new CatalogoModel();
        $data = $model->editarCatalogoFoto($id);
        if ($data) {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode("error", JSON_UNESCAPED_UNICODE);
        }

        die();
    }
}
