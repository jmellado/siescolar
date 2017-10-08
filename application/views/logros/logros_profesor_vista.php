	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">GESTIÓN DE LOGROS</h1>
        </div>
    </div>
    <input type="hidden" id="rol" name="rol" value="<?php echo $this->session->userdata('rol')?>">

    <div class="row">

    	<div class="col-lg-6">
    		<button type="submit" name="btn_agregar_logro" id="btn_agregar_logro" class="btn btn-success">Agregar Logro</button>
    	</div></br>

        <div class="col-lg-6">
            <form class="form-inline" role="form">
				<div class="form-group">
					<label class="sr-only" for="buscar_logro">Email</label>
					<input type="text" class="form-control" id="buscar_logro" name="buscar_logro"
					           placeholder="Introduce tu nombre">
				</div>

				<button type="submit" name="btn_buscar_logro" id="btn_buscar_logro" class="btn btn-primary">Buscar</button>
			</form></br></br>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary">
    			<div class="panel-heading">Listado De Logros</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_logro">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_logro" name="cantidad_grado" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_logros" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th>Descripcion</th>
									<th>Periodo</th>
									<th>Grado</th>
									<th>Asignatura</th>
									<th>Año Lectivo</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_logro">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>



</div>

<!-- Modal  agregar nuev logro -->
<div id="modal_agregar_logro" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">REGISTRAR LOGROS</h4>
      </div>
      <div class="modal-body">
        
        <form role="form" action="<?php echo base_url(); ?>logros_controller/insertar" name="" method="post" id="form_logros">

			<input type="hidden" class="form-control" id="id_persona" name="id_persona" value="<?php echo $this->session->userdata('id_persona')?>">

			<div class="row">
	        	<div class="col-md-12">
	        		<div class="panel panel-default">
		        		<div class="panel-body">
			        		
			        		<div class="col-md-4">
								<label for="periodo">PERIODO</label>
								<select class="form-control" id="periodo" name="periodo">
										<option value="Primero">Primero</option>
										<option value="Segundo">Segundo</option>
										<option value="Tercero">Tercero</option>
										<option value="Cuarto">Cuarto</option>
								</select>
							</div>

							<div class="col-md-4">
								<label for="id_grado">GRADO</label>
								<div id="grados_logros1">
									<select class="form-control" id="id_grado_logros" name="id_grado">
												    
									</select>
								</div>
							</div>

							<div class="col-md-4">
								<label for="id_asignatura">ASIGNATURA</label>
								<div id="asignaturas_logros1">
									<select class="form-control" id="id_asignatura_logros" name="id_asignatura">
												    
									</select>
								</div>
							</div>

						</div>
					</div>
	        	</div>

	        	<div class="col-md-12">
	        		<div class="panel panel-default">
	        			<div class="panel-body">
	        		
			        		<div class="form-group">
								<label for="descripcion_logro">DESCRIPCION LOGRO</label>
								<textarea class="form-control" name="descripcion_logro" id="descripcion_logro" cols="50" rows="4" placeholder="Describir logro.."></textarea>
							</div>
						</div>
					</div>		
	        	</div>

	        	<div class="col-md-offset-4 col-md-4">
					<button type="submit" name="btn_registrar_logro" id="btn_registrar_logro" class="btn btn-primary btn-lg btn-block">Registrar</button>
				</div>
			</div>
        </form>

      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>

<!-- Modal  actualizar logro -->
<div id="modal_actualizar_logro" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ACTUALIZAR LOGROS</h4>
      </div>
      <div class="modal-body">
        

        <form role="form" id="form_logros_actualizar">

        	<div class="row">

	        	<div class="col-md-12">
	        		<div class="panel panel-default">
	        			<div class="panel-body">
				        						    
							<input type="hidden" class="form-control" id="id_logrosele" name="id_logro">
											    
							<input type="hidden" class="form-control" id="id_personasele" name="id_persona">
							
							<div class="col-md-4">
								<label for="periodo">PERIODO</label>
								<select class="form-control" id="periodosele" name="periodo">
										<option value="Primero">Primero</option>
										<option value="Segundo">Segundo</option>
										<option value="Tercero">Tercero</option>
										<option value="Cuarto">Cuarto</option>
								</select>
							</div>

							<div class="col-md-4">
								<label for="id_grado">GRADO</label>
								<div id="grados_logros1">
									<select class="form-control" id="id_grado_logrossele" name="id_grado">
												    
									</select>
								</div>
							</div>

							<div class="col-md-4">
								<label for="id_asignatura">ASIGNATURA</label>
								<div id="asignaturas_logros1">
									<select class="form-control" id="id_asignatura_logrossele" name="id_asignatura">
												    
									</select>
								</div>
							</div>
						</div>
					</div>	

				</div>

				<div class="col-md-12">
					<div class="panel panel-default">
	        			<div class="panel-body">
							<div class="form-group">
								<label for="descripcion_logro">DESCRIPCION LOGRO</label>
								<textarea class="form-control" name="descripcion_logro" id="descripcion_logrosele" cols="60" rows="4" placeholder="Descripcion logro"></textarea>
							</div>
						</div>
					</div>		

				</div>
        	</div>

			
        </form>

        <div class="row">
	        <div class="col-md-offset-4 col-md-4">
	        	<button type="submit" name="btn_actualizar_logro" id="btn_actualizar_logro" class="btn btn-primary btn-lg btn-block">Actualizar</button>
	        </div>
        </div>

      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>