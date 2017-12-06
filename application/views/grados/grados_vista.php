	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">GESTIÓN DE GRADOS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-6">
    		<button type="submit" name="btn_agregar_grado" id="btn_agregar_grado" class="btn btn-success">Agregar Grado</button>
    	</div></br>

        <div class="col-lg-6">
            <form class="form-inline" role="form">
				<div class="form-group">
					<label class="sr-only" for="buscar_grado">Email</label>
					<input type="text" class="form-control" id="buscar_grado" name="buscar_grado"
					           placeholder="Introduce tu nombre">
				</div>

				<button type="submit" name="btn_buscar_grado" id="btn_buscar_grado" class="btn btn-primary">Buscar</button>
			</form></br></br>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary">
    			<div class="panel-heading">Lista De Grados</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_grado">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_grado" name="cantidad_grado" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_grados" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th>Ciclo</th>
									<th>Jornada</th>
									<th>Año lectivo</th>
									<th>Estado</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_grado">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>



</div>

<!-- Modal  agregar nuev grado -->
<div id="modal_agregar_grado" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR GRADOS</h4>
      </div>
      <div class="modal-body">
        
      	<div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>grados_controller/insertar" name="" method="post" id="form_grados">

		        	<div class="form-group">
						<label class="control-label col-sm-3" for="nombre_grado">NOMBRE</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="nombre_grado" name="nombre_grado"
								 placeholder="Nombre">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="ciclo_grado">CICLO</label>
						<div class="col-sm-7">
							<select class="form-control" id="ciclo_grado" name="ciclo_grado">
									<option value="Preescolar">Preescolar</option>
									<option value="Básica primaria">Básica-primaria</option>
									<option value="Básica secundaria">Básica-secundaria</option>
									<option value="Media">Media</option>
							</select>
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="jornada">JORNADA</label>
						<div class="col-sm-7">
							<select class="form-control" id="jornada" name="jornada">
									<option value="Mañana">Mañana</option>
									<option value="Tarde">Tarde</option>
									<option value="Noche">Noche</option>
							</select>
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
						<label class="control-label col-sm-3" for="estado_grado">ESTADO</label>
						<div class="col-sm-7">
							<select class="form-control" id="estado_grado" name="estado_grado">
									<option value="Activo">Activo</option>
									<option value="Inactivo">Inactivo</option>
							</select>
						</div>	
					</div>

					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-5">
							<button type="submit" name="btn_registrar_grado" id="btn_registrar_grado" class="btn btn-primary btn-lg btn-block">Registrar</button>
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

<!-- Modal  actualizar grado -->
<div id="modal_actualizar_grado" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR GRADOS</h4>
      </div>
      <div class="modal-body">
        
        <div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" id="form_grados_actualizar">
										    
					<input type="hidden" class="form-control" id="id_gradosele" name="id_grado">
					
		        	<div class="form-group">
						<label class="control-label col-sm-3" for="nombre_grado">NOMBRE</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="nombre_gradosele" name="nombre_grado"
								 placeholder="Nombre">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="ciclo_grado">CICLO</label>
						<div class="col-sm-7">
							<select class="form-control" id="ciclo_gradosele" name="ciclo_grado">
									<option value="Preescolar">Preescolar</option>
									<option value="Básica primaria">Básica-primaria</option>
									<option value="Básica secundaria">Básica-secundaria</option>
									<option value="Media">Media</option>
							</select>
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="jornada">JORNADA</label>
						<div class="col-sm-7">
							<select class="form-control" id="jornadasele" name="jornada">
									<option value="Mañana">Mañana</option>
									<option value="Tarde">Tarde</option>
									<option value="Noche">Noche</option>
							</select>
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="año_lectivo">AÑO LECTIVO</label>
						<div class="col-sm-7">
							<div id="ano_lectivo1">
								<select class="form-control" id="ano_lectivosele" name="ano_lectivo">
												    
								</select>
							</div>
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="estado_grado">ESTADO</label>
						<div class="col-sm-7">
							<select class="form-control" id="estado_gradosele" name="estado_grado">
									<option value="Activo">Activo</option>
									<option value="Inactivo">Inactivo</option>
							</select>
						</div>	
					</div>

		        </form>

		        <div class="form-group">
					<div class="col-sm-offset-4 col-sm-5">
		        		<button type="submit" name="btn_actualizar_grado" id="btn_actualizar_grado" class="btn btn-primary btn-lg btn-block">Actualizar</button>
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