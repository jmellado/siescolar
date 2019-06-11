	<style type="text/css">
	    
	    label.error{color:red;}

	    .panel-margen{
			margin-bottom: 0px;
		}

	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-sitemap'></i>&nbsp;GESTIÓN DE PENSUM</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_pensum" id="btn_agregar_pensum" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Pensum</button>
    		</div>
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_pensum" name="buscar_pensum"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_pensum" id="btn_buscar_pensum" class="btn btn-primary">
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
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Pensum</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_pensum">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_pensum" name="cantidad_pensum" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_pensum" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-graduation-cap'></i>&nbsp;Grado</th>
									<th><i class='fa fa-clone'></i>&nbsp;Asignatura</th>
									<th><i class='fa fa-clock-o'></i>&nbsp;Horas</th>
									<th><i class='fa fa-calendar-times-o'></i>&nbsp;Año lectivo</th>
									<th><i class='fa fa-shield'></i>&nbsp;Estado</th>
									<th></th>
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

						<div class="text-center paginacion_pensum">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>



</div>

<!-- Modal  agregar nuev pensum -->
<div id="modal_agregar_pensum" class="modal fade" role="dialog">
	<div class="modal-dialog">

    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR PENSUM</h4>
      		</div>

      		<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>pensum_controller/insertar" name="" method="post" id="form_pensum">
	      		<div class="modal-body">
	        
			      	<div class="panel panel-default panel-margen">
					    <div class="panel-body">

							<div class="form-group">
								<label class="control-label col-sm-3" for="id_grado">GRADO</label>
								<div class="col-sm-7">
									<div id="grado1">
										<select class="form-control" id="id_grado" name="id_grado">
														    
										</select>
									</div>
								</div>	
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="id_asignatura">ASIGNATURA</label>
								<div class="col-sm-7">
									<div id="asignatura1">
										<select class="form-control" id="id_asignatura" name="id_asignatura">
														    
										</select>
									</div>
								</div>	
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="intensidad_horaria">HORAS</label>
								<div class="col-sm-2">
									<select class="form-control" id="intensidad_horaria" name="intensidad_horaria">
											<option value=""></option>
											<option value="0">0</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
									</select>
								</div>	
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="año_lectivo">AÑO LECTIVO</label>
								<div class="col-sm-7">
									<div id="ano_lectivo1">
										<select class="form-control" id="ano_lectivo" name="ano_lectivo">
														    
										</select>
									</div>
								</div>	
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="estado_pensum">ESTADO</label>
								<div class="col-sm-7">
									<select class="form-control" id="estado_pensum" name="estado_pensum">
											<option value="Activo">Activo</option>
											<option value="Inactivo">Inactivo</option>
									</select>
								</div>	
							</div>		

					    </div>
					</div>        

	      		</div>
	      		<div class="modal-footer">
	        		<div class="col-sm-offset-4 col-sm-4">
						<button type="submit" name="btn_registrar_pensum" id="btn_registrar_pensum" class="btn btn-primary btn-lg btn-block">Registrar</button>
					</div>
	      		</div>
      		</form>
    	</div>

  	</div>
</div>

<!-- Modal  actualizar pensum -->
<div id="modal_actualizar_pensum" class="modal fade" role="dialog">
	<div class="modal-dialog">

    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR PENSUM</h4>
      		</div>
      		<div class="modal-body">
        
		      	<div class="panel panel-default panel-margen">
				    <div class="panel-body">

				        <form class="form-horizontal" role="form" id="form_pensum_actualizar">
						    
							<input type="hidden" class="form-control" id="id_pensumsele" name="id_pensum">
							
							<!--<div class="form-group">
								<label class="control-label col-sm-3" for="id_grado">GRADO</label>
								<div class="col-sm-7">
									<div id="grado1">
										<select class="form-control" id="id_gradosele" name="id_grado">
														    
										</select>
									</div>
								</div>	
							</div>-->

							<div class="form-group">
								<label class="control-label col-sm-3" for="grado">GRADO</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="gradosele" name="grado" disabled>
								</div>	
							</div>
							<input type="hidden" class="form-control" id="id_gradosele" name="id_grado">

							<!--<div class="form-group">
								<label class="control-label col-sm-3" for="id_asignatura">ASIGNATURA</label>
								<div class="col-sm-7">
									<div id="asignatura1">
										<select class="form-control" id="id_asignaturasele" name="id_asignatura">
														    
										</select>
									</div>
								</div>	
							</div>-->

							<div class="form-group">
								<label class="control-label col-sm-3" for="asignatura">ASIGNATURA</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="asignaturasele" name="asignatura" disabled>
								</div>	
							</div>
							<input type="hidden" class="form-control" id="id_asignaturasele" name="id_asignatura">

							<div class="form-group">
								<label class="control-label col-sm-3" for="intensidad_horaria">HORAS</label>
								<div class="col-sm-2">
									<select class="form-control" id="intensidad_horariasele" name="intensidad_horaria">
											<option value=""></option>
											<option value="0">0</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
									</select>
								</div>	
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="anolectivo">AÑO LECTIVO</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="anolectivosele" name="anolectivo" disabled>
								</div>	
							</div>
							<input type="hidden" class="form-control" id="ano_lectivosele" name="ano_lectivo">

							<div class="form-group">
								<label class="control-label col-sm-3" for="estado_pensum">ESTADO</label>
								<div class="col-sm-7">
									<select class="form-control" id="estado_pensumsele" name="estado_pensum">
											<option value="Activo">Activo</option>
											<option value="Inactivo">Inactivo</option>
									</select>
								</div>	
							</div>
			
				        </form>

				    </div>
				</div>        

      		</div>
      		<div class="modal-footer">
        		<div class="col-sm-offset-4 col-sm-4">
	        		<button type="submit" name="btn_actualizar_pensum" id="btn_actualizar_pensum" class="btn btn-primary btn-lg btn-block">Actualizar</button>
	        	</div>
      		</div>
    	</div>

	</div>
</div>