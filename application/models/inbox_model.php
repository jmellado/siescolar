<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbox_model extends CI_Model {


	public function buscar_estudiante($id,$id_curso,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		
		$this->db->where("(personas.nombres LIKE '".$id."%' OR personas.apellido1 LIKE '".$id."%' OR personas.apellido2 LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
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

		$fecha_horaGMT = now();  //Obtenemos la fecha actual en formato GMT

		$esVerano = date('I', $fecha_horaGMT); //Obtenemos TRUE si es horario de verano
		$zona_horaria = 'UM5'; //zona horaria de bogota

		$fechaLocal = gmt_to_local($fecha_horaGMT, $zona_horaria, $esVerano); //Convertimos la fecha GMT a local a partir del código de zona horaria

		$fechaLocal_Formateada = mdate("%Y/%m/%d %h:%i:%s %a", $fechaLocal); //Formato español (dd/mm/yyyy HH:mm:ss)

		return $fechaLocal_Formateada; 

	}


	public function insertar_notificacion($ultimo_id,$categoria_notificacion,$remitente,$titulo,$tipo_notificacion,$contenido,$destinatario,$rol_destinatario,$id_asignatura,$fecha_envio,$estado_lectura){

		//NUEVA TRANSACCION
		$this->db->trans_start();

		for ($i=0; $i < count($destinatario) ; $i++) {

			//array para insertar en la tabla notificaciones
        	$notificacion = array(
        	'codigo_notificacion' =>$ultimo_id,
        	'categoria_notificacion' =>$categoria_notificacion,
        	'remitente' =>$remitente,	
			'titulo' =>$titulo,
			'tipo_notificacion' =>$tipo_notificacion,
			'contenido' =>$contenido,
			'destinatario' =>$destinatario[$i],
			'rol_destinatario' =>$rol_destinatario,
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


}