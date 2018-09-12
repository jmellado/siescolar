<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Horarios_model extends CI_Model {


	//llenar el combo con todos los cursos de una respectiva jornada
	public function llenar_cursos($jornada){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cursos.jornada',$jornada);
		$this->db->where('cursos.ano_lectivo',$ano_lectivo);

		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');

		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');
		
		$query = $this->db->get('cursos');
		return $query->result();
	}


	//Esta funcion me permite obtener las materias a cursar por un determinado grado dependiendo del pensum
	public function llenar_asignaturas_pensum($id_curso){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$id_grado = $this->horarios_model->obtener_gradoPorcurso($id_curso);

		$this->db->where('pensum.id_grado',$id_grado);
		$this->db->where('pensum.ano_lectivo',$ano_lectivo);
		
		$this->db->join('asignaturas', 'pensum.id_asignatura = asignaturas.id_asignatura');

		$this->db->select('pensum.id_asignatura,pensum.intensidad_horaria,asignaturas.nombre_asignatura');

		$query = $this->db->get('pensum');
		return $query->result();
	}


	//Esta Funcion me permite obtener el grado del curso seleccionado
	public function obtener_gradoPorcurso($id_curso){

		$this->db->where('cursos.id_curso',$id_curso);

		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');

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


	public function buscar_horario($id,$id_curso,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('horarios.id_curso',$id_curso);
		$this->db->where('horarios.ano_lectivo',$ano_lectivo);

		$this->db->join('asignaturas as lu', 'horarios.lunes = lu.id_asignatura');
		$this->db->join('asignaturas as ma', 'horarios.martes = ma.id_asignatura');
		$this->db->join('asignaturas as mi', 'horarios.miercoles = mi.id_asignatura');
		$this->db->join('asignaturas as ju', 'horarios.jueves = ju.id_asignatura');
		$this->db->join('asignaturas as vi', 'horarios.viernes = vi.id_asignatura');
		$this->db->join('asignaturas as sa', 'horarios.sabado = sa.id_asignatura');
		$this->db->join('asignaturas as do', 'horarios.domingo = do.id_asignatura');

		//$this->db->select('horarios.id_horario,horarios.id_curso,horarios.hora,horarios.lunes,horarios.martes,horarios.miercoles,horarios.jueves,horarios.viernes,horarios.sabado,horarios.domingo,horarios.ano_lectivo');

		$this->db->select('horarios.id_horario,horarios.id_curso,horarios.hora,IF(horarios.lunes = "1","", horarios.lunes) as lunes,IF(horarios.martes = "1","", horarios.martes) as martes,IF(horarios.miercoles = "1","", horarios.miercoles) as miercoles,IF(horarios.jueves = "1","", horarios.jueves) as jueves,IF(horarios.viernes = "1","", horarios.viernes) as viernes,IF(horarios.sabado = "1","", horarios.sabado) as sabado,IF(horarios.domingo = "1","", horarios.domingo) as domingo,horarios.ano_lectivo,lu.nombre_asignatura as asiglunes,ma.nombre_asignatura as asigmartes,mi.nombre_asignatura as asigmiercoles,ju.nombre_asignatura as asigjueves,vi.nombre_asignatura as asigviernes,sa.nombre_asignatura as asigsabado,do.nombre_asignatura as asigdomingo',false);
		
		$query = $this->db->get('horarios');

		return $query->result();
	
	}


	public function modificar_horario($id_curso,$id_asignatura,$dias){

		//NUEVA TRANSACCION
		$this->db->trans_start();

		for ($i=0; $i < count($dias) ; $i++) {

			$d = $dias[$i];
			$d = explode("-", $d);

			$dia = $d[0];
			$hora = $d[1];

			//array para actualizar en la tabla horarios
        	$horario = array(
			'id_curso' =>$id_curso,
			$dia =>$id_asignatura);

        	$this->db->where('id_curso',$id_curso);
        	$this->db->where('hora',$hora);
			$this->db->update('horarios', $horario);

		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}

	}


	//Esta funcion permite validar que el numero de horas que se esta ingresando, 
	//no supere la intensidad horaria permitida para una asignatura de acuerdo al pensum.
	public function validar_intensidad_horaria($id_curso,$id_asignatura,$dias){

		$intensidad_horaria = $this->horarios_model->obtener_IntensidadHorariaPorAsignatura($id_curso,$id_asignatura);
		
		if (count($dias) <= $intensidad_horaria) {

			return true;
		}
		else{

			return false;
		}

	}


	//Esta funcion permite validar que el numero de horas registradas no supere
	//la intensidad horaria permitida para una asignatura.
	public function validar_horas_registradas($id_curso,$id_asignatura,$dias){

		$intensidad_horaria = $this->horarios_model->obtener_IntensidadHorariaPorAsignatura($id_curso,$id_asignatura);
		$horas_registradas = $this->horarios_model->obtener_HorasRegistradasPorAsignatura($id_curso,$id_asignatura);

		$sum = count($dias) + $horas_registradas;
		
		if ($sum <= $intensidad_horaria) {

			return true;
		}
		else{

			return false;
		}

	}


	//permite obtener el maximo de horas permitidas para una asignatura de acuerdo al pensum
	public function obtener_IntensidadHorariaPorAsignatura($id_curso,$id_asignatura){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$id_grado = $this->horarios_model->obtener_gradoPorcurso($id_curso);

		$this->db->where('pensum.id_grado',$id_grado);
		$this->db->where('pensum.id_asignatura',$id_asignatura);
		$this->db->where('pensum.ano_lectivo',$ano_lectivo);

		$this->db->select('pensum.id_asignatura,pensum.intensidad_horaria');

		$query = $this->db->get('pensum');
		
		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['intensidad_horaria'];
		}
		else{
			return false;
		}

	}


	//permite obtener el numero de horas registradas por asignatura en un horario.
	public function obtener_HorasRegistradasPorAsignatura($id_curso,$id_asignatura){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('horarios.id_curso',$id_curso);
		$this->db->where('horarios.ano_lectivo',$ano_lectivo);

		$this->db->select('horarios.lunes,horarios.martes,horarios.miercoles,horarios.jueves,horarios.viernes,horarios.sabado,horarios.domingo');

		$query = $this->db->get('horarios');

		$horarios = $query->result_array();

		$cont_lunes = 0;
		$cont_martes = 0;
		$cont_miercoles = 0;
		$cont_jueves = 0;
		$cont_viernes = 0;
		$cont_sabado = 0;
		$cont_domingo = 0;
		$cont_general = 0;

		for ($i=0; $i < count($horarios); $i++) { 
			
			if ($horarios[$i]['lunes'] == $id_asignatura) {
				$cont_lunes = $cont_lunes + 1;
			}
			if ($horarios[$i]['martes'] == $id_asignatura) {
				$cont_martes = $cont_martes + 1;
			}
			if ($horarios[$i]['miercoles'] == $id_asignatura) {
				$cont_miercoles = $cont_miercoles + 1;
			}
			if ($horarios[$i]['jueves'] == $id_asignatura) {
				$cont_jueves = $cont_jueves + 1;
			}
			if ($horarios[$i]['viernes'] == $id_asignatura) {
				$cont_viernes = $cont_viernes + 1;
			}
			if ($horarios[$i]['sabado'] == $id_asignatura) {
				$cont_sabado = $cont_sabado + 1;
			}
			if ($horarios[$i]['domingo'] == $id_asignatura) {
				$cont_domingo = $cont_domingo + 1;
			}
		}

		$cont_general = $cont_lunes + $cont_martes + $cont_miercoles + $cont_jueves + $cont_viernes + $cont_sabado + $cont_domingo;

		return $cont_general;


	}




}