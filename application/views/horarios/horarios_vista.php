	<style type="text/css">
	    
	    label.error{color:red;}

	    #lista_seleccion_horarios th,td{
	    	text-align: center;
	    }

	    #lista_horarios th,td{
	    	text-align: center;
	    }
	    
	</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-calendar'></i>&nbsp;GESTIÓN DE HORARIOS</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">

                	<div class="row">
	                	<div class="col-md-4">
				    		<div class="panel panel-default">
					    		<div class="panel-heading"><i class='fa fa-check-square'></i>&nbsp;Seleccionar Curso:</div>
					    			<div class="panel-body">
										
										<form role="form" action="<?php echo base_url(); ?>horarios_controller/insertar" name="" method="post" id="form_horarios">

											<div class="form-group">
												<label for="jornada">JORNADA</label>
												<select class="form-control" id="jornadaH" name="jornada">
													<option value="Mañana">Mañana</option>
													<option value="Tarde">Tarde</option>
													<option value="Noche">Noche</option>
													<option value="Unica">Única</option>
												</select>
											</div>
										
											<div class="form-group">
												<label for="id_curso">CURSO</label>
												<div id="cursos_horarios1">
													<select class="form-control" id="id_cursoH" name="id_curso">
																    
													</select>
												</div>
											</div>

											<div class="form-group">
												<label for="id_asignatura">ASIGNATURA</label>
												<div id="asignaturas_horarios1">
													<select class="form-control" id="id_asignaturaH" name="id_asignatura">
																    
													</select>
												</div>
											</div>
											
											<div class="form-group">
												<div class="table-responsive">
													<table border='1' id="lista_seleccion_horarios" class="table table-bordered table-condensed table-hover table-striped">
														<thead>
															<tr>
																<th>Hora</th>
																<th>L</th>
																<th>M</th>
																<th>M</th>
																<th>J</th>
																<th>V</th>
																<th>S</th>
																<th>D</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>1</td>
																<td><input type='checkbox' name='dia[]' value='lunes-1'></td>
																<td><input type='checkbox' name='dia[]' value='martes-1'></td>
																<td><input type='checkbox' name='dia[]' value='miercoles-1'></td>
																<td><input type='checkbox' name='dia[]' value='jueves-1'></td>
																<td><input type='checkbox' name='dia[]' value='viernes-1'></td>
																<td><input type='checkbox' name='dia[]' value='sabado-1'></td>
																<td><input type='checkbox' name='dia[]' value='domingo-1'></td>
															</tr>
															<tr>
																<td>2</td>
																<td><input type='checkbox' name='dia[]' value='lunes-2'></td>
																<td><input type='checkbox' name='dia[]' value='martes-2'></td>
																<td><input type='checkbox' name='dia[]' value='miercoles-2'></td>
																<td><input type='checkbox' name='dia[]' value='jueves-2'></td>
																<td><input type='checkbox' name='dia[]' value='viernes-2'></td>
																<td><input type='checkbox' name='dia[]' value='sabado-2'></td>
																<td><input type='checkbox' name='dia[]' value='domingo-2'></td>
															</tr>
															<tr>
																<td>3</td>
																<td><input type='checkbox' name='dia[]' value='lunes-3'></td>
																<td><input type='checkbox' name='dia[]' value='martes-3'></td>
																<td><input type='checkbox' name='dia[]' value='miercoles-3'></td>
																<td><input type='checkbox' name='dia[]' value='jueves-3'></td>
																<td><input type='checkbox' name='dia[]' value='viernes-3'></td>
																<td><input type='checkbox' name='dia[]' value='sabado-3'></td>
																<td><input type='checkbox' name='dia[]' value='domingo-3'></td>
															</tr>
															<tr>
																<td>4</td>
																<td><input type='checkbox' name='dia[]' value='lunes-4'></td>
																<td><input type='checkbox' name='dia[]' value='martes-4'></td>
																<td><input type='checkbox' name='dia[]' value='miercoles-4'></td>
																<td><input type='checkbox' name='dia[]' value='jueves-4'></td>
																<td><input type='checkbox' name='dia[]' value='viernes-4'></td>
																<td><input type='checkbox' name='dia[]' value='sabado-4'></td>
																<td><input type='checkbox' name='dia[]' value='domingo-4'></td>
															</tr>
															<tr>
																<td>5</td>
																<td><input type='checkbox' name='dia[]' value='lunes-5'></td>
																<td><input type='checkbox' name='dia[]' value='martes-5'></td>
																<td><input type='checkbox' name='dia[]' value='miercoles-5'></td>
																<td><input type='checkbox' name='dia[]' value='jueves-5'></td>
																<td><input type='checkbox' name='dia[]' value='viernes-5'></td>
																<td><input type='checkbox' name='dia[]' value='sabado-5'></td>
																<td><input type='checkbox' name='dia[]' value='domingo-5'></td>
															</tr>
															<tr>
																<td>6</td>
																<td><input type='checkbox' name='dia[]' value='lunes-6'></td>
																<td><input type='checkbox' name='dia[]' value='martes-6'></td>
																<td><input type='checkbox' name='dia[]' value='miercoles-6'></td>
																<td><input type='checkbox' name='dia[]' value='jueves-6'></td>
																<td><input type='checkbox' name='dia[]' value='viernes-6'></td>
																<td><input type='checkbox' name='dia[]' value='sabado-6'></td>
																<td><input type='checkbox' name='dia[]' value='domingo-6'></td>
															</tr>
															<tr>
																<td>7</td>
																<td><input type='checkbox' name='dia[]' value='lunes-7'></td>
																<td><input type='checkbox' name='dia[]' value='martes-7'></td>
																<td><input type='checkbox' name='dia[]' value='miercoles-7'></td>
																<td><input type='checkbox' name='dia[]' value='jueves-7'></td>
																<td><input type='checkbox' name='dia[]' value='viernes-7'></td>
																<td><input type='checkbox' name='dia[]' value='sabado-7'></td>
																<td><input type='checkbox' name='dia[]' value='domingo-7'></td>
															</tr>
															<tr>
																<td>8</td>
																<td><input type='checkbox' name='dia[]' value='lunes-8'></td>
																<td><input type='checkbox' name='dia[]' value='martes-8'></td>
																<td><input type='checkbox' name='dia[]' value='miercoles-8'></td>
																<td><input type='checkbox' name='dia[]' value='jueves-8'></td>
																<td><input type='checkbox' name='dia[]' value='viernes-8'></td>
																<td><input type='checkbox' name='dia[]' value='sabado-8'></td>
																<td><input type='checkbox' name='dia[]' value='domingo-8'></td>
															</tr>
															<tr>
																<td>9</td>
																<td><input type='checkbox' name='dia[]' value='lunes-9'></td>
																<td><input type='checkbox' name='dia[]' value='martes-9'></td>
																<td><input type='checkbox' name='dia[]' value='miercoles-9'></td>
																<td><input type='checkbox' name='dia[]' value='jueves-9'></td>
																<td><input type='checkbox' name='dia[]' value='viernes-9'></td>
																<td><input type='checkbox' name='dia[]' value='sabado-9'></td>
																<td><input type='checkbox' name='dia[]' value='domingo-9'></td>
															</tr>
															<tr>
																<td>10</td>
																<td><input type='checkbox' name='dia[]' value='lunes-10'></td>
																<td><input type='checkbox' name='dia[]' value='martes-10'></td>
																<td><input type='checkbox' name='dia[]' value='miercoles-10'></td>
																<td><input type='checkbox' name='dia[]' value='jueves-10'></td>
																<td><input type='checkbox' name='dia[]' value='viernes-10'></td>
																<td><input type='checkbox' name='dia[]' value='sabado-10'></td>
																<td><input type='checkbox' name='dia[]' value='domingo-10'></td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>

											<div class="form-group">
												<button type="submit" name="btn_registrar_horario" id="btn_registrar_horario" class="btn btn-primary btn-lg btn-block">Registrar</button>
											</div>

										</form>

									</div>
								
							</div>
						</div>				

				    	<div class="col-md-8">
				    		<div class="panel panel-default">
				    			<div class="panel-heading"><i class='fa fa-calendar'></i>&nbsp;Horario De Clases</div>
				    				<div class="panel-body">

										<div class="table-responsive">
											<table border='1' id="lista_horarios" class="table table-bordered table-condensed table-striped">
												<thead>
													<tr>
														<th>Hora</th>
														<th>Lunes</th>
														<th>Martes</th>
														<th>Miercoles</th>
														<th>Jueves</th>
														<th>Viernes</th>
														<th>Sabado</th>
														<th>Domingo</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>2</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>3</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>4</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>5</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>6</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>7</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>8</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>9</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>10</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>	
												</tbody>
												<tfoot>
													<tr>
														<td colspan='8'></td>
													</tr>
												</tfoot>
											</table>
										</div>

				    				</div>

				    		</div>
				    	</div>
				    </div>

                </div>
            </div>    	
    	</div>
    </div>

</div>