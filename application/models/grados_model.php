<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grados_model extends CI_Model {


	public function insertar_grado($grado){
		if ($this->db->insert('grados', $grado)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($nombre,$ano_lectivo){

		$this->db->where('nombre_grado',$nombre);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('grados');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_grado($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('grados.nombre_grado',$id,'after');
		$this->db->or_like('niveles_educacion.nombre_nivel',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');
		$this->db->or_like('grados.estado_grado',$id,'after');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('anos_lectivos', 'grados.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->join('niveles_educacion', 'grados.nivel_educacion = niveles_educacion.id_nivel');
		$this->db->select('grados.id_grado,grados.nombre_grado,grados.nivel_educacion,grados.ano_lectivo,grados.estado_grado,anos_lectivos.nombre_ano_lectivo,niveles_educacion.nombre_nivel');
		
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


	public function obtener_nombre_grado($id){

		$this->db->where('id_grado',$id);
		$query = $this->db->get('grados');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['nombre_grado'];
		}
		else{
			return false;
		}

	}


	public function obtener_ano_lectivo($id){

		$this->db->where('id_grado',$id);
		$query = $this->db->get('grados');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['ano_lectivo'];
		}
		else{
			return false;
		}

	}


	public function llenar_niveles(){

		$query = $this->db->get('niveles_educacion');
		return $query->result();
	}


	public function llenar_gradoseducacion($id_nivel){

		$this->db->where('nivel_educacion',$id_nivel);
		$query = $this->db->get('grados_educacion');
		return $query->result();
	}





}