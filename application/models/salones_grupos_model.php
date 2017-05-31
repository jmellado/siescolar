<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salones_grupos_model extends CI_Model {


	public function insertar_salon_grupo($salon_grupo){
		if ($this->db->insert('salones_grupo', $salon_grupo)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($id_salon){

		$this->db->where('id_salon',$id_salon);
		$query = $this->db->get('salones_grupo');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_salon_grupo($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('id_salon',$id,'after');
		$this->db->or_like('id_grado',$id,'after');
		$this->db->or_like('id_grupo',$id);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}
		
		$query = $this->db->get('salones_grupo');

		return $query->result();
		
	}

	public function eliminar_salon_grupo($id){

     	$this->db->where('id_salon',$id);
		$consulta = $this->db->delete('salones_grupo');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    public function modificar_salon_grupo($id,$salon_grupo){

	
		$this->db->where('id_salon',$id);

		if ($this->db->update('salones_grupo', $salon_grupo))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_salon');
		$query = $this->db->get('salones_grupo');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_salon'];
        return $data['query'];
	}

	public function llenar_salones(){

		$this->db->where('estado_salon','Activo');
		$query = $this->db->get('salones');
		return $query->result();
	}

	public function llenar_grados(){

		$this->db->where('estado_grado','Activo');
		$query = $this->db->get('grados');
		return $query->result();
	}

	public function llenar_grupos(){

		$this->db->where('estado_grupo','Activo');
		$query = $this->db->get('grupos');
		return $query->result();
	}










}