	<style type="text/css">
	    
	    label.error{color:red;}

	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/abstencion.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-ban'></i>&nbsp;ABSTENCIÓN DE LAS ELECCIONES</h1>
        </div>
    </div>

    <div class="panel panel-default">
		<div class="panel-body">
		    <div class="row">
		    	<div class="col-md-12">
		    		<div class="panel panel-default">
				    	<div class="panel-body">

				    		<div class="col-md-offset-1 col-md-4">
					    		<div class="form-group">
									<label for="ano_lectivo">AÑO LECTIVO</label>
									<div id="ano_lectivoAB1">
										<select class="form-control" id="ano_lectivoAB" name="ano_lectivo">
														    
										</select>
									</div>	
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="id_eleccionAB">ELECCIÓN</label>
									<div id="eleccionAB1">
										<select class="form-control" id="id_eleccionAB" name="id_eleccion">
												
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
		    					<i class='fa fa-list'></i>&nbsp;Lista De Abstención
		    				</div>		
		    			</div>
		    			
						<div class="box-body">

							<div class="table-responsive">
							<table border='1' id="lista_abstencion" class="table table-bordered table-condensed table-hover table-striped">
								<thead>
									<tr>
										<th><i class='fa fa-sort-amount-asc'></i></th>
										<th><i class='fa fa-newspaper-o'></i>&nbsp;Identificación</th>
										<th><i class='fa fa-user'></i>&nbsp;Nombres Y Apellidos</th>
										<th><i class='fa fa-th-large'></i>&nbsp;Curso</th>
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