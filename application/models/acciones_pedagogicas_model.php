<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acciones_pedagogicas_model extends CI_Model {


	public function insertar_accion_pedagogica($accion){
		if ($this->db->insert('acciones_pedagogicas', $accion)) 
			return true;
		else
			return false;
	}


	public function validar_existencia($accion_pedagogica){

		$this->db->where('accion_pedagogica',$accion_pedagogica);
		$query = $this->db->get('acciones_pedagogicas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_accion_pedagogica');
		$query = $this->db->get('acciones_pedagogicas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_accion_pedagogica'];
        return $data['query'];
	}


	public function buscar_acciones_pedagogicas($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('acciones_pedagogicas.accion_pedagogica',$id,'after');

		$this->db->order_by('acciones_pedagogicas.accion_pedagogica', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->select('acciones_pedagogicas.id_accion_pedagogica,acciones_pedagogicas.accion_pedagogica');
		
		$query = $this->db->get('acciones_pedagogicas');

		return $query->result();
		
	}


	public function modificar_accion_pedagogica($id_accion_pedagogica,$accion){

		$this->db->where('id_accion_pedagogica',$id_accion_pedagogica);

		if ($this->db->update('acciones_pedagogicas', $accion))

			return true;
		else
			return false;
	}


	public function eliminar_accion_pedagogica($id_accion_pedagogica){

     	$this->db->where('id_accion_pedagogica',$id_accion_pedagogica);
		$consulta = $this->db->delete('acciones_pedagogicas');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }


    public function obtener_informacion_accion_pedagogica($id_accion_pedagogica){

		$this->db->where('id_accion_pedagogica',$id_accion_pedagogica);
		$query = $this->db->get('acciones_pedagogicas');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['accion_pedagogica'];
		}
		else{
			return false;
		}

	}


	public function ValidarExistencia_AccionPedagogicaEnSeguimientos($id_accion_pedagogica){

		$this->db->where('id_accion_pedagogica',$id_accion_pedagogica);
		$query = $this->db->get('seguimientos_disciplinarios');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}



}