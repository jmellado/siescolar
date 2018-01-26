<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rol_votante extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'votante')
		{
			redirect(base_url().'login_controller');
		}
		$data['contents'] = null;
		$this->load->view('roles/rol_votante_vista',$data);
	}


	public function elecciones()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'votante')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_votante_vista', 'elecciones/voto_electronico_vista');
	}


}