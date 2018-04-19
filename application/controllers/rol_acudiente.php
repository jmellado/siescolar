<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rol_acudiente extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'acudiente')
		{
			redirect(base_url().'login_controller');
		}
		$data['contents'] = null;
		$this->load->view('roles/rol_acudiente_vista',$data);
	}
}