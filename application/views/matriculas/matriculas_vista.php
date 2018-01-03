	<style type="text/css">
	    
	    label.error{color:red;}

	    #modal_agregar_matricula .modal-body
		{
  			height:480px;
  			overflow:auto;
		}
		#modal_actualizar_matricula .modal-body
		{
  			height:490px;
  			overflow:auto;
		}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-clipboard'></i>&nbsp;GESTIÓN DE MATRICULAS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_matricula" id="btn_agregar_matricula" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Matricular Estudiantes</button>
    		</div>
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_matricula" name="buscar_matricula"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_matricula" id="btn_buscar_matricula" class="btn btn-primary">
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
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Estudiantes Matriculados</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_matricula">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_matricula" name="cantidad_matricula" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_matriculas" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-calendar-check-o'></i>&nbsp;Fecha Matricula</th>
									<th><i class='fa fa-calendar-times-o'></i>&nbsp;Año Lectivo</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Identificación</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Nombres</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Apellido1</th>
									<th><i class='fa fa-graduation-cap'></i>&nbsp;Grado</th>
									<th><i class='fa fa-object-group'></i>&nbsp;Grupo</th>
									<th><i class='fa fa-calendar-o'></i>&nbsp;Jornada</th>
									<th><i class='fa fa-shield'></i>&nbsp;Estado Matricula</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_matricula">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>



</div>

<!-- Modal  agregar nuev matricula -->
<div id="modal_agregar_matricula" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;MATRICULAR ESTUDIANTES</h4>
      </div>
      <div class="modal-body">

        <div class="box box-primary"><!--primergrupo-->
		    <div class="box-body"><!--primergrupo-->

		    	<div class="row">
			      	<div class="col-sm-offset-4 col-sm-4">
			      		<div class="form-group">
					        <div class="input-group custom-search-form">
					            <input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Identificación Estudiante" onkeypress="return valida(event)">
					                <span class="input-group-btn">
					                    <button class="btn btn-primary" type="button" name="btn_buscar_estudiante" id="btn_buscar_estudiante">
					                        <i class="fa fa-search"></i>
					                    </button>
					                </span>
					        </div>
					    </div>
				    </div>
				</div>    

		        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>matriculas_controller/insertar" name="" method="post" id="form_matriculas">

		        	<div class="row">
		        		<div class="col-sm-6">
				            <div class="panel panel-default">
		    					<div class="panel-body">
									<input type="hidden" class="form-control" id="id_persona" name="id_persona">
									
						        	<div class="form-group">
						        		<label class="control-label col-sm-4" for="nombres">NOMBRES</label>
						        		<div class="col-sm-7">
											<input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" disabled>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-sm-4" for="apellido1">1° APELLIDO</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" id="apellido1" name="apellido1" placeholder="Primer Apellido" disabled>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-sm-4" for="apellido2">2° APELLIDO</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" id="apellido2" name="apellido2" placeholder="Segundo Apellido" disabled>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-sm-4" for="jornada">JORNADA</label>
										<div class="col-sm-6">
											<select class="form-control" id="jornadaMT" name="jornada" disabled>
													<option value="Mañana">Mañana</option>
													<option value="Tarde">Tarde</option>
													<option value="Noche">Noche</option>
													<option value="Unica">Única</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-sm-4" for="id_curso">CURSO</label>
										<div class="col-sm-6">
											<div id="curso1">
												<select class="form-control" id="id_curso" name="id_curso" disabled>
																    
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>		

						<div class="col-sm-6">
							<div class="panel panel-default">
		    					<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-4" for="id_acudiente">ACUDIENTE</label>
										<div class="col-sm-7">
											<div id="acudiente1">
												<select class="form-control" id="id_acudiente" name="id_acudiente" disabled>
																    
												</select>
											</div>
										</div>
									</div>

									<div class="form-group">
									  	<label class="control-label col-sm-4" for="parentesco">PARENTESCO</label>
									  	<div class="col-sm-6">
										  	<select class="form-control" id="parentesco" name="parentesco" disabled>
										  		<option value=""></option>
											    <option value="Padre">Padre</option>
												<option value="Madre">Madre</option>
												<option value="Hermano(a)">Hermano(a)</option>
												<option value="Tio(a)">Tio(a)</option>
												<option value="Primo(a)">Primo(a)</option>
												<option value="Abuelo(a)">Abuelo(a)</option>
												<option value="Cuñado(a)">Cuñado(a)</option>
												<option value="Padrino">Padrino</option>
												<option value="Madrina">Madrina</option>
										  	</select>
										</div>  	 	
									</div>

									<div class="col-sm-12">
						        		<div class="form-group">
											<label for="observaciones">OBSERVACIONES</label>
											<textarea class="form-control" name="observaciones" id="observaciones" cols="50" rows="3" placeholder="Observaciones.." disabled style="resize:none"></textarea>
										</div>	
						        	</div>
								</div>
							</div>		
						</div>	

						<div class="col-sm-offset-4 col-sm-4">
							<button type="submit" name="btn_registrar_matricula" id="btn_registrar_matricula" class="btn btn-primary btn-lg btn-block" disabled="">Registrar</button>
						</div>

					</div>	
		        </form>
		    </div>    
		</div>
		    
      </div><!-- Modalbody -->
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div><!-- Modalcontent -->

  </div><!-- Modaldialog -->
</div><!-- Modal -->


<!-- Modal  actualizar matricula -->
<div id="modal_actualizar_matricula" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR MATRICULAS</h4>
      </div>
      <div class="modal-body">
        
      	<div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" id="form_matriculas_actualizar">
			    
					<input type="hidden" class="form-control" id="id_matriculasele" name="id_matricula">
					
					<div class="form-group">
		    			<label class="control-label col-sm-3" for="fecha_nacimiento">FECHA DE MATRICULA</label>
		    			<div class="col-sm-7">
		    				<input type="date" class="form-control" id="fecha_matriculasele" name="fecha_matricula" disabled>
		    			</div>		
		  			</div>

		  			<div class="form-group">
						<label class="control-label col-sm-3" for="año_lectivo">AÑO LECTIVO</label>
						<div class="col-sm-4">
							<div id="ano_lectivo1">
								<select class="form-control" id="ano_lectivosele" name="ano_lectivo" disabled>
												    
								</select>
							</div>
						</div>	
					</div>
				    
					<input type="hidden" class="form-control" id="id_personasele" name="id_persona">
					
					<div class="form-group">
						<label class="control-label col-sm-3" for="jornada">JORNADA</label>
						<div class="col-sm-4">
							<select class="form-control" id="jornadaseleMT" name="jornada">
									<option value="Mañana">Mañana</option>
									<option value="Tarde">Tarde</option>
									<option value="Noche">Noche</option>
									<option value="Unica">Única</option>
							</select>
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="id_curso">CURSO</label>
						<div class="col-sm-6">
							<div id="curso1">
								<select class="form-control" id="id_cursosele" name="id_curso">
												    
								</select>
							</div>
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="id_acudiente">ACUDIENTE</label>
						<div class="col-sm-6">
							<div id="acudiente1">
								<select class="form-control" id="id_acudientesele" name="id_acudiente">
												    
								</select>
							</div>
						</div>	
					</div>

					<div class="form-group">
					  	<label class="control-label col-sm-3" for="parentesco">PARENTESCO</label>
					  	<div class="col-sm-4">
						  	<select class="form-control" id="parentescosele" name="parentesco">
						  		<option value=""></option>
							    <option value="Padre">Padre</option>
								<option value="Madre">Madre</option>
								<option value="Hermano(a)">Hermano(a)</option>
								<option value="Tio(a)">Tio(a)</option>
								<option value="Primo(a)">Primo(a)</option>
								<option value="Abuelo(a)">Abuelo(a)</option>
								<option value="Cuñado(a)">Cuñado(a)</option>
								<option value="Padrino">Padrino</option>
								<option value="Madrina">Madrina</option>
						  	</select>
						</div>  	 	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="observaciones">OBSERVACIONES</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="observacionessele" name="observaciones" placeholder="Observaciones">
						</div>	
					</div>

		        </form>

		        <div class="form-group">
		        	<div class="col-sm-offset-4 col-sm-5"> 
		        		<button type="submit" name="btn_actualizar_matricula" id="btn_actualizar_matricula" class="btn btn-primary btn-lg btn-block">Actualizar</button>
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