<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grados_model extends CI_Model {


	public function insertar_grado($grado){
		if ($this->db->insert('grados', $grado)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($nombre){

		$this->db->where('nombre_grado',$nombre);
		$query = $this->db->get('grados');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_grado($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('nombre_grado',$id,'after');
		$this->db->or_like('ciclo_grado',$id,'after');
		$this->db->or_like('jornada',$id);
		$this->db->or_like('año_lectivo',$id);
		$this->db->or_like('estado_grado',$id);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}
		
		$query = $this->db->get('grados');

		return $query->result();
		
	}

	public function eliminar_grado($id){

     	$this->db->where('id_grado',$id);
		$consulta = $this->db->delete('grados');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    public function modificar_grado($id,$grado){

	
		$this->db->where('id_grado',$id);

		if ($this->db->update('grados', $grado))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_grado');
		$query = $this->db->get('grados');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_grado'];
        return $data['query'];
	}










}