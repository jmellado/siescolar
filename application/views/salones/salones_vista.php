	<style type="text/css">
	    
	    label.error{color:red;}

	    .panel-margen{
			margin-bottom: 0px;
		}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-institution'></i>&nbsp;GESTIÓN DE SALONES</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_salon" id="btn_agregar_salon" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Salón</button>
    		</div>
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_salon" name="buscar_salon"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_salon" id="btn_buscar_salon" class="btn btn-primary">
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
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Salones</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_salon">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_salon" name="cantidad_salon" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_salones" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Nombre Del Salón</th>
									<th><i class='fa fa-eye'></i>&nbsp;Observaciones</th>
									<th><i class='fa fa-calendar-times-o'></i>&nbsp;Año lectivo</th>
									<th><i class='fa fa-shield'></i>&nbsp;Estado</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<td colspan='7'></td>
								</tr>
							</tfoot>
							<tbody>
							</tbody>
						</table>
						</div>
						
						<div class="text-center paginacion_salon">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>

</div>

<!-- Modal  agregar nuev salon -->
<div id="modal_agregar_salon" class="modal fade" role="dialog">
	<div class="modal-dialog">

    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR SALONES</h4>
      		</div>

      		<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>salones_controller/insertar" name="" method="post" id="form_salones">
      			<div class="modal-body">

	      			<div class="panel panel-default panel-margen">
			    		<div class="panel-body">

				        	<div class="form-group">
								<label class="control-label col-sm-3" for="nombre_salon">NOMBRE</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="nombre_salon" name="nombre_salon"
										 placeholder="Nombre">
								</div>		 
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="observacion">OBSERVACIONES</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="observacion" name="observacion"
										 placeholder="Observaciones">
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
								<label class="control-label col-sm-3" for="estado_salon">ESTADO</label>
								<div class="col-sm-7">
									<select class="form-control" id="estado_salon" name="estado_salon">
											<option value="Activo">Activo</option>
											<option value="Inactivo">Inactivo</option>
									</select>
								</div>	
							</div>		

			    		</div>
					</div>        

      			</div>
	      		<div class="modal-footer">
	        		<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
		        	<div class="col-sm-offset-4 col-sm-4">
						<button type="submit" name="btn_registrar_salon" id="btn_registrar_salon" class="btn btn-primary btn-lg btn-block">Registrar</button>
					</div>
	      		</div>
      		</form>
    	</div>

  	</div>
</div>

<!-- Modal  actualizar salon -->
<div id="modal_actualizar_salon" class="modal fade" role="dialog">
	<div class="modal-dialog">

    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR SALON</h4>
      		</div>
      		<div class="modal-body">

      			<div class="panel panel-default panel-margen">
				    <div class="panel-body">

				        <form class="form-horizontal" role="form" id="form_salones_actualizar">
						    
							<input type="hidden" class="form-control" id="id_salonsele" name="id_salon">
							
				        	<div class="form-group">
								<label class="control-label col-sm-3" for="nombre_salon">NOMBRE</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="nombre_salonsele" name="nombre_salon"
										 placeholder="Nombre">
								</div>		 
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="observacion">OBSERVACIONES</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="observacionsele" name="observacion"
										 placeholder="Observaciones">
								</div>		 
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="año_lectivo">AÑO LECTIVO</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="anolectivosele" name="anolectivo" disabled>
								</div>	
							</div>
							<input type="hidden" class="form-control" id="ano_lectivosele" name="ano_lectivo">

							<div class="form-group">
								<label class="control-label col-sm-3" for="estado_salon">ESTADO</label>
								<div class="col-sm-7">
									<select class="form-control" id="estado_salonsele" name="estado_salon">
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
        		<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        		<div class="col-sm-offset-4 col-sm-4">
	        		<button type="submit" name="btn_actualizar_salon" id="btn_actualizar_salon" class="btn btn-primary btn-lg btn-block">Actualizar</button>
	        	</div>
      		</div>
    	</div>

  	</div>
</div>