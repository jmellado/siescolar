	<style type="text/css">
	    
	    label.error{color:red;}

	    .panel-margen{
			margin-bottom: 0px;
		}
	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/asistencias_consolidado_mes_consultar_a.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-check-square-o'></i>&nbsp;CONSULTAR CONSOLIDADO DE ASISTENCIAS POR MES</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="" name="" method="post" id="form_asistencias">

						<div class="col-md-3">
							<div class="form-group">
								<label for="id_curso">AÑO LECTIVO</label>
								<div id="ano_lectivo_asistencias1">
									<select class="form-control" id="ano_lectivoAST" name="ano_lectivo">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-3">
	        				<div class="form-group">
								<label for="mes">MES</label>
								<select class="form-control" id="mesAST" name="mes">
									<option></option>
									<option value="00">Todos</option>
									<option value="01">Enero</option>
									<option value="02">Febrero</option>
									<option value="03">Marzo</option>
									<option value="04">Abril</option>
									<option value="05">Mayo</option>
									<option value="06">Junio</option>
									<option value="07">Julio</option>
									<option value="08">Agosto</option>
									<option value="09">Septiembre</option>
									<option value="10">Octubre</option>
									<option value="11">Noviembre</option>
									<option value="12">Diciembre</option>
								</select>
							</div>
						</div>

						<div class="col-md-3">
	        				<div class="form-group">
								<label for="asistencia">ASISTENCIA</label>
								<select class="form-control" id="asistenciaAST" name="asistencia">
									<option></option>
									<option value="Todas">Todas</option>
									<option value="Asistió">Asistió</option>
									<option value="Faltó">Faltó</option>
									<option value="Tardanza">Tardanza</option>
									<option value="Falta Justificada">Falta Justificada</option>
									<option value="Tardanza Justificada">Tardanza Justificada</option>
								</select>
							</div>
						</div>

						<div class="col-md-3">
	        				<div class="form-group">
	        					<label for=""></label>
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
											<th style="text-align: center;"><i class='fa fa-calendar-check-o'></i>&nbsp;Mes</th>
											<th style="text-align: center;"><i class='fa fa-check-square'></i>&nbsp;Asistencia</th>
											<th style="text-align: center;"><i class='fa fa-caret-right'></i>&nbsp;Total</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<td colspan='4'></td>
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