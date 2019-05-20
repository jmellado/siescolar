<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/consultar_seguimientosA.js" defer></script>

<style type="text/css">

    label.error{color:red;}

    #modal_detalle_seguimientoA .modal-body
	{
		height:450px;
		overflow:auto;
	}

    .panel-margen{
		margin-bottom: 0px;
	}

</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-retweet'></i>&nbsp;SEGUIMIENTOS ACADÉMICOS Y/O DISCIPLINARIOS</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="" name="" method="post" id="form_consultar_seguimientosA">

						<div class="col-md-offset-1 col-md-4">
							<div class="form-group">
								<label for="id_acudido">ACUDIDOS</label>
								<div id="acudidos_seguimientosA1">
									<select class="form-control" id="id_acudidoSA" name="id_acudido">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="id_asignatura">ASIGNATURA</label>
								<div id="asignaturas_seguimientosA1">
									<select class="form-control" id="id_asignaturaSA" name="id_asignatura">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-2">
	        				<div class="form-group">
	        					<label for=""></label>
								<button type="button" name="btn_consultar_seguimientosA" id="btn_consultar_seguimientosA" class="btn btn-primary btn-lg btn-block">Consultar</button>
							</div>
	        			</div>

                	</form>
                </div>
            </div>    	
    	</div>	
    </div>

    <div id="div-consultarseguimientosA" class="row" style="display:none;">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">

                	<div class="box">
		    			<div class="box-header with-border">
		    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Seguimientos</div>

		    				<div class="box-tools pull-right">
						    	<div class="has-feedback">
						        	<input type="text" class="form-control input-sm" id="buscar_seguimientoA" name="buscar_tarea" placeholder="Buscar...">
						        	<span class="glyphicon glyphicon-search form-control-feedback"></span>
						      	</div>
						    </div>	
		    			</div>

		    			<div class="box-body">
		                	<div class="table-responsive">
								<table border='1' id="lista_seguimientosA" class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th><i class='fa fa-sort-amount-asc'></i></th>
											<th width="300"><i class='fa fa-check-circle'></i>&nbsp;Tipo Causal</th>
											<th width="200"><i class='fa fa-clone'></i>&nbsp;Asignatura</th>
											<th style="text-align: center"><i class='fa fa-calendar-plus-o'></i>&nbsp;Fecha Causal</th>
											<th style="text-align: center"><i class='fa fa-calendar-check-o'></i>&nbsp;Fecha Registro</th>
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
						</div>
					</div>		

                </div>
            </div>
        </div>        	
    </div>

</div>


<!-- Modal  detalle seguimiento -->
<div id="modal_detalle_seguimientoA" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

	    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title"><i class='fa fa-retweet'></i>&nbsp;SEGUIMIENTO</h4>
	      	</div>
	      	<div class="modal-body">
		        <div class="panel panel-default panel-margen">
				    <div class="panel-body">

				        <form role="form" id="form_seguimientos_actualizar">
						    
							<input type="hidden" class="form-control" id="id_seguimientosele" name="id_seguimiento">

							<div class="panel panel-default">
				    			<div class="panel-body">
		
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

				    				<div class="col-md-5">
										<div class="form-group">
											<label for="tipo_causal">TIPO CAUSAL</label>
											<textarea class="form-control" name="tipo_causal" id="tipo_causalsele" cols="50" rows="2" placeholder="Tipo Causal.." style="resize:none" readonly></textarea>
										</div>
									</div>

									<div class="col-md-7">
										<div class="form-group">
											<label for="causal">CAUSAL</label>
											<textarea class="form-control" name="causal" id="causalsele" cols="50" rows="2" placeholder="Causal.." style="resize:none" readonly></textarea>
										</div>
									</div>

									<div class="col-md-9">
										<div class="form-group">
											<label for="descripcion_situacion">DESCRIPCIÓN SITUACIÓN</label>
											<textarea class="form-control" name="descripcion_situacion" id="descripcion_situacionsele" cols="50" rows="4" placeholder="Descripción De La Situación.." style="resize:none" readonly></textarea>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="id_causal">FECHA CAUSAL</label>
											<input type="date" class="form-control" id="fecha_causalsele" name="fecha_causal" disabled>
										</div>
									</div>

				    			</div>
				    		</div>

				    		<div class="panel panel-default">
				    			<div class="panel-body">

				    				<div class="col-md-9">
										<div class="form-group">
											<label for="accion_pedagogica">ACCIÓN PEDAGÓGICA</label>
											<textarea class="form-control" name="accion_pedagogica" id="accion_pedagogicasele" cols="50" rows="2" placeholder="Acción Pedagógica.." style="resize:none" readonly></textarea>
										</div>
									</div>

									<div class="col-md-9">
										<div class="form-group">
											<label for="descripcion_accion">DESCRIPCIÓN ACCIÓN PEDAGÓGICA</label>
											<textarea class="form-control" name="descripcion_accion_pedagogica" id="descripcion_accion_pedagogicasele" cols="50" rows="4" placeholder="Descripción De La Acción Pedagógica.." style="resize:none" readonly></textarea>
										</div>
									</div>

									<div class="col-md-9">
										<div class="form-group">
											<label for="compromiso_estudiante">COMPROMISO DEL ESTUDIANTE</label>
											<textarea class="form-control" name="compromiso_estudiante" id="compromiso_estudiantesele" cols="50" rows="4" placeholder="Compromiso Del Estudiante Por Mejorar.." style="resize:none" readonly></textarea>
										</div>
									</div>

									<div class="col-md-9">
										<div class="form-group">
											<label for="observaciones">OBSERVACIONES</label>
											<textarea class="form-control" name="observaciones" id="observacionessele" cols="50" rows="4" placeholder="Observaciones.." style="resize:none" readonly></textarea>
										</div>
									</div>

				    			</div>
				    		</div>

				    		<div class="panel panel-default">
				    			<div class="panel-body">
									<div class="col-md-6">
										<div class="form-group">
											<label for="profesorsele">PROFESOR QUE REGISTRA</label>
											<input type="text" class="form-control" id="profesorsele" name="profesorsele" disabled>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="asignaturasele">ASIGNATURA</label>
											<input type="text" class="form-control" id="asignaturasele" name="asignaturasele" disabled>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="fecha_registrosele">FECHA REGISTRO</label>
											<input type="text" class="form-control" id="fecha_registrosele" name="fecha_registrosele" disabled>
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