<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notas_progreso_model extends CI_Model {


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


	public function buscar_notasprogreso($jornada,$id_curso,$periodo){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$id_grado = $this->notas_progreso_model->obtener_gradoDelcurso($id_curso);
		$asignaturas = $this->notas_progreso_model->obtener_asignaturasPorgrado($id_grado);
		$estudiantes = $this->notas_progreso_model->buscar_estudiantes_matriculados_curso($ano_lectivo,$id_curso);

		$listado_asignaturas_progreso = array();

		for ($i=0; $i < count($asignaturas); $i++) {

			$id_asignatura = $asignaturas[$i]['id_asignatura'];

			$progreso = $this->notas_progreso_model->calcular_progreso_asignatura($ano_lectivo,$estudiantes,$id_grado,$id_asignatura,$periodo);

			$asignatura_progreso = array(

				'id_asignatura' 	=> $asignaturas[$i]['id_asignatura'],
				'nombre_asignatura' => $asignaturas[$i]['nombre_asignatura'],
				'progreso' 			=> $progreso

			);

			$listado_asignaturas_progreso[] = $asignatura_progreso;
			
		}


		return $listado_asignaturas_progreso;
	
	}


	//Esta Funcion me permite obtener el id_grado del curso seleccionado
	public function obtener_gradoDelcurso($id_curso){

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


	//Esta funcion me permite obtener las materias a cursar por un determinado grado dependiendo del pensum
	public function obtener_asignaturasPorgrado($id_grado){

		$this->db->where('id_grado',$id_grado);

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->join('asignaturas', 'pensum.id_asignatura = asignaturas.id_asignatura');
		$this->db->select('pensum.id_asignatura,asignaturas.nombre_asignatura');

		$query = $this->db->get('pensum');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
		}
		else{
			return false;
		}
		
	}


	//Esta funcion me permite obtener todos los estudiantes matriculados en un respectivo curso y año lectivo
	public function buscar_estudiantes_matriculados_curso($ano_lectivo,$id_curso){

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('matriculas.estado_matricula',"Activo");

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.nombres,personas.apellido1,personas.apellido2');
		
		$query = $this->db->get('matriculas');

		return $query->result_array();
		
	}


	//Esta funcion permite calcular el progreso en el registro de notas de una asignatura
	public function calcular_progreso_asignatura($ano_lectivo,$estudiantes,$id_grado,$id_asignatura,$periodo){

		$estudiantes_connotas = array();

		for ($i=0; $i < count($estudiantes); $i++) { 
			
			$id_estudiante = $estudiantes[$i]['id_estudiante'];

			$NotaAsignatura = $this->notas_progreso_model->obtener_NotaPorAsignatura($ano_lectivo,$id_estudiante,$id_grado,$id_asignatura,$periodo);

			if ($NotaAsignatura != NULL) {
				
				$estudiantes_connotas[] = $id_estudiante;
			}

		}

		$progreso = round((count($estudiantes_connotas) * 100) / count($estudiantes), 0);

		return $progreso;

	}


	//Esta funcion permite obtener por estudiante la nota en una determinada asignatura y periodo
	public function obtener_NotaPorAsignatura($ano_lectivo,$id_estudiante,$id_grado,$id_asignatura,$periodo){

		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.id_grado',$id_grado);
		$this->db->where('notas.id_asignatura',$id_asignatura);

		$this->db->select('notas.id_estudiante,notas.id_asignatura,notas.p1,notas.p2,notas.p3,notas.p4');

		$query = $this->db->get('notas');

		if ($query->num_rows() > 0) {
			
			$notas = $query->result_array();

			if ($periodo == "Primero") {

				$nota_asignatura = $notas[0]['p1'];
			}
			if ($periodo == "Segundo") {

				$nota_asignatura = $notas[0]['p2'];
			}
			if ($periodo == "Tercero") {

				$nota_asignatura = $notas[0]['p3'];
			}
			if ($periodo == "Cuarto") {

				$nota_asignatura = $notas[0]['p4'];
			}

			return $nota_asignatura;

		}
		else{

			return false;
		}

	}


	//valido si existen estudiantes matriculados en un respectivo curso
	public function validar_existencia_estudiantes($id_curso){

		$this->db->where('id_curso',$id_curso);
		$this->db->where('estado_matricula',"Activo");
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return true;
		}
		else{
			return false;
		}

	}


}