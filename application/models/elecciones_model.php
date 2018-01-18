<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elecciones_model extends CI_Model {


	public function insertar_eleccion($eleccion){
		if ($this->db->insert('elecciones', $eleccion)) 
			return true;
		else
			return false;
	}


	public function validar_existencia($nombre_eleccion,$ano_lectivo){

		$this->db->where('nombre_eleccion',$nombre_eleccion);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('elecciones');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function buscar_eleccion($id,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('elecciones.ano_lectivo',$ano_lectivo);

		$this->db->where("(elecciones.nombre_eleccion LIKE '".$id."%' OR elecciones.estado_eleccion LIKE '".$id."%' OR elecciones.fecha_inicio LIKE '".$id."%' OR elecciones.fecha_fin LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('anos_lectivos', 'elecciones.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->select('elecciones.id_eleccion,elecciones.nombre_eleccion,elecciones.descripcion,elecciones.fecha_inicio,elecciones.hora_inicio,elecciones.fecha_fin,elecciones.hora_fin,elecciones.ano_lectivo,elecciones.estado_eleccion,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('elecciones');

		return $query->result();
		
	}


	public function eliminar_eleccion($id_eleccion){

     	$this->db->where('id_eleccion',$id_eleccion);
		$consulta = $this->db->delete('elecciones');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }


    public function modificar_eleccion($id_eleccion,$eleccion){

	
		$this->db->where('id_eleccion',$id_eleccion);

		if ($this->db->update('elecciones', $eleccion))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_eleccion');
		$query = $this->db->get('elecciones');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_eleccion'];
        return $data['query'];
	}


	public function obtener_informacion_eleccion($id_eleccion){

		$this->db->where('id_eleccion',$id_eleccion);
		$query = $this->db->get('elecciones');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
		}
		else{
			return false;
		}

	}


	public function validar_eleccion_candidatos($id_eleccion){

		$this->db->where('id_eleccion',$id_eleccion);
		$query = $this->db->get('candidatos_eleccion');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}




}