<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notificaciones_model extends CI_Model {


	public function insertar_notificacion($ultimo_id,$categoria_notificacion,$remitente,$titulo,$tipo_notificacion,$contenido,$rol_destinatario,$fecha_envio,$estado_lectura){

		$estudiantes = $this->notificaciones_model->obtener_estudiantes();
        $acudientes = $this->notificaciones_model->obtener_acudientes();
        $profesores = $this->notificaciones_model->obtener_profesores();

        if ($rol_destinatario == "1") {
        
			//NUEVA TRANSACCION
			$this->db->trans_start();

				if ($estudiantes != false) {
	        			
	    			for ($i=0; $i < count($estudiantes) ; $i++) {

	    				//array para insertar en la tabla notificaciones----------
			        	$notificacion = array(
			        	'codigo_notificacion' =>$ultimo_id,
			        	'categoria_notificacion' =>$categoria_notificacion,
			        	'remitente' =>$remitente,	
						'titulo' =>$titulo,
						'tipo_notificacion' =>$tipo_notificacion,
						'contenido' =>$contenido,
						'destinatario' =>$estudiantes[$i]['id_persona'],
						'rol_destinatario' =>$rol_destinatario,
						'fecha_envio' =>$fecha_envio,
						'estado_lectura' =>$estado_lectura);

						$this->db->insert('notificaciones', $notificacion);

	    			}

	    		}
	    		if ($acudientes != false) {
	        			
	    			for ($i=0; $i < count($acudientes) ; $i++) {

	    				//array para insertar en la tabla notificaciones----------
			        	$notificacion = array(
			        	'codigo_notificacion' =>$ultimo_id,
			        	'categoria_notificacion' =>$categoria_notificacion,
			        	'remitente' =>$remitente,	
						'titulo' =>$titulo,
						'tipo_notificacion' =>$tipo_notificacion,
						'contenido' =>$contenido,
						'destinatario' =>$acudientes[$i]['id_persona'],
						'rol_destinatario' =>$rol_destinatario,
						'fecha_envio' =>$fecha_envio,
						'estado_lectura' =>$estado_lectura);

						$this->db->insert('notificaciones', $notificacion);

	    			}

	    		}
			
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE){

				return false;
			}
			else{

				return true;
			}
		}
		elseif ($rol_destinatario == "2") {

			//NUEVA TRANSACCION
			$this->db->trans_start();

				if ($profesores != false) {
	        			
	    			for ($i=0; $i < count($profesores) ; $i++) {

	    				//array para insertar en la tabla notificaciones----------
			        	$notificacion = array(
			        	'codigo_notificacion' =>$ultimo_id,
			        	'categoria_notificacion' =>$categoria_notificacion,
			        	'remitente' =>$remitente,	
						'titulo' =>$titulo,
						'tipo_notificacion' =>$tipo_notificacion,
						'contenido' =>$contenido,
						'destinatario' =>$profesores[$i]['id_persona'],
						'rol_destinatario' =>$rol_destinatario,
						'fecha_envio' =>$fecha_envio,
						'estado_lectura' =>$estado_lectura);

						$this->db->insert('notificaciones', $notificacion);

	    			}

	    		}
			
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE){

				return false;
			}
			else{

				return true;
			}
			
		}
		elseif ($rol_destinatario == "3") {

			//NUEVA TRANSACCION
			$this->db->trans_start();

				if ($estudiantes != false) {
	        			
	    			for ($i=0; $i < count($estudiantes) ; $i++) {

	    				//array para insertar en la tabla notificaciones----------
			        	$notificacion = array(
			        	'codigo_notificacion' =>$ultimo_id,
			        	'categoria_notificacion' =>$categoria_notificacion,
			        	'remitente' =>$remitente,	
						'titulo' =>$titulo,
						'tipo_notificacion' =>$tipo_notificacion,
						'contenido' =>$contenido,
						'destinatario' =>$estudiantes[$i]['id_persona'],
						'rol_destinatario' =>$rol_destinatario,
						'fecha_envio' =>$fecha_envio,
						'estado_lectura' =>$estado_lectura);

						$this->db->insert('notificaciones', $notificacion);

	    			}

	    		}
	    		if ($acudientes != false) {
	        			
	    			for ($i=0; $i < count($acudientes) ; $i++) {

	    				//array para insertar en la tabla notificaciones----------
			        	$notificacion = array(
			        	'codigo_notificacion' =>$ultimo_id,
			        	'categoria_notificacion' =>$categoria_notificacion,
			        	'remitente' =>$remitente,	
						'titulo' =>$titulo,
						'tipo_notificacion' =>$tipo_notificacion,
						'contenido' =>$contenido,
						'destinatario' =>$acudientes[$i]['id_persona'],
						'rol_destinatario' =>$rol_destinatario,
						'fecha_envio' =>$fecha_envio,
						'estado_lectura' =>$estado_lectura);

						$this->db->insert('notificaciones', $notificacion);

	    			}

	    		}
	    		if ($profesores != false) {
	        			
	    			for ($i=0; $i < count($profesores) ; $i++) {

	    				//array para insertar en la tabla notificaciones----------
			        	$notificacion = array(
			        	'codigo_notificacion' =>$ultimo_id,
			        	'categoria_notificacion' =>$categoria_notificacion,
			        	'remitente' =>$remitente,	
						'titulo' =>$titulo,
						'tipo_notificacion' =>$tipo_notificacion,
						'contenido' =>$contenido,
						'destinatario' =>$profesores[$i]['id_persona'],
						'rol_destinatario' =>$rol_destinatario,
						'fecha_envio' =>$fecha_envio,
						'estado_lectura' =>$estado_lectura);

						$this->db->insert('notificaciones', $notificacion);

	    			}

	    		}
			
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE){

				return false;
			}
			else{

				return true;
			}
			
		}

	}

	public function validar_existencia($titulo){

		$this->db->where('titulo',$titulo);
		$query = $this->db->get('notificaciones');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_notificacion($id,$id_admin,$inicio = FALSE,$cantidad = FALSE){

		$this->db->where('remitente',$id_admin);
		$this->db->where('categoria_notificacion',"Mensajes");
		$this->db->group_by("codigo_notificacion"); 

		$this->db->where("(notificaciones.titulo LIKE '".$id."%' OR notificaciones.fecha_envio LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->select('codigo_notificacion,remitente,titulo,tipo_notificacion,contenido,destinatario,rol_destinatario,fecha_envio,estado_lectura');
		$query = $this->db->get('notificaciones');

		return $query->result();
		
	}

	public function eliminar_notificacion($id){

     	$this->db->where('codigo_notificacion',$id);
		$consulta = $this->db->delete('notificaciones');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    public function modificar_notificacion($codigo_notificacion,$notificacion){

	
		$this->db->where('codigo_notificacion',$codigo_notificacion);

		if ($this->db->update('notificaciones', $notificacion))

			return true;
		else
			return false;
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

		$fecha_horaGMT = now();  //Obtenemos la fecha actual en formato GMT

		$esVerano = date('I', $fecha_horaGMT); //Obtenemos TRUE si es horario de verano
		$zona_horaria = 'UM5'; //zona horaria de bogota

		$fechaLocal = gmt_to_local($fecha_horaGMT, $zona_horaria, $esVerano); //Convertimos la fecha GMT a local a partir del código de zona horaria

		$fechaLocal_Formateada = mdate("%Y/%m/%d %h:%i:%s %a", $fechaLocal); //Formato español (dd/mm/yyyy HH:mm:ss)

		return $fechaLocal_Formateada; 

	}


	public function obtener_informacion_notificacion($codigo_notificacion){

		$this->db->where('codigo_notificacion',$codigo_notificacion);
		$this->db->group_by("codigo_notificacion");

		$this->db->select('codigo_notificacion,remitente,titulo,tipo_notificacion,contenido,destinatario,rol_destinatario,fecha_envio,estado_lectura');

		$query = $this->db->get('notificaciones');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
		}
		else{
			return false;
		}

	}


	public function buscar_notificacion_usuarios($id,$rol,$id_persona,$inicio = FALSE,$cantidad = FALSE){

		if ($rol == "profesor") {
			$this->db->where("(rol_destinatario = 2 OR rol_destinatario = 3)");
			$this->db->where('destinatario',$id_persona);
			$this->db->where('categoria_notificacion',"Mensajes");
		}
		elseif ($rol == "estudiante") {
			$this->db->where("(rol_destinatario = 1 OR rol_destinatario = 3)");
			$this->db->where('destinatario',$id_persona);
			$this->db->where('categoria_notificacion',"Mensajes");
		}
		elseif ($rol == "acudiente") {
			$this->db->where("(rol_destinatario = 1 OR rol_destinatario = 3)");
			$this->db->where('destinatario',$id_persona);
			$this->db->where('categoria_notificacion',"Mensajes");
		}

		$this->db->order_by('fecha_envio', 'desc');

		$this->db->where("(notificaciones.titulo LIKE '".$id."%' OR notificaciones.tipo_notificacion LIKE '".$id."%' OR notificaciones.fecha_envio LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->select('id_notificacion,codigo_notificacion,categoria_notificacion,remitente,titulo,tipo_notificacion,contenido,destinatario,rol_destinatario,fecha_envio,estado_lectura');
		$query = $this->db->get('notificaciones');

		return $query->result();
		
	}


	public function total_notificaciones($rol,$id_persona){

		if ($rol == "profesor") {
			
			$this->db->where("(rol_destinatario = 2 OR rol_destinatario = 3)");
			$this->db->where('estado_lectura',0);
			$this->db->where('destinatario',$id_persona);
		}
		elseif ($rol == "estudiante") {
			$this->db->where("(rol_destinatario = 1 OR rol_destinatario = 3)");
			$this->db->where('estado_lectura',0);
			$this->db->where('destinatario',$id_persona);
		}
		elseif ($rol == "acudiente") {
			$this->db->where("(rol_destinatario = 1 OR rol_destinatario = 3)");
			$this->db->where('estado_lectura',0);
			$this->db->where('destinatario',$id_persona);
		}

		$query = $this->db->get('notificaciones');
		return $query->result();
	}


	public function vistaprevia_notificaciones($rol,$id_persona){


		if ($rol == "profesor") {
			
			$this->db->where("(rol_destinatario = 2 OR rol_destinatario = 3)");
			$this->db->where('destinatario',$id_persona);
		}
		elseif ($rol == "estudiante") {
			$this->db->where("(rol_destinatario = 1 OR rol_destinatario = 3)");
			$this->db->where('destinatario',$id_persona);
		}
		elseif ($rol == "acudiente") {
			$this->db->where("(rol_destinatario = 1 OR rol_destinatario = 3)");
			$this->db->where('destinatario',$id_persona);
		}

		$this->db->order_by('fecha_envio', 'desc');
		$this->db->limit(5);

		$query = $this->db->get('notificaciones');
		return $query->result();
	}


	public function actualizar_estado_notificacion($rol,$id_persona){

		$notificacion = array(

			'estado_lectura' => '1'
		);
		
		if ($rol == "profesor") {

			$this->db->where("(rol_destinatario = 2 OR rol_destinatario = 3)");
			$this->db->where('estado_lectura',0);
			$this->db->where('destinatario',$id_persona);
		}
		elseif ($rol == "estudiante") {
			$this->db->where("(rol_destinatario = 1 OR rol_destinatario = 3)");
			$this->db->where('estado_lectura',0);
			$this->db->where('destinatario',$id_persona);
		}
		elseif ($rol == "acudiente") {
			$this->db->where("(rol_destinatario = 1 OR rol_destinatario = 3)");
			$this->db->where('estado_lectura',0);
			$this->db->where('destinatario',$id_persona);
		}

		if ($this->db->update('notificaciones', $notificacion))

			return true;
		else
			return false;
	}


	//Esta funcion me permite obtener los profesores activos
    public function obtener_profesores(){

    	$this->db->where('profesores.estado_profesor',"Activo");
		$this->db->join('profesores', 'personas.id_persona = profesores.id_persona');
		$query = $this->db->get('personas');
		return $query->result_array();
	}

	//Esta funcion me permite obtener los estudiantes matriculados
    public function obtener_estudiantes(){

    	$this->db->where('matriculas.estado_matricula',"Activo");
		$this->db->join('matriculas', 'personas.id_persona = matriculas.id_estudiante');
		$query = $this->db->get('personas');
		return $query->result_array();
	}

	//Esta funcion me permite obtener los acudientes que tienen acudidos
	public function obtener_acudientes(){

		$this->db->where('matriculas.estado_matricula',"Activo");
		$this->db->join('matriculas', 'personas.id_persona = matriculas.id_acudiente');
		$query = $this->db->get('personas');
		return $query->result_array();
	}


	//Esta Funcion Me Permite Enviar Una Notificacion A Todos Los Acudientes Conectados En La App Movil
	public function enviar_notificacionFirebase($titulo,$contenido){

		$TokensAcudientes = $this->notificaciones_model->obtener_TokensAcudientes();

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

	//Con esta Funcion obtengo un array con los tokens de los todos los acudientes
	public function obtener_TokensAcudientes(){

		$this->db->where('usuarios.id_rol',4);

		$this->db->join('matriculas', 'personas.id_persona = matriculas.id_acudiente');
		$this->db->join('usuarios', 'matriculas.id_acudiente = usuarios.id_persona');

		$this->db->select('usuarios.token');

		$query = $this->db->get('personas');

		$row = $query->result_array();

		//array sencillo para los tokens
		$tokens = array();

		for ($i=0; $i < count($row) ; $i++) { 
			$tokens[] = $row[$i]['token'];
		}
		
		//array con los token de los dispositvos a los cuales va ir dirgido la notificacion
		return $tokens;
	}


	




}