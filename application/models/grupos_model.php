<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupos_model extends CI_Model {


	public function insertar_grupo($grupo){
		if ($this->db->insert('grupos', $grupo)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($nombre,$ano_lectivo){

		$this->db->where('nombre_grupo',$nombre);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('grupos');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_grupo($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('grupos.nombre_grupo',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');
		$this->db->or_like('grupos.estado_grupo',$id,'after');

		$this->db->order_by('grupos.ano_lectivo', 'desc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('anos_lectivos', 'grupos.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->select('grupos.id_grupo,grupos.nombre_grupo,grupos.ano_lectivo,grupos.estado_grupo,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('grupos');

		return $query->result();
		
	}

	public function eliminar_grupo($id){

     	$this->db->where('id_grupo',$id);
		$consulta = $this->db->delete('grupos');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    public function modificar_grupo($id,$grupo){

	
		$this->db->where('id_grupo',$id);

		if ($this->db->update('grupos', $grupo))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_grupo');
		$query = $this->db->get('grupos');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_grupo'];
        return $data['query'];
	}


	public function obtener_nombre_grupo($id){

		$this->db->where('id_grupo',$id);
		$query = $this->db->get('grupos');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['nombre_grupo'];
		}
		else{
			return false;
		}

	}

	public function obtener_ano_lectivo($id){

		$this->db->where('id_grupo',$id);
		$query = $this->db->get('grupos');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['ano_lectivo'];
		}
		else{
			return false;
		}

	}


	public function ValidarExistencia_GrupoEnCursos($id_grupo){

		$this->db->where('id_grupo',$id_grupo);
		$query = $this->db->get('cursos');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function obtener_anio_grupo($id_grupo){

		$this->db->where('id_grupo',$id_grupo);
		$query = $this->db->get('grupos');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['ano_lectivo'];
		}
		else{
			
			return false;
		}

	}

}