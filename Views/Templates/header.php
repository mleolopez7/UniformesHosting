<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Uniformes del Atlantico</title>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url; ?>Assets/favicon.ico">
    <link href="<?php echo base_url; ?>Assets/DataTables/datatables.min.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/css/estilos.css" rel="stylesheet" />
    <script src="<?php echo base_url; ?>Assets/js/all.min.js" crossorigin="anonymous"></script>

    <style>
        .resumen-empresarial {
            text-align: center;
            margin-bottom: 20px;
        }

        .resumen-empresarial h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 10px;
        }

        .decoracion {
            width: 100%;
            height: 20px;
            background: linear-gradient(to right, #007bff, #0056b3, #00397e, #001f3d, #000b17, #001f3d, #00397e, #0056b3, #007bff);
            /* Cambia los colores a tonos de azul oscuro */
            background-size: 200% auto;
            animation: gradient 5s linear infinite;
        }


        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }

        .totals-container {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .total {
            font-weight: bold;
        }

        .noticias {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .noticias h2 {
            color: #333;
        }

        .noticias article {
            margin-bottom: 20px;
        }

        .noticias article h3 {
            color: #555;
        }

        .noticias article p {
            color: #777;
        }

        .noticias {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .contenido {
            flex: 1;
            padding-right: 20px;
            /* Espacio entre el contenido y la imagen */
        }

        .imagen {
            width: 300px;
            /* Ancho de la imagen */
            height: 200px;
            /* Altura de la imagen */
            background-image: url('<?php echo base_url; ?>Assets/images/uniformes.jpg');
            /* Ruta de la imagen */
            background-size: cover;
            background-position: center;
            border: 5px solid #007bff;
            /* Color azul del marco */
            border-radius: 10px;
        }

        .bienvenida {
            background-color: #f8f9fa;
            /* Color de fondo */
            padding: 50px 0;
            /* Espacio alrededor del contenido */
            text-align: center;
            /* Alinear texto al centro */
        }

        .mensaje {
            background-color: #ffffff;
            /* Color de fondo */
            padding: 50px;
            /* Espacio alrededor del contenido */
        }

        .contenido {
            max-width: 800px;
            /* Ancho máximo del contenido */
            margin: 0 auto;
            /* Centrar el contenido horizontalmente */
        }

        .decoracion {
            height: 10px;
            /* Altura de la decoración */
            background-color: #007bff;
            /* Color de la decoración */
            margin-top: 20px;
            /* Espacio entre el mensaje y la decoración */
        }

        .resumen-empresarial img {
            max-width: 100%;
            /* Ajustar imagen al ancho del contenedor */
            height: auto;
            /* Mantener la proporción de la imagen */
            margin-top: 20px;
            /* Espacio entre el texto y la imagen */
        }
    </style>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <img src="<?php echo base_url; ?>Assets/img/logo.png " width="77" /><a class="navbar-brand ps-3" href="<?php echo base_url; ?>Administracion/home">Uniformes del Atlántico</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i><span class="hidden-xs">
                        <?php echo $_SESSION['usuario']; ?>
                    </span></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <!-- Correcto para Bootstrap 5 -->
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#cambiarPass">Modificar contraseña</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir">Cerrar Sesión</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <br>
                        <a class="nav-link" href="<?php echo base_url; ?>Administracion/home">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-shop"></i></div>
                            Inicio
                        </a>

                        &#160;
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-bag-shopping"></i></div>
                            Ventas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>


                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>ventas"><i class="fa fa-plus-square" aria-hidden="true"></i></i>&nbsp;Nueva Venta</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Ventas/Realizadas"><i class="fa-solid fa-clipboard-check"></i>&nbsp;Historial de ventas</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Clientes"><i class="fa fa-address-book" aria-hidden="true"></i>&nbsp;Clientes</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Tallas"><i class="fa fa-tags" aria-hidden="true"></i></i>&nbsp;Tallas</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCompras" aria-expanded="false" aria-controls="collapseCompras">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-basket-shopping"></i></div>
                            Compras
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseCompras" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Compras"><i class="fa-solid fa-cart-plus"></i>&nbsp;Nueva Compra</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Compras/Realizadas"><i class="fa-solid fa-clipboard-check"></i>&nbsp;Realizadas</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Proveedores"><i class="fa-solid fa-truck"></i>&nbsp;Proveedores</a>
                                <a class="nav-link" href="<?php echo base_url; ?>MateriaPrima"><i class="fa-solid fa-scissors"></i>&nbsp;Materia Prima</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseInventario" aria-expanded="false" aria-controls="collapseInventario">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-box"></i></div>
                            Inventario
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseInventario" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Inventario"><i class="fa-solid fa-box"></i>&nbsp;Materia Prima</a>
                            </nav>
                        </div>


                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProductos" aria-expanded="false" aria-controls="collapseCompras">
                            <div class="sb-nav-link-icon"><i class="fa-brands fa-product-hunt"></i></div>
                            Productos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProductos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Productos"><i class="fa-solid fa-shirt"></i>&nbsp;Categorias</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Catalogo"><i class="fa-solid fa-book-open-reader"></i>
                                    &nbsp;Catalogo</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduccion" aria-expanded="false" aria-controls="collapseProduccion">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-check"></i></div>
                            Produccion
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProduccion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>/Produccion">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-industry"></i></div>
                                    En producción
                                </a>
                                <a class="nav-link" href="<?php echo base_url; ?>/Entregas">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-ramp-box"></i></div>
                                    Entregas
                                </a>
                            </nav>
                        </div>


                        <a class="nav-link" href="<?php echo base_url; ?>Kardex">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Kardex
                        </a>
                        <?php if( $_SESSION['id_usuario'] == 1){ ?>
                        <a class="nav-link" href="<?php echo base_url; ?>Reportes">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-pie"></i></div>
                            Reportes
                        </a>
                        <?php } ?>

                        <p></p>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
                            Administración
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Usuarios"><i class="fas fa-user mr-2"></i>&nbsp;Usuarios</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Roles"><i class="fa fa-gear"></i>&nbsp;Roles</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Administracion"><i class="fas fa-tools mr-2"></i>&nbsp;Configuración</a>
                            </nav>
                        </div>

                    </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">


            <main>
                <div class="container-fluid mt-2">