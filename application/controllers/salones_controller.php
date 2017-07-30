<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salones_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('salones_model');
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
		$this->template->load('roles/rol_administrador_vista', 'salones/salones_vista');
	}

	public function insertar(){

        $this->form_validation->set_rules('nombre_salon', 'nombre', 'required|alpha_spaces');
        $this->form_validation->set_rules('observacion', 'observacion', 'required|alpha_spaces');
        $this->form_validation->set_rules('ano_lectivo', 'ano lectivo', 'required|min_length[1]|max_length[4]');
        $this->form_validation->set_rules('estado_salon', 'estado', 'required|alpha_spaces');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de salones + 1 
        	 $ultimo_id = $this->salones_model->obtener_ultimo_id();

        	$disponibilidad = 'si';
        	  //array para insertar en la tabla salones----------
        	$salon = array(
        	'id_salon' =>$ultimo_id,	
			'nombre_salon' =>ucwords($this->input->post('nombre_salon')),
			'observacion' =>ucwords($this->input->post('observacion')),
			'ano_lectivo' =>$this->input->post('ano_lectivo'),
			'estado_salon' =>$this->input->post('estado_salon'),
			'disponibilidad' =>$disponibilidad);

			if ($this->salones_model->validar_existencia($this->input->post('nombre_salon'),$this->input->post('ano_lectivo'))){

				$respuesta=$this->salones_model->insertar_salon($salon);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "salon ya existe";
			}

        }

	}

	public function mostrarsalones(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'salones' => $this->salones_model->buscar_salon($id,$inicio,$cantidad),

		    'totalregistros' => count($this->salones_model->buscar_salon($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			
	        $respuesta=$this->salones_model->eliminar_salon($id);
	        
          	if($respuesta==true){
              
              	echo "eliminado correctamente";
          	}else{
              
              	echo "no se pudo eliminar";
          	}
          
        }else{
          
          	echo "digite valor numerico para identificar un salon";
        }
    }

    public function modificar(){

    	$disponibilidad = 'si';
    	//array para insertar en la tabla salones----------
        $salon = array(
        'id_salon' =>$this->input->post('id_salon'),	
		'nombre_salon' =>ucwords($this->input->post('nombre_salon')),
		'observacion' =>ucwords($this->input->post('observacion')),
		'ano_lectivo' =>$this->input->post('ano_lectivo'),
		'estado_salon' =>$this->input->post('estado_salon'),
		'disponibilidad' =>$disponibilidad);

		$id = $this->input->post('id_salon');
		$nombre_buscado = $this->salones_model->obtener_nombre_salon($id);
		$ano_lectivo_buscado = $this->salones_model->obtener_ano_lectivo($id);

        if(is_numeric($id)){

        	if ($nombre_buscado == $this->input->post('nombre_salon') && $ano_lectivo_buscado == $this->input->post('ano_lectivo')){

	        	$respuesta=$this->salones_model->modificar_salon($this->input->post('id_salon'),$salon);

				 if($respuesta==true){

					echo "registro actualizado";

	             }else{

					echo "registro no se pudo actualizar";

	             }
	        }
	        else{

	        	if($this->salones_model->validar_existencia($this->input->post('nombre_salon'),$this->input->post('ano_lectivo'))){

	        		$respuesta=$this->salones_model->modificar_salon($this->input->post('id_salon'),$salon);

	        		if($respuesta==true){

	        			echo "registro actualizado";

	        		}else{

	        			echo "registro no se pudo actualizar";
	        		}

	        	}
	        	else{

	        		echo "salon ya existe";
	        	}
	
			}    
                
         
        }else{
            
            echo "digite valor numerico para identificar un salon";
        }

    }



    public function llenarcombo_anos_lectivos(){

    	$consulta = $this->salones_model->llenar_anos_lectivos();
    	echo json_encode($consulta);
    }

}