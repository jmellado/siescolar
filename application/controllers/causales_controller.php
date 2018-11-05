<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Causales_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('causales_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}

	
	public function tipos_causales()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'causales/tipos_causales_vista');
	}


	public function insertar_tipo_causal(){

        $this->form_validation->set_rules('tipo_causal', 'Tipo causal', 'required|alpha_spaces');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de tipos de causales + 1 
        	$ultimo_id = $this->causales_model->obtener_ultimo_id_tipo_causal();
        	$tipo_causal = ucwords(mb_strtolower(trim($this->input->post('tipo_causal'))));

        	//array para insertar en la tabla tipos causales
        	$tipo = array(
        	'id_tipo_causal' =>$ultimo_id,	
			'tipo_causal' =>$tipo_causal);

			if ($this->causales_model->validar_existencia_tipo_causal($tipo_causal)){

				$respuesta=$this->causales_model->insertar_tipo_causal($tipo);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "tipoyaexiste";
			}

        }

	}


	public function mostrartipos_causales(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'tipos' => $this->causales_model->buscar_tipo_causal($id,$inicio,$cantidad),

		    'totalregistros' => count($this->causales_model->buscar_tipo_causal($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function modificar_tipo_causal(){

    	$id_tipo = $this->input->post('id_tipo_causal');
    	$tipo_causal = ucwords(mb_strtolower(trim($this->input->post('tipo_causal'))));

    	//array para insertar en la tabla tipos causales
        $tipo = array(
        'id_tipo_causal' =>$id_tipo,	
		'tipo_causal' =>$tipo_causal);

		$tipo_buscado = $this->causales_model->obtener_nombre_tipo($id_tipo);

        if(is_numeric($id_tipo)){

        	if ($this->causales_model->ValidarExistencia_TipoEnCausales($id_tipo)){

	        	if ($tipo_buscado == $tipo_causal){

		        	$respuesta=$this->causales_model->modificar_tipo_causal($id_tipo,$tipo);

					if($respuesta==true){

						echo "registroactualizado";

		            }else{

						echo "registronoactualizado";

		            }
		        }
		        else{

		        	if($this->causales_model->validar_existencia_tipo_causal($tipo_causal)){

		        		$respuesta=$this->causales_model->modificar_tipo_causal($id_tipo,$tipo);

		        		if($respuesta==true){

		        			echo "registroactualizado";

		        		}else{

		        			echo "registronoactualizado";

		        		}

		        	}
		        	else{

		        		echo "tipoyaexiste";

		        	}

					
				}
			}
			else{
				echo "tipoencausales";
			}          
         
        }else{
            
            echo "digite valor numerico para identificar un tipo";
        }


    }


    public function eliminar_tipo_causal(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			if ($this->causales_model->ValidarExistencia_TipoEnCausales($id)){

		        $respuesta=$this->causales_model->eliminar_tipo_causal($id);
		        
	          	if($respuesta==true){
	              
	              	echo "Tipo De Causal Eliminado Correctamente.";
	          	}else{
	              
	              	echo "No Se Pudo Eliminar.";
	          	}
	        }
	        else{
	        	echo "No Se Puede Eliminar Este Tipo De Causal; Actualmente Tiene Causales Asociadas.";
	        }
          
        }else{
          
          	echo "digite valor numerico para identificar un tipo de causal";
        }
    }



    //================ Funciones Para La Gestion De Causales ==================


    public function causales()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'causales/causales_vista');
	}


}