<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignaturas_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
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
		$this->template->load('roles/rol_administrador_vista', 'asignaturas/asignaturas_vista');
	}

	public function insertar(){

        $this->form_validation->set_rules('nombre_asignatura', 'nombre', 'required|alpha_spaces');
        $this->form_validation->set_rules('id_area', 'area', 'required|min_length[1]|max_length[4]');
        $this->form_validation->set_rules('ano_lectivo', 'año lectivo', 'required|min_length[1]|max_length[4]');
        $this->form_validation->set_rules('estado_asignatura', 'estado', 'required|alpha_spaces');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de asignaturas + 1 
        	$ultimo_id = $this->asignaturas_model->obtener_ultimo_id();
        	$nombre_asignatura = ucwords(strtolower(trim($this->input->post('nombre_asignatura'))));
        	$id_area = $this->input->post('id_area');
        	$ano_lectivo = $this->input->post('ano_lectivo');
        	$estado_asignatura = $this->input->post('estado_asignatura');

        	//array para insertar en la tabla asignaturas----------
        	$asignatura = array(
        	'id_asignatura' =>$ultimo_id,	
			'nombre_asignatura' =>$nombre_asignatura,
			'id_area' =>$id_area,
			'ano_lectivo' =>$ano_lectivo,
			'estado_asignatura' =>$estado_asignatura);

			if ($this->asignaturas_model->validar_existencia($nombre_asignatura,$ano_lectivo)){

				$respuesta=$this->asignaturas_model->insertar_asignatura($asignatura);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "asignaturayaexiste";
			}

        }

	}

	public function mostrarasignaturas(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'asignaturas' => $this->asignaturas_model->buscar_asignatura($id,$inicio,$cantidad),

		    'totalregistros' => count($this->asignaturas_model->buscar_asignatura($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			
	        $respuesta=$this->asignaturas_model->eliminar_asignatura($id);
	        
          	if($respuesta==true){
              
              	echo "Asignatura Eliminada Correctamente.";
          	}else{
              
              	echo "No Se Pudo Eliminar.";
          	}
          
        }else{
          
          	echo "digite valor numerico para identificar una asignatura";
        }
    }

    public function modificar(){

    	$id_asignatura = $this->input->post('id_asignatura');
    	$nombre_asignatura = ucwords(strtolower(trim($this->input->post('nombre_asignatura'))));
    	$id_area = $this->input->post('id_area');
    	$ano_lectivo = $this->input->post('ano_lectivo');
    	$estado_asignatura = $this->input->post('estado_asignatura');

    	//array para insertar en la tabla asignaturas----------
        $asignatura = array(
        'id_asignatura' =>$id_asignatura,	
		'nombre_asignatura' =>$nombre_asignatura,
		'id_area' =>$id_area,
		'ano_lectivo' =>$ano_lectivo,
		'estado_asignatura' =>$estado_asignatura);

		$nombre_buscado = $this->asignaturas_model->obtener_nombre_asignatura($id_asignatura);
		$ano_lectivo_buscado = $this->asignaturas_model->obtener_ano_lectivo($id_asignatura);

        if(is_numeric($id_asignatura)){

        	if ($nombre_buscado == $nombre_asignatura && $ano_lectivo_buscado == $ano_lectivo){

	        	$respuesta=$this->asignaturas_model->modificar_asignatura($id_asignatura,$asignatura);

				 if($respuesta==true){

					echo "registroactualizado";

	             }else{

					echo "registronoactualizado";

	             }
	        }
	        else{

	        	if($this->asignaturas_model->validar_existencia($nombre_asignatura,$ano_lectivo)){

	        		$respuesta=$this->asignaturas_model->modificar_asignatura($id_asignatura,$asignatura);

	        		if($respuesta==true){

	        			echo "registroactualizado";

	        		}else{

	        			echo "registronoactualizado";
	        		}



	        	}else{

	        		echo "asignaturayaexiste";

	        	}

				
			}    
                
         
        }else{
            
            echo "digite valor numerico para identificar una asignatura";
        }




    }

    
    public function llenarcombo_areas(){

    	$consulta = $this->asignaturas_model->llenar_areas();
    	echo json_encode($consulta);
    }

}