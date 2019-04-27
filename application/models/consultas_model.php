<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Consultas_model extends CI_Model {

	//===== Funciones para consultar las notas de un estudiante desde el rol acudiente =====

	public function llenar_acudidos($id_acudiente){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.id_acudiente',$id_acudiente);

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.nombres,personas.apellido1,personas.apellido2');
		
		$query = $this->db->get('matriculas');
		return $query->result();
	}


	public function buscar_asignaturaNA($id_estudiante){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.id_estudiante',$id_estudiante);
		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->join('notas', 'matriculas.id_estudiante = notas.id_estudiante');
		$this->db->join('asignaturas', 'notas.id_asignatura = asignaturas.id_asignatura');

		$this->db->select('matriculas.id_estudiante,matriculas.id_curso,notas.id_asignatura,asignaturas.nombre_asignatura');

		$query = $this->db->get('matriculas');

		return $query->result();
		
	}


	// Esta funcion me permite obtener las notas por actividades de un estudiante en una asignatura
	public function buscar_actividadesNA($id_estudiante,$periodo,$id_curso,$id_asignatura){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('actividades.ano_lectivo',$ano_lectivo);
		$this->db->where('actividades.periodo',$periodo);
		$this->db->where('actividades.id_curso',$id_curso);
		$this->db->where('actividades.id_asignatura',$id_asignatura);
		$this->db->where('notas_actividades.id_estudiante',$id_estudiante);

		$this->db->join('actividades', 'notas_actividades.id_actividad = actividades.id_actividad');
		$this->db->join('personas', 'notas_actividades.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'actividades.id_curso = cursos.id_curso');
		$this->db->join('asignaturas', 'actividades.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');

		$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,notas_actividades.id_actividad,IFNULL(notas_actividades.nota,"Sin Nota") as nota,actividades.descripcion_actividad', false);
		
		$query = $this->db->get('notas_actividades');

		return $query->result();
	
	}


	//===== Funciones para consultar las notas de un estudiante desde el rol estudiante =====


	public function buscar_asignaturaNE($id_estudiante){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.id_estudiante',$id_estudiante);
		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->join('notas', 'matriculas.id_estudiante = notas.id_estudiante');
		$this->db->join('asignaturas', 'notas.id_asignatura = asignaturas.id_asignatura');

		$this->db->select('matriculas.id_estudiante,matriculas.id_curso,notas.id_asignatura,asignaturas.nombre_asignatura');

		$query = $this->db->get('matriculas');

		return $query->result();
		
	}


	// Esta funcion me permite obtener las notas por actividades de un estudiante en una asignatura
	public function buscar_actividadesNE($id_estudiante,$periodo,$id_curso,$id_asignatura){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('actividades.ano_lectivo',$ano_lectivo);
		$this->db->where('actividades.periodo',$periodo);
		$this->db->where('actividades.id_curso',$id_curso);
		$this->db->where('actividades.id_asignatura',$id_asignatura);
		$this->db->where('notas_actividades.id_estudiante',$id_estudiante);

		$this->db->join('actividades', 'notas_actividades.id_actividad = actividades.id_actividad');
		$this->db->join('personas', 'notas_actividades.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'actividades.id_curso = cursos.id_curso');
		$this->db->join('asignaturas', 'actividades.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');

		$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,notas_actividades.id_actividad,IFNULL(notas_actividades.nota,"Sin Nota") as nota,actividades.descripcion_actividad', false);
		
		$query = $this->db->get('notas_actividades');

		return $query->result();
	
	}


	//===== Funciones para consultar las asistencias de un estudiante desde el rol acudiente =====


	public function llenar_acudidosAA($id_acudiente){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.id_acudiente',$id_acudiente);

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.nombres,personas.apellido1,personas.apellido2');
		
		$query = $this->db->get('matriculas');
		return $query->result();
	}


	public function llenar_asignaturasAA($id_estudiante){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.id_estudiante',$id_estudiante);
		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->join('notas', 'matriculas.id_estudiante = notas.id_estudiante');
		$this->db->join('asignaturas', 'notas.id_asignatura = asignaturas.id_asignatura');

		$this->db->select('matriculas.id_estudiante,notas.id_asignatura,asignaturas.nombre_asignatura');

		$query = $this->db->get('matriculas');
		return $query->result();
		
	}


	public function buscar_asistenciasA($periodo,$id_estudiante,$id_asignatura){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('asistencias.ano_lectivo',$ano_lectivo);
		$this->db->where('asistencias.id_asignatura',$id_asignatura);
		$this->db->where('asistencias.id_estudiante',$id_estudiante);
		$this->db->where('asistencias.periodo',$periodo);

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');
		$this->db->order_by('asistencias.fecha', 'desc');

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


	//===== Funciones para consultar las tareas de un estudiante desde el rol acudiente =====


	public function llenar_acudidosTA($id_acudiente){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.id_acudiente',$id_acudiente);

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.nombres,personas.apellido1,personas.apellido2');
		
		$query = $this->db->get('matriculas');
		return $query->result();
	}


	public function llenar_asignaturasTA($id_estudiante){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.id_estudiante',$id_estudiante);
		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->join('notas', 'matriculas.id_estudiante = notas.id_estudiante');
		$this->db->join('asignaturas', 'notas.id_asignatura = asignaturas.id_asignatura');

		$this->db->select('matriculas.id_estudiante,notas.id_asignatura,asignaturas.nombre_asignatura');

		$query = $this->db->get('matriculas');
		return $query->result();
		
	}


	public function buscar_tareasA($buscar,$id_estudiante,$id_asignatura){

		if ($id_asignatura == "0") {

			$this->db->where('notificaciones.categoria_notificacion',"Tareas");
			$this->db->where('notificaciones.id_estudiante',$id_estudiante);

			$this->db->where("(notificaciones.titulo LIKE '".$buscar."%' OR notificaciones.fecha_fin LIKE '".$buscar."%' OR notificaciones.fecha_envio LIKE '".$buscar."%' OR asignaturas.nombre_asignatura LIKE '".$buscar."%')", NULL, FALSE);
		}
		else{

			$this->db->where('notificaciones.categoria_notificacion',"Tareas");
			$this->db->where('notificaciones.id_estudiante',$id_estudiante);
			$this->db->where('notificaciones.id_asignatura',$id_asignatura);

			$this->db->where("(notificaciones.titulo LIKE '".$buscar."%' OR notificaciones.fecha_fin LIKE '".$buscar."%' OR notificaciones.fecha_envio LIKE '".$buscar."%' OR asignaturas.nombre_asignatura LIKE '".$buscar."%')", NULL, FALSE);
		}

		$this->db->order_by('notificaciones.fecha_envio', 'desc');
		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->join('personas', 'notificaciones.id_estudiante = personas.id_persona');
		$this->db->join('asignaturas', 'notificaciones.id_asignatura = asignaturas.id_asignatura');

		$this->db->select('notificaciones.id_notificacion,notificaciones.codigo_notificacion,notificaciones.categoria_notificacion,notificaciones.remitente,notificaciones.titulo,notificaciones.tipo_notificacion,notificaciones.contenido,notificaciones.destinatario,notificaciones.rol_destinatario,notificaciones.id_estudiante,notificaciones.id_asignatura,notificaciones.fecha_fin,notificaciones.fecha_envio,notificaciones.estado_lectura,personas.nombres,personas.apellido1,personas.apellido2,asignaturas.nombre_asignatura');
		
		$query = $this->db->get('notificaciones');

		return $query->result_array();
		
	}


}