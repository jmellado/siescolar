	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-calendar-times-o'></i>&nbsp;AÑO LECTIVO</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_anolectivo" id="btn_agregar_anolectivo" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Año</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_anolectivo" name="buscar_anolectivo"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_anolectivo" id="btn_buscar_anolectivo" class="btn btn-primary">
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
    					<i class='fa fa-list'></i>&nbsp;Años Lectivos
    				</div>		
    			</div>
    			
				<div class="box-body">

					<div class="form-group">
					  <label for="cantidad_anolectivo">Mostrar Por:</label>
					  <select class="selectpicker" id="cantidad_anolectivo" name="cantidad_anolectivo" >
					    <option value="5">5</option>
	  					<option value="10">10</option>
	  					<option value="15">15</option>
	  					<option value="20">20</option>
					  </select>
					</div>

					<div class="table-responsive">
					<table border='1' id="lista_anoslectivos" class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<tr>
								<th><i class='fa fa-sort-amount-asc'></i></th>
								<th><i class='fa fa-calendar-times-o'></i>&nbsp;Año lectivo</th>
								<th><i class='fa fa-calendar-plus-o'></i>&nbsp;Fecha Inicio</th>
								<th><i class='fa fa-calendar-minus-o'></i>&nbsp;Fecha Fin</th>
								<th><i class='fa fa-shield'></i>&nbsp;Estado</th>
								<th><i class='fa fa-check-square-o'></i>&nbsp;Seleccionado</th>
								<th></th>
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

					<div class="text-center paginacion_anolectivo">
					
					</div>

				</div>

    		</div>
    	</div>
    </div>



</div>

<!-- Modal  agregar nuev año -->
<div id="modal_agregar_anolectivo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR AÑO LECTIVO</h4>
      </div>
      <div class="modal-body">
        
      	<div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>configuraciones_controller/insertar_anolectivo" name="" method="post" id="form_anoslectivos">

					<div class="form-group">
						<label class="control-label col-sm-3" for="anolectivo">AÑO LECTIVO</label>
						<div class="col-sm-7">
							<div id="anolectivo1">
								<select class="form-control" id="anolectivo" name="anolectivo">
												    
								</select>
							</div>
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="fecha_inicio">FECHA INICIO</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="fecha_fin">FECHA FIN</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="estado_anolectivo">ESTADO</label>
						<div class="col-sm-7">
							<select class="form-control" id="estado_anolectivo" name="estado_anolectivo" disabled>
									<option value="Activo">Activo</option>
									<option value="Inactivo">Inactivo</option>
							</select>
						</div>	
					</div>

					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-5">
							<button type="submit" name="btn_registrar_anolectivo" id="btn_registrar_anolectivo" class="btn btn-primary btn-lg btn-block">Registrar</button>
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

<!-- Modal  actualizar año -->
<div id="modal_actualizar_anolectivo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR AÑO LECTIVO</h4>
      </div>
      <div class="modal-body">
        
        <div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" id="form_anoslectivos_actualizar">
										    
					<input type="hidden" class="form-control" id="id_anolectivosele" name="id_anolectivo">

					<div class="form-group">
						<label class="control-label col-sm-3" for="anolectivo">AÑO LECTIVO</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="anolectivosele" name="anolectivo" disabled>
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="fecha_inicio">FECHA INICIO</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" id="fecha_iniciosele" name="fecha_inicio">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="fecha_fin">FECHA FIN</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" id="fecha_finsele" name="fecha_fin">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="estado_anolectivo">ESTADO</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="estado_anolectivosele" name="estado_anolectivo" disabled>
						</div>	
					</div>

		        </form>

		        <div class="form-group">
					<div class="col-sm-offset-4 col-sm-5">
		        		<button type="submit" name="btn_actualizar_anolectivo" id="btn_actualizar_anolectivo" class="btn btn-primary btn-lg btn-block">Actualizar</button>
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