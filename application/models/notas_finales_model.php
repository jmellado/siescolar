<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notas_finales_model extends CI_Model {


	//llenar el combo con todos los cursos de una respectiva jornada
	public function llenar_cursos($jornada){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cursos.jornada',$jornada);
		$this->db->where('cursos.ano_lectivo',$ano_lectivo);

		$this->db->order_by('grados_educacion.nivel_educacion', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');

		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');
		
		$query = $this->db->get('cursos');
		return $query->result();
	}


	public function llenar_estudiantes($id_curso){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.estado_matricula',"Activo");

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.nombres,personas.apellido1,personas.apellido2');

		$query = $this->db->get('matriculas');
		return $query->result();

	}


	public function buscar_notas($jornada,$id_curso,$id_estudiante){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->join('personas', 'notas.id_estudiante = personas.id_persona');
		$this->db->join('estudiantes', 'notas.id_estudiante = estudiantes.id_persona');
		$this->db->join('asignaturas', 'notas.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('desempenos', 'notas.id_desempeno = desempenos.id_desempeno','left');

		$this->db->select('notas.id_nota,notas.ano_lectivo,notas.id_estudiante,notas.id_grado,notas.id_asignatura,IFNULL(notas.p1,"") as p1,IFNULL(notas.p2,"") as p2,IFNULL(notas.p3,"") as p3,IFNULL(notas.p4,"") as p4,IFNULL(notas.nota_final,"") as nota_final,IFNULL(notas.definitiva,"") as definitiva,notas.id_desempeno,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,asignaturas.nombre_asignatura,IFNULL(desempenos.nombre_desempeno, "") as nombre_desempeno', false);
		
		$query = $this->db->get('notas');

		return $query->result();
	
	}


}