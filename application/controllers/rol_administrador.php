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
}