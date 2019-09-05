<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exportar_logros_model extends CI_Model {


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


	//Esta funcion me permite obtener las asignaturas por grado de la tabla pensum.
	public function llenar_asignaturas($id_grado){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('pensum.id_grado',$id_grado);
		$this->db->where('pensum.ano_lectivo',$ano_lectivo);

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->join('asignaturas', 'pensum.id_asignatura = asignaturas.id_asignatura');
		$this->db->select('pensum.id_asignatura,asignaturas.nombre_asignatura');

		$query = $this->db->get('pensum');
		return $query->result();
	}


	//Esta Funcion me permite obtener el id_grado del curso seleccionado
	public function obtener_gradoPorcurso($id_curso){

		$this->db->where('cursos.id_curso',$id_curso);

		$this->db->select('cursos.id_grado');

		$query = $this->db->get('cursos');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['id_grado'];
		}
		else{
			return false;
		}

	}


	public function obtener_informacion_curso($id_curso){

		$this->db->where('cursos.id_curso',$id_curso);

		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('personas', 'cursos.director = personas.id_persona');
		$this->db->join('anos_lectivos', 'cursos.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$query = $this->db->get('cursos');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
		}
		else{
			return false;
		}

	}


	public function EstudiantesMatriculadosPorCurso($id_curso){

		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('matriculas.estado_matricula',"Activo");

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.identificacion,personas.tipo_id,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('matriculas');

		return $query->result_array();

	}


	public function obtener_informacion_asignatura($id_asignatura){

		$this->db->where('asignaturas.id_asignatura',$id_asignatura);

		$query = $this->db->get('asignaturas');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
		}
		else{
			return false;
		}

	}


	public function convertir_periodo($periodo){

		if ($periodo == "Primero") {

			$period = "p1";
		}
		elseif ($periodo == "Segundo") {

			$period = "p2";
		}
		elseif ($periodo == "Tercero") {

			$period = "p3";
		}
		elseif ($periodo == "Cuarto") {

			$period = "p4";
		}

		return $period;
	}


	public function obtener_NotaPorAsignatura($ano_lectivo,$id_estudiante,$id_grado,$id_asignatura,$period){

		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.id_grado',$id_grado);
		$this->db->where('notas.id_asignatura',$id_asignatura);

		$this->db->select('notas.p1,notas.p2,notas.p3,notas.p4');

		$query = $this->db->get('notas');

		if ($query->num_rows() > 0) {
			
			$row = $query->result_array();
			return $row[0][$period];
		}
		else{
			return false;
		}

	}


	// Esta funcion permite obtener los logros registrados por un profesor
	public function obtener_logros($periodo,$id_curso,$id_grado,$id_asignatura,$ano_lectivo){

		$id_profesor = $this->exportar_logros_model->obtener_profesor($id_curso,$id_asignatura,$ano_lectivo);

		$this->db->where('logros.periodo',$periodo);
		$this->db->where('logros.id_profesor',$id_profesor);
		$this->db->where('logros.id_grado',$id_grado);
		$this->db->where('logros.id_asignatura',$id_asignatura);
		$this->db->where('logros.ano_lectivo',$ano_lectivo);

		$this->db->select('logros.id_logro,logros.nombre_logro,logros.descripcion_logro');

		$query = $this->db->get('logros');

		if ($query->num_rows() > 0) {
			
			return $query->result_array();

		}
		else{
			return false;
		}

	}


	// Esta funcion permite obtener el profesor que dicta una asignatura
	public function obtener_profesor($id_curso,$id_asignatura,$ano_lectivo){

		$this->db->where('cargas_academicas.id_curso',$id_curso);
		$this->db->where('cargas_academicas.id_asignatura',$id_asignatura);
		$this->db->where('cargas_academicas.ano_lectivo',$ano_lectivo);

		$this->db->select('cargas_academicas.id_profesor');

		$query = $this->db->get('cargas_academicas');

		if ($query->num_rows() > 0) {
			
			$row = $query->result_array();
			return $row[0]['id_profesor'];
		}
		else{
			return false;
		}

	}

}