<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notificaciones_model extends CI_Model {


	public function insertar_notificacion($notificacion){
		if ($this->db->insert('notificaciones', $notificacion)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($asunto){

		$this->db->where('asunto',$asunto);
		$query = $this->db->get('notificaciones');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_notificacion($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('notificaciones.asunto',$id,'after');
		$this->db->or_like('notificaciones.fecha_evento',$id,'after');
		$this->db->or_like('notificaciones.fecha_envio',$id,'after');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}
		
		$this->db->select('id_notificacion,autor,asunto,mensaje,destinatario,fecha_evento,hora_evento,DATE_FORMAT(hora_evento, "%r") as hora_evento1,fecha_envio,estado',false);
		$query = $this->db->get('notificaciones');

		return $query->result();
		
	}

	public function eliminar_notificacion($id){

     	$this->db->where('id_notificacion',$id);
		$consulta = $this->db->delete('notificaciones');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    public function modificar_notificacion($id_notificacion,$notificacion){

	
		$this->db->where('id_notificacion',$id_notificacion);

		if ($this->db->update('notificaciones', $notificacion))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_notificacion');
		$query = $this->db->get('notificaciones');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_notificacion'];
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


	public function obtener_informacion_notificacion($id_notificacion){

		$this->db->where('id_notificacion',$id_notificacion);

		$this->db->select('id_notificacion,autor,asunto,mensaje,destinatario,fecha_evento,DATE_FORMAT(hora_evento, "%r") as hora_evento,fecha_envio,estado',false);

		$query = $this->db->get('notificaciones');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
		}
		else{
			return false;
		}

	}








}