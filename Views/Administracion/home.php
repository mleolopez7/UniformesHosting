<?php include "Views/Templates/header.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de inicio</title>
</head>

<body>
    <main>
        <div class="container-fluid px-4">
        <section class="bienvenida" style="margin-top: -70px;">
    <div class="resumen-empresarial">
        <div class="decoracion"></div>
        <h1 class="mt-4">Bienvenido a</h1>
        <h1 class="mt-4">Uniformes del Atlántico</h1>
        <img src="<?php echo base_url; ?>Assets/images/pantalla2.jpeg" alt="Imagen de bienvenida" style="max-width: 600px; height: auto;">   
    </div>
</section>

            <div class="decoracion"></div>

            <section class="mensaje">
                <div class="contenido text-center">
                    <h2>¡Bienvenido <?php echo $_SESSION['usuario']; ?> nuestra plataforma de gestión de pedidos!</h2>
                    <p>Estamos aquí para ayudarte a administrar tus ventas y pedidos de manera eficiente. Recuerda revisar tus pedidos pendientes y estar al tanto de las últimas actualizaciones de inventario.</p>
                </div>
                <div class="decoracion"></div>
            </section>

            <?php if ($_SESSION['id_usuario'] == 1) { ?>
                <div class="contenido text-center">
                    <h2>¡Hola Administrador!</h2>
                    <p>Un vistazo rápido de reportes recientes.</p>
                </div>


                <div class="row justify-content-center">


                    <div class="col-xl-5">
                        <div class="card mb-4">
                            <div class="card-header bg-dark text-white">
                                <i class="fas fa-chart-pie me-1"></i>
                                Productos de inventario con stock mínimo
                            </div>
                            <div class="card-body"><canvas id="stockminimo" width="100%" height="50"></canvas></div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card mb-4">
                            <div class="card-header bg-dark text-white">
                                <i class="fas fa-chart-pie me-1"></i>
                                Productos más salidos
                            </div>
                            <div class="card-body">
                                <canvas id="cantidad_salida" width="100%" height="50"></canvas>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="decoracion"></div>

            <?php } ?>

            <section class="noticias">
                <div class="contenido">
                    <h2>Somos una empresa originalmente teleña</h2>
                    <article>
                        <p>Dedicados siempre a la confección de uniformes equipos, uniformes para empresas, uniformes para centros educativos, estampados y mas.</p>
                        <p>Barrio El Centro, ave 5
                            Tela, Atlántida
                            Honduras, C.A.
                    </article>
                </div>
                <div class="imagen"></div>
            </section>



        </div>
        </div>

    </main>
</body>

</html>


<?php include "Views/Templates/footer.php"; ?>