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
		$fecha_registro = $this->funciones_globales_model->obtener_fecha_actual2();

		$id_grado = $this->promocion_model->obtener_gradoDelcurso($id_curso);

		$estudiantes = $this->promocion_model->buscar_estudiantes_matriculados_curso($ano_lectivo,$id_curso);

		//NUEVA TRANSACCION
		$this->db->trans_start();

			for ($i=0; $i < count($estudiantes); $i++) { 
				
				$id_estudiante = $estudiantes[$i]['id_estudiante'];
				$situacion_academica = $this->promocion_model->calcular_situacion_academica($ano_lectivo,$id_estudiante,$id_curso,$id_grado);
				$AsigReprob = $this->promocion_model->calcular_asignaturas_reprobadas($ano_lectivo,$id_estudiante,$id_grado);
				$AreasReprob = $this->promocion_model->calcular_areas_reprobadas($ano_lectivo,$id_estudiante,$id_grado);
				$fallas = $this->promocion_model->calcular_inasistencias($ano_lectivo,$id_estudiante,$id_curso,$id_grado);

				$matriculas = array('situacion_academica' => $situacion_academica[0]);

				$promocion = array(
				'ano_lectivo'              => $ano_lectivo,
				'id_estudiante'            => $id_estudiante,
				'id_curso'                 => $id_curso,
				'asignaturas_reprobadas'   => $AsigReprob,
				'areas_reprobadas'         => $AreasReprob,
				'inasistencias'            => $fallas[0],
				'porcentaje_inasistencias' => $fallas[1],
				'situacion_academica'      => $situacion_academica[0],
				'causa'                    => $situacion_academica[1],
				'fecha_registro'           => $fecha_registro);

				$this->db->where('ano_lectivo',$ano_lectivo);
				$this->db->where('id_estudiante',$id_estudiante);
				$this->db->where('id_curso',$id_curso);
				$this->db->update('matriculas', $matriculas);

				$this->db->where('ano_lectivo',$ano_lectivo);
				$this->db->where('id_estudiante',$id_estudiante);
				$this->db->where('id_curso',$id_curso);
				$this->db->update('promocion', $promocion);
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
	public function calcular_situacion_academica($ano_lectivo,$id_estudiante,$id_curso,$id_grado){

		$situacion_academica = array();
		$criterios = $this->promocion_model->obtener_criterios_promocion($ano_lectivo,$id_grado);

		for ($i=0; $i < count($criterios); $i++) {

			$id_criterio = $criterios[$i]['id_criterio'];
			$codigo_criterio = $criterios[$i]['codigo_criterio'];
			$nombre_criterio = $criterios[$i]['nombre_criterio'];

			if ($codigo_criterio == 1) {

				//array sencillo para las asignaturas aprobadas y reprobadas
				$asignaturas_aprobadas = array();
				$asignaturas_reprobadas = array();

				$NotasAsignaturas = $this->promocion_model->obtener_NotasPorAsignaturas($ano_lectivo,$id_estudiante,$id_grado);

				$DesempenoBajo = $this->promocion_model->obtener_DesempenoBajo($ano_lectivo);
				$minino = $DesempenoBajo[0]['rango_inicial'];
				$maximo = $DesempenoBajo[0]['rango_final'];

				for ($j=0; $j < count($NotasAsignaturas); $j++) {

					$nota_final = $NotasAsignaturas[$j]['definitiva'];

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

					$situacion_academica = array("Reprobado",$nombre_criterio);
					return $situacion_academica;
				}
				elseif ($TotalAsigReprob > 0 && $TotalAsigReprob < $numero_areas_asignaturas) {

					$situacion_academica = array("Nivelacion",$nombre_criterio);
					return $situacion_academica;
				}
				

			}
			if ($codigo_criterio == 2) {

				$inasistencias = $this->promocion_model->obtener_inasistencias($ano_lectivo,$id_estudiante);
				$horas_semanales = $this->promocion_model->obtener_horas_semanales($ano_lectivo,$id_grado);

				$horas_totales = 40 * $horas_semanales;

				if ($horas_totales > 0) {
					
					$PorcentajeI = round(($inasistencias / $horas_totales) * 100, 2);

					$porcentaje_inasistencias = $criterios[$i]['porcentaje_inasistencias'];

					if ($PorcentajeI > $porcentaje_inasistencias) {
						
						$situacion_academica = array("Reprobado",$nombre_criterio);
						return $situacion_academica;
					}

				}
				
			}
			if ($codigo_criterio == 3) {

				$AsigEsp_aprobadas = array();
				$AsigEsp_reprobadas = array();

				$AsigEsp = $this->promocion_model->obtener_AsignaturasEspecificas($ano_lectivo,$id_grado,$id_criterio);

				$DesempenoBajo = $this->promocion_model->obtener_DesempenoBajo($ano_lectivo);
				$minino = $DesempenoBajo[0]['rango_inicial'];
				$maximo = $DesempenoBajo[0]['rango_final'];

				for ($k=0; $k < count($AsigEsp); $k++) {

					$asignatura_especifica = $AsigEsp[$k]['asignatura_especifica'];

					$nota_final = $this->promocion_model->obtener_NotaPorAsignaturaEspecifica($ano_lectivo,$id_estudiante,$id_grado,$asignatura_especifica);
					
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

					$situacion_academica = array("Reprobado",$nombre_criterio);
					return $situacion_academica;
				}
				else{

					//Se debe validar en este criterio(asignaturas espeficas), que si el estudiante solo pierde
					//una de las asignaturas especificas estipuladas quedaria para nivelacion; siempre y cuando 
					//el estudiante no incumpla el criterio(numero de areas o asignaturas reprobadas), si lo 
					//incumple es reprobado por tal criterio.

					$id_crit = 1;
					$validacion = $this->promocion_model->validar_criterio_asignado($ano_lectivo,$id_grado,$id_crit);

					if ($validacion == true) {

						$crit = $this->promocion_model->obtener_criterio_asignado($ano_lectivo,$id_grado,$id_crit);
						$nombre_crit = $crit[0]['nombre_criterio'];
						$numero_areas_asignaturas = $crit[0]['numero_areas_asignaturas'];

						$AsigReprob = $this->promocion_model->calcular_asignaturas_reprobadas($ano_lectivo,$id_estudiante,$id_grado);

						if ($AsigReprob >= $numero_areas_asignaturas) {

							$situacion_academica = array("Reprobado",$nombre_crit);
							return $situacion_academica;
						}
						elseif ($Total_AsigEspReprob > 0 && $Total_AsigEspReprob < $Total_AsigEsp) {
					
							$situacion_academica = array("Nivelacion",$nombre_criterio);
							return $situacion_academica;
						}
						
					}
					else{

						if ($Total_AsigEspReprob > 0 && $Total_AsigEspReprob < $Total_AsigEsp) {
						
							$situacion_academica = array("Nivelacion",$nombre_criterio);
							return $situacion_academica;
						}

					}
					
				}
				
			}
			
		}

		if (count($situacion_academica) == 0) {

			$situacion_academica = array("Aprobado","");

			return $situacion_academica;
		}

	}


	//Esta Funcion me permite obtener los criterios de promocion asignados para el curso seleccionado
	public function obtener_criterios_promocion($ano_lectivo,$id_grado){

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


	public function obtener_NotasPorAsignaturas($ano_lectivo,$id_estudiante,$id_grado){

		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.id_grado',$id_grado);

		$this->db->select('notas.id_estudiante,notas.id_grado,notas.id_asignatura,IFNULL(notas.definitiva, 0.0) as definitiva',false);

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

		$this->db->select('asistencias.ano_lectivo,asistencias.id_estudiante,IFNULL(SUM(asistencias.horas), 0) as inasistencias',false);

		$query = $this->db->get('asistencias');

		if ($query->num_rows() > 0) {
		
        	$row = $query->result_array();
        	return $row[0]['inasistencias'];
		}
		else{
			return 0;
		}

	}


	public function obtener_horas_semanales($ano_lectivo,$id_grado){

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
	public function obtener_AsignaturasEspecificas($ano_lectivo,$id_grado,$id_criterio){

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


	public function obtener_NotaPorAsignaturaEspecifica($ano_lectivo,$id_estudiante,$id_grado,$asignatura_especifica){

		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.id_grado',$id_grado);
		$this->db->where('notas.id_asignatura',$asignatura_especifica);

		$this->db->select('notas.id_estudiante,notas.id_grado,notas.id_asignatura,IFNULL(notas.definitiva, 0.0) as definitiva',false);

		$query = $this->db->get('notas');

		if ($query->num_rows() > 0) {
	
			$NotaAsigEsp = $query->result_array();
        	return $NotaAsigEsp[0]['definitiva'];
        }
		else{

			return false;
		}

	}


	//Esta Funcion me permite validar si el grado tiene asignado un criterio de prom. determinado
	public function validar_criterio_asignado($ano_lectivo,$id_grado,$id_criterio){

		$this->db->where('criterios_asignados.ano_lectivo',$ano_lectivo);
		$this->db->where('criterios_asignados.id_grado',$id_grado);
		$this->db->where('criterios_asignados.id_criterio',$id_criterio);

		$query = $this->db->get('criterios_asignados');

		if ($query->num_rows() > 0) {
		
        	return true;
		}
		else{
			return false;
		}

	}


	//Esta Funcion me permite obtener informacion de un criterio de promocion asignado para un grado determinado
	public function obtener_criterio_asignado($ano_lectivo,$id_grado,$id_criterio){

		$this->db->where('criterios_asignados.ano_lectivo',$ano_lectivo);
		$this->db->where('criterios_asignados.id_grado',$id_grado);
		$this->db->where('criterios_asignados.id_criterio',$id_criterio);

		$this->db->join('criterios', 'criterios_asignados.id_criterio = criterios.id_criterio');

		$this->db->select('criterios_asignados.id_criterio_asignado,criterios_asignados.ano_lectivo,criterios_asignados.id_grado,criterios_asignados.id_criterio,criterios_asignados.numero_areas_asignaturas,criterios_asignados.porcentaje_inasistencias,criterios_asignados.asignatura_especifica,criterios.nombre_criterio,criterios.codigo_criterio,criterios.prioridad');

		$query = $this->db->get('criterios_asignados');

		if ($query->num_rows() > 0) {
		
        	return $query->result_array();
		}
		else{
			return false;
		}

	}



	//================ OTRAS FUNCIONES ===================


	public function calcular_asignaturas_reprobadas($ano_lectivo,$id_estudiante,$id_grado){

		//array sencillo para las asignaturas aprobadas y reprobadas
		$asignaturas_aprobadas = array();
		$asignaturas_reprobadas = array();

		$NotasAsignaturas = $this->promocion_model->obtener_NotasPorAsignaturas($ano_lectivo,$id_estudiante,$id_grado);

		$DesempenoBajo = $this->promocion_model->obtener_DesempenoBajo($ano_lectivo);
		$minino = $DesempenoBajo[0]['rango_inicial'];
		$maximo = $DesempenoBajo[0]['rango_final'];

		for ($j=0; $j < count($NotasAsignaturas); $j++) {

			$nota_final = $NotasAsignaturas[$j]['definitiva'];

			if ($nota_final >= $minino && $nota_final <= $maximo) {
				
				$asignaturas_reprobadas[] = $nota_final;
			}
			else{

				$asignaturas_aprobadas[] = $nota_final;
			}
			
		}

		$TotalAsigReprob = count($asignaturas_reprobadas);

		return $TotalAsigReprob;

	}


	public function calcular_inasistencias($ano_lectivo,$id_estudiante,$id_curso,$id_grado){

		$InaPor = array();

		$inasistencias = $this->promocion_model->obtener_inasistencias($ano_lectivo,$id_estudiante);
		$horas_semanales = $this->promocion_model->obtener_horas_semanales($ano_lectivo,$id_grado);

		$horas_totales = 40 * $horas_semanales;

		if ($horas_totales > 0) {
			
			$PorcentajeI = round(($inasistencias / $horas_totales) * 100, 2);

			$InaPor = array($inasistencias,$PorcentajeI);

			return $InaPor;

		}

	}


	public function calcular_areas_reprobadas($ano_lectivo,$id_estudiante,$id_grado){

		$areas_reprobadas = array();

		$areas = $this->promocion_model->obtener_AreasPorEstudiante($ano_lectivo,$id_estudiante,$id_grado);

		$DesempenoBajo = $this->promocion_model->obtener_DesempenoBajo($ano_lectivo);
		$minino = $DesempenoBajo[0]['rango_inicial'];
		$maximo = $DesempenoBajo[0]['rango_final'];

		for ($i=0; $i < count($areas); $i++) { 
			
			$id_area = $areas[$i]['id_area'];
			$asignaturas_reprobadas = array();

			$asignaturas = $this->promocion_model->obtener_AsignaturasPorArea($ano_lectivo,$id_estudiante,$id_grado,$id_area);

			for ($j=0; $j < count($asignaturas); $j++) {

				$nota_final = $asignaturas[$j]['definitiva'];

				if ($nota_final >= $minino && $nota_final <= $maximo) {
					
					$asignaturas_reprobadas[] = $nota_final;
				} 

			}

			if (count($asignaturas_reprobadas) == count($asignaturas)) {
				
				$areas_reprobadas[] = $id_area;
			}

		}

		return count($areas_reprobadas);

	}


	//Esta funcion permite obtener las areas que esta cursando un estudiante
	public function obtener_AreasPorEstudiante($ano_lectivo,$id_estudiante,$id_grado){

		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.id_grado',$id_grado);
		$this->db->group_by("areas.id_area"); 

		$this->db->join('asignaturas', 'notas.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('areas', 'asignaturas.id_area = areas.id_area');

		$this->db->select('areas.id_area,areas.nombre_area');

		$query = $this->db->get('notas');

		if ($query->num_rows() > 0) {
	
			$areas = $query->result_array();
        	return $areas;
        }
		else{

			return false;
		}

	}


	//Esta funcion permite obtener las asignaturas de una area
	public function obtener_AsignaturasPorArea($ano_lectivo,$id_estudiante,$id_grado,$id_area){

		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.id_grado',$id_grado);
		$this->db->where('asignaturas.id_area',$id_area); 

		$this->db->join('asignaturas', 'notas.id_asignatura = asignaturas.id_asignatura');

		$this->db->select('notas.id_estudiante,notas.id_grado,notas.id_asignatura,IFNULL(notas.definitiva, 0.0) as definitiva',false);

		$query = $this->db->get('notas');

		if ($query->num_rows() > 0) {
	
			$asignaturas = $query->result_array();
        	return $asignaturas;
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



	//======== FUNCIONES PARA CONSULTAR LA PROMOCION ==========


	public function buscar_promocion($jornada,$id_curso){

		$this->db->where('promocion.id_curso',$id_curso);

		$this->db->join('cursos', 'promocion.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('personas', 'promocion.id_estudiante = personas.id_persona');
		$this->db->join('anos_lectivos', 'promocion.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('promocion.id_promocion,promocion.ano_lectivo,promocion.id_estudiante,promocion.id_curso,promocion.asignaturas_reprobadas,promocion.areas_reprobadas,promocion.inasistencias,promocion.porcentaje_inasistencias,promocion.situacion_academica,promocion.causa,promocion.fecha_registro,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('promocion');

		return $query->result();
		
	}



}