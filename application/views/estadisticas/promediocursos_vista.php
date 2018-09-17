<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/estadisticas.js" defer></script>

<style type="text/css">

    label.error{color:red;}
    
</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
            	<a class="btn btn-success" href="<?php echo base_url(); ?>estadisticas_controller/index" title="Regresar Al Menu Principal"><i class='fa fa-arrow-left'></i></a>&nbsp;
            	<i class='fa fa-th-large'></i>&nbsp;PROMEDIO POR CURSOS
            </h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="" name="" method="post" id="form_promediocursos">

                		<div class="col-md-12">
                			<div class="panel panel-default">
	                			<div class="panel-body">

	                				<div class="col-md-3">
				        				<div class="form-group">
											<label for="periodo">PERIODO</label>
											<select class="form-control" id="periodoPC" name="periodo">
												<option value="Primero">Primero</option>
												<option value="Segundo">Segundo</option>
												<option value="Tercero">Tercero</option>
												<option value="Cuarto">Cuarto</option>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="jornada">JORNADA</label>
											<select class="form-control" id="jornadaPC" name="jornada">
												<option value="Mañana">Mañana</option>
												<option value="Tarde">Tarde</option>
												<option value="Noche">Noche</option>
												<option value="Unica">Única</option>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="ano_lectivo">AÑO LECTIVO</label>
											<div id="ano_lectivoE1">
												<select class="form-control" id="ano_lectivoPC" name="ano_lectivo">
																    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-3">
				        				<div class="form-group">
				        					<label for=""></label>
											<button type="button" name="btn_consultar_PC" id="btn_consultar_PC" class="btn btn-primary btn-lg btn-block">Consultar</button>
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

    <div id="div-promediocursos" class="row" style="display:none;">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">

                	<div class="box">
		    			<div class="box-header with-border">
		    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Cursos</div>
		    				<div class="box-tools pull-right">
		    					<button type="button" name="btn_imprimir_PC" id="btn_imprimir_PC" class="btn btn-success btn-sm" title="Imprimir Lista."><i class='fa fa-print'></i></button>
		    				</div>	
		    			</div>
		    			<div class="box-body">

		                	<div class="table-responsive">
								<table border='1' id="lista_promediocursos" class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th><i class='fa fa-sort-amount-asc'></i></th>
											<th><i class='fa fa-th-large'></i>&nbsp;Curso</th>
											<th><i class='fa fa-sticky-note'></i>&nbsp;Promedio</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<td colspan='3'></td>
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