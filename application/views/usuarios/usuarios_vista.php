	<style type="text/css">
	    
	    label.error{color:red;}

	    #modal_agregar_usuario .modal-body
		{
  			height:355px;
  			overflow:auto;
		}

		.panel-margen{
			margin-bottom: 0px;
		}

		.panel-margen1{
			margin-bottom: 2px;
		}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-group'></i>&nbsp;GESTIÓN DE USUARIOS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_usuario" id="btn_agregar_usuario" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Usuario</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_usuario" name="buscar_usuario"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_usuario" id="btn_buscar_usuario" class="btn btn-primary">
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
    			<div class="box-header with-border"><div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Usuarios</div></div>
    				<div class="box-body">

    					<div class="form-group">
						  <label for="cantidad_usuario">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_usuario" name="cantidad_usuario" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_usuarios" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-newspaper-o'></i>&nbsp;Identificación</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Nombres</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Apellidos</th>
									<th><i class='fa fa-black-tie'></i>&nbsp;Rol</th>
									<th><i class='fa fa-user'></i>&nbsp;Usuario</th>
									<th><i class='fa fa-shield'></i>&nbsp;Estado</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<td colspan='9'></td>
								</tr>
							</tfoot>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_usuario">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>

</div>

<!-- Modal  actualizar usuario -->
<div id="modal_actualizar_usuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR USUARIOS</h4>
      </div>
      <div class="modal-body">
        
        <div class="panel panel-default panel-margen1">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" id="form_usuarios_actualizar">
										    
					<input type="hidden" class="form-control" id="id_usuariosele" name="id_usuario">

					<div class="form-group">
						<label class="control-label col-sm-3" for="identificacion">IDENTIFICACIÓN</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="identificacionsele_u" name="identificacion" readonly>
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="nombres">NOMBRES</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="nombressele_u" name="nombres" readonly>
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="apellidos">APELLIDOS</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="apellidossele_u" name="apellidos" readonly>
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="rol">ROL</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="rolsele_u" name="rol" readonly>
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="estado_usuario">ESTADO</label>
						<div class="col-sm-7">
							<select class="form-control" id="estado_usuariosele" name="estado_usuario">
									<option value="1">Activo</option>
									<option value="0">Inactivo</option>
							</select>
						</div>	
					</div>

		        </form>		

		    </div>
		</div>        

      </div>
      <div class="modal-footer">
      	<div class="col-sm-offset-4 col-sm-4">
    		<button type="submit" name="btn_actualizar_usuario" id="btn_actualizar_usuario" class="btn btn-primary btn-lg btn-block">Actualizar</button>
    	</div>
      </div>
    </div>

  </div>
</div>


<!-- Modal  agregar nuev usuario --><!--Para Que no se cierre el modal automaticamente utilizar data-backdrop="static" data-keyboard="false"-->
<div id="modal_agregar_usuario" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

	    <!-- Modal content-->
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR USUARIOS</h4>
			</div>

	      	<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>usuarios_controller/insertar" name="" method="post" id="form_usuarios">	
				<div class="modal-body">
					<div class="panel panel-default panel-margen">
					    <div class="panel-body">
					    	<div class="row">
					    		<div class="col-md-6">
					    			<div class="panel panel-default panel-margen1">
					    				<div class="panel-body">

					    					<div class="form-group">
										    	<label class="control-label col-md-4" for="identificacion">IDENTIFICACIÓN</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="identificacion_u" name="identificacion"
										           placeholder="Identificación">
										        </div>   
										  	</div>

										  	<div class="form-group">
											  	<label class="control-label col-md-4" for="tipo_id">TIPO DE IDENTIFICACIÓN</label>
											  	<div class="col-md-7">
												  	<select class="form-control" id="tipo_id" name="tipo_id">
												  		<option value=""></option>
													    <option value="rc">RC</option>
														<option value="ti">TI</option>
														<option value="cc">CC</option>
														<option value="ce">CE</option>
												  	</select>
												</div>  	
											</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="nombres">NOMBRES</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="nombres_u" name="nombres"
										           placeholder="Nombres">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="apellido1">1° APELLIDO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="apellido1_2" name="apellido1"
										           placeholder="Primer Apellido">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="apellido2">2° APELLIDO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="apellido2_u" name="apellido2"
										           placeholder="Segundo Apellido">
										        </div>   
										  	</div>

					    				</div>
					    			</div>		
					    		</div>
					    		
					    		<div class="col-md-6">
					    			<div class="panel panel-default panel-margen1">
					    				<div class="panel-body">

					    					<div class="form-group">
										    	<label class="control-label col-md-4" for="telefono">TELÉFONO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="telefono_u" name="telefono"
										           placeholder="Teléfono">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="correo">CORREO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="correo_u" name="correo"
										           placeholder="Correo">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="direccion">DIRECCIÓN</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="direccion_u" name="direccion"
										           placeholder="Dirección">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="barrio">BARRIO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="barrio_u" name="barrio"
										           placeholder="Barrio">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="rol">ROL</label>
										    	<div class="col-md-7">
										           <select class="form-control" id="rol_u" name="rol">
														<option value=""></option>
														<option value="1">Administrador</option>
													</select>
										        </div>   
										  	</div>

					    				</div>
					    			</div>		
					    		</div>	
					    	</div>	
					    </div>
					</div>  
				</div>
		      	<div class="modal-footer">
					<div class="col-sm-offset-4 col-sm-4">
						<button type="submit" name="btn_registrar_usuario" id="btn_registrar_usuario" class="btn btn-primary btn-lg btn-block">Registrar</button>
					</div>
		      	</div>
		    </form>  
	    </div>

  	</div>
</div>
