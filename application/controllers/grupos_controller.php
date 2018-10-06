<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupos_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('grupos_model');
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
		$this->template->load('roles/rol_administrador_vista', 'grupos/grupos_vista');
	}

	public function insertar(){

        $this->form_validation->set_rules('nombre_grupo', 'nombre', 'required|alpha_spaces');
        $this->form_validation->set_rules('ano_lectivo', 'ano lectivo', 'required|min_length[1]|max_length[4]');
        $this->form_validation->set_rules('estado_grupo', 'estado', 'required|alpha_spaces');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de grupos + 1 
        	$ultimo_id = $this->grupos_model->obtener_ultimo_id();

        	//array para insertar en la tabla grados----------
        	$grupo = array(
        	'id_grupo' =>$ultimo_id,	
			'nombre_grupo' =>ucwords(strtolower(trim($this->input->post('nombre_grupo')))),
			'ano_lectivo' =>$this->input->post('ano_lectivo'),
			'estado_grupo' =>$this->input->post('estado_grupo'));

			if ($this->grupos_model->validar_existencia($this->input->post('nombre_grupo'),$this->input->post('ano_lectivo'))){

				$respuesta=$this->grupos_model->insertar_grupo($grupo);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "grupoyaexiste";
			}

        }

	}

	public function mostrargrupos(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'grupos' => $this->grupos_model->buscar_grupo($id,$inicio,$cantidad),

		    'totalregistros' => count($this->grupos_model->buscar_grupo($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			if ($this->grupos_model->ValidarExistencia_GrupoEnCursos($id)){

		        $respuesta=$this->grupos_model->eliminar_grupo($id);
		        
	          	if($respuesta==true){
	              
	              	echo "Grupo Eliminado Correctamente.";
	          	}else{
	              
	              	echo "No Se Pudo Eliminar.";
	          	}
	        }
	        else{
	        	echo "No Se Puede Eliminar Este Grupo; Actualmente Se Encuentra Asociado A Un Curso.";
	        }
          
        }else{
          
          	echo "digite valor numerico para identificar un grupo";
        }
    }

    public function modificar(){

    	//array para insertar en la tabla grupos----------
        $grupo = array(
        'id_grupo' =>$this->input->post('id_grupo'),	
		'nombre_grupo' =>ucwords($this->input->post('nombre_grupo')),
		'ano_lectivo' =>$this->input->post('ano_lectivo'),
		'estado_grupo' =>$this->input->post('estado_grupo'));
        
		$id = $this->input->post('id_grupo');
		$nombre_buscado = $this->grupos_model->obtener_nombre_grupo($id);
		$ano_lectivo_buscado = $this->grupos_model->obtener_ano_lectivo($id);

        if(is_numeric($id)){

        	if ($this->grupos_model->ValidarExistencia_GrupoEnCursos($id)){

	        	if ($nombre_buscado == $this->input->post('nombre_grupo') && $ano_lectivo_buscado == $this->input->post('ano_lectivo')){

		        	$respuesta=$this->grupos_model->modificar_grupo($this->input->post('id_grupo'),$grupo);

					 if($respuesta==true){

						echo "registroactualizado";

		             }else{

						echo "registronoactualizado";

		             }
		        }
		        else{

		        	if($this->grupos_model->validar_existencia($this->input->post('nombre_grupo'),$this->input->post('ano_lectivo'))){

		        		$respuesta=$this->grupos_model->modificar_grupo($this->input->post('id_grupo'),$grupo);

		        		if($respuesta==true){

		        			echo "registroactualizado";
		        		}else{

		        			echo "registronoactualizado";
		        		}


		        	}else{

		        		echo "grupoyaexiste";
		        	}

					
				}    
            }
            else{
            	echo "grupoencursos";
            }    
         
        }else{
            
            echo "digite valor numerico para identificar un grupo";
        }

    }
    

    

}