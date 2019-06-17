<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/consultar_eventosA.js" defer></script>

<style type="text/css">

    label.error{color:red;}

    .panel-margen{
		margin-bottom: 0px;
	}

</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-calendar-plus-o'></i>&nbsp;EVENTOS</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="" name="" method="post" id="form_consultar_eventosA">

						<div class="col-md-offset-1 col-md-4">
							<div class="form-group">
								<label for="id_acudido">ACUDIDOS</label>
								<div id="acudidos_eventosA1">
									<select class="form-control" id="id_acudidoEA" name="id_acudido">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="id_asignatura">ASIGNATURA</label>
								<div id="asignaturas_eventosA1">
									<select class="form-control" id="id_asignaturaEA" name="id_asignatura">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-2">
	        				<div class="form-group">
	        					<label for=""></label>
								<button type="button" name="btn_consultar_eventosA" id="btn_consultar_eventosA" class="btn btn-primary btn-lg btn-block">Consultar</button>
							</div>
	        			</div>

                	</form>
                </div>
            </div>    	
    	</div>	
    </div>

    <div id="div-consultareventosA" class="row" style="display:none;">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">

                	<div class="box">
		    			<div class="box-header with-border">
		    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Eventos</div>

		    				<div class="box-tools pull-right">
						    	<div class="has-feedback">
						        	<input type="text" class="form-control input-sm" id="buscar_eventoA" name="buscar_evento" placeholder="Buscar...">
						        	<span class="glyphicon glyphicon-search form-control-feedback"></span>
						      	</div>
						    </div>	
		    			</div>

		    			<div class="box-body">
		                	<div class="table-responsive">
								<table border='1' id="lista_eventosA" class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th><i class='fa fa-sort-amount-asc'></i></th>
											<th width="300"><i class='fa fa-file-text-o'></i>&nbsp;Título</th>
											<th width="200"><i class='fa fa-clone'></i>&nbsp;Asignatura</th>
											<th style="text-align: center"><i class='fa fa-calendar-plus-o'></i>&nbsp;Fecha Inicio</th>
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


<!-- Modal  detalle evento -->
<div id="modal_detalle_eventoA" class="modal fade" role="dialog">
	<div class="modal-dialog">

    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title"><i class='fa fa-calendar-plus-o'></i>&nbsp;EVENTO</h4>
      		</div>
      		<div class="modal-body">
        
    			<div class="panel panel-default panel-margen">
                	<div class="panel-body">

                		<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>notificaciones_controller/modificar" name="" method="post" id="form_notificaciones_actualizar">

                			<input type="hidden" class="form-control" id="id_notificacionsele" name="id_notificacion">

				        	<div class="form-group">
				        		<label class="control-label col-sm-3" for="titulo">TÍTULO:</label>
				        		<div class="col-sm-7">
									<input type="text" class="form-control" id="titulosele" name="titulo" placeholder="Título" disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="contenido">CONTENIDO:</label>
								<div class="col-sm-7">
									<textarea class="form-control" id="contenidosele" name="contenido" cols="50" rows="5" placeholder="Contenido.." style="resize:none" readonly></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="asignaturasele">ASIGNATURA:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="asignaturasele" name="asignatura" disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="fecha_inicio">INICIO:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="fecha_iniciosele" name="fecha_inicio" disabled>
								</div>
								<label for=""></label>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="hora_iniciosele" name="hora_inicio" disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="fecha_fin">FIN:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="fecha_finsele" name="fecha_fin" disabled>
								</div>
								<label for=""></label>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="hora_finsele" name="hora_fin" disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="fecha_envio">FECHA DE REGISTRO:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="fecha_enviosele" name="fecha_envio" disabled>
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