<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuenta_model extends CI_Model {

	public function validar_actual_password($id_usuario,$actual_password){

		$this->db->where('id_usuario',$id_usuario);
		$this->db->where('password',sha1($actual_password));
		$query = $this->db->get('usuarios');

		if ($query->num_rows() > 0) {
			return true;
		}
		else{
			return false;
		}

	}


	public function cambiar_password($id_usuario,$pass){

		$this->db->where('id_usuario',$id_usuario);

		if ($this->db->update('usuarios', $pass))

			return true;
		else
			return false;
	}

}