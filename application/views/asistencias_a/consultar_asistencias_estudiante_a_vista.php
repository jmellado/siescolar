	<style type="text/css">
	    
	    label.error{color:red;}

	    .panel-margen{
			margin-bottom: 0px;
		}
	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/asistencias_estudiante_consultar_a.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-check-square-o'></i>&nbsp;CONSULTA DE ASISTENCIAS POR ESTUDIANTE</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="" name="" method="post" id="form_asistencias">

        				<div class="panel panel-default panel-margen">
                			<div class="panel-body">

                				<div class="row">
	                				<div class="col-md-3">
										<div class="form-group">
											<label for="id_curso">AÑO LECTIVO</label>
											<div id="ano_lectivo_asistencias1">
												<select class="form-control" id="ano_lectivoAST" name="ano_lectivo">
																    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="id_curso">CURSO</label>
											<div id="cursos_asistencias1">
												<select class="form-control" id="id_cursoAST" name="id_curso">
																    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-5">
										<div class="form-group">
											<label for="id_asignatura">ASIGNATURA</label>
											<div id="asignaturas_asistencias1">
												<select class="form-control" id="id_asignaturaAST" name="id_asignatura">
																    
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<label for="id_estudiante">ESTUDIANTE</label>
											<div id="estudiantes_asistencias1">
												<select class="form-control" id="id_estudianteAST" name="id_estudiante">
															    
												</select>
											</div>
										</div>
									</div>
									
									<div class="col-md-3">
				        				<div class="form-group">
											<label for="periodo">PERIODO</label>
											<select class="form-control" id="periodoAST" name="periodo">
												<option></option>
												<option value="Primero">Primero</option>
												<option value="Segundo">Segundo</option>
												<option value="Tercero">Tercero</option>
												<option value="Cuarto">Cuarto</option>
											</select>
										</div>
									</div>

									<div class="col-md-3">
				        				<div class="form-group">
				        					<label for=""></label>
											<button type="button" name="btn_consultar_asistencia" id="btn_consultar_asistencia" class="btn btn-primary btn-lg btn-block">Consultar Asistencias</button>
										</div>
				        			</div>
								</div>

							</div>
						</div>

                	</form>
                </div>
            </div>    	
    	</div>	
    </div>

    <div id="div-asistencias" class="row" style="display:none;">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">

                	<div class="box panel-margen">
		    			<div class="box-header with-border">
		    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Asistencias</div>
		    			</div>

		    			<div class="box-body">
		                	<div class="table-responsive">
								<table border='1' id="lista_asistencias" class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th width="30" style="text-align: center;"><i class='fa fa-sort-amount-asc'></i></th>
											<th width="300"><i class='fa fa-clone'></i>&nbsp;Asignatura</th>
											<th style="text-align: center;"><i class='fa fa-check-square'></i>&nbsp;Asistencia</th>
											<th style="text-align: center;"><i class='fa fa-clock-o'></i>&nbsp;Horas</th>
											<th style="text-align: center;"><i class='fa fa-calendar-check-o'></i>&nbsp;Fecha</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<td colspan='5'></td>
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