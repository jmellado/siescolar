<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignaturas_model extends CI_Model {


	public function insertar_asignatura($asignatura){
		if ($this->db->insert('asignaturas', $asignatura)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($nombre,$ano_lectivo){

		$this->db->where('nombre_asignatura',$nombre);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('asignaturas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_asignatura($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('asignaturas.nombre_asignatura',$id,'after');
		$this->db->or_like('areas.nombre_area',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');
		$this->db->or_like('asignaturas.estado_asignatura',$id,'after');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('anos_lectivos', 'asignaturas.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->join('areas', 'asignaturas.id_area = areas.id_area');

		$this->db->select('asignaturas.id_asignatura,asignaturas.nombre_asignatura,asignaturas.id_area,asignaturas.ano_lectivo,asignaturas.estado_asignatura,areas.nombre_area,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('asignaturas');

		return $query->result();
		
	}

	public function eliminar_asignatura($id){

     	$this->db->where('id_asignatura',$id);
		$consulta = $this->db->delete('asignaturas');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    public function modificar_asignatura($id,$asignatura){

	
		$this->db->where('id_asignatura',$id);

		if ($this->db->update('asignaturas', $asignatura))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_asignatura');
		$query = $this->db->get('asignaturas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_asignatura'];
        return $data['query'];
	}


	public function llenar_anos_lectivos(){

		$query = $this->db->get('anos_lectivos');
		return $query->result();
	}


	public function llenar_areas(){

		$this->db->where('estado_area','Activo');
		$query = $this->db->get('areas');
		return $query->result();
	}


	public function obtener_nombre_asignatura($id){

		$this->db->where('id_asignatura',$id);
		$query = $this->db->get('asignaturas');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['nombre_asignatura'];
		}
		else{
			return false;
		}

	}


	public function obtener_ano_lectivo($id){

		$this->db->where('id_asignatura',$id);
		$query = $this->db->get('asignaturas');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['ano_lectivo'];
		}
		else{
			return false;
		}

	}








}