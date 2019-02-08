<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libro_calificaciones.js" defer></script>

<style type="text/css">

    label.error{color:red;}

</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-book'></i>&nbsp;LIBRO DE CALIFICACIONES</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="" name="" method="post" id="form_libro_calificaciones">

                		<div class="col-md-3">
							<div class="form-group">
								<label for="ano_lectivo">AÑO LECTIVO</label>
								<div id="ano_lectivo_libro1">
									<select class="form-control" id="ano_lectivoLC" name="ano_lectivo">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="jornada">JORNADA</label>
								<select class="form-control" id="jornadaLC" name="jornada">
									<option value=""></option>
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
								<div id="cursos_libro1">
									<select class="form-control" id="id_cursoLC" name="id_curso">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-2">
	        				<div class="form-group">
	        					<label for=""></label>
								<button type="button" name="btn_descargar_LC" id="btn_descargar_LC" class="btn btn-primary btn-lg btn-block">Descargar</button>
							</div>
	        			</div>

                	</form>
                </div>
            </div>    	
    	</div>	
    </div>

</div>