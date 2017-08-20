<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matriculas_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('matriculas_model');
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
		//$this->load->view('estudiantes/registrar2');
		$this->template->load('roles/rol_administrador_vista', 'matriculas/matriculas_vista');
	}

	public function insertar(){

        $this->form_validation->set_rules('id_persona', 'id persona', 'required|numeric');
        $this->form_validation->set_rules('id_salon', 'salon', 'required|numeric');
        $this->form_validation->set_rules('jornada', 'jornada', 'required|alpha_spaces');
        $this->form_validation->set_rules('observaciones', 'observaciones', 'required|alpha_spaces');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de matriculas + 1 
        	 $ultimo_id = $this->matriculas_model->obtener_ultimo_id();

        	//obtengo la fecha actual 
        	 $fecha_actual = $this->funciones_globales_model->obtener_fecha_actual_corta();
        	 
        	 //obtengo la año actual 
        	 $ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

        	 $estado = 'Activo';

        	  //array para insertar en la tabla grados----------
        	$matricula = array(
        	'id_matricula' =>$ultimo_id,	
			'fecha_matricula' =>$fecha_actual,
			'ano_lectivo' =>$ano_lectivo,
			'id_estudiante' =>$this->input->post('id_persona'),
			'id_salon' =>$this->input->post('id_salon'),
			'jornada' =>$this->input->post('jornada'),
			'observaciones' =>ucwords($this->input->post('observaciones')),
			'estado_matricula' =>$estado);

			if ($this->matriculas_model->validar_existencia($this->input->post('id_persona'),$ano_lectivo)){

				$respuesta=$this->matriculas_model->insertar_matricula($matricula);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "matricula ya existe";
			}

        }

	}

	public function mostrarmatriculas(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'matriculas' => $this->matriculas_model->buscar_matricula($id,$inicio,$cantidad),

		    'totalregistros' => count($this->matriculas_model->buscar_matricula($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			
	        $respuesta=$this->matriculas_model->eliminar_matricula($id);
	        
          	if($respuesta==true){
              
              	echo "eliminado correctamente";
          	}else{
              
              	echo "no se pudo eliminar";
          	}
          
        }else{
          
          	echo "digite valor numerico para identificar una matricula";
        }
    }

    public function modificar(){

        $estado = 'Activo';

    	//array para insertar en la tabla matriculas----------
        $matricula = array(
        'id_matricula' =>$this->input->post('id_matricula'),	
		'fecha_matricula' =>$this->input->post('fecha_matricula'),
		'ano_lectivo' =>$this->input->post('ano_lectivo'),
		'id_estudiante' =>$this->input->post('id_persona'),
		'id_salon' =>$this->input->post('id_salon'),
		'jornada' =>$this->input->post('jornada'),
		'observaciones' =>ucwords($this->input->post('observaciones')),
		'estado_matricula' =>$estado);

		$id = $this->input->post('id_matricula');

        if(is_numeric($id)){

	    	$respuesta=$this->matriculas_model->modificar_matricula($this->input->post('id_matricula'),$matricula);

	        if($respuesta==true){

	        	echo "registro actualizado";

	        }else{

	        	echo "registro no se pudo actualizar";
	        }

         
        }else{
            
            echo "digite valor numerico para identificar una matricula";
        }




    }


    public function buscar_estudiante(){

		$id = $this->input->post('id'); 
		//obtengo la fecha actual 
       	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		
		$consulta = $this->matriculas_model->buscar_estudiante($id);
		if($consulta==false){
			echo "estudiantenoexiste";
		}
		else{

			if($this->matriculas_model->validar_existencia_por_identificacion($id,$ano_lectivo)){

				echo json_encode($consulta);	
						
			}else{

				echo "matricula ya existe";
			}
			
		}
	    
	}


    public function llenarcombo_salones_grupo(){

    	$consulta = $this->matriculas_model->llenar_salones_grupo();
    	echo json_encode($consulta);
    }

    

}