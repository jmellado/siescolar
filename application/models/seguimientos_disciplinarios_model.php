<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seguimientos_disciplinarios_model extends CI_Model {


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


	public function llenar_tipos_causales(){

		$query = $this->db->get('tipos_causales');
		return $query->result();
	}


	public function llenar_causales($id_tipo_causal){

		$this->db->where('causales.id_tipo_causal',$id_tipo_causal);

		$query = $this->db->get('causales');

		return $query->result();

	}


	public function llenar_acciones_pedagogicas(){

		$query = $this->db->get('acciones_pedagogicas');
		return $query->result();
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_seguimiento');
		$query = $this->db->get('seguimientos_disciplinarios');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_seguimiento'];
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


	public function insertar_seguimiento($seguimiento){
		if ($this->db->insert('seguimientos_disciplinarios', $seguimiento)) 
			return true;
		else
			return false;
	}


	public function buscar_seguimiento($id,$id_profesor,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('seguimientos_disciplinarios.id_profesor',$id_profesor);
		$this->db->where('seguimientos_disciplinarios.ano_lectivo',$ano_lectivo);
		
		$this->db->where("(personas.nombres LIKE '".$id."%' OR personas.apellido1 LIKE '".$id."%' OR personas.apellido2 LIKE '".$id."%' OR grados.nombre_grado LIKE '".$id."%' OR tipos_causales.tipo_causal LIKE '".$id."%' OR seguimientos_disciplinarios.fecha_causal LIKE '".$id."%' OR seguimientos_disciplinarios.estado_seguimiento LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('personas', 'seguimientos_disciplinarios.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'seguimientos_disciplinarios.id_curso = cursos.id_curso');
		$this->db->join('asignaturas', 'seguimientos_disciplinarios.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('tipos_causales', 'seguimientos_disciplinarios.id_tipo_causal = tipos_causales.id_tipo_causal');
		$this->db->join('causales', 'seguimientos_disciplinarios.id_causal = causales.id_causal');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');

		$this->db->select('seguimientos_disciplinarios.id_seguimiento,seguimientos_disciplinarios.id_curso,seguimientos_disciplinarios.id_asignatura,seguimientos_disciplinarios.id_estudiante,seguimientos_disciplinarios.id_tipo_causal,seguimientos_disciplinarios.id_causal,seguimientos_disciplinarios.descripcion_situacion,seguimientos_disciplinarios.fecha_causal,seguimientos_disciplinarios.id_accion_pedagogica,seguimientos_disciplinarios.descripcion_accion_pedagogica,seguimientos_disciplinarios.compromiso_estudiante,seguimientos_disciplinarios.observaciones,seguimientos_disciplinarios.estado_seguimiento,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,asignaturas.nombre_asignatura,personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,tipos_causales.tipo_causal,causales.causal');
		
		$query = $this->db->get('seguimientos_disciplinarios');

		return $query->result();
	
	}


	public function modificar_seguimiento($id_seguimiento,$seguimiento){

		$this->db->where('id_seguimiento',$id_seguimiento);

		if ($this->db->update('seguimientos_disciplinarios', $seguimiento))

			return true;
		else
			return false;
	}


	public function validar_estadoseguimiento($id_seguimiento){

		$this->db->where('id_seguimiento',$id_seguimiento);

		$this->db->select('estado_seguimiento');

		$query = $this->db->get('seguimientos_disciplinarios');

		if ($query->num_rows() > 0) {

			$seguimiento = $query->result_array();
			$estado_seguimiento = $seguimiento[0]['estado_seguimiento'];

			if ($estado_seguimiento == "Abierto") {
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}

	}


	public function cerrar_seguimiento($id_seguimiento){

		$this->db->where('id_seguimiento',$id_seguimiento);

		$seguimiento = array('estado_seguimiento' => "Cerrado");

		if ($this->db->update('seguimientos_disciplinarios', $seguimiento))

			return true;
		else
			return false;

	}


	//***************************** Funciones Para El Envio De Notificicaciones *****************

	//Esta Funcion Me Permite Enviar Una Notificacion A Todos Los Acudientes Conectados En La App Movil
	public function enviar_notificacionFirebase($destinatario){

		$TokensAcudientes = $this->seguimientos_disciplinarios_model->obtener_TokensAcudientes($destinatario);
		$nombre_estudiante = $this->seguimientos_disciplinarios_model->obtener_nombre_estudiante($destinatario);

		$titulo = "Seguimiento!!";
		$contenido = $nombre_estudiante." tiene un nuevo seguimiento disciplinario.";

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


	//Con esta Funcion obtengo un array con los tokens de los acudientes seleccionados
	//Recibo un array con los id de los estudiantes
	//Luego consulto el id del acudiente de cada estudiante
	//Po ultimo consulto el token de cada acudiente y lo voy almacenando en el array tokens el cual es retornado
	public function obtener_TokensAcudientes($destinatario){

		//array sencillo para los tokens
		$tokens = array();

		//for ($i=0; $i < count($destinatario) ; $i++) {

			$id_acudiente = $this->seguimientos_disciplinarios_model->consultar_acudiente($destinatario);

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




}