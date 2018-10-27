<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/consultar_notasE.js" defer></script>

<style type="text/css">

    label.error{color:red;}

    #modal_ver_actividades .modal-body
	{
		height:408px;
		overflow-y:auto;
	}

</style>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-bar-chart'></i>&nbsp;MIS CALIFICACIONES</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="" name="" method="post" id="form_consultar_notasE">

						<div class="col-md-offset-3 col-md-3">
	        				<div class="form-group">
								<label for="periodo">PERIODO</label>
								<select class="form-control" id="periodoNE" name="periodo">
									<option value="Primero">Primero</option>
									<option value="Segundo">Segundo</option>
									<option value="Tercero">Tercero</option>
									<option value="Cuarto">Cuarto</option>
								</select>
							</div>
						</div>

						<div class="col-md-3">
	        				<div class="form-group">
	        					<label for=""></label>
								<button type="button" name="btn_consultar_NE" id="btn_consultar_NE" class="btn btn-primary btn-lg btn-block">Consultar</button>
							</div>
	        			</div>

                	</form>
                </div>
            </div>    	
    	</div>	
    </div>

    <div id="div-consultarnotasE" class="row" style="display:none;">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">

                	<div class="box">
		    			<div class="box-header with-border">
		    				<div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Asignaturas</div>	
		    			</div>
		    			<div class="box-body">

		                	<div class="table-responsive">
								<table border='1' id="lista_asignaturasNE" class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th><i class='fa fa-sort-amount-asc'></i></th>
											<th><i class='fa fa-clone'></i>&nbsp;Asignatura</th>
											<th><i class='fa fa-list-alt'></i>&nbsp;Listado</th>
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


<!-- Modal ver notas por actividades -->
<div id="modal_ver_actividades" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title"><i class='fa fa-list-alt'></i>&nbsp;ACTIVIDADES</h4>
	    	</div>
	    	<div class="modal-body">
	        
	        	<div class="row">
	        		<div class="col-md-12">
			        	<div class="panel panel-default">
			    			<div class="panel-body">

			    				<div class="table-responsive">
									<table border='1' id="lista_actividadesNE" class="table table-bordered table-condensed table-hover table-striped">
										<thead>
											<tr>
												<th><i class='fa fa-sort-amount-asc'></i></th>
												<th><i class='fa fa-file-text-o'></i>&nbsp;Actividad</th>
												<th style="text-align:center;"><i class='fa fa-sticky-note'></i>&nbsp;Nota</th>
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
	      	<!--<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div>-->
	    </div>
	</div>
</div>