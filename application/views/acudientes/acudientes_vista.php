	<style type="text/css">
	    
	    label.error{color:red;}

	    #modal_agregar_acudiente .modal-body
		{
  			height:480px;
  			overflow:auto;
		}

		#modal_actualizar_acudiente .modal-body
		{
  			height:480px;
  			overflow:auto;
		}
	    
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-group'></i>&nbsp;GESTIÓN DE ACUDIENTES</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_acudiente" id="btn_agregar_acudiente" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Acudiente</button>
    			<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal_agregar_acudiente">Open Modal</button>-->
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_acudiente" name="buscar_acudiente"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_acudiente" id="btn_buscar_acudiente" class="btn btn-primary">
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
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Acudientes</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_acudiente">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_acudiente" name="cantidad_acudiente" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_acudientes" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-newspaper-o'></i>&nbsp;Identificación</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Nombres</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;1° Apellido</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;2° Apellido</th>
									<th><i class='fa fa-phone-square'></i>&nbsp;Telefono</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_acudiente">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>

</div>

<!-- Modal  agregar nuev grado --><!--Para Que no se cierre el modal automaticamente utilizar data-backdrop="static" data-keyboard="false"-->
<div id="modal_agregar_acudiente" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR ACUDIENTES</h4>
      </div>
      <div class="modal-body">
        
      	<div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>acudientes_controller/insertar" name="" method="post" id="form_acudientes">

		        	<div class="row">
		        		
		        		<div class="col-md-6">

		        			<div class="panel panel-default">
		    					<div class="panel-body">

		    						<div class="form-group">
								    	<label class="control-label col-md-4" for="identificacion">IDENTIFICACIÓN</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="identificacion_a" name="identificacion"
								           placeholder="Identificación" onkeypress="return validar_solonumeros(event)">
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="nombres">NOMBRES</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="nombres_a" name="nombres"
								           placeholder="Nombres" readonly>
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="apellido1">1° APELLIDO</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="apellido1_a" name="apellido1"
								           placeholder="Primer Apellido" readonly>
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="apellido2">2° APELLIDO</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="apellido2_a" name="apellido2"
								           placeholder="Segundo Apellido" readonly>
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="telefono">TELÉFONO</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="telefono_a" name="telefono"
								           placeholder="Teléfono" readonly>
								        </div>   
								  	</div>
						        	
								</div>
							</div>	
						</div>

						<div class="col-md-6">

							<div class="panel panel-default">
		    					<div class="panel-body">

		    						<div class="form-group">
								    	<label class="control-label col-md-4" for="direccion">DIRECCIÓN</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="direccion_a" name="direccion"
								           placeholder="Dirección" readonly>
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="barrio">BARRIO</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="barrio_a" name="barrio"
								           placeholder="Barrio" readonly>
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="ocupacion">OCUPACIÓN</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="ocupacion_a" name="ocupacion"
								           placeholder="Ocupación">
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="telefono_trabajo">TELÉFONO TRABAJO</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="telefono_trabajo_a" name="telefono_trabajo"
								           placeholder="Teléfono Trabajo">
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="direccion_trabajo">DIRECCIÓN TRABAJO</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="direccion_trabajo_a" name="direccion_trabajo"
								           placeholder="Dirección Trabajo">
								        </div>   
								  	</div>

								</div>
							</div>	
						</div>

						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-4">
								<button type="submit" name="btn_registrar_acudiente" id="btn_registrar_acudiente" class="btn btn-primary btn-lg btn-block">Registrar</button>
							</div>
						</div>		
						
					</div>
		        </form>
		    </div>
		</div>        

      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>


<!-- Modal  actualizar acudiente -->
<div id="modal_actualizar_acudiente" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR ACUDIENTES</h4>
      </div>
      <div class="modal-body">
        
        <div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" id="form_acudientes_actualizar">
										    
					<div class="row">
		        		
		        		<div class="col-md-6">

		        			<div class="panel panel-default">
		    					<div class="panel-body">

		    						<input type="hidden" class="form-control" id="id_personasele" name="id_persona">
		    						<input type="hidden" class="form-control" id="identificacionsele2" name="identificacion">

		    						<div class="form-group">
								    	<label class="control-label col-md-4" for="identificacion">IDENTIFICACIÓN</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="identificacionsele" name="identificacion"
								           placeholder="Identificación" disabled>
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="nombres">NOMBRES</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="nombressele" name="nombres"
								           placeholder="Nombres" readonly>
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="apellido1">1° APELLIDO</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="apellido1sele" name="apellido1"
								           placeholder="Primer Apellido" readonly>
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="apellido2">2° APELLIDO</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="apellido2sele" name="apellido2"
								           placeholder="Segundo Apellido" readonly>
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="telefono">TELÉFONO</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="telefonosele" name="telefono"
								           placeholder="Teléfono" readonly>
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="direccion">DIRECCIÓN</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="direccionsele" name="direccion"
								           placeholder="Dirección" readonly>
								        </div>   
								  	</div>
						        	
								</div>
							</div>	
						</div>

						<div class="col-md-6">

							<div class="panel panel-default">
		    					<div class="panel-body">

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="barrio">BARRIO</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="barriosele" name="barrio"
								           placeholder="Barrio" readonly>
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="ocupacion">OCUPACIÓN</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="ocupacionsele" name="ocupacion"
								           placeholder="Ocupación">
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="telefono_trabajo">TELÉFONO TRABAJO</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="telefono_trabajosele" name="telefono_trabajo"
								           placeholder="Teléfono Trabajo">
								        </div>   
								  	</div>

								  	<div class="form-group">
								    	<label class="control-label col-md-4" for="direccion_trabajo">DIRECCIÓN TRABAJO</label>
								    	<div class="col-md-7">
								    		<input type="text" class="form-control" id="direccion_trabajosele" name="direccion_trabajo"
								           placeholder="Dirección Trabajo">
								        </div>   
								  	</div>

								  	<div class="form-group">
										<label class="control-label col-md-4" for="estado_acudiente">ESTADO</label>
										<div class="col-md-7">
											<select class="form-control" id="estado_acudientesele" name="estado_acudiente">
													<option value="Activo">Activo</option>
													<option value="Inactivo">Inactivo</option>
											</select>
										</div>	
									</div>

								</div>
							</div>	
						</div>

					</div>
					
		        </form>

		        <div class="form-group">
					<div class="col-sm-offset-4 col-sm-4">
		        		<button type="submit" name="btn_actualizar_acudiente" id="btn_actualizar_acudiente" class="btn btn-primary btn-lg btn-block">Actualizar</button>
		        	</div>
		        </div>		

		    </div>
		</div>        

      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>