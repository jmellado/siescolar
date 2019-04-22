<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/consultar_asistenciasA.js" defer></script>

<style type="text/css">

    label.error{color:red;}

</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-check-square-o'></i>&nbsp;ASISTENCIAS</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="" name="" method="post" id="form_consultar_asistenciasA">

						<div class="col-md-3">
	        				<div class="form-group">
								<label for="periodo">PERIODO</label>
								<select class="form-control" id="periodoAA" name="periodo">
									<option value="Primero">Primero</option>
									<option value="Segundo">Segundo</option>
									<option value="Tercero">Tercero</option>
									<option value="Cuarto">Cuarto</option>
								</select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="id_acudido">ACUDIDOS</label>
								<div id="acudidos_asistenciasA1">
									<select class="form-control" id="id_acudidoAA" name="id_acudido">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="id_asignatura">ASIGNATURA</label>
								<div id="asignaturas_asistenciasA1">
									<select class="form-control" id="id_asignaturaAA" name="id_asignatura">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-2">
	        				<div class="form-group">
	        					<label for=""></label>
								<button type="button" name="btn_consultar_asistenciasA" id="btn_consultar_asistenciasA" class="btn btn-primary btn-lg btn-block">Consultar</button>
							</div>
	        			</div>

                	</form>
                </div>
            </div>    	
    	</div>	
    </div>

    <div id="div-consultarasistenciasA" class="row" style="display:none;">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">

                	<div class="box">
		    			<div class="box-header with-border">
		    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Asistencias</div>	
		    			</div>

		    			<div class="box-body">
		                	<div class="table-responsive">
								<table border='1' id="lista_asistenciasA" class="table table-bordered table-condensed table-hover table-striped">
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