<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actividades_model extends CI_Model {


	public function insertar_actividad($actividad){
		if ($this->db->insert('actividades', $actividad)) 
			return true;
		else
			return false;
	}


	public function buscar_actividad($id,$id_profesor,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('actividades.id_profesor',$id_profesor);
		$this->db->where('actividades.ano_lectivo',$ano_lectivo);
		
		$this->db->where("(grados.nombre_grado LIKE '".$id."%' OR grupos.nombre_grupo LIKE '".$id."%' OR actividades.descripcion_actividad LIKE '".$id."%' OR actividades.periodo LIKE '".$id."%' OR asignaturas.nombre_asignatura LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('cursos', 'actividades.id_curso = cursos.id_curso');
		$this->db->join('asignaturas', 'actividades.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('actividades.id_actividad,actividades.descripcion_actividad,actividades.id_curso,actividades.id_asignatura,actividades.periodo,actividades.fecha_registro,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,asignaturas.nombre_asignatura');
		
		$query = $this->db->get('actividades');

		return $query->result();
	
	}


	public function eliminar_actividad($id_actividad){

       	//NUEVA TRANSACCION
		$this->db->trans_start();
		$this->db->where('id_actividad',$id_actividad);
		$this->db->delete('notas_actividades');

		$this->db->where('id_actividad',$id_actividad);
		$this->db->delete('actividades');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}
    }


    public function modificar_actividad($id_actividad,$actividad){

		$this->db->where('id_actividad',$id_actividad);

		if ($this->db->update('actividades', $actividad))

			return true;
		else
			return false;
	}


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


	public function obtener_ultimo_id(){

		$this->db->select_max('id_actividad');
		$query = $this->db->get('actividades');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_actividad'];
        return $data['query'];
	}


	public function obtener_fecha_actual(){

		$CI = & get_instance();
		$CI->load->helper('date');

		$fecha_horaGMT = now();  //Obtenemos la fecha actual en formato GMT

		$esVerano = date('I', $fecha_horaGMT); //Obtenemos TRUE si es horario de verano
		$zona_horaria = 'UM5'; //zona horaria de bogota

		$fechaLocal = gmt_to_local($fecha_horaGMT, $zona_horaria, $esVerano); //Convertimos la fecha GMT a local a partir del código de zona horaria

		$fechaLocal_Formateada = mdate("%Y/%m/%d %h:%i:%s %a", $fechaLocal); //Formato español (dd/mm/yyyy HH:mm:ss)

		return $fechaLocal_Formateada; 

	}


	public function EstudiantesMatriculadosPorCurso($id_curso){

		$this->db->where('matriculas.id_curso',$id_curso);

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('matriculas');

		return $query->result_array();

	}


	//Esta Funcion permite registrar los estudiantes en una determinada actividad, para el posterior registro de notas.
	public function insertar_estudiantesPoractividad($id_actividad,$id_curso){

		$estudiantes = $this->actividades_model->EstudiantesMatriculadosPorCurso($id_curso);

		if ($estudiantes != false) {
			
			//NUEVA TRANSACCION
			$this->db->trans_start();

				for ($i=0; $i < count($estudiantes); $i++) { 
					
					//array para insertar en la tabla notas_actividades
		        	$notas_actividades = array(
					'id_estudiante' =>$estudiantes[$i]['id_estudiante'],
					'id_actividad' =>$id_actividad);

					$this->db->insert('notas_actividades', $notas_actividades);
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
			return true;
		}

	}



	//===================== Funciones Para La Calificacion De Actividades =======================


	public function buscar_actividadCA($id,$id_profesor,$periodo,$id_curso,$id_asignatura,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('actividades.id_profesor',$id_profesor);
		$this->db->where('actividades.ano_lectivo',$ano_lectivo);
		$this->db->where('actividades.periodo',$periodo);
		$this->db->where('actividades.id_curso',$id_curso);
		$this->db->where('actividades.id_asignatura',$id_asignatura);
		
		//$this->db->where("(grados.nombre_grado LIKE '".$id."%' OR grupos.nombre_grupo LIKE '".$id."%' OR actividades.descripcion_actividad LIKE '".$id."%' OR actividades.periodo LIKE '".$id."%' OR asignaturas.nombre_asignatura LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('cursos', 'actividades.id_curso = cursos.id_curso');
		$this->db->join('asignaturas', 'actividades.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('actividades.id_actividad,actividades.descripcion_actividad,actividades.id_curso,actividades.id_asignatura,actividades.periodo,actividades.fecha_registro,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,asignaturas.nombre_asignatura');
		
		$query = $this->db->get('actividades');

		return $query->result();
	
	}


	public function buscar_nota($id,$id_curso,$id_actividad,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('notas_actividades.id_actividad',$id_actividad);
		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		
		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('estudiantes', 'matriculas.id_estudiante = estudiantes.id_persona');
		$this->db->join('notas_actividades', 'matriculas.id_estudiante = notas_actividades.id_estudiante');

		$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,notas_actividades.id_actividad,IFNULL(notas_actividades.nota,"") as nota', false);
		
		$query = $this->db->get('matriculas');

		return $query->result();
	
	}


	public function modificar_nota($estudiantes,$id_actividad,$notas,$fecha_registro){

		//NUEVA TRANSACCION
		$this->db->trans_start();

		for ($i=0; $i < count($estudiantes) ; $i++) {

			$nota = $notas[$i];

			if ($nota == ""){
		        $nota = NULL;
		    }

			//array para actualizar en la tabla notas actividades
        	$nota = array(
			'id_estudiante' =>$estudiantes[$i],
			'id_actividad' =>$id_actividad,
			'nota' =>$nota,
			'fecha_registro' =>$fecha_registro);

        	$this->db->where('id_estudiante',$estudiantes[$i]);
        	$this->db->where('id_actividad',$id_actividad);
			$this->db->update('notas_actividades', $nota);

		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}

	}


	//***************************** Funciones Para El Envio De Notificicaciones *****************

	//Esta Funcion Me Permite Enviar Una Notificacion A Todos Los Acudientes Conectados En La App Movil
	public function enviar_notificacionFirebase($destinatario,$id_actividad,$notas){

		$actividad = $this->actividades_model->obtener_detalles_actividad($id_actividad);
		$nombre_asignatura = $actividad[0]['nombre_asignatura'];

		for ($i=0; $i < count($destinatario); $i++) { 
			
			$TokensAcudientes = $this->actividades_model->obtener_TokensAcudientes($destinatario[$i]);
			$nombre_estudiante = $this->actividades_model->obtener_nombre_estudiante($destinatario[$i]);

			$titulo = "Calificación!!";
			$contenido = $nombre_estudiante." ha obtenido una calificación de ".$notas[$i]." en ".$nombre_asignatura.".";

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


	//Con esta Funcion obtengo un array con los tokens de los acudientes seleccionados
	//Recibo un array con los id de los estudiantes
	//Luego consulto el id del acudiente de cada estudiante
	//Po ultimo consulto el token de cada acudiente y lo voy almacenando en el array tokens el cual es retornado
	public function obtener_TokensAcudientes($destinatario){

		//array sencillo para los tokens
		$tokens = array();

		for ($i=0; $i < count($destinatario) ; $i++) {

			$id_acudiente = $this->actividades_model->consultar_acudiente($destinatario[$i]);

			$this->db->where('usuarios.id_rol',4);
			$this->db->where('usuarios.id_persona',$id_acudiente);

			$this->db->select('usuarios.token');

			$query = $this->db->get('usuarios');

			$row = $query->result_array();

			$tokens[] = $row[0]['token'];
		}
		
		//array con los token de los dispositvos a los cuales va ir dirgido la notificacion
		return $tokens;
	}


	//Esta funcion me permite consultar el acudiente(id) de un estudiante matriculado
	public function consultar_acudiente($id_estudiante){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.id_estudiante',$id_estudiante);

		$this->db->select('matriculas.id_acudiente');
		
		$query = $this->db->get('matriculas');

		$row = $query->result_array();

		$id_acudiente = $row[0]['id_acudiente'];

		return $id_acudiente;

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


	public function obtener_detalles_actividad($id_actividad){

		$this->db->where('actividades.id_actividad',$id_actividad);

		$this->db->join('asignaturas', 'actividades.id_asignatura = asignaturas.id_asignatura');
		
		$query = $this->db->get('actividades');

		if ($query->num_rows() > 0) {

			$actividad = $query->result_array();

			return $actividad;
		}
		else{
			return false;
		}


	}


	//===================== Funciones Para La Consulta De Calificaciones =======================


	public function buscar_notafinal($id,$id_profesor,$periodo,$id_curso,$id_asignatura,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('actividades.id_profesor',$id_profesor);
		$this->db->where('actividades.ano_lectivo',$ano_lectivo);
		$this->db->where('actividades.periodo',$periodo);
		$this->db->where('actividades.id_curso',$id_curso);
		$this->db->where('actividades.id_asignatura',$id_asignatura);

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('actividades', 'notas_actividades.id_actividad = actividades.id_actividad');
		$this->db->join('personas', 'notas_actividades.id_estudiante = personas.id_persona');

		$this->db->select('DISTINCT(notas_actividades.id_estudiante)');
		$query = $this->db->get('notas_actividades');

		$estudiantes = $query->result_array();
		$listado_estudiantes = array();

		for ($i=0; $i < count($estudiantes) ; $i++) { 
			
			$id_estudiante = $estudiantes[$i]['id_estudiante'];

			$this->db->where('actividades.id_profesor',$id_profesor);
			$this->db->where('actividades.ano_lectivo',$ano_lectivo);
			$this->db->where('actividades.periodo',$periodo);
			$this->db->where('actividades.id_curso',$id_curso);
			$this->db->where('actividades.id_asignatura',$id_asignatura);
			$this->db->where('notas_actividades.id_estudiante',$id_estudiante);

			/*$this->db->order_by('personas.apellido1', 'asc');
			$this->db->order_by('personas.apellido2', 'asc');
			$this->db->order_by('personas.nombres', 'asc');*/

			$this->db->join('actividades', 'notas_actividades.id_actividad = actividades.id_actividad');
			$this->db->join('personas', 'notas_actividades.id_estudiante = personas.id_persona');
			$this->db->join('cursos', 'actividades.id_curso = cursos.id_curso');
			$this->db->join('asignaturas', 'actividades.id_asignatura = asignaturas.id_asignatura');
			$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
			$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');

			$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,ROUND(AVG(IFNULL(notas_actividades.nota, 0.0)),1) as nota,actividades.periodo,actividades.id_curso,actividades.id_asignatura,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,asignaturas.nombre_asignatura',false);
		
			$query2 = $this->db->get('notas_actividades');

			$listado_estudiantes[] =$query2->row();
		}

		
		return $listado_estudiantes;

	}


	// Esta funcion me permite obtener las notas por actividades de un estudiante en una asignatura
	public function buscar_notasactividades($id,$id_estudiante,$periodo,$id_curso,$id_asignatura,$inicio = FALSE,$cantidad = FALSE){

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



}