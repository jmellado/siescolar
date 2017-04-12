<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<script>var base_url = '<?php echo base_url() ?>'</script>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery-1.12.4.min.js"></script>
	<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/login.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery.validate.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/messages_es.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/libs/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">

	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
</head>
<body onload="nobackbutton();">
	<style type="text/css">
	    
	    label.error{color:red;}
	</style>

	<div class="container">
		<div class="row">
                <div class="col-lg-12 ">
                    <h1 class="page-header"></h1>
                </div>
        </div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">LOGIN</div>
					<div class="panel-body">
						<form role="form" action="<?php echo base_url(); ?>login_controller/login_user" name="" method="post" id="formlogin">

							<div class="form-group">
							    <label for="username">USUARIO</label>
							    <input type="text" class="form-control" id="username" name="username"
							           placeholder="Introduce tu usuario">
						  	</div>

						  	<div class="form-group">
							    <label for="password">PASSWORD</label>
							    <input type="password" class="form-control" id="password" name="password"
							           placeholder="Introduce tu contraseña">
						  	</div>

						  	<div class="form-group">
							  	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="form-control">
							    
							</div>

							<button type="submit" name="btn_ingresar" id="btn_ingresar" class="btn btn-primary btn-lg btn-block">Ingresar</button>
						

						</form>
						

					</div>
					
				</div>

			</div>

		</div>

	</div>

	



</body>
</html>
