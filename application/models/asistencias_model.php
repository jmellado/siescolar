<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asistencias_model extends CI_Model {


	public function llenar_cursos_profesor($id_profesor){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cargas_academicas.id_profesor',$id_profesor);
		$this->db->where('cargas_academicas.ano_lectivo',$ano_lectivo);

		$this->db->order_by('cursos.jornada', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');

		$this->db->join('cursos', 'cargas_academicas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

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

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');
		
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


	public function insertar_asistencia($ano_lectivo,$id_profesor,$id_curso,$id_asignatura,$estudiantes,$periodo,$fecha,$asistencias,$horas,$fecha_registro){

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
					'horas' 		=>$horas,
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

		$this->db->select('asistencias.id_asistencia,asistencias.ano_lectivo,asistencias.id_profesor,asistencias.id_curso,asistencias.id_asignatura,asistencias.id_estudiante,asistencias.periodo,asistencias.fecha,asistencias.asistencia,asistencias.horas,asistencias.fecha_registro,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,asignaturas.nombre_asignatura,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('asistencias');

		return $query->result_array();
		
	}


	// esta funcion permite obtener el numero de horas de clase que tiene una asigntura en una fecha dada
	// obteniendo el dia de la semana y consultando en la tabla horarios
	public function obtener_HorasAsignaturaPorFecha($ano_lectivo,$id_curso,$id_asignatura,$fecha){

		$dia_semana = $this->asistencias_model->obtener_dia_semana($fecha);

		$this->db->where('horarios.ano_lectivo',$ano_lectivo);
		$this->db->where('horarios.id_curso',$id_curso);
		$this->db->where($dia_semana,$id_asignatura);

		$this->db->select('horarios.id_horario,horarios.id_curso,horarios.hora,horarios.ano_lectivo');

		$query = $this->db->get('horarios');

		if ($query->num_rows() > 0) {

			return count($query->result_array());
		}
		else{
			return 0;
		}

	}


	public function obtener_dia_semana($fecha){

		$fech = strtotime($fecha);  //fecha como numero

		$dia_semana = date("w", $fech); //dia de la semana en numero 0 a 6

		switch ($dia_semana) {
			case '0': return "domingo"; break;
			case '1': return "lunes"; break;
			case '2': return "martes"; break;
			case '3': return "miercoles"; break;
			case '4': return "jueves"; break;
			case '5': return "viernes"; break;
			case '6': return "sabado"; break;
		}

	}


	public function validar_fechaIngresoAsistencias($periodo,$fecha_actual,$ano_lectivo){

		$estado_actividad = "Activo";

		$sql= "SELECT nombre_actividad FROM cronogramas WHERE nombre_actividad ='". $periodo."' AND ano_lectivo ='".$ano_lectivo."' AND estado_actividad ='".$estado_actividad."' AND '".$fecha_actual."' >= fecha_inicial AND '".$fecha_actual."' <= fecha_final";

		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) 
			return true;
		else
			return false;
		
	}


	public function EstudiantesMatriculadosPorCurso($id_curso){

		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('matriculas.estado_matricula',"Activo");

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('matriculas');

		return $query->result();

	}


	public function buscar_asistencia_estudiante($id_profesor,$id_curso,$id_asignatura,$id_estudiante,$periodo){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('asistencias.ano_lectivo',$ano_lectivo);
		$this->db->where('asistencias.id_profesor',$id_profesor);
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



	//***************************** Funciones Para El Envio De Notificicaciones *****************

	//Esta Funcion Me Permite Enviar Una Notificacion A Todos Los Acudientes Conectados En La App Movil
	public function enviar_notificacionFirebase($destinatario,$id_asignatura,$asistencias){

		$asignatura = $this->asistencias_model->obtener_nombre_asignatura($id_asignatura);
		$nombre_asignatura = $asignatura[0]['nombre_asignatura'];

		for ($i=0; $i < count($destinatario); $i++) {

			if ($asistencias[$i] == "Faltó") { 
			
				$TokensAcudientes = $this->asistencias_model->obtener_TokensAcudientes($destinatario[$i]);
				$nombre_estudiante = $this->asistencias_model->obtener_nombre_estudiante($destinatario[$i]);

				$titulo = "Asistencia!!";
				$contenido = $nombre_estudiante." ".$asistencias[$i]." A La Clase De ".$nombre_asignatura.".";

				if ($TokensAcudientes != false) {

					//clave del servidor FCM
		 			$apiKey = 'AAAAhVC_IAs:APA91bFIRUkXQpUEUKbZ_PdYJtHc2zt_g7kAcD6tct8ZfU0xI_c0pjmBTrW5PPuhJBG8AzNtuQJvcSUtal8sZnZpAcMHdkkTcOFOHWiJB6oHyeFr6q3sTSeuzes2v0XUmIYY6qnqQ4na';

		 			$headers = array(
						"Authorization:key=$apiKey",
						'Content-Type:application/json'
					);

					//datos
					$notificacion = array(
						'body' => $contenido,
						'title' => $titulo,
					);

					$data = array(
					   'registration_ids' => $TokensAcudientes,
					   'data' => $notificacion
					);

					// Petición
					$ch = curl_init();
					curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
					curl_setopt( $ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send" );
					curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
					curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
					curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($data));

					// Conectamos y recuperamos la respuesta
					$response = curl_exec($ch);
					//echo($response);
					 
					// Cerramos conexión
					curl_close($ch);
				}

			}

		}


	}


	//Con esta Funcion obtengo un array con los tokens de los acudientes seleccionados
	//Recibo un array con los id de los estudiantes
	//Luego consulto el id del acudiente de cada estudiante
	//Po ultimo consulto el token de cada acudiente y lo voy almacenando en el array tokens el cual es retornado
	public function obtener_TokensAcudientes($destinatario){

		//array sencillo para los tokens
		$tokens = array();

		$id_acudiente = $this->asistencias_model->consultar_acudiente($destinatario);

		$this->db->where('usuarios.id_rol',4);
		$this->db->where('usuarios.id_persona',$id_acudiente);

		$this->db->select('usuarios.token');

		$query = $this->db->get('usuarios');

		if ($query->num_rows() > 0) {

			$row = $query->result_array();
			$tokens[] = $row[0]['token'];

			//array con los token de los dispositvos a los cuales va ir dirgido la notificacion
			return $tokens;
		}
		else{
			return false;
		}
		
	}


	//Esta funcion me permite consultar el acudiente(id) de un estudiante matriculado
	public function consultar_acudiente($id_estudiante){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.id_estudiante',$id_estudiante);

		$this->db->select('matriculas.id_acudiente');
		
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {

			$row = $query->result_array();
			$id_acudiente = $row[0]['id_acudiente'];

			return $id_acudiente;
		}
		else{
			return false;
		}

	}


	public function obtener_nombre_estudiante($id_persona){

		$this->db->where('personas.id_persona',$id_persona);

		$this->db->join('estudiantes', 'personas.id_persona = estudiantes.id_persona');
		
		$query = $this->db->get('personas');

		if ($query->num_rows() > 0) {

			$estudiante = $query->result_array();
			$nombre_estudiante = $estudiante[0]['nombres']." ".$estudiante[0]['apellido1']." ".$estudiante[0]['apellido2'];

			return $nombre_estudiante;
		}
		else{
			return false;
		}


	}


	public function obtener_nombre_asignatura($id_asignatura){

		$this->db->where('asignaturas.id_asignatura',$id_asignatura);
		
		$query = $this->db->get('asignaturas');

		if ($query->num_rows() > 0) {

			$asignatura = $query->result_array();

			return $asignatura;
		}
		else{
			return false;
		}


	}




}
