<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuraciones_controller extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('configuraciones_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
	}


	public function datos_institucion()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'configuraciones/datos_institucion_vista');
	}


	public function periodos_evaluacion()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'configuraciones/periodos_evaluacion_vista');
	}


	public function insertar(){

		$this->form_validation->set_rules('nombre_institucion', 'Nombre Institución', 'required|alpha_spaces');
        $this->form_validation->set_rules('niveles_educacion', 'Niveles Educación', 'required|alpha_spaces');
        $this->form_validation->set_rules('resolucion', 'Resolucion', 'required|alpha_spaces');
        $this->form_validation->set_rules('dane', 'Dane', 'required|alpha_spaces');
        $this->form_validation->set_rules('nit', 'Nit', 'required|alpha_spaces');
        $this->form_validation->set_rules('ultimo_grado', 'Ultimo Grado', 'required');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|alpha_spaces');
        $this->form_validation->set_rules('direccion', 'Direccion', 'required|alpha_spaces');
        $this->form_validation->set_rules('barrio', 'Barrio', 'required|alpha_spaces');
        $this->form_validation->set_rules('pais_ubicacion', 'Pais Ubicacion', 'required');
        $this->form_validation->set_rules('departamento_ubicacion', 'Departamento Ubicacion', 'required');
        $this->form_validation->set_rules('municipio_ubicacion', 'Municipio Ubicacion', 'required');
        $this->form_validation->set_rules('responsable', 'Responsable', 'required|alpha_spaces');
        $this->form_validation->set_rules('cargo_responsable', 'Cargo Responsable', 'required');
        
        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{


			$nombre_institucion = mb_strtoupper(trim($this->input->post('nombre_institucion')));
			$niveles_educacion = mb_convert_case(mb_strtolower(trim($this->input->post('niveles_educacion'))), MB_CASE_TITLE);
			$resolucion = mb_convert_case(mb_strtolower(trim($this->input->post('resolucion'))), MB_CASE_TITLE);
			$dane = mb_convert_case(mb_strtolower(trim($this->input->post('dane'))), MB_CASE_TITLE);
			$nit = mb_convert_case(mb_strtolower(trim($this->input->post('nit'))), MB_CASE_TITLE);
			$ultimo_grado = $this->input->post('ultimo_grado');
			$telefono = trim($this->input->post('telefono'));
			$email = trim($this->input->post('email'));
			$direccion = mb_convert_case(mb_strtolower(trim($this->input->post('direccion'))), MB_CASE_TITLE);
			$barrio = mb_convert_case(mb_strtolower(trim($this->input->post('barrio'))), MB_CASE_TITLE);
			$pais_ubicacion = $this->input->post('pais_ubicacion');
			$departamento_ubicacion = $this->input->post('departamento_ubicacion');
			$municipio_ubicacion = $this->input->post('municipio_ubicacion');
			$corregimiento_ubicacion = mb_convert_case(mb_strtolower(trim($this->input->post('corregimiento_ubicacion'))), MB_CASE_TITLE);
			$responsable = mb_convert_case(mb_strtolower(trim($this->input->post('responsable'))), MB_CASE_TITLE);
			$cargo_responsable = mb_convert_case($this->input->post('cargo_responsable'), MB_CASE_TITLE);

			//array para insertar en la tabla datos_institucion----------
        	$institucion = array(
        	'nombre_institucion' =>$nombre_institucion,	
			'niveles_educacion' =>$niveles_educacion,
			'resolucion' =>$resolucion,
			'dane' =>$dane,
			'nit' =>$nit,
			'ultimo_grado' =>$ultimo_grado,
			'telefono' =>$telefono,
			'email' =>$email,
			'direccion' =>$direccion,
			'barrio' =>$barrio,
			'pais_ubicacion' =>$pais_ubicacion,
			'departamento_ubicacion' =>$departamento_ubicacion,
			'municipio_ubicacion' =>$municipio_ubicacion,
			'corregimiento_ubicacion' =>$corregimiento_ubicacion,
			'responsable' =>$responsable,
			'cargo_responsable' =>$cargo_responsable);

			if ($this->configuraciones_model->validar_existencia()){

				$respuesta=$this->configuraciones_model->insertar_datos_institucion($institucion);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				$respuesta=$this->configuraciones_model->modificar_datos_institucion($institucion);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}
			}

			

		}

	}


	public function insertar_imagen(){

		//Ruta donde se guardan los ficheros
		//Tipos de ficheros permitidos
		$config = [
			'upload_path' => './uploads/imagenes/colegio',
			'allowed_types' => 'png|jpg',
			'file_name' => 'escudo.png',
			'overwrite' => 'true',
			'max_width' => '1300',
			'max_height' => '1300'
		];

		//Cargamos la librería de subida y le pasamos la configuración
		$this->load->library('upload', $config);

		//si el fchero es subido correctamente
		if ($this->upload->do_upload('escudo')) {

			//Datos del fichero subido
			$data = array('upload_data' => $this->upload->data());

			//array para insertar la imagen en la tabla datos_institucion----------
        	$institucion = array(
			'escudo' =>$data['upload_data']['file_name']);

			if ($this->configuraciones_model->validar_existencia()){

				$respuesta=$this->configuraciones_model->insertar_datos_institucion($institucion);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				$respuesta=$this->configuraciones_model->modificar_datos_institucion($institucion);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}
			}
			
		}
		else{

			echo $this->upload->display_errors();
		}

	}


	public function buscar_datos_institucion(){
 
		
		$consulta = $this->configuraciones_model->buscar_datos_institucion();

		if($consulta==false){
			echo "noexiste";
		}
		else{

			echo json_encode($consulta);	
						
		}
	    
	}


	public function llenarcombo_paises(){

    	$consulta = $this->configuraciones_model->llenar_paises();
    	echo json_encode($consulta);
    }


    public function llenarcombo_departamentos(){

    	$id =$this->input->post('id');
    	$consulta = $this->configuraciones_model->llenar_departamentos($id);
    	echo json_encode($consulta);
    }


    public function llenarcombo_municipios(){

    	$id =$this->input->post('id');
    	$consulta = $this->configuraciones_model->llenar_municipios($id);
    	echo json_encode($consulta);
    }


	//**************************** FUNCIONES PERIODOS DE EVALUACION ****************************************
	public function insertar_periodo(){

        $this->form_validation->set_rules('periodo', 'Periodo', 'required');
        $this->form_validation->set_rules('fecha_inicial', 'Fecha Inicio', 'required');
        $this->form_validation->set_rules('fecha_final', 'Fecha Fin', 'required');
        //$this->form_validation->set_rules('estado_periodo', 'Estado Periodo', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de grados + 1 
        	$ultimo_id = $this->configuraciones_model->obtener_ultimo_idactividad();

        	$nombre_actividad = $this->input->post('periodo');
        	$id_categoria = "1";
        	$descripcion_actividad = "Fechas Para El Ingreso De Calificaciones.";
        	$fecha_inicial = $this->input->post('fecha_inicial');
        	$fecha_final = $this->input->post('fecha_final');
        	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
        	$estado_actividad = "Inactivo";

        	//array para insertar en la tabla cronogramas
        	$actividad = array(
        	'id_actividad' =>$ultimo_id,	
			'nombre_actividad' =>$nombre_actividad,
			'id_categoria' =>$id_categoria,
			'descripcion_actividad' =>$descripcion_actividad,
			'fecha_inicial' =>$fecha_inicial,
			'fecha_final' =>$fecha_final,
			'ano_lectivo' =>$ano_lectivo,
			'estado_actividad' =>$estado_actividad);

			if ($ano_lectivo !=""){

				if ($this->configuraciones_model->validar_existencia_actividad($nombre_actividad,$ano_lectivo)){

					$respuesta=$this->configuraciones_model->insertar_periodo($actividad);

					if($respuesta==true){

						echo "registroguardado";
					}
					else{

						echo "registronoguardado";
					}

				}
				else{

					echo "periodo ya existe";
				}
			}
			else{

				echo "anionoexiste";
			}

        }

	}


	public function mostrarperiodos(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'periodos' => $this->configuraciones_model->buscar_periodo($id,$inicio,$cantidad),

		    'totalregistros' => count($this->configuraciones_model->buscar_periodo($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function modificar_periodo(){

        $this->form_validation->set_rules('fecha_inicial', 'Fecha Inicio', 'required');
        $this->form_validation->set_rules('fecha_final', 'Fecha Fin', 'required');
        //$this->form_validation->set_rules('estado_periodo', 'Estado Periodo', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$id_actividad = $this->input->post('id_periodo');
        	$fecha_inicial = $this->input->post('fecha_inicial');
        	$fecha_final = $this->input->post('fecha_final');
        	//$estado_actividad = $this->input->post('estado_periodo');

        	//array para insertar en la tabla cronogramas
        	$actividad = array(
        	'id_actividad' =>$id_actividad,	
			'fecha_inicial' =>$fecha_inicial,
			'fecha_final' =>$fecha_final);

			
			$respuesta=$this->configuraciones_model->modificar_periodo($id_actividad,$actividad);

			if($respuesta==true){

				echo "Registro Actualizado Satisfactoriamente.";
			}
			else{

				echo "Registro No Actualizado.";
			}

        }

	}


	public function activar_periodo(){

	  	$id_periodo =$this->input->post('id_periodo'); 

        if(is_numeric($id_periodo)){

			if ($this->configuraciones_model->Verificar_PeriodosActivos()) {
			
		        $respuesta=$this->configuraciones_model->activar_periodo($id_periodo);
		        
	          	if($respuesta==true){
	              
	              	echo "periodoactivado";
	          	}else{
	              
	              	echo "periodonoactivado";
	          	}
	        }
	        else{
	        	echo "periodosactivos";
	        }
          
        }else{
          
          	echo "Digite valor numerico para identificar un Periodo.";
        }
    }


    public function cerrar_periodo(){

	  	$id_periodo =$this->input->post('id_periodo'); 

        if(is_numeric($id_periodo)){

			if ($this->configuraciones_model->Verificar_EstadoPeriodo($id_periodo)) {

				if ($this->configuraciones_model->Verificar_Existencia_Estudiantes_Matriculados()) {

					if ($this->configuraciones_model->Verificar_NotasEstudiantesMatriculados($id_periodo)) {

						if ($this->configuraciones_model->Verificar_LogrosEstudiantesMatriculados($id_periodo)) {

					        $respuesta=$this->configuraciones_model->cerrar_periodo($id_periodo);
					        
				          	if($respuesta==true){
				              
				              	echo "periodocerrado";
				          	}else{
				              
				              	echo "periodonocerrado";
				          	}
				        }
				        else{
				        	echo "periodopendiente2";
				        }
			        }
			        else{
			        	echo "periodopendiente";
			        }
			    }
			    else{
			    	echo "nohayestudiantes";
			    }
	        }
	        else{
	        	echo "periodoinactivo";
	        }
          
        }else{
          
          	echo "Digite valor numerico para identificar un Periodo.";
        }
    }


	//**************************** FUNCIONES AÑO LECTIVO ****************************************


	public function anio_lectivo()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'configuraciones/ano_lectivo_vista');
	}


	public function insertar_anolectivo(){

        $this->form_validation->set_rules('anolectivo', 'Año Lectivo', 'required');
        $this->form_validation->set_rules('fecha_inicio', 'Fecha Inicio', 'required');
        $this->form_validation->set_rules('fecha_fin', 'Fecha Fin', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de anolectivo + 1 
        	$ultimo_id = $this->configuraciones_model->obtener_ultimo_idanolectivo();

        	$nombre_ano_lectivo = $this->input->post('anolectivo');
        	$fecha_inicio = $this->input->post('fecha_inicio');
        	$fecha_fin = $this->input->post('fecha_fin');
        	$estado_ano_lectivo = "Activo";
        	$seleccionado = "No";

        	//array para insertar en la tabla anos_lectivos
        	$anolectivo = array(
        	'id_ano_lectivo' =>$ultimo_id,	
			'nombre_ano_lectivo' =>$nombre_ano_lectivo,
			'fecha_inicio' =>$fecha_inicio,
			'fecha_fin' =>$fecha_fin,
			'estado_ano_lectivo' =>$estado_ano_lectivo,
			'seleccionado' =>$seleccionado);

			$anoslectivosActivos = $this->configuraciones_model->anoslectivosActivos();

			if ($anoslectivosActivos == 0) {
				
				if ($this->configuraciones_model->validar_existencia_anolectivo($nombre_ano_lectivo)){

					$respuesta=$this->configuraciones_model->insertar_anolectivo($anolectivo);

					if($respuesta==true){

						echo "registroguardado";

						$resp = $this->configuraciones_model->CrearDesempeños($ultimo_id);

						if($resp == false){
							echo "No Se Pudo Registrar En La Tabla Desempeños.";
						}
					}
					else{

						echo "registronoguardado";
					}

				}
				else{

					echo "anolectivoyaexiste";
				}

			}
			else{
				echo "registrodenegado";
			}

        }

	}


	public function mostraranoslectivos(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'anoslectivos' => $this->configuraciones_model->buscar_anolectivo($id,$inicio,$cantidad),

		    'totalregistros' => count($this->configuraciones_model->buscar_anolectivo($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function modificar_anolectivo(){

        $this->form_validation->set_rules('id_anolectivo', 'Id Año Lectivo', 'required');
        $this->form_validation->set_rules('fecha_inicio', 'Fecha Inicio', 'required');
        $this->form_validation->set_rules('fecha_fin', 'Fecha Fin', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$id_ano_lectivo = $this->input->post('id_anolectivo');
        	$fecha_inicio = $this->input->post('fecha_inicio');
        	$fecha_fin = $this->input->post('fecha_fin');

        	//array para insertar en la tabla anos_lectivos
        	$anolectivo = array(
        	'id_ano_lectivo' =>$id_ano_lectivo,	
			'fecha_inicio' =>$fecha_inicio,
			'fecha_fin' =>$fecha_fin);

			$estado_anolectivo = $this->configuraciones_model->estado_anolectivo($id_ano_lectivo);

			if ($estado_anolectivo == "Activo") {
			
				$respuesta=$this->configuraciones_model->modificar_anolectivo($id_ano_lectivo,$anolectivo);

				if($respuesta==true){

					echo "registroactualizado";
				}
				else{

					echo "registronoactualizado";
				}

			}
			else{
				echo "anolectivocerrado";
			}

        }

	}


	//Esta funcion me permite llenar el combo anolectivo con el ultimo anolectivo +1
	public function llenarcombo_anolectivo(){

    	$consulta = $this->configuraciones_model->llenar_anolectivo();
    	echo json_encode($consulta);
    }


    public function seleccionar_anolectivo(){

	  	$id_anolectivo =$this->input->post('id_anolectivo'); 

        if(is_numeric($id_anolectivo)){

			
	        $respuesta=$this->configuraciones_model->seleccionar_anolectivo($id_anolectivo);
	        
          	if($respuesta==true){
              
              	echo "registroseleccionado";
          	}else{
              
              	echo "registronoseleccionado";
          	}
          
        }else{
          
          	echo "Digite valor numerico para identificar un Ano lectivo";
        }
    }


    public function cerrar_anolectivo(){

	  	$id_anolectivo =$this->input->post('id_anolectivo'); 

        if(is_numeric($id_anolectivo)){

        	if ($this->configuraciones_model->Validar_SituacionAcademica($id_anolectivo)){

		        $respuesta=$this->configuraciones_model->cerrar_anolectivo($id_anolectivo);
		        
	          	if($respuesta==true){
	              
	              	echo "aniocerrado";

	          	}else{
	              
	              	echo "anionocerrado";
	          	}
	        }
	        else{

	        	echo "matriculanodefinida";
	        }
          
        }else{
          
          	echo "Digite valor numerico para identificar un Ano lectivo";
        }
    }



    //**************************** FUNCIONES ESCALA DE DESEMPEÑO ****************************************


    public function escala_desempeno()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'configuraciones/escala_desempeno_vista');
	}


	public function mostrardesempenos(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'desempenos' => $this->configuraciones_model->buscar_desempeno($id,$inicio,$cantidad),

		    'totalregistros' => count($this->configuraciones_model->buscar_desempeno($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function modificar_desempeno(){

		$this->form_validation->set_rules('id_desempeno', 'Id Desempeño', 'required');
        $this->form_validation->set_rules('rango_inicial', 'Minimo', 'required|numeric');
        $this->form_validation->set_rules('rango_final', 'Maximo', 'required|numeric');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$id_desempeno = $this->input->post('id_desempeno');
        	$rango_inicial = $this->input->post('rango_inicial');
        	$rango_final = $this->input->post('rango_final');
        	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

        	//array para actualizar en la tabla desempenos
        	$desempeno = array(	
			'rango_inicial' =>$rango_inicial,
			'rango_final' 	=>$rango_final);

			if($this->configuraciones_model->validar_existencia_notas($ano_lectivo)){

				if($this->configuraciones_model->validar_existencia_notas_actividades($ano_lectivo)){

					$respuesta=$this->configuraciones_model->modificar_desempeno($id_desempeno,$desempeno);

					if($respuesta==true){

						echo "registroactualizado";
					}
					else{

						echo "registronoactualizado";
					}
				}
				else{

					echo "notasactividadesregistradas";
				}
			}
			else{

				echo "notasregistradas";
			}

        }

	}






}