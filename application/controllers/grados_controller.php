<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grados_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('grados_model');
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
		$this->template->load('roles/rol_administrador_vista', 'grados/grados_vista');
	}

	public function insertar(){

        $this->form_validation->set_rules('nombre_grado', 'nombre', 'required|alpha_spaces');
        $this->form_validation->set_rules('ciclo_grado', 'ciclo', 'required|alpha_spaces');
        $this->form_validation->set_rules('jornada', 'jornada', 'required|alpha_spaces');
        $this->form_validation->set_rules('ano_lectivo', 'año lectivo', 'required|min_length[1]|max_length[4]');
        $this->form_validation->set_rules('estado_grado', 'estado', 'required|alpha_spaces');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de grados + 1 
        	 $ultimo_id = $this->grados_model->obtener_ultimo_id();

        	  //array para insertar en la tabla grados----------
        	$grado = array(
        	'id_grado' =>$ultimo_id,	
			'nombre_grado' =>ucwords($this->input->post('nombre_grado')),
			'ciclo_grado' =>$this->input->post('ciclo_grado'),
			'jornada' =>$this->input->post('jornada'),
			'ano_lectivo' =>$this->input->post('ano_lectivo'),
			'estado_grado' =>$this->input->post('estado_grado'));

			if ($this->grados_model->validar_existencia($this->input->post('nombre_grado'),$this->input->post('ano_lectivo'))){

				$respuesta=$this->grados_model->insertar_grado($grado);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "grado ya existe";
			}

        }

	}

	public function mostrargrados(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'grados' => $this->grados_model->buscar_grado($id,$inicio,$cantidad),

		    'totalregistros' => count($this->grados_model->buscar_grado($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			
	        $respuesta=$this->grados_model->eliminar_grado($id);
	        
          	if($respuesta==true){
              
              	echo "eliminado correctamente";
          	}else{
              
              	echo "no se pudo eliminar";
          	}
          
        }else{
          
          	echo "digite valor numerico para identificar un grado";
        }
    }

    public function modificar(){

    	//array para insertar en la tabla grados----------
        $grado = array(
        'id_grado' =>$this->input->post('id_grado'),	
		'nombre_grado' =>ucwords($this->input->post('nombre_grado')),
		'ciclo_grado' =>$this->input->post('ciclo_grado'),
		'jornada' =>$this->input->post('jornada'),
		'ano_lectivo' =>$this->input->post('ano_lectivo'),
		'estado_grado' =>$this->input->post('estado_grado'));

		$id = $this->input->post('id_grado');
		$nombre_buscado = $this->grados_model->obtener_nombre_grado($id);
		$ano_lectivo_buscado = $this->grados_model->obtener_ano_lectivo($id);

        if(is_numeric($id)){

        	if ($nombre_buscado == $this->input->post('nombre_grado') && $ano_lectivo_buscado == $this->input->post('ano_lectivo')){

	        	$respuesta=$this->grados_model->modificar_grado($this->input->post('id_grado'),$grado);

				 if($respuesta==true){

					echo "registro actualizado";

	             }else{

					echo "registro no se pudo actualizar";

	             }
	        }
	        else{

	        	if($this->grados_model->validar_existencia($this->input->post('nombre_grado'),$this->input->post('ano_lectivo'))){

	        		$respuesta=$this->grados_model->modificar_grado($this->input->post('id_grado'),$grado);

	        		if($respuesta==true){

	        			echo "registro actualizado";

	        		}else{

	        			echo "registro no se pudo actualizar";
	        		}



	        	}else{

	        		echo "grado ya existe";

	        	}

				
			}    
                
         
        }else{
            
            echo "digite valor numerico para identificar un grado";
        }




    }

    public function llenarcombo_anos_lectivos(){

    	$consulta = $this->grados_model->llenar_anos_lectivos();
    	echo json_encode($consulta);
    }

}