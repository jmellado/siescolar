<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuraciones_model extends CI_Model {


	public function insertar_datos_institucion($institucion){
		if ($this->db->insert('datos_institucion', $institucion)) 
			return true;
		else
			return false;
	}

	public function validar_existencia(){

		$query = $this->db->get('datos_institucion');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function modificar_datos_institucion($institucion){

		if ($this->db->update('datos_institucion', $institucion))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id');
		$query = $this->db->get('datos_institucion');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id'];
        return $data['query'];
	}


	public function buscar_datos_institucion(){

		$query = $this->db->get('datos_institucion');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else{
			return false;
		}

	}


	//**************************** FUNCIONES PERIODOS DE EVALUACION ****************************************
	public function validar_existencia_actividad($nombre,$ano_lectivo){

		$this->db->where('nombre_actividad',$nombre);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('cronogramas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function obtener_ultimo_idactividad(){

		$this->db->select_max('id_actividad');
		$query = $this->db->get('cronogramas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_actividad'];
        return $data['query'];
	}


	public function insertar_periodo($actividad){
		if ($this->db->insert('cronogramas', $actividad)) 
			return true;
		else
			return false;
	}


	public function buscar_periodo($id,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cronogramas.ano_lectivo',$ano_lectivo);

		$this->db->where("(cronogramas.nombre_actividad LIKE '".$id."%' OR cronogramas.estado_actividad LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->select('cronogramas.id_actividad,cronogramas.nombre_actividad,cronogramas.fecha_inicial,cronogramas.fecha_final,cronogramas.estado_actividad,');
		
		$query = $this->db->get('cronogramas');

		return $query->result();
		
	}


	public function modificar_periodo($id_actividad,$actividad){

	
		$this->db->where('id_actividad',$id_actividad);

		if ($this->db->update('cronogramas', $actividad))

			return true;
		else
			return false;
	}

}