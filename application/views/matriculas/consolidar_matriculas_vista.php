<style type="text/css">

    label.error{color:red;}

</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-tasks'></i>&nbsp;CONSOLIDAR MATRÍCULAS</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
	    	<div class="panel panel-default">
	            <div class="panel-body">

	            	<div class="col-md-12">
			    		<div class="callout callout-info">
			            	<h4>Informacíon Importante!</h4>

			                <p>A Continuación Podra Realizar El Consolodidado De Matrículas, El Cual Permite Definir La Situción Académica De Los Estudiante Matriculados En El Respectivo Año Lectivo; Tenga En Cuenta Que Para Realizar Este Proceso, Se Deben Encontrar Todos Los Períodos De Evaluación En Estado Cerrado.</p>
			            </div>
			    	</div>

			    	<div class="col-md-12">
			    		<form role="form" action="" name="" method="post" id="form_consolidar_matriculas">

			    			<div class="col-md-offset-1 col-md-3">
								<div class="form-group">
									<label for="jornada">JORNADA</label>
									<select class="form-control" id="jornadaCM" name="jornada">
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
									<div id="cursos_consolidar1">
										<select class="form-control" id="id_cursoCM" name="id_curso">
														    
										</select>
									</div>
								</div>
							</div>

			    			<div class="col-md-3">
					    		<div class="form-group">
					    			<label for=""></label>
					    			<button type="button" name="btn_consolidar_matriculas" id="btn_consolidar_matriculas" class="btn btn-success btn-lg"><i class='fa fa-check-square'></i>&nbsp;Consolidar Matrículas</button>
					    		</div>
					    	</div>

				    	</form>
			    	</div>
			    		
			    </div>
			</div>    
		</div>	
    </div>

</div>