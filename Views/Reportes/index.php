<?php include "Views/Templates/header.php"; ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>


<div class="container mt-3">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#Rinicio" type="button" role="tab" aria-controls="home" aria-selected="true">Resumen</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ventas-tab" data-bs-toggle="tab" data-bs-target="#Rventas" type="button" role="tab" aria-controls="ventas" aria-selected="false">Ventas</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="mprima-tab" data-bs-toggle="tab" data-bs-target="#Rmprima" type="button" role="tab" aria-controls="productos" aria-selected="false">Compras/Materia Prima</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="productos-tab" data-bs-toggle="tab" data-bs-target="#Rproductos" type="button" role="tab" aria-controls="productos" aria-selected="false">Productos</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="clientes-tab" data-bs-toggle="tab" data-bs-target="#Rclientes" type="button" role="tab" aria-controls="clientes" aria-selected="false">Clientes</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="proveedores-tab" data-bs-toggle="tab" data-bs-target="#Rproveedores" type="button" role="tab" aria-controls="proveedores" aria-selected="false">Proveedores</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="usuarios-tab" data-bs-toggle="tab" data-bs-target="#Rusuarios" type="button" role="tab" aria-controls="usuarios" aria-selected="false">Usuarios</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="Rinicio" role="tabpanel" aria-labelledby="home-tab">
            <div class="resumen-empresarial">
                <h1>Resumen Empresarial</h1>
                <div class="decoracion"></div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body d-flex text-white">
                            Usuarios
                            <i class="fas fa-user fa-2x ml-auto"></i>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?php echo base_url; ?>Usuarios">Ver detalles</a>
                            <span class="text-white"><?php echo $data['usuarios']['total'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body d-flex text-white">
                            Clientes
                            <i class="fas fa-users fa-2x ml-auto"></i>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?php echo base_url; ?>Clientes">Ver detalles</a>
                            <span class="text-white"><?php echo $data['clientes']['total'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body d-flex text-white">
                            Productos
                            <i class="fab fa-product-hunt fa-2x ml-auto"></i>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?php echo base_url; ?>Productos">Ver detalles</a>
                            <span class="text-white"><?php echo $data['productos']['total'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body d-flex text-white">
                            Roles
                            <i class="fas fa-sitemap fa-2x ml-auto"></i>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?php echo base_url; ?>Roles">Ver detalles</a>
                            <span class="text-white"><?php echo $data['roles']['total'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-dark text-white" style="position: relative;">
                    <i class="fas fa-chart-pie me-1"></i>
                    Comparación de ventas y compras
                    <button data-canvasid="comparacion" class="btn btn-light btn-sm btn-print"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                        Imprimir
                    </button>
                </div>
                <div class="form-group">
                    <label for="anio">Año</label>
                    <select id="anio" onchange="comparacion()">
                        <?php
                        $fecha = date('Y');
                        for ($i = 2023; $i <= $fecha; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php echo ($fecha == $i) ? 'selected' : ''; ?>>
                                <?php echo $i; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="card-body">
                    <canvas id="comparacion" width="100%" height="50"></canvas>
                    <div class="totals-container">
                        <div id="totalVentas" class="total">Total Ventas: </div>
                        <div id="totalCompras" class="total">Total Compras: </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-dark text-white" style="position: relative;">
                    <i class="fas fa-chart-pie me-1"></i>
                    Material más utilizado
                    <button data-canvasid="cantidad_salida" class="btn btn-light btn-sm btn-print"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                        Imprimir
                    </button>
                </div>
                <div class="card-body">
                    <canvas id="cantidad_salida" width="100%" height="50"></canvas>
                </div>
            </div>


            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div style="text-align: center; width: 100%;">
                            <h3 class="mb-0">Ultimas Ventas</h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-light" id="tblvrealizadasDESC">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Factura</th>
                                    <th>Producto</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div style="text-align: center; width: 100%;">
                            <h3 class="mb-0">Ultimas Compras</h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-light" id="tblrealizadasDESC">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Producto</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>

                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="Rventas" role="tabpanel" aria-labelledby="ventas-tab">
            <div class="resumen-empresarial">
                <h1>Resumen de ventas</h1>
                <div class="decoracion"></div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-dark text-white" style="position: relative;">
                    <i class="fas fa-chart-pie me-1"></i>
                    Abonos por mes
                    <button data-canvasid="abonospormes" class="btn btn-light btn-sm btn-print"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                        Imprimir
                    </button>
                </div>
                <div class="form-group">
                    <label for="anioventas">Año</label>
                    <select id="anioventas" onchange="abonosporMes()">
                        <?php
                        $fecha = date('Y');
                        for ($i = 2023; $i <= $fecha; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php echo ($fecha == $i) ? 'selected' : ''; ?>>
                                <?php echo $i; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="card-body">
                    <canvas id="abonospormes" width="100%" height="50"></canvas>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-header bg-dark text-white" style="position: relative;">
                    <i class="fas fa-chart-pie me-1"></i>
                    Saldos pendientes
                    <button data-canvasid="saldos" class="btn btn-light btn-sm btn-print"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                        Imprimir
                    </button>
                </div>
                <div class="form-group">
                    <label for="anioSaldos">Año</label>
                    <select id="anioSaldos" onchange="reporteSaldos()">
                        <?php
                        $fecha = date('Y');
                        for ($i = 2023; $i <= $fecha; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php echo ($fecha == $i) ? 'selected' : ''; ?>>
                                <?php echo $i; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="card-body">
                    <canvas id="saldos" width="100%" height="50"></canvas>
                </div>
            </div>


        </div>

        <div class="tab-pane fade" id="Rmprima" role="tabpanel" aria-labelledby="mprima-tab">
            <div class="resumen-empresarial">
                <h1>Materia prima/Compras</h1>
                <div class="decoracion"></div>

                <div class="row mt-2">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header bg-dark text-white" style="position: relative;">
                                <i class="fas fa-chart-pie me-1"></i>
                                Productos con Mayor Cantidad en Inventario
                                <button data-canvasid="graficoProductosMasCantidad"
                                    class="btn btn-light btn-sm btn-print"
                                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                    Imprimir
                                </button>
                            </div>
                            <div class="card-body">
                                <canvas id="graficoProductosMasCantidad" width="100%" height="50"></canvas>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header bg-dark text-white" style="position: relative;">
                                <i class="fas fa-chart-pie me-1"></i>
                                Productos con Menor Cantidad en Inventario
                                <button data-canvasid="graficoProductosMenosCantidad"
                                    class="btn btn-light btn-sm btn-print"
                                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                    Imprimir
                                </button>
                            </div>
                            <div class="card-body">
                                <canvas id="graficoProductosMenosCantidad" width="100%" height="50"></canvas>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header bg-dark text-white" style="position: relative;">
                                <i class="fas fa-chart-pie me-1"></i>
                                Entradas de materia prima por mes
                                <button data-canvasid="entradas" class="btn btn-light btn-sm btn-print"
                                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                    Imprimir
                                </button>
                            </div>
                            <div class="form-group">
                                <label for="anioEntradas">Año</label>
                                <select id="anioEntradas" onchange="reporteEntradas()">
                                    <?php
                                    $fecha = date('Y');
                                    for ($i = 2023; $i <= $fecha; $i++) { ?>
                                        <option value="<?php echo $i; ?>" <?php echo ($fecha == $i) ? 'selected' : ''; ?>>
                                            <?php echo $i; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="card-body">
                                <canvas id="entradas" width="100%" height="50"></canvas>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header bg-dark text-white" style="position: relative;">
                                <i class="fas fa-chart-pie me-1"></i>
                                Salidas por mes
                                <button data-canvasid="salidas" class="btn btn-light btn-sm btn-print"
                                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                    Imprimir
                                </button>
                            </div>
                            <div class="form-group">
                                <label for="anioSalidas">Año</label>
                                <select id="anioSalidas" onchange="reporteSalidas()">
                                    <?php
                                    $fecha = date('Y');
                                    for ($i = 2023; $i <= $fecha; $i++) { ?>
                                        <option value="<?php echo $i; ?>" <?php echo ($fecha == $i) ? 'selected' : ''; ?>>
                                            <?php echo $i; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="card-body">
                                <canvas id="salidas" width="100%" height="50"></canvas>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="Rproductos" role="tabpanel" aria-labelledby="productos-tab">
            <div class="resumen-empresarial">
                <h1>Reportes de Producto terminado</h1>
                <div class="decoracion"></div>
            </div>
            <div class="row mt-2">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header bg-dark text-white" style="position: relative;">
                            <i class="fas fa-chart-bar me-1"></i>
                            Productos Más Vendidos
                            <button data-canvasid="graficoProductosMasVendidos" class="btn btn-light btn-sm btn-print"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                Imprimir
                            </button>
                        </div>
                        <div class="card-body">
                            <canvas id="graficoProductosMasVendidos" width="100%" height="60"></canvas>
                        </div>
                    </div>
                </div>


                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header bg-dark text-white" style="position: relative;">
                            <i class="fas fa-chart-pie me-1"></i>
                            Productos vendidos por mes
                            <button data-canvasid="vendidos" class="btn btn-light btn-sm btn-print"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                Imprimir
                            </button>
                        </div>
                        <div class="form-group">
                            <label for="anioVendidos">Año</label>
                            <select id="anioVendidos" onchange="reporteVendidos()">
                                <?php
                                $fecha = date('Y');
                                for ($i = 2023; $i <= $fecha; $i++) { ?>
                                    <option value="<?php echo $i; ?>" <?php echo ($fecha == $i) ? 'selected' : ''; ?>>
                                        <?php echo $i; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="card-body">
                            <canvas id="vendidos" width="100%" height="50"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="tab-pane fade" id="Rclientes" role="tabpanel" aria-labelledby="clientes-tab">
            <div class="resumen-empresarial">
                <h1>Reportes de Clientes</h1>
                <div class="decoracion"></div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header bg-dark text-white" style="position: relative;">
                            <i class="fas fa-chart-bar me-1"></i>
                            Clientes con más compras
                            <button onclick="imprimirClientesConCompras()" class="btn btn-light btn-sm"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                Imprimir
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <canvas id="clientesMasCompras" width="100%" height="50"></canvas>
                                </div>
                                <div class="col-md-4">
                                    <div id="clientList" style="padding-top: 10px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function imprimirClientesConCompras() {
                        var canvas = document.getElementById('clientesMasCompras');
                        var dataUrl = canvas.toDataURL();
                        var clientListHTML = document.getElementById('clientList').innerHTML;

                        var cardHeader = canvas.closest('.card').querySelector('.card-header');
                        var headerText = cardHeader ? cardHeader.innerText.replace(/\s*Imprimir\s*$/, '') : 'Clientes con más compras'; 

                        var windowContent = '<!DOCTYPE html>';
                        windowContent += '<html>'
                        windowContent += '<head><title>Reporte Grafico</title>';
                        windowContent += '<style>body { font-family: Arial, sans-serif; } h1 { font-size: 24px; margin-bottom: 20px; } h3 { font-size: 18px; margin-top: 20px; }</style>';
                        windowContent += '</head>';
                        windowContent += '<body>'
                        windowContent += '<h1>' + headerText + '</h1>'; 
                        windowContent += '<img src="' + dataUrl + '" style="width:100%;">';
                        windowContent += '<h3>Lista de Clientes</h3>' + clientListHTML;
                        windowContent += '</body>';
                        windowContent += '</html>';

                        var printWin = window.open('', '', 'width=800,height=600');
                        printWin.document.open();
                        printWin.document.write(windowContent);
                        printWin.document.addEventListener('load', function () {
                            printWin.focus();
                            printWin.print();
                            printWin.document.close();
                            printWin.close();
                        }, true);
                    }

                </script>

                <style>
                    #clientList div {
                        font-size: 0.8em; // Tamaño de fuente más pequeño
                        margin-bottom: 5px; // Espaciado entre nombres
                        color: #333; // Color del texto oscuro para mayor legibilidad
                        padding: 3px; // Padding para mejor manejo del espacio
                        border-left: 5px solid; // Barra lateral para indicar color asociado en el gráfico
                        border-color: #666; // Color inicial del borde, podrías ajustarlo dinámicamente con JS
                    }
                </style>

                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header bg-dark text-white" style="position: relative;">
                            <i class="fas fa-chart-pie me-1"></i>
                            Clientes Activos e Inactivos
                            <button data-canvasid="clientesactivosinactivos" class="btn btn-light btn-sm btn-print"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                Imprimir
                            </button>
                        </div>
                        <div class="card-body">
                            <canvas id="clientesactivosinactivos" width="100%" height="50"></canvas>
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <div class="tab-pane fade" id="Rproveedores" role="tabpanel" aria-labelledby="proveedores-tab">
            <div class="resumen-empresarial">
                <h1>Reporte de proveedores</h1>
                <div class="decoracion"></div>
            </div>

            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header bg-dark text-white" style="position: relative;">
                        <i class="fas fa-chart-bar me-1"></i>
                        Proveedores con Más Compras
                        <button data-canvasid="graficoProveedoresMasCompras" class="btn btn-light btn-sm btn-print"
                            style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                            Imprimir
                        </button>
                    </div>
                    <div class="card-body">
                        <canvas id="graficoProveedoresMasCompras" width="100%" height="50"></canvas>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="Rusuarios" role="tabpanel" aria-labelledby="usuarios-tab">
            <div class="resumen-empresarial">
                <h1>Reportes de Usuario</h1>
                <div class="decoracion"></div>

                <div class="row mt-2">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header bg-dark text-white" style="position: relative;">
                                <i class="fas fa-chart-pie me-1"></i>
                                Usuarios por Estado
                                <button data-canvasid="graficoUsuariosPorEstado" class="btn btn-light btn-sm btn-print"
                                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                    Imprimir
                                </button>
                            </div>
                            <div class="card-body">
                                <canvas id="graficoUsuariosPorEstado" width="100%" height="50"></canvas>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header bg-dark text-white" style="position: relative;">
                                <i class="fas fa-chart-pie me-1"></i>
                                Roles con Más Usuarios
                                <button data-canvasid="graficoRolesConMasUsuarios"
                                    class="btn btn-light btn-sm btn-print"
                                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                    Imprimir
                                </button>
                            </div>
                            <div class="card-body">
                                <canvas id="graficoRolesConMasUsuarios" width="100%" height="50"></canvas>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    document.querySelectorAll('.btn-print').forEach(button => {
        button.addEventListener('click', function () {
            imprimirGrafico(this.getAttribute('data-canvasid'));
        });
    });

    function imprimirGrafico(canvasId) {
        var canvas = document.getElementById(canvasId);
        var dataUrl = canvas.toDataURL();

        var cardHeader = canvas.closest('.card').querySelector('.card-header');
        var headerText = cardHeader ? cardHeader.innerText.replace(/\s*Imprimir\s*$/, '') : 'Gráfico'; 

        var windowContent = '<!DOCTYPE html>';
        windowContent += '<html>'
        windowContent += '<head><title>Reporte Gráfico</title>';
        windowContent += '<style>body { font-family: Arial, sans-serif; } h1 { font-size: 24px; }</style>';
        windowContent += '</head>';
        windowContent += '<body>'
        windowContent += '<h1>' + headerText + '</h1>'; 
        windowContent += '<img src="' + dataUrl + '" style="width:100%;">';
        windowContent += '</body>';
        windowContent += '</html>';

        var printWin = window.open('', '', 'width=800,height=600');
        printWin.document.open();
        printWin.document.write(windowContent);

        printWin.document.addEventListener('load', function () {
            printWin.focus();
            printWin.print();
            printWin.document.close();
            printWin.close();
        }, true);
    }


</script>

<?php include "Views/Templates/footer.php"; ?>