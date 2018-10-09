<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/situacion_academica.js" defer></script>

<style type="text/css">

    label.error{color:red;}

</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-shield'></i>&nbsp;SITUACIÓN ACADÉMICA POR CURSO</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="" name="" method="post" id="form_situacionacademica">

						<div class="col-md-offset-1 col-md-3">
							<div class="form-group">
								<label for="jornada">JORNADA</label>
								<select class="form-control" id="jornadaSA" name="jornada">
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
								<div id="cursos_situacion1">
									<select class="form-control" id="id_cursoSA" name="id_curso">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-3">
	        				<div class="form-group">
	        					<label for=""></label>
								<button type="button" name="btn_consultar_SA" id="btn_consultar_SA" class="btn btn-primary btn-lg btn-block">Consultar</button>
							</div>
	        			</div>

                	</form>
                </div>
            </div>    	
    	</div>	
    </div>

    <div id="div-situacionacademica" class="row" style="display:none;">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">

                	<div class="box">
		    			<div class="box-header with-border">
		    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Estudiantes</div>
		    				<div class="box-tools pull-right">
		    					<button type="button" name="btn_imprimir_SA" id="btn_imprimir_SA" class="btn btn-success btn-sm" title="Imprimir Lista."><i class='fa fa-print'></i></button>
		    				</div>	
		    			</div>
		    			<div class="box-body">

		                	<div class="table-responsive">
								<table border='1' id="lista_situacionacademica" class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th style="text-align: center;"><i class='fa fa-sort-amount-asc'></i></th>
											<th style="text-align: center;"><i class='fa fa-newspaper-o'></i>&nbsp;Identificación</th>
											<th style="text-align: center;"><i class='fa fa-user'></i>&nbsp;Apellidos Y Nombres</th>
											<th style="text-align: center;"><i class='fa fa-th-large'></i>&nbsp;Curso</th>
											<th style="text-align: center;"><i class='fa fa-clone'></i>&nbsp;Asignaturas</br>Reprobadas</th>
											<th style="text-align: center;"><i class='fa fa-check-square'></i>&nbsp;Inasistencias</th>
											<th style="text-align: center;"><i class='fa fa-shield'></i>&nbsp;Situación Académica</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<td colspan='7'></td>
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