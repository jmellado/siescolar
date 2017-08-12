<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cargas_academicas_model extends CI_Model {


	public function insertar_cargas_academicas($cargas_academicas){
		if ($this->db->insert('cargas_academicas', $cargas_academicas)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($id_grado,$id_asignatura,$id_grupo,$ano_lectivo){

		$this->db->where('id_grado',$id_grado);
		$this->db->where('id_asignatura',$id_asignatura);
		$this->db->where('id_grupo',$id_grupo);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('cargas_academicas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_cargas_academicas($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('personas.nombres',$id,'after');
		$this->db->or_like('grados.nombre_grado',$id,'after');
		$this->db->or_like('asignaturas.nombre_asignatura',$id,'after');
		$this->db->or_like('grupos.nombre_grupo',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('personas', 'cargas_academicas.id_profesor = personas.id_persona');
		$this->db->join('grados', 'cargas_academicas.id_grado = grados.id_grado');
		$this->db->join('asignaturas', 'cargas_academicas.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('grupos', 'cargas_academicas.id_grupo = grupos.id_grupo');
		$this->db->join('anos_lectivos', 'cargas_academicas.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('cargas_academicas.id_carga_academica,cargas_academicas.id_profesor,cargas_academicas.id_grado,cargas_academicas.id_asignatura,cargas_academicas.id_grupo,cargas_academicas.ano_lectivo,personas.nombres,grados.nombre_grado,asignaturas.nombre_asignatura,grupos.nombre_grupo,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('cargas_academicas');

		return $query->result();
		
	}

	public function eliminar_cargas_academicas($id){

     	$this->db->where('id_carga_academica',$id);
		$consulta = $this->db->delete('cargas_academicas');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    public function modificar_cargas_academicas($id,$cargas_academicas){

	
		$this->db->where('id_carga_academica',$id);

		if ($this->db->update('cargas_academicas', $cargas_academicas))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_carga_academica');
		$query = $this->db->get('cargas_academicas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_carga_academica'];
        return $data['query'];
	}


	public function llenar_anos_lectivos(){

		$query = $this->db->get('anos_lectivos');
		return $query->result();
	}


	public function obtener_cargas_academicas($id){

		$this->db->where('id_carga_academica',$id);
		$query = $this->db->get('cargas_academicas');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
		}
		else{
			return false;
		}

	}


	/*public function obtener_id_grado($id){

		$this->db->where('id_pensum',$id);
		$query = $this->db->get('pensum');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['id_grado'];
		}
		else{
			return false;
		}

	}


	public function obtener_id_asignatura($id){

		$this->db->where('id_pensum',$id);
		$query = $this->db->get('pensum');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['id_asignatura'];
		}
		else{
			return false;
		}

	}


	public function obtener_ano_lectivo($id){

		$this->db->where('id_pensum',$id);
		$query = $this->db->get('pensum');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['ano_lectivo'];
		}
		else{
			return false;
		}

	}*/


	public function llenar_asignaturas($id){

		$this->db->where('id_grado',$id);

		$this->db->join('asignaturas', 'pensum.id_asignatura = asignaturas.id_asignatura');
		$this->db->select('pensum.id_asignatura,asignaturas.nombre_asignatura');

		$query = $this->db->get('pensum');
		return $query->result();
	}


	public function llenar_grados(){

		$this->db->where('estado_grado','Activo');
		$query = $this->db->get('grados');
		return $query->result();
	}


	public function llenar_profesores(){

		$this->db->join('profesores', 'personas.id_persona = profesores.id_persona');
		$query = $this->db->get('personas');
		return $query->result();
	}








}