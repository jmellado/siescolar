	<style type="text/css">
	    
	    label.error{color:red;}

	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-retweet'></i>&nbsp;REGISTRO DE SEGUIMIENTOS DISCIPLINARIOS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-md-12">

    		<div class="panel panel-default">
                <!--<div class="panel-heading"></div>-->
                <div class="panel-body">

					<form role="form" action="<?php echo base_url(); ?>seguimientos_disciplinarios_controller/insertar" name="" method="post" id="form_seguimientos_disciplinarios">

	        			<input type="hidden" class="form-control" id="id_profesorSG" name="id_profesor" value="<?php echo $this->session->userdata('id_persona')?>">
	        			
	        			<div class="col-md-12">

	        				<div class="panel panel-default">
	        					<!--<div class="panel-heading"></div>-->
	                			<div class="panel-body">

									<div class="col-md-3">
										<div class="form-group">
											<label for="id_curso">CURSO</label>
											<div id="cursos_seguimientos1">
												<select class="form-control" id="id_cursoSG" name="id_curso">
															    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="id_asignatura">ASIGNATURA</label>
											<div id="asignaturas_seguimientos1">
												<select class="form-control" id="id_asignaturaSG" name="id_asignatura">
															    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="id_estudiante">ESTUDIANTE</label>
											<div id="estudiantes_seguimientos1">
												<select class="form-control" id="id_estudianteSG" name="id_estudiante">
															    
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

	        						<div class="col-md-3">
										<div class="form-group">
											<label for="id_tipo_causal">TIPO CAUSAL</label>
											<div id="tipocausal_seguimientos1">
												<select class="form-control" id="id_tipo_causalSG" name="id_tipo_causal">
															    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="id_causal">CAUSALES</label>
											<div id="causales_seguimientos1">
												<select class="form-control" id="id_causalSG" name="id_causal">
															    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="id_causal">FECHA CAUSAL</label>
											<input type="date" class="form-control" id="fecha_causalSG" name="fecha_causal">
										</div>
									</div>

									<div class="col-md-9">
										<div class="form-group">
											<label for="descripcion_situacion">DESCRIBIR SITUACIÓN</label>
											<textarea class="form-control" name="descripcion_situacion" id="descripcion_situacionSG" cols="50" rows="4" placeholder="Descripción De La Situación.." style="resize:none"></textarea>
										</div>
									</div>

	        					</div>	
	        				</div>

	        			</div>

	        			<div class="col-md-12">

	        				<div class="col-md-offset-6 col-md-3">
		        				<div class="form-group">
									<button type="button" name="btn_cancelar_seguimiento" id="btn_cancelar_seguimiento" class="btn btn-warning btn-lg btn-block">Cancelar</button>
								</div>
							</div>	

							<div class="col-md-3">
		        				<div class="form-group">
									<button type="submit" name="btn_registrar_seguimiento" id="btn_registrar_seguimiento" class="btn btn-success btn-lg btn-block">Registrar</button>
								</div>
							</div>
							
	        			</div>

        			</form>

                </div>
            </div>



    	</div>

    	
    </div>

</div>