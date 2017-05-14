<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grados_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('estudiantes_model');
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

}