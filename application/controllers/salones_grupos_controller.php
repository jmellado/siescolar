<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salones_grupos_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('salones_grupos_model');
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
		$this->template->load('roles/rol_administrador_vista', 'salones_grupos/salones_grupos_vista');
	}

	public function insertar(){

        $this->form_validation->set_rules('id_salon', 'salon', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('id_grado', 'grado', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('id_grupo', 'grupo', 'required|numeric|max_length[10]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de salones + 1 
        	 //$ultimo_id = $this->salones_model->obtener_ultimo_id();

        	  //array para insertar en la tabla salones por grupos----------
        	$salon_grupo = array(
        	//'id_salon' =>$ultimo_id,	
			'id_salon' =>$this->input->post('id_salon'),
			'id_grado' =>$this->input->post('id_grado'),
			'id_grupo' =>$this->input->post('id_grupo'));

			if ($this->salones_grupos_model->validar_existencia($this->input->post('id_salon'))){

				if($this->salones_grupos_model->validar_grado_grupo($this->input->post('id_grado'),$this->input->post('id_grupo'))){

					$respuesta=$this->salones_grupos_model->insertar_salon_grupo($salon_grupo);

					if($respuesta==true){

						echo "registroguardado";
					}
					else{

						echo "registronoguardado";
					}
				}
				else{

					echo "gradogrupo ya existe";
				}

			}
			else{

				echo "salongrupo ya existe";
			}

        }

	}

	public function mostrarsalones_grupos(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'salones_grupos' => $this->salones_grupos_model->buscar_salon_grupo($id,$inicio,$cantidad),

		    'totalregistros' => count($this->salones_grupos_model->buscar_salon_grupo($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			
	        $respuesta=$this->salones_grupos_model->eliminar_salon_grupo($id);
	        
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

    	//array para insertar en la tabla salones por grupo----------
        $salon_grupo = array(
        //'id_salon' =>$this->input->post('id_salon'),	
		'id_salon' =>$this->input->post('id_salon'),
		'id_grado' =>$this->input->post('id_grado'),
		'id_grupo' =>$this->input->post('id_grupo'));

		$id = $this->input->post('id_salon');
		//$id = (int) $id;
        if(is_numeric($id)){

        	//if ($this->salones_model->validar_existencia($this->input->post('nombre_salon'))){

        		if($this->salones_grupos_model->validar_grado_grupo($this->input->post('id_grado'),$this->input->post('id_grupo'))){
		        	$respuesta=$this->salones_grupos_model->modificar_salon_grupo($this->input->post('id_salon'),$salon_grupo);

					 if($respuesta==true){

						echo "registro actualizado";

		             }else{

						echo "registro no se pudo actualizar, nombre de salon ya registrado";

		             }
        		}
        		else{

        			echo "grado y grupo ya registrados";
        		}

	        //}
	        /*else{

				echo "salon ya existe";
			}*/     
                
         
        }else{
            
            echo "digite valor numerico para identificar un salon";
        }




    }

    public function llenarcombo_salones(){

    	$consulta = $this->salones_grupos_model->llenar_salones();
    	echo json_encode($consulta);
    }

    public function llenarcombo_grados(){

    	$consulta = $this->salones_grupos_model->llenar_grados();
    	echo json_encode($consulta);
    }

    public function llenarcombo_grupos(){

    	$consulta = $this->salones_grupos_model->llenar_grupos();
    	echo json_encode($consulta);
    }

}