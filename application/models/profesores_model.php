<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profesores_model extends CI_Model {

	public function insertar_profesor($profesor,$profesor2,$profesor3){
		if ($this->db->insert('personas', $profesor) && $this->db->insert('profesores', $profesor2) && $this->db->insert('usuarios', $profesor3)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($id){

		$this->db->where('identificacion',$id);
		$query = $this->db->get('personas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_profesor($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('nombres',$id,'after');
		$this->db->or_like('apellido1',$id,'after');
		$this->db->or_like('apellido2',$id);
		$this->db->or_like('identificacion',$id);
		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}
		$this->db->join('profesores', 'personas.id_persona = profesores.id_persona');  //nada mas add is line
		$query = $this->db->get('personas');

		//if ($query->num_rows() > 0) {
			return $query->result();
		//}
		//else{
			//return false;
		//}

	}

	public function modificar_profesor($id,$profesor){

		$this->db->where('id_persona',$id);

		if ($this->db->update('personas', $profesor))

			return true;
		else
			return false;
	}

	public function modificar_profesor2($id,$profesor2){

		$this->db->where('id_persona',$id);

		if ($this->db->update('profesores', $profesor2))

			return true;
		else
			return false;
	}

	public function modificar_profesor3($id,$profesor3){

		$this->db->where('id_persona',$id);

		if ($this->db->update('usuarios', $profesor3))

			return true;
		else
			return false;
	}

	public function eliminar_profesor($id){

     	$this->db->where('id_persona',$id);
		$consulta = $this->db->delete('usuarios');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

   
    public function obtener_ultimo_id(){

		$this->db->select_max('id_persona');
		$query = $this->db->get('personas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_persona'];
        return $data['query'];
	}


	public function obtener_identificacion($id){

		$this->db->where('id_persona',$id);
		$query = $this->db->get('personas');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['identificacion'];
		}
		else{
			return false;
		}

	}


	
	
}