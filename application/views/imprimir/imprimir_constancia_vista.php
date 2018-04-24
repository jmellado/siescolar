<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-print'></i>&nbsp;IMPRESIÓN DE CONSTANCIAS</h1>
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
						            <input type="text" class="form-control" id="identificacionC" name="identificacionC" placeholder="Identificación Estudiante" onkeypress="return validaC(event)">
						                <span class="input-group-btn">
						                    <button class="btn btn-primary" type="button" name="btn_buscar_estudiante" id="btn_buscar_estudianteC">
						                        <i class="fa fa-search"></i>
						                    </button>
						                </span>
						        </div>
						    </div>
					    </div>
					</div>

					<form role="form" action="<?php echo base_url(); ?>imprimir_controller/generar_constancia" name="" method="post" id="form_constancias">

						<div class="col-md-12">

							<div class="panel panel-default">
	                			<div class="panel-body">

	                				<input type="hidden" class="form-control" id="id_personaC" name="id_persona">

	                				<div class="col-md-4">
		                				<div class="form-group">
							        		<label for="nombres">NOMBRES</label>
											<input type="text" class="form-control" id="nombresC" name="nombres" placeholder="Nombres" disabled>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="apellido1">1° APELLIDO</label>
											<input type="text" class="form-control" id="apellido1C" name="apellido1" placeholder="Primer Apellido" disabled>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="apellido2">2° APELLIDO</label>
											<input type="text" class="form-control" id="apellido2C" name="apellido2" placeholder="Segundo Apellido" disabled>
										</div>
									</div>

	                			</div>
	                		</div>

						</div>

						<div class="col-sm-offset-9 col-sm-3">

	        				<div class="form-group">
								<button type="button" name="btn_generar_constancia" id="btn_generar_constancia" class="btn btn-primary btn-lg btn-block" disabled>Generar</button>
							</div>
							
	        			</div>		

					</form> 

    			</div>

    		</div>	
    	</div>
    </div>


</div>