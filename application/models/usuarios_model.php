<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public function buscar_usuario($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('personas.identificacion',$id,'after');
		$this->db->or_like('personas.nombres',$id,'after');
		$this->db->or_like('personas.apellido1',$id,'after');
		$this->db->or_like('personas.apellido2',$id,'after');
		$this->db->or_like('roles.nombre_rol',$id,'after');

		$this->db->order_by('roles.nombre_rol', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('personas', 'usuarios.id_persona = personas.id_persona');
		$this->db->join('roles', 'usuarios.id_rol = roles.id_rol');
		$this->db->select('usuarios.id_usuario,usuarios.id_persona,usuarios.id_rol,usuarios.username,usuarios.password,usuarios.acceso,roles.nombre_rol,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2');
		
		$query = $this->db->get('usuarios');

		return $query->result();
		
	}


	public function modificar_usuario($id_usuario,$usuario){

		$this->db->where('id_usuario',$id_usuario);

		if ($this->db->update('usuarios', $usuario))

			return true;
		else
			return false;
	}


}