	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-bullhorn'></i>&nbsp;MIS NOTIFICACIONES</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="box">
    			<!--<div class="panel-heading">NOTIFICACIONES REGISTRADAS</div>-->
    				<div class="box-header with-border">
    					<h3 class="box-title text-aling:center"><i class='fa fa-list'></i>&nbsp;Notificaciones</h3>
    					<div class="box-tools pull-right">
					      <div class="has-feedback">
					        <input type="text" class="form-control input-sm" id="buscar_notificacion" name="buscar_notificacion" placeholder="Buscar...">
					        <span class="glyphicon glyphicon-search form-control-feedback"></span>
					      </div>
					    </div><!-- /.box-tools -->
    				</div>

    				<div class="box-body">

    					<div class="form-group">
						  <label for="cantidad_notificacion">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_notificacion" name="cantidad_notificacion" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_notificacionesP" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-file-text-o'>&nbsp;</i>Asunto</th>
									<th><i class='fa fa-calendar-times-o'>&nbsp;</i>Fecha Del Evento</th>
									<th><i class='fa fa-clock-o'>&nbsp;</i>Hora Del Evento</th>
									<th style='display:none'><i class='fa fa-mail-forward'>&nbsp;</i>Destinatario</th>
									<th><i class='fa fa-calendar-check-o'>&nbsp;</i>Fecha De Envio</th>
									<th style='display:none'></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-right paginacion_notificacionP">
						
						</div>

    				</div>
    				<!--<div class="box-footer">
    					<div class="text-right paginacion_notificacion"></div>
			        </div>-->

    		</div>
    	</div>
    </div>



</div>


<!-- Modal  actualizar notificacion -->
<div id="modal_actualizar_notificacion" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-envelope'></i>&nbsp;MENSAJE</h4>
      </div>
      <div class="modal-body">
        
        <div class="row">

    		<div class="col-md-12">

    			<div class="panel panel-default">
                <!--<div class="panel-heading"></div>-->
                	<div class="panel-body">

                		<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>notificaciones_controller/modificar" name="" method="post" id="form_notificaciones_actualizar">

                			<input type="hidden" class="form-control" id="id_notificacionsele" name="id_notificacion">

				        	<div class="form-group">
				        		<label class="control-label col-sm-3" for="asunto">ASUNTO</label>
				        		<div class="col-sm-7">
									<input type="text" class="form-control" id="asuntosele" name="asunto" placeholder="Asunto" readonly>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="mensaje">MENSAJE</label>
								<div class="col-sm-7">
									<textarea class="form-control" id="mensajesele" name="mensaje" cols="50" rows="4" placeholder="Mensaje.." style="resize:none" readonly></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="fecha_evento">FECHA DEL EVENTO</label>
								<div class="col-sm-7">
									<input type="date" class="form-control" id="fecha_eventosele" name="fecha_evento" readonly>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="hora">HORA DEL EVENTO</label>
								<div class="col-sm-7">
									<input type="time" class="form-control" id="hora_eventosele" name="hora_evento" max="19:30:00" min="08:00:00" required="required" readonly>
								</div>
							</div>

							
				        </form>


                	</div>

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