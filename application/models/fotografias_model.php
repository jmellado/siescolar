<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fotografias_model extends CI_Model {


	public function buscar_estudiante($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('personas.nombres',$id,'after');
		$this->db->or_like('personas.apellido1',$id,'after');
		$this->db->or_like('personas.apellido2',$id,'after');
		$this->db->or_like('personas.identificacion',$id,'after');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('estudiantes', 'personas.id_persona = estudiantes.id_persona');

		$query = $this->db->get('personas');

		return $query->result();
		
	}


}