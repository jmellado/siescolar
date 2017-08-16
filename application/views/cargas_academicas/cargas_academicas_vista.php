	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">GESTIÓN DE CARGAS ACADEMICAS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-6">
    		<button type="submit" name="btn_agregar_cargas_academicas" id="btn_agregar_cargas_academicas" class="btn btn-success">Asignar Carga Academica</button>
    	</div></br>

        <div class="col-lg-6">
            <form class="form-inline" role="form">
				<div class="form-group">
					<label class="sr-only" for="buscar_cargas_academicas">Email</label>
					<input type="text" class="form-control" id="buscar_cargas_academicas" name="buscar_cargas_academicas"
					           placeholder="Introduce tu nombre">
				</div>

				<button type="submit" name="btn_buscar_cargas_academicas" id="btn_buscar_cargas_academicas" class="btn btn-primary">Buscar</button>
			</form></br></br>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary">
    			<div class="panel-heading">Listado De Cargas Academicas</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_cargas_academicas">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_cargas_academicas" name="cantidad_cargas_academicas" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_cargas_academicas" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Profesor</th>
									<th>Grado</th>
									<th>Asignatura</th>
									<th>Grupo</th>
									<th>Año lectivo</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_cargas_academicas">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>



</div>

<!-- Modal  agregar nueva cargas academicas -->
<div id="modal_agregar_cargas_academicas" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">REGISTRAR CARGAS ACADEMICAS</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>

        <form role="form" action="<?php echo base_url(); ?>cargas_academicas_controller/insertar" name="" method="post" id="form_cargas_academicas">

        	<div class="form-group">
				<label for="id_profesor">PROFESOR</label>
				<div id="profesor1">
					<select class="form-control" id="id_profesor" name="id_profesor">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="id_grado2">GRADO</label>
				<div id="grado1">
					<select class="form-control" id="id_grado2" name="id_grado">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="id_asignatura">ASIGNATURA</label>
				<div id="asignatura_carga">
					<select class="form-control" id="id_asignatura" name="id_asignatura">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="id_asignatura">GRUPO</label>
				<div id="grupo1">
					<select class="form-control" id="id_grupo" name="id_grupo">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="año_lectivo">AÑO LECTIVO</label>
				<div id="ano_lectivo1">
					<select class="form-control" id="ano_lectivo" name="ano_lectivo">
									    
					</select>
				</div>
			</div>

			<button type="submit" name="btn_registrar_cargas_academicas" id="btn_registrar_cargas_academicas" class="btn btn-primary btn-lg btn-block">Registrar</button>

        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal  actualizar cargas academicas -->
<div id="modal_actualizar_cargas_academicas" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ACTUALIZAR CARGAS ACADEMICAS</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>

        <form role="form" id="form_cargas_academicas_actualizar">

        	<div class="form-group">
								    
				<input type="hidden" class="form-control" id="id_carga_academicasele" name="id_carga_academica">
			</div>

			<div class="form-group">
				<label for="id_profesor">PROFESOR</label>
				<div id="profesor1">
					<select class="form-control" id="id_profesorsele" name="id_profesor">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="id_grado2">GRADO</label>
				<div id="grado1">
					<select class="form-control" id="id_grado2sele" name="id_grado">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="id_asignatura">ASIGNATURA</label>
				<div id="asignatura_carga">
					<select class="form-control" id="id_asignaturasele" name="id_asignatura">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="id_asignatura">GRUPO</label>
				<div id="grupo1">
					<select class="form-control" id="id_gruposele" name="id_grupo">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="año_lectivo">AÑO LECTIVO</label>
				<div id="ano_lectivo1">
					<select class="form-control" id="ano_lectivosele" name="ano_lectivo">
									    
					</select>
				</div>
			</div>
	
        </form>

        <button type="submit" name="btn_actualizar_cargas_academicas" id="btn_actualizar_cargas_academicas" class="btn btn-primary btn-lg btn-block">Actualizar</button>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>