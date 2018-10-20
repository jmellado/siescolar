	<style type="text/css">
	    
	    label.error{color:red;}
	    
	</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-print'></i>&nbsp;IMPRESIÓN DE PLANILLAS DE ASISTENCIA</h1>
        </div>
    </div>
    <input type="hidden" id="rol" name="rol" value="<?php echo $this->session->userdata('rol')?>">

    <div class="row">

    	<div class="col-md-12">

    		<div class="panel panel-default">
                
                <div class="panel-body">


					<form role="form" action="<?php echo base_url(); ?>imprimir_controller/generar_planilla_asistencia" name="" method="post" id="form_planillasA">

	        			<div class="col-md-12">

	        				<div class="panel panel-default">
	        					
	                			<div class="panel-body">

									<div class="col-md-offset-2 col-md-4">
										<div class="form-group">
											<label for="jornada">JORNADA</label>
											<select class="form-control" id="jornadaPA" name="jornada">
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
											<div id="cursos_planillaA1">
												<select class="form-control" id="id_cursoPA" name="id_curso">
															    
												</select>
											</div>
										</div>
									</div>

								</div>
							</div>

	        			</div>

	        			<div class="col-sm-offset-9 col-sm-3">

	        				<div class="form-group">
								<button type="button" name="btn_generar_planillaA" id="btn_generar_planillaA" class="btn btn-primary btn-lg btn-block">Generar</button>
							</div>
							
	        			</div>

        			</form>

                </div>
            </div>



    	</div>

    	
    </div>

</div>