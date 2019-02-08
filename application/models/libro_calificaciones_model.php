<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Libro_calificaciones_model extends CI_Model {


	public function llenar_anos_lectivos(){

		$query = $this->db->get('anos_lectivos');
		return $query->result();
	}


	//llenar el combo con todos los cursos de una respectiva jornada
	public function llenar_cursos($ano_lectivo,$jornada){

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


	public function obtener_informacion_colegio(){

		$this->db->join('paises', 'datos_institucion.pais_ubicacion = paises.id_pais');
		$this->db->join('departamentos', 'datos_institucion.departamento_ubicacion = departamentos.id_departamento');
		$this->db->join('municipios', 'datos_institucion.municipio_ubicacion = municipios.id_municipio');

		$query = $this->db->get('datos_institucion');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
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


	//Esta funcion me permite obtener todos los estudiantes matriculados en un respectivo curso y año lectivo
	public function buscar_estudiantes_matriculados_curso($ano_lectivo,$id_curso){

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.id_curso',$id_curso);

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'matriculas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('anos_lectivos', 'matriculas.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('matriculas.id_matricula,matriculas.fecha_matricula,matriculas.ano_lectivo,matriculas.id_estudiante,matriculas.id_curso,grados.nombre_grado,grupos.nombre_grupo,matriculas.jornada,matriculas.id_acudiente,matriculas.parentesco,matriculas.observaciones,matriculas.estado_matricula,matriculas.situacion_academica,personas.identificacion,personas.tipo_id,personas.nombres,personas.apellido1,personas.apellido2,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('matriculas');

		return $query->result_array();
		
	}


	public function obtener_NotasPorEstudiante($ano_lectivo,$id_estudiante,$id_grado){

		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.id_grado',$id_grado);

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->join('asignaturas', 'notas.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('desempenos', 'notas.id_desempeno = desempenos.id_desempeno');

		$this->db->select('notas.id_estudiante,notas.id_grado,notas.id_asignatura,IFNULL(notas.p1, 0.0) as p1,IFNULL(notas.p2, 0.0) as p2,IFNULL(notas.p3, 0.0) as p3,IFNULL(notas.p4, 0.0) as p4,IFNULL(notas.definitiva, 0.0) as definitiva,IF(notas.fallas = "","0", notas.fallas) as fallas,asignaturas.nombre_asignatura,desempenos.nombre_desempeno',false);

		$query = $this->db->get('notas');

		if ($query->num_rows() > 0) {
	
			$notas = $query->result_array();
        	return $notas;
        }
		else{

			return false;
		}

	}


	public function obtener_Desempenos($ano_lectivo){

		$this->db->where('desempenos.ano_lectivo',$ano_lectivo);

		$this->db->select('desempenos.id_desempeno,desempenos.nombre_desempeno,desempenos.rango_inicial,desempenos.rango_final,desempenos.ano_lectivo');

		$query = $this->db->get('desempenos');

		if ($query->num_rows() > 0) {
		
        	return $query->result_array();
		}
		else{
			return false;
		}

	}


	//funcion para obtener las inasistencias por estudiante en una determinada asignatura
	public function obtener_inasistencias($ano_lectivo,$id_asignatura,$id_estudiante){

		$this->db->where('asistencias.ano_lectivo',$ano_lectivo);
		$this->db->where('asistencias.id_asignatura',$id_asignatura);
		$this->db->where('asistencias.id_estudiante',$id_estudiante);
		$this->db->where('asistencias.asistencia','Faltó');

		$this->db->select('asistencias.ano_lectivo,asistencias.id_asignatura,asistencias.id_estudiante');

		$query = $this->db->get('asistencias');

		if ($query->num_rows() > 0) {
		
        	return count($query->result_array());
		}
		else{
			return 0;
		}

	}




}