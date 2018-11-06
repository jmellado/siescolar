<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Causales_model extends CI_Model {


	public function insertar_tipo_causal($tipo){
		if ($this->db->insert('tipos_causales', $tipo)) 
			return true;
		else
			return false;
	}


	public function validar_existencia_tipo_causal($tipo_causal){

		$this->db->where('tipo_causal',$tipo_causal);
		$query = $this->db->get('tipos_causales');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function buscar_tipo_causal($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('tipos_causales.id_tipo_causal',$id,'after');
		$this->db->or_like('tipos_causales.tipo_causal',$id,'after');

		$this->db->order_by('tipos_causales.tipo_causal', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->select('tipos_causales.id_tipo_causal,tipos_causales.tipo_causal');
		
		$query = $this->db->get('tipos_causales');

		return $query->result();
		
	}


	public function obtener_ultimo_id_tipo_causal(){

		$this->db->select_max('id_tipo_causal');
		$query = $this->db->get('tipos_causales');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_tipo_causal'];
        return $data['query'];
	}


	public function modificar_tipo_causal($id_tipo,$tipo){

		$this->db->where('id_tipo_causal',$id_tipo);

		if ($this->db->update('tipos_causales', $tipo))

			return true;
		else
			return false;
	}


	public function obtener_nombre_tipo($id_tipo){

		$this->db->where('id_tipo_causal',$id_tipo);
		$query = $this->db->get('tipos_causales');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['tipo_causal'];
		}
		else{
			return false;
		}

	}


	public function ValidarExistencia_TipoEnCausales($id_tipo){

		$this->db->where('id_tipo_causal',$id_tipo);
		$query = $this->db->get('causales');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function eliminar_tipo_causal($id){

     	$this->db->where('id_tipo_causal',$id);
		$consulta = $this->db->delete('tipos_causales');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }



    //================ Funciones Para La Gestion De Causales ==================


	public function insertar_causal($caus){
		if ($this->db->insert('causales', $caus)) 
			return true;
		else
			return false;
	}


	public function validar_existencia_causal($causal){

		$this->db->where('causal',$causal);
		$query = $this->db->get('causales');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function buscar_causal($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('causales.causal',$id,'after');
		$this->db->or_like('tipos_causales.tipo_causal',$id,'after');

		$this->db->order_by('tipos_causales.tipo_causal', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('tipos_causales', 'causales.id_tipo_causal = tipos_causales.id_tipo_causal');

		$this->db->select('causales.id_causal,causales.causal,tipos_causales.id_tipo_causal,tipos_causales.tipo_causal');
		
		$query = $this->db->get('causales');

		return $query->result();
		
	}


	public function obtener_ultimo_id_causal(){

		$this->db->select_max('id_causal');
		$query = $this->db->get('causales');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_causal'];
        return $data['query'];
	}


	public function modificar_causal($id_causal,$caus){

		$this->db->where('id_causal',$id_causal);

		if ($this->db->update('causales', $caus))

			return true;
		else
			return false;
	}


	public function obtener_nombre_causal($id_causal){

		$this->db->where('id_causal',$id_causal);
		$query = $this->db->get('causales');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['causal'];
		}
		else{
			return false;
		}

	}


	public function ValidarExistencia_CausalEnSeguimientos($id_causal){

		$this->db->where('id_causal',$id_causal);
		$query = $this->db->get('seguimientos_disciplinarios');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function eliminar_causal($id){

     	$this->db->where('id_causal',$id);
		$consulta = $this->db->delete('causales');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }


    public function llenar_tipos_causales(){

    	$this->db->order_by('tipos_causales.tipo_causal', 'asc');

		$query = $this->db->get('tipos_causales');
		return $query->result();
	}


}