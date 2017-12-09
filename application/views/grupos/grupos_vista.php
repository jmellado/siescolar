	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-object-group'></i>&nbsp;GESTIÓN DE GRUPOS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_grupo" id="btn_agregar_grupo" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Grupo</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_grupo" name="buscar_grupo"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_grupo" id="btn_buscar_grupo" class="btn btn-primary">
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
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Grupos</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_grupo">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_grupo" name="cantidad_grupo" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_grupos" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Nombre</th>
									<th><i class='fa fa-calendar-times-o'></i>&nbsp;Año lectivo</th>
									<th><i class='fa fa-shield'></i>&nbsp;Estado</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_grupo">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>



</div>

<!-- Modal  agregar nuev grado -->
<div id="modal_agregar_grupo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR GRUPOS</h4>
      </div>
      <div class="modal-body">
        
      	<div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>grupos_controller/insertar" name="" method="post" id="form_grupos">

		        	<div class="form-group">
						<label class="control-label col-sm-3" for="nombre_grupo">NOMBRE</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="nombre_grupo" name="nombre_grupo"
								 placeholder="Nombre">
						</div>			 
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-3" for="año_lectivo">AÑO LECTIVO</label>
						<div class="col-sm-7">
							<div id="ano_lectivo1">
								<select class="form-control" id="ano_lectivo" name="ano_lectivo">
												    
								</select>
							</div>
						</div>	
					</div>
				
					<div class="form-group">
						<label class="control-label col-sm-3" for="estado_grupo">ESTADO</label>
						<div class="col-sm-7">
							<select class="form-control" id="estado_grupo" name="estado_grupo">
									<option value="Activo">Activo</option>
									<option value="Inactivo">Inactivo</option>
							</select>
						</div>	
					</div>
						
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-5">
							<button type="submit" name="btn_registrar_grupo" id="btn_registrar_grupo" class="btn btn-primary btn-lg btn-block">Registrar</button>
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

<!-- Modal  actualizar grado -->
<div id="modal_actualizar_grupo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR GRUPO</h4>
      </div>
      <div class="modal-body">
        
        <div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" id="form_grupos_actualizar">
				    
					<input type="hidden" class="form-control" id="id_gruposele" name="id_grupo">
					
		        	<div class="form-group">
						<label class="control-label col-sm-3" for="nombre_grupo">NOMBRE</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="nombre_gruposele" name="nombre_grupo"
								 placeholder="Nombre">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="año_lectivo">AÑO LECTIVO</label>
						<div class="col-sm-7">
							<div id="ano_lectivo1">
								<select class="form-control" id="ano_lectivosele" name="ano_lectivo">
												    
								</select>
							</div>
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="estado_grupo">ESTADO</label>
						<div class="col-sm-7">
							<select class="form-control" id="estado_gruposele" name="estado_grupo">
									<option value="Activo">Activo</option>
									<option value="Inactivo">Inactivo</option>
							</select>
						</div>	
					</div>

		        </form>

		        <div class="form-group">
					<div class="col-sm-offset-4 col-sm-5">
        				<button type="submit" name="btn_actualizar_grupo" id="btn_actualizar_grupo" class="btn btn-primary btn-lg btn-block">Actualizar</button>
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