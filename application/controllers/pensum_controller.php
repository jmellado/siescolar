<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pensum_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('pensum_model');
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
		$this->template->load('roles/rol_administrador_vista', 'pensum/pensum_vista');
	}

	public function insertar(){

        $this->form_validation->set_rules('id_grado', 'grado', 'required|numeric');
        $this->form_validation->set_rules('id_asignatura', 'asignatura', 'required|numeric');
        $this->form_validation->set_rules('intensidad_horaria', 'horas', 'required|numeric');
        $this->form_validation->set_rules('ano_lectivo', 'año lectivo', 'required|min_length[1]|max_length[4]');
        $this->form_validation->set_rules('estado_pensum', 'estado', 'required|alpha_spaces');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de pensum + 1 
        	$ultimo_id = $this->pensum_model->obtener_ultimo_id();
        	$id_grado = $this->input->post('id_grado');
        	$id_asignatura = $this->input->post('id_asignatura');
        	$intensidad_horaria = $this->input->post('intensidad_horaria');
        	$ano_lectivo = $this->input->post('ano_lectivo');
        	$estado_pensum = $this->input->post('estado_pensum');

        	//array para insertar en la tabla pensum-
        	$pensum = array(
        	'id_pensum' =>$ultimo_id,	
			'id_grado' =>$id_grado,
			'id_asignatura' =>$id_asignatura,
			'intensidad_horaria' =>$intensidad_horaria,
			'ano_lectivo' =>$ano_lectivo,
			'estado_pensum' =>$estado_pensum);

			if ($this->pensum_model->validar_existencia($id_grado,$id_asignatura,$ano_lectivo)){

				$respuesta=$this->pensum_model->insertar_pensum($pensum);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "pensumyaexiste";
			}

        }

	}

	public function mostrarpensum(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'pensum' => $this->pensum_model->buscar_pensum($id,$inicio,$cantidad),

		    'totalregistros' => count($this->pensum_model->buscar_pensum($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			
	        $respuesta=$this->pensum_model->eliminar_pensum($id);
	        
          	if($respuesta==true){
              
              	echo "Asignatura Eliminada De Este Pensum Correctamente.";
          	}else{
              
              	echo "No Se Pudo Eliminar.";
          	}
          
        }else{
          
          	echo "digite valor numerico para identificar un pensum";
        }
    }

    public function modificar(){

    	$id_pensum = $this->input->post('id_pensum');
    	$id_grado = $this->input->post('id_grado');
    	$id_asignatura = $this->input->post('id_asignatura');
    	$intensidad_horaria = $this->input->post('intensidad_horaria');
    	$ano_lectivo = $this->input->post('ano_lectivo');
    	$estado_pensum = $this->input->post('estado_pensum');

    	//array para insertar en la tabla pensum----------
        $pensum = array(
        'id_pensum' =>$id_pensum,	
		'id_grado' =>$id_grado,
		'id_asignatura' =>$id_asignatura,
		'intensidad_horaria' =>$intensidad_horaria,
		'ano_lectivo' =>$ano_lectivo,
		'estado_pensum' =>$estado_pensum);

		$grado_buscado = $this->pensum_model->obtener_id_grado($id_pensum);
		$asignatura_buscada = $this->pensum_model->obtener_id_asignatura($id_pensum);
		$ano_lectivo_buscado = $this->pensum_model->obtener_ano_lectivo($id_pensum);

        if(is_numeric($id_pensum)){

        	if ($grado_buscado == $id_grado && $asignatura_buscada == $id_asignatura && $ano_lectivo_buscado == $ano_lectivo){

	        	$respuesta=$this->pensum_model->modificar_pensum($id_pensum,$pensum);

				 if($respuesta==true){

					echo "registroactualizado";

	             }else{

					echo "registronoactualizado";

	             }
	        }
	        else{

	        	if($this->pensum_model->validar_existencia($id_grado,$id_asignatura,$ano_lectivo)){

	        		$respuesta=$this->pensum_model->modificar_pensum($id_pensum,$pensum);

	        		if($respuesta==true){

	        			echo "registroactualizado";

	        		}else{

	        			echo "registronoactualizado";
	        		}



	        	}else{

	        		echo "pensumyaexiste";

	        	}

				
			}    
                
         
        }else{
            
            echo "digite valor numerico para identificar un pensum";
        }




    }

    
    public function llenarcombo_asignaturas(){

    	$consulta = $this->pensum_model->llenar_asignaturas();
    	echo json_encode($consulta);
    }



}