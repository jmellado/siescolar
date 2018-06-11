<style type="text/css">
	    
	label.error{color:red;}
</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-print'></i>&nbsp;IMPRESIÓN DE CERTIFICADOS</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">

    			<div class="panel-body">

    				<div class="row">
				      	<div class="col-sm-offset-4 col-sm-4">
				      		<div class="form-group">
						        <div class="input-group custom-search-form">
						            <input type="text" class="form-control" id="identificacionCT" name="identificacionCT" placeholder="Identificación Estudiante" onkeypress="return validaCT(event)">
						                <span class="input-group-btn">
						                    <button class="btn btn-primary" type="button" name="btn_buscar_estudiante" id="btn_buscar_estudianteCT">
						                        <i class="fa fa-search"></i>
						                    </button>
						                </span>
						        </div>
						    </div>
					    </div>
					</div>

					<form role="form" action="<?php echo base_url(); ?>imprimir_controller/generar_certificado" name="" method="post" id="form_certificados">

						<div class="col-md-12">

							<div class="panel panel-default">
	                			<div class="panel-body">

	                				<input type="hidden" class="form-control" id="id_personaCT" name="id_persona">

	                				<div class="col-md-3">
		                				<div class="form-group">
							        		<label for="nombres">NOMBRES</label>
											<input type="text" class="form-control" id="nombresCT" name="nombres" placeholder="Nombres" disabled>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="apellido1">1° APELLIDO</label>
											<input type="text" class="form-control" id="apellido1CT" name="apellido1" placeholder="Primer Apellido" disabled>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="apellido2">2° APELLIDO</label>
											<input type="text" class="form-control" id="apellido2CT" name="apellido2" placeholder="Segundo Apellido" disabled>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="ano_lectivo">AÑO LECTIVO</label>
											<div id="ano_lectivoCT1">
												<select class="form-control" id="ano_lectivoCT" name="ano_lectivo" disabled>
																    
												</select>
											</div>
										</div>
									</div>

	                			</div>
	                		</div>

						</div>

						<div class="col-sm-offset-9 col-sm-3">

	        				<div class="form-group">
								<button type="button" name="btn_generar_certificado" id="btn_generar_certificado" class="btn btn-primary btn-lg btn-block" disabled>Generar</button>
							</div>
							
	        			</div>		

					</form> 

    			</div>

    		</div>	
    	</div>
    </div>


</div>