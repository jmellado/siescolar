	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-clipboard'></i>&nbsp;GESTIÓN DE ACTIVIDADES</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_actividad" id="btn_agregar_actividad" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Actividad</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_actividad" name="buscar_actividad"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_actividad" id="btn_buscar_actividad" class="btn btn-primary">
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
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Actividades</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_grupo">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_actividad" name="cantidad_actividad" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_actividades" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Actividad</th>
									<th><i class='fa fa-clock-o'></i>&nbsp;Periodo</th>
									<th><i class='fa fa-th-large'></i>&nbsp;Curso</th>
									<th><i class='fa fa-clone'></i>&nbsp;Asignatura</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<td colspan='7'></td>
								</tr>
							</tfoot>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_actividad">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>

</div>


<!-- Modal  agregar nueva actividad -->
<div id="modal_agregar_actividad" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR ACTIVIDADES</h4>
      </div>
      <div class="modal-body">
        
	        <form role="form" action="<?php echo base_url(); ?>actividades_controller/insertar" name="" method="post" id="form_actividades">

	        	<input type="hidden" class="form-control" id="id_profesorA" name="id_profesor" value="<?php echo $this->session->userdata('id_persona')?>">

	        	<div class="row">
	        		<div class="col-md-12">
			        	<div class="panel panel-default">
			    			<div class="panel-body">

								<div class="form-group">
									<label for="descripcion_actividad">DESCRIPCIÓN DE ACTIVIDAD</label>
									<textarea class="form-control" name="descripcion_actividad" id="descripcion_actividad" cols="50" rows="4" placeholder="Descripción De La Actividad.." style="resize:none"></textarea>
								</div>
							
			    			</div>
			    		</div>
			    	</div>		

			    	<div class="col-md-12">
			        	<div class="panel panel-default">
			    			<div class="panel-body">

			    				<div class="col-md-4">
									<div class="form-group">
										<label for="periodo">PERIODO</label>
										<select class="form-control" id="periodoA" name="periodo">
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
										<div id="cursos_actividades1">
											<select class="form-control" id="id_cursoA" name="id_curso">
														    
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="id_asignatura">ASIGNATURA</label>
										<div id="asignaturas_actividades1">
											<select class="form-control" id="id_asignaturaA" name="id_asignatura">
														    
											</select>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
						
					
					<div class="col-sm-offset-4 col-sm-4">
						<div class="form-group">
							<button type="submit" name="btn_registrar_actividad" id="btn_registrar_actividad" class="btn btn-primary btn-lg btn-block">Registrar</button>
						</div>
					</div>
				</div>
					
	        </form>
		          
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>


<!-- Modal  actualizar actividad -->
<div id="modal_actualizar_actividad" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR ACTIVIDAD</h4>
      </div>
      <div class="modal-body">
        
        <form role="form" id="form_actividades_actualizar">
		    
			<div class="row">
        		<div class="col-md-12">
		        	<div class="panel panel-default">
		    			<div class="panel-body">

		    				<input type="hidden" class="form-control" id="id_actividadsele" name="id_actividad">

		    				<div class="col-md-4">
								<div class="form-group">
									<label for="periodo">PERIODO</label>
									<select class="form-control" id="periodoseleA" name="periodo" disabled>
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
									<input type="text" class="form-control" id="cursoseleA" name="id_curso" disabled>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="id_asignatura">ASIGNATURA</label>
									<input type="text" class="form-control" id="asignaturaseleA" name="id_asignatura" disabled>
								</div>
							</div>

		    			</div>
		    		</div>
		    	</div>

		    	<div class="col-md-12">
		        	<div class="panel panel-default">
		    			<div class="panel-body">

		    				<div class="form-group">
								<label for="descripcion_actividad">DESCRIPCIÓN DE ACTIVIDAD</label>
								<textarea class="form-control" name="descripcion_actividad" id="descripcion_actividadseleA" cols="50" rows="4" placeholder="Descripción De La Actividad.." style="resize:none"></textarea>
							</div>

		    			</div>
		    		</div>
		    	</div>		
			</div>

        </form>

        <div class="row">
	        <div class="form-group">
				<div class="col-sm-offset-4 col-sm-4">
    				<button type="submit" name="btn_actualizar_actividad" id="btn_actualizar_actividad" class="btn btn-primary btn-lg btn-block">Actualizar</button>
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