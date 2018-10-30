	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-clipboard'></i>&nbsp;DATOS DE LA INSTITUCIÓN EDUCATIVA</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-md-8">

    		<div class="panel panel-default">
                <!--<div class="panel-heading"></div>-->
                <div class="panel-body">


                	<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>configuraciones_controller/insertar" name="" method="post" id="form_datos_institucion" enctype="multipart/form-data">


			        	<div class="form-group">
			        		<label class="control-label col-sm-3" for="nombre_institucion">NOMBRE INSTITUCIÓN</label>
			        		<div class="col-sm-7">
								<input type="text" class="form-control" id="nombre_institucion" name="nombre_institucion" placeholder="Nombre">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="niveles_educacion">NIVELES DE EDUCACIÓN</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="niveles_educacion" name="niveles_educacion" placeholder="Niveles">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="resolucion">RESOLUCIÓN</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="resolucion" name="resolucion" placeholder="Resolucion">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="dane">DANE</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="dane" name="dane" placeholder="Dane">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="nit">NIT</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="nit" name="nit" placeholder="N° Nit">
							</div>
						</div>

						<div class="form-group">
						  	<label class="control-label col-sm-3" for="ultimo_grado">ÚLTIMO GRADO OFERTADO</label>
						  	<div class="col-sm-7">
							  	<select class="form-control" id="ultimo_grado" name="ultimo_grado">
							  		<option value=""></option>
								    <option value="Prejardín">Prejardín</option>
									<option value="Jardín">Jardín</option>
									<option value="Transición">Transición</option>
									<option value="Primero">Primero</option>
									<option value="Segundo">Segundo</option>
									<option value="Tercero">Tercero</option>
									<option value="Cuarto">Cuarto</option>
									<option value="Quinto">Quinto</option>
									<option value="Sexto">Sexto</option>
									<option value="Séptimo">Séptimo</option>
									<option value="Octavo">Octavo</option>
									<option value="Noveno">Noveno</option>
									<option value="Décimo">Décimo</option>
									<option value="Undécimo">Undécimo</option>
							  	</select>
							</div>  	
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="telefono">TELEFONO</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="telefono_i" name="telefono" placeholder="Telefono">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="email">EMAIL</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="email_i" name="email" placeholder="Email">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="direccion">DIRECCIÓN</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="direccion_i" name="direccion" placeholder="Dirección">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="barrio">BARRIO</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="barrio_i" name="barrio" placeholder="Barrio">
							</div>
						</div>

						<div class="form-group">
		  					<label class="control-label col-sm-3" for="pais_ubicacion">PAIS DE UBICACIÓN</label>
		  					<div class="col-sm-7">
			  					<div id="pais_ubicacion1">
			  						<select class="form-control" id="pais_ubicacion" name="pais_ubicacion">
			    
			  						</select>
			  					</div>
			  				</div>		
						</div>

						<div class="form-group">
		  					<label class="control-label col-sm-3" for="departamento_ubicacion">DPTO. DE UBICACIÓN</label>
		  					<div class="col-sm-7">
			  					<div id="departamento_ubicacion1">
			  						<select class="form-control" id="departamento_ubicacion" name="departamento_ubicacion">
			    
			  						</select>
			  					</div>
			  				</div>		
						</div>

						<div class="form-group">
						 	<label class="control-label col-sm-3" for="municipio_ubicacion">MUNICIPIO DE UBICACIÓN</label>
						 	<div class="col-sm-7">
							 	<div id="municipio_ubicacion1">
									<select class="form-control" id="municipio_ubicacion" name="municipio_ubicacion">
								    
									</select>
								</div>
							</div>	
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="corregimiento_ubicacion">CORREGIMIENTO DE UBICACIÓN</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="corregimiento_ubicacion" name="corregimiento_ubicacion" placeholder="Corregimiento De Ubicación Si Aplica">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="responsable">RESPONSABLE</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="responsable" name="responsable" placeholder="Nombre Del Responsable">
							</div>
						</div>

						<div class="form-group">
						  	<label class="control-label col-sm-3" for="cargo_responsable">CARGO DEL RESPONSABLE</label>
						  	<div class="col-sm-7">
							  	<select class="form-control" id="cargo_responsable" name="cargo_responsable">
							  		<option value=""></option>
								    <option value="Rector">Rector</option>
									<option value="Director">Director</option>
									<option value="Director General">Director General</option>
									<option value="Coordinador">Coordinador</option>
									<option value="Coordinador Académico">Coordinador Académico</option>
									<option value="Coordinador Disciplinario">Coordinador Disciplinario</option>
									<option value="Psicorientador">Psicorientador</option>
									<option value="Docente">Docente</option>
							  	</select>
							</div>  	
						</div>

						<div class="form-group">
			        		<div class="col-sm-offset-3 col-sm-7"> 
								<button type="submit" name="btn_registrar_datos" id="btn_registrar_datos" class="btn btn-primary btn-lg btn-block">Registrar</button>
							</div>
						</div>
			        </form>


                </div>

            </div>

        </div>

       <div class="col-md-4">

	       	<div class="panel panel-default">
            	<!--<div class="panel-heading"></div>-->
                	<div class="panel-body">

                		<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>configuraciones_controller/insertar_imagen" name="" method="post" id="form_escudo_institucion" enctype="multipart/form-data">

                			<style type="text/css">label.error{color:red; font-size: 10px;}</style>

                			<div class="form-group">
	                          <label for="field-1" class="col-sm-3 control-label">ESCUDO</label>
	                          
	                            <div class="col-sm-9">
	                                <div class="fileinput fileinput-new" data-provides="fileinput">
	                                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
	                                      <img src="<?php echo base_url();?>uploads/imagenes/colegio/escudo.png" alt="...">
	                                    </div>
	                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
	                                    <div>
	                                      <span class="btn btn-white btn-file">
	                                          <span class="fileinput-new">Select image</span>
	                                          <span class="fileinput-exists">Change</span>
	                                          <input type="file" name="escudo" accept="image/*" value="jeiner">
	                                      </span>
	                                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="form-group">
		                      <div class="col-sm-offset-3 col-sm-9">
		                          <button type="submit" name="btn_registrar_escudo" id="btn_registrar_escudo" class="btn btn-info">Cargar</button>
		                      </div>
		                    </div>

                		</form>

	                </div>
	        </div>        
       </div>
        

    </div>        

</div>