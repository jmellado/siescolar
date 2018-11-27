<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/documentosP.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-book'></i>&nbsp;DOCUMENTOS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-offset-5 col-lg-3">
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

						<div class="text-center paginacion_documento">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>

</div>