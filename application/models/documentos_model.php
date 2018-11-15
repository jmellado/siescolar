<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Documentos_model extends CI_Model {


	public function insertar_documento($doc){
		if ($this->db->insert('documentos', $doc)) 
			return true;
		else
			return false;
	}


	public function validar_existencia_documento($nombre_documento){

		$this->db->where('nombre_documento',$nombre_documento);
		$query = $this->db->get('documentos');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function buscar_documento($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('documentos.descripcion_documento',$id,'after');
		$this->db->or_like('documentos.fecha_subida',$id,'after');

		$this->db->order_by('documentos.fecha_subida', 'desc');
		$this->db->order_by('documentos.nombre_documento', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->select('documentos.id_documento,documentos.descripcion_documento,documentos.nombre_documento,documentos.fecha_subida');
		
		$query = $this->db->get('documentos');

		return $query->result();
		
	}


	public function eliminar_documento($id){

     	$this->db->where('id_documento',$id);
		$consulta = $this->db->delete('documentos');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }


    public function modificar_documento($id,$doc){

		$this->db->where('id_documento',$id);

		if ($this->db->update('documentos', $doc))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id_documento(){

		$this->db->select_max('id_documento');
		$query = $this->db->get('documentos');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_documento'];
        return $data['query'];
	}


	public function obtener_nombre_documento($id){

		$this->db->where('id_documento',$id);
		$query = $this->db->get('documentos');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['nombre_documento'];
		}
		else{
			return false;
		}

	}


}