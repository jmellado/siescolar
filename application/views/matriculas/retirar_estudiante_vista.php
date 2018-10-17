<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/retirar_estudiante.js" defer></script>

<style type="text/css">

    label.error{color:red;}

    #modal_agregar_retiro .modal-body
	{
		height:393px;
		overflow:auto;
	}

	#modal_actualizar_retiro .modal-body
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
            <h1 class="page-header"><i class='fa fa-shield'></i>&nbsp;RETIRO DE ESTUDIANTES</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_retiro" id="btn_agregar_retiro" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Retirar Estudiante</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_retiro" name="buscar_retiro"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_retiro" id="btn_buscar_retiro" class="btn btn-primary">
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
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Estudiantes Retirados</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_retiro">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_retiro" name="cantidad_retiro">
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_retiros" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-th-large'></i>&nbsp;Curso</th>
									<th><i class='fa fa-user'></i>&nbsp;Estudiante</th>
									<th><i class='fa fa-calendar-check-o'></i>&nbsp;Fecha Retiro</th>
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

						<div class="text-center paginacion_retiro">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>


</div>


<!-- Modal  agregar retiro -->
<div id="modal_agregar_retiro" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;RETIRAR ESTUDIANTE</h4>
			</div>
	    	
	    	<form role="form" action="<?php echo base_url(); ?>matriculas_controller/insertar_retiro" name="" method="post" id="form_retiros">
		    	<div class="modal-body">
		        
			        <div class="panel panel-default panel-margen">
					    <div class="panel-body">

					    	<div class="panel panel-default panel-margen1">
					    		<div class="panel-body">
						        	<div class="col-md-5">
										<div class="form-group">
											<label for="jornada">JORNADA</label>
											<select class="form-control" id="jornadaRT" name="jornada">
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
											<div id="curso_retiros1">
												<select class="form-control" id="id_cursoRT" name="id_curso">
																    
												</select>
											</div>
										</div>
									</div>
								</div>	
							</div>
							
							<div class="panel panel-default panel-margen1">
					    		<div class="panel-body">	
									<div class="col-md-7">
				    					<div class="form-group">
											<label for="id_estudiante">ESTUDIANTE</label>
											<div id="estudiante_retiros1">
												<select class="form-control" id="id_estudianteRT" name="id_estudiante">
															    
												</select>
											</div>
										</div>
				    				</div>

				    				<div class="col-md-5">
				    					<div class="form-group">
											<label for="fecha_retiro">FECHA RETIRO</label>
											<input type="date" class="form-control" id="fecha_retiroRT" name="fecha_retiro">
										</div>
				    				</div>

				    				<div class="col-md-12">
										<div class="form-group">
											<label for="observaciones">OBSERVACIONES</label>
											<textarea class="form-control" name="observaciones" id="observacionesRT" cols="50" rows="3" placeholder="Observaciones.." style="resize:none"></textarea>
										</div>
									</div>
				    			</div>		
				    		</div>
				    			
					    </div>
					</div>        

		      	</div>
				<div class="modal-footer">
					<div class="col-sm-offset-3 col-sm-6">
						<button type="submit" name="btn_registrar_retiro" id="btn_registrar_retiro" class="btn btn-primary btn-lg btn-block">Retirar Estudiante</button>
					</div>
				</div>
			</form>
	    </div>

  	</div>
</div>


<!-- Modal  actualizar retiro -->
<div id="modal_actualizar_retiro" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;RETIRO DE ESTUDIANTE</h4>
			</div>
	    	
	    	<div class="modal-body">
	        
		        <div class="panel panel-default panel-margen">
				    <div class="panel-body">

				    	<form role="form" id="form_retiros_actualizar">

				    		<input type="hidden" class="form-control" id="id_retirosele" name="id_retiro">

					    	<div class="panel panel-default panel-margen1">
					    		<div class="panel-body">
						        	<div class="col-md-5">
										<div class="form-group">
											<label for="jornada">JORNADA</label>
											<select class="form-control" id="jornadaseleRT" name="jornada" disabled>
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
											<input type="text" class="form-control" id="cursoseleRT" name="cursosele" disabled>
										</div>
									</div>
								</div>	
							</div>
						
							<div class="panel panel-default panel-margen1">
					    		<div class="panel-body">	
									<div class="col-md-7">
				    					<div class="form-group">
											<label for="id_estudiante">ESTUDIANTE</label>
											<input type="text" class="form-control" id="estudianteseleRT" name="estudiantesele" disabled>
										</div>
				    				</div>

				    				<div class="col-md-5">
				    					<div class="form-group">
											<label for="fecha_retiro">FECHA RETIRO</label>
											<input type="date" class="form-control" id="fecha_retiroseleRT" name="fecha_retiro" disabled>
										</div>
				    				</div>

				    				<div class="col-md-12">
										<div class="form-group">
											<label for="observaciones">OBSERVACIONES</label>
											<textarea class="form-control" name="observaciones" id="observacionesseleRT" cols="50" rows="3" placeholder="Observaciones.." style="resize:none" disabled></textarea>
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
					<button type="submit" name="btn_actualizar_retiro" id="btn_actualizar_retiro" class="btn btn-primary btn-lg btn-block">Actualizar Retiro Estudiante</button>
				</div>-->
			</div>
			
	    </div>

  	</div>
</div>