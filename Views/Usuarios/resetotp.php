<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
    <link href="<?php echo base_url; ?>Assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url; ?>Assets/favicon.ico">
        <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url; ?>Assets/css/estilos.css" rel="stylesheet" />
		<link href="<?php echo base_url; ?>Assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url; ?>Assets/css/bootstrap-extended.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <script src="<?php echo base_url; ?>Assets/js/all.min.js" crossorigin="anonymous"></script>
		<title><?php echo $data['title'];?></title>
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper container">
		<div class="authentication-reset-password d-flex align-items-center justify-content-center">
			<div class="row">
			<div class="card-body">
									<div class="p-5">
										<div class="text-start">
											<img src="assets/images/logo-img.png" width="180" alt="">
										</div>
										<input type="hidden" id="token" value="<?php echo $data['seguridad']['token']; ?>">
										<h4 class="mt-5 font-weight-bold">Generar Nueva Contraseña</h4>
										<p class="text-muted">Su contraseña será cambiada para activar su cuenta. Por favor, ingrese su nueva contraseña.</p>
										<div class="mb-3 mt-5">
											<label class="form-label">Ingrese su nueva contraseña<span class="text-danger fw-bold">*</span></label>
											<input type="password" class="form-control" id="nueva_claveotp" placeholder="Contraseña nueva" />
										</div>
										<div class="mb-3">
											<label class="form-label">Confirme su nueva contraseña<span class="text-danger fw-bold">*</span></label>
											<input type="password" class="form-control" id="confirmar_claveotp" placeholder="Confirmar contraseña" />
										</div>
										<div class="d-grid gap-2">
											<button type="button" class="btn btn-primary" id="btnAccionotp">Cambiar Contraseña</button> <a href="<?php echo base_url;?>" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Volver al menú principal</a>
										</div>
									</div>
								</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
    	
        <script>
            const base_url = "<?php echo base_url; ?>";
        </script>
		<script src="<?php echo base_url. 'Assets/js/sweetalert2.all.min.js'; ?>"></script>
    	<script src="<?php echo base_url. 'Assets/js/otp.js'; ?>"></script>
</body>

</html>