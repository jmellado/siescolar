<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imprimir_model extends CI_Model {



	//Esta funcion me permite obtener los estudiantes matriculados en un determinado curso y su respectivo promedio de notas por periodo
	public function EstudiantesPorCursos($id_curso,$periodo){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$cu = $this->imprimir_model->obtener_informacion_curso($id_curso);
		$id_grado = $cu[0]['id_grado'];

		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);

		$query = $this->db->get('matriculas');

		$estudiantes = $query->result_array();
		//$total_estudiantes = $query->num_rows();
		$total_estudiantes = count($query->result());
		$listado_estudiantes = array();
		$aux = array();

		for ($i=0; $i < $total_estudiantes; $i++) {

			$id_estudiante = $estudiantes[$i]['id_estudiante'];

			$this->db->where('notas.ano_lectivo',$ano_lectivo);
			$this->db->where('notas.id_estudiante',$id_estudiante);
			$this->db->where('notas.id_grado',$id_grado);
			
			$this->db->join('personas', 'notas.id_estudiante = personas.id_persona');
			$this->db->join('anos_lectivos', 'notas.ano_lectivo = anos_lectivos.id_ano_lectivo');

			if ($periodo == "Primero") {
				# code...
				$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,AVG(IFNULL(notas.p1, 0.0)) as promedio,anos_lectivos.nombre_ano_lectivo',false);
			}
			if ($periodo == "Segundo") {
				# code...
				$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,AVG(IFNULL(notas.p2, 0.0)) as promedio,anos_lectivos.nombre_ano_lectivo',false);
			}
			if ($periodo == "Tercero") {
				# code...
				$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,AVG(IFNULL(notas.p3, 0.0)) as promedio,anos_lectivos.nombre_ano_lectivo',false);
			}
			if ($periodo == "Cuarto") {
				# code...
				$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,AVG(IFNULL(notas.p4, 0.0)) as promedio,anos_lectivos.nombre_ano_lectivo',false);
			}

			$query2 = $this->db->get('notas');

			$listado_estudiantes[] =$query2->row_array();
			
		}


		foreach ($listado_estudiantes as $key => $row) {
				//array auxiliar con los promedios de todos los estudiantes de un curso
				$aux[$key] = $row['promedio'];
		}

		//Ordenamos el array, descendentemente por el promedio de notas de cada estudiante matriculado en un respectivo curso, luego retornamos ese array
		array_multisort($aux, SORT_DESC, $listado_estudiantes);

		return $listado_estudiantes;
		
	
	}



	//Esta funcion me permite obtener las notas y los logros asignados de las asignaturas dadas por un estudiante 
	public function Notas_Logros($id_curso,$periodo,$id_estudiante){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$cu = $this->imprimir_model->obtener_informacion_curso($id_curso);
		$id_grado = $cu[0]['id_grado'];

		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('logros_asignados.id_estudiante',$id_estudiante);
		$this->db->where('logros_asignados.periodo',$periodo);
		$this->db->where('pensum.id_grado',$id_grado);

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->join('asignaturas', 'notas.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('logros_asignados', 'notas.id_asignatura = logros_asignados.id_asignatura');

		$this->db->join('logros as l1', 'logros_asignados.id_logro1 = l1.id_logro');
		$this->db->join('logros as l2', 'logros_asignados.id_logro2 = l2.id_logro');
		$this->db->join('logros as l3', 'logros_asignados.id_logro3 = l3.id_logro');
		$this->db->join('logros as l4', 'logros_asignados.id_logro4 = l4.id_logro');
	
		$this->db->join('pensum', 'notas.id_asignatura = pensum.id_asignatura');
		$this->db->join('desempenos', 'notas.id_desempeno = desempenos.id_desempeno');

		$this->db->select('notas.id_asignatura,asignaturas.nombre_asignatura,notas.p1,notas.p2,notas.p3,notas.p4,notas.nota_final,logros_asignados.id_logro1,logros_asignados.id_logro2,logros_asignados.id_logro3,logros_asignados.id_logro4,l1.descripcion_logro as dl1,l2.descripcion_logro as dl2,l3.descripcion_logro as dl3,l4.descripcion_logro as dl4,pensum.intensidad_horaria,desempenos.nombre_desempeno');
		
		$query = $this->db->get('notas');

		return $query->result_array();
	
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


	//Esta funcion me permite verificar si un curso tiene estudiantes pendientes por calificaciones en un periodo determinado. Verificando Estudiante Por Estudiante.
	public function Verificar_NotasEstudiantesPorCurso($id_curso,$periodo){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		//array sencillo para almacenar los estudiantes pendientes por calificaciones
		$estudiantes_pendientes = array();

		$this->db->where('id_curso',$id_curso);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->where('estado_matricula',"Activo");
		$query = $this->db->get('matriculas');

		$estudiantes = $query->result_array();
		
		for ($i=0; $i < count($estudiantes); $i++) {

			$id_estudiante = $estudiantes[$i]['id_estudiante'];

			$asignaturas_sinnotas=$this->imprimir_model->Verificar_NotasEstudiante($id_estudiante,$periodo,$ano_lectivo);

			if (count($asignaturas_sinnotas) > 0) {

				$estudiantes_pendientes[] = $id_estudiante;
			}
			
		}

		if (count($estudiantes_pendientes) > 0) {

			return false;
		}
		else{

			return true;
		}	

	}


	//Esta funcion permite verificar si un estudiante tienes asignaturas pendientes por notas
	public function Verificar_NotasEstudiante($id_estudiante,$periodo,$ano_lectivo){

		//array sencillo para las asignaturas sin notas de un estudiante
		$asignaturas_sinnotas = array();

		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.ano_lectivo',$ano_lectivo);

		$this->db->select('notas.id_estudiante,notas.id_asignatura,notas.p1,notas.p2,notas.p3,notas.p4');

		$query = $this->db->get('notas');

		$NotasAsignaturas = $query->result_array();
		
		for ($i=0; $i < count($NotasAsignaturas); $i++) {

			if ($periodo == "Primero") {

				if ($NotasAsignaturas[$i]['p1'] == NULL) {
					$asignaturas_sinnotas[] = $NotasAsignaturas[$i]['p1'];
				}
			}
			if ($periodo == "Segundo") {

				if ($NotasAsignaturas[$i]['p2'] == NULL) {
					$asignaturas_sinnotas[] = $NotasAsignaturas[$i]['p2'];
				}
			}
			if ($periodo == "Tercero") {

				if ($NotasAsignaturas[$i]['p3'] == NULL) {
					$asignaturas_sinnotas[] = $NotasAsignaturas[$i]['p3'];
				}
			}
			if ($periodo == "Cuarto") {

				if ($NotasAsignaturas[$i]['p4'] == NULL) {
					$asignaturas_sinnotas[] = $NotasAsignaturas[$i]['p4'];
				}
			}

		}

		return $asignaturas_sinnotas;

	}


	//Esta funcion me permite verificar si un curso tiene estudiantes pendientes por asignacion de logros en un periodo determinado.
	public function Verificar_LogrosEstudiantesPorCurso($id_curso,$periodo){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		//array sencillo para almacenar los estudiantes pendientes por asignacion de logros
		$estudiantes_pendientes = array();

		$this->db->where('id_curso',$id_curso);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->where('estado_matricula',"Activo");
		$query = $this->db->get('matriculas');

		$estudiantes = $query->result_array();
		
		for ($i=0; $i < count($estudiantes); $i++) {

			$id_estudiante = $estudiantes[$i]['id_estudiante'];

			$asignaturas_sinlogros=$this->imprimir_model->Verificar_LogrosEstudiante($id_estudiante,$periodo,$ano_lectivo);

			if (count($asignaturas_sinlogros) > 0) {

				$estudiantes_pendientes[] = $id_estudiante;
			}
			
		}

		if (count($estudiantes_pendientes) > 0) {

			return false;
		}
		else{

			return true;
		}	

	}


	//Esta funcion permite verificar si un estudiante tienes asignaturas pendientes por asignacion de logros
	public function Verificar_LogrosEstudiante($id_estudiante,$periodo,$ano_lectivo){

		//array sencillo para las asignaturas sin logros de un estudiante
		$asignaturas_sinlogros = array();

		$this->db->where('logros_asignados.id_estudiante',$id_estudiante);
		$this->db->where('logros_asignados.periodo',$periodo);
		$this->db->where('logros_asignados.ano_lectivo',$ano_lectivo);

		$this->db->select('logros_asignados.id_estudiante,logros_asignados.id_asignatura,logros_asignados.id_logro1,logros_asignados.id_logro2,logros_asignados.id_logro3,logros_asignados.id_logro4');

		$query = $this->db->get('logros_asignados');

		$LogrosAsignaturas = $query->result_array();

		if (count($LogrosAsignaturas) > 0) {

			$total_asignaturas = $this->imprimir_model->Total_AsignaturasMatriculadas($id_estudiante,$ano_lectivo);

			if (count($LogrosAsignaturas) == $total_asignaturas) {
				
				for ($i=0; $i < count($LogrosAsignaturas); $i++) {

					if ($LogrosAsignaturas[$i]['id_logro1'] == NULL) {
						$asignaturas_sinlogros[] = $LogrosAsignaturas[$i]['id_logro1'];
					}

				}

				return $asignaturas_sinlogros;
			}
			else{

				$asignaturas_sinlogros[] = 1;

				return $asignaturas_sinlogros;

			}
		}
		else{

			$asignaturas_sinlogros[] = 1;

			return $asignaturas_sinlogros;
		}

	}


	//esta funcion permite obtener el total de asignaturas matriculadas por estudiante.
	public function Total_AsignaturasMatriculadas($id_estudiante,$ano_lectivo){

		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.ano_lectivo',$ano_lectivo);

		$this->db->select('notas.id_estudiante,notas.id_asignatura,notas.p1,notas.p2,notas.p3,notas.p4');

		$query = $this->db->get('notas');
		$total_asignaturas = count($query->result_array());
	
		return $total_asignaturas;

	}


	//funcion para obtener las inasistencias por estudiante en una determinada asignatura y periodo
	public function obtener_inasistencias($ano_lectivo,$id_asignatura,$id_estudiante,$periodo){

		$this->db->where('asistencias.ano_lectivo',$ano_lectivo);
		$this->db->where('asistencias.id_asignatura',$id_asignatura);
		$this->db->where('asistencias.id_estudiante',$id_estudiante);
		$this->db->where('asistencias.periodo',$periodo);
		$this->db->where('asistencias.asistencia','Faltó');

		$this->db->select('asistencias.ano_lectivo,asistencias.id_estudiante,IFNULL(SUM(asistencias.horas), "") as inasistencias',false);

		$query = $this->db->get('asistencias');

		if ($query->num_rows() > 0) {
		
        	$row = $query->result_array();
        	return $row[0]['inasistencias'];
		}
		else{
			return 0;
		}

	}


	//********************************** FUNCIONES PARA IMPRIMIR PLANILLAS *********************************


	public function EstudiantesMatriculadosPorCurso($id_curso){

		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('matriculas.estado_matricula',"Activo");

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.identificacion,personas.tipo_id,personas.nombres,personas.apellido1,personas.apellido2,personas.tipo_sangre');
		$query = $this->db->get('matriculas');

		return $query->result_array();

	}


	//****************************** FUNCIONES PARA IMPRIMIR CONSTANCIAS ***************************

	public function buscar_estudiante($identificacion){

		$this->db->where('personas.identificacion',$identificacion);

		$this->db->join('estudiantes', 'personas.id_persona = estudiantes.id_persona');

		$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('personas');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else{
			return false;
		}

	}


	public function validar_existencia_matricula($identificacion = FALSE, $id_persona = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		if ($identificacion !== FALSE) {
			$this->db->where('personas.identificacion',$identificacion);
			$this->db->where('ano_lectivo',$ano_lectivo);
		}
		else{
			$this->db->where('personas.id_persona',$id_persona);
			$this->db->where('ano_lectivo',$ano_lectivo);
		}

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return true;
		}
		else{
			return false;
		}

	}


	public function obtener_informacion_estudiante($id_persona){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('personas.id_persona',$id_persona);
		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'matriculas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('anos_lectivos', 'matriculas.ano_lectivo = anos_lectivos.id_ano_lectivo');
		
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else{
			return false;
		}


	}


	public function obtener_fecha(){

		$CI = & get_instance();
		$CI->load->helper('date');

		$fecha_horaGMT = now();  //Obtenemos la fecha actual en formato GMT

		$esVerano = date('I', $fecha_horaGMT); //Obtenemos TRUE si es horario de verano
		$zona_horaria = 'UM5'; //zona horaria de bogota

		$fechaLocal = gmt_to_local($fecha_horaGMT, $zona_horaria, $esVerano); //Convertimos la fecha GMT a local a partir del código de zona horaria

		$fechaLocal_Formateada = mdate("%d/%m/%Y", $fechaLocal); //Formato español (dd/mm/yyyy HH:mm:ss)

		return $fechaLocal_Formateada; 

	}


	function FechaxLetras(){
    
       	setlocale(LC_ALL,"es_ES","esp");
       	date_default_timezone_set('America/Bogota');
        
        $dia =  date("d");
        $output = " ";
	    switch ($dia) {
	        case "1":
	            $output = "un";
	            break;
	        case "2":
	            $output = "dos";
	            break;
	        case "3":
	            $output = "tres";
	            break;
	        case "4":
	            $output = "cuatro";
	            break;
	        case "5":
	            $output = "cinco";
	            break;
	        case "6":
	            $output = "seis";
	            break;
	        case "7":
	            $output = "siete";
	            break;
	        case "8":
	            $output = "ocho";
	            break;
	        case "9":
	            $output = "nueve";
	            break;
	        case "10":
	            $output = "diez";
	            break;
	        case "11":
	            $output = "once";
	            break;
	        case "12":
	            $output = "doce";
	            break;
	        case "13":
	            $output = "trece";
	            break;
	        case "14":
	            $output = "catorce";
	            break;
	        case "15":
	            $output = "quince";
	            break;
	        case "16":
	            $output = "dieciseis";
	            break;
	        case "17":
	            $output = "diecisiete";
	            break;
	        case "18":
	            $output = "dieciocho";
	            break;
	        case "19":
	            $output = "diecinueve";
	            break;
	         case "20":
	            $output = "veinte";
	            break;
	         case "21":
	            $output = "veintiun";
	            break;
	         case "22":
	            $output = "veintidos";
	            break;
	         case "23":
	            $output = "veintitres";
	            break;
	         case "24":
	            $output = "veinticuatro";
	            break;
	        case "25":
	            $output = "veinticinco";
	            break;
	        case "26":
	            $output = "veintiseis";
	            break;
	        case "27":
	            $output = "veintisiete";
	            break;
	        case "28":
	            $output = "veintiocho";
	            break;
	        case "29":
	            $output = "veintinueve";
	            break;
	        case "30";
	            $output = "treinta";
	            break;
	        case "31":
	            $output = "treinta y un";
	            break;
	    } 
         
        $cadenafinal = strftime(" dia(s) del mes de %B del año %Y", time());
        return $output." (".$dia.") ".$cadenafinal;
    } 


	//****************************** FUNCIONES PARA IMPRIMIR CERTIFICADOS ***************************


	public function validar_existencia_matriculaCT($identificacion = FALSE, $id_persona = FALSE, $ano_lectivo = FALSE){

		if ($identificacion !== FALSE) {
			$this->db->where('personas.identificacion',$identificacion);
		}
		else{
			$this->db->where('personas.id_persona',$id_persona);
			$this->db->where('ano_lectivo',$ano_lectivo);
		}

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return true;
		}
		else{
			return false;
		}

	}


	public function llenar_anos_lectivosCT(){

		$query = $this->db->get('anos_lectivos');
		return $query->result();
	}


	//Esta funcion permite obtener informacion de la matricula del estudiante seleccionado y el año lectivo seleccionado
	public function obtener_informacion_estudianteCT($id_persona,$ano_lectivo){

		$this->db->where('personas.id_persona',$id_persona);
		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'matriculas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('anos_lectivos', 'matriculas.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else{
			return false;
		}


	}


	//Esta funcion permite obtener las asignaturas cursadas por un estudiante en una año lectivo,
	//con su repectiva calificacion y desempeño.
	public function Obtener_NotasEstudianteCT($id_persona,$id_grado,$ano_lectivo){

		$this->db->where('notas.id_estudiante',$id_persona);
		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('pensum.id_grado',$id_grado);

		$this->db->join('asignaturas', 'notas.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('pensum', 'notas.id_asignatura = pensum.id_asignatura');
		$this->db->join('desempenos', 'notas.id_desempeno = desempenos.id_desempeno');

		$this->db->select('notas.id_estudiante,notas.id_asignatura,notas.nota_final,notas.id_desempeno,asignaturas.nombre_asignatura,pensum.intensidad_horaria,desempenos.nombre_desempeno');

		$query = $this->db->get('notas');

		return $query->result_array();

	}


}