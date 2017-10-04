<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	
	public function login_usuarios($username,$password){

		$this->db->select('id_usuario,roles.nombre_rol,username,acceso,personas.nombres,personas.apellido1,personas.apellido2');
		$this->db->from('usuarios');
		$this->db->join('roles', 'usuarios.id_rol = roles.id_rol');
		$this->db->join('personas', 'usuarios.id_persona = personas.id_persona');
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