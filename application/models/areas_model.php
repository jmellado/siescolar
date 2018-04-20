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

		$this->db->like('areas.nombre_area',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');
		$this->db->or_like('areas.estado_area',$id,'after');

		$this->db->order_by('areas.nombre_area', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('anos_lectivos', 'areas.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->select('areas.id_area,areas.nombre_area,areas.ano_lectivo,areas.estado_area,anos_lectivos.nombre_ano_lectivo');
		
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


	public function obtener_nombre_area($id){

		$this->db->where('id_area',$id);
		$query = $this->db->get('areas');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['nombre_area'];
		}
		else{
			return false;
		}

	}


	public function ValidarExistencia_AreaEnAsignaturas($id_area){

		$this->db->where('id_area',$id_area);
		$query = $this->db->get('asignaturas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

}