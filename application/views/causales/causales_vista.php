	<style type="text/css">
	    
	    label.error{color:red;}

	    .panel-margen{
			margin-bottom: 0px;
		}

	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/causales.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-contao'></i>&nbsp;CAUSALES</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_causal" id="btn_agregar_causal" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Causal</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_causal" name="buscar_causal"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_causal" id="btn_buscar_causal" class="btn btn-primary">
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
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Causales</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_causal">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_causal" name="cantidad_causal">
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_causales" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Causal</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Tipo Causal</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<td colspan='5'></td>
								</tr>
							</tfoot>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_causal">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>

</div>


<!-- Modal  agregar nuevo causal -->
<div id="modal_agregar_causal" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR CAUSALES</h4>
			</div>

			<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>causales_controller/insertar_causal" name="" method="post" id="form_causales">
		      	<div class="modal-body">
		        
			        <div class="panel panel-default panel-margen">
					    <div class="panel-body">

				        	<div class="form-group">
								<label class="control-label col-sm-3" for="causal">CAUSAL</label>
								<div class="col-sm-7">
									<textarea class="form-control" name="causal" id="causal" cols="50" rows="4" placeholder="Causal.." style="resize:none"></textarea>
								</div>		 
							</div>	

							<div class="form-group">
								<label class="control-label col-sm-3" for="id_tipo_causal">TIPO CAUSAL</label>
								<div class="col-sm-7">
									<div id="tipocausal1">
										<select class="form-control" id="id_tipo_causal" name="id_tipo_causal">
														    
										</select>
									</div>
								</div>	
							</div>		

					    </div>
					</div>        

		      	</div>
				<div class="modal-footer">
					<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
					<div class="col-sm-offset-4 col-sm-4">
						<button type="submit" name="btn_registrar_causal" id="btn_registrar_causal" class="btn btn-primary btn-lg btn-block">Registrar</button>
					</div>
				</div>
			</form>
	    </div>

	</div>
</div>

<!-- Modal  actualizar causal -->
<div id="modal_actualizar_causal" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR CAUSALES</h4>
	    	</div>
	    	<div class="modal-body">
	        
		        <div class="panel panel-default panel-margen">
				    <div class="panel-body">

				        <form class="form-horizontal" role="form" id="form_causales_actualizar">
							    
							<input type="hidden" class="form-control" id="id_causalsele" name="id_causal">

							<div class="form-group">
								<label class="control-label col-sm-3" for="causal">CAUSAL</label>
								<div class="col-sm-7">
									<textarea class="form-control" name="causal" id="causalsele" cols="50" rows="4" placeholder="Causal.." style="resize:none"></textarea>
								</div>		 
							</div>	

							<div class="form-group">
								<label class="control-label col-sm-3" for="id_tipo_causal">TIPO CAUSAL</label>
								<div class="col-sm-7">
									<div id="tipocausal1">
										<select class="form-control" id="id_tipo_causalsele" name="id_tipo_causal">
														    
										</select>
									</div>
								</div>	
							</div>
			
				        </form>

				    </div>
				</div>        	

	      	</div>
	      	<div class="modal-footer">
	        	<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
	        	<div class="col-sm-offset-4 col-sm-4">
	        		<button type="submit" name="btn_actualizar_causal" id="btn_actualizar_causal" class="btn btn-primary btn-lg btn-block">Actualizar</button>
	        	</div>
	      	</div>
	    </div>

	</div>
</div>