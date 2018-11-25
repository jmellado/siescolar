	<style type="text/css">
	    
	    label.error{color:red;}

	    #modal_ingresar_notas_actividad .modal-body
		{
  			height:450px;
  			overflow:auto;
		}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-sticky-note'></i>&nbsp;REGISTRO DE NOTAS POR ACTIVIDADES</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">

    		<div class="panel panel-default">
                <div class="panel-body">

					<form role="form" action="" name="" method="post" id="form_consultar_actividades">

	        			<div class="col-md-12">
	        				<div class="panel panel-default">
	                			<div class="panel-body">

			        				<div class="col-md-offset-1 col-md-3">
				        				<div class="form-group">
											<label for="periodo">PERIODO</label>
											<select class="form-control" id="periodoCA" name="periodo">
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
												<select class="form-control" id="id_cursoCA" name="id_curso">
															    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="id_asignatura">ASIGNATURA</label>
											<div id="asignaturas_actividades1">
												<select class="form-control" id="id_asignaturaCA" name="id_asignatura">
															    
												</select>
											</div>
										</div>
									</div>

								</div>
							</div>
	        			</div>

	        			<div class="col-sm-offset-9 col-sm-3">
	        				<div class="form-group">
								<button type="button" name="btn_consultar_actividades" id="btn_consultar_actividades" class="btn btn-primary btn-lg btn-block">Consultar Actividades</button>
							</div>
	        			</div>

        			</form>

                </div>
            </div>

    	</div>
    </div>

    <div id="div_actividades" class="row" style="display:none;">
    	<div class="col-md-12">
	    	<div class="panel panel-default">
		    	<div class="panel-body">

		    		<div class="row">
				    	<div class="col-md-12">
				    		<div class="panel panel-default">
				    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Actividades</div>
				    				<div class="panel-body">

				    					<div class="form-group">
										  <label for="cantidad_actividadCA">Mostrar Por:</label>
										  <select class="selectpicker" id="cantidad_actividadCA" name="cantidad_actividadCA" >
										    <option value="5">5</option>
						  					<option value="10">10</option>
						  					<option value="15">15</option>
						  					<option value="20">20</option>
										  </select>
										</div>

										<div class="table-responsive">
										<table border='1' id="lista_actividadesCA" class="table table-bordered table-condensed table-hover table-striped">
											<thead>
												<tr>
													<th><i class='fa fa-sort-amount-asc'></i></th>
													<th><i class='fa fa-file-text-o'></i>&nbsp;Actividad</th>
													<th><i class='fa fa-clock-o'></i>&nbsp;Periodo</th>
													<th><i class='fa fa-th-large'></i>&nbsp;Curso</th>
													<th><i class='fa fa-clone'></i>&nbsp;Asignatura</th>
													<th><i class='fa fa-list-alt'></i>&nbsp;Listado</th>
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

										<div class="text-center paginacion_actividadCA">
										
										</div>

				    				</div>

				    		</div>
				    	</div>
				    </div>

		    	</div>
		    </div>
		</div>    	
    </div>

</div>


<!-- Modal  ingresar nuev nota -->
<div id="modal_ingresar_notas_actividad" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR NOTAS</h4>
      </div>
      <div class="modal-body">
        

        <form role="form" action="<?php echo base_url(); ?>actividades_controller/insertar_notas" name="" method="post" id="form_notas_actividad_insertar">

        	<div class="col-md-12">

				<div class="panel panel-default">
        			<div class="panel-body">

        				<input type="hidden" class="form-control" id="id_actividadseleCA" name="id_actividad">
        				<input type="hidden" class="form-control" id="id_cursoseleCA" name="id_curso">

        				<div class="col-md-offset-1 col-md-3">
	        				<div class="form-group">
								<label for="periodo">PERIODO</label>
									<select class="form-control" id="periodoseleCA" name="periodo" disabled>
										<option value="Primero">Primero</option>
										<option value="Segundo">Segundo</option>
										<option value="Tercero">Tercero</option>
										<option value="Cuarto">Cuarto</option>
									</select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="curso">CURSO</label>
								<input type="text" class="form-control" id="cursoseleCA" name="curso" disabled>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="asignatura">ASIGNATURA</label>
								<input type="text" class="form-control" id="asignaturaseleCA" name="asignatura" disabled>
							</div>
						</div>

					</div>
				</div>

			</div>

        	<div class="row">
		    	<div class="col-md-12">
		    		<div class="panel panel-default">
		    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Ingresar Notas</div>
		    				<div class="panel-body">

		    					<!--<div class="form-group">
								  <label for="cantidad_nota_actividad">Mostrar Por:</label>
								  <select class="selectpicker" id="cantidad_nota_actividad" name="cantidad_nota" >
								    <option value="5">5</option>
				  					<option value="10">10</option>
				  					<option value="15">15</option>
				  					<option value="20">20</option>
								  </select>
								</div>-->

								<div class="table-responsive">
								<table border='1' id="lista_notas_actividad" class="table table-bordered table-condensed table-hover table-striped">
									<thead>
										<tr>
											<th><i class='fa fa-sort-amount-asc'></i></th>
											<th><i class='fa fa-newspaper-o'></i>&nbsp;Identificacion</th>
											<th><i class='fa fa-file-text-o'></i>&nbsp;Nombres</th>
											<th><i class='fa fa-file-text-o'></i>&nbsp;1° Apellido</th>
											<th><i class='fa fa-file-text-o'></i>&nbsp;2° Apellido</th>
											<th><i class='fa fa-caret-down'></i>&nbsp;Nota</th>
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

								<!--<div class="text-center paginacion_nota_actividad">
								
								</div>-->

		    				</div>

		    		</div>
		    	</div>
		    </div>

		    <!--<div class="row">
				<div class="col-sm-offset-9 col-sm-3">
	        		<div class="form-group">
						<button type="submit" name="btn_registrar_nota_actividad" id="btn_registrar_nota_actividad" class="btn btn-primary btn-lg btn-block">Registrar Notas</button>
					</div>
	        	</div>
	        </div>-->

        </form>

      </div>
      <div class="modal-footer">
      	<div class="row">
			<div class="col-sm-offset-9 col-sm-3">
       			<button type="button" class="btn btn-success btn-lg btn-block" id="btn_registrar_nota_actividad" name="btn_registrar_nota_actividad">Registrar Notas</button>
       		</div>
       	</div>	
      </div>
    </div>

  </div>
</div>