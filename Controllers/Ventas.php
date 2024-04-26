<?php
class   Ventas extends Controller
{
    public function __construct()
    {
        session_start();

        parent::__construct();
        $this->model = new VentasModel();
    }
    public function index()
    {
        $id_user = $_SESSION['id_usuario'];
        $model = new VentasModel(); // Cambiado a VentasModel
        $verificar = $model->verificarPermiso($id_user, 'nueva_venta'); // Cambiado a nueva_venta
        if (!empty($verificar) || $id_user == 1) {
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            } // Validación de seguridad para no entrar sin logearse 
            $this->views->getView('Ventas', "index"); // Cambiado a Ventas
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    }



    public function listarClientes()
    {
        try {
            $model = new VentasModel();
            $data = $model->getClientes();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        die();
    }





    public function listarTallas()
    {
        try {
            $model = new VentasModel();
            $data = $model->getTallas();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        die();
    }





    public function listarProductoBase()
    {
        try {
            $model = new VentasModel();
            $data = $model->getProductoBase();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        die();
    }




    public function ingresar()
    {
        $usuario_id = $_SESSION['id_usuario'];
        $tipo_productob = $_POST['tipo_productob'];
        $descripcionpb = $_POST['descripcionpb'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];
        $talla = $_POST['TallasText'];
        $color = $_POST['color'];
        $color_letra = $_POST['color_letra'];
        $logo_izquierdo = $_POST['logo_izquierdo'];
        $logo_derecho = $_POST['logo_derecho'];
        $logo_delantero = $_POST['logo_delantero'];
        $logo_trasero = $_POST['logo_trasero'];
        $sub_total = $cantidad * $precio;

        $data = $this->model->registrarDetallev($usuario_id, $tipo_productob, $descripcionpb, $cantidad, $precio, $talla, $color, $color_letra, $logo_izquierdo, $logo_derecho, $logo_delantero, $logo_trasero, $sub_total);

        if ($data == "ok") {
            $msg = "ok";
        } else {
            $msg = "Error al ingresar";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function listarVentas()
    {
        $usuario_id = $_SESSION['id_usuario'];

        try {
            $data['detallev'] = $this->model->getDetalleVenta($usuario_id);

            $data['total_pagar'] = $this->model->calcularVenta($usuario_id);

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
        }

        die();
    }


    public function delete($id_detallev)
    {
        try {
            $data = $this->model->deleteDetalleVenta($id_detallev);

            if ($data == 'ok') {
                $msg = 'ok';
            } else {
                $msg = 'No se pudo eliminar el detalle';
            }
        } catch (Exception $e) {
            $msg = 'Error: ' . $e->getMessage();
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }




    public function registrarVenta()
    {
        $usuario_id = $_SESSION['id_usuario'];
        $factura = $_POST['factura'];
        $cliente = $_POST['clientes'];
        $telefono = $_POST['telefono'];
        $Identificacion = $_POST['Identificacion'];
        $fecha_actual = $_POST['fecha_actual'];
        $fecha_entrega = $_POST['fecha_entrega'];
        $cajero = $_POST['cajero'];
        $comentario = $_POST['comentario'];
        $descuento = $_POST['descuento'];
        $total = $_POST['total'];
        $abono = $_POST['abono'];

        // Aplicar descuento al total
        $total -= $total * ($descuento / 100);

        $saldo = $total - $abono;

        $detalle = $this->model->getDetalleVenta($usuario_id);
        $data = $this->model->registrarVenta($factura, $cliente, $telefono, $Identificacion, $fecha_actual, $fecha_entrega, $cajero, $comentario, $descuento, $total, $abono, $saldo);
        if ($data == 'ok') {
            $id_venta = $this->model->id_venta();
            foreach ($detalle as $row) {
                $factura = $_POST['factura'];
                $tipo_productob = $row['tipo_productob'];
                $descripcionpb = $row['descripcionpb'];
                $cantidad = $row['cantidad'];
                $precio = $row['precio'];
                $talla = $row['talla'];
                $color = $row['color'];
                $sub_total = $row['sub_total'];
                $color_letra = $row['color_letra'];
                $logo_izquierdo = $row['logo_izquierdo'];
                $logo_derecho = $row['logo_derecho'];
                $logo_delantero = $row['logo_delantero'];
                $logo_trasero = $row['logo_trasero'];


                $this->model->registrarDetalleVenta($id_venta['id'], $factura, $tipo_productob, $descripcionpb, $cantidad, $precio, $talla, $color, $color_letra, $logo_izquierdo, $logo_derecho, $logo_delantero, $logo_trasero, $sub_total);
            }

            $vaciar = $this->model->vaciarDetallev($usuario_id);

            if ($vaciar == 'ok') {
                $msg = array('msg' => 'ok', 'id_venta' => $id_venta['id']);
            }
        } else {
            $msg = array('msg' => 'error');
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function generarPdfv($id_venta)
    {
        $empresa = $this->model->getEmpresa();
        $detalle = $this->model->getDetaVenta($id_venta);
        $venta = $this->model->getVentas($id_venta);
        require('Libraries/fpdf/fpdf.php');
        $pdf = new FPDF('P', 'mm', array(210, 297));

        $pdf->AddPage();
        $pdf->SetMargins(5, 0, 0);
        $pdf->SetTitle('Reporte de Venta');
        $pdf->SetFont('Arial', 'B', 14);

        // Encabezado con el nombre de la empresa y el logotipo (si se desea agregar)
        $pdf->Cell(0, 10, utf8_decode($empresa['nombre']), 0, 1, 'C');

        // Información de contacto de la empresa
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 5, utf8_decode('Teléfono: ' . $empresa['telefono']), 0, 1, 'C');

        // Información de contacto de la empresa
        $pdf->SetFont('Arial', 'B', 11);
        if (isset($empresa['Identificacion'])) {
            $pdf->Cell(0, 5, utf8_decode('Identificacion: ' . $empresa['Identificacion']), 0, 1, 'C');
        } else {
            $pdf->Cell(0, 5, utf8_decode('Identificacion: No disponible'), 0, 1, 'C'); // O proporciona un mensaje alternativo si no está definido
        }


        // Dirección de la empresa
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 5, utf8_decode('Dirección: ' . $empresa['direccion']), 0, 1, 'C');

        // Folio de la compra
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 5, 'Folio: ' . $id_venta, 0, 1, 'C');
        $pdf->Ln();
        $pdf->Cell(0, 5, utf8_decode('Nº Factura: ' . $venta['factura']), 0, 1, 'L');
        $pdf->Ln();

        if (is_array($venta)) {
            $pdf->Cell(0, 5, utf8_decode('Fecha: ' . $venta['fecha_actual']), 0, 1, 'L');
            $pdf->Cell(0, 5, utf8_decode('Fecha de entrega: ' . $venta['fecha_entrega']), 0, 1, 'L');
            $pdf->Cell(0, 5, utf8_decode('Cliente: ' . $venta['cliente']), 0, 1, 'L');
            $pdf->Cell(0, 5, utf8_decode('Telefono: ' . $venta['telefono']), 0, 1, 'L');
            $pdf->Cell(0, 5, utf8_decode('Identificacion: ' . $venta['identificacion']), 0, 1, 'L');
        } else {
            $pdf->Cell(0, 5, 'Información de venta no disponible', 0, 1, 'C');
        }

        $pdf->Ln();
        // Encabezados de la tabla
        // Configurar colores
        // Encabezado de la tabla
        $pdf->SetFillColor(0, 0, 0); // Color de fondo negro
        $pdf->SetTextColor(255, 255, 255); // Color de texto blanco
        $pdf->SetFont('Arial', 'B', 10); // Reducir el tamaño de la fuente

        $pdf->Cell(20, 10, utf8_decode('Tipo'), 1, 0, 'C', true); // Reducir el alto de las celdas a 10
        $pdf->Cell(15, 10, utf8_decode('Talla'), 1, 0, 'C', true); // Reducir el ancho de las celdas a 15
        $pdf->Cell(15, 10, utf8_decode('Color'), 1, 0, 'C', true);
        $pdf->Cell(15, 10, utf8_decode('C. Letra'), 1, 0, 'C', true);
        $pdf->Cell(30, 10, utf8_decode('Logo Izq.'), 1, 0, 'C', true); // Utilizar "Izq." en lugar de "Izquierdo" para ahorrar espacio
        $pdf->Cell(30, 10, utf8_decode('Logo Der.'), 1, 0, 'C', true); // Utilizar "Der." en lugar de "Derecho" para ahorrar espacio
        $pdf->Cell(30, 10, utf8_decode('Logo Fte.'), 1, 0, 'C', true); // Utilizar "Fte." en lugar de "Enfrente" para ahorrar espacio
        $pdf->Cell(30, 10, utf8_decode('Logo Atrás'), 1, 0, 'C', true);
        $pdf->Cell(15, 10, 'Cant.', 1, 1, 'C', true);

        // Detalles de la compra
        $pdf->SetTextColor(0, 0, 0); // Restablecer el color de texto a negro

        foreach ($detalle as $row) {
            // Alineación vertical y horizontal centrada en todas las celdas
            $pdf->Cell(20, 10, $row['tipo_productob'], 1, 0, 'C');
            $pdf->Cell(15, 10, utf8_decode($row['talla']), 1, 0, 'C');
            $pdf->Cell(15, 10, utf8_decode($row['color']), 1, 0, 'C');
            $pdf->Cell(15, 10, utf8_decode($row['color_letra']), 1, 0, 'C');
            $pdf->Cell(30, 10, utf8_decode($row['logo_izquierdo']), 1, 0, 'C');
            $pdf->Cell(30, 10, utf8_decode($row['logo_derecho']), 1, 0, 'C');
            $pdf->Cell(30, 10, utf8_decode($row['logo_delantero']), 1, 0, 'C');
            $pdf->Cell(30, 10, utf8_decode($row['logo_trasero']), 1, 0, 'C');
            $pdf->Cell(15, 10, utf8_decode($row['cantidad']), 1, 1, 'C');
        }


        $pdf->Ln(10);


        if (is_array($venta)) {
            $pdf->Cell(0, 5, utf8_decode('Descuento %: ' . $venta['descuento']), 0, 1, 'L');
            $pdf->Cell(0, 5, utf8_decode('Total: ' . $venta['total']), 0, 1, 'L');
            $pdf->Cell(0, 5, utf8_decode('Abono: ' . $venta['abono']), 0, 1, 'L');
            $pdf->Cell(0, 5, utf8_decode('Saldo: ' . $venta['saldo']), 0, 1, 'L');
        } else {
            $pdf->Cell(0, 5, 'Información de venta no disponible', 0, 1, 'C');
        }

        // Añade un espacio entre cada producto para mayor claridad
        $pdf->Ln();
        $pdf->Cell(0, 5, utf8_decode('Comentario: ' . $venta['comentario']), 0, 1, 'L');



        $pdf->Ln(5);
        $observacion = utf8_decode('Observacion: ' . $empresa['mensaje']);
        $pdf->MultiCell(0, 8, $observacion, 0, 'C');
        $pdf->Ln(5);



        $pdf->Image('Assets/img/logo.png', 170, 10, 25, 25);

        $pdf->Output();
    }



    public function Realizadas()
    {
        $id_user = $_SESSION['id_usuario'];
        $model = new VentasModel(); // Cambiado a VentasModel
        $verificar = $model->verificarPermiso($id_user, 'historial de ventas'); // Cambiado a nueva_venta
        if (!empty($verificar) || $id_user == 1) {
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            } // Validación de seguridad para no entrar sin logearse 
            $this->views->getView('Ventas', "Realizadas");
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }

    }

    public function listar_realizadas()
    {
        $data = $this->model->getVentasRealizadas();

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]["acciones"] = '<div>
                <a class="btn btn-danger" href="' . base_url . ("Ventas/generarPdfv/" . $data[$i]['id']) . '" target="_blank"><i class="fas fa-file-pdf"></i></a>
            </div>';
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }




    public function listar_realizadasDESC()
    {
        $data = $this->model->getVentasRealizadasDESC();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function pdf()
    {
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];

        if (empty($desde) || empty($hasta)) {
            $data = $this->model->getVentasRealizadas();
        } else {
            $data = $this->model->getRangoFechas($desde, $hasta);
        }

        $empresa = $this->model->getEmpresa();
        require('Libraries/fpdf/fpdf.php');
        $pdf = new FPDF('P', 'mm', 'A4');

        $pdf->AddPage();
        $pdf->SetMargins(10, 0, 0);
        $pdf->SetTitle('Reporte de Ventas por fecha');
        $pdf->SetFont('Arial', 'B', 12);

        // Encabezado con el nombre de la empresa y el logotipo (si se desea agregar)
        $pdf->Cell(0, 10, utf8_decode($empresa['nombre']), 0, 1, 'C');

        // Información de contacto de la empresa
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 5, utf8_decode('Teléfono: ' . $empresa['telefono']), 0, 1, 'C');

        // Dirección de la empresa
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 5, utf8_decode('Dirección: ' . $empresa['direccion']), 0, 1, 'C');
        $pdf->Ln();

        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(25, 5, 'Factura', 0, 0,  'L', true);
        $pdf->Cell(70, 5, 'Cliente', 0, 0,  'L', true);
        $pdf->Cell(25, 5, 'Total', 0, 0,  'L', true);
        $pdf->Cell(25, 5, 'Abono', 0, 0,  'L', true);
        $pdf->Cell(25, 5, 'Saldo', 0, 0,  'L', true);
        $pdf->Cell(30, 5, 'Fecha', 0, 1,  'L', true);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0, 0, 0);

        foreach ($data as $row) {
            $pdf->Cell(25, 5, $row['factura'], 0, 0,  'L');
            $pdf->Cell(70, 5, $row['cliente'], 0, 0,  'L');
            $pdf->Cell(25, 5, $row['total'], 0, 0,  'L');
            $pdf->Cell(25, 5, $row['abono'], 0, 0,  'L');
            $pdf->Cell(25, 5, $row['saldo'], 0, 0,  'L');
            $pdf->Cell(30, 5, $row['fecha_actual'], 0, 1,  'L');
        }

        $pdf->Image('Assets/img/logo.png', 170, 10, 25, 25);
        $pdf->Output();
    }
}
