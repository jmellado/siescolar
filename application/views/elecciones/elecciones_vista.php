	<style type="text/css">
	    
	    label.error{color:red;}

	    #modal_agregar_eleccion .modal-body
		{
  			height:430px;
  			overflow:auto;
		}

		#modal_actualizar_eleccion .modal-body
		{
  			height:430px;
  			overflow:auto;
		}
	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/elecciones.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-clipboard'></i>&nbsp;GESTIÓN DE ELECCIONES</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_eleccion" id="btn_agregar_eleccion" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Elección</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_eleccion" name="buscar_eleccion"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_eleccion" id="btn_buscar_eleccion" class="btn btn-primary">
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
    					<i class='fa fa-list'></i>&nbsp;Lista De Elecciones
    				</div>		
    			</div>
    			
				<div class="box-body">

					<div class="form-group">
					  <label for="cantidad_eleccion">Mostrar Por:</label>
					  <select class="selectpicker" id="cantidad_eleccion" name="cantidad_eleccion" >
					    <option value="5">5</option>
	  					<option value="10">10</option>
	  					<option value="15">15</option>
	  					<option value="20">20</option>
					  </select>
					</div>

					<div class="table-responsive">
					<table border='1' id="lista_elecciones" class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<tr>
								<th><i class='fa fa-sort-amount-asc'></i></th>
								<th><i class='fa fa-file-text-o'></i>&nbsp;Nombre</th>
								<th><i class='fa fa-calendar-plus-o'></i>&nbsp;Fecha Inicio</th>
								<th><i class='fa fa-clock-o'></i>&nbsp;Hora Inicio</th>
								<th><i class='fa fa-calendar-times-o'></i>&nbsp;Fecha Fin</th>
								<th><i class='fa fa-clock-o'></i>&nbsp;Hora Fin</th>
								<th><i class='fa fa-shield'></i>&nbsp;Estado</th>
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

					<div class="text-center paginacion_eleccion">
					
					</div>

				</div>

    		</div>
    	</div>
    </div>



</div>

<!-- Modal  agregar nueva eleccion -->
<div id="modal_agregar_eleccion" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR ELECCIONES</h4>
      </div>
      <div class="modal-body">
        
      	<div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>elecciones_controller/insertar_eleccion" name="" method="post" id="form_elecciones">

		        	<div class="form-group">
						<label class="control-label col-sm-3" for="nombre_eleccion">NOMBRE</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nombre_eleccion" name="nombre_eleccion"
								 placeholder="Nombre De La Elección">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="descripcion_eleccion">DESCRIPCIÓN</label>
						<div class="col-sm-8">
							<textarea class="form-control" name="descripcion_eleccion" id="descripcion_eleccion" cols="50" rows="3" placeholder="Descripción De La Elección.." style="resize:none"></textarea>
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="fecha_inicio">INICIO:</label>
						<div class="col-sm-4">
							<input type="date" class="form-control" id="fecha_inicio_eleccion" name="fecha_inicio">
						</div>
						<div class="col-sm-4">
							<input type="time" class="form-control" id="hora_inicio_eleccion" name="hora_inicio">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="fecha_fin">FIN:</label>
						<div class="col-sm-4">
							<input type="date" class="form-control" id="fecha_fin_eleccion" name="fecha_fin">
						</div>
						<div class="col-sm-4">
							<input type="time" class="form-control" id="hora_fin_eleccion" name="hora_fin">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="estado_grado">ESTADO</label>
						<div class="col-sm-4">
							<select class="form-control" id="estado_eleccion" name="estado_eleccion">
									<option value="Activo">Activo</option>
									<option value="Inactivo">Inactivo</option>
							</select>
						</div>	
					</div>

					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-5">
							<button type="submit" name="btn_registrar_eleccion" id="btn_registrar_eleccion" class="btn btn-primary btn-lg btn-block">Registrar</button>
						</div>
					</div>		

		        </form>
		    </div>
		</div>        

      </div>
    </div>

  </div>
</div>


<!-- Modal  actualizar eleccion -->
<div id="modal_actualizar_eleccion" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR INFORMACIÓN DE LA ELECCIÓN</h4>
      </div>
      <div class="modal-body">
        
        <div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" id="form_elecciones_actualizar">
										    
					<input type="hidden" class="form-control" id="id_eleccionsele" name="id_eleccion">
					
		        	<div class="form-group">
						<label class="control-label col-sm-3" for="nombre_eleccion">NOMBRE</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nombre_eleccionsele" name="nombre_eleccion"
								 placeholder="Nombre De La Elección">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="descripcion_eleccion">DESCRIPCIÓN</label>
						<div class="col-sm-8">
							<textarea class="form-control" name="descripcion_eleccion" id="descripcion_eleccionsele" cols="50" rows="3" placeholder="Descripción De La Elección.." style="resize:none"></textarea>
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="fecha_inicio">INICIO:</label>
						<div class="col-sm-4">
							<input type="date" class="form-control" id="fecha_inicio_eleccionsele" name="fecha_inicio">
						</div>
						<div class="col-sm-4">
							<input type="time" class="form-control" id="hora_inicio_eleccionsele" name="hora_inicio">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="fecha_fin">FIN:</label>
						<div class="col-sm-4">
							<input type="date" class="form-control" id="fecha_fin_eleccionsele" name="fecha_fin">
						</div>
						<div class="col-sm-4">
							<input type="time" class="form-control" id="hora_fin_eleccionsele" name="hora_fin">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="estado_grado">ESTADO</label>
						<div class="col-sm-4">
							<select class="form-control" id="estado_eleccionsele" name="estado_eleccion">
									<option value="Activo">Activo</option>
									<option value="Inactivo">Inactivo</option>
							</select>
						</div>	
					</div>

		        </form>

		        <div class="form-group">
					<div class="col-sm-offset-4 col-sm-5">
		        		<button type="button" name="btn_actualizar_eleccion" id="btn_actualizar_eleccion" class="btn btn-primary btn-lg btn-block">Actualizar</button>
		        	</div>
		        </div>		

		    </div>
		</div>        

      </div>
    </div>

  </div>
</div>