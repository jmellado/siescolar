	<style type="text/css">
	    
	    label.error{color:red;}

	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-check-square'></i>&nbsp;ELECCIONES ESTUDIANTILES</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
	    		<div class="panel-body">
    	
			    	<div class="col-md-4">
			    		<img src="<?php echo base_url();?>uploads/imagenes/colegio/escudo.png" alt="Escudo Institución" class="img-circle img-responsive" style="width: 300px; height: 300px; text-align: center;">
			    	</div>

			    	<div class="col-md-6">
			    		<div class="panel panel-default">
			    			<div class="panel-body">

			    				<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>elecciones_controller/insertar_candidato" name="" method="post" id="form_ingresar_eleccion">

									<div class="form-group">
										<label class="control-label col-sm-4" for="codigo_eleccion">CÓDIGO DE INGRESO</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" id="codigo_eleccion" name="codigo_eleccion"
												 placeholder="Ingresar Código">
										</div>	
									</div>

									<div class="form-group">
										<div class="col-sm-offset-4 col-sm-5">
											<button type="submit" name="btn_ingresar_eleccion" id="btn_ingresar_eleccion" class="btn btn-primary btn-lg btn-block"><i class='fa fa-check-square-o'></i>&nbsp;Ingresar</button>
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