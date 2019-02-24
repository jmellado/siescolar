<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salones_model extends CI_Model {


	public function insertar_salon($salon){
		if ($this->db->insert('salones', $salon)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($nombre,$ano_lectivo){

		$this->db->where('nombre_salon',$nombre);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('salones');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_salon($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('salones.nombre_salon',$id,'after');
		$this->db->or_like('salones.observacion',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');
		$this->db->or_like('salones.estado_salon',$id,'after');

		$this->db->order_by('salones.ano_lectivo', 'desc');
		$this->db->order_by('salones.nombre_salon', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('anos_lectivos', 'salones.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->select('salones.id_salon,salones.nombre_salon,salones.observacion,salones.ano_lectivo,salones.estado_salon,anos_lectivos.nombre_ano_lectivo');
		
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


	public function obtener_informacion_salon($id){

		$this->db->where('id_salon',$id);
		$query = $this->db->get('salones');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
		}
		else{
			return false;
		}

	}


	public function ValidarExistencia_SalonEnCursos($id_salon){

		$this->db->where('id_salon',$id_salon);
		$query = $this->db->get('cursos');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function obtener_anio_salon($id_salon){

		$this->db->where('id_salon',$id_salon);
		$query = $this->db->get('salones');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['ano_lectivo'];
		}
		else{
			
			return false;
		}

	}



}