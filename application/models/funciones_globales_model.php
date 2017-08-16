<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funciones_globales_model extends CI_Model {


	public function llenar_anos_lectivos(){

		$query = $this->db->get('anos_lectivos');
		return $query->result();
	}

	public function llenar_salones(){
		
		$id_ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('ano_lectivo',$id_ano_lectivo);
		$this->db->where('estado_salon','Activo');
		$this->db->where('disponibilidad','si');
		$query = $this->db->get('salones');
		return $query->result();
	}

	public function llenar_grados(){

		$id_ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('ano_lectivo',$id_ano_lectivo);
		$this->db->where('estado_grado','Activo');
		$query = $this->db->get('grados');
		return $query->result();
	}

	public function llenar_grupos(){

		$id_ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('ano_lectivo',$id_ano_lectivo);
		$this->db->where('estado_grupo','Activo');
		$query = $this->db->get('grupos');
		return $query->result();
	}

	public function obtener_fecha_actual(){

		$CI = & get_instance();
		$CI->load->helper('date');

		$fecha_horaGMT = now();  //Obtenemos la fecha actual en formato GMT

		$esVerano = date('I', $fecha_horaGMT); //Obtenemos TRUE si es horario de verano
		$zona_horaria = 'UM5'; //zona horaria de bogota

		$fechaLocal = gmt_to_local($fecha_horaGMT, $zona_horaria, $esVerano); //Convertimos la fecha GMT a local a partir del código de zona horaria

		$fechaLocal_Formateada = mdate("%d/%m/%Y %h:%i:%s %a", $fechaLocal); //Formato español (dd/mm/yyyy HH:mm:ss)

		return $fechaLocal_Formateada; 

	}

	public function obtener_anio_actual(){

		$fecha = $this->funciones_globales_model->obtener_fecha_actual();

		$anio = substr($fecha, 6,4);

		$this->db->where('nombre_ano_lectivo',$anio);
		$query = $this->db->get('anos_lectivos');
		$row = $query->result_array();
		
		return $row[0]['id_ano_lectivo'];

	}
}