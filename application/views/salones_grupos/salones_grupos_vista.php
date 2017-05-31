	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">GESTIÓN DE SALONES POR GRUPOS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-6">
    		<button type="submit" name="btn_agregar_salon_grupo" id="btn_agregar_salon_grupo" class="btn btn-success">Agregar Salon</button>
    	</div></br>

        <div class="col-lg-6">
            <form class="form-inline" role="form">
				<div class="form-group">
					<label class="sr-only" for="buscar_salon_grupo">Email</label>
					<input type="text" class="form-control" id="buscar_salon_grupo" name="buscar_salon_grupo"
					           placeholder="Introduce tu nombre">
				</div>

				<button type="submit" name="btn_buscar_salon_grupo" id="btn_buscar_salon_grupo" class="btn btn-primary">Buscar</button>
			</form></br></br>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary">
    			<div class="panel-heading">Listado De Salones Por Grupo</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_salon_grupo">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_salon_grupo" name="cantidad_salon_grupo" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_salones_grupos" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Salon</th>
									<th>Grado</th>
									<th>Grupo</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						</div>
						
						<div class="text-center paginacion_salon_grupo">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>



</div>

<!-- Modal  agregar nuev salon por grupo -->
<div id="modal_agregar_salon_grupo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">REGISTRAR SALONES POR GRUPOS</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>

        <form role="form" action="<?php echo base_url(); ?>salones_grupos_controller/insertar" name="" method="post" id="form_salones_grupos">

			<div class="form-group">
				<label for="id_salon">SALON</label>
				<div id="salon1">
					<select class="form-control" id="id_salon" name="id_salon">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="id_grado">GRADO</label>
				<div id="grado1">
					<select class="form-control" id="id_grado" name="id_grado">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="id_grupo">GRUPO</label>
				<div id="grupo1">
					<select class="form-control" id="id_grupo" name="id_grupo">
									    
					</select>
				</div>
			</div>

			<button type="submit" name="btn_registrar_salon_grupo" id="btn_registrar_salon_grupo" class="btn btn-primary btn-lg btn-block">Registrar</button>

        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal  actualizar salon por grupo -->
<div id="modal_actualizar_salon_grupo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ACTUALIZAR SALON POR GRUPO</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>

        <form role="form" id="form_salones_grupos_actualizar">

        	<div class="form-group">
				<label for="id_salon">SALON</label>
				<div id="salon1">
					<select class="form-control" id="id_salonsele" name="id_salon">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="id_grado">GRADO</label>
				<div id="grado1">
					<select class="form-control" id="id_gradosele" name="id_grado">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="id_grupo">GRUPO</label>
				<div id="grupo1">
					<select class="form-control" id="id_gruposele" name="id_grupo">
									    
					</select>
				</div>
			</div>

        </form>

        <button type="submit" name="btn_actualizar_salon_grupo" id="btn_actualizar_salon_grupo" class="btn btn-primary btn-lg btn-block">Actualizar</button>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>