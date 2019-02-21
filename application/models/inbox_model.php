<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbox_model extends CI_Model {


	public function buscar_estudiante($id,$id_curso,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.estado_matricula',"Activo");
		
		$this->db->where("(personas.nombres LIKE '".$id."%' OR personas.apellido1 LIKE '".$id."%' OR personas.apellido2 LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			//$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('estudiantes', 'matriculas.id_estudiante = estudiantes.id_persona');

		$this->db->select('matriculas.id_acudiente,personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2');
		
		$query = $this->db->get('matriculas');

		return $query->result();
	
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('codigo_notificacion');
		$query = $this->db->get('notificaciones');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['codigo_notificacion'];
        return $data['query'];
	}


	public function obtener_fecha_actual(){

		$CI = & get_instance();
		$CI->load->helper('date');

		$this->config->set_item('time_reference', 'gmt');  //Se indica al sistema usar la hora convertida a gmt

		$fecha_horaGMT = now();  //Obtenemos la fecha actual en formato GMT

		$esVerano = date('I', $fecha_horaGMT); //Obtenemos TRUE si es horario de verano
		$zona_horaria = 'UM5'; //zona horaria de bogota

		$fechaLocal = gmt_to_local($fecha_horaGMT, $zona_horaria, $esVerano); //Convertimos la fecha GMT a local a partir del código de zona horaria

		$fechaLocal_Formateada = mdate("%Y/%m/%d %H:%i:%s %a", $fechaLocal); //Formato español (dd/mm/yyyy HH:mm:ss)

		return $fechaLocal_Formateada; 

	}


	public function insertar_mensajes($ultimo_id,$categoria_notificacion,$remitente,$titulo,$tipo_notificacion,$contenido,$destinatario,$rol_destinatario,$id_asignatura,$fecha_envio,$estado_lectura){

		//NUEVA TRANSACCION
		$this->db->trans_start();

		for ($i=0; $i < count($destinatario) ; $i++) {

			$id_acudiente = $this->inbox_model->consultar_acudiente($destinatario[$i]);

			//array para insertar en la tabla notificaciones
        	$notificacion = array(
        	'codigo_notificacion' =>$ultimo_id,
        	'categoria_notificacion' =>$categoria_notificacion,
        	'remitente' =>$remitente,	
			'titulo' =>$titulo,
			'tipo_notificacion' =>$tipo_notificacion,
			'contenido' =>$contenido,
			'destinatario' =>$id_acudiente,
			'rol_destinatario' =>$rol_destinatario,
			'id_estudiante' =>$destinatario[$i],
			'id_asignatura' =>$id_asignatura,
			'fecha_envio' =>$fecha_envio,
			'estado_lectura' =>$estado_lectura);

			$this->db->insert('notificaciones', $notificacion);

		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}


	}


	public function insertar_tareas($ultimo_id,$categoria_notificacion,$remitente,$titulo,$contenido,$destinatario,$rol_destinatario,$id_asignatura,$fecha_limite,$fecha_envio,$estado_lectura){

		//NUEVA TRANSACCION
		$this->db->trans_start();

		for ($i=0; $i < count($destinatario) ; $i++) {

			$id_acudiente = $this->inbox_model->consultar_acudiente($destinatario[$i]);

			//array para insertar en la tabla notificaciones
        	$notificacion = array(
        	'codigo_notificacion' =>$ultimo_id,
        	'categoria_notificacion' =>$categoria_notificacion,
        	'remitente' =>$remitente,	
			'titulo' =>$titulo,
			'contenido' =>$contenido,
			'destinatario' =>$id_acudiente,
			'rol_destinatario' =>$rol_destinatario,
			'id_estudiante' =>$destinatario[$i],
			'id_asignatura' =>$id_asignatura,
			'fecha_fin' =>$fecha_limite,
			'fecha_envio' =>$fecha_envio,
			'estado_lectura' =>$estado_lectura);

			$this->db->insert('notificaciones', $notificacion);

		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}


	}


	public function insertar_eventos($ultimo_id,$categoria_notificacion,$remitente,$titulo,$contenido,$destinatario,$rol_destinatario,$id_asignatura,$fecha_inicio,$hora_inicio,$fecha_fin,$hora_fin,$fecha_envio,$estado_lectura){

		//NUEVA TRANSACCION
		$this->db->trans_start();

		for ($i=0; $i < count($destinatario) ; $i++) {

			$id_acudiente = $this->inbox_model->consultar_acudiente($destinatario[$i]);

			//array para insertar en la tabla notificaciones
        	$notificacion = array(
        	'codigo_notificacion' =>$ultimo_id,
        	'categoria_notificacion' =>$categoria_notificacion,
        	'remitente' =>$remitente,	
			'titulo' =>$titulo,
			'contenido' =>$contenido,
			'destinatario' =>$id_acudiente,
			'rol_destinatario' =>$rol_destinatario,
			'id_estudiante' =>$destinatario[$i],
			'id_asignatura' =>$id_asignatura,
			'fecha_inicio' =>$fecha_inicio,
			'hora_inicio' =>$hora_inicio,
			'fecha_fin' =>$fecha_fin,
			'hora_fin' =>$hora_fin,
			'fecha_envio' =>$fecha_envio,
			'estado_lectura' =>$estado_lectura);

			$this->db->insert('notificaciones', $notificacion);

		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
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

		$row = $query->result_array();

		$id_acudiente = $row[0]['id_acudiente'];

		return $id_acudiente;

	}


	//Esta Funcion Me Permite Enviar Una Notificacion A Todos Los Acudientes Conectados En La App Movil
	public function enviar_notificacionFirebase($titulo,$contenido,$destinatario,$firebase){

		$titulo2 = $titulo;

		for ($i=0; $i < count($destinatario); $i++) { 

			$TokensAcudientes = $this->inbox_model->obtener_TokensAcudientes($destinatario[$i]);
			$nombre_estudiante = $this->inbox_model->obtener_nombre_estudiante($destinatario[$i]);

			if ($firebase == "1") {
				$titulo = "Mensaje!!";
				$contenido = $nombre_estudiante.":<br>".$titulo2;
			}
			elseif ($firebase == "2") {
				$titulo = "Tarea!!";
				$contenido = $nombre_estudiante.":<br>".$titulo2;
			}
			elseif ($firebase == "3") {
				$titulo = "Evento!!";
				$contenido = $nombre_estudiante.":<br>".$titulo2;
			}
				

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

		//for ($i=0; $i < count($destinatario) ; $i++) {

			$id_acudiente = $this->inbox_model->consultar_acudiente($destinatario);

			$this->db->where('usuarios.id_rol',4);
			$this->db->where('usuarios.id_persona',$id_acudiente);

			$this->db->select('usuarios.token');

			$query = $this->db->get('usuarios');

			$row = $query->result_array();

			$tokens[] = $row[0]['token'];
		//}
		
		//array con los token de los dispositvos a los cuales va ir dirgido la notificacion
		return $tokens;
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



	//Funciones para mostrar los mensajes, eventos, y tareas programadas por un profesor


	public function buscar_mensaje($id,$id_profesor,$inicio = FALSE,$cantidad = FALSE){

		$this->db->where('notificaciones.remitente',$id_profesor);
		$this->db->where('notificaciones.categoria_notificacion',"Mensajes");
		
		$this->db->where("(notificaciones.titulo LIKE '".$id."%' OR notificaciones.tipo_notificacion LIKE '".$id."%' OR notificaciones.contenido LIKE '".$id."%' OR notificaciones.fecha_envio LIKE '".$id."%' OR asignaturas.nombre_asignatura LIKE '".$id."%')", NULL, FALSE);

		$this->db->order_by('notificaciones.fecha_envio', 'desc');
		$this->db->group_by("notificaciones.codigo_notificacion"); 

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('asignaturas', 'notificaciones.id_asignatura = asignaturas.id_asignatura');

		$this->db->select('notificaciones.id_notificacion,notificaciones.codigo_notificacion,notificaciones.categoria_notificacion,notificaciones.remitente,notificaciones.titulo,notificaciones.tipo_notificacion,notificaciones.contenido,notificaciones.id_asignatura,notificaciones.fecha_envio,asignaturas.nombre_asignatura');
		
		$query = $this->db->get('notificaciones');

		return $query->result();
	
	}


	public function buscar_tarea($id,$id_profesor,$inicio = FALSE,$cantidad = FALSE){

		$this->db->where('notificaciones.remitente',$id_profesor);
		$this->db->where('notificaciones.categoria_notificacion',"Tareas");
		
		$this->db->where("(notificaciones.titulo LIKE '".$id."%' OR notificaciones.contenido LIKE '".$id."%' OR notificaciones.fecha_fin LIKE '".$id."%' OR notificaciones.fecha_envio LIKE '".$id."%' OR asignaturas.nombre_asignatura LIKE '".$id."%')", NULL, FALSE);

		$this->db->order_by('notificaciones.fecha_envio', 'desc');
		$this->db->group_by("notificaciones.codigo_notificacion");

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('asignaturas', 'notificaciones.id_asignatura = asignaturas.id_asignatura');

		$this->db->select('notificaciones.id_notificacion,notificaciones.codigo_notificacion,notificaciones.categoria_notificacion,notificaciones.remitente,notificaciones.titulo,notificaciones.contenido,notificaciones.id_asignatura,notificaciones.fecha_fin,notificaciones.fecha_envio,asignaturas.nombre_asignatura');
		
		$query = $this->db->get('notificaciones');

		return $query->result();
	
	}


	public function buscar_evento($id,$id_profesor,$inicio = FALSE,$cantidad = FALSE){

		$this->db->where('notificaciones.remitente',$id_profesor);
		$this->db->where('notificaciones.categoria_notificacion',"Eventos");
		
		$this->db->where("(notificaciones.titulo LIKE '".$id."%' OR notificaciones.contenido LIKE '".$id."%' OR notificaciones.fecha_inicio LIKE '".$id."%' OR notificaciones.hora_inicio LIKE '".$id."%' OR notificaciones.fecha_fin LIKE '".$id."%' OR notificaciones.hora_fin LIKE '".$id."%' OR notificaciones.fecha_envio LIKE '".$id."%' OR asignaturas.nombre_asignatura LIKE '".$id."%')", NULL, FALSE);

		$this->db->order_by('notificaciones.fecha_envio', 'desc');
		$this->db->group_by("notificaciones.codigo_notificacion");

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('asignaturas', 'notificaciones.id_asignatura = asignaturas.id_asignatura');

		$this->db->select('notificaciones.id_notificacion,notificaciones.codigo_notificacion,notificaciones.categoria_notificacion,notificaciones.remitente,notificaciones.titulo,notificaciones.contenido,notificaciones.id_asignatura,notificaciones.fecha_inicio,notificaciones.hora_inicio,notificaciones.fecha_fin,notificaciones.hora_fin,notificaciones.fecha_envio,asignaturas.nombre_asignatura');
		
		$query = $this->db->get('notificaciones');

		return $query->result();
	
	}


	public function buscar_destinatario($id,$codigo_notificacion,$inicio = FALSE,$cantidad = FALSE){

		$this->db->where('notificaciones.codigo_notificacion',$codigo_notificacion);
		
		$this->db->where("(personas.identificacion LIKE '".$id."%' OR personas.nombres LIKE '".$id."%' OR personas.apellido1 LIKE '".$id."%' OR personas.apellido2 LIKE '".$id."%')", NULL, FALSE);

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			//$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('personas', 'notificaciones.id_estudiante = personas.id_persona');

		$this->db->select('notificaciones.id_estudiante,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2');
		
		$query = $this->db->get('notificaciones');

		return $query->result();
	
	}


}