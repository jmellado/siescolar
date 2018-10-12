	<style type="text/css">
	    
	    label.error{color:red;}
	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/cuenta.js" defer></script>
<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-expeditedssl'></i>&nbsp;CAMBIAR CONTRASEÑA</h1>
        </div>
    </div>

    <div class="row">
    	<div class="panel panel-default">
    		<div class="panel-body">
    			<div class="row">
    				
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-body">
								<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>cuenta_controller/cambiar_password" name="" method="post" id="form_cambiarpassword">

									<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $this->session->userdata('id_usuario')?>">

									<div class="form-group">
										<label class="control-label col-sm-4" for="password">ACTUAL CONTRASEÑA</label>
										<div class="col-sm-7">
											<input type="password" class="form-control" id="actual_password" name="actual_password">
										</div>	
									</div>

									<div class="form-group">
										<label class="control-label col-sm-4" for="identificacion">NUEVA CONTRASEÑA</label>
										<div class="col-sm-7">
											<input type="password" class="form-control" id="nueva_password" name="nueva_password">
										</div>	
									</div>

									<div class="form-group">
										<label class="control-label col-sm-4" for="identificacion">CONFIRMAR NUEVA CONTRASEÑA</label>
										<div class="col-sm-7">
											<input type="password" class="form-control" id="confirmar_password" name="confirmar_password">
										</div>	
									</div>

									<div class="form-group">
										<div class="col-sm-offset-4 col-sm-7">
								    		<button type="submit" name="btn_cambiar_password" id="btn_cambiar_password" class="btn btn-primary btn-lg btn-block">Cambiar Contraseña</button>
								    	</div>
									</div>	
									
								</form>
							</div>
						</div>		
					</div>

				</div>		
    		</div>
    	</div>	
    </div>	

</div>    