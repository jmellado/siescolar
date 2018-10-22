	<style type="text/css">
	    
	    label.error{color:red;}

        #modal_agregar_profesor .modal-body
        {
            height:440px;
            overflow-y:auto;
        }
        #modal_actualizar_profesor .modal-body
        {
            height:440px;
            overflow-y:auto;
        }

        .panel-margen{
            margin-bottom: 0px;
        }
	</style>


<div class="container-fluid">

	<div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><i class='fa fa-user'></i>&nbsp;GESTIÓN DE PROFESORES</h1>
      </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
            <div class="form-group">
    		  <button type="submit" name="btn_agregar_profesor" id="btn_agregar_profesor" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Profesor</button>
            </div>
    	</div>

	    <div class="col-lg-offset-2 col-lg-3">
		    <div class="form-group">
		    	<div class="input-group">
			        <input type="text" class="form-control" id="buscar_profesor" name="buscar_profesor"
			                 placeholder="Buscar..">
			      	<span class="input-group-btn">
				        <button type="submit" name="btn_buscar_profesor" id="btn_buscar_profesor" class="btn btn-primary">
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
    			<div class="box-header with-border"><div class="box-title"><i class='fa fa-list'></i>&nbsp;Lista De Profesores</div></div>
    				<div class="box-body">

    					<div class="form-group">
						  <label for="cantidad_profesor">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_profesor" name="cantidad_profesor" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_profesores" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-newspaper-o'></i>&nbsp;Identificación</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Nombres</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;1° Apellido</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;2° Apellido</th>
									<th><i class='fa fa-intersex'></i>&nbsp;Sexo</th>
									<th><i class='fa fa-calendar-check-o'></i>&nbsp;Fecha Nacimiento</th>
									<th><i class='fa fa-phone-square'></i>&nbsp;Telefono</th>
									<th><i class='fa fa-envelope'></i>&nbsp;Correo</th>
									<th><i class='fa fa-map'></i>&nbsp;Dirección</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
                            <tfoot>
                                <tr>
                                    <td colspan='12'></td>
                                </tr>
                            </tfoot>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_profesor">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>



</div>

<!-- Modal  agregar nuev profesor -->
<div id="modal_agregar_profesor" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR PROFESORES</h4>
        </div>

        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>profesores_controller/insertar" name="" method="post" id="form_profesores">
            <div class="modal-body">
            
                <div class="nav-tabs-custom panel-margen">

                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#tab_1" data-toggle="tab"><i class='fa fa-newspaper-o'></i>&nbsp;Datos Personales</a></li>
                      <li><a href="#tab_2" data-toggle="tab"><i class='fa fa-location-arrow'></i>&nbsp;Datos De Contacto</a></li>
                      <li><a href="#tab_3" data-toggle="tab"><i class='fa fa-graduation-cap'></i>&nbsp;Datos Académicos</a></li>
                      <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>

                    <!--CONTENIDO DE LOS TABS-->
                    <div class="tab-content">

                        <div class="tab-pane active" id="tab_1">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-body">

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="identificacion">IDENTIFICACIÓN</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Identificación">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="tipo_id">TIPO DE IDENTIFICACIÓN</label>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="tipo_id" name="tipo_id">
                                                        <option value="rc">RC</option>
                                                        <option value="ti">TI</option>
                                                        <option value="cc">CC</option>
                                                        <option value="ce">CE</option>
                                                    </select>
                                                </div>      
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="fecha_expedicion">FECHA DE EXPEDICIÓN</label>
                                                <div class="col-md-7">
                                                    <input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion">
                                                </div>  
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="pais_expedicion">PAIS DE EXPEDICIÓN</label>
                                                <div class="col-md-7">
                                                    <div id="pais_expedicionP1">
                                                        <select class="form-control" id="pais_expedicionP" name="pais_expedicion">
                                    
                                                        </select>
                                                    </div>
                                                </div>      
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="departamento_expedicion">DPTO. DE EXPEDICIÓN</label>
                                                <div class="col-md-7">
                                                    <div id="departamento_expedicionP1">
                                                        <select class="form-control" id="departamento_expedicionP" name="departamento_expedicion">
                                    
                                                        </select>
                                                    </div>
                                                </div>      
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="municipio_expedicion">MUNICIPIO DE EXPEDICIÓN</label>
                                                <div class="col-md-7">
                                                    <div id="municipio_expedicionP1">
                                                        <select class="form-control" id="municipio_expedicionP" name="municipio_expedicion">
                                                        
                                                        </select>
                                                    </div>
                                                </div>  
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-body">

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="nombres">NOMBRES</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" id="nombres" name="nombres"
                                                   placeholder="Nombres">
                                                </div>   
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="apellido1">1° APELLIDO</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" id="apellido1" name="apellido1"
                                                   placeholder="Primer apellido">
                                                </div>   
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="apellido2">2° APELLIDO</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" id="apellido2" name="apellido2"
                                                   placeholder="Segundo apellido">
                                                </div>   
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="sexo">SEXO</label>
                                                <div class="col-md-5">
                                                     <select class="form-control" id="sexo" name="sexo">
                                                        <option value="m">Masculino</option>
                                                        <option value="f">Femenino</option>
                                                     </select>
                                                </div>       
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
                                                <div class="col-md-7">
                                                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                                                </div>  
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="pais_nacimiento">PAIS DE NACIMIENTO</label>
                                                <div class="col-md-7">
                                                    <div id="pais_nacimientoP1">
                                                        <select class="form-control" id="pais_nacimientoP" name="pais_nacimiento">
                                    
                                                        </select>
                                                    </div>
                                                </div>      
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="departamento_nacimiento">DPTO. DE NACIMIENTO</label>
                                                <div class="col-md-7">
                                                    <div id="departamento_nacimientoP1">
                                                        <select class="form-control" id="departamento_nacimientoP" name="departamento_nacimiento">
                                    
                                                        </select>
                                                    </div>
                                                </div>      
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="municipio_nacimiento">MUNICIPIO DE NACIMIENTO</label>
                                                <div class="col-md-7">
                                                    <div id="municipio_nacimientoP1">
                                                        <select class="form-control" id="municipio_nacimientoP" name="municipio_nacimiento">
                                                        
                                                        </select>
                                                    </div>
                                                </div>  
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>        

                        </div>

                        <div class="tab-pane" id="tab_2">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-body">

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="telefono">TELÉFONO</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" id="telefono" name="telefono"
                                                   placeholder="Teléfono">
                                                </div>   
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="correo">CORREO</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" id="correo" name="correo"
                                                   placeholder="Correo">
                                                </div>   
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="direccion">DIRECCIÓN</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" id="direccion" name="direccion"
                                                   placeholder="Dirección">
                                                </div>   
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="barrio">BARRIO</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" id="barrio" name="barrio"
                                                   placeholder="Barrio">
                                                </div>   
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-body">

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="pais_residencia">PAIS DE RESIDENCIA</label>
                                                <div class="col-md-7">
                                                    <div id="pais_residencia1">
                                                        <select class="form-control" id="pais_residenciaP" name="pais_residencia">
                                    
                                                        </select>
                                                    </div>
                                                </div>      
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="departamento_residencia">DPTO. DE RESIDENCIA</label>
                                                <div class="col-md-7">
                                                    <div id="departamento_residenciaP1">
                                                        <select class="form-control" id="departamento_residenciaP" name="departamento_residencia">
                                    
                                                        </select>
                                                    </div>
                                                </div>      
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="municipio_residencia">MUNICIPIO DE RESIDENCIA</label>
                                                <div class="col-md-7">
                                                    <div id="municipio_residenciaP1">
                                                        <select class="form-control" id="municipio_residenciaP" name="municipio_residencia">
                                                        
                                                        </select>
                                                    </div>
                                                </div>  
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="estrato">ESTRATO</label>
                                                <div class="col-md-5">
                                                    <select class="form-control" id="estrato" name="estrato">
                                                        <option value=""></option>
                                                        <option value="1">Uno</option>
                                                        <option value="2">Dos</option>
                                                        <option value="3">Tres</option>
                                                        <option value="4">Cuatro</option>
                                                        <option value="5">Cinco</option>
                                                        <option value="6">Seis</option>
                                                        <option value="7">Siete</option>
                                                        <option value="0">No Estratificado</option>
                                                     </select>
                                                </div>       
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane" id="tab_3">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-body">

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="titulo">TÍTULO</label>
                                                <div class="col-md-7">
                                                    <!--<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo">-->
                                                    <textarea class="form-control" name="titulo" id="titulo" cols="50" rows="3" placeholder="Título" style="resize:none"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="escalafon">ESCALAFON</label>
                                                <div class="col-md-3">
                                                    <select class="form-control" id="escalafon" name="escalafon">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="fecha_vinculacion">FECHA DE VINCULACIÓN</label>
                                                <div class="col-md-7">
                                                    <input type="date" class="form-control" id="fecha_vinculacion" name="fecha_vinculacion">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="tipo_vinculacion">TIPO DE VINCULACIÓN</label>
                                                <div class="col-md-7">
                                                    <select class="form-control" id="tipo_vinculacion" name="tipo_vinculacion">
                                                        <option value=""></option>
                                                        <option value="En propiedad">En propiedad</option>
                                                        <option value="En periodo de prueba">En periodo de prueba</option>
                                                        <option value="En provisionalidad">En provisionalidad</option>
                                                        <option value="Encargado">Encargado</option>
                                                        <option value="Transitorio">Transitorio</option>
                                                        <option value="Contrato">Contrato</option>
                                                        <option value="Obra o labor">Obra o labor</option>
                                                        <option value="Prestacion de servicios">Prestacion de servicios</option>
                                                        <option value="Aprendizaje">Aprendizaje</option>
                                                        <option value="Otro">Otro</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-body">

                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="decreto">DECRETO DE NOMBRAMIENTO</label>
                                                <div class="col-md-7">
                                                    <textarea class="form-control" name="decreto" id="decreto" cols="50" rows="3" placeholder="Decreto De Nombramiento.." style="resize:none"></textarea>
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
            <div class="modal-footer">
                <div class="col-md-offset-4 col-md-4"> 
                    <button type="submit" name="btn_registrar_profesor" id="btn_registrar_profesor" class="btn btn-primary btn-lg btn-block">Registrar</button>
                </div>
            </div>
        </form>
    </div>

  </div>
</div>

<!-- Modal  actualizar profesor -->
<div id="modal_actualizar_profesor" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR PROFESORES</h4>
      </div>
      <div class="modal-body">
        

        <form class="form-horizontal" role="form" id="form_profesores_actualizar">

            <div class="nav-tabs-custom panel-margen">

                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_11" data-toggle="tab"><i class='fa fa-newspaper-o'></i>&nbsp;Datos Personales</a></li>
                  <li><a href="#tab_22" data-toggle="tab"><i class='fa fa-location-arrow'></i>&nbsp;Datos De Contacto</a></li>
                  <li><a href="#tab_33" data-toggle="tab"><i class='fa fa-graduation-cap'></i>&nbsp;Datos Académicos</a></li>
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>

                <!--CONTENIDO DE LOS TABS-->
                <div class="tab-content">

                    <div class="tab-pane active" id="tab_11">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <input type="hidden" class="form-control" id="id_personasele" name="id_persona">

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="identificacion">IDENTIFICACIÓN</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" id="identificacionsele" name="identificacion" placeholder="Identificación">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="tipo_id">TIPO DE IDENTIFICACIÓN</label>
                                            <div class="col-md-4">
                                                <select class="form-control" id="tipo_idsele" name="tipo_id">
                                                    <option value="rc">RC</option>
                                                    <option value="ti">TI</option>
                                                    <option value="cc">CC</option>
                                                    <option value="ce">CE</option>
                                                </select>
                                            </div>      
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="fecha_expedicion">FECHA DE EXPEDICIÓN</label>
                                            <div class="col-md-7">
                                                <input type="date" class="form-control" id="fecha_expedicionsele" name="fecha_expedicion">
                                            </div>  
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="pais_expedicion">PAIS DE EXPEDICIÓN</label>
                                            <div class="col-md-7">
                                                <div id="pais_expedicionP1">
                                                    <select class="form-control" id="pais_expedicionseleP" name="pais_expedicion">
                                
                                                    </select>
                                                </div>
                                            </div>  
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="departamento_expedicion">DPTO. DE EXPEDICIÓN</label>
                                            <div class="col-md-7">
                                                <div id="departamento_expedicionP1">
                                                    <select class="form-control" id="departamento_expedicionseleP" name="departamento_expedicion">
                                
                                                    </select>
                                                </div>
                                            </div>  
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="municipio_expedicion">MUNICIPIO DE EXPEDICIÓN</label>
                                            <div class="col-md-7">
                                                <div id="municipio_expedicionP1">
                                                    <select class="form-control" id="municipio_expedicionseleP" name="municipio_expedicion">
                                                    
                                                    </select>
                                                </div>
                                            </div>  
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="nombres">NOMBRES</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" id="nombressele" name="nombres"
                                               placeholder="Nombres">
                                            </div>   
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="apellido1">1° APELLIDO</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" id="apellido1sele" name="apellido1"
                                               placeholder="Primer apellido">
                                            </div>   
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="apellido2">2° APELLIDO</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" id="apellido2sele" name="apellido2"
                                               placeholder="Segundo apellido">
                                            </div>   
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="sexo">SEXO</label>
                                            <div class="col-md-5">
                                                 <select class="form-control" id="sexosele" name="sexo">
                                                    <option value="m">Masculino</option>
                                                    <option value="f">Femenino</option>
                                                 </select>
                                            </div>       
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
                                            <div class="col-md-7">
                                                <input type="date" class="form-control" id="fecha_nacimientosele" name="fecha_nacimiento">
                                            </div>  
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="pais_nacimiento">PAIS DE NACIMIENTO</label>
                                            <div class="col-md-7">
                                                <div id="pais_nacimientoP1">
                                                    <select class="form-control" id="pais_nacimientoseleP" name="pais_nacimiento">
                                
                                                    </select>
                                                </div>
                                            </div>      
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="departamento_nacimiento">DPTO. DE NACIMIENTO</label>
                                            <div class="col-md-7">
                                                <div id="departamento_nacimientoP1">
                                                    <select class="form-control" id="departamento_nacimientoseleP" name="departamento_nacimiento">
                                
                                                    </select>
                                                </div>
                                            </div>      
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="municipio_nacimiento">MUNICIPIO DE NACIMIENTO</label>
                                            <div class="col-md-7">
                                                <div id="municipio_nacimientoP1">
                                                    <select class="form-control" id="municipio_nacimientoseleP" name="municipio_nacimiento">
                                                    
                                                    </select>
                                                </div>
                                            </div>      
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>        

                    </div>

                    <div class="tab-pane" id="tab_22">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="telefono">TELÉFONO</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" id="telefonosele" name="telefono"
                                               placeholder="Teléfono">
                                            </div>   
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="correo">CORREO</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" id="correosele" name="correo"
                                               placeholder="Correo">
                                            </div>   
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="direccion">DIRECCIÓN</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" id="direccionsele" name="direccion"
                                               placeholder="Dirección">
                                            </div>   
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="barrio">BARRIO</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" id="barriosele" name="barrio"
                                               placeholder="Barrio">
                                            </div>   
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="pais_residencia">PAIS DE RESIDENCIA</label>
                                            <div class="col-md-7">
                                                <div id="pais_residenciaP1">
                                                    <select class="form-control" id="pais_residenciaseleP" name="pais_residencia">
                                
                                                    </select>
                                                </div>
                                            </div>      
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="departamento_residencia">DPTO. DE RESIDENCIA</label>
                                            <div class="col-md-7">
                                                <div id="departamento_residenciaP1">
                                                    <select class="form-control" id="departamento_residenciaseleP" name="departamento_residencia">
                                
                                                    </select>
                                                </div>
                                            </div>      
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="municipio_residencia">MUNICIPIO DE RESIDENCIA</label>
                                            <div class="col-md-7">
                                                <div id="municipio_residenciaP1">
                                                    <select class="form-control" id="municipio_residenciaseleP" name="municipio_residencia">
                                                    
                                                    </select>
                                                </div>
                                            </div>      
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="estrato">ESTRATO</label>
                                            <div class="col-md-5">
                                                <select class="form-control" id="estratosele" name="estrato">
                                                    <option value=""></option>
                                                    <option value="1">Uno</option>
                                                    <option value="2">Dos</option>
                                                    <option value="3">Tres</option>
                                                    <option value="4">Cuatro</option>
                                                    <option value="5">Cinco</option>
                                                    <option value="6">Seis</option>
                                                    <option value="7">Siete</option>
                                                    <option value="0">No Estratificado</option>
                                                 </select>
                                            </div>       
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane" id="tab_33">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="titulo">TÍTULO</label>
                                            <div class="col-md-7">
                                                <textarea class="form-control" name="titulo" id="titulosele" cols="50" rows="3" placeholder="Título" style="resize:none"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="escalafon">ESCALAFON</label>
                                            <div class="col-md-3">
                                                <select class="form-control" id="escalafonsele" name="escalafon">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="fecha_vinculacion">FECHA DE VINCULACIÓN</label>
                                            <div class="col-md-7">
                                                <input type="date" class="form-control" id="fecha_vinculacionsele" name="fecha_vinculacion">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="tipo_vinculacion">TIPO DE VINCULACIÓN</label>
                                            <div class="col-md-7">
                                                <select class="form-control" id="tipo_vinculacionsele" name="tipo_vinculacion">
                                                    <option value=""></option>
                                                    <option value="En propiedad">En propiedad</option>
                                                    <option value="En periodo de prueba">En periodo de prueba</option>
                                                    <option value="En provisionalidad">En provisionalidad</option>
                                                    <option value="Encargado">Encargado</option>
                                                    <option value="Transitorio">Transitorio</option>
                                                    <option value="Contrato">Contrato</option>
                                                    <option value="Obra o labor">Obra o labor</option>
                                                    <option value="Prestacion de servicios">Prestacion de servicios</option>
                                                    <option value="Aprendizaje">Aprendizaje</option>
                                                    <option value="Otro">Otro</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="control-label col-md-4" for="decreto">DECRETO DE NOMBRAMIENTO</label>
                                            <div class="col-md-7">
                                                <textarea class="form-control" name="decreto" id="decretosele" cols="50" rows="3" placeholder="Decreto De Nombramiento.." style="resize:none"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>            
                        </div>

                    </div>

                </div>

            </div>
        	
	
        </form>

      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <div class="col-md-offset-4 col-md-4">
            <button type="submit" name="btn_actualizar_profesor" id="btn_actualizar_profesor" class="btn btn-primary btn-lg btn-block">Actualizar</button>
        </div>
      </div>
    </div>

  </div>
</div>