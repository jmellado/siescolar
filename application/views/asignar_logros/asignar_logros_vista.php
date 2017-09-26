	<style type="text/css">
	    
	    label.error{color:red;}

	    #modal_ingresar_nota .modal-body
		{
  			height:490px;
  			overflow:auto;
		}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ASIGNACIÓN DE LOGROS</h1>
        </div>
    </div>
    <input type="hidden" id="rol" name="rol" value="<?php echo $this->session->userdata('rol')?>">

    <div class="row">

    	<div class="col-md-12">

    		<div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">

                	<div class="col-sm-offset-4 col-sm-4">
						<div class="input-group custom-search-form">
							<input type="text" class="form-control" id="identificacion_profesorAL" name="identificacion_profesorAL" placeholder="Identificacion Profesor" onkeypress="return valida(event)">
			    				<span class="input-group-btn">
			        				<button class="btn btn-primary" type="button" name="btn_buscar_profesorAL" id="btn_buscar_profesorAL">
			            				<i class="fa fa-search"></i>
			            			</button>
			        			</span>
						</div>
					</div></br></br>

					<form role="form" action="<?php echo base_url(); ?>logros_controller/ingresar_notas" name="" method="post" id="form_asignar_logros">

						<div class="col-md-12">

							<div class="panel panel-default">
	                			<!--<div class="panel-heading"></div>-->
	                			<div class="panel-body">

					        		<div class="form-group">
										<input type="hidden" class="form-control" id="id_persona" name="id_persona">
									</div>

									<div class="col-md-4">
						        		<div class="form-group">
											<label for="nombres">NOMBRES</label>
											<input type="text" class="form-control" id="nombres" name="nombres"
												 placeholder="Nombres" disabled> 
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="apellido1">APELLIDO1</label>
											<input type="text" class="form-control" id="apellido1" name="apellido1"
												 placeholder="Primer Apellido" disabled>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="apellido2">APELLIDO2</label>
											<input type="text" class="form-control" id="apellido2" name="apellido2"
												 placeholder="Segundo Apellido" disabled>
										</div>
									</div>
								</div>
							</div>	

	        			</div>

	        			<div class="col-md-12">

	        				<div class="panel panel-default">
	        					<!--<div class="panel-heading"></div>-->
	                			<div class="panel-body">
			        				<div class="col-md-3">
				        				<div class="form-group">
											<label for="periodo">PERIODO</label>
												<select class="form-control" id="periodoAL" name="periodo" disabled>
													<option value="Primero">Primero</option>
													<option value="Segundo">Segundo</option>
													<option value="Tercero">Tercero</option>
													<option value="Cuarto">Cuarto</option>
												</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="id_grado">GRADO</label>
											<div id="grados_logrosAL1">
												<select class="form-control" id="id_gradoAL" name="id_grado" disabled>
															    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="id_grupo">GRUPO</label>
											<div id="grupos_logrosAL1">
												<select class="form-control" id="id_grupoAL" name="id_grupo" disabled>
															    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="id_asignatura">ASIGNATURA</label>
											<div id="asignaturas_logrosAL1">
												<select class="form-control" id="id_asignaturaAL" name="id_asignatura" disabled>
															    
												</select>
											</div>
										</div>
									</div>

								</div>
							</div>

	        			</div>

	        			<div class="col-sm-offset-9 col-sm-3">

	        				<div class="form-group">
								<button type="button" name="btn_ingresar_logro" id="btn_ingresar_logro" class="btn btn-primary btn-lg btn-block" disabled>Asignar</button>
							</div>
							
	        			</div>

        			</form>

                </div>
            </div>



    	</div>

    	
    </div>

</div>