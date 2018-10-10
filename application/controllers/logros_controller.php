<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logros_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('logros_model');
		$this->load->model('funciones_globales_model');
		$this->load->model('grados_model');
		$this->load->model('asignaturas_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}

	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		//$this->load->view('estudiantes/registrar2');
		$this->template->load('roles/rol_administrador_vista', 'logros/logros_vista');
	}

	public function index_profesor()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		//$this->load->view('estudiantes/registrar2');
		$this->template->load('roles/rol_profesor_vista', 'logros/logros_profesor_vista');
	}

	public function insertar(){

        $this->form_validation->set_rules('descripcion_logro', 'descripcion', 'required|alpha_spaces');
        $this->form_validation->set_rules('periodo', 'periodo', 'required|max_length[7]');
        $this->form_validation->set_rules('id_persona', 'id persona', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('id_grado', 'grado', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('id_asignatura', 'asignatura', 'required|numeric|max_length[10]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de logros + 1 
        	$ultimo_id = $this->logros_model->obtener_ultimo_id();

        	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

        	$descripcion_logro = $this->input->post('descripcion_logro');
        	$periodo = $this->input->post('periodo');
        	$id_profesor = $this->input->post('id_persona');
        	$id_grado = $this->input->post('id_grado');
        	$id_asignatura = $this->input->post('id_asignatura');
        	$secuencia = $this->logros_model->obtener_ultima_secuencia($periodo,$id_profesor,$id_grado,$id_asignatura,$ano_lectivo);

        	//aqui creamos el nombre del logro
			$n_grado = substr($this->grados_model->obtener_nombre_grado($id_grado), 0,1);
			$n_asignatura = substr($this->asignaturas_model->obtener_nombre_asignatura($id_asignatura), 0,4);
			$n_periodo = substr($periodo, 0,1);
			$nombre_logro = $n_asignatura.$n_grado.$n_periodo.$secuencia;

        	  //array para insertar en la tabla logros----------
        	$logro = array(
        	'id_logro' =>$ultimo_id,	
			'nombre_logro' =>$nombre_logro,
			'descripcion_logro' =>$descripcion_logro,
			'periodo' =>$periodo,
			'id_profesor' =>$id_profesor,
			'id_grado' =>$id_grado,
			'id_asignatura' =>$id_asignatura,
			'ano_lectivo' =>$ano_lectivo,
			'secuencia' =>$secuencia);

			if ($this->logros_model->validar_existencia($nombre_logro,$id_profesor,$ano_lectivo)){

				$respuesta=$this->logros_model->insertar_logro($logro);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "logro ya existe";
			}

        }

	}

	public function mostrarlogros(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'logros' => $this->logros_model->buscar_logro($id,$inicio,$cantidad),

		    'totalregistros' => count($this->logros_model->buscar_logro($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	//Mostrar los Logros Ingresados Por Un Determinado Profesor
	public function mostrarlogros_profesor(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		$id_profesor =$this->input->post('id_persona');

		$data = array(

			'logros' => $this->logros_model->buscar_logro_profesor($id,$id_profesor,$inicio,$cantidad),

		    'totalregistros' => count($this->logros_model->buscar_logro_profesor($id,$id_profesor)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			if ($this->logros_model->ValidarExistencia_LogroAsignado($id)){

		        $respuesta=$this->logros_model->eliminar_logro($id);
		        
	          	if($respuesta==true){
	              
	              	echo "Logro Eliminado Correctamente.";
	          	}else{
	              
	              	echo "No Se Pudo Eliminar.";
	          	}
	        }
	        else{
	        	echo "No Se Puede Eliminar Este Logro; Actualmente Se Encuentra Asignado A Un Estudiante.";
	        }
          
        }else{
          
          	echo "digite valor numerico para identificar un logro";
        }
    }

    public function modificar(){

    	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

    	$id_logro = $this->input->post('id_logro');
    	$descripcion_logro = $this->input->post('descripcion_logro');
        $periodo = $this->input->post('periodo');
        $id_profesor = $this->input->post('id_persona');
        $id_grado = $this->input->post('id_grado');
        $id_asignatura = $this->input->post('id_asignatura');
        $row = $this->logros_model->obtener_secuencia_logro($id_logro);

        if($row[0]['periodo'] == $periodo && $row[0]['id_asignatura'] == $id_asignatura && $row[0]['id_grado'] == $id_grado){
        	$secuencia = $row[0]['secuencia'];
        }
        else{
        	$secuencia = $this->logros_model->obtener_ultima_secuencia($periodo,$id_profesor,$id_grado,$id_asignatura,$ano_lectivo);
    	}
    	//aqui creamos el nombre del logro
		$n_grado = substr($this->grados_model->obtener_nombre_grado($id_grado), 0,1);
		$n_asignatura = substr($this->asignaturas_model->obtener_nombre_asignatura($id_asignatura), 0,4);
		$n_periodo = substr($periodo, 0,1);
		$nombre_logro = $n_asignatura.$n_grado.$n_periodo.$secuencia;

    	//array para insertar en la tabla logros----------
        $logro = array(
        'id_logro' =>$id_logro,	
		'nombre_logro' =>$nombre_logro,
		'descripcion_logro' =>$descripcion_logro,
		'periodo' =>$periodo,
		'id_profesor' =>$id_profesor,
		'id_grado' =>$id_grado,
		'id_asignatura' =>$id_asignatura,
		'ano_lectivo' =>$ano_lectivo,
		'secuencia' =>$secuencia);


        if(is_numeric($id_logro)){

	    	//if($this->logros_model->validar_existencia($nombre_logro,$ano_lectivo)){

	        	$respuesta=$this->logros_model->modificar_logro($id_logro,$logro);

	        	if($respuesta==true){

	        		echo "registro actualizado";

	        	}else{

	        		echo "registro no se pudo actualizar";
	        	}

	        //}else{

	        	//echo "logro ya existe";

	        //}

        }else{
            
            echo "digite valor numerico para identificar un logro";
        }


    }


    public function buscar_profesor(){

		$id = $this->input->post('id'); 
		
		$consulta = $this->logros_model->buscar_profesor($id);

		if($consulta==false){
			echo "profesornoexiste";
		}
		else{

			echo json_encode($consulta);	
						
		}
	    
	}


	public function llenarcombo_grados_profesor(){

		$id_profesor = $this->input->post('id_persona');

    	$consulta = $this->logros_model->llenar_grados_profesor($id_profesor);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas_profesor(){

    	$id_profesor = $this->input->post('id_persona');
		$id_grado = $this->input->post('id_grado');

    	$consulta = $this->logros_model->llenar_asignaturas_profesor($id_profesor,$id_grado);
    	echo json_encode($consulta);
    }


	
	
}