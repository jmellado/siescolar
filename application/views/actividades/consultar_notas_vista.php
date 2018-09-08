	<style type="text/css">
	    
	    label.error{color:red;}

	    #modal_ver_notas_actividades .modal-body
		{
  			height:408px;
  			overflow-y:auto;
		}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-sticky-note'></i>&nbsp;CONSULTA DE NOTAS</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">

    		<div class="panel panel-default">
                <div class="panel-body">

					<form role="form" action="" name="" method="post" id="form_consultar_notas">

	        			<div class="col-md-12">
	        				<div class="panel panel-default">
	                			<div class="panel-body">

			        				<div class="col-md-offset-1 col-md-3">
				        				<div class="form-group">
											<label for="periodo">PERIODO</label>
											<select class="form-control" id="periodoCN" name="periodo">
												<option value="Primero">Primero</option>
												<option value="Segundo">Segundo</option>
												<option value="Tercero">Tercero</option>
												<option value="Cuarto">Cuarto</option>
											</select>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="id_grado">CURSO</label>
											<div id="cursos_actividades1">
												<select class="form-control" id="id_cursoCN" name="id_curso">
															    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="id_asignatura">ASIGNATURA</label>
											<div id="asignaturas_actividades1">
												<select class="form-control" id="id_asignaturaCN" name="id_asignatura">
															    
												</select>
											</div>
										</div>
									</div>

								</div>
							</div>
	        			</div>

	        			<div class="col-sm-offset-9 col-sm-3">
	        				<div class="form-group">
								<button type="button" name="btn_consultar_notas" id="btn_consultar_notas" class="btn btn-primary btn-lg btn-block">Consultar Notas</button>
							</div>
	        			</div>

        			</form>

                </div>
            </div>

    	</div>
    </div>

    <div id="div_notas" class="row" style="display:none;">
    	<div class="col-md-12">
	    	<div class="panel panel-default">
		    	<div class="panel-body">

		    		<div class="row">
				    	<div class="col-md-12">
				    		<div class="panel panel-default">
				    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Notas</div>
				    				<div class="panel-body">

				    					<!--<div class="form-group">
										  <label for="cantidad_actividadCA">Mostrar Por:</label>
										  <select class="selectpicker" id="cantidad_nota_asignatura" name="cantidad_nota">
										    <option value="5">5</option>
						  					<option value="10">10</option>
						  					<option value="15">15</option>
						  					<option value="20">20</option>
										  </select>
										</div>-->

										<div class="table-responsive">
										<table border='1' id="lista_notas_asignatura" class="table table-bordered table-condensed table-hover table-striped">
											<thead>
												<tr>
													<th><i class='fa fa-sort-amount-asc'></i></th>
													<th><i class='fa fa-user'></i>&nbsp;Estudiante</th>
													<th><i class='fa fa-clock-o'></i>&nbsp;Periodo</th>
													<th><i class='fa fa-th-large'></i>&nbsp;Curso</th>
													<th><i class='fa fa-clone'></i>&nbsp;Asignatura</th>
													<th><i class='fa fa-sticky-note'></i>&nbsp;Nota Def.</th>
													<th><i class='fa fa-list-alt'></i>&nbsp;Listado</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<td colspan='7'></td>
												</tr>
											</tfoot>
											<tbody>
											</tbody>
										</table>
										</div>

										<!--<div class="text-center paginacion_nota_asignatura">
										
										</div>-->

				    				</div>

				    		</div>
				    	</div>
				    </div>

		    	</div>
		    </div>
		</div>    	
    </div>

</div>


<!-- Modal ver notas por actividades -->
<div id="modal_ver_notas_actividades" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-list-alt'></i>&nbsp;NOTAS POR ACTIVIDADES</h4>
      </div>
      <div class="modal-body">
        
        	<div class="row">
        		<div class="col-md-12">
		        	<div class="panel panel-default">
		    			<div class="panel-body">

		    				<div class="table-responsive">
								<table border='1' id="lista_notas_actividades" class="table table-bordered table-condensed table-hover table-striped">
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