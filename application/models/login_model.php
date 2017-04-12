<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	
	public function login_usuarios($username,$password){

		$this->db->select('id_usuario,roles.nombre_rol,username');
		$this->db->from('usuarios');
		$this->db->join('roles', 'usuarios.id_rol = roles.id_rol');
		$this->db->where('username',$username);
		$this->db->where('password',$password);

		//$query = $this->db->get('usuarios');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {

			
			return $query->row();
		}
		else{

			
			return false;
		}

	}
}