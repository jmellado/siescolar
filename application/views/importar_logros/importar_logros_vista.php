	<style type="text/css">
	    
	    label.error{color:red;}

	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/importar_logros.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-upload'></i>&nbsp;IMPORTAR LOGROS</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="<?php echo base_url(); ?>importar_logros_controller/importar" name="" method="post" id="form_importar_logros" enctype="multipart/form-data">

                		<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="jornada">JORNADA</label>
									<select class="form-control" id="jornadaI" name="jornada">
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
									<div id="cursos_importar1">
										<select class="form-control" id="id_cursoI" name="id_curso">
														    
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-5">
								<div class="form-group">
									<label for="id_asignatura">ASIGNATURA</label>
									<div id="asignaturas_importar1">
										<select class="form-control" id="id_asignaturaI" name="id_asignatura">
														    
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
		        				<div class="form-group">
									<label for="periodo">PERIODO</label>
									<select class="form-control" id="periodoI" name="periodo">
										<option></option>
										<option value="Primero">Primero</option>
										<option value="Segundo">Segundo</option>
										<option value="Tercero">Tercero</option>
										<option value="Cuarto">Cuarto</option>
									</select>
								</div>
							</div>

							<div class="col-md-4">
		        				<div class="form-group">
		        					<label for="archivo">ARCHIVO EXCEL</label>
									<input class="btn btn-default btn-block" type="file" name="archivo" accept=".xlsx" required>
								</div>
		        			</div>

							<div class="col-md-3">
		        				<div class="form-group">
		        					<label for=""></label>
									<button type="submit" name="btn_importar_archivo" id="btn_importar_archivo" class="btn btn-primary btn-lg btn-block"><i class='fa fa-upload'></i>&nbsp;Importar</button>
								</div>
		        			</div>
		        		</div>

                	</form>
                </div>
            </div>    	
    	</div>	
    </div>

</div>