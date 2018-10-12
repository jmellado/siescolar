<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model {


	public function insertar_usuario($usuario,$usuario2,$usuario3){

		//NUEVA TRANSACCION
		$this->db->trans_start();
		$this->db->insert('personas', $usuario);
		$this->db->insert('administradores', $usuario2);
		$this->db->insert('usuarios', $usuario3);
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


	public function buscar_usuario($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('personas.identificacion',$id,'after');
		$this->db->or_like('personas.nombres',$id,'after');
		$this->db->or_like('personas.apellido1',$id,'after');
		$this->db->or_like('personas.apellido2',$id,'after');
		$this->db->or_like('roles.nombre_rol',$id,'after');

		$this->db->order_by('roles.nombre_rol', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('personas', 'usuarios.id_persona = personas.id_persona');
		$this->db->join('roles', 'usuarios.id_rol = roles.id_rol');
		$this->db->select('usuarios.id_usuario,usuarios.id_persona,usuarios.id_rol,usuarios.username,usuarios.password,usuarios.acceso,roles.nombre_rol,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2');
		
		$query = $this->db->get('usuarios');

		return $query->result();
		
	}


	public function modificar_usuario($id_usuario,$usuario){

		$this->db->where('id_usuario',$id_usuario);

		if ($this->db->update('usuarios', $usuario))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_persona');
		$query = $this->db->get('personas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_persona'];
        return $data['query'];
	}


	public function obtener_informacion_usuario($id_usuario){

		$this->db->where('id_usuario',$id_usuario);

		$this->db->join('personas', 'usuarios.id_persona = personas.id_persona');

		$query = $this->db->get('usuarios');

		if ($query->num_rows() > 0) {

			return $query->result_array();
		}
		else{
			return false;
		}
	}


	public function reestablecer_contrasena($id_usuario,$password){

		$this->db->where('id_usuario',$id_usuario);

		if ($this->db->update('usuarios', $password))

			return true;
		else
			return false;
	}

}