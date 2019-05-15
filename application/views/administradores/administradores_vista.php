	<style type="text/css">
	    
	    label.error{color:red;}

	    #modal_agregar_administrador .modal-body
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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/administradores.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-group'></i>&nbsp;GESTIÓN DE ADMINISTRADORES</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_administrador" id="btn_agregar_administrador" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Administrador</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_administrador" name="buscar_administrador"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_administrador" id="btn_buscar_administrador" class="btn btn-primary">
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
    			<div class="box-header with-border"><div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Administradores</div></div>
    				<div class="box-body">

    					<div class="form-group">
							<label for="cantidad_administrador">Mostrar Por:</label>
						  	<select class="selectpicker" id="cantidad_administrador" name="cantidad_administrador" >
						    	<option value="5">5</option>
		  						<option value="10">10</option>
		  						<option value="15">15</option>
		  						<option value="20">20</option>
						  	</select>
						</div>

						<div class="table-responsive">
							<table border='1' id="lista_administradores" class="table table-bordered table-condensed table-hover table-striped">
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
								<tfoot>
									<tr>
										<td colspan='8'></td>
									</tr>
								</tfoot>
								<tbody>
								</tbody>
							</table>
						</div>

						<div class="text-center paginacion_administrador">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>

</div>

<!-- Modal  agregar nuevo administrador --><!--Para Que no se cierre el modal automaticamente utilizar data-backdrop="static" data-keyboard="false"-->
<div id="modal_agregar_administrador" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

	    <!-- Modal content-->
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR ADMINISTRADORES</h4>
			</div>

	      	<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>administradores_controller/insertar" name="" method="post" id="form_administradores">	
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
										    		<input type="text" class="form-control" id="identificacion_ad" name="identificacion"
										           placeholder="Identificación" onkeypress="return validar_solonumerosAD(event)">
										        </div>   
										  	</div>

										  	<div class="form-group">
											  	<label class="control-label col-md-4" for="tipo_id">TIPO DE IDENTIFICACIÓN</label>
											  	<div class="col-md-7">
												  	<select class="form-control" id="tipo_id_ad" name="tipo_id" readonly>
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
										    		<input type="text" class="form-control" id="nombres_ad" name="nombres"
										           placeholder="Nombres" readonly>
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="apellido1">1° APELLIDO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="apellido1_ad" name="apellido1"
										           placeholder="Primer Apellido" readonly>
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="apellido2">2° APELLIDO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="apellido2_ad" name="apellido2"
										           placeholder="Segundo Apellido" readonly>
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
										    		<input type="text" class="form-control" id="telefono_ad" name="telefono"
										           placeholder="Teléfono" readonly>
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="correo">CORREO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="correo_ad" name="correo"
										           placeholder="Correo" readonly>
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="direccion">DIRECCIÓN</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="direccion_ad" name="direccion"
										           placeholder="Dirección" readonly>
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="barrio">BARRIO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="barrio_ad" name="barrio"
										           placeholder="Barrio" readonly>
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
						<button type="submit" name="btn_registrar_administrador" id="btn_registrar_administrador" class="btn btn-primary btn-lg btn-block">Registrar</button>
					</div>
		      	</div>
		    </form>  
	    </div>

  	</div>
</div>

<!-- Modal  actualizar administrador -->
<div id="modal_actualizar_administrador" class="modal fade" role="dialog">
  	<div class="modal-dialog modal-lg">

	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR ADMINISTRADORES</h4>
	      	</div>
	      	<div class="modal-body">
	        
		        <div class="panel panel-default panel-margen1">
				    <div class="panel-body">
				        <form class="form-horizontal" role="form" id="form_administradores_actualizar">

				        	<div class="row">
					    		<div class="col-md-6">
					    			<div class="panel panel-default panel-margen1">
					    				<div class="panel-body">

					    					<input type="hidden" class="form-control" id="id_personasele_ad" name="id_persona">

					    					<div class="form-group">
										    	<label class="control-label col-md-4" for="identificacion">IDENTIFICACIÓN</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="identificacionsele_ad" name="identificacion" placeholder="Identificación">
										        </div>   
										  	</div>

										  	<div class="form-group">
											  	<label class="control-label col-md-4" for="tipo_id">TIPO DE IDENTIFICACIÓN</label>
											  	<div class="col-md-7">
												  	<select class="form-control" id="tipo_idsele_ad" name="tipo_id">
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
										    		<input type="text" class="form-control" id="nombressele_ad" name="nombres"
										           placeholder="Nombres">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="apellido1">1° APELLIDO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="apellido1sele_ad" name="apellido1" placeholder="Primer Apellido">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="apellido2">2° APELLIDO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="apellido2sele_ad" name="apellido2" placeholder="Segundo Apellido">
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
										    		<input type="text" class="form-control" id="telefonosele_ad" name="telefono" placeholder="Teléfono">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="correo">CORREO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="correosele_ad" name="correo"
										           placeholder="Correo">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="direccion">DIRECCIÓN</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="direccionsele_ad" name="direccion" placeholder="Dirección">
										        </div>   
										  	</div>

										  	<div class="form-group">
										    	<label class="control-label col-md-4" for="barrio">BARRIO</label>
										    	<div class="col-md-7">
										    		<input type="text" class="form-control" id="barriosele_ad" name="barrio"
										           placeholder="Barrio">
										        </div>   
										  	</div>

					    				</div>
					    			</div>
					    		</div>
					    	</div> 

				        </form>
				    </div>
				</div>        

	      	</div>
	      	<div class="modal-footer">
		      	<div class="col-sm-offset-4 col-sm-4">
		    		<button type="submit" name="btn_actualizar_administrador" id="btn_actualizar_administrador" class="btn btn-primary btn-lg btn-block">Actualizar</button>
		    	</div>
	      	</div>
	    </div>

  	</div>
</div>