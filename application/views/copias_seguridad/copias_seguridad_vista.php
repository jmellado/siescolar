<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-database'></i>&nbsp;COPIA DE SEGURIDAD</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
	    	<div class="panel panel-default">
	            <div class="panel-body">

	            	<div class="col-md-12">
			    		<div class="callout callout-info">
			            	<h4>Informacíon Importante!</h4>

			                <p>A Continuación Podra Generar Una Copia De Seguridad De La Base De Datos Del Sistema.</p>
			            </div>
			    	</div>

			    	<div class="col-md-12">
			    		<form role="form" action="<?php echo base_url(); ?>copias_seguridad_controller/generar" name="" method="post" id="form_copias_seguridad">

			    			<div class="col-sm-offset-4 col-sm-4">
								<button type="submit" name="btn_generar_copias_seguridad" id="btn_generar_copias_seguridad" class="btn btn-success btn-lg btn-block"><i class='fa fa-check-square'></i>&nbsp;Generar Copia</button>
							</div>

			    		</form>

			    	</div>	

	            </div>
	        </div>
	    </div>    	
    </div>

</div>

