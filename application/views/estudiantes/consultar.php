
	<style type="text/css">
	    
	    label.error{color:red;}

	    #myModal .modal-body
		{
  			height:490px;
  			overflow:auto;
		}
	</style>


<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-group'></i>&nbsp;CONSULTAR ESTUDIANTES</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-offset-5 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="id_buscar" name="id_buscar"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar" id="btn_buscar" class="btn btn-primary">
							<i class="fa fa-search"></i>
						</button>
					</span>
    			</div>
    		</div>	
    	</div>
    </div>

  	<div class="row">
    	<div class="col-md-12">
    		<div class="box">
    			<div class="box-header with-border"><div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Estudiantes</div></div>
    				<div class="box-body">

    					<div class="form-group">
						  <label for="cantidad">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad" name="cantidad" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_estudiantes" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-newspaper-o'></i>&nbsp;Identificacion</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Nombres</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;1° Apellido</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;2° Apellido</th>
									<th><i class='fa fa-intersex'></i>&nbsp;Sexo</th>
									<th><i class='fa fa-calendar-o'></i>&nbsp;Fecha Nacimiento</th>
									<th><i class='fa fa-phone-square'></i>&nbsp;Telefono</th>
									<th><i class='fa fa-envelope'></i>&nbsp;Correo</th>
									<th><i class='fa fa-map'></i>&nbsp;Direccion</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>

</div>




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" id="tamano">

    <!-- Modal content-->
    <div class="modal-content">
    	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
        	<h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;<b>ACTUALIZAR INFORMACIÓN</b></h4>
    	</div>
      	<div class="modal-body">

      		<div class="row">
    			<div class="col-md-12">
      				<form class="form-horizontal" role="form" name="" method="post" id="form_estudiantes_actualizar">
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

							                    	<input type="hidden" class="form-control" id="id_personasele" name="id_persona">

							                    	<div class="form-group">
												    	<label class="control-label col-md-4" for="identificacion">IDENTIFICACIÓN</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="idsele" name="identificacion"
												           placeholder="Identificación">
												        </div>   
												  	</div>

												  	<div class="form-group">
													  	<label class="control-label col-md-4" for="tipo_id">TIPO DE IDENTIFICACIÓN:</label>
													  	<div class="col-md-3">
														  	<select class="form-control" id="tipo_idsele" name="tipo_id">
															    <option value="rc">RC</option>
																<option value="ti">TI</option>
																<option value="cc">CC</option>
																<option value="ce">CE</option>
														  	</select>
														</div>  	
													</div>

													<div class="form-group">
												    	<label class="control-label col-md-4" for="fecha_expedicion">FECHA DE EXPEDICIÓN</label>
												    	<div class="col-md-7">
												    		<input type="date" class="form-control" id="fecha_expedicionsele" name="fecha_expedicion">
												    	</div>	
												  	</div>

												  	<div class="form-group">
									  					<label class="control-label col-md-4" for="departamento_expedicion">DPTO. DE EXPEDICIÓN</label>
									  					<div class="col-md-7">
										  					<div id="departamento_expedicion1">
										  						<select class="form-control" id="departamento_expedicionsele" name="departamento_expedicion">
										    
										  						</select>
										  					</div>
										  				</div>	
													</div>

													<div class="form-group">
													 	<label class="control-label col-md-4" for="municipio_expedicion">MUNICIPIO DE EXPEDICIÓN</label>
													 	<div class="col-md-7">
														 	<div id="municipio_expedicion1">
																<select class="form-control" id="municipio_expedicionsele" name="municipio_expedicion">
															    
																</select>
															</div>
														</div>	
													</div>
							                    </div>
							                </div>
							                <div class="panel panel-default">
							                    <div class="panel-body">

							                    	<div class="form-group">
												    	<label class="control-label col-md-4" for="nombres">NOMBRES</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="nombressele" name="nombres"
												           placeholder="Nombres">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="apellido1">1° APELLIDO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="apellido1sele" name="apellido1"
												           placeholder="Primer apellido">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="apellido2">2° APELLIDO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="apellido2sele" name="apellido2"
												           placeholder="Segundo apellido">
												        </div>   
												  	</div>

												  	<div class="form-group">
														<label class="control-label col-md-4" for="sexo">SEXO:</label>
														<div class="col-md-5">
															<select class="form-control" id="sexosele" name="sexo">
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
												    	<label class="control-label col-md-4" for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
												    	<div class="col-md-7">
												    		<input type="date" class="form-control" id="fecha_nacimientosele" name="fecha_nacimiento">
												    	</div>	
												  	</div>

												  	<div class="form-group">
									  					<label class="control-label col-md-4" for="departamento_nacimiento">DPTO. DE NACIMIENTO</label>
									  					<div class="col-md-7">
										  					<div id="departamento_nacimiento1">
										  						<select class="form-control" id="departamento_nacimientosele" name="departamento_nacimiento">
										    
										  						</select>
										  					</div>
										  				</div>		
													</div>

													<div class="form-group">
													 	<label class="control-label col-md-4" for="municipio_nacimiento">MUNICIPIO DE NACIMIENTO</label>
													 	<div class="col-md-7">
														 	<div id="municipio_nacimiento1">
																<select class="form-control" id="municipio_nacimientosele" name="municipio_nacimiento">
															    
																</select>
															</div>
														</div>		
													</div>
												</div>
											</div>

											<div class="panel panel-default">
							                    <div class="panel-body">		

													<div class="form-group">
														<label class="control-label col-md-4" for="tipo_sangre">TIPO DE SANGRE:</label>
														<div class="col-md-3">
															<select class="form-control" id="tipo_sangresele" name="tipo_sangre">
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
													 	<label class="control-label col-md-4" for="eps">EPS</label>
													 	<div class="col-md-7">
															<input type="text" class="form-control" id="epssele" name="eps" placeholder="Eps">
														</div>	
													</div>

													<div class="form-group">
														<label class="control-label col-md-4" for="poblacion">POBLACIÓN</label>
														<div class="col-md-7">
															<select class="form-control" id="poblacionsele" name="poblacion">
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
														<label class="control-label col-md-4" for="discapacidad">DISCAPACIDAD</label>
														<div class="col-md-7">
															<select class="form-control" id="discapacidadsele" name="discapacidad">
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
												    	<label class="control-label col-md-4" for="telefono">TELÉFONO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="telefonosele" name="telefono"
												           placeholder="Teléfono">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="correo">CORREO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="correosele" name="correo"
												           placeholder="Correo">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="direccion">DIRECCIÓN</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="direccionsele" name="direccion"
												           placeholder="Dirección">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="barrio">BARRIO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="barriosele" name="barrio"
												           placeholder="Barrio">
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

							                    	<input type="hidden" class="form-control" id="id_padresele" name="id_padre">

							                    	<div class="form-group">
												    	<label class="control-label col-md-4" for="identificacion_padre">IDENTIFICACIÓN</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="identificacion_padresele" name="identificacion_padre"
												           placeholder="Identificación del padre">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="nombres_padre">NOMBRES</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="nombres_padresele" name="nombres_padre"
												           placeholder="Nombres">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="apellido1_padre">1° APELLIDO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="apellido1_padresele" name="apellido1_padre"
												           placeholder="Primer Apellido">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="apellido2_padre">2° APELLIDO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="apellido2_padresele" name="apellido2_padre"
												           placeholder="Segundo Apellido">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="telefono_padre">TELÉFONO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="telefono_padresele" name="telefono_padre"
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
												    	<label class="control-label col-md-4" for="direccion_padre">DIRECCIÓN</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="direccion_padresele" name="direccion_padre"
												           placeholder="Dirección">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="barrio_padre">BARRIO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="barrio_padresele" name="barrio_padre"
												           placeholder="Barrio">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="ocupacion_padre">OCUPACIÓN</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="ocupacion_padresele" name="ocupacion_padre"
												           placeholder="Ocupación">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="telefono_trabajo_padre">TELÉFONO TRABAJO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="telefono_trabajo_padresele" name="telefono_trabajo_padre"
												           placeholder="Teléfono Trabajo">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="direccion_trabajo_padre">DIRECCIÓN TRABAJO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="direccion_trabajo_padresele" name="direccion_trabajo_padre"
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

							                    	<input type="hidden" class="form-control" id="id_madresele" name="id_madre">

							                    	<div class="form-group">
												    	<label class="control-label col-md-4" for="identificacion_madre">IDENTIFICACIÓN</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="identificacion_madresele" name="identificacion_madre"
												           placeholder="Identificación de la madre">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="nombres_madre">NOMBRES</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="nombres_madresele" name="nombres_madre"
												           placeholder="Nombres">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="apellido1_madre">1° APELLIDO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="apellido1_madresele" name="apellido1_madre"
												           placeholder="Primer Apellido">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="apellido2_madre">2° APELLIDO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="apellido2_madresele" name="apellido2_madre"
												           placeholder="Segundo Apellido">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="telefono_madre">TELÉFONO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="telefono_madresele" name="telefono_madre"
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
												    	<label class="control-label col-md-4" for="direccion_madre">DIRECCIÓN</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="direccion_madresele" name="direccion_madre"
												           placeholder="Dirección">
												        </div>
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="barrio_madre">BARRIO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="barrio_madresele" name="barrio_madre"
												           placeholder="Barrio">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="ocupacion_madre">OCUPACIÓN</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="ocupacion_madresele" name="ocupacion_madre"
												           placeholder="Ocupación">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="telefono_trabajo_madre">TELÉFONO TRABAJO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="telefono_trabajo_madresele" name="telefono_trabajo_madre"
												           placeholder="Teléfono Trabajo">
												        </div>   
												  	</div>

												  	<div class="form-group">
												    	<label class="control-label col-md-4" for="direccion_trabajo_madre">DIRECCIÓN TRABAJO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="direccion_trabajo_madresele" name="direccion_trabajo_madre"
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
												    	<label class="control-label col-md-4" for="institucion_procedencia">I.E. DE PROCEDENCIA</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="institucion_procedenciasele" name="institucion_procedencia"
												           placeholder="Institución Procedencia">
												        </div>   
												  	</div>

												  	<div class="form-group">
													  	<label class="control-label col-md-4" for="grado_cursado">GRADO CURSADO</label>
													  	<div class="col-md-5">
														  	<select class="form-control" id="grado_cursadosele" name="grado_cursado">
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
												    	<label class="control-label col-md-4" for="anio">AÑO</label>
												    	<div class="col-md-7">
												    		<input type="text" class="form-control" id="aniosele" name="anio"
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

						
					</form>
				</div>
			</div>		

			<div class="row">
				<div class="col-md-offset-4 col-md-4">
					<div class="form-group">
						<button type="submit" name="btn_actualizar" id="btn_actualizar" class="btn btn-primary btn-lg btn-block">Actualizar</button>
					</div>
				</div>
			</div>			
			
      	</div>
      	<div class="modal-footer">
        	<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      	</div>
    </div>

  </div>
</div>