<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Documentos_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('documentos_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}


	public function documentosA()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'documentos/documentosA_vista');
	}


    public function insertar_documentoA(){

        $this->form_validation->set_rules('descripcion_documento', 'Descripción Del Documento', 'required|max_length[500]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$id_documento = $this->documentos_model->obtener_ultimo_id_documento();
        	$descripcion_documento = ucwords(mb_strtolower(trim($this->input->post('descripcion_documento'))));
        	$nombre_documento = str_replace(" ", "_", $_FILES['documento']['name']);
        	$documento = "documento";
        	$fecha_subida = $this->funciones_globales_model->obtener_fecha_actual_corta();

        	//array para insertar en la tabla documentos
        	$doc = array(
        	'id_documento' => $id_documento,
        	'descripcion_documento' =>$descripcion_documento,
			'nombre_documento' =>$nombre_documento,
			'fecha_subida' =>$fecha_subida);
        	
			if ($this->documentos_model->validar_existencia_documento($nombre_documento)){

				$config = [
					'upload_path' => './uploads/documentos',
					'allowed_types' => 'pdf|docx|doc',
					'overwrite' => 'true',
					'max_size' => '6000'
				];

				//Cargamos la librería de subida y le pasamos la configuración
				$this->load->library('upload', $config);

				//si el fchero es subido correctamente
				if ($this->upload->do_upload($documento)) {
					
					$respuesta=$this->documentos_model->insertar_documento($doc);

					if($respuesta==true){

						echo "registroguardado";
					}
					else{

						echo "registronoguardado";

						if (!unlink("./uploads/documentos/".$nombre_documento)) {
		              		echo "Error Al Eliminar El Documento.";
		              	}
					}

				}
				else{

					echo $this->upload->display_errors();
				}

			}
			else{

				echo "documentoyaexiste";
			}


        }

    }


    public function mostrardocumentos(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'documentos' => $this->documentos_model->buscar_documento($id,$inicio,$cantidad),

		    'totalregistros' => count($this->documentos_model->buscar_documento($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function eliminar_documentoA(){

	  	$id =$this->input->post('id');
	  	$nombre_documento = $this->documentos_model->obtener_nombre_documento($id); 

        if(is_numeric($id)){

	        $respuesta=$this->documentos_model->eliminar_documento($id);
	        
          	if($respuesta==true){
              
              	echo "Documento Eliminado Correctamente.";

              	if (!unlink("./uploads/documentos/".$nombre_documento)) {
              		echo "Error Al Eliminar El Documento.";
              	}

          	}else{
              
              	echo "No Se Pudo Eliminar.";
          	}
	        
        }else{
          
          	echo "digite valor numerico para identificar un Documento.";
        }
        
    }


    public function modificar_documentoA(){

    	$id_documento = $this->input->post('id_documento');
    	$descripcion_documento = ucwords(mb_strtolower(trim($this->input->post('descripcion_documento'))));
    	$nombre_documento = str_replace(" ", "_", $_FILES['documento']['name']);
        $documento = "documento";

    	//array para actualizar en la tabla documentos
        $doc = array(
    	'id_documento' => $id_documento,
    	'descripcion_documento' =>$descripcion_documento,
    	'nombre_documento' =>$nombre_documento);

    	$doc1 = array(
    	'id_documento' => $id_documento,
    	'descripcion_documento' =>$descripcion_documento);

    	$nombre_documento_anterior = $this->documentos_model->obtener_nombre_documento($id_documento);

		if ($_FILES['documento']['name'] != ""){

			if ($this->documentos_model->validar_existencia_documento($nombre_documento)){

				$config = [
					'upload_path' => './uploads/documentos',
					'allowed_types' => 'pdf|docx|doc',
					'overwrite' => 'true',
					'max_size' => '6000'
				];


				$this->load->library('upload', $config);

				
				if ($this->upload->do_upload($documento)) {
					
					$respuesta=$this->documentos_model->modificar_documento($id_documento,$doc);

					if($respuesta==true){

						echo "registroactualizado";

						if (!unlink("./uploads/documentos/".$nombre_documento_anterior)) {
		              		echo "Error Al Eliminar El Documento Anterior.";
		              	}
					}
					else{

						echo "registronoactualizado";

						if (!unlink("./uploads/documentos/".$nombre_documento)) {
		              		echo "Error Al Eliminar El Documento Nuevo.";
		              	}
					}

				}
				else{

					echo $this->upload->display_errors();
				}

			}
			else{

				echo "documentoyaexiste";
			}

		}
		else{
			
			$respuesta=$this->documentos_model->modificar_documento($id_documento,$doc1);

			if($respuesta==true){

				echo "registroactualizado";
			}
			else{

				echo "registronoactualizado";
			}

		}


    }


    //=========== Consultar los documentos desde el rol Profesor ============


    public function documentosP()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_profesor_vista', 'documentos/documentosP_vista');
	}


	//=========== Consultar los documentos desde el rol Estudiante ============


    public function documentosE()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'estudiante')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_estudiante_vista', 'documentos/documentosE_vista');
	}


	//=========== Consultar los documentos desde el rol Acudiente ============


    public function documentosAC()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'acudiente')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_acudiente_vista', 'documentos/documentosAC_vista');
	}


}