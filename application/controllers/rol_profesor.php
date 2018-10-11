<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rol_profesor extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		$data['contents'] = null;
		$this->load->view('roles/rol_profesor_vista',$data);
	}


	public function dashboard()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_profesor_vista', 'dashboards/dashboard_profesor');
	}


	public function carga_academica()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_profesor_vista', 'cargas_academicas/cargas_academicasprofesor_vista');
	}
}