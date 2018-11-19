	<style type="text/css">
	    
	    label.error{color:red;}

	    .lista-destinatarios
		{
			height: 150px;
		    overflow-y: auto;

		}

		.panel-margen{
			margin-bottom: 0px;
		}
	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/inboxconsultar.js" defer></script>

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
	              <li class="active"><a href="#tab_1" data-toggle="tab" id="tab_m"><i class='fa fa-envelope'></i>&nbsp;MENSAJES</a></li>
	              <li><a href="#tab_2" data-toggle="tab" id="tab_t"><i class='fa fa-pencil'></i>&nbsp;TAREAS</a></li>
	              <li><a href="#tab_3" data-toggle="tab" id="tab_e"><i class='fa fa-calendar-plus-o'></i>&nbsp;EVENTOS</a></li>
	              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
	            </ul>

	            <!--CONTENIDO DE LOS TABS-->
		        <div class="tab-content">

		        	<div class="tab-pane active" id="tab_1">

		        		<div class="row">
		        			<div class="col-md-12">
			        			<div class="box">

			        				<div class="box-header with-border">
				    					<h3 class="box-title text-aling:center"><i class='fa fa-list'></i>&nbsp;Mensajes Enviados</h3>
				    					<div class="box-tools pull-right">
									      <div class="has-feedback">
									        <input type="text" class="form-control input-sm" id="buscar_mensaje" name="buscar_mensaje" placeholder="Buscar...">
									        <span class="glyphicon glyphicon-search form-control-feedback"></span>
									      </div>
									    </div>
				    				</div>

			        				<div class="box-body">

			        					<div class="form-group">
											<label for="cantidad_mensaje">Mostrar Por:</label>
											<select class="selectpicker" id="cantidad_mensaje" name="cantidad_mensaje" >
												<option value="5">5</option>
												<option value="10">10</option>
												<option value="15">15</option>
												<option value="20">20</option>
											</select>
										</div>

										<div class="table-responsive">
											<table border='1' id="lista_mensajes" class="table table-bordered table-condensed table-hover table-striped">
												<thead>
													<tr>
														<th><i class='fa fa-sort-amount-asc'></i></th>
														<th><i class='fa fa-file-text-o'>&nbsp;</i>Título</th>
														<th><i class='fa fa-check-circle'>&nbsp;</i>Tipo</th>
														<th><i class='fa fa-file-text-o'>&nbsp;</i>Contenido</th>
														<th><i class='fa fa-clone'>&nbsp;</i>Asignatura</th>
														<th><i class='fa fa-calendar-check-o'>&nbsp;</i>Fecha Envio</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
												</tbody>
												<tfoot>
													<tr>
														<td colspan='7'></td>
													</tr>
												</tfoot>
											</table>
										</div>

										<div class="text-center paginacion_mensaje">
						
										</div>

			        				</div>

			        			</div>
			        		</div>		
		        		</div>

		        	</div>

		        	<div class="tab-pane" id="tab_2">

		        		<div class="row">
		        			<div class="col-md-12">
			        			<div class="box box-default">

			        				<div class="box-header with-border">
				    					<h3 class="box-title text-aling:center"><i class='fa fa-list'></i>&nbsp;Tareas Programadas</h3>
				    					<div class="box-tools pull-right">
									      <div class="has-feedback">
									        <input type="text" class="form-control input-sm" id="buscar_tarea" name="buscar_tarea" placeholder="Buscar...">
									        <span class="glyphicon glyphicon-search form-control-feedback"></span>
									      </div>
									    </div>
				    				</div>

			        				<div class="box-body">

			        					<div class="form-group">
											<label for="cantidad_tarea">Mostrar Por:</label>
											<select class="selectpicker" id="cantidad_tarea" name="cantidad_tarea" >
												<option value="5">5</option>
												<option value="10">10</option>
												<option value="15">15</option>
												<option value="20">20</option>
											</select>
										</div>

										<div class="table-responsive">
											<table border='1' id="lista_tareas" class="table table-bordered table-condensed table-hover table-striped">
												<thead>
													<tr>
														<th><i class='fa fa-sort-amount-asc'></i></th>
														<th><i class='fa fa-file-text-o'>&nbsp;</i>Título</th>
														<th><i class='fa fa-file-text-o'>&nbsp;</i>Contenido</th>
														<th><i class='fa fa-clone'>&nbsp;</i>Asignatura</th>
														<th><i class='fa fa-calendar-minus-o'>&nbsp;</i>Fecha Entrega</th>
														<th><i class='fa fa-calendar-check-o'>&nbsp;</i>Fecha Envio</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
												</tbody>
												<tfoot>
													<tr>
														<td colspan='7'></td>
													</tr>
												</tfoot>
											</table>
										</div>

										<div class="text-center paginacion_tarea">
						
										</div>
			        					
			        				</div>
			        			</div>
			        		</div>		
		        		</div>

		        	</div>

		        	<div class="tab-pane" id="tab_3">

		        		<div class="row">
		        			<div class="col-md-12">
			        			<div class="box box-default">

			        				<div class="box-header with-border">
				    					<h3 class="box-title text-aling:center"><i class='fa fa-list'></i>&nbsp;Eventos Programados</h3>
				    					<div class="box-tools pull-right">
									      <div class="has-feedback">
									        <input type="text" class="form-control input-sm" id="buscar_evento" name="buscar_evento" placeholder="Buscar...">
									        <span class="glyphicon glyphicon-search form-control-feedback"></span>
									      </div>
									    </div>
				    				</div>

			        				<div class="box-body">

			        					<div class="form-group">
											<label for="cantidad_evento">Mostrar Por:</label>
											<select class="selectpicker" id="cantidad_evento" name="cantidad_evento" >
												<option value="5">5</option>
												<option value="10">10</option>
												<option value="15">15</option>
												<option value="20">20</option>
											</select>
										</div>

										<div class="table-responsive">
											<table border='1' id="lista_eventos" class="table table-bordered table-condensed table-hover table-striped">
												<thead>
													<tr>
														<th><i class='fa fa-sort-amount-asc'></i></th>
														<th><i class='fa fa-file-text-o'>&nbsp;</i>Título</th>
														<th><i class='fa fa-file-text-o'>&nbsp;</i>Contenido</th>
														<th><i class='fa fa-clone'>&nbsp;</i>Asignatura</th>
														<th><i class='fa fa-calendar-plus-o'>&nbsp;</i>Fecha Inicio</th>
														<th><i class='fa fa-clock-o'>&nbsp;</i>Hora Inicio</th>
														<th><i class='fa fa-calendar-minus-o'>&nbsp;</i>Fecha Fin</th>
														<th><i class='fa fa-clock-o'>&nbsp;</i>Hora Fin</th>
														<th><i class='fa fa-calendar-check-o'>&nbsp;</i>Fecha Envio</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
												</tbody>
												<tfoot>
													<tr>
														<td colspan='10'></td>
													</tr>
												</tfoot>
											</table>
										</div>

										<div class="text-center paginacion_evento">
						
										</div>
			        					
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


<!-- Modal ver destinatarios mensajes -->
<div id="modal_ver_destinatarios_mensaje" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title"><i class='fa fa-envelope'></i>&nbsp;MENSAJES</h4>
	    	</div>
	      	<div class="modal-body">
	        
				<div class="row">
			    	<div class="col-md-12">
			    		<div class="box box-default panel-margen">
			    			<div class="box-header with-border">
			    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Estudiantes Destinatarios</div>
			    			</div>

		    				<div class="box-body">

								<div class="table-responsive lista-destinatarios">
									<table border='1' id="lista_destinatarios" class="table table-bordered table-condensed table-hover table-striped">
										<thead>
											<tr>
												<th><i class='fa fa-sort-amount-asc'></i></th>
												<th><i class='fa fa-file-text-o'></i>&nbsp;Nombres</th>
												<th><i class='fa fa-file-text-o'></i>&nbsp;1° Apellido</th>
												<th><i class='fa fa-file-text-o'></i>&nbsp;2° Apellido</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot>
											<tr>
												<td colspan='4'></td>
											</tr>
										</tfoot>
									</table>
								</div>

		    				</div>

			    		</div>
			    	</div>
			    </div>

	      	</div>
	    	<div class="modal-footer">
	        	
	    	</div>
	    </div>

	</div>
</div>


<!-- Modal ver destinatarios tareas -->
<div id="modal_ver_destinatarios_tarea" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title"><i class='fa fa-pencil'></i>&nbsp;TAREAS</h4>
	    	</div>
	      	<div class="modal-body">
	        
				<div class="row">
			    	<div class="col-md-12">
			    		<div class="box box-default panel-margen">
			    			<div class="box-header with-border">
			    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Estudiantes Destinatarios</div>
			    			</div>

		    				<div class="box-body">

								<div class="table-responsive lista-destinatarios">
									<table border='1' id="lista_destinatarios" class="table table-bordered table-condensed table-hover table-striped">
										<thead>
											<tr>
												<th><i class='fa fa-sort-amount-asc'></i></th>
												<th><i class='fa fa-file-text-o'></i>&nbsp;Nombres</th>
												<th><i class='fa fa-file-text-o'></i>&nbsp;1° Apellido</th>
												<th><i class='fa fa-file-text-o'></i>&nbsp;2° Apellido</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot>
											<tr>
												<td colspan='4'></td>
											</tr>
										</tfoot>
									</table>
								</div>

		    				</div>

			    		</div>
			    	</div>
			    </div>

	      	</div>
	    	<div class="modal-footer">
	        	
	    	</div>
	    </div>

	</div>
</div>


<!-- Modal ver destinatarios eventos -->
<div id="modal_ver_destinatarios_evento" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title"><i class='fa fa-calendar-plus-o'></i>&nbsp;EVENTOS</h4>
	    	</div>
	      	<div class="modal-body">
	        
				<div class="row">
			    	<div class="col-md-12">
			    		<div class="box box-default panel-margen">
			    			<div class="box-header with-border">
			    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Estudiantes Destinatarios</div>
			    			</div>

		    				<div class="box-body">

								<div class="table-responsive lista-destinatarios">
									<table border='1' id="lista_destinatarios" class="table table-bordered table-condensed table-hover table-striped">
										<thead>
											<tr>
												<th><i class='fa fa-sort-amount-asc'></i></th>
												<th><i class='fa fa-file-text-o'></i>&nbsp;Nombres</th>
												<th><i class='fa fa-file-text-o'></i>&nbsp;1° Apellido</th>
												<th><i class='fa fa-file-text-o'></i>&nbsp;2° Apellido</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot>
											<tr>
												<td colspan='4'></td>
											</tr>
										</tfoot>
									</table>
								</div>

		    				</div>

			    		</div>
			    	</div>
			    </div>

	      	</div>
	    	<div class="modal-footer">
	        	
	    	</div>
	    </div>

	</div>
</div>