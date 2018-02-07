	<style type="text/css">
	    
	    label.error{color:red;}

	    #modal_agregar_votante .modal-body
		{
  			height:350px;
  			overflow:auto;
		}

		#modal_votantes_eleccion .modal-body
		{
  			height:380px;
  			overflow:auto;
		}

		#cursos_votantes
		{
  			height:290px;
  			overflow:auto;
		}
	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/votantes.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-list'></i>&nbsp;VOTANTES</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
    		<div class="form-group">
    			<button type="submit" name="btn_agregar_votante" id="btn_agregar_votante" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Votantes</button>
    		</div>	
    	</div>

    	<div class="col-lg-offset-2 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_votante" name="buscar_votante"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_votante" id="btn_buscar_votante" class="btn btn-primary">
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
    					<i class='fa fa-list'></i>&nbsp;Lista De Elecciones Con Votantes
    				</div>		
    			</div>
    			
				<div class="box-body">

					<div class="form-group">
					  <label for="cantidad_votante">Mostrar Por:</label>
					  <select class="selectpicker" id="cantidad_votante" name="cantidad_votante" >
					    <option value="5">5</option>
	  					<option value="10">10</option>
	  					<option value="15">15</option>
	  					<option value="20">20</option>
					  </select>
					</div>

					<div class="table-responsive">
					<table border='1' id="lista_votantes" class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<tr>
								<th><i class='fa fa-sort-amount-asc'></i></th>
								<th><i class='fa fa-check-square'></i>&nbsp;Elección</th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td colspan='5'></td>
							</tr>
						</tfoot>
						<tbody>
						</tbody>
					</table>
					</div>

					<div class="text-center paginacion_votante">
					
					</div>

				</div>

    		</div>
    	</div>
    </div>

</div>


<!-- Modal  agregar votantes por eleccion -->
<div id="modal_agregar_votante" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR VOTANTES POR ELECCIÓN</h4>
      </div>
      <div class="modal-body">
        
      	<div class="panel panel-default">
		    <div class="panel-body">

		        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>elecciones_controller/insertar_votante" name="" method="post" id="form_votantes">

		        	<div class="form-group">
						<label class="control-label col-sm-3" for="id_eleccion">ELECCIÓN</label>
						<div class="col-sm-7">
							<div id="eleccionV1">
								<select class="form-control" id="id_eleccion" name="id_eleccion">
										
								</select>
							</div>	
						</div>	
					</div>
					
					<div class="col-sm-offset-3 col-sm-7">
			            <label class="control-label">Seleccione Los Cursos Que Pueden Votar:</label>
			        </div>    

					<div class="form-group">
						<label class="control-label col-sm-3" for="id_eleccion">CURSOS</label>
						<div class="col-sm-7">
							<div id="cursosV1">
								<select class="form-control" id="id_cursoV" name="id_curso[]" size="5" multiple required>
										
								</select>
							</div>	
						</div>	
					</div>

					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-5">
							<button type="submit" name="btn_registrar_votante" id="btn_registrar_votante" class="btn btn-primary btn-lg btn-block">Registrar</button>
						</div>
					</div>		

		        </form>
		    </div>
		</div>        

      </div>
    </div>

  </div>
</div>


<!-- Modal  votantes eleccion -->
<div id="modal_cursos_votantes" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-th-large'></i>&nbsp;CURSOS VOTANTES PARA ESTA ELECCIÓN</h4>
      </div>
      <div class="modal-body">
        
        <div class="panel panel-default">
		    <div class="panel-body">

		    <!--<input type="hidden" name="" id="id_eleccionsele">-->

		    	<div class="row">
			    	<div class="col-md-12">
			    		
						<div id="cursos_votantes" class="table-responsive">
						<table border='1' id="lista_cursos_votantes" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-check-square'></i>&nbsp;Elección</th>
									<th><i class='fa fa-th-large'></i>&nbsp;Curso</th>
									<th></th>
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

			    	</div>
			    </div>

		    </div>
		</div>        

      </div>
    </div>

  </div>
</div>