<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/notas_finales.js" defer></script>

<style type="text/css">

    label.error{color:red;}

</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-list-alt'></i>&nbsp;NOTAS FINALES POR ESTUDIANTE</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="" name="" method="post" id="form_notas_finales">

						<div class="col-md-3">
							<div class="form-group">
								<label for="jornada">JORNADA</label>
								<select class="form-control" id="jornadaNF" name="jornada">
									<option value="Mañana">Mañana</option>
									<option value="Tarde">Tarde</option>
									<option value="Noche">Noche</option>
									<option value="Unica">Única</option>
								</select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="id_curso">CURSO</label>
								<div id="cursos_notasfinales1">
									<select class="form-control" id="id_cursoNF" name="id_curso">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="id_estudiante">ESTUDIANTE</label>
								<div id="estudiantes_notasfinales1">
									<select class="form-control" id="id_estudianteNF" name="id_estudiante">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-2">
	        				<div class="form-group">
	        					<label for=""></label>
								<button type="button" name="btn_consultar_NF" id="btn_consultar_NF" class="btn btn-primary btn-lg btn-block">Consultar</button>
							</div>
	        			</div>

                	</form>
                </div>
            </div>    	
    	</div>	
    </div>

    <div id="div-notasfinales" class="row" style="display:none;">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">

                	<div class="box">
		    			<div class="box-header with-border">
		    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Asignaturas</div>	
		    			</div>
		    			<div class="box-body">

		                	<div class="table-responsive">
								<table border='1' id="lista_notasfinales" class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th width="30" style="text-align: center;"><i class='fa fa-sort-amount-asc'></i></th>
											<th width="200"><i class='fa fa-clone'></i>&nbsp;Asignatura</th>
											<th width="40" style="text-align: center;">1°P</th>
											<th width="40" style="text-align: center;">2°P</th>
											<th width="40" style="text-align: center;">3°P</th>
											<th width="40" style="text-align: center;">4°P</th>
											<th width="80" style="text-align: center;">Definitiva</th>
											<th width="80" style="text-align: center;">Desempeño</th>
											<th width="80" style="text-align: center;">Inasistencias</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<td colspan='9'></td>
										</tr>
									</tfoot>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>		

                </div>
            </div>
        </div>        	
    </div>

</div>