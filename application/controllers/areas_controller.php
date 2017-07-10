<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Areas_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('areas_model');
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
		$this->template->load('roles/rol_administrador_vista', 'areas/areas_vista');
	}

	public function insertar(){

        $this->form_validation->set_rules('nombre_area', 'nombre', 'required|alpha_spaces');
        $this->form_validation->set_rules('ano_lectivo', 'ano lectivo', 'required|min_length[1]|max_length[4]');
        $this->form_validation->set_rules('estado_area', 'estado', 'required|alpha_spaces');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de areas + 1 
        	 $ultimo_id = $this->areas_model->obtener_ultimo_id();

        	  //array para insertar en la tabla areas----------
        	$area = array(
        	'id_area' =>$ultimo_id,	
			'nombre_area' =>ucwords($this->input->post('nombre_area')),
			'ano_lectivo' =>$this->input->post('ano_lectivo'),
			'estado_area' =>$this->input->post('estado_area'));

			if ($this->areas_model->validar_existencia($this->input->post('nombre_area'))){

				$respuesta=$this->areas_model->insertar_area($area);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "area ya existe";
			}

        }

	}

	public function mostrarareas(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'areas' => $this->areas_model->buscar_area($id,$inicio,$cantidad),

		    'totalregistros' => count($this->areas_model->buscar_area($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			
	        $respuesta=$this->areas_model->eliminar_area($id);
	        
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

    	//array para insertar en la tabla areas----------
        $area = array(
        'id_area' =>$this->input->post('id_area'),	
		'nombre_area' =>ucwords($this->input->post('nombre_area')),
		'ano_lectivo' =>$this->input->post('ano_lectivo'),
		'estado_area' =>$this->input->post('estado_area'));

		$id = $this->input->post('id_area');
        if(is_numeric($id)){

        	//if ($this->grados_model->validar_existencia($this->input->post('nombre_grado'))){

	        	$respuesta=$this->areas_model->modificar_area($this->input->post('id_area'),$area);

				 if($respuesta==true){

					echo "registro actualizado";

	             }else{

					echo "registro no se pudo actualizar, nombre de area ya registrado";

	             }
	        //}
	        /*else{

				echo "grado ya existe";
			}*/     
                
         
        }else{
            
            echo "digite valor numerico para identificar un area";
        }




    }


    public function llenarcombo_anos_lectivos(){

    	$consulta = $this->areas_model->llenar_anos_lectivos();
    	echo json_encode($consulta);
    }

}