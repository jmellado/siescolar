<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estudiantes_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('estudiantes_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'estudiantes/registrar');
	}

	public function index2()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'estudiantes/consultar');
	}


	public function insertar(){

		$this->form_validation->set_rules('identificacion', 'Identificación', 'required|numeric|max_length[10]');
		$this->form_validation->set_rules('tipo_id', 'Tipo De Identificación', 'required');
		$this->form_validation->set_rules('fecha_expedicion', 'Fecha De Expedicion', 'required');
		$this->form_validation->set_rules('pais_expedicion', 'Pais De Expedicion', 'required');
        $this->form_validation->set_rules('departamento_expedicion', 'Dpto. De Expedicion', 'required');
        $this->form_validation->set_rules('municipio_expedicion', 'Mcpio. De Expedicion', 'required');
        $this->form_validation->set_rules('nombres', 'Nombres', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1', 'Primer Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2', 'Segundo Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('sexo', 'Sexo', 'required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('fecha_nacimiento', 'Fecha De Nacimiento', 'required');
        $this->form_validation->set_rules('pais_nacimiento', 'Pais De Nacimiento', 'required');
        $this->form_validation->set_rules('departamento_nacimiento', 'Dpto. De Nacimiento', 'required');
        $this->form_validation->set_rules('municipio_nacimiento', 'Mcpio. De Nacimiento', 'required');
        $this->form_validation->set_rules('tipo_sangre', 'Tipo De Sangre', 'required');
        $this->form_validation->set_rules('eps', 'Eps', 'required|alpha_spaces');
        $this->form_validation->set_rules('poblacion', 'Poblacion', 'required|alpha_spaces');
        $this->form_validation->set_rules('correo', 'Correo', 'required|alpha_spaces');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('barrio', 'Barrio', 'required|alpha_spaces');
        $this->form_validation->set_rules('pais_residencia', 'Pais De Residencia', 'required');
        $this->form_validation->set_rules('departamento_residencia', 'Dpto. De Residencia', 'required');
        $this->form_validation->set_rules('municipio_residencia', 'Mcpio. De Residencia', 'required');
        $this->form_validation->set_rules('estrato', 'Estrato', 'required');
        //$this->form_validation->set_rules('institucion_procedencia', 'I.E. De Procedencia', 'required|alpha_spaces');
        $this->form_validation->set_rules('discapacidad', 'Discapacidad', 'required|alpha_spaces');
        $this->form_validation->set_rules('grado_cursado', 'Grado Cursado', 'required');
        //$this->form_validation->set_rules('anio', 'Año', 'required|numeric|max_length[4]');
        //Padre
        $this->form_validation->set_rules('identificacion_padre', 'Identificación Del Padre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('nombres_padre', 'Nombres Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1_padre', 'Primer Apellido Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2_padre', 'Segundo Apellido Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono Del Padre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_padre', 'Dirección Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('barrio_padre', 'Barrio Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('ocupacion_padre', 'Ocupacion Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono_trabajo_padre', 'Telefono Trabajo Del Padre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_trabajo_padre', 'Dirección Trabajo Del Padre', 'required|alpha_spaces');

        //Madre
        $this->form_validation->set_rules('identificacion_madre', 'Identificación De la madre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('nombres_madre', 'Nombres De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1_madre', 'Primer Apellido De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2_madre', 'Segundo Apellido De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono De la madre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_madre', 'Dirección De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('barrio_madre', 'Barrio De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('ocupacion_madre', 'Ocupacion De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono_trabajo_madre', 'Telefono Trabajo De la madre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_trabajo_madre', 'Dirección Trabajo De la madre', 'required|alpha_spaces');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();
        }
        else{

        	//obtengo el ultimo id de persona + 1 
        	$ultimo_id = $this->estudiantes_model->obtener_ultimo_id();

        	//obtengo el ultimo id de padres + 1 
        	$ultimo_id_padre = $this->estudiantes_model->obtener_ultimo_id_padres();

        	//obtengo el ultimo id de madres + 1 
        	$ultimo_id_madre = $this->estudiantes_model->obtener_ultimo_id_madres();

        	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
			$fecha_actual = $this->funciones_globales_model->obtener_fecha_actual_corta();

			$identificacion = $this->input->post('identificacion');
			$tipo_id = $this->input->post('tipo_id');
			$fecha_expedicion = $this->input->post('fecha_expedicion');
			$pais_expedicion = $this->input->post('pais_expedicion');
			$departamento_expedicion = $this->input->post('departamento_expedicion');
			$municipio_expedicion = $this->input->post('municipio_expedicion');
			$nombres = mb_convert_case(mb_strtolower(trim($this->input->post('nombres'))), MB_CASE_TITLE);
			$apellido1 = mb_convert_case(mb_strtolower(trim($this->input->post('apellido1'))), MB_CASE_TITLE);
			$apellido2 = mb_convert_case(mb_strtolower(trim($this->input->post('apellido2'))), MB_CASE_TITLE);
			$sexo = $this->input->post('sexo');
			$fecha_nacimiento = $this->input->post('fecha_nacimiento');
			$pais_nacimiento = $this->input->post('pais_nacimiento');
			$departamento_nacimiento = $this->input->post('departamento_nacimiento');
			$municipio_nacimiento = $this->input->post('municipio_nacimiento');
			$tipo_sangre = $this->input->post('tipo_sangre');
			$eps = mb_convert_case(mb_strtolower(trim($this->input->post('eps'))), MB_CASE_TITLE);
			$poblacion = $this->input->post('poblacion');
			$telefono = trim($this->input->post('telefono'));
			$email = trim($this->input->post('correo'));
			$direccion = mb_convert_case(mb_strtolower(trim($this->input->post('direccion'))), MB_CASE_TITLE);
			$barrio = mb_convert_case(mb_strtolower(trim($this->input->post('barrio'))), MB_CASE_TITLE);
			$pais_residencia = $this->input->post('pais_residencia');
			$departamento_residencia = $this->input->post('departamento_residencia');
			$municipio_residencia = $this->input->post('municipio_residencia');
			$estrato = $this->input->post('estrato');

			$discapacidad = $this->input->post('discapacidad');
			$institucion_procedencia = mb_convert_case(mb_strtolower(trim($this->input->post('institucion_procedencia'))), MB_CASE_TITLE);
			$grado_cursado = $this->input->post('grado_cursado');
			$anio = trim($this->input->post('anio'));

			$id_padre = $ultimo_id_padre;
			$identificacion_p = $this->input->post('identificacion_padre');
			$nombres_p = mb_convert_case(mb_strtolower(trim($this->input->post('nombres_padre'))), MB_CASE_TITLE);
			$apellido1_p = mb_convert_case(mb_strtolower(trim($this->input->post('apellido1_padre'))), MB_CASE_TITLE);
			$apellido2_p = mb_convert_case(mb_strtolower(trim($this->input->post('apellido2_padre'))), MB_CASE_TITLE);
			$telefono_p = trim($this->input->post('telefono_padre'));
			$direccion_p = mb_convert_case(mb_strtolower(trim($this->input->post('direccion_padre'))), MB_CASE_TITLE);
			$barrio_p = mb_convert_case(mb_strtolower(trim($this->input->post('barrio_padre'))), MB_CASE_TITLE);
			$ocupacion_p = mb_convert_case(mb_strtolower(trim($this->input->post('ocupacion_padre'))), MB_CASE_TITLE);
			$telefono_trabajo_p = trim($this->input->post('telefono_trabajo_padre'));
			$direccion_trabajo_p = mb_convert_case(mb_strtolower(trim($this->input->post('direccion_trabajo_padre'))), MB_CASE_TITLE);

			$id_madre = $ultimo_id_madre;
			$identificacion_m = $this->input->post('identificacion_madre');
			$nombres_m = mb_convert_case(mb_strtolower(trim($this->input->post('nombres_madre'))), MB_CASE_TITLE);
			$apellido1_m = mb_convert_case(mb_strtolower(trim($this->input->post('apellido1_madre'))), MB_CASE_TITLE);
			$apellido2_m = mb_convert_case(mb_strtolower(trim($this->input->post('apellido2_madre'))), MB_CASE_TITLE);
			$telefono_m = trim($this->input->post('telefono_madre'));
			$direccion_m = mb_convert_case(mb_strtolower(trim($this->input->post('direccion_madre'))), MB_CASE_TITLE);
			$barrio_m = mb_convert_case(mb_strtolower(trim($this->input->post('barrio_madre'))), MB_CASE_TITLE);
			$ocupacion_m = mb_convert_case(mb_strtolower(trim($this->input->post('ocupacion_madre'))), MB_CASE_TITLE);
			$telefono_trabajo_m = trim($this->input->post('telefono_trabajo_madre'));
			$direccion_trabajo_m = mb_convert_case(mb_strtolower(trim($this->input->post('direccion_trabajo_madre'))), MB_CASE_TITLE);

        	 //array para insertar en la tabla personas
        	$estudiante = array(
        	'id_persona'       =>$ultimo_id,	
			'identificacion'   =>$identificacion,
			'tipo_id'          =>$tipo_id,
			'fecha_expedicion' =>$fecha_expedicion,
			'pais_expedicion'  =>$pais_expedicion,
			'departamento_expedicion' =>$departamento_expedicion,
			'municipio_expedicion'    =>$municipio_expedicion,
			'nombres'          =>$nombres,
			'apellido1'        =>$apellido1,
			'apellido2'        =>$apellido2,
			'sexo'             =>$sexo,
			'fecha_nacimiento' =>$fecha_nacimiento,
			'pais_nacimiento'  =>$pais_nacimiento,
			'departamento_nacimiento' =>$departamento_nacimiento,
			'municipio_nacimiento'    =>$municipio_nacimiento,
			'tipo_sangre'      =>$tipo_sangre,
			'eps'              =>$eps,
			'poblacion'        =>$poblacion,
			'telefono'         =>$telefono,
			'email'            =>$email,
			'direccion'        =>$direccion,
			'barrio'           =>$barrio,
			'pais_residencia'  =>$pais_residencia,
			'departamento_residencia' =>$departamento_residencia,
			'municipio_residencia'    =>$municipio_residencia,
			'estrato'          =>$estrato);

        	//array para insertar en la tabla estudiantes
			$estudiante2 = array(
			'id_persona'    =>$ultimo_id,
			'discapacidad'  =>$discapacidad,
			'institucion_procedencia' =>$institucion_procedencia,
			'grado_cursado' =>$grado_cursado,
			'anio'          =>$anio,
			'fecha_estado'  =>$fecha_actual);

			//aqui creamos el username de un estudiante
			$user = mb_strtolower(substr($nombres, 0, 2));
			$name = mb_strtolower($apellido1);
			$username = $user.$name.$ultimo_id;

			//array para insertar en la tabla usuarios
			$usuario = array(
			'id_usuario' =>$ultimo_id,
			'id_persona' =>$ultimo_id,
			'id_rol'     =>2,
			'username'   =>$username,
			'password'   =>sha1($identificacion),
			'acceso'     =>0);

			//array del padre - para insertar en la tabla padres
			$padre = array(
			'id_padre'         =>$ultimo_id_padre,
			'identificacion_p' =>$identificacion_p,
			'nombres_p'        =>$nombres_p,
			'apellido1_p'      =>$apellido1_p,
			'apellido2_p'      =>$apellido2_p,
			'telefono_p'       =>$telefono_p,
			'direccion_p'      =>$direccion_p,
			'barrio_p'         =>$barrio_p,
			'ocupacion_p'      =>$ocupacion_p,
			'telefono_trabajo_p'  =>$telefono_trabajo_p,
			'direccion_trabajo_p' =>$direccion_trabajo_p);

			//array de la madre - para insertar en la tabla madres
			$madre = array(
			'id_madre'         =>$ultimo_id_madre,
			'identificacion_m' =>$identificacion_m,
			'nombres_m'        =>$nombres_m,
			'apellido1_m'      =>$apellido1_m,
			'apellido2_m'      =>$apellido2_m,
			'telefono_m'       =>$telefono_m,
			'direccion_m'      =>$direccion_m,
			'barrio_m'         =>$barrio_m,
			'ocupacion_m'      =>$ocupacion_m,
			'telefono_trabajo_m' =>$telefono_trabajo_m,
			'direccion_trabajo_m' =>$direccion_trabajo_m);

			$estudiantes_padres = array(
			'id_estudiante' =>$ultimo_id,
			'id_padre'      =>$ultimo_id_padre,
			'id_madre'      =>$ultimo_id_madre);

			$estado = array(
			'id_persona'    =>$ultimo_id,
			'Estado'        =>"Inscrito",
			'observaciones' =>"Estudiante Inscrito.",
			'fecha_estado'  =>$fecha_actual,
			'ano_lectivo'   =>$ano_lectivo);


			if ($this->estudiantes_model->validar_existencia($identificacion)){

				$respuesta=$this->estudiantes_model->insertar_estudiante($estudiante,$estudiante2,$usuario,$padre,$madre,$estudiantes_padres,$estado);
				

				if($respuesta==true){

					echo "registroguardado";

					if(!copy("./uploads/imagenes/fotos/foto.jpg","./uploads/imagenes/fotos/".$ultimo_id.".jpg")){
						echo "Error Al Copiar La Imagen.";
					}

				}
				else{
					echo "registronoguardado";
				}


			}
			else{

				echo "estudianteyaexiste";
			}



        }
        

	}

	public function mostrarestudiantes(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		//---------FORMA PARA JSON ARRAY---------
		//$consulta = $data['buscado'] = $this->estudiantes_model->buscar_estudiante($id);
		
		//---------FORMA PARA JSON OBJECTH---------
		$data = array(

			'estudiantes' => $this->estudiantes_model->buscar_estudiante($id,$inicio,$cantidad),

		    'totalregistros' => count($this->estudiantes_model->buscar_estudiante($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function modificar(){

		$this->form_validation->set_rules('identificacion', 'Identificación', 'required|numeric|max_length[10]');
		$this->form_validation->set_rules('tipo_id', 'Tipo De Identificación', 'required');
		$this->form_validation->set_rules('fecha_expedicion', 'Fecha De Expedicion', 'required');
		$this->form_validation->set_rules('pais_expedicion', 'Pais De Expedicion', 'required');
        $this->form_validation->set_rules('departamento_expedicion', 'Dpto. De Expedicion', 'required');
        $this->form_validation->set_rules('municipio_expedicion', 'Mcpio. De Expedicion', 'required');
        $this->form_validation->set_rules('nombres', 'Nombres', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1', 'Primer Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2', 'Segundo Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('sexo', 'Sexo', 'required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('fecha_nacimiento', 'Fecha De Nacimiento', 'required');
        $this->form_validation->set_rules('pais_nacimiento', 'Pais De Nacimiento', 'required');
        $this->form_validation->set_rules('departamento_nacimiento', 'Dpto. De Nacimiento', 'required');
        $this->form_validation->set_rules('municipio_nacimiento', 'Mcpio. De Nacimiento', 'required');
        $this->form_validation->set_rules('tipo_sangre', 'Tipo De Sangre', 'required');
        $this->form_validation->set_rules('eps', 'Eps', 'required|alpha_spaces');
        $this->form_validation->set_rules('poblacion', 'Poblacion', 'required|alpha_spaces');
        $this->form_validation->set_rules('correo', 'Correo', 'required|alpha_spaces');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('barrio', 'Barrio', 'required|alpha_spaces');
        $this->form_validation->set_rules('pais_residencia', 'Pais De Residencia', 'required');
        $this->form_validation->set_rules('departamento_residencia', 'Dpto. De Residencia', 'required');
        $this->form_validation->set_rules('municipio_residencia', 'Mcpio. De Residencia', 'required');
        $this->form_validation->set_rules('estrato', 'Estrato', 'required');
        //$this->form_validation->set_rules('institucion_procedencia', 'I.E. De Procedencia', 'required|alpha_spaces');
        $this->form_validation->set_rules('discapacidad', 'Discapacidad', 'required|alpha_spaces');
        $this->form_validation->set_rules('grado_cursado', 'Grado Cursado', 'required');
        //$this->form_validation->set_rules('anio', 'Año', 'required|numeric|max_length[4]');
        //Padre
        $this->form_validation->set_rules('identificacion_padre', 'Identificación Del Padre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('nombres_padre', 'Nombres Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1_padre', 'Primer Apellido Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2_padre', 'Segundo Apellido Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono Del Padre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_padre', 'Dirección Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('barrio_padre', 'Barrio Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('ocupacion_padre', 'Ocupacion Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono_trabajo_padre', 'Telefono Trabajo Del Padre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_trabajo_padre', 'Dirección Trabajo Del Padre', 'required|alpha_spaces');

        //Madre
        $this->form_validation->set_rules('identificacion_madre', 'Identificación De la madre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('nombres_madre', 'Nombres De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1_madre', 'Primer Apellido De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2_madre', 'Segundo Apellido De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono De la madre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_madre', 'Dirección De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('barrio_madre', 'Barrio De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('ocupacion_madre', 'Ocupacion De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono_trabajo_madre', 'Telefono Trabajo De la madre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_trabajo_madre', 'Dirección Trabajo De la madre', 'required|alpha_spaces');


        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();
        }
        else{

        	$id_persona = $this->input->post('id_persona');
        	$identificacion = $this->input->post('identificacion');
			$tipo_id = $this->input->post('tipo_id');
			$fecha_expedicion = $this->input->post('fecha_expedicion');
			$pais_expedicion = $this->input->post('pais_expedicion');
			$departamento_expedicion = $this->input->post('departamento_expedicion');
			$municipio_expedicion = $this->input->post('municipio_expedicion');
			$nombres = mb_convert_case(mb_strtolower(trim($this->input->post('nombres'))), MB_CASE_TITLE);
			$apellido1 = mb_convert_case(mb_strtolower(trim($this->input->post('apellido1'))), MB_CASE_TITLE);
			$apellido2 = mb_convert_case(mb_strtolower(trim($this->input->post('apellido2'))), MB_CASE_TITLE);
			$sexo = $this->input->post('sexo');
			$fecha_nacimiento = $this->input->post('fecha_nacimiento');
			$pais_nacimiento = $this->input->post('pais_nacimiento');
			$departamento_nacimiento = $this->input->post('departamento_nacimiento');
			$municipio_nacimiento = $this->input->post('municipio_nacimiento');
			$tipo_sangre = $this->input->post('tipo_sangre');
			$eps = mb_convert_case(mb_strtolower(trim($this->input->post('eps'))), MB_CASE_TITLE);
			$poblacion = $this->input->post('poblacion');
			$telefono = trim($this->input->post('telefono'));
			$email = trim($this->input->post('correo'));
			$direccion = mb_convert_case(mb_strtolower(trim($this->input->post('direccion'))), MB_CASE_TITLE);
			$barrio = mb_convert_case(mb_strtolower(trim($this->input->post('barrio'))), MB_CASE_TITLE);
			$pais_residencia = $this->input->post('pais_residencia');
			$departamento_residencia = $this->input->post('departamento_residencia');
			$municipio_residencia = $this->input->post('municipio_residencia');
			$estrato = $this->input->post('estrato');

			$discapacidad = $this->input->post('discapacidad');
			$institucion_procedencia = mb_convert_case(mb_strtolower(trim($this->input->post('institucion_procedencia'))), MB_CASE_TITLE);
			$grado_cursado = $this->input->post('grado_cursado');
			$anio = trim($this->input->post('anio'));

			$id_padre = $this->input->post('id_padre');
			$identificacion_p = $this->input->post('identificacion_padre');
			$nombres_p = mb_convert_case(mb_strtolower(trim($this->input->post('nombres_padre'))), MB_CASE_TITLE);
			$apellido1_p = mb_convert_case(mb_strtolower(trim($this->input->post('apellido1_padre'))), MB_CASE_TITLE);
			$apellido2_p = mb_convert_case(mb_strtolower(trim($this->input->post('apellido2_padre'))), MB_CASE_TITLE);
			$telefono_p = trim($this->input->post('telefono_padre'));
			$direccion_p = mb_convert_case(mb_strtolower(trim($this->input->post('direccion_padre'))), MB_CASE_TITLE);
			$barrio_p = mb_convert_case(mb_strtolower(trim($this->input->post('barrio_padre'))), MB_CASE_TITLE);
			$ocupacion_p = mb_convert_case(mb_strtolower(trim($this->input->post('ocupacion_padre'))), MB_CASE_TITLE);
			$telefono_trabajo_p = trim($this->input->post('telefono_trabajo_padre'));
			$direccion_trabajo_p = mb_convert_case(mb_strtolower(trim($this->input->post('direccion_trabajo_padre'))), MB_CASE_TITLE);

			$id_madre = $this->input->post('id_madre');
			$identificacion_m = $this->input->post('identificacion_madre');
			$nombres_m = mb_convert_case(mb_strtolower(trim($this->input->post('nombres_madre'))), MB_CASE_TITLE);
			$apellido1_m = mb_convert_case(mb_strtolower(trim($this->input->post('apellido1_madre'))), MB_CASE_TITLE);
			$apellido2_m = mb_convert_case(mb_strtolower(trim($this->input->post('apellido2_madre'))), MB_CASE_TITLE);
			$telefono_m = trim($this->input->post('telefono_madre'));
			$direccion_m = mb_convert_case(mb_strtolower(trim($this->input->post('direccion_madre'))), MB_CASE_TITLE);
			$barrio_m = mb_convert_case(mb_strtolower(trim($this->input->post('barrio_madre'))), MB_CASE_TITLE);
			$ocupacion_m = mb_convert_case(mb_strtolower(trim($this->input->post('ocupacion_madre'))), MB_CASE_TITLE);
			$telefono_trabajo_m = trim($this->input->post('telefono_trabajo_madre'));
			$direccion_trabajo_m = mb_convert_case(mb_strtolower(trim($this->input->post('direccion_trabajo_madre'))), MB_CASE_TITLE);

			//array para actualizar en la tabla personas
			$estudiante = array(
        	'id_persona'       =>$id_persona,	
			'identificacion'   =>$identificacion,
			'tipo_id'          =>$tipo_id,
			'fecha_expedicion' =>$fecha_expedicion,
			'pais_expedicion'  =>$pais_expedicion,
			'departamento_expedicion' =>$departamento_expedicion,
			'municipio_expedicion'    =>$municipio_expedicion,
			'nombres'          =>$nombres,
			'apellido1'        =>$apellido1,
			'apellido2'        =>$apellido2,
			'sexo'             =>$sexo,
			'fecha_nacimiento' =>$fecha_nacimiento,
			'pais_nacimiento'  =>$pais_nacimiento,
			'departamento_nacimiento' =>$departamento_nacimiento,
			'municipio_nacimiento'    =>$municipio_nacimiento,
			'tipo_sangre'      =>$tipo_sangre,
			'eps'              =>$eps,
			'poblacion'        =>$poblacion,
			'telefono'         =>$telefono,
			'email'            =>$email,
			'direccion'        =>$direccion,
			'barrio'           =>$barrio,
			'pais_residencia'  =>$pais_residencia,
			'departamento_residencia' =>$departamento_residencia,
			'municipio_residencia'    =>$municipio_residencia,
			'estrato'          =>$estrato);

			//array para actualizar en la tabla estudiantes
			$estudiante2 = array(
			'id_persona'    =>$id_persona,
			'discapacidad'  =>$discapacidad,
			'institucion_procedencia' =>$institucion_procedencia,
			'grado_cursado' =>$grado_cursado,
			'anio'          =>$anio);

			//aqui creamos el username de un estudiante
			$user = mb_strtolower(substr($nombres, 0, 2));
			$name = mb_strtolower($apellido1);
			$username = $user.$name.$id_persona;

			//array para actualizar en la tabla usuarios	
			$usuario = array(
			'id_usuario' =>$id_persona,
			'id_persona' =>$id_persona,
			'id_rol'     =>2,
			'username'   =>$username,
			'password'   =>sha1($identificacion),
			'acceso'     =>0);

			//array del padre - para actualizar en la tabla padres
			$padre = array(
			'id_padre'         =>$id_padre,
			'identificacion_p' =>$identificacion_p,
			'nombres_p'        =>$nombres_p,
			'apellido1_p'      =>$apellido1_p,
			'apellido2_p'      =>$apellido2_p,
			'telefono_p'       =>$telefono_p,
			'direccion_p'      =>$direccion_p,
			'barrio_p'         =>$barrio_p,
			'ocupacion_p'      =>$ocupacion_p,
			'telefono_trabajo_p'  =>$telefono_trabajo_p,
			'direccion_trabajo_p' =>$direccion_trabajo_p);

			//array de la madre - para actualizar en la tabla madres
			$madre = array(
			'id_madre'         =>$id_madre,
			'identificacion_m' =>$identificacion_m,
			'nombres_m'        =>$nombres_m,
			'apellido1_m'      =>$apellido1_m,
			'apellido2_m'      =>$apellido2_m,
			'telefono_m'       =>$telefono_m,
			'direccion_m'      =>$direccion_m,
			'barrio_m'         =>$barrio_m,
			'ocupacion_m'      =>$ocupacion_m,
			'telefono_trabajo_m' =>$telefono_trabajo_m,
			'direccion_trabajo_m' =>$direccion_trabajo_m);
			
	    	$identificacion_buscada = $this->estudiantes_model->obtener_identificacion($id_persona);

	        if(is_numeric($identificacion)){

	        	if ($identificacion_buscada == $identificacion) {

	        		$respuesta=$this->estudiantes_model->modificar_estudiante($id_persona,$id_padre,$id_madre,$estudiante,$estudiante2,$usuario,$padre,$madre);
	            
		            if($respuesta==true){
		                
		                echo "registroactualizado";
		            }else{
		               
		            	echo "registronoactualizado";
		            }
	        		
	        	}
	        	else{

	        		if ($this->estudiantes_model->validar_existencia($identificacion)){

	        			$respuesta=$this->estudiantes_model->modificar_estudiante($id_persona,$id_padre,$id_madre,$estudiante,$estudiante2,$usuario,$padre,$madre);
	            
			            if($respuesta==true){
			                
			                echo "registroactualizado";
			            }else{
			               
			            	echo "registronoactualizado";
			            }


	        		}
	        		else{

	        			echo "estudianteyaexiste";

	        		}

	        	}
	          
	            
	         
	        }else{
	            
	            echo "digite valor numerico para la Identificacion";
	        }

	    }
	        
    }


    public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			if ($this->estudiantes_model->ValidarExistencia_EstudianteEnMatriculas($id)){

		        $respuesta=$this->estudiantes_model->eliminar_estudiante($id);
		        	
	          	if($respuesta==true){
	              
	              	echo "Estudiante Eliminado Correctamente.";

	              	if (!unlink("./uploads/imagenes/fotos/".$id.".jpg")) {
	              		echo "Error Al Borrar La Imagen.";
	              	}

	          	}else{
	              
	              	echo "No Se Pudo Eliminar.";
	          	}
	        }
	        else{
	        	echo "No Se Puede Eliminar Este Estudiante; Actualmente Se Encuentra Asociado A Una Matrícula.";
	        }
          //redirect(base_url());
        }else{
          
          	echo "digite valor numerico para la cedula";
        }
    }


    public function llenarcombo_paises(){

    	$consulta = $this->estudiantes_model->llenar_paises();
    	echo json_encode($consulta);
    }

    public function llenarcombo_departamentos(){

    	$id =$this->input->post('id');
    	$consulta = $this->estudiantes_model->llenar_departamentos($id);
    	echo json_encode($consulta);
    }

    public function llenarcombo_municipios(){

    	$id =$this->input->post('id');
    	$consulta = $this->estudiantes_model->llenar_municipios($id);
    	echo json_encode($consulta);
    }





	
}