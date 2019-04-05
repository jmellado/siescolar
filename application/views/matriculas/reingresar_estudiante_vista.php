<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/reingresar_estudiante.js" defer></script>

<style type="text/css">

    label.error{color:red;}

    #modal_agregar_reingreso .modal-body
	{
		height:410px;
		overflow:auto;
	}

	#modal_agregar_reingreso2 .modal-body
	{
		height:410px;
		overflow:auto;
	}

	#modal_actualizar_reingreso .modal-body
	{
		height:393px;
		overflow:auto;
	}

    .panel-margen{
		margin-bottom: 0px;
	}

	.panel-margen1{
		margin-bottom: 2px;
	}

</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-shield'></i>&nbsp;REINGRESO DE ESTUDIANTES</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<div class="btn-group">
                	<button type="button" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Reingresar Estudiante</button>
                	<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    	<span class="caret"></span>
                    	<span class="sr-only">Toggle Dropdown</span>
                  	</button>
                  	<ul class="dropdown-menu" role="menu">
                    	<li><a href="#" id="btn_agregar_reingreso">Retirado En Años Anteriores</a></li>
                    	<li><a href="#" id="btn_agregar_reingreso2">Retirado En El Año Actual</a></li>
                  	</ul>
                </div>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_reingreso" name="buscar_reingreso"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_reingreso" id="btn_buscar_reingreso" class="btn btn-primary">
							<i class="fa fa-search"></i>
						</button>
					</span>
    			</div>
    		</div>	
    	</div>

    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary">
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Estudiantes Reingresados</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_reingreso">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_reingreso" name="cantidad_reingreso">
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_reingresos" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-th-large'></i>&nbsp;Curso</th>
									<th><i class='fa fa-user'></i>&nbsp;Estudiante</th>
									<th><i class='fa fa-calendar-check-o'></i>&nbsp;Fecha Reingreso</th>
									<th><i class='fa fa-calendar-times-o'></i>&nbsp;Año lectivo</th>
									<th></th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<td colspan='6'></td>
								</tr>
							</tfoot>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_reingreso">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>


</div>


<!-- Modal  agregar reingreso -->
<div id="modal_agregar_reingreso" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

	    <!-- Modal content-->
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REINGRESAR ESTUDIANTE</h4>
			</div>
	    	
	    	<div class="modal-body">
	        
		        <div class="panel panel-default panel-margen">
				    <div class="panel-body">

				    	<div class="row">
					      	<div class="col-sm-offset-4 col-sm-4">
					      		<div class="form-group">
							        <div class="input-group custom-search-form">
							            <input type="text" class="form-control" id="identificacionRI" name="identificacion" placeholder="Identificación Estudiante" onkeypress="return validaRI(event)">
							                <span class="input-group-btn">
							                    <button class="btn btn-primary" type="button" name="btn_buscar_estudiante" id="btn_buscar_estudianteRI">
							                        <i class="fa fa-search"></i>
							                    </button>
							                </span>
							        </div>
							    </div>
						    </div>
						</div>

						<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>matriculas_controller/insertar_reingreso" name="" method="post" id="form_reingresos">

							<div class="row">
				        		<div class="col-sm-6">
						            <div class="panel panel-default">
				    					<div class="panel-body">
											<input type="hidden" class="form-control" id="id_estudianteRI" name="id_estudiante">
											
								        	<div class="form-group">
								        		<label class="control-label col-sm-4" for="nombres">NOMBRES</label>
								        		<div class="col-sm-7">
													<input type="text" class="form-control" id="nombresRI" name="nombres" placeholder="Nombres" disabled>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-4" for="apellido1">1° APELLIDO</label>
												<div class="col-sm-7">
													<input type="text" class="form-control" id="apellido1RI" name="apellido1" placeholder="Primer Apellido" disabled>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-4" for="apellido2">2° APELLIDO</label>
												<div class="col-sm-7">
													<input type="text" class="form-control" id="apellido2RI" name="apellido2" placeholder="Segundo Apellido" disabled>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-4" for="jornada">JORNADA</label>
												<div class="col-sm-6">
													<select class="form-control" id="jornadaRI" name="jornada" disabled>
															<option value="Mañana">Mañana</option>
															<option value="Tarde">Tarde</option>
															<option value="Noche">Noche</option>
															<option value="Unica">Única</option>
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-4" for="id_curso">CURSO</label>
												<div class="col-sm-6">
													<div id="curso_reingreso1">
														<select class="form-control" id="id_cursoRI" name="id_curso" disabled>
																		    
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>		

								<div class="col-sm-6">
									<div class="panel panel-default">
				    					<div class="panel-body">
											<div class="form-group">
												<label class="control-label col-sm-4" for="id_acudiente">ACUDIENTE</label>
												<div class="col-sm-7">
													<div id="acudiente_reingreso1">
														<select class="form-control" id="id_acudienteRI" name="id_acudiente" disabled>
																		    
														</select>
													</div>
												</div>
											</div>

											<div class="form-group">
											  	<label class="control-label col-sm-4" for="parentesco">PARENTESCO</label>
											  	<div class="col-sm-6">
												  	<select class="form-control" id="parentescoRI" name="parentesco" disabled>
												  		<option value=""></option>
													    <option value="Padre">Padre</option>
														<option value="Madre">Madre</option>
														<option value="Hermano(a)">Hermano(a)</option>
														<option value="Tio(a)">Tio(a)</option>
														<option value="Primo(a)">Primo(a)</option>
														<option value="Abuelo(a)">Abuelo(a)</option>
														<option value="Cuñado(a)">Cuñado(a)</option>
														<option value="Padrino">Padrino</option>
														<option value="Madrina">Madrina</option>
												  	</select>
												</div>  	 	
											</div>

											<div class="col-sm-12">
								        		<div class="form-group">
													<label for="observaciones">OBSERVACIONES</label>
													<textarea class="form-control" name="observaciones" id="observacionesRI" cols="50" rows="3" placeholder="Observaciones.." disabled style="resize:none"></textarea>
												</div>	
								        	</div>
										</div>
									</div>		
								</div>	
							</div>

						</form>
			    			
				    </div>
				</div>        

	      	</div>
			<div class="modal-footer">
				<div class="col-sm-offset-4 col-sm-4">
					<button type="submit" name="btn_registrar_reingreso" id="btn_registrar_reingreso" class="btn btn-primary btn-lg btn-block" disabled>Reingresar Estudiante</button>
				</div>
			</div>
	    </div>

  	</div>
</div>


<!-- Modal  agregar reingreso2 -->
<div id="modal_agregar_reingreso2" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

	    <!-- Modal content-->
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REINGRESAR ESTUDIANTE RETIRADO EN EL AÑO ACTUAL</h4>
			</div>
	    	
	    	<div class="modal-body">
	        
		        <div class="panel panel-default panel-margen">
				    <div class="panel-body">

				    	<div class="row">
					      	<div class="col-sm-offset-4 col-sm-4">
					      		<div class="form-group">
							        <div class="input-group custom-search-form">
							            <input type="text" class="form-control" id="identificacionRI2" name="identificacion" placeholder="Identificación Estudiante" onkeypress="return validaRI(event)">
							                <span class="input-group-btn">
							                    <button class="btn btn-primary" type="button" name="btn_buscar_estudiante" id="btn_buscar_estudianteRI2">
							                        <i class="fa fa-search"></i>
							                    </button>
							                </span>
							        </div>
							    </div>
						    </div>
						</div>

						<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>matriculas_controller/insertar_reingreso2" name="" method="post" id="form_reingresos2">

							<div class="row">
				        		<div class="col-sm-6">
						            <div class="panel panel-default">
				    					<div class="panel-body">

				    						<input type="hidden" class="form-control" id="id_matriculaRI2" name="id_matricula">

											<input type="hidden" class="form-control" id="id_estudianteRI2" name="id_estudiante">
											
								        	<div class="form-group">
								        		<label class="control-label col-sm-4" for="nombres">NOMBRES</label>
								        		<div class="col-sm-7">
													<input type="text" class="form-control" id="nombresRI2" name="nombres" placeholder="Nombres" disabled>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-4" for="apellido1">1° APELLIDO</label>
												<div class="col-sm-7">
													<input type="text" class="form-control" id="apellido1RI2" name="apellido1" placeholder="Primer Apellido" disabled>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-4" for="apellido2">2° APELLIDO</label>
												<div class="col-sm-7">
													<input type="text" class="form-control" id="apellido2RI2" name="apellido2" placeholder="Segundo Apellido" disabled>
												</div>
											</div>


											<input type="hidden" class="form-control" id="jornadaRI2" name="jornada">

											<div class="form-group">
												<label class="control-label col-sm-4" for="nombre_jornada">JORNADA</label>
												<div class="col-sm-6">
													<input type="text" class="form-control" id="nombre_jornadaRI2" name="nombre_jornada" placeholder="Jornada" disabled>
												</div>
											</div>


											<input type="hidden" class="form-control" id="id_cursoRI2" name="id_curso">

											<div class="form-group">
												<label class="control-label col-sm-4" for="nombre_curso">CURSO</label>
												<div class="col-sm-6">
													<input type="text" class="form-control" id="nombre_cursoRI2" name="nombre_curso" placeholder="Curso" disabled>
												</div>
											</div>

										</div>
									</div>
								</div>		

								<div class="col-sm-6">
									<div class="panel panel-default">
				    					<div class="panel-body">
											<div class="form-group">
												<label class="control-label col-sm-4" for="id_acudiente">ACUDIENTE</label>
												<div class="col-sm-7">
													<div id="acudiente_reingreso2">
														<select class="form-control" id="id_acudienteRI2" name="id_acudiente" disabled>
																		    
														</select>
													</div>
												</div>
											</div>

											<div class="form-group">
											  	<label class="control-label col-sm-4" for="parentesco">PARENTESCO</label>
											  	<div class="col-sm-6">
												  	<select class="form-control" id="parentescoRI2" name="parentesco" disabled>
												  		<option value=""></option>
													    <option value="Padre">Padre</option>
														<option value="Madre">Madre</option>
														<option value="Hermano(a)">Hermano(a)</option>
														<option value="Tio(a)">Tio(a)</option>
														<option value="Primo(a)">Primo(a)</option>
														<option value="Abuelo(a)">Abuelo(a)</option>
														<option value="Cuñado(a)">Cuñado(a)</option>
														<option value="Padrino">Padrino</option>
														<option value="Madrina">Madrina</option>
												  	</select>
												</div>  	 	
											</div>

											<div class="col-sm-12">
								        		<div class="form-group">
													<label for="observaciones">OBSERVACIONES</label>
													<textarea class="form-control" name="observaciones" id="observacionesRI2" cols="50" rows="3" placeholder="Observaciones.." disabled style="resize:none"></textarea>
												</div>	
								        	</div>
										</div>
									</div>		
								</div>	
							</div>

						</form>
			    			
				    </div>
				</div>        

	      	</div>
			<div class="modal-footer">
				<div class="col-sm-offset-4 col-sm-4">
					<button type="submit" name="btn_registrar_reingreso" id="btn_registrar_reingreso2" class="btn btn-primary btn-lg btn-block" disabled>Reingresar Estudiante</button>
				</div>
			</div>
	    </div>

  	</div>
</div>


<!-- Modal  actualizar retiro -->
<div id="modal_actualizar_reingreso" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;REINGRESO DE ESTUDIANTE</h4>
			</div>
	    	
	    	<div class="modal-body">
	        
		        <div class="panel panel-default panel-margen">
				    <div class="panel-body">

				    	<form role="form" id="form_reingresos_actualizar">

				    		<input type="hidden" class="form-control" id="id_reingresosele" name="id_reingreso">

					    	<div class="panel panel-default panel-margen1">
					    		<div class="panel-body">
						        	<div class="col-md-5">
										<div class="form-group">
											<label for="jornada">JORNADA</label>
											<select class="form-control" id="jornadaseleRI" name="jornada" disabled>
												<option value="Mañana">Mañana</option>
												<option value="Tarde">Tarde</option>
												<option value="Noche">Noche</option>
												<option value="Unica">Única</option>
											</select>
										</div>
									</div>

									<div class="col-md-7">
										<div class="form-group">
											<label for="id_curso">CURSO</label>
											<input type="text" class="form-control" id="cursoseleRI" name="cursosele" disabled>
										</div>
									</div>
								</div>	
							</div>
						
							<div class="panel panel-default panel-margen1">
					    		<div class="panel-body">	
									<div class="col-md-7">
				    					<div class="form-group">
											<label for="id_estudiante">ESTUDIANTE</label>
											<input type="text" class="form-control" id="estudianteseleRI" name="estudiantesele" disabled>
										</div>
				    				</div>

				    				<div class="col-md-5">
				    					<div class="form-group">
											<label for="fecha_retiro">FECHA REINGRESO</label>
											<input type="date" class="form-control" id="fecha_reingresoseleRI" name="fecha_reingreso" disabled>
										</div>
				    				</div>

				    				<div class="col-md-12">
										<div class="form-group">
											<label for="observaciones">OBSERVACIONES</label>
											<textarea class="form-control" name="observaciones" id="observacionesseleRI" cols="50" rows="3" placeholder="Observaciones.." style="resize:none" disabled></textarea>
										</div>
									</div>
				    			</div>		
				    		</div>

			    		</form>	
				    </div>
				</div>        

	      	</div>
			<div class="modal-footer">
				<!--<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" name="btn_actualizar_reingreso" id="btn_actualizar_reingreso" class="btn btn-primary btn-lg btn-block">Actualizar Reingreso Estudiante</button>
				</div>-->
			</div>
			
	    </div>

  	</div>
</div>