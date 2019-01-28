<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promocion_model extends CI_Model {


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


	// Esta funcion me permite actualizar el estado o situacion_academica de la matricula en la tabla matriculas.
	public function modificar_estado_matricula($jornada,$id_curso){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$estudiantes = $this->promocion_model->buscar_estudiantes_matriculados_curso($ano_lectivo,$id_curso);

		//NUEVA TRANSACCION
		$this->db->trans_start();

			for ($i=0; $i < count($estudiantes); $i++) { 
				
				$id_estudiante = $estudiantes[$i]['id_estudiante'];
				$situacion_academica = $this->promocion_model->calcular_situacion_academica($ano_lectivo,$id_estudiante,$id_curso);

				$matriculas = array('situacion_academica' => $situacion_academica);

				$this->db->where('ano_lectivo',$ano_lectivo);
				$this->db->where('id_estudiante',$id_estudiante);
				$this->db->update('matriculas', $matriculas);
			}


		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
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

		$this->db->select('matriculas.id_matricula,matriculas.fecha_matricula,matriculas.ano_lectivo,matriculas.id_estudiante,matriculas.id_curso,grados.nombre_grado,grupos.nombre_grupo,matriculas.jornada,matriculas.id_acudiente,matriculas.parentesco,matriculas.observaciones,matriculas.estado_matricula,matriculas.situacion_academica,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('matriculas');

		return $query->result_array();
		
	}


	//Esta funcion me permite calcular la situacion academica de un estudiante.
	public function calcular_situacion_academica($ano_lectivo,$id_estudiante,$id_curso){

		$situacion_academica = "";
		$criterios = $this->promocion_model->obtener_criterios_promocion($ano_lectivo,$id_curso);

		for ($i=0; $i < count($criterios); $i++) {

			$id_criterio = $criterios[$i]['id_criterio'];
			$codigo_criterio = $criterios[$i]['codigo_criterio'];
			$nombre_criterio = $criterios[$i]['nombre_criterio'];

			if ($codigo_criterio == 1) {

				//array sencillo para las asignaturas aprobadas y reprobadas
				$asignaturas_aprobadas = array();
				$asignaturas_reprobadas = array();

				$NotasAsignaturas = $this->promocion_model->obtener_NotasPorAsignaturas($ano_lectivo,$id_estudiante);

				$DesempenoBajo = $this->promocion_model->obtener_DesempenoBajo($ano_lectivo);
				$minino = $DesempenoBajo[0]['rango_inicial'];
				$maximo = $DesempenoBajo[0]['rango_final'];

				for ($j=0; $j < count($NotasAsignaturas); $j++) {

					$nota_final = $NotasAsignaturas[$j]['nota_final'];

					if ($nota_final >= $minino && $nota_final <= $maximo) {
						
						$asignaturas_reprobadas[] = $nota_final;
					}
					else{

						$asignaturas_aprobadas[] = $nota_final;
					}
					
				}

				$numero_areas_asignaturas = $criterios[$i]['numero_areas_asignaturas'];
				$TotalAsigReprob = count($asignaturas_reprobadas);

				if ($TotalAsigReprob >= $numero_areas_asignaturas) {

					$situacion_academica = "Reprobado";
					return $situacion_academica;
				}
				elseif ($TotalAsigReprob > 0 && $TotalAsigReprob < $numero_areas_asignaturas) {

					$situacion_academica = "Nivelacion";
					return $situacion_academica;
				}
				

			}
			if ($codigo_criterio == 2) {

				$inasistencias = $this->promocion_model->obtener_inasistencias($ano_lectivo,$id_estudiante);
				$horas_semanales = $this->promocion_model->obtener_horas_semanales($ano_lectivo,$id_curso);

				$horas_totales = 40 * $horas_semanales;

				if ($horas_totales > 0) {
					
					$PorcentajeI = round(($inasistencias / $horas_totales) * 100, 2);

					$porcentaje_inasistencias = $criterios[$i]['porcentaje_inasistencias'];

					if ($PorcentajeI > $porcentaje_inasistencias) {
						
						$situacion_academica = "Reprobado";
						return $situacion_academica;
					}

				}
				
			}
			if ($codigo_criterio == 3) {

				$AsigEsp_aprobadas = array();
				$AsigEsp_reprobadas = array();

				$AsigEsp = $this->promocion_model->obtener_AsignaturasEspecificas($ano_lectivo,$id_curso,$id_criterio);

				$DesempenoBajo = $this->promocion_model->obtener_DesempenoBajo($ano_lectivo);
				$minino = $DesempenoBajo[0]['rango_inicial'];
				$maximo = $DesempenoBajo[0]['rango_final'];

				for ($k=0; $k < count($AsigEsp); $k++) {

					$asignatura_especifica = $AsigEsp[$k]['asignatura_especifica'];

					$nota_final = $this->promocion_model->obtener_NotaPorAsignaturaEspecifica($ano_lectivo,$id_estudiante,$asignatura_especifica);
					
					if ($nota_final >= $minino && $nota_final <= $maximo) {
						
						$AsigEsp_reprobadas[] = $nota_final;
					}
					else{

						$AsigEsp_aprobadas[] = $nota_final;
					}
					
				}

				$Total_AsigEsp = count($AsigEsp);
				$Total_AsigEspReprob = count($AsigEsp_reprobadas);

				if ($Total_AsigEspReprob == $Total_AsigEsp) {

					$situacion_academica = "Reprobado";
					return $situacion_academica;
				}
				elseif ($Total_AsigEspReprob > 0 && $Total_AsigEspReprob < $Total_AsigEsp) {
					
					$situacion_academica = "Nivelacion";
					return $situacion_academica;
				}

				
			}
			
		}

		if ($situacion_academica == "") {

			return "Aprobado";
		}

	}


	//Esta Funcion me permite obtener los criterios de promocion asignados para el curso seleccionado
	public function obtener_criterios_promocion($ano_lectivo,$id_curso){

		$id_grado = $this->promocion_model->obtener_gradoDelcurso($id_curso);

		$this->db->where('criterios_asignados.ano_lectivo',$ano_lectivo);
		$this->db->where('criterios_asignados.id_grado',$id_grado);

		$this->db->order_by('criterios.prioridad', 'asc');

		$this->db->join('criterios', 'criterios_asignados.id_criterio = criterios.id_criterio');

		$this->db->select('DISTINCT(criterios_asignados.id_criterio),criterios_asignados.ano_lectivo,criterios_asignados.id_grado,criterios_asignados.numero_areas_asignaturas,criterios_asignados.porcentaje_inasistencias,criterios_asignados.asignatura_especifica,criterios.nombre_criterio,criterios.codigo_criterio,criterios.prioridad');

		$query = $this->db->get('criterios_asignados');

		if ($query->num_rows() > 0) {
		
        	return $query->result_array();
		}
		else{
			return false;
		}

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


	//1) FUNCIONES PARA CALCULAR (NUMERO DE AREAS O ASIGNATURAS REPROBADAS)


	public function obtener_NotasPorAsignaturas($ano_lectivo,$id_estudiante){

		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);

		$this->db->select('notas.id_estudiante,notas.id_grado,notas.id_asignatura,IFNULL(notas.nota_final, 0.0) as nota_final',false);

		$query = $this->db->get('notas');

		if ($query->num_rows() > 0) {
	
			$NotasAsignaturas = $query->result_array();
        	return $NotasAsignaturas;
        }
		else{

			return false;
		}

	}


	public function obtener_DesempenoBajo($ano_lectivo){

		$this->db->where('desempenos.ano_lectivo',$ano_lectivo);
		$this->db->where('desempenos.nombre_desempeno','Bajo');

		$this->db->select('desempenos.id_desempeno,desempenos.nombre_desempeno,desempenos.rango_inicial,desempenos.rango_final,desempenos.ano_lectivo');

		$query = $this->db->get('desempenos');

		if ($query->num_rows() > 0) {
		
        	return $query->result_array();
		}
		else{
			return false;
		}

	}


	//2) FUNCIONES PARA CALCULAR (PORCENTAJE TOTAL DE INASISTENCIAS)


	public function obtener_inasistencias($ano_lectivo,$id_estudiante){

		$this->db->where('asistencias.ano_lectivo',$ano_lectivo);
		$this->db->where('asistencias.id_estudiante',$id_estudiante);
		$this->db->where('asistencias.asistencia','Faltó');

		$this->db->select('asistencias.ano_lectivo,asistencias.id_estudiante');

		$query = $this->db->get('asistencias');

		if ($query->num_rows() > 0) {
		
        	return count($query->result_array());
		}
		else{
			return 0;
		}

	}


	public function obtener_horas_semanales($ano_lectivo,$id_curso){

		$id_grado = $this->promocion_model->obtener_gradoDelcurso($id_curso);

		$this->db->where('pensum.ano_lectivo',$ano_lectivo);
		$this->db->where('pensum.id_grado',$id_grado);

		$this->db->select('SUM(pensum.intensidad_horaria) as horas_semanales',false);

		$query = $this->db->get('pensum');

		if ($query->num_rows() > 0) {
		
        	$row = $query->result_array();
        	return $row[0]['horas_semanales'];
		}
		else{
			return 0;
		}

	}


	//3) FUNCIONES PARA CALCULAR (REPROBACION POR PERDIDA DE ASIGNATURAS ESPECIFICAS)


	//Esta Funcion me permite obtener las asignaturas seleccionadas como criterio de promocion
	public function obtener_AsignaturasEspecificas($ano_lectivo,$id_curso,$id_criterio){

		$id_grado = $this->promocion_model->obtener_gradoDelcurso($id_curso);

		$this->db->where('criterios_asignados.ano_lectivo',$ano_lectivo);
		$this->db->where('criterios_asignados.id_grado',$id_grado);
		$this->db->where('criterios_asignados.id_criterio',$id_criterio);

		$this->db->select('criterios_asignados.id_criterio,criterios_asignados.ano_lectivo,criterios_asignados.id_grado,criterios_asignados.asignatura_especifica');

		$query = $this->db->get('criterios_asignados');

		if ($query->num_rows() > 0) {
		
        	return $query->result_array();
		}
		else{
			return false;
		}

	}


	public function obtener_NotaPorAsignaturaEspecifica($ano_lectivo,$id_estudiante,$asignatura_especifica){

		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.id_asignatura',$asignatura_especifica);

		$this->db->select('notas.id_estudiante,notas.id_grado,notas.id_asignatura,IFNULL(notas.nota_final, 0.0) as nota_final',false);

		$query = $this->db->get('notas');

		if ($query->num_rows() > 0) {
	
			$NotaAsigEsp = $query->result_array();
        	return $NotaAsigEsp[0]['nota_final'];
        }
		else{

			return false;
		}

	}


	//============================ VALIDACIONES =============================


	//Esta Funcion me permite obtener el numero total de periodos de evaluacion registrados o creados
    public function PeriodosRegistrados(){

    	$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		
    	$this->db->where('id_categoria',"1");
    	$this->db->where('ano_lectivo',$ano_lectivo);

		$query = $this->db->get('cronogramas');

		if ($query->num_rows() > 0) {
			return count($query->result());
		}
		else{
			return 0;
		}

	}


	//Esta Funcion me permite obtener el numero total de periodos de evaluacion con estado activo
    public function PeriodosActivos(){

    	$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		
    	$this->db->where('id_categoria',"1");
    	$this->db->where('ano_lectivo',$ano_lectivo);
    	$this->db->where('estado_actividad',"Activo");

		$query = $this->db->get('cronogramas');

		if ($query->num_rows() > 0) {
			return count($query->result());
		}
		else{
			return 0;
		}

	}


	//Esta Funcion me permite obtener el numero total de periodos de evaluacion con estado cerrado
    public function PeriodosCerrados(){

    	$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		
    	$this->db->where('id_categoria',"1");
    	$this->db->where('ano_lectivo',$ano_lectivo);
    	$this->db->where('estado_actividad',"Cerrado");

		$query = $this->db->get('cronogramas');

		if ($query->num_rows() > 0) {
			return count($query->result());
		}
		else{
			return 0;
		}

	}


	//Esta Funcion me permite validar si un curso tiene criterios de promocion asignados.
	public function validar_existencia_criterios($id_curso){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$id_grado = $this->promocion_model->obtener_gradoDelcurso($id_curso);

		$this->db->where('criterios_asignados.ano_lectivo',$ano_lectivo);
		$this->db->where('criterios_asignados.id_grado',$id_grado);

		$this->db->select('criterios_asignados.id_criterio_asignado,criterios_asignados.ano_lectivo,criterios_asignados.id_grado,criterios_asignados.id_criterio');

		$query = $this->db->get('criterios_asignados');

		if ($query->num_rows() > 0) {
		
        	return true;
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