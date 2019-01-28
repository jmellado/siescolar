<style type="text/css">

    label.error{color:red;}

</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/promocion.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-play'></i>&nbsp;PROCESAR PROMOCIÓN</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
	    	<div class="panel panel-default">
	            <div class="panel-body">

	            	<div class="col-md-12">
			    		<div class="callout callout-info">
			            	<h4>Informacíon Importante!</h4>

			                <p>A Continuación Podra Realizar El Proceso De Promoción Por Cursos, El Cual Permite Definir La Situación Académica Final De Los Estudiante Matriculados En El Respectivo Curso Y Año Lectivo; Tenga En Cuenta Que Para Realizar Este Proceso, Se Deben Encontrar Todos Los Períodos De Evaluación En Estado Cerrado.</p>
			            </div>
			    	</div>

			    	<div class="col-md-12">
			    		<form role="form" action="" name="" method="post" id="form_procesar_promocion">

			    			<div class="col-md-offset-1 col-md-3">
								<div class="form-group">
									<label for="jornada">JORNADA</label>
									<select class="form-control" id="jornadaPP" name="jornada">
										<option value="Mañana">Mañana</option>
										<option value="Tarde">Tarde</option>
										<option value="Noche">Noche</option>
										<option value="Unica">Única</option>
									</select>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="ano_lectivo">CURSO</label>
									<div id="cursos_procesar1">
										<select class="form-control" id="id_cursoPP" name="id_curso">
														    
										</select>
									</div>
								</div>
							</div>

			    			<div class="col-md-3">
					    		<div class="form-group">
					    			<label for=""></label>
					    			<button type="button" name="btn_procesar_promocion" id="btn_procesar_promocion" class="btn btn-success btn-lg btn-block"><i class='fa fa-play'></i>&nbsp;Procesar</button>
					    		</div>
					    	</div>

				    	</form>
			    	</div>
			    		
			    </div>
			</div>    
		</div>	
    </div>

</div>