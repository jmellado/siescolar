	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-group'></i>&nbsp;GESTIÓN DE USUARIOS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-offset-4 col-lg-3">
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
        
        <div class="panel panel-default">
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

		        <div class="form-group">
					<div class="col-sm-offset-4 col-sm-5">
		        		<button type="submit" name="btn_actualizar_usuario" id="btn_actualizar_usuario" class="btn btn-primary btn-lg btn-block">Actualizar</button>
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