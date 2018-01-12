<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbox_model extends CI_Model {


	public function buscar_estudiante($id,$id_curso,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		
		$this->db->where("(personas.nombres LIKE '".$id."%' OR personas.apellido1 LIKE '".$id."%' OR personas.apellido2 LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('estudiantes', 'matriculas.id_estudiante = estudiantes.id_persona');

		$this->db->select('matriculas.id_acudiente,personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2');
		
		$query = $this->db->get('matriculas');

		return $query->result();
	
	}


}