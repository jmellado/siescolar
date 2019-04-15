	<style type="text/css">
	    
	    label.error{color:red;}

	    #modal_actualizar_seguimiento .modal-body
		{
  			height:450px;
  			overflow:auto;
		}
	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/seguimientosA.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-retweet'></i>&nbsp;CONSULTA DE SEGUIMIENTOS ACADÉMICOS Y/O DISCIPLINARIOS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-offset-4 col-lg-4">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_seguimiento" name="buscar_seguimiento"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_seguimiento" id="btn_buscar_seguimiento" class="btn btn-primary">
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
    			<div class="box-header with-border"><div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Seguimientos</div></div>
    				<div class="box-body">

    					<div class="form-group">
						  <label for="cantidad_seguimiento">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_seguimiento" name="cantidad_seguimiento" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_seguimientos" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-th-large'></i>&nbsp;Curso</th>
									<th><i class='fa fa-user'></i>&nbsp;Estudiante</th>
									<th><i class='fa fa-check-circle'></i>&nbsp;Tipo Causal</th>
									<th><i class='fa fa-calendar-check-o'></i>&nbsp;Fecha Causal</th>
									<th><i class='fa fa-shield'></i>&nbsp;Estado</th>
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

						<div class="text-center paginacion_seguimiento">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>


</div>


<!-- Modal  actualizar seguimiento -->
<div id="modal_actualizar_seguimiento" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

	    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR SEGUIMIENTO</h4>
	      	</div>
	      	<div class="modal-body">
		        <div class="panel panel-default">
				    <div class="panel-body">

				        <form role="form" id="form_seguimientos_actualizar">
						    
							<input type="hidden" class="form-control" id="id_seguimientosele" name="id_seguimiento">

							<div class="panel panel-default">
				    			<div class="panel-body">

									<div class="col-md-6">
										<div class="form-group">
											<label for="id_profesor">PROFESOR QUE REGISTRA</label>
											<input type="text" class="form-control" id="profesorsele" name="profesorsele" disabled>
										</div>
									</div>

								</div>
							</div>

							<div class="panel panel-default">
				    			<div class="panel-body">
									<div class="col-md-3">
										<div class="form-group">
											<label for="id_curso">CURSO</label>
											<input type="text" class="form-control" id="cursosele" name="cursosele" disabled>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="id_asignatura">ASIGNATURA</label>
											<input type="text" class="form-control" id="asignaturasele" name="asignaturasele" disabled>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="id_estudiante">ESTUDIANTE</label>
											<input type="text" class="form-control" id="estudiantesele" name="estudiantesele" disabled>
										</div>
									</div>
								</div>
							</div>
							
							<div class="panel panel-default">
				    			<div class="panel-body">

				    				<div class="col-md-3">
										<div class="form-group">
											<label for="id_tipo_causal">TIPO CAUSAL</label>
											<div id="tipocausal_seguimientos1">
												<select class="form-control" id="id_tipo_causalseleSG" name="id_tipo_causal">
															    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="id_causal">CAUSALES</label>
											<div id="causales_seguimientos1">
												<select class="form-control" id="id_causalseleSG" name="id_causal">
															    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="id_causal">FECHA CAUSAL</label>
											<input type="date" class="form-control" id="fecha_causalseleSG" name="fecha_causal">
										</div>
									</div>

									<div class="col-md-9">
										<div class="form-group">
											<label for="descripcion_situacion">DESCRIBIR SITUACIÓN</label>
											<textarea class="form-control" name="descripcion_situacion" id="descripcion_situacionseleSG" cols="50" rows="4" placeholder="Descripción De La Situación.." style="resize:none"></textarea>
										</div>
									</div>

				    			</div>
				    		</div>

				    		<div class="panel panel-default">
				    			<div class="panel-body">

				    				<div class="col-md-4">
										<div class="form-group">
											<label for="id_accion_pedagogica">ACCIÓN PEDAGÓGICA</label>
											<div id="accionespedagogicas_seguimientos1">
												<select class="form-control" id="id_accion_pedagogicaseleSG" name="id_accion_pedagogica">
															    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-9">
										<div class="form-group">
											<label for="descripcion_accion">DESCRIBIR ACCIÓN PEDAGÓGICA</label>
											<textarea class="form-control" name="descripcion_accion" id="descripcion_accionseleSG" cols="50" rows="4" placeholder="Descripción De La Acción Pedagógica.." style="resize:none"></textarea>
										</div>
									</div>

									<div class="col-md-9">
										<div class="form-group">
											<label for="compromiso_estudiante">COMPROMISO DEL ESTUDIANTE</label>
											<textarea class="form-control" name="compromiso_estudiante" id="compromiso_estudianteseleSG" cols="50" rows="4" placeholder="Compromiso Del Estudiante Por Mejorar.." style="resize:none"></textarea>
										</div>
									</div>

									<div class="col-md-9">
										<div class="form-group">
											<label for="observaciones">OBSERVACIONES</label>
											<textarea class="form-control" name="observaciones" id="observacionesseleSG" cols="50" rows="4" placeholder="Observaciones.." style="resize:none"></textarea>
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
					<div class="form-group">
						<button type="submit" name="btn_actualizar_seguimiento" id="btn_actualizar_seguimiento" class="btn btn-primary btn-block">Actualizar</button>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-group">
						<button type="button" name="btn_cerrar_seguimiento" id="btn_cerrar_seguimiento" class="btn btn-warning btn-block">Cerrar Seguimiento</button>
					</div>
				</div>
	      	</div>
	    </div>

  	</div>
</div>