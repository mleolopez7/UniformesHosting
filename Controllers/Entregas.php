<?php
class Entregas extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
        $this->model = new EntregasModel();
    }


    public function index()
    {
        //funcion que hay que cortar y pegar para los permisos
        $id_user = $_SESSION['id_usuario'];
        $model = new EntregasModel();
        $verificar = $model->verificarPermiso($id_user, 'entregas'); //aquí se cambia el nombre como está en la tabla detalle_permiso
        if (!empty($verificar) || $id_user == 1) {
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            } //validación de seguridad para no entrar sin logearse 
            $model = new EntregasModel();
            $data['cajas'] = $model->getCajas();
            $data['roles'] = $model->getRoles();
            $this->views->getView('Entregas', "index", $data);
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    }

    function listar()
    {
        $model = new EntregasModel();
        $data = $model->getListas();

        if ($data) {
            foreach ($data as &$row) {
                $row['acciones'] = ' <div>
                <a class="btn btn-danger" href="' . base_url . ("Ventas/generarPdfv/" . $row['id']) . '" target="_blank"><i class="fas fa-file-pdf"></i></a>
                <button class="btn btn-primary" type="button" onclick="btnDesactivarEntrega(' . $row['id'] . ');">Entregar</button>
                </div>
            </div>';

            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(array('error' => 'No se encontraron datos'), JSON_UNESCAPED_UNICODE);
        }

        exit;
    }


    public function desactivar(int $id)
    {
        $model = new EntregasModel();
        $data = $model->VentaEntregado(2, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al Entregar el registro";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }


}

?>