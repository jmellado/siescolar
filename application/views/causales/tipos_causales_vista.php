	<style type="text/css">
	    
	    label.error{color:red;}

	    .panel-margen{
			margin-bottom: 0px;
		}

	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tipos_causales.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-contao'></i>&nbsp;TIPOS DE CAUSALES</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_tipo" id="btn_agregar_tipo" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Tipo Causal</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_tipo" name="buscar_tipo"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_tipo" id="btn_buscar_tipo" class="btn btn-primary">
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
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Tipos Causales</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_tipo">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_area" name="cantidad_tipo">
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_tipos" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Tipo Causal</th>
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

						<div class="text-center paginacion_tipo">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>

</div>


<!-- Modal  agregar nuevo tipo causal -->
<div id="modal_agregar_tipo" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR TIPOS DE CAUSALES</h4>
			</div>

			<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>causales_controller/insertar_tipo_causal" name="" method="post" id="form_tipos">
		      	<div class="modal-body">
		        
			        <div class="panel panel-default panel-margen">
					    <div class="panel-body">

				        	<div class="form-group">
								<label class="control-label col-sm-3" for="tipo_causal">TIPO CAUSAL</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="tipo_causal" name="tipo_causal"
										 placeholder="Tipo Causal">
								</div>		 
							</div>		

					    </div>
					</div>        

		      	</div>
				<div class="modal-footer">
					<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
					<div class="col-sm-offset-4 col-sm-4">
						<button type="submit" name="btn_registrar_tipo" id="btn_registrar_tipo" class="btn btn-primary btn-lg btn-block">Registrar</button>
					</div>
				</div>
			</form>
	    </div>

	</div>
</div>

<!-- Modal  actualizar tipo causal -->
<div id="modal_actualizar_tipo" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR TIPOS DE CAUSALES</h4>
	    	</div>
	    	<div class="modal-body">
	        
		        <div class="panel panel-default panel-margen">
				    <div class="panel-body">

				        <form class="form-horizontal" role="form" id="form_tipos_actualizar">
							    
							<input type="hidden" class="form-control" id="id_tiposele" name="id_tipo_causal">
							
				        	<div class="form-group">
								<label class="control-label col-sm-3" for="tipo_causal">TIPO CAUSAL</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="tipo_causalsele" name="tipo_causal" placeholder="Tipo Causal">
								</div>		 
							</div>
			
				        </form>

				    </div>
				</div>        	

	      	</div>
	      	<div class="modal-footer">
	        	<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
	        	<div class="col-sm-offset-4 col-sm-4">
	        		<button type="submit" name="btn_actualizar_tipo" id="btn_actualizar_tipo" class="btn btn-primary btn-lg btn-block">Actualizar</button>
	        	</div>
	      	</div>
	    </div>

	</div>
</div>