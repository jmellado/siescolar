	<style type="text/css">
	    
	    label.error{color:red;}

	    .panel-margen{
			margin-bottom: 0px;
		}

	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/escala_desempeno.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-signal'></i>&nbsp;ESCALA DE DESEMPEÑO</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="box box-default">
    			<div class="box-header with-border">
    				<div class="box-title">
    					<i class='fa fa-list'></i>&nbsp;Lista De Niveles De Desempeño
    				</div>		
    			</div>
				<div class="box-body">

					<div class="table-responsive">
						<table border='1' id="lista_desempenos" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-chevron-circle-right'></i>&nbsp;Nivel De Desempeño</th>
									<th><i class='fa fa-chevron-circle-right'></i>&nbsp;Mínimo</th>
									<th><i class='fa fa-chevron-circle-right'></i>&nbsp;Máximo</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<td colspan='5'></td>
								</tr>
							</tfoot>
						</table>
					</div>

				</div>
    		</div>
    	</div>
    </div>

</div>


<!-- Modal  actualizar desempeno -->
<div id="modal_actualizar_desempeno" class="modal fade" role="dialog">
	<div class="modal-dialog">

    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR NIVEL DE DESEMPEÑO</h4>
      		</div>
	      	<div class="modal-body">
	        
		        <div class="panel panel-default panel-margen">
				    <div class="panel-body">

				        <form class="form-horizontal" role="form" id="form_desempenos_actualizar">
												    
							<input type="hidden" class="form-control" id="id_desempenosele" name="id_desempeno">
							
				        	<div class="form-group">
								<label class="control-label col-sm-3" for="nombre_desempeno">NIVEL DE DESEMPEÑO</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="nombre_desempenosele" name="nombre_desempeno" disabled>
								</div>	
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="rango_inicial">MÍNIMO</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="rango_inicialsele" name="rango_inicial">
								</div>		 
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="rango_final">MÁXIMO</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="rango_finalsele" name="rango_final">
								</div>		 
							</div>

				        </form>		

			    	</div>
				</div>        

	      	</div>
	      	<div class="modal-footer">
	      		<div class="col-sm-offset-4 col-sm-4">
	        		<button type="submit" name="btn_actualizar_desempeno" id="btn_actualizar_desempeno" class="btn btn-primary btn-lg btn-block">Actualizar</button>
	        	</div>
	      	</div>
    	</div>

  	</div>
</div>