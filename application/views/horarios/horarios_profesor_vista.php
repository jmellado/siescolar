	<style type="text/css">
	    
	    label.error{color:red;}

	    #lista_horarios th,td{
	    	text-align: center;
	    }
	    
	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/horarios_profesor.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-calendar'></i>&nbsp;MI HORARIO</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="" name="" method="post" id="form_horario">

        				<div class="col-md-offset-3 col-md-3">
							<div class="form-group">
								<label for="jornada">JORNADA</label>
								<select class="form-control" id="jornada" name="jornada">
									<option value="Mañana">Mañana</option>
									<option value="Tarde">Tarde</option>
									<option value="Noche">Noche</option>
									<option value="Unica">Única</option>
								</select>
							</div>
						</div>

						<div class="col-md-3">
	        				<div class="form-group">
	        					<label for=""></label>
								<button type="button" name="btn_consultar_horario" id="btn_consultar_horario" class="btn btn-primary btn-lg btn-block">Consultar</button>
							</div>
	        			</div>			

                	</form>
                </div>
            </div>    	
    	</div>	
    </div>

    <div id="div-horario" class="row" style="display:none;">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">

                	<div class="row">		
				    	<div class="col-md-12">
				    		<div class="panel panel-default">
				    			<div class="panel-heading"><i class='fa fa-calendar'></i>&nbsp;Horario De Clases</div>
				    				<div class="panel-body">

										<div class="table-responsive">
											<table border='1' id="lista_horarios" class="table table-bordered table-condensed table-striped">
												<thead>
													<tr>
														<th width="30">Hora</th>
														<th width="85">Lunes</th>
														<th width="85">Martes</th>
														<th width="85">Miercoles</th>
														<th width="85">Jueves</th>
														<th width="85">Viernes</th>
														<th width="85">Sabado</th>
														<th width="85">Domingo</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>2</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>3</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>4</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>5</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>6</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>7</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>8</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>9</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>
													<tr>
														<td>10</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
													</tr>	
												</tbody>
												<tfoot>
													<tr>
														<td colspan='8'></td>
													</tr>
												</tfoot>
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

</div>