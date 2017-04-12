<!DOCTYPE html>
<html>
<head>
	<title>BIENVENIDO PROFESOR</title>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.1.0.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/login.js"></script>
</head>
<body onload="nobackbutton();">
	<h1 style="text-align: center">Bienvenido de nuevo <?=$this->session->userdata('rol')?></h1>
				<?=anchor(base_url().'login_controller/logout_ci', 'Cerrar sesión')?>

</body>
</html>