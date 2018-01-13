	<style type="text/css">
	    
	    label.error{color:red;}

	    .table-responsive
		{
			height: 150px;
		    overflow-y: auto;

		}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-send'></i>&nbsp;INBOX&nbsp;<i class='fa fa-chevron-down'></i></h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-md-12">

    		<div class="nav-tabs-custom">

    			<ul class="nav nav-tabs">
	              <li class="active"><a href="#tab_1" data-toggle="tab"><i class='fa fa-envelope'></i>&nbsp;MENSAJES</a></li>
	              <li><a href="#tab_2" data-toggle="tab"><i class='fa fa-pencil'></i>&nbsp;TAREAS</a></li>
	              <li><a href="#tab_3" data-toggle="tab"><i class='fa fa-calendar-plus-o'></i>&nbsp;EVENTOS</a></li>
	              <!--<li><a href="#tab_4" data-toggle="tab"><i class='fa fa-trophy'></i>&nbsp;INSIGNIAS</a></li>-->
	              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
	            </ul>

	            <!--CONTENIDO DE LOS TABS-->
		        <div class="tab-content">

		        	<div class="tab-pane active" id="tab_1">

		        		<div class="row">

		        			<div class="col-md-12">
			        			<div class="panel panel-default">
			        				<div class="panel-body">

			        					<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>inbox_controller/insertar_mensajes" name="" method="post" id="form_mensajes">

			        						<input type="hidden" id="remitente_m" name="remitente" value="<?php echo $this->session->userdata('id_persona')?>">

				                			<div class="form-group">
												<label class="control-label col-sm-3" for="total_destinatario">PARA:</label>
												<div class="col-sm-7">
													<div class="input-group">
														<input type="text" class="form-control" id="total_destinatario_m" name="total_destinatario" placeholder="Agregar Estudiantes" readonly>

														<span class="input-group-btn">
															<button type="button" name="btn_buscar_destinatario" id="btn_buscar_destinatario_m" class="btn btn-warning">
																<i class="fa fa-plus"></i>
															</button>
														</span>

													</div>
												</div>
											</div>

											<div id="lista_destinatarios_m" style='display:none'></div>

								        	<div class="form-group">
								        		<label class="control-label col-sm-3" for="titulo">TÍTULO:</label>
								        		<div class="col-sm-7">
													<input type="text" class="form-control" id="titulo_m" name="titulo" placeholder="Título">
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-3" for="tipo">TIPO:</label>
												<div class="col-sm-3">
													<select class="form-control" id="tipo_m" name="tipo">
															<option></option>
															<option value="Mensaje General">Mensaje General</option>
															<option value="Noticia">Noticia</option>
															<option value="Circular">Circular</option>
															<option value="Importante">Importante</option>
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-3" for="contenido">CONTENIDO:</label>
												<div class="col-sm-7">
													<textarea class="form-control" name="contenido" id="contenido_m" cols="50" rows="4" placeholder="Contenido.." style="resize:none"></textarea>
												</div>
											</div>

											<div class="form-group">
								        		<div class="col-sm-offset-6 col-sm-2"> 
													<button type="button" name="btn_cancelar_mensaje" id="btn_cancelar_mensaje" class="btn btn-warning btn-lg btn-block">Cancelar</button>
												</div>
												<div class="col-sm-2"> 
													<button type="submit" name="btn_registrar_mensaje" id="btn_registrar_mensaje" class="btn btn-success btn-lg btn-block">Enviar</button>
												</div>
											</div>
											
			        					</form>
			        				</div>
			        			</div>
			        		</div>		

		        		</div>

		        	</div>

		        	<div class="tab-pane" id="tab_2">

		        		<div class="row">

		        			<div class="col-md-12">
			        			<div class="panel panel-default">
			        				<div class="panel-body">

			        					<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>inbox_controller/insertar_tareas" name="" method="post" id="form_tareas">

			        						<input type="hidden" id="remitente_t" name="remitente" value="<?php echo $this->session->userdata('id_persona')?>">

				                			<div class="form-group">
												<label class="control-label col-sm-3" for="total_destinatario">PARA:</label>
												<div class="col-sm-7">
													<div class="input-group">
														<input type="text" class="form-control" id="total_destinatario_t" name="total_destinatario" placeholder="Agregar Estudiantes" readonly>

														<span class="input-group-btn">
															<button type="button" name="btn_buscar_destinatario" id="btn_buscar_destinatario_t" class="btn btn-warning">
																<i class="fa fa-plus"></i>
															</button>
														</span>

													</div>
												</div>
											</div>

											<div id="lista_destinatarios_t" style='display:none'></div>

								        	<div class="form-group">
								        		<label class="control-label col-sm-3" for="titulo">TÍTULO:</label>
								        		<div class="col-sm-7">
													<input type="text" class="form-control" id="titulo_t" name="titulo" placeholder="Título">
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-3" for="fecha_limite">FECHA LÍMITE:</label>
												<div class="col-sm-3">
													<input type="date" class="form-control" id="fecha_limite_t" name="fecha_limite">
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-3" for="contenido">CONTENIDO:</label>
												<div class="col-sm-7">
													<textarea class="form-control" name="contenido" id="contenido_t" cols="50" rows="4" placeholder="Contenido.." style="resize:none"></textarea>
												</div>
											</div>

											<div class="form-group">
								        		<div class="col-sm-offset-6 col-sm-2"> 
													<button type="button" name="btn_cancelar_tarea" id="btn_cancelar_tarea" class="btn btn-warning btn-lg btn-block">Cancelar</button>
												</div>
												<div class="col-sm-2"> 
													<button type="submit" name="btn_registrar_tarea" id="btn_registrar_tarea" class="btn btn-success btn-lg btn-block">Enviar</button>
												</div>
											</div>

			        					</form>
			        				</div>
			        			</div>
			        		</div>		

		        		</div>

		        	</div>

		        	<div class="tab-pane" id="tab_3">

		        		<div class="row">

		        			<div class="col-md-12">
			        			<div class="panel panel-default">
			        				<div class="panel-body">

			        					<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>inbox_controller/insertar" name="" method="post" id="form_eventos">

			        						<input type="hidden" id="remitente_e" name="remitente" value="<?php echo $this->session->userdata('id_persona')?>">

				                			<div class="form-group">
												<label class="control-label col-sm-3" for="total_destinatario">PARA:</label>
												<div class="col-sm-7">
													<div class="input-group">
														<input type="text" class="form-control" id="total_destinatario_e" name="total_destinatario" placeholder="Agregar Estudiantes" readonly>

														<span class="input-group-btn">
															<button type="button" name="btn_buscar_destinatario" id="btn_buscar_destinatario_e" class="btn btn-warning">
																<i class="fa fa-plus"></i>
															</button>
														</span>

													</div>
												</div>
											</div>

											<div id="lista_destinatarios_e" style='display:none'></div>

								        	<div class="form-group">
								        		<label class="control-label col-sm-3" for="titulo">TÍTULO:</label>
								        		<div class="col-sm-7">
													<input type="text" class="form-control" id="titulo_e" name="titulo" placeholder="Título">
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-3" for="fecha_inicio">INICIO:</label>
												<div class="col-sm-3">
													<input type="date" class="form-control" id="fecha_inicio_e" name="fecha_inicio">
												</div>
												<div class="col-sm-2">
													<input type="time" class="form-control" id="hora_inicio_e" name="hora_inicio">
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-3" for="fecha_fin">FIN:</label>
												<div class="col-sm-3">
													<input type="date" class="form-control" id="fecha_fin_e" name="fecha_fin">
												</div>
												<div class="col-sm-2">
													<input type="time" class="form-control" id="hora_fin_e" name="hora_fin">
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-3" for="contenido">CONTENIDO:</label>
												<div class="col-sm-7">
													<textarea class="form-control" name="contenido" id="contenido_e" cols="50" rows="4" placeholder="Contenido.." style="resize:none"></textarea>
												</div>
											</div>

											<div class="form-group">
								        		<div class="col-sm-offset-6 col-sm-2"> 
													<button type="button" name="btn_cancelar_evento" id="btn_cancelar_evento" class="btn btn-warning btn-lg btn-block">Cancelar</button>
												</div>
												<div class="col-sm-2"> 
													<button type="submit" name="btn_registrar_evento" id="btn_registrar_evento" class="btn btn-success btn-lg btn-block">Enviar</button>
												</div>
											</div>

			        					</form>
			        				</div>
			        			</div>
			        		</div>		

		        		</div>

		        	</div>

		        	<div class="tab-pane" id="tab_4">

		        	</div>

		        </div>


    		</div>

    	</div>

    </div>

    


</div>


<!-- Modal  agregar destinatarios -->
<div id="modal_agregar_destinatario_m" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-envelope'></i>&nbsp;MENSAJES</h4>
      </div>
      <div class="modal-body">
        
      	<div class="panel panel-default">
		    <div class="panel-body">

		        <div class="row">	

					<div class="col-md-offset-1 col-md-5">
						<div class="form-group">
							<label for="id_grado">CURSO</label>
							<div id="cursos_inbox1">
								<select class="form-control" id="id_curso_m" name="id_curso">
											    
								</select>
							</div>
						</div>
					</div>

					<div class="col-md-5">
						<div class="form-group">
							<label for="id_asignatura">ASIGNATURA</label>
							<div id="asignaturas_inbox1">
								<select class="form-control" id="id_asignatura_m" name="id_asignatura">
											    
								</select>
							</div>
						</div>
					</div>	

				</div>

				<div class="row">
			    	<div class="col-md-12">
			    		<div class="box box-default">
			    			<div class="box-header with-border">
			    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Nombre Del Estudiante</div>
			    				<div class="box-tools pull-right">
							      <div class="has-feedback">
							        <input type="text" class="form-control input-sm" id="buscar_estudiante_m" name="buscar_estudiante" placeholder="Buscar...">
							        <span class="glyphicon glyphicon-search form-control-feedback"></span>
							      </div>
							    </div>
			    			</div>

		    				<div class="box-body">

		    					<!--<div class="form-group">
								  <label for="cantidad_estudiante" style='display:none'>Mostrar Por:</label>
								  <select class="selectpicker" id="cantidad_estudianteI" name="cantidad_estudiante" style='display:none'>
								    <option value="5">5</option>
				  					<option value="10">10</option>
				  					<option value="15">15</option>
				  					<option value="20">20</option>
								  </select>
								</div>-->

								<div class="table-responsive">
								<table border='1' id="lista_estudiantes_m" class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th><input type='checkbox' id="check_todos_m"></th>
											<th><i class='fa fa-sort-amount-asc'></i></th>
											<th><i class='fa fa-file-text-o'></i>&nbsp;Nombres</th>
											<th><i class='fa fa-file-text-o'></i>&nbsp;1° Apellido</th>
											<th><i class='fa fa-file-text-o'></i>&nbsp;2° Apellido</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								</div>

								<div id="paginacion_estudiante_m" class="text-center paginacion_estudiante_m">
								
								</div>

		    				</div>

			    		</div>
			    	</div>
			    </div>

		    </div>
		</div>        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn_agregar_estudiantes_m"><i class='fa fa-plus'></i>&nbsp;Agregar Estudiantes</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal  agregar destinatarios -->
<div id="modal_agregar_destinatario_t" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-pencil'></i>&nbsp;TAREAS</h4>
      </div>
      <div class="modal-body">
        
      	<div class="panel panel-default">
		    <div class="panel-body">

		        <div class="row">	

					<div class="col-md-offset-1 col-md-5">
						<div class="form-group">
							<label for="id_grado">CURSO</label>
							<div id="cursos_inbox1">
								<select class="form-control" id="id_curso_t" name="id_curso">
											    
								</select>
							</div>
						</div>
					</div>

					<div class="col-md-5">
						<div class="form-group">
							<label for="id_asignatura">ASIGNATURA</label>
							<div id="asignaturas_inbox1">
								<select class="form-control" id="id_asignatura_t" name="id_asignatura">
											    
								</select>
							</div>
						</div>
					</div>	

				</div>

				<div class="row">
			    	<div class="col-md-12">
			    		<div class="box box-default">
			    			<div class="box-header with-border">
			    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Nombre Del Estudiante</div>
			    				<div class="box-tools pull-right">
							      <div class="has-feedback">
							        <input type="text" class="form-control input-sm" id="buscar_estudiante_t" name="buscar_estudiante" placeholder="Buscar...">
							        <span class="glyphicon glyphicon-search form-control-feedback"></span>
							      </div>
							    </div>
			    			</div>

		    				<div class="box-body">

								<div class="table-responsive">
								<table border='1' id="lista_estudiantes_t" class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th><input type='checkbox' id="check_todos_t"></th>
											<th><i class='fa fa-sort-amount-asc'></i></th>
											<th><i class='fa fa-file-text-o'></i>&nbsp;Nombres</th>
											<th><i class='fa fa-file-text-o'></i>&nbsp;1° Apellido</th>
											<th><i class='fa fa-file-text-o'></i>&nbsp;2° Apellido</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								</div>

								<div id="paginacion_estudiante_t" class="text-center paginacion_estudiante_t">
								
								</div>

		    				</div>

			    		</div>
			    	</div>
			    </div>

		    </div>
		</div>        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn_agregar_estudiantes_t"><i class='fa fa-plus'></i>&nbsp;Agregar Estudiantes</button>
      </div>
    </div>

  </div>
</div>