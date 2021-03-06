<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rol_administrador extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$data['contents'] = null;
		$this->load->view('roles/rol_administrador_vista',$data);
	}

	public function dashboard()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$this->load->model('funciones_globales_model');
		$data['ano_lectivo'] = $this->funciones_globales_model->obtener_anio_actual();
		
		$this->template->load('roles/rol_administrador_vista', 'dashboards/dashboard_administrador', $data);
	}
}