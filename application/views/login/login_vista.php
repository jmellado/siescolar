<!DOCTYPE html>
<html>
<head>

	<title>Login | Siescolar</title>

	<!-- icono del titulo-->
	<link href="<?php echo base_url(); ?>assets/plantillas/AdminLTE/dist/img/favicon.png" rel="shortcut icon" type="image/x-icon"/>

	<!-- metatags-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Magnificent login form a Flat Responsive Widget,Login form widgets, Sign up Web 	forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />

	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
	function hideURLbar(){ window.scrollTo(0,1); } </script>

	<script defer>var base_url = '<?php echo base_url() ?>'</script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/login.js"></script>
    <!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery.validate.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/messages_es.js" defer></script>-->

	<!-- Meta tag Keywords -->
	<link href="<?php echo base_url(); ?>assets/plantillas/login/css/style.css" rel="stylesheet" type="text/css" media="all"/><!--stylesheet-css-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plantillas/login/css/font-awesome.css"><!--fontawesome-->
	<link href="//fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet"><!--online fonts-->
	<link href="//fonts.googleapis.com/css?family=Raleway" rel="stylesheet"><!--online fonts-->

	<!--Mensajes emergentes-->
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" defer></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

</head>
<body onload="nobackbutton();">

	<style type="text/css">label.error{color:white;}</style>

	<div class="w3ls-main">
		<div class="wthree-heading">
			<!--<h1><i class='fa fa-graduation-cap'></i>&nbsp;SIESCOLAR</h1>-->
			<h1>
				<i class='fa fa-graduation-cap'></i>&nbsp;SIESCOLAR</br>
				<img src="<?php echo base_url();?>assets/plantillas/login/images/uni.png" alt="Logo UPC" class=" img-responsive" style="width: 155px; height: 55px; text-align: center;">
			</h1>
		</div>
			<div class="wthree-container">
				<div class="wthree-form">
					<div class="agileits-2">
						<h2>login</h2>
					</div>
					<form action="<?php echo base_url(); ?>login_controller/login_user" method="post" id="formlogin">
						<div class="w3-user">
							<span><i class="fa fa-user-o" aria-hidden="true"></i></span>
							<input type="text" id="username" name="username" placeholder="Usuario" required="" maxlength="20">
						</div>
						<div class="clear"></div>
						<div class="w3-psw">
							<span><i class="fa fa-key" aria-hidden="true"></i></span>
							<input type="password" id="password" name="password" placeholder="Contraseña" required="" maxlength="20">
						</div>
						<div class="clear"></div>
						<div class="w3l">
							<span><a href="#"><!--He olvidado mi contraseña--></a></span>  
						</div>
						<div class="clear"></div>

						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="form-control">

						<div class="w3l-submit">
							<input type="submit" name="btn_ingresar" id="btn_ingresar" value="Acceder">
						</div>
						<div class="clear"></div>
					</form>
				</div>
			</div>
	</div>
	<div class="agileits-footer">
		<p>Copyright &copy; 2017-2018 <a href="http://siescolar.com">Proyecto Siescolar</a> All Rights Reserved.</p>
	</div>
</body>
</html>
