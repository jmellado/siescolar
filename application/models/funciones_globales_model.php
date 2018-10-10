<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funciones_globales_model extends CI_Model {


	public function llenar_anos_lectivos(){

		$this->db->where('estado_ano_lectivo','Activo');
		$query = $this->db->get('anos_lectivos');
		return $query->result();
	}

	public function llenar_salones(){
		
		$id_ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('ano_lectivo',$id_ano_lectivo);
		$this->db->where('estado_salon','Activo');
		$this->db->where('disponibilidad','si');

		$this->db->order_by('nombre_salon', 'asc');

		$query = $this->db->get('salones');
		return $query->result();
	}

	public function llenar_grados(){

		$id_ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('ano_lectivo',$id_ano_lectivo);
		$this->db->where('estado_grado','Activo');

		$this->db->order_by('grados_educacion.nivel_educacion', 'asc');

		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$query = $this->db->get('grados');
		return $query->result();
	}

	public function llenar_grupos(){

		$id_ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('ano_lectivo',$id_ano_lectivo);
		$this->db->where('estado_grupo','Activo');

		$this->db->order_by('nombre_grupo', 'asc');

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

	/*public function obtener_anio_actual(){

		$fecha = $this->funciones_globales_model->obtener_fecha_actual();

		$anio = substr($fecha, 6,4);

		$this->db->where('nombre_ano_lectivo',$anio);
		$query = $this->db->get('anos_lectivos');
		$row = $query->result_array();
		
		return $row[0]['id_ano_lectivo'];

	}*/

	public function obtener_fecha_actual_corta(){

		$CI = & get_instance();
		$CI->load->helper('date');

		$fecha_horaGMT = now();  //Obtenemos la fecha actual en formato GMT

		$esVerano = date('I', $fecha_horaGMT); //Obtenemos TRUE si es horario de verano
		$zona_horaria = 'UM5'; //zona horaria de bogota

		$fechaLocal = gmt_to_local($fecha_horaGMT, $zona_horaria, $esVerano); //Convertimos la fecha GMT a local a partir del código de zona horaria

		$fechaLocal_Formateada = mdate("%Y/%m/%d", $fechaLocal); //Formato español (dd/mm/yyyy HH:mm:ss)

		return $fechaLocal_Formateada; 

	}

	public function obtener_anio_actual(){

		$this->db->where('estado_ano_lectivo','Activo');
		$query = $this->db->get('anos_lectivos');

		if ($query->num_rows() > 0) {

			$row = $query->result_array();
			$id_ano_lectivo = $row[0]['id_ano_lectivo'];

			return $id_ano_lectivo;
		}
		else{
			return false;
		}

	}


	//necesaria para guardar en la bd las fechas y horas de registro.
	public function obtener_fecha_actual2(){

		$CI = & get_instance();
		$CI->load->helper('date');

		$fecha_horaGMT = now();  //Obtenemos la fecha actual en formato GMT

		$esVerano = date('I', $fecha_horaGMT); //Obtenemos TRUE si es horario de verano
		$zona_horaria = 'UM5'; //zona horaria de bogota

		$fechaLocal = gmt_to_local($fecha_horaGMT, $zona_horaria, $esVerano); //Convertimos la fecha GMT a local a partir del código de zona horaria

		$fechaLocal_Formateada = mdate("%Y/%m/%d %h:%i:%s %a", $fechaLocal); //Formato español (dd/mm/yyyy HH:mm:ss)

		return $fechaLocal_Formateada; 

	}


	// Esta Funcion me permite obtener el estado de un anolectivo
	public function ValidarEstado_AnoLectivo($id_ano_lectivo){

		$this->db->where('id_ano_lectivo',$id_ano_lectivo);
		$query = $this->db->get('anos_lectivos');

		if ($query->num_rows() > 0) {

			$row = $query->result_array();
			$estado = $row[0]['estado_ano_lectivo'];

			if ($estado == "Activo") {
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
}