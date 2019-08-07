<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asistencias_a_model extends CI_Model {


	public function llenar_anos_lectivos(){

		$query = $this->db->get('anos_lectivos');
		return $query->result();
	}


	public function llenar_cursos($ano_lectivo){

		$this->db->where('cursos.ano_lectivo',$ano_lectivo);

		$this->db->order_by('grados_educacion.nivel_educacion', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');
		$this->db->order_by('cursos.jornada', 'asc');

		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');
		
		$query = $this->db->get('cursos');
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


	//Esta funcion me permite obtener las asignaturas por grado de la tabla pensum.
	public function llenar_asignaturas($id_grado,$ano_lectivo){

		$this->db->where('pensum.id_grado',$id_grado);
		$this->db->where('pensum.ano_lectivo',$ano_lectivo);

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->join('asignaturas', 'pensum.id_asignatura = asignaturas.id_asignatura');
		$this->db->select('pensum.id_asignatura,asignaturas.nombre_asignatura');

		$query = $this->db->get('pensum');
		return $query->result();
	}


	public function EstudiantesMatriculadosPorCurso($id_curso){

		$this->db->where('matriculas.id_curso',$id_curso);
		//$this->db->where('matriculas.estado_matricula',"Activo");

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('matriculas');

		return $query->result();

	}


	public function buscar_asistencia_estudiante($ano_lectivo,$id_curso,$id_asignatura,$id_estudiante,$periodo){

		$this->db->where('asistencias.ano_lectivo',$ano_lectivo);
		$this->db->where('asistencias.id_curso',$id_curso);
		$this->db->where('asistencias.id_asignatura',$id_asignatura);
		$this->db->where('asistencias.id_estudiante',$id_estudiante);
		$this->db->where('asistencias.periodo',$periodo);

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'asistencias.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'asistencias.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('asignaturas', 'asistencias.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('anos_lectivos', 'asistencias.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('asistencias.id_asistencia,asistencias.ano_lectivo,asistencias.id_profesor,asistencias.id_curso,asistencias.id_asignatura,asistencias.id_estudiante,asistencias.periodo,asistencias.fecha,asistencias.asistencia,asistencias.horas,asistencias.fecha_registro,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,asignaturas.nombre_asignatura,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('asistencias');

		return $query->result_array();
		
	}

}