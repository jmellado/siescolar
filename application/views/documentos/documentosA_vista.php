	<style type="text/css">
	    
	    label.error{color:red;}

	    .panel-margen{
			margin-bottom: 0px;
		}

	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/documentosA.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-book'></i>&nbsp;GESTIÓN DE DOCUMENTOS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_documento" id="btn_agregar_documento" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Documento</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_documento" name="buscar_documento"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_documento" id="btn_buscar_documento" class="btn btn-primary">
							<i class="fa fa-search"></i>
						</button>
					</span>
    			</div>
    		</div>	
    	</div>

    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary">
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Documentos</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_documento">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_documento" name="cantidad_documento">
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_documentos" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Descripción Del Documento</th>
									<th><i class='fa fa-calendar-check-o'></i>&nbsp;Fecha De Subida</th>
									<th><i class='fa fa-folder-open-o'></i>&nbsp;Archivo</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<td colspan='6'></td>
								</tr>
							</tfoot>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_documento">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>

</div>


<!-- Modal  agregar nuevo documento -->
<div id="modal_agregar_documento" class="modal fade" role="dialog">
	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR DOCUMENTOS</h4>
			</div>

			<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>documentos_controller/insertar_documentoA" name="" method="post" id="form_documentos" enctype="multipart/form-data">

		      	<div class="modal-body">
		        
			      	<div class="panel panel-default panel-margen">
					    <div class="panel-body">

							<div class="form-group">
								<label class="control-label col-sm-3" for="descripcion_documento">DESCRIPCIÓN DEL DOCUMENTO</label>
								<div class="col-sm-7">
									<textarea class="form-control" name="descripcion_documento" id="descripcion_documento" cols="50" rows="4" placeholder="Decripción Del Documento" style="resize:none"></textarea>
								</div>		 
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="documento">DOCUMENTO</label>
								<div class="col-sm-4">
									<input class="btn btn-default" type="file" name="documento" accept=".pdf, .docx, .doc" required>
								</div>		 
							</div>
							
					    </div>
					</div>        

		      	</div>

		      	<div class="modal-footer">
		      		<div class="col-sm-offset-4 col-sm-4">
						<button type="submit" name="btn_registrar_documento" id="btn_registrar_documento" class="btn btn-primary btn-lg btn-block">Registrar</button>
					</div>
		      	</div>
	      	</form>	
	    </div>

	</div>
</div>


<!-- Modal  actualizar documento -->
<div id="modal_actualizar_documento" class="modal fade" role="dialog">
	<div class="modal-dialog">

    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR DOCUMENTOS</h4>
      		</div>
      		<div class="modal-body">
        
		        <div class="panel panel-default panel-margen">
				    <div class="panel-body">

				        <form class="form-horizontal" role="form" id="form_documentos_actualizar">
							    
							<input type="hidden" class="form-control" id="id_documentosele" name="id_documento">

							<div class="form-group">
								<label class="control-label col-sm-3" for="descripcion_documento">DESCRIPCIÓN DEL DOCUMENTO</label>
								<div class="col-sm-7">
									<textarea class="form-control" name="descripcion_documento" id="descripcion_documentosele" cols="50" rows="4" placeholder="Decripción Del Documento" style="resize:none"></textarea>
								</div>		 
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="documento">DOCUMENTO</label>
								<div class="col-sm-4">
									<input class="btn btn-default" type="file" name="documento" accept=".pdf, .docx, .doc">
								</div>		 
							</div>
			
				        </form>

				    </div>
				</div>        	

      		</div>
			<div class="modal-footer">
				<div class="col-sm-offset-4 col-sm-4">
	        		<button type="submit" name="btn_actualizar_documento" id="btn_actualizar_documento" class="btn btn-primary btn-lg btn-block">Actualizar</button>
	        	</div>
			</div>
    	</div>

	</div>
</div>