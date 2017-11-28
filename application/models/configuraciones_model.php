<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuraciones_model extends CI_Model {


	public function insertar_datos_institucion($institucion){
		if ($this->db->insert('datos_institucion', $institucion)) 
			return true;
		else
			return false;
	}

	public function validar_existencia(){

		$query = $this->db->get('datos_institucion');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function modificar_datos_institucion($institucion){

		if ($this->db->update('datos_institucion', $institucion))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id');
		$query = $this->db->get('datos_institucion');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id'];
        return $data['query'];
	}


	public function buscar_datos_institucion(){

		$query = $this->db->get('datos_institucion');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else{
			return false;
		}

	}

}