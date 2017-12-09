	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-th'></i>&nbsp;GESTIÓN DE CARGAS ACADÉMICAS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_cargas_academicas" id="btn_agregar_cargas_academicas" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Asignar Carga Académica</button>
    		</div>
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_cargas_academicas" name="buscar_cargas_academicas"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_cargas_academicas" id="btn_buscar_cargas_academicas" class="btn btn-primary">
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
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Cargas Académicas</div>
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
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-user'></i>&nbsp;Profesor</th>
									<th><i class='fa fa-th-large'></i>&nbsp;Curso</th>
									<th><i class='fa fa-clone'></i>&nbsp;Asignatura</th>
									<th><i class='fa fa-calendar-times-o'></i>&nbsp;Año lectivo</th>
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
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR CARGAS ACADEMICAS</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>cargas_academicas_controller/insertar" name="" method="post" id="form_cargas_academicas">

        	<div class="row">
	        	<div class="col-md-12">
	        		<div class="panel panel-default">
		        		<div class="panel-body">

				        	<div class="form-group">
								<label class="control-label col-md-3" for="id_profesor">PROFESOR</label>
								<div class="col-md-7">
									<div id="profesor_carga1">
										<select class="form-control" id="id_profesorCG" name="id_profesor">
														    
										</select>
									</div>
								</div>	
							</div>

							<div class="form-group">
								<label class="control-label col-md-3" for="id_curso">CURSO</label>
								<div class="col-md-7">
									<div id="curso_carga1">
										<select class="form-control" id="id_cursoCG" name="id_curso">
														    
										</select>
									</div>
								</div>	
							</div>

							<div class="form-group">
								<label class="control-label col-md-3" for="id_asignatura">ASIGNATURA</label>
								<div class="col-md-7">
									<div id="asignatura_carga1">
										<select class="form-control" id="id_asignaturaCG" name="id_asignatura">
														    
										</select>
									</div>
								</div>	
							</div>

							<div class="form-group">
								<label class="control-label col-md-3" for="año_lectivo">AÑO LECTIVO</label>
								<div class="col-md-7">
									<div id="ano_lectivo1">
										<select class="form-control" id="ano_lectivo" name="ano_lectivo" disabled>
														    
										</select>
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>			

				<div class="col-md-offset-4 col-md-5">
					<button type="submit" name="btn_registrar_cargas_academicas" id="btn_registrar_cargas_academicas" class="btn btn-primary btn-lg btn-block">Registrar</button>
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

<!-- Modal  actualizar cargas academicas -->
<div id="modal_actualizar_cargas_academicas" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR CARGAS ACADEMICAS</h4>
      </div>
      <div class="modal-body">
        

        <form class="form-horizontal" role="form" id="form_cargas_academicas_actualizar">

        	<div class="row">
	        	<div class="col-md-12">
	        		<div class="panel panel-default">
		        		<div class="panel-body">

				        	<div class="form-group">				    
								<input type="hidden" class="form-control" id="id_carga_academicasele" name="id_carga_academica">
							</div>

							<div class="form-group">
								<label class="control-label col-md-3" for="id_profesor">PROFESOR</label>
								<div class="col-md-7">
									<div id="profesor_carga1">
										<select class="form-control" id="id_profesorCGsele" name="id_profesor">
														    
										</select>
									</div>
								</div>	
							</div>

							<div class="form-group">
								<label class="control-label col-md-3" for="id_curso">CURSO</label>
								<div class="col-md-7">
									<div id="curso_carga1">
										<select class="form-control" id="id_cursoCGsele" name="id_curso">
														    
										</select>
									</div>
								</div>	
							</div>

							<div class="form-group">
								<label class="control-label col-md-3" for="id_asignatura">ASIGNATURA</label>
								<div class="col-md-7">
									<div id="asignatura_carga1">
										<select class="form-control" id="id_asignaturaCGsele" name="id_asignatura">
														    
										</select>
									</div>
								</div>	
							</div>

							<div class="form-group">
								<label class="control-label col-md-3" for="año_lectivo">AÑO LECTIVO</label>
								<div class="col-md-7">
									<div id="ano_lectivo1">
										<select class="form-control" id="ano_lectivosele" name="ano_lectivo" disabled>
														    
										</select>
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>				
        </form>

        <div class="row">
        	<div class="form-group">
	        	<div class="col-md-offset-4 col-md-5">
	        		<button type="submit" name="btn_actualizar_cargas_academicas" id="btn_actualizar_cargas_academicas" class="btn btn-primary btn-lg btn-block">Actualizar</button>
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