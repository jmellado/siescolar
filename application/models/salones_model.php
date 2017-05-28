<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salones_model extends CI_Model {


	public function insertar_salon($salon){
		if ($this->db->insert('salones', $salon)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($nombre){

		$this->db->where('nombre_salon',$nombre);
		$query = $this->db->get('salones');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_salon($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('nombre_salon',$id,'after');
		$this->db->or_like('observacion',$id,'after');
		$this->db->or_like('estado_salon',$id);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}
		
		$query = $this->db->get('salones');

		return $query->result();
		
	}

	public function eliminar_salon($id){

     	$this->db->where('id_salon',$id);
		$consulta = $this->db->delete('salones');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    public function modificar_salon($id,$salon){

	
		$this->db->where('id_salon',$id);

		if ($this->db->update('salones', $salon))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_salon');
		$query = $this->db->get('salones');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_salon'];
        return $data['query'];
	}










}