	<style type="text/css">
	    
	    label.error{color:red;}
	</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pensum_adicionar.js" defer></script>

<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-sitemap'></i>&nbsp;ADICIONAR ASIGNATURAS A UN PENSUM</h1>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
                <div class="panel-body">
                	<form role="form" action="<?php echo base_url(); ?>pensum_controller/adicionar" name="" method="post" id="form_adicionar">

                		<div class="col-md-12">
				    		<div class="panel panel-default">
				                <div class="panel-body">
									<div class="col-md-3">
										<div class="form-group">
											<label for="id_grado">GRADO</label>
											<div id="grado1">
												<select class="form-control" id="id_grado" name="id_grado">
																    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="id_asignatura">ASIGNATURA</label>
											<div id="asignatura1">
												<select class="form-control" id="id_asignatura" name="id_asignatura">
																    
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label for="intensidad_horaria">HORAS</label>
											<select class="form-control" id="intensidad_horaria" name="intensidad_horaria">
												<option value=""></option>
												<option value="0">0</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="ano_lectivo">AÑO LECTIVO</label>
											<div id="ano_lectivo1">
												<select class="form-control" id="ano_lectivo" name="ano_lectivo">
																    
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>			

						<div class="col-md-offset-9 col-md-3">
	        				<div class="form-group">
								<button type="submit" name="btn_adicionar" id="btn_adicionar" class="btn btn-primary btn-lg btn-block">Adicionar</button>
							</div>
	        			</div>

                	</form>
                </div>
            </div>    	
    	</div>	
    </div>    

</div>    