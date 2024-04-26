
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $data['title']; ?></title>
        <link href="<?php echo base_url; ?>Assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
        <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url; ?>Assets/css/estilos.css" rel="stylesheet" />
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url; ?>Assets/favicon.ico">
        <script src="<?php echo base_url; ?>Assets/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <form action="Config/recovery.php" method="POST">
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Recuperación de contraseña</h3></div>
                                    <div class="card-body">
                                        <form id="frmLogin">
                                        &nbsp;<h7 for="inputPassword">&nbsp;Su contraseña será recuperada mediate su correo electrónico </h7>
                                    
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="correo" name="correo" type="email" placeholder="jevinvega@gmail.com" autocomplete="off" />
                                                <label for="usuario">Correo Electrónico</label>
                                            </div>                          
                                            <div class ="alert alert-danger text-center d-none" id="alerta" role="alert">
                                            </div>                                      
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            
                                            <button class="btn btn-primary" type="button" id="btnAccion">Enviar </button>
                                            <div class="d-flex">
                                            <a href="<?php echo base_url; ?>" class="btn btn-light ml-auto">
                                                <i class='bx bx-arrow-back mr-1'></i>Volver al menú principal
                                            </a>
                                            </div>
                                           
                                            </div>           
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            </form>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">FSociety &copy; Uniformes Del Atlantico <?php echo date("Y");?></div>
                            <div>
                                <a href="#">Políticas de privacidad</a>
                                &middot;
                                <a href="#">Terminos y Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="<?php echo base_url; ?>Assets/js/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url; ?>Assets/js/scripts.js"></script>
        <script>
            const base_url = "<?php echo base_url; ?>";
        </script>
        <script src="<?php echo base_url; ?>Assets/js/funciones.js"></script>
    </body>

    <script src="<?php echo base_url. 'Assets/js/sweetalert2.all.min.js'; ?>"></script>
    <script src="<?php echo base_url. 'Assets/js/reset.js'; ?>"></script>

</html>

