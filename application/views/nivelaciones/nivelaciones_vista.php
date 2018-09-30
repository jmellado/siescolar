<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/nivelaciones.js" defer></script>

<style type="text/css">
    
    label.error{color:red;}

	#modal_agregar_nivelacion .modal-body
	{
		height:450px;
		overflow:auto;
	}

	#modal_actualizar_nivelacion .modal-body
	{
		height:490px;
		overflow:auto;
	}
</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-sliders'></i>&nbsp;GESTIÓN DE NIVELACIONES</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_nivelacion" id="btn_agregar_nivelacion" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Registrar Nivelación</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_nivelacion" name="buscar_nivelacion"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_nivelacion" id="btn_buscar_nivelacion" class="btn btn-primary">
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
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Nivelaciones</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_nivelacion">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_nivelacion" name="cantidad_nivelacion">
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_nivelaciones" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-th-large'></i>&nbsp;Curso</th>
									<th><i class='fa fa-user'></i>&nbsp;Estudiante</th>
									<th><i class='fa fa-clock-o'></i>&nbsp;Período</th>
									<th><i class='fa fa-clone'></i>&nbsp;Asignatura</th>
									<th><i class='fa fa-calendar-check-o'></i>&nbsp;Fecha Nivelación</th>
									<th><i class='fa fa-calendar-times-o'></i>&nbsp;Año lectivo</th>
									<th></th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<td colspan='8'></td>
								</tr>
							</tfoot>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_nivelacion">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>

</div>


<!-- Modal  agregar nueva nivelacion -->
<div id="modal_agregar_nivelacion" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR NIVELACIONES</h4>
      </div>
      <div class="modal-body">
        
        <div class="panel panel-default">
		    <div class="panel-body">

		        <form role="form" action="<?php echo base_url(); ?>nivelaciones_controller/insertar" name="" method="post" id="form_nivelaciones">

		        	<div class="panel panel-default">
		    			<div class="panel-body">
		    				<div class="col-md-3">
		    					<div class="form-group">
									<label for="id_curso">CURSO</label>
									<div id="curso_nivelacion1">
										<select class="form-control" id="id_cursoNV" name="id_curso">
													    
										</select>
									</div>
								</div>
		    				</div>
		    				
		    				<div class="col-md-4">
		    					<div class="form-group">
									<label for="id_asignatura">ASIGNATURA</label>
									<div id="asignatura_nivelacion1">
										<select class="form-control" id="id_asignaturaNV" name="id_asignatura">
													    
										</select>
									</div>
								</div>
		    				</div>

		    				<div class="col-md-5">
		    					<div class="form-group">
									<label for="id_profesor">PROFESOR</label>
									<div id="profesor_nivelacion1">
										<select class="form-control" id="id_profesorNV" name="id_profesor" disabled>
													    
										</select>
									</div>
								</div>
		    				</div>	
		    			</div>
		    		</div>

		    		<div class="panel panel-default">
		    			<div class="panel-body">
		    				<div class="col-md-3">
		    					<div class="form-group">
									<label for="periodo">PERIODO</label>
									<select class="form-control" id="periodoNV" name="periodo" disabled>
											<option value=""></option>
											<option value="Primero">Primero</option>
											<option value="Segundo">Segundo</option>
											<option value="Tercero">Tercero</option>
											<option value="Cuarto">Cuarto</option>
									</select>
								</div>
		    				</div>
		    				
		    				<div class="col-md-6">
		    					<div class="form-group">
									<label for="id_estudiante">ESTUDIANTE</label>
									<div id="estudiante_nivelacion1">
										<select class="form-control" id="id_estudianteNV" name="id_estudiante">
													    
										</select>
									</div>
								</div>
		    				</div>

		    				<div class="col-md-3">
		    					<div class="form-group">
									<label for="calificacion"><i class='fa fa-chevron-right'></i>&nbsp;CALIFICACIÓN</label>
									<input type="text" class="form-control" id="calificacionNV" name="calificacion" readonly>
								</div>
		    				</div>

		    				<div class="col-md-3">
		    					<div class="form-group">
									<label for="nivelacion"><i class='fa fa-chevron-right'></i>&nbsp;NIVELACIÓN</label>
									<input type="text" class="form-control" id="nivelacionNV" name="nivelacion" onKeypress="return valida_nivelacionNV(event)">
								</div>
		    				</div>

		    				<div class="col-md-3">
		    					<div class="form-group">
									<label for="fecha_nivelacion">FECHA NIVELACIÓN</label>
									<input type="date" class="form-control" id="fecha_nivelacionNV" name="fecha_nivelacion">
								</div>
		    				</div>

		    				<div class="col-md-3">
		    				</div>	

		    				<div class="col-md-9">
								<div class="form-group">
									<label for="descripcion_situacion">OBSERVACIONES</label>
									<textarea class="form-control" name="observaciones" id="observacionesNV" cols="50" rows="3" placeholder="Descripción De La Situación.." style="resize:none"></textarea>
								</div>
							</div>	
		    			</div>
		    		</div>					

		        </form>
		    </div>
		</div>        

      </div>
      <div class="modal-footer">
		<div class="col-sm-offset-8 col-sm-4">
			<div class="form-group"">
				<button type="submit" name="btn_registrar_nivelacion" id="btn_registrar_nivelacion" class="btn btn-primary btn-block">Registrar</button>
			</div>
		</div>
      </div>
    </div>

  </div>
</div>


<!-- Modal  actualizar nivelacion -->
<div id="modal_actualizar_nivelacion" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;NIVELACIÓN</h4>
      </div>
      <div class="modal-body">
        
        <div class="panel panel-default">
		    <div class="panel-body">

		        <form role="form" id="form_nivelaciones_actualizar">

		        	<input type="hidden" class="form-control" id="id_nivelacionsele" name="id_nivelacion">

		        	<div class="panel panel-default">
		    			<div class="panel-body">
		    				<div class="col-md-3">
		    					<div class="form-group">
									<label for="id_curso">CURSO</label>
									<input type="text" class="form-control" id="cursoseleNV" name="cursosele" disabled>
								</div>
		    				</div>
		    				
		    				<div class="col-md-4">
		    					<div class="form-group">
									<label for="id_asignatura">ASIGNATURA</label>
									<input type="text" class="form-control" id="asignaturaseleNV" name="asignaturasele" disabled>
								</div>
		    				</div>

		    				<div class="col-md-5">
		    					<div class="form-group">
									<label for="id_profesor">PROFESOR</label>
									<input type="text" class="form-control" id="profesorseleNV" name="profesorsele" disabled>
								</div>
		    				</div>	
		    			</div>
		    		</div>

		    		<div class="panel panel-default">
		    			<div class="panel-body">
		    				<div class="col-md-3">
		    					<div class="form-group">
									<label for="periodo">PERIODO</label>
									<select class="form-control" id="periodoseleNV" name="periodo" disabled>
											<option value=""></option>
											<option value="Primero">Primero</option>
											<option value="Segundo">Segundo</option>
											<option value="Tercero">Tercero</option>
											<option value="Cuarto">Cuarto</option>
									</select>
								</div>
		    				</div>
		    				
		    				<div class="col-md-6">
		    					<div class="form-group">
									<label for="id_estudiante">ESTUDIANTE</label>
									<input type="text" class="form-control" id="estudianteseleNV" name="estudiantesele" disabled>
								</div>
		    				</div>

		    				<div class="col-md-3">
		    					<div class="form-group">
									<label for="calificacion"><i class='fa fa-chevron-right'></i>&nbsp;CALIFICACIÓN</label>
									<input type="text" class="form-control" id="calificacionseleNV" name="calificacion" disabled>
								</div>
		    				</div>

		    				<div class="col-md-3">
		    					<div class="form-group">
									<label for="nivelacion"><i class='fa fa-chevron-right'></i>&nbsp;NIVELACIÓN</label>
									<input type="text" class="form-control" id="nivelacionseleNV" name="nivelacion" onKeypress="return valida_nivelacionNV(event)" disabled>
								</div>
		    				</div>

		    				<div class="col-md-3">
		    					<div class="form-group">
									<label for="fecha_nivelacion">FECHA NIVELACIÓN</label>
									<input type="date" class="form-control" id="fecha_nivelacionseleNV" name="fecha_nivelacion" disabled>
								</div>
		    				</div>

		    				<div class="col-md-3">
		    				</div>	

		    				<div class="col-md-9">
								<div class="form-group">
									<label for="descripcion_situacion">OBSERVACIONES</label>
									<textarea class="form-control" name="observaciones" id="observacionesseleNV" cols="50" rows="3" placeholder="Descripción De La Situación.." style="resize:none" disabled></textarea>
								</div>
							</div>	
		    			</div>
		    		</div>

		        </form>
		    </div>
		</div>        

      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>