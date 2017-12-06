	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">GESTIÓN DE CURSOS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-6">
    		<button type="submit" name="btn_agregar_curso" id="btn_agregar_curso" class="btn btn-success">Agregar Curso</button>
    	</div></br>

        <div class="col-lg-4">
            <form class="form-inline" role="form">
				<div class="form-group">
					<label class="sr-only" for="buscar_curso">Email</label>
					<input type="text" class="form-control" id="buscar_curso" name="buscar_curso"
					           placeholder="Buscar..">
				</div>

				<button type="submit" name="btn_buscar_curso" id="btn_buscar_curso" class="btn btn-primary">Buscar</button>
			</form></br></br>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary">
    			<div class="panel-heading">Listado De Cursos</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_curso">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_curso" name="cantidad_curso" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_cursos" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Grado</th>
									<th>Grupo</th>
									<th>Aula</th>
									<th>Director</th>
									<th>Cupo Maximo</th>
									<th>Jornada</th>
									<th>Año lectivo</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						</div>
						
						<div class="text-center paginacion_curso">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>



</div>

<!-- Modal  agregar nuevo curso -->
<div id="modal_agregar_curso" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR CURSOS</h4>
      </div>
      <div class="modal-body">

        <form role="form" action="<?php echo base_url(); ?>cursos_controller/insertar" name="" method="post" id="form_cursos">

        	<div class="row">
	        	<div class="col-md-12">
	        		<div class="panel panel-default">
		        		<div class="panel-body">

		        			<div class="col-md-4">
								<div class="form-group">
									<label for="id_grado">GRADO</label>
									<div id="grado1">
										<select class="form-control" id="id_grado" name="id_grado">
														    
										</select>
									</div>
								</div>
							</div>
							
							<div class="col-md-4">	
								<div class="form-group">
									<label for="id_grupo">GRUPO</label>
									<div id="grupo1">
										<select class="form-control" id="id_grupo" name="id_grupo">
														    
										</select>
									</div>
								</div>
							</div>
							
							<div class="col-md-4">	
								<div class="form-group">
									<label for="id_salon">AULA</label>
									<div id="salon1">
										<select class="form-control" id="id_salon" name="id_salon">
														    
										</select>
									</div>
								</div>
							</div>
								
						</div>
					</div>
				</div>

				<div class="col-md-12">
	        		<div class="panel panel-default">
		        		<div class="panel-body">

		        			<div class="col-md-offset-1 col-md-6">
								<div class="form-group">
									<label for="id_salon">DIRECTOR</label>
									<div id="director1">
										<select class="form-control" id="director" name="director">
														    
										</select>
									</div>
								</div>
							</div>	

							<div class="col-md-4">
								<div class="form-group">
									<label for="cupo_maximo">CUPO MAXIMO</label>
									<input type="text" class="form-control" id="cupo_maximo" name="cupo_maximo"
											 placeholder="Cupo maximo">
								</div>
							</div>	

							<div class="col-md-offset-1 col-md-6">
								<div class="form-group">
									<label for="jornada">JORNADA</label>
									<select class="form-control" id="jornada" name="jornada">
											<option value="Mañana">Mañana</option>
											<option value="Tarde">Tarde</option>
											<option value="Noche">Noche</option>
											<option value="Unica">Única</option>
									</select>
								</div>
							</div>

							<div class="col-md-4">	
								<div class="form-group">
									<label for="año_lectivo">AÑO LECTIVO</label>
									<div id="ano_lectivo1">
										<select class="form-control" id="ano_lectivo" name="ano_lectivo" disabled>
														    
										</select>
									</div>
								</div>
							</div>
								
						</div>
					</div>
				</div>
				
				<div class="col-md-offset-4 col-md-4">			
					<button type="submit" name="btn_registrar_curso" id="btn_registrar_curso" class="btn btn-primary btn-lg btn-block">Registrar</button>
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

<!-- Modal  actualizar curso -->
<div id="modal_actualizar_curso" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR CURSO</h4>
      </div>
      <div class="modal-body">

        <form role="form" id="form_cursos_actualizar">

        	<div class="row">
	        	<div class="col-md-12">
	        		<div class="panel panel-default">
		        		<div class="panel-body">

		        			<input type="hidden" class="form-control" id="id_cursosele" name="id_curso">	

							<div class="col-md-4">
								<div class="form-group">
									<label for="id_grado">GRADO</label>
									<div id="grado1">
										<select class="form-control" id="id_gradosele" name="id_grado" disabled>
														    
										</select>
									</div>
								</div>
							</div>	
							<input type="hidden" class="form-control" id="id_grado-sele" name="id_grado">

							<div class="col-md-4">
								<div class="form-group">
									<label for="id_grupo">GRUPO</label>
									<div id="grupo1">
										<select class="form-control" id="id_gruposele" name="id_grupo" disabled>
														    
										</select>
									</div>
								</div>
							</div>
							<input type="hidden" class="form-control" id="id_grupo-sele" name="id_grupo">
							
							<div class="col-md-4">
					        	<div class="form-group">
									<label for="id_salon">AULA</label>
									<div id="salon1">
										<select class="form-control" id="id_salonsele" name="id_salon">
														    
										</select>
									</div>
								</div>
							</div>	

						</div>
					</div>
				</div>

				<div class="col-md-12">
	        		<div class="panel panel-default">
		        		<div class="panel-body">

		        			<div class="col-md-offset-1 col-md-6">
								<div class="form-group">
									<label for="id_salon">DIRECTOR</label>
									<div id="director1">
										<select class="form-control" id="directorsele" name="director">
														    
										</select>
									</div>
								</div>
							</div>	

							<div class="col-md-4">
								<div class="form-group">
									<label for="cupo_maximo">CUPO MAXIMO</label>
									<input type="text" class="form-control" id="cupo_maximosele" name="cupo_maximo"
											 placeholder="Cupo maximo">
								</div>
							</div>	

							<div class="col-md-offset-1 col-md-6">
								<div class="form-group">
									<label for="jornada">JORNADA</label>
									<select class="form-control" id="jornadasele" name="jornada" disabled>
											<option value="Mañana">Mañana</option>
											<option value="Tarde">Tarde</option>
											<option value="Noche">Noche</option>
											<option value="Unica">Única</option>
									</select>
								</div>
							</div>
							<input type="hidden" class="form-control" id="jornada-sele" name="jornada">

							<div class="col-md-4">	
								<div class="form-group">
									<label for="año_lectivo">AÑO LECTIVO</label>
									<div id="ano_lectivo1">
										<select class="form-control" id="ano_lectivosele" name="ano_lectivo" disabled>
														    
										</select>
									</div>
								</div>
							</div>
							<input type="hidden" class="form-control" id="ano_lectivo-sele" name="ano_lectivo">
								
						</div>
					</div>
				</div>
			</div>				

        </form>

        <div class="row">
        	<div class="col-md-offset-4 col-md-4">
        		<button type="submit" name="btn_actualizar_curso" id="btn_actualizar_curso" class="btn btn-primary btn-lg btn-block">Actualizar</button>
        	</div>	
        </div>

      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>