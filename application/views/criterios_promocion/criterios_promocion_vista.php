	<style type="text/css">
	    
	    label.error{color:red;}

	    .panel-margen{
			margin-bottom: 0px;
		}

		.centrado{
			text-align: center;
		}

	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/criterios_promocion.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-check-square-o'></i>&nbsp;CRITERIOS DE PROMOCIÓN</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_criterios_promocion" id="btn_agregar_criterios_promocion" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Asignar Criterio De Promoción</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_criterios_promocion" name="buscar_criterios_promocion" placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_criterios_promocion" id="btn_buscar_criterios_promocion" class="btn btn-primary">
							<i class="fa fa-search"></i>
						</button>
					</span>
    			</div>
    		</div>	
    	</div>

    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="box box-default">
    			<div class="box-header with-border">
    				<div class="box-title">
    					<i class='fa fa-list'></i>&nbsp;Lista De Criterios De Promoción Asignados
    				</div>		
    			</div>
    			
				<div class="box-body">

					<div class="form-group">
					  <label for="cantidad_criterio">Mostrar Por:</label>
					  <select class="selectpicker" id="cantidad_criterios_promocion" name="cantidad_criterio" >
					    <option value="5">5</option>
	  					<option value="10">10</option>
	  					<option value="15">15</option>
	  					<option value="20">20</option>
					  </select>
					</div>

					<div class="table-responsive">
					<table border='1' id="lista_criterios_promocion" class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<tr>
								<th><i class='fa fa-sort-amount-asc'></i></th>
								<th width="130"><i class='fa fa-graduation-cap'></i>&nbsp;Grado</th>
								<th width="220"><i class='fa fa-check-square-o'></i>&nbsp;Criterio</th>
								<th class="centrado"><i class='fa fa-caret-right'></i>&nbsp;N° Areas o Asignaturas</th>
								<th class="centrado"><i class='fa fa-caret-right'></i>&nbsp;Porcentaje De Inasistencia</th>
								<th width="220" class="centrado"><i class='fa fa-clone'></i>&nbsp;Asignatura Especifica</th>
								<th><i class='fa fa-calendar-times-o'></i>&nbsp;Año Lectivo</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td colspan='9'></td>
							</tr>
						</tfoot>
						<tbody>
						</tbody>
					</table>
					</div>

					<div class="text-center paginacion_criterios_promocion">
					
					</div>

				</div>

    		</div>
    	</div>
    </div>

</div>


<!-- Modal  agregar nuevo criterio -->
<div id="modal_agregar_criterios_promocion" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;ASIGNACION DE CRITERIOS</h4>
			</div>

			<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>criterios_promocion_controller/insertar" name="" method="post" id="form_criterios_promocion">

		      	<div class="modal-body">
		        
			      	<div class="panel panel-default panel-margen">
					    <div class="panel-body">

					    	<div class="form-group">
								<label class="control-label col-sm-3" for="id_grado">GRADO</label>
								<div class="col-sm-7">
									<div id="gradoCP1">
										<select class="form-control" id="id_gradoCP" name="id_grado">
														    
										</select>
									</div>
								</div>	
							</div>

					    	<div class="form-group">
								<label class="control-label col-sm-3" for="id_criterio">CRITERIO</label>
								<div class="col-sm-7">
									<div id="criterio1">
										<select class="form-control" id="id_criterio" name="id_criterio">
														    
										</select>
									</div>
								</div>	
							</div>

							<div id="vacio" style="display:none;"></div>

							<div id="1" style="display:none;">
								<div class="form-group">
									<label class="control-label col-sm-3" for="numero_areas_asignaturas">N° DE AREAS O ASIGNATURAS</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="numero_areas_asignaturas" name="numero_areas_asignaturas" placeholder="N° Areas o Asignaturas">
									</div>		 
								</div>
							</div>

							<div id="2" style="display:none;">
								<div class="form-group">
									<label class="control-label col-sm-3" for="porcentaje_inasistencias">PORCENTAJE DE INASISTENCIAS</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="porcentaje_inasistencias" name="porcentaje_inasistencias" placeholder="% De Inasistencias">
									</div>		 
								</div>
							</div>

							<div id="3" style="display:none;">
								<div class="form-group">
									<label class="control-label col-sm-3" for="asignatura_especifica">ASIGNATURA ESPECIFICA</label>
									<div class="col-sm-7">
										<div id="asignaturaCP1">
											<select class="form-control" id="asignatura_especifica" name="asignatura_especifica">
															    
											</select>
										</div>
									</div>	
								</div>
							</div>
							
					    </div>
					</div>        

		      	</div>

		      	<div class="modal-footer">
		      		<div class="col-sm-offset-4 col-sm-4">
						<button type="submit" name="btn_registrar_criterios_promocion" id="btn_registrar_criterios_promocion" class="btn btn-primary btn-lg btn-block">Asignar Criterio</button>
					</div>
		      	</div>
	      	</form>	
	    </div>

	</div>
</div>


<!-- Modal  actualizar criterio -->
<div id="modal_actualizar_criterios_promocion" class="modal fade" role="dialog">
	<div class="modal-dialog">

    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR CRITERIO</h4>
      		</div>
      		<div class="modal-body">
        
		        <div class="panel panel-default panel-margen">
				    <div class="panel-body">

				        <form class="form-horizontal" role="form" id="form_criterios_promocion_actualizar">
							    
							<input type="hidden" class="form-control" id="id_criterio_asignadosele" name="id_criterio_asignado">

							<div class="form-group">
								<label class="control-label col-sm-3" for="nombre_gradosele">GRADO</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="nombre_gradosele" name="nombre_gradosele" disabled>
								</div>		 
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="nombre_criterio">CRITERIO</label>
								<div class="col-sm-7">
									<textarea class="form-control" name="nombre_criterio" id="nombre_criteriosele" cols="50" rows="2" style="resize:none" disabled></textarea>
								</div>		 
							</div>

							<input type="hidden" class="form-control" id="codigo_criteriosele" name="codigo_criterio">

							<div id="11" style="display:none;">
								<div class="form-group">
									<label class="control-label col-sm-3" for="numero_areas_asignaturas">N° DE AREAS O ASIGNATURAS</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="numero_areas_asignaturassele" name="numero_areas_asignaturas" placeholder="N° Areas o Asignaturas">
									</div>		 
								</div>
							</div>

							<div id="22" style="display:none;">
								<div class="form-group">
									<label class="control-label col-sm-3" for="porcentaje_inasistencias">PORCENTAJE DE INASISTENCIAS</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="porcentaje_inasistenciassele" name="porcentaje_inasistencias" placeholder="% De Inasistencias">
									</div>		 
								</div>
							</div>

							<div id="33" style="display:none;">
								<div class="form-group">
									<label class="control-label col-sm-3" for="asignatura_especifica">ASIGNATURA ESPECIFICA</label>
									<div class="col-sm-7">
										<div id="asignaturaCP11">
											<select class="form-control" id="asignatura_especificasele" name="asignatura_especifica">
															    
											</select>
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
	        		<button type="submit" name="btn_actualizar_criterios_promocion" id="btn_actualizar_criterios_promocion" class="btn btn-primary btn-lg btn-block">Actualizar</button>
	        	</div>
			</div>
    	</div>

	</div>
</div>