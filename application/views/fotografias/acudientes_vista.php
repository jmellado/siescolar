
	<style type="text/css">
	    
	    label.error{color:red;}

	    #myModal .modal-body
		{
  			height:440px;
  			overflow:auto;
		}

		.panel-margen{
			margin-bottom: 0px;
		}
	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/fotografias_acudientes.js" defer></script>

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-photo'></i>&nbsp;CARGAR FOTOGRAFIAS DE ACUDIENTES</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-offset-5 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_acudientef" name="buscar_acudientef"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_acudientef" id="btn_buscar_acudientef" class="btn btn-primary">
							<i class="fa fa-search"></i>
						</button>
					</span>
    			</div>
    		</div>	
    	</div>
    </div>

  	<div class="row">
    	<div class="col-md-12">
    		<div class="box">
    			<div class="box-header with-border"><div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Acudientes</div></div>
    				<div class="box-body">

    					<div class="form-group">
						  <label for="cantidad_acudientef">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_acudientef" name="cantidad_acudientef" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_acudientesf" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-photo'></i>&nbsp;Foto</th>
									<th><i class='fa fa-newspaper-o'></i>&nbsp;Identificación</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Nombres</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;1° Apellido</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;2° Apellido</th>
									<th><i class='fa fa-phone-square'></i>&nbsp;Telefono</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
                                <tr>
                                    <td colspan='12'></td>
                                </tr>
                            </tfoot>
						</table>
						</div>

						<div class="text-center paginacion_acudientef">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>

</div>


<!-- Modal  cargar foto -->
<div id="modal_cargar_fotoAC" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class='fa fa-photo'></i>&nbsp;CARGAR FOTOGRAFIA</h4>
			</div>

			<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>fotografias_controller/cargar_fotografiaAC" name="" method="post" id="form_cargar_fotoAC" enctype="multipart/form-data">
		      	<div class="modal-body">
		        
			        <div class="panel panel-default panel-margen">
					    <div class="panel-body">
	    
							<input type="hidden" class="form-control" id="id_personasele" name="id_persona">
							
				        	<div class="form-group">
								<label class="control-label col-sm-4" for="nombre_acudiente">ACUDIENTE</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="nombre_acudientesele" name="nombre_acudiente" placeholder="Nombre Del Acudiente" disabled>
								</div>		 
							</div>

							<div class="form-group">
								<label class="control-label col-sm-4" for="foto_acudiente">FOTOGRAFIA (En formato JPG o PNG no mayor a 6Mb)</label>
								<div class="col-sm-7">
									<input class="btn btn-default" type="file" name="foto_acudiente" accept="image/*" required>
								</div>		 
							</div>

					    </div>
					</div>        	

		      	</div>
				<div class="modal-footer">
					<div class="col-sm-offset-4 col-sm-4">
		        		<button type="submit" name="btn_cargar_fotoAC" id="btn_cargar_fotoAC" class="btn btn-primary btn-lg btn-block">Cargar Fotografia</button>
		        	</div>
				</div>
			</form>
	    </div>

	</div>
</div>