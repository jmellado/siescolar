<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matriculas_model extends CI_Model {


	public function insertar_matricula($matricula){
		if ($this->db->insert('matriculas', $matricula)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($id_persona,$ano_lectivo){

		$this->db->where('id_estudiante',$id_persona);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_matricula($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('personas.identificacion',$id,'after');
		$this->db->or_like('personas.nombres',$id,'after');
		$this->db->or_like('personas.apellido1',$id,'after');
		$this->db->or_like('grados.nombre_grado',$id,'after');
		$this->db->or_like('grupos.nombre_grupo',$id,'after');
		$this->db->or_like('matriculas.jornada',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('salones_grupo', 'matriculas.id_salon = salones_grupo.id_salon');
		$this->db->join('grados', 'salones_grupo.id_grado = grados.id_grado');
		$this->db->join('grupos', 'salones_grupo.id_grupo = grupos.id_grupo');
		$this->db->join('anos_lectivos', 'matriculas.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('matriculas.id_matricula,matriculas.fecha_matricula,matriculas.ano_lectivo,matriculas.id_estudiante,matriculas.id_salon,grados.nombre_grado,grupos.nombre_grupo,matriculas.jornada,matriculas.observaciones,matriculas.estado_matricula,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('matriculas');

		return $query->result();
		
	}

	public function eliminar_matricula($id){

     	$this->db->where('id_matricula',$id);
		$consulta = $this->db->delete('matriculas');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    public function modificar_matricula($id,$matricula){

	
		$this->db->where('id_matricula',$id);

		if ($this->db->update('matriculas', $matricula))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_matricula');
		$query = $this->db->get('matriculas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_matricula'];
        return $data['query'];
	}


	public function buscar_estudiante($id){

		$this->db->where('personas.identificacion',$id);

		$this->db->join('estudiantes', 'personas.id_persona = estudiantes.id_persona');

		$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('personas');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else{
			return false;
		}

	}


	public function llenar_salones_grupo(){
		
		$this->db->join('grados', 'salones_grupo.id_grado = grados.id_grado');
		$this->db->join('grupos', 'salones_grupo.id_grupo = grupos.id_grupo');

		$this->db->select('salones_grupo.id_salon,salones_grupo.id_grado,salones_grupo.id_grupo,grados.nombre_grado,grupos.nombre_grupo');

		$query = $this->db->get('salones_grupo');
		return $query->result();
	}


	public function validar_existencia_por_identificacion($identificacion,$ano_lectivo){

		$this->db->where('personas.identificacion',$identificacion);
		$this->db->where('ano_lectivo',$ano_lectivo);

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	



}