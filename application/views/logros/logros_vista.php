	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-line-chart'></i>&nbsp;GESTIÓN DE LOGROS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_logro" id="btn_agregar_logro" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Logro</button>
    		<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal_agregar_logro">Open Modal</button>-->
    		</div>
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_logro" name="buscar_logro"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_logro" id="btn_buscar_logro" class="btn btn-primary">
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
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Logros</div>
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
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Código</th>
									<th><i class='fa fa-clock-o'></i>&nbsp;Periodo</th>
									<th><i class='fa fa-user'></i>&nbsp;Profesor</th>
									<th><i class='fa fa-graduation-cap'></i>&nbsp;Grado</th>
									<th><i class='fa fa-clone'></i>&nbsp;Asignatura</th>
									<th><i class='fa fa-calendar-times-o'></i>&nbsp;Año Lectivo</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<td colspan='9'></td>
								</tr>
							</tfoot>
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
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR LOGROS</h4>
      </div>
      <div class="modal-body">

      	<div class="panel panel-default">
		    <div class="panel-body">

		    	<div class="row">
			      	<div class="col-sm-offset-3 col-sm-7">
						<div class="input-group custom-search-form">
							<input type="text" class="form-control" id="identificacion_profesor" name="identificacion_profesor" placeholder="Identificación Profesor" onkeypress="return valida(event)">
						    	<span class="input-group-btn">
						        	<button class="btn btn-primary" type="button" name="btn_buscar_profesor" id="btn_buscar_profesor">
						            	<i class="fa fa-search"></i>
						            </button>
						        </span>
						</div></br>
					</div>
				</div>	
		        
		        <form role="form" action="<?php echo base_url(); ?>logros_controller/insertar" name="" method="post" id="form_logros">

		        	<div class="row">
			        	<div class="col-md-6">

							<input type="hidden" class="form-control" id="id_persona" name="id_persona">
							
			        		<div class="form-group">
								<label for="nombres">NOMBRES</label>
								<input type="text" class="form-control" id="nombres" name="nombres"
									 placeholder="Nombres" disabled> 
							</div>

							<div class="form-group">
								<label for="apellido1">1.° APELLIDO</label>
								<input type="text" class="form-control" id="apellido1" name="apellido1"
									 placeholder="Primer Apellido" disabled>
							</div>

							<div class="form-group">
								<label for="apellido2">2.° APELLIDO</label>
								<input type="text" class="form-control" id="apellido2" name="apellido2"
									 placeholder="Segundo Apellido" disabled>
							</div>


			        	</div>

			        	<div class="col-md-6">
			        		
			        		<div class="form-group">
								<label for="periodo">PERIODO</label>
								<select class="form-control" id="periodo" name="periodo" disabled>
										<option value="Primero">Primero</option>
										<option value="Segundo">Segundo</option>
										<option value="Tercero">Tercero</option>
										<option value="Cuarto">Cuarto</option>
								</select>
							</div>

							<div class="form-group">
								<label for="id_grado_logros">GRADO</label>
								<div id="grados_logros1">
									<select class="form-control" id="id_grado_logros" name="id_grado" disabled>
												    
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="id_asignatura">ASIGNATURA</label>
								<div id="asignaturas_logros1">
									<select class="form-control" id="id_asignatura_logros" name="id_asignatura" disabled>
												    
									</select>
								</div>
							</div>

			        	</div>

			        	<div class="col-md-12">
			        		<div class="form-group">
								<label for="descripcion_logro">DESCRIPCIÓN LOGRO</label>
								<textarea class="form-control" name="descripcion_logro" id="descripcion_logro" cols="50" rows="4" placeholder="Describir logro.." disabled style="resize:none"></textarea>
							</div>	
			        	</div>

			        	<div class="col-md-offset-4 col-md-4">
							<button type="submit" name="btn_registrar_logro" id="btn_registrar_logro" class="btn btn-primary btn-lg btn-block" disabled>Registrar</button>
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

<!-- Modal  actualizar logro -->
<div id="modal_actualizar_logro" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR LOGROS</h4>
      </div>
      <div class="modal-body">
        
      	<div class="panel panel-default">
		    <div class="panel-body">
		        <form role="form" id="form_logros_actualizar">

		        	<div class="row">
			        	<div class="col-md-12">
				        						    
							<input type="hidden" class="form-control" id="id_logrosele" name="id_logro">
							
							<div class="col-md-4">
								<div class="form-group">
									<label for="periodo">PERIODO</label>
									<select class="form-control" id="periodosele" name="periodo">
											<option value="Primero">Primero</option>
											<option value="Segundo">Segundo</option>
											<option value="Tercero">Tercero</option>
											<option value="Cuarto">Cuarto</option>
									</select>
								</div>
							</div>	

							<div class="col-md-4">
								<div class="form-group">
									<label for="id_grado">GRADO</label>
									<div id="grados_logros1">
										<select class="form-control" id="id_grado_logrossele" name="id_grado">
													    
										</select>
									</div>
								</div>
							</div>	

							<input type="hidden" class="form-control" id="id_personasele" name="id_persona">

							<div class="col-md-4">
								<div class="form-group">
									<label for="id_asignatura">ASIGNATURA</label>
									<div id="asignaturas_logros1">
										<select class="form-control" id="id_asignatura_logrossele" name="id_asignatura">
													    
										</select>
									</div>
								</div>
							</div>	
							
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label for="descripcion_logro">DESCRIPCIÓN LOGRO</label>
								<textarea class="form-control" name="descripcion_logro" id="descripcion_logrosele" cols="60" rows="4" placeholder="Describir logro.." style="resize:none"></textarea>
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
		</div>        

      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>