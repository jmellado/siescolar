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
            <h1 class="page-header">GESTIÓN DE NOTAS</h1>
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
							<input type="text" class="form-control" id="identificacion_profesorN" name="identificacion_profesorN" placeholder="Identificacion Profesor" onkeypress="return valida(event)">
			    				<span class="input-group-btn">
			        				<button class="btn btn-primary" type="button" name="btn_buscar_profesorN" id="btn_buscar_profesorN">
			            				<i class="fa fa-search"></i>
			            			</button>
			        			</span>
						</div>
					</div></br></br>

					<form role="form" action="<?php echo base_url(); ?>notas_controller/ingresar_notas" name="" method="post" id="form_notas">

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
												<select class="form-control" id="periodoN" name="periodo" disabled>
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
											<div id="grados_notas1">
												<select class="form-control" id="id_gradoN" name="id_grado" disabled>
															    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="id_grupo">GRUPO</label>
											<div id="grupos_notas1">
												<select class="form-control" id="id_grupoN" name="id_grupo" disabled>
															    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="id_asignatura">ASIGNATURA</label>
											<div id="asignaturas_notas1">
												<select class="form-control" id="id_asignaturaN" name="id_asignatura" disabled>
															    
												</select>
											</div>
										</div>
									</div>

								</div>
							</div>

	        			</div>

	        			<div class="col-sm-offset-9 col-sm-3">

	        				<div class="form-group">
								<button type="button" name="btn_ingresar_nota" id="btn_ingresar_nota" class="btn btn-primary btn-lg btn-block" disabled>Ingresar Notas</button>
							</div>
							
	        			</div>

        			</form>

                </div>
            </div>



    	</div>

    	
    </div>

</div>

<!-- Modal  ingresar nuev nota -->
<div id="modal_ingresar_nota" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">REGISTRAR NOTAS</h4>
      </div>
      <div class="modal-body">
        

        <form role="form" action="<?php echo base_url(); ?>notas_controller/insertar" name="" method="post" id="form_notas_insertar">

        	<div class="col-md-12">

				<div class="panel panel-default">
					<!--<div class="panel-heading"></div>-->
        			<div class="panel-body">
        				<div class="col-md-3">
	        				<div class="form-group">
								<label for="periodo">PERIODO</label>
									<select class="form-control" id="periodoseleN" name="periodo">
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
								<div id="grados_notas1">
									<select class="form-control" id="id_gradoseleN" name="id_grado">
												    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="id_grupo">GRUPO</label>
								<div id="grupos_notas1">
									<select class="form-control" id="id_gruposeleN" name="id_grupo">
												    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="id_asignatura">ASIGNATURA</label>
								<div id="asignaturas_notas1">
									<select class="form-control" id="id_asignaturaseleN" name="id_asignatura">
												    
									</select>
								</div>
							</div>
						</div>

					</div>
				</div>

			</div>

        	<div class="row">
		    	<div class="col-md-12">
		    		<div class="panel panel-default">
		    			<div class="panel-heading">Ingresar Notas</div>
		    				<div class="panel-body">

		    					<div class="form-group">
								  <label for="cantidad_nota">Mostrar Por:</label>
								  <select class="selectpicker" id="cantidad_nota" name="cantidad_nota" >
								    <option value="5">5</option>
				  					<option value="10">10</option>
				  					<option value="15">15</option>
				  					<option value="20">20</option>
								  </select>
								</div>

								<div class="table-responsive">
								<table border='1' id="lista_notas" class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>Identificacion</th>
											<th>Nombres</th>
											<th>Apellido 1</th>
											<th>Apellido 2</th>
											<th>Nota 1</th>
											<th>Nota 2</th>
											<th>Nota 3</th>
											<th>Nota 4</th>
											<th>Nota Final</th>
											<th># Fallas</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								</div>

								<div class="text-center paginacion_nota">
								
								</div>

		    				</div>

		    		</div>
		    	</div>
		    </div>

			<div class="col-sm-offset-9 col-sm-3">
        		<div class="form-group">
					<button type="submit" name="btn_registrar_nota" id="btn_registrar_nota" class="btn btn-primary btn-lg btn-block">Registrar Notas</button>
				</div>
        	</div>

        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

