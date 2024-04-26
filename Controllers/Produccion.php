<?php
class Produccion extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
        $this->model = new ProduccionModel();
    }

    public function index()
    {
        $id_user = $_SESSION['id_usuario'];
        $model = new ProduccionModel();
        $verificar = $model->verificarPermiso($id_user, 'produccion');
        if (!empty($verificar) || $id_user == 1) {
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            } //validación de seguridad para no entrar sin logearse 
            $this->views->getView('Produccion', "index");
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    }

    public function listar()
    {
        $model = new ProduccionModel();
        $data = $model->getVenta();

        if ($data) {
            // Modificar cada elemento del arreglo para agregar la propiedad 'acciones'
            foreach ($data as &$producto) {
                $producto["acciones"] = '
                <div>
                    <a class="btn btn-danger" href="' . base_url . ("Ventas/generarPdfv/" . $producto['id']) . '" target="_blank"><i class="fas fa-file-pdf"></i></a>
                    <div class="dropdown" id="dropdown' . $producto['id'] . '" style="display: inline-block">
                        <button class="btn btn-success dropdown-toggle" type="button" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false">
                            En proceso
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" type="button" data-toggle="modal" data-target="#miModal" data-id="' . $producto['id'] . '">
                                    <i class="fa-solid fa-scissors" style="margin-right: 5px;"></i> 
                                    Material Usado
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" type="button" onclick="btnDesactivarDventa(' . $producto['id'] . ');">
                                    <i class="fa-regular fa-calendar-check" style="margin-right: 5px;"></i> 
                                    Terminar
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>';
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(array('error' => 'No se encontraron datos'), JSON_UNESCAPED_UNICODE);
        }

        exit;
    }




    public function ingresar()
    {
        $usuario_id = $_SESSION['id_usuario'];
        $id_producto = $_POST['id_producto'];
        $producto = $_POST['materiaPrima'];
        $cantidad = $_POST['cantidad'];
        $motivo = $_POST['motivo'];


        $data = $this->model->registrarDetalleSalida($usuario_id, $id_producto, $producto, $cantidad, $motivo);

        if ($data == "ok") {
            $msg = "ok";
        } else {
            $msg = "Error al ingresar";
        }


        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function listarDetalleSalida()
    {
        $usuario_id = $_SESSION['id_usuario'];
        $data['detalle_salida'] = $this->model->getDetalleSalida($usuario_id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }



    public function deleteSalida($id)
    {
        try {
            $data = $this->model->deleteDetalleSalida($id);

            if ($data == 'ok') {
                $msg = 'ok';
            } else {
                $msg = 'No se pudo eliminar el detalle de salida';
            }
        } catch (Exception $e) {
            $msg = 'Error: ' . $e->getMessage();
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }



    public function registrarSalidaKardex()
    {
        $usuario_id = $_SESSION['id_usuario'];


        $detalle_salida = $this->model->getDetalleSalida($usuario_id);

        foreach ($detalle_salida as $row) {
            $producto = $row['producto'];
            $cantidad = $row['cantidad'];
            $id_producto = $row['id_producto'];
            $motivo_salida = $row['motivo_salida'];
            $fecha = $row['fecha'];

            // Registrar la salida en el kardex
            $this->model->registrarKardexSalida($id_producto, $producto, $cantidad, $motivo_salida, $fecha);
        }

        // Vaciar el detalle_salida después de registrar en el kardex
        $this->model->vaciarDetalleSalida($usuario_id);

        echo json_encode(['msg' => 'ok'], JSON_UNESCAPED_UNICODE);
        die();
    }


    public function desactivar(int $id)
    {
        $model = new ProduccionModel();
        $data = $model->VentaInactivo(0, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al Desactivar el registro";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }


}

?>