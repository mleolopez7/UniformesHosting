<?php
class Compras extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
        $this->model = new ComprasModel();
    }

    public function index()
    {
        $id_user = $_SESSION['id_usuario'];
        $model = new ComprasModel();
        $verificar = $model->verificarPermiso($id_user, 'nueva compra'); //aquí se cambia el nombre como está en la tabla detalle_permiso
        if (!empty($verificar) || $id_user == 1) {
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            } //validación de seguridad para no entrar sin logearse 
            $this->views->getView('Compras', "index");
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    }


    public function listarProveedores()
    {
        try {
            $data = $this->model->getProveedores();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        die();
    }


    public function listarMateriaPrima()
    {
        try {
            $data = $this->model->getMateriaPrima();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()], JSON_UNESCAPED_UNICODE);
        }
        die();
    }


    public function ingresar()
    {
        $usuario_id = $_SESSION['id_usuario'];
        $proveedor = $_POST['proveedor'];
        $id_producto = $_POST['id_producto'];
        $producto = $_POST['materiaPrima'];
        $descripcion = $_POST['descripcion'];
        $cantidad = $_POST['cantidad_compra'];
        $precio = $_POST['precio_compra'];
        $sub_total = $cantidad * $precio;

        $data = $this->model->registrarDetalle($usuario_id, $proveedor, $id_producto, $producto, $descripcion, $cantidad, $precio, $sub_total);

        if ($data == "ok") {
            $msg = "ok";
        } else {
            $msg = "Error al ingresar";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function listar()
    {
        $usuario_id = $_SESSION['id_usuario'];
        $data['detalle'] = $this->model->getDetalle($usuario_id);
        $data['total_pagar'] = $this->model->calcularCompra($usuario_id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function delete($detalle_id)
    {
        $data = $this->model->deleteDetalle($detalle_id);
        if ($data == 'ok') {
            $msg = 'ok';
        } else {
            $msg = 'error';
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function registrarCompra()
{
    $usuario_id = $_SESSION['id_usuario'];

    $factura = $_POST['factura'];
    $fecha = $_POST['fecha'];
    $isv_percentage = $_POST['isv']; // Assuming ISV is provided as percentage
    $descuento_percentage = $_POST['descuento']; // Assuming discount is provided as percentage

    $detalle = $this->model->getDetalle($usuario_id);

    $total = 0;
    foreach ($detalle as $row) {
        $cantidad = $row['cantidad'];
        $precio = $row['precio'];
        $sub_total = $cantidad * $precio;
        $total += $sub_total;
    }

    // Calculate discount and tax amounts
    $descuento = ($total * $descuento_percentage) / 100;
    $isv = ($total * $isv_percentage) / 100;

    // Apply discount and tax to the total
    $total -= $descuento;
    $total += $isv;

    $data = $this->model->registrarCompra($factura, $total, $fecha);

    if ($data == 'ok') {
        $id_compra = $this->model->id_compra();
        foreach ($detalle as $row) {
            $proveedor = $row['proveedor'];
            $id_producto = $row['id_producto'];
            $producto = $row['producto'];
            $descripcion = $row['descripcion'];
            $cantidad = $row['cantidad'];
            $precio = $row['precio'];
            $sub_total = $cantidad * $precio;

            
            $this->model->registrarDetalleCompra($id_compra['id'], $proveedor, $id_producto, $producto, $descripcion, $cantidad, $precio, $sub_total);

            
            $this->model->registrarKardex($proveedor, $id_producto, $producto, $descripcion, $fecha, $factura, $cantidad, $precio);
        }

        
        $vaciar = $this->model->vaciarDetalle($usuario_id);

        if ($vaciar == 'ok') {
            $msg = array('msg' => 'ok', 'id_compra' => $id_compra['id']);
        }
    } else {
        $msg = array('msg' => 'error');
    }

    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}





    public function generarPdf($id_compra)
    {
        $empresa = $this->model->getEmpresa();
        $detalle = $this->model->getDetaCompra($id_compra);
        $compra = $this->model->getCompras($id_compra);

        require('Libraries/fpdf/fpdf.php');
        $pdf = new FPDF('P', 'mm', array(210, 297));

        $pdf->AddPage();
        $pdf->SetMargins(5, 0, 0);
        $pdf->SetTitle('Reporte de Compra');
        $pdf->SetFont('Arial', 'B', 14);

        // Encabezado con el nombre de la empresa y el logotipo (si se desea agregar)
        $pdf->Cell(0, 10, utf8_decode($empresa['nombre']), 0, 1, 'C');

        // Información de contacto de la empresa
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 5, utf8_decode('Teléfono: ' . $empresa['telefono']), 0, 1, 'C');

        // Dirección de la empresa
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 5, utf8_decode('Dirección: ' . $empresa['direccion']), 0, 1, 'C');

        // Folio de la compra
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 5, 'Folio: ' . $id_compra, 0, 1, 'C');
        $pdf->Ln();
        $pdf->Cell(0, 5, utf8_decode('Nº Factura: ' . $compra['factura']), 0, 1, 'L');
        $pdf->Ln(10);
        $pdf->Cell(0, 5, utf8_decode('Fecha: ' . $compra['fecha']), 0, 1, 'L');


        // Encabezados de la tabla
        // Configurar colores
        $pdf->SetFillColor(0, 0, 0); // Color de fondo negro
        $pdf->SetTextColor(255, 255, 255); // Color de texto blanco
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 8, utf8_decode('Compra'), 1, 0, 'C', true);
        $pdf->Cell(70, 8, utf8_decode('Descripcion'), 1, 0, 'C', true);
        $pdf->Cell(40, 8, utf8_decode('Proveedor'), 1, 0, 'C', true);
        $pdf->Cell(20, 8, 'Cantidad', 1, 0, 'C', true);
        $pdf->Cell(20, 8, 'Precio', 1, 0, 'C', true);
        $pdf->Cell(20, 8, 'Sub Total', 1, 1, 'C', true);

        // Detalles de la compra
        $total = 0.00;
        $pdf->SetTextColor(0, 0, 0); // Color de texto blanco
        foreach ($detalle as $row) {
            $total = $total + $row['sub_total'];

            $pdf->Cell(20, 8, utf8_decode($row['producto']), 0, 0,  'C');
            $pdf->Cell(70, 8, utf8_decode($row['descripcion']), 0, 0,  'C');
            $pdf->Cell(40, 8, utf8_decode($row['proveedor']), 0, 0,  'C');
            $pdf->Cell(20, 8, $row['cantidad'], 0, 0,  'C');
            $pdf->Cell(20, 8, $row['precio'], 0, 0,  'C');
            $pdf->Cell(20, 8, number_format($row['sub_total'], 2, '.', ','), 0, 1,  'C');
        }
        $pdf->Ln();

        if (is_array($compra)) {
            $pdf->Cell(183, 8, 'Total', 0, 1, 'R');
            $pdf->Cell(183, 5, $compra['total'], 0, 1,  'R');   
        } else {
            $pdf->Cell(0, 5, 'Información de venta no disponible', 0, 1, 'C');
        }

        $pdf->Image('Assets/img/logo.png', 170, 10, 25, 25);

        $pdf->Output();
    }



    public function Realizadas()
    {
        $id_user = $_SESSION['id_usuario'];
        $model = new ComprasModel();
        $verificar = $model->verificarPermiso($id_user, 'historial de compras'); //aquí se cambia el nombre como está en la tabla detalle_permiso
        if (!empty($verificar) || $id_user == 1) {
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            } //validación de seguridad para no entrar sin logearse 
            $this->views->getView('Compras', "Realizadas");
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    }

    public function listar_realizadas()
    {
        $data = $this->model->getComprasRealizadas();
        for ($i = 0; $i < count($data); $i++) {

            $data[$i]["acciones"] = '<div>
        <a class="btn btn-danger" href="' . base_url . ("Compras/generarPdf/" . $data[$i]['id']) . '" target="_blank"><i class="fas fa-file-pdf"></i></a>
    </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function pdf()
    {
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];
        if (empty($desde) || empty($hasta)) {
            $data = $this->model->getComprasRealizadas();
        } else {
            $data = $this->model->getRangoFechas($desde, $hasta);
        }

        $empresa = $this->model->getEmpresa();
        require('Libraries/fpdf/fpdf.php');
        $pdf = new FPDF('P', 'mm', 'A4');

        $pdf->AddPage();
        $pdf->SetMargins(10, 0, 0);
        $pdf->SetTitle('Reporte de Compra por fecha');
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
        $pdf->Cell(80, 5, 'Factura', 0, 0,  'L', true);
        $pdf->Cell(25, 5, 'Total', 0, 0,  'L', true);
        $pdf->Cell(30, 5, 'Fecha', 0, 1,  'L', true);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        foreach ($data as $row) {
            $pdf->Cell(80, 5, $row['factura'], 0, 0,  'L');
            $pdf->Cell(25, 5, $row['total'], 0, 0,  'L');
            $pdf->Cell(30, 5, $row['fecha'], 0, 1,  'L');
        }
        
        $pdf->Image('Assets/img/logo.png', 170, 10, 25, 25);
        $pdf->Output();
    }

    public function listar_realizadasCompras()
    {
        $data = $this->model->getdetalleCompra(); 
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

}
