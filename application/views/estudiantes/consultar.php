
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
      				<form role="form" name="" method="post" id="form_estudiantes_actualizar">
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

				              			<div class="col-md-4">
							                <div class="panel panel-default">
							                    <div class="panel-body">

							                    	<input type="hidden" class="form-control" id="id_personasele" name="id_persona">

							                    	<div class="form-group">
												    	<label for="identificacion">IDENTIFICACIÓN</label>
												    	<input type="text" class="form-control" id="idsele" name="identificacion"
												           placeholder="Identificación">
												  	</div>

												  	<div class="form-group">
													  	<label for="tipo_id">TIPO DE IDENTIFICACIÓN:</label>
													  	<select class="form-control" id="tipo_idsele" name="tipo_id">
														    <option value="rc">RC</option>
															<option value="ti">TI</option>
															<option value="cc">CC</option>
															<option value="ce">CE</option>
													  	</select>
													</div>

													<div class="form-group">
												    	<label for="fecha_expedicion">FECHA DE EXPEDICIÓN</label>
												    	<input type="date" class="form-control" id="fecha_expedicionsele" name="fecha_expedicion">
												  	</div>

												  	<div class="form-group">
									  					<label for="departamento_expedicion">DEPARTAMENTO DE EXPEDICIÓN</label>
									  					<div id="departamento_expedicion1">
									  						<select class="form-control" id="departamento_expedicionsele" name="departamento_expedicion">
									    
									  						</select>
									  					</div>
													</div>

													<div class="form-group">
													 	<label for="municipio_expedicion">MUNICIPIO DE EXPEDICIÓN</label>
													 	<div id="municipio_expedicion1">
															<select class="form-control" id="municipio_expedicionsele" name="municipio_expedicion">
														    
															</select>
														</div>
													</div>
							                    </div>
							                </div>
							            </div>    
							            <div class="col-md-4">
							                <div class="panel panel-default">
							                    <div class="panel-body">

							                    	<div class="form-group">
												    	<label for="nombres">NOMBRES</label>
												    	<input type="text" class="form-control" id="nombressele" name="nombres"
												           placeholder="Nombres">
												  	</div>

												  	<div class="form-group">
												    	<label for="apellido1">1° APELLIDO</label>
												    	<input type="text" class="form-control" id="apellido1sele" name="apellido1"
												           placeholder="Primer apellido">
												  	</div>

												  	<div class="form-group">
												    	<label for="apellido2">2° APELLIDO</label>
												    	<input type="text" class="form-control" id="apellido2sele" name="apellido2"
												           placeholder="Segundo apellido">
												  	</div>

												  	<div class="form-group">
														<label for="sexo">SEXO:</label>
														 <select class="form-control" id="sexosele" name="sexo">
														 	<option value="m">Masculino</option>
										  				 	<option value="f">Femenino</option>
														 </select>
												   	</div>
							                    </div>
							                </div>
							            </div>
							            
							            <div class="col-md-4">
							            	<div class="panel panel-default">
							                    <div class="panel-body">

							                    	<div class="form-group">
												    	<label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
												    	<input type="date" class="form-control" id="fecha_nacimientosele" name="fecha_nacimiento">
												  	</div>

												  	<div class="form-group">
													 	<label for="lugar_nacimiento">LUGAR DE NACIMIENTO</label>
													 	<input type="text" class="form-control" id="lugar_nacimientosele" name="lugar_nacimiento" placeholder="Lugar de Nacimiento">
													</div>

													<div class="form-group">
														<label for="tipo_sangre">TIPO DE SANGRE:</label>
														<select class="form-control" id="tipo_sangresele" name="tipo_sangre">
															<option value="o+">O+</option>
										  					<option value="o-">O-</option>
										  					<option value="a+">A+</option>
										  					<option value="a-">A-</option>
										  					<option value="b+">B+</option>
										  					<option value="b-">B-</option>
														 </select>
													</div>

													<div class="form-group">
													 	<label for="eps">EPS</label>
														<input type="text" class="form-control" id="epssele" name="eps" placeholder="Eps">
													</div>

													<div class="form-group">
														<label for="poblacion">POBLACIÓN</label>
														<input type="text" class="form-control" id="poblacionsele" name="poblacion" placeholder="Población">
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
												    	<label for="telefono">TELÉFONO</label>
												    	<input type="text" class="form-control" id="telefonosele" name="telefono"
												           placeholder="Teléfono">
												  	</div>

												  	<div class="form-group">
												    	<label for="correo">CORREO</label>
												    	<input type="text" class="form-control" id="correosele" name="correo"
												           placeholder="Correo">
												  	</div>

												  	<div class="form-group">
												    	<label for="direccion">DIRECCIÓN</label>
												    	<input type="text" class="form-control" id="direccionsele" name="direccion"
												           placeholder="Dirección">
												  	</div>

												  	<div class="form-group">
												    	<label for="barrio">BARRIO</label>
												    	<input type="text" class="form-control" id="barriosele" name="barrio"
												           placeholder="Barrio">
												  	</div>
							                    </div>
							                </div> 
							            </div>

							            <div class="col-md-6">
							                <div class="panel panel-default">
							                    <div class="panel-body">

							                    	<div class="form-group">
												    	<label for="institucion_procedencia">INSTITUCIÓN DE PROCEDENCIA</label>
												    	<input type="text" class="form-control" id="institucion_procedenciasele" name="institucion_procedencia"
												           placeholder="Institución Procedencia">
												  	</div>

												  	<div class="form-group">
												    	<label for="discapacidad">DISCAPACIDAD</label>
												    	<input type="text" class="form-control" id="discapacidadsele" name="discapacidad"
												           placeholder="Discapacidad">
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
												    	<label for="identificacion_padre">IDENTIFICACIÓN DEL PADRE</label>
												    	<input type="text" class="form-control" id="identificacion_padresele" name="identificacion_padre"
												           placeholder="Identificación del padre">
												  	</div>

												  	<div class="form-group">
												    	<label for="nombres_padre">NOMBRES DEL PADRE</label>
												    	<input type="text" class="form-control" id="nombres_padresele" name="nombres_padre"
												           placeholder="Nombres">
												  	</div>

												  	<div class="form-group">
												    	<label for="apellidos_padre">APELLIDOS DEL PADRE</label>
												    	<input type="text" class="form-control" id="apellidos_padresele" name="apellidos_padre"
												           placeholder="Apellidos">
												  	</div>

												  	<div class="form-group">
												    	<label for="ocupacion_padre">OCUPACIÓN DEL PADRE</label>
												    	<input type="text" class="form-control" id="ocupacion_padresele" name="ocupacion_padre"
												           placeholder="Ocupación">
												  	</div>

												  	<div class="form-group">
												    	<label for="telefono_padre">TELÉFONO</label>
												    	<input type="text" class="form-control" id="telefono_padresele" name="telefono_padre"
												           placeholder="Teléfono">
												  	</div>

												  	<div class="form-group">
												    	<label for="telefono_trabajo_padre">TELÉFONO TRABAJO</label>
												    	<input type="text" class="form-control" id="telefono_trabajo_padresele" name="telefono_trabajo_padre"
												           placeholder="Teléfono Trabajo">
												  	</div>

												  	<div class="form-group">
												    	<label for="direccion_trabajo_padre">DIRECCIÓN TRABAJO</label>
												    	<input type="text" class="form-control" id="direccion_trabajo_padresele" name="direccion_trabajo_padre"
												           placeholder="Dirección Trabajo">
												  	</div>
							                    </div>
							                </div>
							            </div>

							            <div class="col-md-6">
							                <div class="panel panel-default">
							                    <div class="panel-body">

							                    	<div class="form-group">
												    	<label for="identificacion_madre">IDENTIFICACIÓN DE LA MADRE</label>
												    	<input type="text" class="form-control" id="identificacion_madresele" name="identificacion_madre"
												           placeholder="Identificación de la madre">
												  	</div>

												  	<div class="form-group">
												    	<label for="nombres_madre">NOMBRES DE LA MADRE</label>
												    	<input type="text" class="form-control" id="nombres_madresele" name="nombres_madre"
												           placeholder="Nombres">
												  	</div>

												  	<div class="form-group">
												    	<label for="apellidos_madre">APELLIDOS DE LA MADRE</label>
												    	<input type="text" class="form-control" id="apellidos_madresele" name="apellidos_madre"
												           placeholder="Apellidos">
												  	</div>

												  	<div class="form-group">
												    	<label for="ocupacion_madre">OCUPACIÓN DE LA MADRE</label>
												    	<input type="text" class="form-control" id="ocupacion_madresele" name="ocupacion_madre"
												           placeholder="Ocupación">
												  	</div>

												  	<div class="form-group">
												    	<label for="telefono_madre">TELÉFONO</label>
												    	<input type="text" class="form-control" id="telefono_madresele" name="telefono_madre"
												           placeholder="Teléfono">
												  	</div>

												  	<div class="form-group">
												    	<label for="telefono_trabajo_madre">TELÉFONO TRABAJO</label>
												    	<input type="text" class="form-control" id="telefono_trabajo_madresele" name="telefono_trabajo_madre"
												           placeholder="Teléfono Trabajo">
												  	</div>

												  	<div class="form-group">
												    	<label for="direccion_trabajo_madre">DIRECCIÓN TRABAJO</label>
												    	<input type="text" class="form-control" id="direccion_trabajo_madresele" name="direccion_trabajo_madre"
												           placeholder="Dirección Trabajo">
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