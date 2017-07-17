	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">GESTIÓN DE SALONES</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-6">
    		<button type="submit" name="btn_agregar_salon" id="btn_agregar_salon" class="btn btn-success">Agregar Salon</button>
    	</div></br>

        <div class="col-lg-6">
            <form class="form-inline" role="form">
				<div class="form-group">
					<label class="sr-only" for="buscar_salon">Email</label>
					<input type="text" class="form-control" id="buscar_salon" name="buscar_salon"
					           placeholder="Introduce tu nombre">
				</div>

				<button type="submit" name="btn_buscar_salon" id="btn_buscar_salon" class="btn btn-primary">Buscar</button>
			</form></br></br>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary">
    			<div class="panel-heading">Lista De Salones</div>
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
									<th>#</th>
									<th>Nombre</th>
									<th>Observacion</th>
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
        <h4 class="modal-title">REGISTRAR SALONES</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>

        <form role="form" action="<?php echo base_url(); ?>salones_controller/insertar" name="" method="post" id="form_salones">

        	<div class="form-group">
				<label for="nombre_salon">NOMBRE</label>
				<input type="text" class="form-control" id="nombre_salon" name="nombre_salon"
						 placeholder="Nombre">
			</div>

			<div class="form-group">
				<label for="observacion">OBSERVACIONES</label>
				<input type="text" class="form-control" id="observacion" name="observacion"
						 placeholder="observaciones">
			</div>

			<div class="form-group">
				<label for="año_lectivo">AÑO LECTIVO</label>
				<div id="ano_lectivo1">
					<select class="form-control" id="ano_lectivo" name="ano_lectivo">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="estado_salon">ESTADO</label>
				<select class="form-control" id="estado_salon" name="estado_salon">
						<option value="Activo">Activo</option>
						<option value="Inactivo">Inactivo</option>
				</select>
			</div>

			<button type="submit" name="btn_registrar_salon" id="btn_registrar_salon" class="btn btn-primary btn-lg btn-block">Registrar</button>

        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
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
        <h4 class="modal-title">ACTUALIZAR SALON</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>

        <form role="form" id="form_salones_actualizar">

        	<div class="form-group">
								    
				<input type="hidden" class="form-control" id="id_salonsele" name="id_salon">
			</div>

        	<div class="form-group">
				<label for="nombre_salon">NOMBRE</label>
				<input type="text" class="form-control" id="nombre_salonsele" name="nombre_salon"
						 placeholder="Nombre">
			</div>

			<div class="form-group">
				<label for="observacion">OBSERVACIONES</label>
				<input type="text" class="form-control" id="observacionsele" name="observacion"
						 placeholder="observaciones">
			</div>

			<div class="form-group">
				<label for="año_lectivo">AÑO LECTIVO</label>
				<div id="ano_lectivo1">
					<select class="form-control" id="ano_lectivosele" name="ano_lectivo">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="estado_salon">ESTADO</label>
				<select class="form-control" id="estado_salonsele" name="estado_salon">
						<option value="Activo">Activo</option>
						<option value="Inactivo">Inactivo</option>
				</select>
			</div>

			
        </form>

        <button type="submit" name="btn_actualizar_salon" id="btn_actualizar_salon" class="btn btn-primary btn-lg btn-block">Actualizar</button>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>