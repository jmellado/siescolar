	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-th'></i>&nbsp;CARGA ACADÉMICA</h1>
        </div>
    </div>
    <input type="hidden" class="form-control" id="id_persona" name="id_persona" value="<?php echo $this->session->userdata('id_persona')?>">

    <!--<div class="row">

    	<div class="col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 col-lg-offset-5 col-lg-3">
    		<div class="form-group">
    			<div class="input-group">
    				<input type="text" class="form-control" id="buscar_cargas_academicas" name="buscar_cargas_academicas"
					           placeholder="Buscar..">
					<span class="input-group-btn">
						<button type="submit" name="btn_buscar_cargas_academicas" id="btn_buscar_cargas_academicas" class="btn btn-primary">
							<i class="fa fa-search"></i>
						</button>
					</span>
    			</div>
    		</div>	
    	</div>
       
    </div>-->

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary">
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Carga Académica</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_cargas_academicas">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_cargas_academicas" name="cantidad_cargas_academicas" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						 
							<span id="th" class="pull-right" style="font-size: 20px"><b>Total Horas Semanales: <span id="total_horas"></span></b></span>
						</div>
						
						<div class="table-responsive">
						<table border='1' id="lista_cargas_academicas" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-th-large'></i>&nbsp;Curso</th>
									<th><i class='fa fa-clone'></i>&nbsp;Asignatura</th>
									<th><i class='fa fa-clock-o'></i>&nbsp;Horas</th>
									<th><i class='fa fa-calendar-times-o'></i>&nbsp;Año lectivo</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_cargas_academicas">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>



</div>
