	<style type="text/css">
	    
	    label.error{color:red;}

		.table-responsive
		{
			height: 300px;
		    overflow-y: auto;

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
                <!--<div class="panel-heading"></div>-->
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

					        		
									<input type="hidden" class="form-control" id="id_persona" name="id_persona">
									

									<div class="col-md-4">
						        		<div class="form-group">
											<label for="nombres">NOMBRES</label>
											<input type="text" class="form-control" id="nombres" name="nombres"
												 placeholder="Nombres" disabled> 
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="apellido1">PRIMER APELLIDO</label>
											<input type="text" class="form-control" id="apellido1" name="apellido1"
												 placeholder="Primer Apellido" disabled>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="apellido2">SEGUNDO APELLIDO</label>
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
			        				<div class="col-md-offset-1 col-md-3">
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

									<div class="col-md-4">
										<div class="form-group">
											<label for="id_curso">CURSO</label>
											<div id="cursos_logrosAL1">
												<select class="form-control" id="id_cursoAL" name="id_curso" disabled>
															    
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
								<button type="button" name="btn_ingresar_logro" id="btn_ingresar_logro" class="btn btn-primary btn-lg btn-block btn-flat" disabled>Asignar</button>
							</div>
							
	        			</div>

        			</form>

                </div>
            </div>



    	</div>

    	
    </div>

    <div id="div-asignar_logros" class="row" style="display:none;">
    <form role="form" action="<?php echo base_url(); ?>asignar_logros_controller/insertar" name="" method="post" id="form_logrosAL_insertar">

    	<div class="col-md-12">
	    	<div class="panel panel-default">
		    	<div class="panel-body">
		    		<div class="row">

		    			<div class="col-md-4">
				    		<div class="panel panel-default">
					    		<div class="panel-heading"><i class='fa fa-check-square'></i>&nbsp;Seleccionar Estudiante:</div>
					    			<div class="panel-body">
    	
										<div class="form-group">
											<input type="hidden" class="form-control" id="periodoseleAL" name="periodo">
										</div>
										<div class="form-group">
											<input type="hidden" class="form-control" id="id_cursoseleAL" name="id_curso">
										</div>
										<div class="form-group">
											<input type="hidden" class="form-control" id="id_asignaturaseleAL" name="id_asignatura">
										</div>

										<div class="form-group">
											<label for="id_estudiante">Estudiantes:</label>
											<div id="estudiantesAL1">
												<select class="form-control" id="id_estudianteAL" name="id_persona" size="8">
															    
												</select>
											</div>
										</div>

										<div class="form-group">
											<label for="calificacion">Calificación</label>
											<input type="text" class="form-control" id="calificacion" name="calificacion" readonly>
										</div>

									</div>
								
							</div>
						</div>				

				    	<div class="col-md-8">
				    		<div class="panel panel-default">
				    			<div class="panel-heading"><i class='fa fa-check-square'></i>&nbsp;Seleccionar Logros:</div>
				    				<div class="panel-body">

										<div class="table-responsive">
										<table border='1' id="lista_logrosAL" class="table table-bordered table-condensed table-hover table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th>Seleccionar</th>
													<th>Código</th>
													<th>Logro</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
										</div>

				    				</div>

				    		</div>
				    	</div>

				    	<div class="col-sm-offset-9 col-sm-3">
							<div class="form-group">
								<button type="submit" name="btn_registrar_logroAL" id="btn_registrar_logroAL" class="btn btn-success btn-flat btn-lg btn-block">Registrar</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

    </form>
    </div>
    
</div>