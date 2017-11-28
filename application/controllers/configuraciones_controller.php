<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuraciones_controller extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('configuraciones_model');
		$this->load->library('form_validation');
	}


	public function datos_institucion()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'configuraciones/datos_institucion_vista');
	}


	public function insertar(){

		$this->form_validation->set_rules('nombre_institucion', 'nombre', 'required|alpha_spaces');
        $this->form_validation->set_rules('niveles_educacion', 'niveles', 'required|alpha_spaces');
        $this->form_validation->set_rules('resolucion', 'resolucion', 'required|alpha_spaces');
        $this->form_validation->set_rules('dane', 'dane', 'required|alpha_spaces');
        $this->form_validation->set_rules('nit', 'nit', 'required|alpha_spaces');
        $this->form_validation->set_rules('direccion', 'direccion', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'telefono', 'required|numeric');
        $this->form_validation->set_rules('email', 'email', 'required|alpha_spaces');
        $this->form_validation->set_rules('rector', 'rector', 'required|alpha_spaces');
        
        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{


			$nombre_institucion = strtoupper($this->input->post('nombre_institucion'));
			$niveles_educacion = ucwords($this->input->post('niveles_educacion'));
			$resolucion = ucwords($this->input->post('resolucion'));
			$dane = ucwords($this->input->post('dane'));
			$nit = ucwords($this->input->post('nit'));
			$direccion = ucwords($this->input->post('direccion'));
			$telefono = $this->input->post('telefono');
			$email = $this->input->post('email');
			$rector = ucwords($this->input->post('rector'));

			//array para insertar en la tabla datos_institucion----------
        	$institucion = array(
        	'nombre_institucion' =>$nombre_institucion,	
			'niveles_educacion' =>$niveles_educacion,
			'resolucion' =>$resolucion,
			'dane' =>$dane,
			'nit' =>$nit,
			'direccion' =>$direccion,
			'telefono' =>$telefono,
			'email' =>$email,
			'rector' =>$rector);

			if ($this->configuraciones_model->validar_existencia()){

				$respuesta=$this->configuraciones_model->insertar_datos_institucion($institucion);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				$respuesta=$this->configuraciones_model->modificar_datos_institucion($institucion);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}
			}

			

		}

	}


	public function insertar_imagen(){

		//Ruta donde se guardan los ficheros
		//Tipos de ficheros permitidos
		$config = [
			'upload_path' => './uploads/imagenes/colegio',
			'allowed_types' => 'png|jpg',
			'file_name' => 'escudo.png',
			'overwrite' => 'true',
			'max_width' => '1300',
			'max_height' => '1300'
		];

		//Cargamos la librería de subida y le pasamos la configuración
		$this->load->library('upload', $config);

		//si el fchero es subido correctamente
		if ($this->upload->do_upload('escudo')) {

			//Datos del fichero subido
			$data = array('upload_data' => $this->upload->data());

			//array para insertar la imagen en la tabla datos_institucion----------
        	$institucion = array(
			'escudo' =>$data['upload_data']['file_name']);

			if ($this->configuraciones_model->validar_existencia()){

				$respuesta=$this->configuraciones_model->insertar_datos_institucion($institucion);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				$respuesta=$this->configuraciones_model->modificar_datos_institucion($institucion);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}
			}
			
		}
		else{

			echo $this->upload->display_errors();
		}

	}


	public function buscar_datos_institucion(){
 
		
		$consulta = $this->configuraciones_model->buscar_datos_institucion();

		if($consulta==false){
			echo "noexiste";
		}
		else{

			echo json_encode($consulta);	
						
		}
	    
	}	
}