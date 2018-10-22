
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
		              <li class="active"><a href="#tab_1" data-toggle="tab"><i class='fa fa-newspaper-o'></i>&nbsp;Datos Personales</a></li>
		              <li><a href="#tab_2" data-toggle="tab"><i class='fa fa-location-arrow'></i>&nbsp;Datos De Contacto</a></li>
		              <li><a href="#tab_3" data-toggle="tab"><i class='fa fa-male'></i>&nbsp;Datos Del Padre</a></li>
		              <li><a href="#tab_4" data-toggle="tab"><i class='fa fa-female'></i>&nbsp;Datos De La Madre</a></li>
		              <li><a href="#tab_5" data-toggle="tab"><i class='fa fa-graduation-cap'></i>&nbsp;Datos Académicos</a></li>
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
							  					<label class="control-label col-md-3" for="pais_expedicion">PAIS DE EXPEDICIÓN</label>
							  					<div class="col-md-7">
								  					<div id="pais_expedicion1">
								  						<select class="form-control" id="pais_expedicion" name="pais_expedicion">
								    
								  						</select>
								  					</div>
								  				</div>		
											</div>

										  	<div class="form-group">
							  					<label class="control-label col-md-3" for="departamento_expedicion">DPTO. DE EXPEDICIÓN</label>
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
												<label class="control-label col-md-3" for="sexo">SEXO</label>
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
							  					<label class="control-label col-md-3" for="pais_nacimiento">PAIS DE NACIMIENTO</label>
							  					<div class="col-md-7">
								  					<div id="pais_nacimiento1">
								  						<select class="form-control" id="pais_nacimiento" name="pais_nacimiento">
								    
								  						</select>
								  					</div>
								  				</div>		
											</div>

										  	<div class="form-group">
							  					<label class="control-label col-md-3" for="departamento_nacimiento">DPTO. DE NACIMIENTO</label>
							  					<div class="col-md-7">
								  					<div id="departamento_nacimiento1">
								  						<select class="form-control" id="departamento_nacimiento" name="departamento_nacimiento">
								    
								  						</select>
								  					</div>
								  				</div>		
											</div>

											<div class="form-group">
											 	<label class="control-label col-md-3" for="municipio_nacimiento">MUNICIPIO DE NACIMIENTO</label>
											 	<div class="col-md-7">
												 	<div id="municipio_nacimiento1">
														<select class="form-control" id="municipio_nacimiento" name="municipio_nacimiento">
													    
														</select>
													</div>
												</div>	
											</div>
					                    </div>
					                </div> 

					                <div class="panel panel-default">
					                    <div class="panel-body">

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
													<select class="form-control" id="poblacion" name="poblacion">
														<option value="Ninguna">Ninguna</option>
														<option value="Indigena">Indigena</option>
									  					<option value="Desplazados Por Fenomenos Naturales">Desplazados Por Fenomenos Naturales</option>
									  					<option value="Desplazados Por Violencia">Desplazados Por Violencia</option>
									  					<option value="Negritudes">Negritudes</option>
									  					<option value="Otra">Otra</option>
													 </select>
												</div>	
											</div>

											<div class="form-group">
												<label class="control-label col-md-3" for="discapacidad">DISCAPACIDAD</label>
												<div class="col-md-7">
													<select class="form-control" id="discapacidad" name="discapacidad">
														<option value="Ninguna">Ninguna</option>
														<option value="Cognitiva O Mental">Cognitiva O Mental</option>
														<option value="Limitación Auditiva O Sorda">Limitación Auditiva O Sorda</option>
														<option value="Limitación Fisica O Motora">Limitación Fisica O Motora</option>
														<option value="Limitación Visual O Ciega">Limitación Visual O Ciega</option>
														<option value="Limitación Vocal O Muda">Limitación Vocal O Muda</option>
									  					<option value="Otra">Otra</option>
													 </select>
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
							  					<label class="control-label col-md-3" for="pais_residencia">PAIS DE RESIDENCIA</label>
							  					<div class="col-md-7">
								  					<div id="pais_residencia1">
								  						<select class="form-control" id="pais_residencia" name="pais_residencia">
								    
								  						</select>
								  					</div>
								  				</div>		
											</div>

										  	<div class="form-group">
							  					<label class="control-label col-md-3" for="departamento_residencia">DPTO. DE RESIDENCIA</label>
							  					<div class="col-md-7">
								  					<div id="departamento_residencia1">
								  						<select class="form-control" id="departamento_residencia" name="departamento_residencia">
								    
								  						</select>
								  					</div>
								  				</div>		
											</div>

											<div class="form-group">
											 	<label class="control-label col-md-3" for="municipio_residencia">MUNICIPIO DE RESIDENCIA</label>
											 	<div class="col-md-7">
												 	<div id="municipio_residencia1">
														<select class="form-control" id="municipio_residencia" name="municipio_residencia">
													    
														</select>
													</div>
												</div>	
											</div>

											<div class="form-group">
												<label class="control-label col-md-3" for="estrato">ESTRATO</label>
												<div class="col-md-4">
													<select class="form-control" id="estrato" name="estrato">
														<option value=""></option>
														<option value="1">Uno</option>
									  					<option value="2">Dos</option>
									  					<option value="3">Tres</option>
									  					<option value="4">Cuatro</option>
									  					<option value="5">Cinco</option>
									  					<option value="6">Seis</option>
									  					<option value="7">Siete</option>
									  					<option value="0">No Estratificado</option>
													 </select>
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
										    	<label class="control-label col-md-3" for="identificacion_padre">IDENTIFICACIÓN</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="identificacion_padre" name="identificacion_padre"
										           placeholder="Identificación del padre">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="nombres_padre">NOMBRES</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="nombres_padre" name="nombres_padre"
										           placeholder="Nombres">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="apellido1_padre">1° APELLIDO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="apellido1_padre" name="apellido1_padre"
										           placeholder="Primer Apellido">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="apellido2_padre">2° APELLIDO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="apellido2_padre" name="apellido2_padre"
										           placeholder="Segundo Apellido">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="telefono_padre">TELÉFONO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="telefono_padre" name="telefono_padre"
										           placeholder="Teléfono">
										        </div>   
										  	</div>

										  	
					                    </div>
					                </div>
					            </div>

					            <div class="col-md-6">
					                <div class="panel panel-default">
					                    <div class="panel-body">

					                    	<div class="form-group">
										    	<label class="control-label col-md-3" for="direccion_padre">DIRECCIÓN</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="direccion_padre" name="direccion_padre"
										           placeholder="Dirección">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="barrio_padre">BARRIO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="barrio_padre" name="barrio_padre"
										           placeholder="Barrio">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="ocupacion_padre">OCUPACIÓN</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="ocupacion_padre" name="ocupacion_padre"
										           placeholder="Ocupación">
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

				            </div>

						</div>

						<div class="tab-pane" id="tab_4">
							
							<div class="row">
								<div class="col-md-6">
					                <div class="panel panel-default">
					                    <div class="panel-body">

					                    	<div class="form-group">
										    	<label class="control-label col-md-3" for="identificacion_madre">IDENTIFICACIÓN</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="identificacion_madre" name="identificacion_madre"
										           placeholder="Identificación de la madre">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="nombres_madre">NOMBRES</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="nombres_madre" name="nombres_madre"
										           placeholder="Nombres">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="apellido1_madre">1° APELLIDO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="apellido1_madre" name="apellido1_madre"
										           placeholder="Primer Apellido">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="apellido2_madre">2° APELLIDO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="apellido2_madre" name="apellido2_madre"
										           placeholder="Segundo Apellido">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="telefono_madre">TELÉFONO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="telefono_madre" name="telefono_madre"
										           placeholder="Teléfono">
										        </div>   
										  	</div>

					                    </div>
					                </div>
					            </div>

					            <div class="col-md-6">
					                <div class="panel panel-default">
					                    <div class="panel-body">

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="direccion_madre">DIRECCIÓN</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="direccion_madre" name="direccion_madre"
										           placeholder="Dirección">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="barrio_madre">BARRIO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="barrio_madre" name="barrio_madre"
										           placeholder="Barrio">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="ocupacion_madre">OCUPACIÓN</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="ocupacion_madre" name="ocupacion_madre"
										           placeholder="Ocupación">
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

						<div class="tab-pane" id="tab_5">
	              			
	              			<div class="row">
		              			
					            <div class="col-md-6">
					                <div class="panel panel-default">
					                    <div class="panel-body">

					                    	<div class="form-group">
										    	<label class="control-label col-md-3" for="institucion_procedencia">I.E. DE PROCEDENCIA</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="institucion_procedencia" name="institucion_procedencia"
										           placeholder="Institución Procedencia">
										        </div>   
										  	</div>

										  	<div class="form-group">
											  	<label class="control-label col-md-3" for="grado_cursado">GRADO CURSADO</label>
											  	<div class="col-md-7">
												  	<select class="form-control" id="grado_cursado" name="grado_cursado">
												  		<option value="Ninguno"></option>
													    <option value="Prejardín">Prejardín</option>
														<option value="Jardín">Jardín</option>
														<option value="Transición">Transición</option>
														<option value="Primero">Primero</option>
														<option value="Segundo">Segundo</option>
														<option value="Tercero">Tercero</option>
														<option value="Cuarto">Cuarto</option>
														<option value="Quinto">Quinto</option>
														<option value="Sexto">Sexto</option>
														<option value="Séptimo">Séptimo</option>
														<option value="Octavo">Octavo</option>
														<option value="Noveno">Noveno</option>
														<option value="Décimo">Décimo</option>
														<option value="Undécimo">Undécimo</option>
												  	</select>
												</div>  	
											</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-3" for="anio">AÑO</label>
										    	<div class="col-md-4">
										    		<input type="text" class="form-control" id="anio" name="anio"
										           placeholder="Año">
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

    
