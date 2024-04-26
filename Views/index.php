<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url; ?>Assets/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Iniciar Sesión</title>

        <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
        <script src="<?php echo base_url; ?>Assets/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Iniciar Sesión</h3></div>
                                    <br>
                                    <center><img src="<?php echo base_url; ?>Assets/images/login-images/160925385_242186104265703_6477669797695369791_n.jpg " width="180"/></center>
                                    <div class="card-body">
                                        <form id="frmLogin">
                                        &nbsp;<h7 for="inputPassword"><i class = "fas fa-user"></i>&nbsp;Usuario</h7>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Ingrese Usuario" />
                                                <label for="usuario">Ingrese Usuario</label>
                                            </div>
                                            &nbsp;<h7><i class = "fas fa-key"></i>&nbsp;Contraseña</h7>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="clave" name="clave" type="password" placeholder="Ingrese Contraseña" />
                                                <label for="clave">Ingrese Contraseña</label>
                                            </div>                                           
                                            <div class ="alert alert-danger text-center d-none" id="alerta" role="alert">
                                            </div>                                      
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit" onclick="frmLogin(event);">Iniciar Sesión</button>
                                            </div>           
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <p>
                                        ¿Olvidaste tu contraseña?
                                        <a href="<?php echo base_url. 'principal/forgot';?>">Recuperar contraseña</a>.
                                    </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </main>
            </div>
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
        <script src="<?php echo base_url; ?>Assets/js/login.js"></script>
    </body>
</html>
