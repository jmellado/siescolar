	<style type="text/css">
	    
	    label.error{color:red;}

	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/resultados.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-bar-chart'></i>&nbsp;RESULTADOS DE LAS ELECCIONES</h1>
        </div>
    </div>

    <div class="panel panel-default">
		<div class="panel-body form-horizontal">
		    <div class="row">
		    	<div class="col-md-offset-3 col-md-6">
		    		<div class="panel panel-default">
				    	<div class="panel-body form-horizontal">

				    		<div class="form-group">
								<label class="control-label col-sm-3" for="id_eleccionR">ELECCIÓN</label>
								<div class="col-sm-7">
									<div id="eleccionR1">
										<select class="form-control" id="id_eleccionR" name="id_eleccion">
												
										</select>
									</div>	
								</div>	
							</div>

				    	</div>
				    </div>
		    	</div>
		    </div>

		    <div class="row">
		    	<div class="col-md-12">
		    		<div class="box box-default">
		    			<div class="box-header with-border">
		    				<div class="box-title">
		    					<i class='fa fa-list'></i>&nbsp;Resultado Por Candidatos
		    				</div>		
		    			</div>
		    			
						<div class="box-body">

							<div class="table-responsive">
							<table border='1' id="lista_candidatos_eleccionR" class="table table-bordered table-condensed table-hover">
								<thead>
									<tr>
										<th><i class='fa fa-sort-amount-asc'></i></th>
										<th><i class='fa fa-image'></i>&nbsp;Foto Del Candidato</th>
										<th><i class='fa fa-sort-numeric-asc'></i>&nbsp;Número</th>
										<th><i class='fa fa-user'></i>&nbsp;Nombre Del Candidato</th>
										<th><i class='fa fa-check-square'></i>&nbsp;Votos</th>
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