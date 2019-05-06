	<style type="text/css">
	    
	    label.error{color:red;}

	    .panel-margen{
			margin-bottom: 0px;
		}

	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/acciones_pedagogicas.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-buysellads'></i>&nbsp;ACCIONES PEDAGÓGICAS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_accion_pedagogica" id="btn_agregar_accion_pedagogica" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Acción Pedagógica</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_acciones_pedagogicas" name="buscar_acciones_pedagogicas" placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_acciones_pedagogicas" id="btn_buscar_acciones_pedagogicas" class="btn btn-primary">
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
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Acciones Pedagógicas</div>
    				<div class="panel-body">

    					<div class="form-group">
						 	<label for="cantidad_acciones_pedagogicas">Mostrar Por:</label>
							<select class="selectpicker" id="cantidad_acciones_pedagogicas" name="cantidad_acciones_pedagogicas">
						    	<option value="5">5</option>
		  						<option value="10">10</option>
		  						<option value="15">15</option>
		  						<option value="20">20</option>
							</select>
						</div>

						<div class="table-responsive">
							<table border='1' id="lista_acciones_pedagogicas" class="table table-bordered table-condensed table-hover table-striped">
								<thead>
									<tr>
										<th><i class='fa fa-sort-amount-asc'></i></th>
										<th><i class='fa fa-file-text-o'></i>&nbsp;Acción Pedagógica</th>
										<th></th>
										<th></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<td colspan='4'></td>
									</tr>
								</tfoot>
								<tbody>
								</tbody>
							</table>
						</div>

						<div class="text-center paginacion_acciones_pedagogicas">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>

</div>


<!-- Modal  agregar nueva accion pedagogica -->
<div id="modal_agregar_acciones_pedagogicas" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR ACCIONES PEDAGÓGICAS</h4>
			</div>

			<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>acciones_pedagogicas_controller/insertar" name="" method="post" id="form_acciones_pedagogicas">
		      	<div class="modal-body">
		        
			        <div class="panel panel-default panel-margen">
					    <div class="panel-body">

				        	<div class="form-group">
								<label class="control-label col-sm-3" for="accion_pedagogica">ACCIÓN PEDAGÓGICA</label>
								<div class="col-sm-7">
									<textarea class="form-control" name="accion_pedagogica" id="accion_pedagogica" cols="50" rows="4" placeholder="Acción Pedagógica.." style="resize:none"></textarea>
								</div>		 
							</div>		

					    </div>
					</div>        

		      	</div>
				<div class="modal-footer">
					<div class="col-sm-offset-4 col-sm-4">
						<button type="submit" name="btn_registrar_accion_pedagogica" id="btn_registrar_accion_pedagogica" class="btn btn-primary btn-lg btn-block">Registrar</button>
					</div>
				</div>
			</form>
	    </div>

	</div>
</div>

<!-- Modal  actualizar accion pedagogica -->
<div id="modal_actualizar_acciones_pedagogicas" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR ACCIONES PEDAGÓGICAS</h4>
	    	</div>
	    	<div class="modal-body">
	        
		        <div class="panel panel-default panel-margen">
				    <div class="panel-body">

				        <form class="form-horizontal" role="form" id="form_acciones_pedagogicas_actualizar">
							    
							<input type="hidden" class="form-control" id="id_accion_pedagogicasele" name="id_accion_pedagogica">

							<div class="form-group">
								<label class="control-label col-sm-3" for="accion_pedagogica">ACCIÓN PEDAGÓGICA</label>
								<div class="col-sm-7">
									<textarea class="form-control" name="accion_pedagogica" id="accion_pedagogicasele" cols="50" rows="4" placeholder="Acción Pedagógica.." style="resize:none"></textarea>
								</div>		 
							</div>
			
				        </form>

				    </div>
				</div>        	

	      	</div>
	      	<div class="modal-footer">
	        	<div class="col-sm-offset-4 col-sm-4">
	        		<button type="submit" name="btn_actualizar_accion_pedagogica" id="btn_actualizar_accion_pedagogica" class="btn btn-primary btn-lg btn-block">Actualizar</button>
	        	</div>
	      	</div>
	    </div>

	</div>
</div>