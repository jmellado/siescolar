	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-calendar'></i>&nbsp;PERÍODOS DE EVALUACÍON</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_periodo" id="btn_agregar_periodo" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Período</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_periodo" name="buscar_periodo"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_periodo" id="btn_buscar_periodo" class="btn btn-primary">
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
    					<i class='fa fa-list'></i>&nbsp;Períodos
    				</div>		
    			</div>
				<div class="box-body">

					<div class="table-responsive">
					<table border='1' id="lista_periodos" class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<tr>
								<th><i class='fa fa-sort-amount-asc'></i></th>
								<th><i class='fa fa-file-text-o'></i>&nbsp;Período</th>
								<th><i class='fa fa-calendar-plus-o'></i>&nbsp;Fecha Inicio</th>
								<th><i class='fa fa-calendar-times-o'></i>&nbsp;Fecha Fin</th>
								<th><i class='fa fa-shield'></i>&nbsp;Estado</th>
								<th></th>
								<th></th>
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

				</div>

    		</div>
    	</div>
    </div>



</div>

<!-- Modal  agregar nuevo periodo -->
<div id="modal_agregar_periodo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR PERÍODOS</h4>
      </div>
      <div class="modal-body">
        
      	<div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>configuraciones_controller/insertar_periodo" name="" method="post" id="form_periodos">

					<div class="form-group">
						<label class="control-label col-sm-3" for="periodo">PERÍODO</label>
						<div class="col-sm-7">
							<select class="form-control" id="periodo" name="periodo">
									<option value=""></option>
									<option value="Primero">Primero</option>
									<option value="Segundo">Segundo</option>
									<option value="Tercero">Tercero</option>
									<option value="Cuarto">Cuarto</option>
							</select>
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="fecha_inicial">FECHA INICIO</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" id="fecha_inicial" name="fecha_inicial">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="fecha_final">FECHA FIN</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" id="fecha_final" name="fecha_final">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="estado_periodo">ESTADO</label>
						<div class="col-sm-7">
							<select class="form-control" id="estado_periodo" name="estado_periodo" disabled>
									<option value=""></option>
									<option value="Activo">Activo</option>
									<option value="Inactivo" selected>Inactivo</option>
							</select>
						</div>	
					</div>

					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-5">
							<button type="submit" name="btn_registrar_periodo" id="btn_registrar_periodo" class="btn btn-primary btn-lg btn-block">Registrar</button>
						</div>
					</div>		

		        </form>
		    </div>
		</div>        

      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>


<!-- Modal  actualizar periodo -->
<div id="modal_actualizar_periodo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR PERÍODOS</h4>
      </div>
      <div class="modal-body">
        
        <div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" id="form_periodos_actualizar">
										    
					<input type="hidden" class="form-control" id="id_periodosele" name="id_periodo">
					
		        	<div class="form-group">
						<label class="control-label col-sm-3" for="periodo">PERÍODO</label>
						<div class="col-sm-7">
							<select class="form-control" id="periodosele" name="periodo" disabled>
									<option value="Primero">Primero</option>
									<option value="Segundo">Segundo</option>
									<option value="Tercero">Tercero</option>
									<option value="Cuarto">Cuarto</option>
							</select>
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="fecha_inicial">FECHA INICIO</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" id="fecha_inicialsele" name="fecha_inicial">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="fecha_final">FECHA FIN</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" id="fecha_finalsele" name="fecha_final">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="estado_periodo">ESTADO</label>
						<div class="col-sm-7">
							<select class="form-control" id="estado_periodosele" name="estado_periodo" disabled>
									<option value="Activo">Activo</option>
									<option value="Inactivo">Inactivo</option>
									<option value="Cerrado">Cerrado</option>
							</select>
						</div>	
					</div>

		        </form>

		        <div class="form-group">
					<div class="col-sm-offset-4 col-sm-5">
		        		<button type="submit" name="btn_actualizar_periodo" id="btn_actualizar_periodo" class="btn btn-primary btn-lg btn-block">Actualizar</button>
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