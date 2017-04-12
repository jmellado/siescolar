<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rol_profesor extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		$this->load->view('roles/rol_profesor_vista');
	}
}