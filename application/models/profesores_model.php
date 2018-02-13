<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profesores_model extends CI_Model {

	public function insertar_profesor($profesor,$profesor2,$usuario){
		
		//NUEVA TRANSACCION
		$this->db->trans_start();
		$this->db->insert('personas', $profesor);
		$this->db->insert('profesores', $profesor2);
		$this->db->insert('usuarios', $usuario);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}
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
		$this->db->or_like('apellido2',$id,'after');
		$this->db->or_like('identificacion',$id,'after');
		$this->db->or_like('sexo',$id,'after');

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

	public function modificar_profesor($id_persona,$profesor,$profesor2,$usuario){

		$this->db->trans_start();
		$this->db->where('id_persona',$id_persona);
		$this->db->update('personas', $profesor);

		$this->db->where('id_persona',$id_persona);
		$this->db->update('profesores', $profesor2);

		$this->db->where('id_persona',$id_persona);
		$this->db->where('id_rol','3');
		$this->db->update('usuarios', $usuario);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}

	}

	public function eliminar_profesor($id_persona,$senal = FALSE){

		if ($senal == "2") {
			
			$this->db->trans_start();
	       	$this->db->where('id_persona',$id_persona);
	       	$this->db->where('id_rol','3');
			$this->db->delete('usuarios');

			$this->db->where('id_persona',$id_persona);
			$this->db->delete('profesores');
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE){

				return false;
			}
			else{

				return true;
			}

		}
		else{

	       	$this->db->trans_start();
	       	$this->db->where('id_persona',$id_persona);
	       	$this->db->where('id_rol','3');
			$this->db->delete('usuarios');

			$this->db->where('id_persona',$id_persona);
			$this->db->delete('profesores');

			$this->db->where('id_persona',$id_persona);
			$this->db->delete('personas');
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE){

				return false;
			}
			else{

				return true;
			}
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


	public function EsAcudiente($id){

		$this->db->where('personas.id_persona',$id);
		$this->db->join('acudientes', 'personas.id_persona = acudientes.id_persona');
		$query = $this->db->get('personas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	
	
}