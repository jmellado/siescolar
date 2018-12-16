<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asistencias_model extends CI_Model {


	public function llenar_cursos_profesor($id_profesor){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cargas_academicas.id_profesor',$id_profesor);
		$this->db->where('cargas_academicas.ano_lectivo',$ano_lectivo);

		$this->db->join('cursos', 'cargas_academicas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');

		$this->db->select('DISTINCT(cargas_academicas.id_curso),grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');

		$query = $this->db->get('cargas_academicas');
		return $query->result();
	}


	public function llenar_asignaturas_profesor($id_profesor,$id_curso){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cargas_academicas.id_profesor',$id_profesor);
		$this->db->where('cargas_academicas.id_curso',$id_curso);
		$this->db->where('cargas_academicas.ano_lectivo',$ano_lectivo);
		
		$this->db->join('asignaturas', 'cargas_academicas.id_asignatura = asignaturas.id_asignatura');

		$this->db->select('DISTINCT(cargas_academicas.id_asignatura),asignaturas.nombre_asignatura');

		$query = $this->db->get('cargas_academicas');
		return $query->result();
	}


	//Esta funcion me permite obtener todos los estudiantes matriculados en un respectivo curso y año lectivo
	public function buscar_estudiantes_matriculados_curso($id_curso){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('matriculas.estado_matricula',"Activo");

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'matriculas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('anos_lectivos', 'matriculas.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('matriculas.id_matricula,matriculas.fecha_matricula,matriculas.ano_lectivo,matriculas.id_estudiante,matriculas.id_curso,grados.nombre_grado,grupos.nombre_grupo,matriculas.jornada,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('matriculas');

		return $query->result_array();
		
	}


	public function insertar_asistencia($ano_lectivo,$id_profesor,$id_curso,$id_asignatura,$estudiantes,$periodo,$fecha,$asistencias,$fecha_registro){

		if ($estudiantes != false) {
			
			$this->db->trans_start();

				for ($i=0; $i < count($estudiantes); $i++) {

					$asistencia = array(
		        	'ano_lectivo' 	=>$ano_lectivo,
		        	'id_profesor' 	=>$id_profesor,
		        	'id_curso' 		=>$id_curso,
		        	'id_asignatura' =>$id_asignatura,
					'id_estudiante' =>$estudiantes[$i],
					'periodo' 		=>$periodo,
					'fecha' 		=>$fecha,
					'asistencia'	=>$asistencias[$i],
					'fecha_registro'=>$fecha_registro);

					$this->db->insert('asistencias', $asistencia);
				}
			
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE){

				return false;
			}
			else{

				return true;
			}
		}
		else{

			return false;
		}

	}


	public function validar_existencia($id_profesor,$id_curso,$id_asignatura,$periodo,$fecha){

		$this->db->where('id_profesor',$id_profesor);
		$this->db->where('id_curso',$id_curso);
		$this->db->where('id_asignatura',$id_asignatura);
		$this->db->where('periodo',$periodo);
		$this->db->where('fecha',$fecha);
		$query = $this->db->get('asistencias');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function buscar_asistencia($id_profesor,$id_curso,$id_asignatura,$periodo,$fecha){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('asistencias.ano_lectivo',$ano_lectivo);
		$this->db->where('asistencias.id_profesor',$id_profesor);
		$this->db->where('asistencias.id_curso',$id_curso);
		$this->db->where('asistencias.id_asignatura',$id_asignatura);
		$this->db->where('asistencias.periodo',$periodo);
		$this->db->where('asistencias.fecha',$fecha);

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'asistencias.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'asistencias.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('asignaturas', 'asistencias.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('anos_lectivos', 'asistencias.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('asistencias.id_asistencia,asistencias.ano_lectivo,asistencias.id_profesor,asistencias.id_curso,asistencias.id_asignatura,asistencias.id_estudiante,asistencias.periodo,asistencias.fecha,asistencias.asistencia,asistencias.fecha_registro,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,asignaturas.nombre_asignatura,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('asistencias');

		return $query->result_array();
		
	}




}
