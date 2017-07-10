<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Areas_model extends CI_Model {


	public function insertar_area($area){
		if ($this->db->insert('areas', $area)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($nombre){

		$this->db->where('nombre_area',$nombre);
		$query = $this->db->get('areas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_area($id,$inicio = FALSE,$cantidad = FALSE){


		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		
		$query = $this->db->get('areas');

		return $query->result();
		
	}

	public function eliminar_area($id){

     	$this->db->where('id_area',$id);
		$consulta = $this->db->delete('areas');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    public function modificar_area($id,$area){

	
		$this->db->where('id_area',$id);

		if ($this->db->update('areas', $area))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_area');
		$query = $this->db->get('areas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_area'];
        return $data['query'];
	}


		return $query->result();
	}










}
