	<style type="text/css">
	    
	    label.error{color:red;}

	    #modal_agregar_eleccion .modal-body
		{
  			height:430px;
  			overflow:auto;
		}

		#matriculados
		{
  			height:150px;
  			overflow:auto;
		}
	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/candidatos.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-users'></i>&nbsp;GESTIÓN DE CANDIDATOS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_candidato" id="btn_agregar_candidato" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Candidato</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_candidato" name="buscar_candidato"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_candidato" id="btn_buscar_candidato" class="btn btn-primary">
							<i class="fa fa-search"></i>
						</button>
					</span>
    			</div>
    		</div>	
    	</div>

    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="box box-default">
    			<div class="box-header with-border">
    				<div class="box-title">
    					<i class='fa fa-list'></i>&nbsp;Lista De Candidatos
    				</div>		
    			</div>
    			
				<div class="box-body">

					<div class="form-group">
					  <label for="cantidad_eleccion">Mostrar Por:</label>
					  <select class="selectpicker" id="cantidad_candidato" name="cantidad_candidato" >
					    <option value="5">5</option>
	  					<option value="10">10</option>
	  					<option value="15">15</option>
	  					<option value="20">20</option>
					  </select>
					</div>

					<div class="table-responsive">
					<table border='1' id="lista_candidatos" class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<tr>
								<th><i class='fa fa-sort-amount-asc'></i></th>
								<th><i class='fa fa-check-square'></i>&nbsp;Elección</th>
								<th><i class='fa fa-user'></i>&nbsp;Candidato</th>
								<th><i class='fa fa-black-tie'></i>&nbsp;Partido</th>
								<th><i class='fa fa-sort-numeric-asc'></i>&nbsp;Número</th>
								<th><i class='fa fa-shield'></i>&nbsp;Estado</th>
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

					<div class="text-center paginacion_candidato">
					
					</div>

				</div>

    		</div>
    	</div>
    </div>

</div>


<!-- Modal  agregar nuevo candidato -->
<div id="modal_agregar_candidato" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR CANDIDATOS</h4>
      </div>
      <div class="modal-body">
        
      	<div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>elecciones_controller/insertar_candidato" name="" method="post" id="form_candidatos" enctype="multipart/form-data">

					<div class="form-group">
						<label class="control-label col-sm-3" for="id_eleccion">ELECCIÓN</label>
						<div class="col-sm-7">
							<div id="eleccion1">
								<select class="form-control" id="id_eleccion" name="id_eleccion">
										
								</select>
							</div>	
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="candidato">CANDIDATO</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="candidato" name="candidato"
								 placeholder="Candidato" readonly>
						</div>		 
					</div>
					<input type="hidden" class="form-control" id="id_candidato" name="id_candidato">

					<div class="form-group">
						<label class="control-label col-sm-3" for="partido">PARTIDO</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="partido" name="partido"
								 placeholder="Partido">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="numero">NÚMERO TARJETÓN</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="numero" name="numero"
								 placeholder="Número Tarjetón" min="1" max="300">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="numero">FOTO CANDIDATO</label>
						<div class="col-sm-4">
							<input type="file" name="foto_candidato" accept="image/*" size="50" required>
						</div>		 
					</div>

					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-5">
							<button type="submit" name="btn_registrar_candidato" id="btn_registrar_candidato" class="btn btn-primary btn-lg btn-block">Registrar</button>
						</div>
					</div>		

		        </form>
		    </div>
		</div>        

      </div>
    </div>

  </div>
</div>


<!-- Modal buscar estudiantes matriculados -->
<div id="modal_buscar_estudiantes_matriculados" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-search'></i>&nbsp;BÚSQUEDA DE ESTUDIANTES MATRICULADOS</h4>
      </div>
      <div class="modal-body">
        
      	<div class="panel panel-default">
		    <div class="panel-body">

		    	<div class="row">

			    	<div class="col-lg-offset-3 col-lg-6">
			    		<div class="form-group">
			    			<div class="input-group">
			    				<input type="text" class="form-control" id="buscar_estudiante_matriculado" name="buscar_estudiante_matriculado"
								           placeholder="Buscar..">
								<span class="input-group-btn">
									<button type="submit" name="btn_buscar_estudiante_matriculado" id="btn_buscar_estudiante_matriculado" class="btn btn-primary">
										<i class="fa fa-search"></i>
									</button>
								</span>
			    			</div>
			    		</div>	
			    	</div>

			    </div>

			    <div class="row">
			    	<div class="col-md-12">
			    		
						<div id="matriculados" class="table-responsive">
							<table border='1' id="lista_estudiantes_matriculados" class="table table-bordered table-condensed table-hover table-striped">
								<thead>
									<tr>
										<th><i class='fa fa-sort-amount-asc'></i></th>
										<th><i class='fa fa-newspaper-o'></i>&nbsp;Identificación</th>
										<th><i class='fa fa-file-text-o'></i>&nbsp;Nombres Y Apellidos</th>
										<th><i class='fa fa-graduation-cap'></i>&nbsp;Grado</th>
										<th><i class='fa fa-object-group'></i>&nbsp;Grupo</th>
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
							
			    	</div>
			    </div>
		        
		    </div>
		</div>        

      </div>
    </div>

  </div>
</div>


<!-- Modal  actualizar candidato -->
<div id="modal_actualizar_candidato" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR INFORMACIÓN DEL CANDIDATO</h4>
      </div>
      <div class="modal-body">
        
        <div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" id="form_candidatos_actualizar">

		        	<input type="hidden" class="form-control" id="id_candidato_eleccion" name="id_candidato_eleccion">
										    
					<div class="form-group">
						<label class="control-label col-sm-3" for="id_eleccion">ELECCIÓN</label>
						<div class="col-sm-7">
							<div id="eleccion1">
								<select class="form-control" id="id_eleccionsele" name="id_eleccion" disabled>
										
								</select>
							</div>	
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="candidato">CANDIDATO</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="candidatosele" name="candidato"
								 placeholder="Candidato" disabled>
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="partido">PARTIDO</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="partidosele" name="partido"
								 placeholder="Partido">
						</div>		 
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="numero">NÚMERO TARJETÓN</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="numerosele" name="numero"
								 placeholder="Número Tarjetón" min="1" max="300">
						</div>		 
					</div>
					
		        </form>

		        <div class="form-group">
					<div class="col-sm-offset-4 col-sm-5">
		        		<button type="button" name="btn_actualizar_candidato" id="btn_actualizar_candidato" class="btn btn-primary btn-lg btn-block">Actualizar</button>
		        	</div>
		        </div>		

		    </div>
		</div>        

      </div>
    </div>

  </div>
</div>

