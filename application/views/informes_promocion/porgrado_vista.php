<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/informes_promocion_grado.js" defer></script>

<style type="text/css">

    label.error{color:red;}

</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
            	<a class="btn btn-success" href="<?php echo base_url(); ?>informes_promocion_controller/index" title="Regresar Al Menu Principal"><i class='fa fa-arrow-left'></i></a>&nbsp;
            	<i class='fa fa-graduation-cap'></i>&nbsp;INFORMES DE PROMOCIÓN POR GRADO
            </h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="" name="" method="post" id="form_porgrado">

        				<div class="col-md-offset-1 col-md-3">
							<div class="form-group">
								<label for="ano_lectivo">AÑO LECTIVO</label>
								<div id="ano_lectivoPG1">
									<select class="form-control" id="ano_lectivoPG" name="ano_lectivo">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="id_grado">GRADO</label>
								<div id="gradoPG1">
									<select class="form-control" id="id_gradoPG" name="id_grado">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-3">
	        				<div class="form-group">
	        					<label for=""></label>
								<button type="button" name="btn_consultar_PG" id="btn_consultar_PG" class="btn btn-primary btn-lg btn-block">Consultar</button>
							</div>
	        			</div>			

                	</form>
                </div>
            </div>    	
    	</div>	
    </div>

    <div id="div-porgrado" class="row" style="display:none;">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">

                	<div class="box">
		    			<div class="box-header with-border">
		    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Grados</div>
		    				<div class="box-tools pull-right">
		    					<button type="button" name="btn_imprimir_PG" id="btn_imprimir_PG" class="btn btn-success btn-sm" title="Imprimir Lista."><i class='fa fa-print'></i></button>
		    				</div>	
		    			</div>
		    			<div class="box-body">

		                	<div class="table-responsive">
								<table border='1' id="lista_porgrado" class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th><i class='fa fa-sort-amount-asc'></i></th>
											<th><i class='fa fa-graduation-cap'></i>&nbsp;Grado</th>
											<th><i class='fa fa-shield'></i>&nbsp;Situación Académica</th>
											<th><i class='fa fa-caret-right'></i>&nbsp;Total</th>
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