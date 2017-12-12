
	<style type="text/css">
	    
	    label.error{color:red;}

	</style>

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-group'></i>&nbsp;REGISTRO DE ESTUDIANTES</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">

    		<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>estudiantes_controller/insertar" name="" method="post" id="form_estudiantes">

	    		<div class="nav-tabs-custom">

		            <ul class="nav nav-tabs">
		              <li class="active"><a href="#tab_1" data-toggle="tab">Datos Personales</a></li>
		              <li><a href="#tab_2" data-toggle="tab">Datos De Contacto</a></li>
		              <li><a href="#tab_3" data-toggle="tab">Datos De Los Padres</a></li>
		              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
		            </ul>


		            <!--CONTENIDO DE LOS TABS-->
		            <div class="tab-content">
	              		<div class="tab-pane active" id="tab_1">
	              			
	              			<div class="row">

		              			<div class="col-md-6">
					                <div class="panel panel-default">
					                    <div class="panel-body">

					                    	<div class="form-group">
										    	<label class="control-label col-md-3" for="identificacion">IDENTIFICACIÓN</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="identificacion" name="identificacion"
										           placeholder="Identificación">
										        </div>   
										  	</div>

										  	<div class="form-group">
											  	<label class="control-label col-md-3" for="tipo_id">TIPO DE IDENTIFICACIÓN</label>
											  	<div class="col-md-3">
												  	<select class="form-control" id="tipo_id" name="tipo_id">
													    <option value="rc">RC</option>
														<option value="ti">TI</option>
														<option value="cc">CC</option>
														<option value="ce">CE</option>
												  	</select>
												</div>  	
											</div>

											<div class="form-group">
										    	<label class="control-label col-md-3" for="fecha_expedicion">FECHA DE EXPEDICIÓN</label>
										    	<div class="col-md-7">
										    		<input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion">
										    	</div>	
										  	</div>

										  	<div class="form-group">
							  					<label class="control-label col-md-3" for="departamento_expedicion">DEPARTAMENTO DE EXPEDICIÓN</label>
							  					<div class="col-md-7">
								  					<div id="departamento_expedicion1">
								  						<select class="form-control" id="departamento_expedicion" name="departamento_expedicion">
								    
								  						</select>
								  					</div>
								  				</div>		
											</div>

											<div class="form-group">
											 	<label class="control-label col-md-3" for="municipio_expedicion">MUNICIPIO DE EXPEDICIÓN</label>
											 	<div class="col-md-7">
												 	<div id="municipio_expedicion1">
														<select class="form-control" id="municipio_expedicion" name="municipio_expedicion">
													    
														</select>
													</div>
												</div>	
											</div>
					                    </div>
					                </div>

					                <div class="panel panel-default">
					                    <div class="panel-body">

					                    	<div class="form-group">
										    	<label class="control-label col-md-3" for="nombres">NOMBRES</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="nombres" name="nombres"
										           placeholder="Nombres">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="apellido1">1° APELLIDO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="apellido1" name="apellido1"
										           placeholder="Primer apellido">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="apellido2">2° APELLIDO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="apellido2" name="apellido2"
										           placeholder="Segundo apellido">
										        </div>   
										  	</div>

										  	<div class="form-group">
												<label class="control-label col-md-3" for="sexo">SEXO:</label>
												<div class="col-md-4">
													 <select class="form-control" id="sexo" name="sexo">
													 	<option value="m">Masculino</option>
									  				 	<option value="f">Femenino</option>
													 </select>
												</div>		 
										   	</div>
					                    </div>
					                </div>
					            </div>
					            
					            <div class="col-md-6">
					            	<div class="panel panel-default">
					                    <div class="panel-body">

					                    	<div class="form-group">
										    	<label class="control-label col-md-3" for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
										    	<div class="col-md-7">
										    		<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
										    	</div>	
										  	</div>

										  	<div class="form-group">
											 	<label class="control-label col-md-3" for="lugar_nacimiento">LUGAR DE NACIMIENTO</label>
											 	<div class="col-md-7">
											 		<input type="text" class="form-control" id="lugar_nacimiento" name="lugar_nacimiento" placeholder="Lugar de Nacimiento">
											 	</div>	
											</div>

											<div class="form-group">
												<label class="control-label col-md-3" for="tipo_sangre">TIPO DE SANGRE:</label>
												<div class="col-md-3">
													<select class="form-control" id="tipo_sangre" name="tipo_sangre">
														<option value="o+">O+</option>
									  					<option value="o-">O-</option>
									  					<option value="a+">A+</option>
									  					<option value="a-">A-</option>
									  					<option value="b+">B+</option>
									  					<option value="b-">B-</option>
													 </select>
												</div>		 
											</div>

											<div class="form-group">
											 	<label class="control-label col-md-3" for="eps">EPS</label>
											 	<div class="col-md-7">
													<input type="text" class="form-control" id="eps" name="eps" placeholder="Eps">
												</div>	
											</div>

											<div class="form-group">
												<label class="control-label col-md-3" for="poblacion">POBLACIÓN</label>
												<div class="col-md-7">
													<input type="text" class="form-control" id="poblacion" name="poblacion" placeholder="Población">
												</div>	
											</div>
					                    </div>
					                </div>    
					            </div>

				            </div>        
	              		</div>

	              		<div class="tab-pane" id="tab_2">
	              			
	              			<div class="row">
		              			<div class="col-md-6">
					                <div class="panel panel-default">
					                    <div class="panel-body">

					                    	<div class="form-group">
										    	<label class="control-label col-md-3" for="telefono">TELÉFONO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="telefono" name="telefono"
										           placeholder="Teléfono">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="correo">CORREO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="correo" name="correo"
										           placeholder="Correo">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="direccion">DIRECCIÓN</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="direccion" name="direccion"
										           placeholder="Dirección">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="barrio">BARRIO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="barrio" name="barrio"
										           placeholder="Barrio">
										        </div>   
										  	</div>
					                    </div>
					                </div> 
					            </div>

					            <div class="col-md-6">
					                <div class="panel panel-default">
					                    <div class="panel-body">

					                    	<div class="form-group">
										    	<label class="control-label col-md-3" for="institucion_procedencia">INSTITUCIÓN DE PROCEDENCIA</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="institucion_procedencia" name="institucion_procedencia"
										           placeholder="Institución Procedencia">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="discapacidad">DISCAPACIDAD</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="discapacidad" name="discapacidad"
										           placeholder="Discapacidad">
										        </div>   
										  	</div>

					                    </div>
					                </div>
					            </div>

					        </div> 
					           
	              		</div>
						
						<div class="tab-pane" id="tab_3">
							
							<div class="row">
								<div class="col-md-6">
					                <div class="panel panel-default">
					                    <div class="panel-body">

					                    	<div class="form-group">
										    	<label class="control-label col-md-3" for="identificacion_padre">IDENTIFICACIÓN DEL PADRE</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="identificacion_padre" name="identificacion_padre"
										           placeholder="Identificación del padre">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="nombres_padre">NOMBRES DEL PADRE</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="nombres_padre" name="nombres_padre"
										           placeholder="Nombres">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="apellidos_padre">APELLIDOS DEL PADRE</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="apellidos_padre" name="apellidos_padre"
										           placeholder="Apellidos">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="ocupacion_padre">OCUPACIÓN DEL PADRE</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="ocupacion_padre" name="ocupacion_padre"
										           placeholder="Ocupación">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="telefono_padre">TELÉFONO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="telefono_padre" name="telefono_padre"
										           placeholder="Teléfono">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="telefono_trabajo_padre">TELÉFONO TRABAJO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="telefono_trabajo_padre" name="telefono_trabajo_padre"
										           placeholder="Teléfono Trabajo">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="direccion_trabajo_padre">DIRECCIÓN TRABAJO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="direccion_trabajo_padre" name="direccion_trabajo_padre"
										           placeholder="Dirección Trabajo">
										        </div>   
										  	</div>
					                    </div>
					                </div>
					            </div>

					            <div class="col-md-6">
					                <div class="panel panel-default">
					                    <div class="panel-body">

					                    	<div class="form-group">
										    	<label class="control-label col-md-3" for="identificacion_madre">IDENTIFICACIÓN DE LA MADRE</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="identificacion_madre" name="identificacion_madre"
										           placeholder="Identificación de la madre">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="nombres_madre">NOMBRES DE LA MADRE</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="nombres_madre" name="nombres_madre"
										           placeholder="Nombres">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="apellidos_madre">APELLIDOS DE LA MADRE</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="apellidos_madre" name="apellidos_madre"
										           placeholder="Apellidos">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="ocupacion_madre">OCUPACIÓN DE LA MADRE</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="ocupacion_madre" name="ocupacion_madre"
										           placeholder="Ocupación">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="telefono_madre">TELÉFONO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="telefono_madre" name="telefono_madre"
										           placeholder="Teléfono">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="telefono_trabajo_madre">TELÉFONO TRABAJO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="telefono_trabajo_madre" name="telefono_trabajo_madre"
										           placeholder="Teléfono Trabajo">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="direccion_trabajo_madre">DIRECCIÓN TRABAJO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="direccion_trabajo_madre" name="direccion_trabajo_madre"
										           placeholder="Dirección Trabajo">
										        </div>   
										  	</div>
					                    </div>
					                </div> 
					            </div>

				            </div>

						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-md-offset-4 col-md-3">
						<div class="form-group">
							<button type="submit" name="btn_registrar" id="btn_registrar" class="btn btn-primary btn-lg btn-block">Registrar</button>
						</div>
					</div>	
				</div>
			</form>			 

    	</div>
    </div>	
    		
</div>

    
