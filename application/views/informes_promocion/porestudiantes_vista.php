<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/informes_promocion_estudiantes.js" defer></script>

<style type="text/css">

    label.error{color:red;}

</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
            	<a class="btn btn-success" href="<?php echo base_url(); ?>informes_promocion_controller/index" title="Regresar Al Menu Principal"><i class='fa fa-arrow-left'></i></a>&nbsp;
            	<i class='fa fa-group'></i>&nbsp;INFORMES DE PROMOCIÓN POR ESTUDIANTES
            </h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="" name="" method="post" id="form_porestudiantes">

        				<div class="col-md-offset-1 col-md-3">
							<div class="form-group">
								<label for="ano_lectivo">AÑO LECTIVO</label>
								<div id="ano_lectivoPE1">
									<select class="form-control" id="ano_lectivoPE" name="ano_lectivo">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="id_curso">CURSO</label>
								<div id="cursoPE1">
									<select class="form-control" id="id_cursoPE" name="id_curso">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-3">
	        				<div class="form-group">
	        					<label for=""></label>
								<button type="button" name="btn_consultar_PE" id="btn_consultar_PE" class="btn btn-primary btn-lg btn-block">Consultar</button>
							</div>
	        			</div>			

                	</form>
                </div>
            </div>    	
    	</div>	
    </div>

    <div id="div-porestudiantes" class="row" style="display:none;">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">

                	<div class="box">
		    			<div class="box-header with-border">
		    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Estudiantes</div>
		    				<div class="box-tools pull-right">
		    					<button type="button" name="btn_imprimir_PE" id="btn_imprimir_PE" class="btn btn-success btn-sm" title="Imprimir Lista."><i class='fa fa-print'></i></button>
		    				</div>	
		    			</div>
		    			<div class="box-body">
		                	<div class="table-responsive">
								<table border='1' id="lista_porestudiantes" class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th><i class='fa fa-sort-amount-asc'></i></th>
											<th><i class='fa fa-th-large'></i>&nbsp;Curso</th>
											<th><i class='fa fa-user'></i>&nbsp;Estudiante</th>
											<th><i class='fa fa-shield'></i>&nbsp;Situación Académica</th>
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