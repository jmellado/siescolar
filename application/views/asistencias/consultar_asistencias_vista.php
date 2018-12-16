	<style type="text/css">
	    
	    label.error{color:red;}
	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/asistencias_consultar.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-check-square-o'></i>&nbsp;CONSULTA DE ASISTENCIAS</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="" name="" method="post" id="form_asistencias">

                		<div class="col-md-12">
	        				<div class="panel panel-default">
	                			<div class="panel-body">

									<div class="col-md-3">
										<div class="form-group">
											<label for="id_curso">CURSO</label>
											<div id="cursos_asistencias1">
												<select class="form-control" id="id_cursoAST" name="id_curso">
																    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="id_asignatura">ASIGNATURA</label>
											<div id="asignaturas_asistencias1">
												<select class="form-control" id="id_asignaturaAST" name="id_asignatura">
																    
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
											<label for="fecha">FECHA</label>
											<input type="date" class="form-control" id="fechaAST" name="fecha">
										</div>
				    				</div>

								</div>
							</div>
						</div>	

						<div class="col-md-offset-9 col-md-3">
	        				<div class="form-group">
								<button type="button" name="btn_consultar_asistencia" id="btn_consultar_asistencia" class="btn btn-primary btn-lg btn-block">Consultar Asistencias</button>
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

                	<div class="box">
		    			<div class="box-header with-border">
		    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Estudiantes</div>
		    			</div>

		    			<div class="box-body">
		                	<div class="table-responsive">
								<table border='1' id="lista_asistencias" class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th style="text-align: center;"><i class='fa fa-sort-amount-asc'></i></th>
											<th style="text-align: center;"><i class='fa fa-newspaper-o'></i>&nbsp;Identificación</th>
											<th style="text-align: center;"><i class='fa fa-user'></i>&nbsp;Apellidos Y Nombres</th>
											<th style="text-align: center;"><i class='fa fa-th-large'></i>&nbsp;Curso</th>
											<th style="text-align: center;"><i class='fa fa-check-square'></i>&nbsp;Asistencia</th>
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