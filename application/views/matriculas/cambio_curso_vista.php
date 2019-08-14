	<style type="text/css">
	    
	    label.error{color:red;}

	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/cambiar_curso.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-refresh'></i>&nbsp;CAMBIO DE CURSO</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="<?php echo base_url(); ?>matriculas_controller/cambiar_curso" name="" method="post" id="form_cambiar_curso">

                		<div class="row">
                			<div class="col-md-12">
				        		<div class="panel panel-default">
				        			<div class="panel-heading"><i class='fa fa-check-square'></i>&nbsp;Curso Origen</div>
					        		<div class="panel-body">

										<div class="col-md-3">
											<div class="form-group">
												<label for="jornada">JORNADA</label>
												<select class="form-control" id="jornadaCC" name="jornada">
													<option value="Mañana">Mañana</option>
													<option value="Tarde">Tarde</option>
													<option value="Noche">Noche</option>
													<option value="Unica">Única</option>
												</select>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label for="id_curso">CURSO</label>
												<div id="cursos_cambiar1">
													<select class="form-control" id="id_cursoCC" name="id_curso">
																	    
													</select>
												</div>
											</div>
										</div>

										<div class="col-md-5">
											<div class="form-group">
												<label for="id_estudiante">ESTUDIANTE</label>
												<div id="estudiantes_cambiar1">
													<select class="form-control" id="id_estudianteCC" name="id_estudiante">
																	    
													</select>
												</div>
											</div>
										</div>

									</div>
								</div>	
							</div>
						
							<div class="col-md-12">
				        		<div class="panel panel-default">
				        			<div class="panel-heading"><i class='fa fa-check-square'></i>&nbsp;Curso Destino</div>
					        		<div class="panel-body">

										<div class="col-md-3">
											<div class="form-group">
												<label for="jornada_destino">JORNADA</label>
												<select class="form-control" id="jornada_destinoCC" name="jornada_destino">
													<option value="Mañana">Mañana</option>
													<option value="Tarde">Tarde</option>
													<option value="Noche">Noche</option>
													<option value="Unica">Única</option>
												</select>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label for="id_curso_destino">CURSO</label>
												<div id="cursos_destino_cambiar1">
													<select class="form-control" id="id_curso_destinoCC" name="id_curso_destino">
																	    
													</select>
												</div>
											</div>
										</div>

									</div>
								</div>	
							</div>
						
							<div class="col-md-offset-9 col-md-3">
		        				<div class="form-group">
									<button type="submit" name="btn_cambiar_curso" id="btn_cambiar_curso" class="btn btn-primary btn-lg btn-block"><i class='fa fa-refresh'></i>&nbsp;Cambiar</button>
								</div>
		        			</div>
	        			</div>

                	</form>
                </div>
            </div>    	
    	</div>	
    </div>

</div>