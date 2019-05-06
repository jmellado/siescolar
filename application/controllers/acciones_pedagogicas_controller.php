<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acciones_pedagogicas_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('acciones_pedagogicas_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'acciones_pedagogicas/acciones_pedagogicas_vista');
	}


	public function insertar(){

		$this->form_validation->set_rules('accion_pedagogica', 'Accion Pedagogica', 'required|alpha_spaces|max_length[500]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de acciones pedagogicas + 1 
        	$ultimo_id = $this->acciones_pedagogicas_model->obtener_ultimo_id();
        	$accion_pedagogica = mb_convert_case(mb_strtolower(trim($this->input->post('accion_pedagogica'))), MB_CASE_TITLE);

        	//array para insertar en la tabla acciones pedagogicas
        	$accion = array(
        	'id_accion_pedagogica' =>$ultimo_id,	
			'accion_pedagogica'    =>$accion_pedagogica);

			if ($this->acciones_pedagogicas_model->validar_existencia($accion_pedagogica)){

				$respuesta=$this->acciones_pedagogicas_model->insertar_accion_pedagogica($accion);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "accionyaexiste";
			}

        }

	}


	public function mostraracciones_pedagogicas(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'acciones_pedagogicas' => $this->acciones_pedagogicas_model->buscar_acciones_pedagogicas($id,$inicio,$cantidad),

		    'totalregistros' => count($this->acciones_pedagogicas_model->buscar_acciones_pedagogicas($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function modificar(){

    	$id_accion_pedagogica = $this->input->post('id_accion_pedagogica');
    	$accion_pedagogica = mb_convert_case(mb_strtolower(trim($this->input->post('accion_pedagogica'))), MB_CASE_TITLE);

    	//array para actualizar en la tabla acciones_pedagogicas
    	$accion = array(
    	'id_accion_pedagogica' =>$id_accion_pedagogica,	
		'accion_pedagogica'    =>$accion_pedagogica);

		$accion_buscada = $this->acciones_pedagogicas_model->obtener_informacion_accion_pedagogica($id_accion_pedagogica);

        if(is_numeric($id_accion_pedagogica)){

        	if ($this->acciones_pedagogicas_model->ValidarExistencia_AccionPedagogicaEnSeguimientos($id_accion_pedagogica)){

	        	if ($accion_buscada == $accion_pedagogica){

		        	$respuesta=$this->acciones_pedagogicas_model->modificar_accion_pedagogica($id_accion_pedagogica,$accion);

					if($respuesta==true){

						echo "registroactualizado";

		            }else{

						echo "registronoactualizado";

		            }
		        }
		        else{

		        	if($this->acciones_pedagogicas_model->validar_existencia($accion_pedagogica)){

		        		$respuesta=$this->acciones_pedagogicas_model->modificar_accion_pedagogica($id_accion_pedagogica,$accion);

		        		if($respuesta==true){

		        			echo "registroactualizado";

		        		}else{

		        			echo "registronoactualizado";

		        		}

		        	}
		        	else{

		        		echo "accionyaexiste";

		        	}
					
				}
				
			}
			else{
				echo "accionenseguimientos";
			}          
         
        }else{
            
            echo "digite valor numerico para identificar una accion pedagogica";
        }

    }


    public function eliminar(){

	  	$id_accion_pedagogica = $this->input->post('id'); 

        if(is_numeric($id_accion_pedagogica)){

			if ($this->acciones_pedagogicas_model->ValidarExistencia_AccionPedagogicaEnSeguimientos($id_accion_pedagogica)){

		        $respuesta=$this->acciones_pedagogicas_model->eliminar_accion_pedagogica($id_accion_pedagogica);
		        
	          	if($respuesta==true){
	              
	              	echo "Acción Pedagógica Eliminada Correctamente.";
	          	}else{
	              
	              	echo "No Se Pudo Eliminar.";
	          	}
	        }
	        else{
	        	echo "No Se Puede Eliminar Esta Acción Pedagógica; Actualmente Se Encuentra Asociada A Un Seguimiento.";
	        }
          
        }else{
          
          	echo "digite valor numerico para identificar una acción pedagógica";
        }

    }


}