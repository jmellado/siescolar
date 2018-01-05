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

	public function buscar_notificacion($id,$inicio = FALSE,$cantidad = FALSE){

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


	public function buscar_notificacion_usuarios($id,$rol,$inicio = FALSE,$cantidad = FALSE){

		if ($rol == "profesor") {
			$this->db->where("(destinatario = 2 OR destinatario = 3)");
		}
		elseif ($rol == "estudiante") {
			$this->db->where("(destinatario = 1 OR destinatario = 3)");
		}
		else{
			$this->db->where("(destinatario = 1 OR destinatario = 3)");
		}

		$this->db->order_by('fecha_envio', 'desc');

		$this->db->where("(notificaciones.asunto LIKE '".$id."%' OR notificaciones.fecha_evento LIKE '".$id."%' OR notificaciones.fecha_envio LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->select('id_notificacion,autor,asunto,mensaje,destinatario,fecha_evento,hora_evento,DATE_FORMAT(hora_evento, "%r") as hora_evento1,fecha_envio,estado',false);
		$query = $this->db->get('notificaciones');

		return $query->result();
		
	}


	public function total_notificaciones($rol){

		if ($rol == "profesor") {
			
			$this->db->where("(destinatario = 2 OR destinatario = 3)");
			$this->db->where('estado',0);
		}
		elseif ($rol == "estudiante") {
			$this->db->where("(destinatario = 1 OR destinatario = 3)");
			$this->db->where('estado',0);
		}
		else{
			$this->db->where("(destinatario = 1 OR destinatario = 3)");
			$this->db->where('estado',0);
		}

		$query = $this->db->get('notificaciones');
		return $query->result();
	}


	public function vistaprevia_notificaciones($rol){


		if ($rol == "profesor") {
			
			$this->db->where('destinatario',2);
			$this->db->or_where('destinatario',3);
		}
		elseif ($rol == "estudiante") {
			$this->db->where('destinatario',1);
			$this->db->or_where('destinatario',3);
		}
		else{
			$this->db->where('destinatario',1);
			$this->db->or_where('destinatario',3);
		}

		$this->db->order_by('fecha_envio', 'desc');
		$this->db->limit(3);

		$query = $this->db->get('notificaciones');
		return $query->result();
	}


	public function actualizar_estado_notificacion(){

		$notificacion = array(

			'estado' => '1'
			);
	
		$this->db->where('estado',0);

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

		$this->db->join('matriculas', 'personas.id_persona = matriculas.id_estudiante');
		$query = $this->db->get('personas');
		return $query->result_array();
	}

	//Esta funcion me permite obtener los acudientes que tienen acudidos
	public function obtener_acudientes(){

		$this->db->join('matriculas', 'personas.id_persona = matriculas.id_acudiente');
		$query = $this->db->get('personas');
		return $query->result_array();
	}


	




}