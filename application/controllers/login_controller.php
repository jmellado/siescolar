<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
		$this->load->database('default');
	}

	
	public function index()
	{


		switch ($this->session->userdata('rol')) {
			case '':
				//$data['token'] = $this->token();
				//$data['titulo'] = 'Login con roles de usuario en codeigniter';
				$this->load->view('login/login_vista');
				break;
			case 'administrador':
				redirect(site_url("rol_administrador"));
				break;
			case 'estudiante':
				redirect(site_url("rol_estudiante"));
				break;	
			case 'profesor':
				redirect(site_url("rol_profesor"));
				break;
			default:		
				//$data['titulo'] = 'Login con roles de usuario en codeigniter';
				$this->load->view('login/login_vista');
				break;		
			}

		
	}



	public function login_user(){

		if($this->input->post('token') === $this->session->userdata('token')){

			$username =$this->input->post('username'); 
			$password = sha1($this->input->post('password')); 
			$check_user = $this->login_model->login_usuarios($username,$password);

			if ($check_user == true){

				$data = array(
	                'logueado' 		=> 		TRUE,
	                'id_usuario' 	=> 		$check_user->id_usuario,
	                'id_persona'	=>		$check_user->id_persona,
	                'rol'			=>		$check_user->nombre_rol,
	                'username' 		=> 		$check_user->username,
	                'acceso' 		=> 		$check_user->acceso,
	                'identificacion'=> 		$check_user->identificacion,
	                'nombres' 		=> 		$check_user->nombres,
	                'apellido1' 	=> 		$check_user->apellido1,
	                'apellido2' 	=> 		$check_user->apellido2
            		);	

					$this->session->set_userdata($data);
					//$this->index();   nuevo coment
					

			}
			else{

				echo "usuario no existe";
			}



		}
		else{

			redirect(base_url());

		}

	}

	public function token()
	{
		$tokenname = $this->security->get_csrf_token_name();
		$token = $this->security->get_csrf_hash();
		$this->session->set_userdata($tokenname,$token);
		return $token;
	}
	
	public function logout_ci()
	{
		$this->session->sess_destroy();
		$this->index();
		
	}










}