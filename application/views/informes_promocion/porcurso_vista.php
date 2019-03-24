<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/informes_promocion_curso.js" defer></script>

<style type="text/css">

    label.error{color:red;}

</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
            	<a class="btn btn-success" href="<?php echo base_url(); ?>informes_promocion_controller/index" title="Regresar Al Menu Principal"><i class='fa fa-arrow-left'></i></a>&nbsp;
            	<i class='fa fa-th-large'></i>&nbsp;INFORMES DE PROMOCIÓN POR CURSO
            </h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="" name="" method="post" id="form_porcurso">

        				<div class="col-md-offset-1 col-md-3">
							<div class="form-group">
								<label for="ano_lectivo">AÑO LECTIVO</label>
								<div id="ano_lectivoPC1">
									<select class="form-control" id="ano_lectivoPC" name="ano_lectivo">
													    
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="id_curso">CURSO</label>
								<div id="cursoPC1">
									<select class="form-control" id="id_cursoPC" name="id_curso">
													    
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

                	</form>
                </div>
            </div>    	
    	</div>	
    </div>

    <div id="div-porcurso" class="row" style="display:none;">
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
								<table border='1' id="lista_porcurso" class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th><i class='fa fa-sort-amount-asc'></i></th>
											<th><i class='fa fa-th-large'></i>&nbsp;Curso</th>
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