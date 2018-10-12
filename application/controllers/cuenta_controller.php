<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuenta_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('cuenta_model');
		$this->load->library('form_validation');

	}


	public function cambiarpassword()
	{

		switch ($this->session->userdata('rol')) {
			case '':
				$this->load->view('login/login_vista');
				break;
			case 'administrador':
				$this->template->load('roles/rol_administrador_vista', 'cuenta/cambiar_contrasena_vista');
				break;
			case 'estudiante':
				$this->template->load('roles/rol_estudiante_vista', 'cuenta/cambiar_contrasena_vista');
				break;	
			case 'profesor':
				$this->template->load('roles/rol_profesor_vista', 'cuenta/cambiar_contrasena_vista');
				break;
			case 'acudiente':
				$this->template->load('roles/rol_acudiente_vista', 'cuenta/cambiar_contrasena_vista');
				break;
			case 'votante':
				$this->template->load('roles/rol_votante_vista', 'cuenta/cambiar_contrasena_vista');
				break;
			default:		
				$this->load->view('login/login_vista');
				break;		
		}
	}


	public function cambiar_password(){

		$this->form_validation->set_rules('id_usuario', 'Id Usuario', 'required|numeric');
		$this->form_validation->set_rules('actual_password', 'Actual Contraseña', 'required|alpha_spaces');
        $this->form_validation->set_rules('nueva_password', 'Nueva Contraseña', 'required|alpha_spaces|max_length[40]|min_length[10]');
        $this->form_validation->set_rules('confirmar_password', 'Confirmar Contraseña', 'required|matches[nueva_password]|alpha_spaces|max_length[40]|min_length[10]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$id_usuario = $this->input->post('id_usuario');
        	$actual_password = $this->input->post('actual_password');
        	$nueva_password = $this->input->post('nueva_password');
        	$confirmar_password = $this->input->post('confirmar_password');

        	$pass = array('password' => sha1($nueva_password));

        	if ($this->cuenta_model->validar_actual_password($id_usuario,$actual_password)){

				$respuesta=$this->cuenta_model->cambiar_password($id_usuario,$pass);

				if($respuesta==true){

					echo "passactualizada";
				}
				else{

					echo "passnoactualizada";
				}

			}
			else{

				echo "passerror";
			}


        }


	}

}	