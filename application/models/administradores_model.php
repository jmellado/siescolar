<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administradores_model extends CI_Model {


	public function insertar_administrador($administrador,$administrador2,$usuario){

		//NUEVA TRANSACCION
		$this->db->trans_start();
		$this->db->insert('personas', $administrador);
		$this->db->insert('administradores', $administrador2);
		$this->db->insert('usuarios', $usuario);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}

	}


	public function validar_existencia($identificacion){

		$this->db->where('identificacion',$identificacion);
		$query = $this->db->get('personas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function buscar_administrador($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->where('personas.id_persona != 1');

		$this->db->where("(personas.identificacion LIKE '".$id."%' OR personas.nombres LIKE '".$id."%' OR personas.apellido1 LIKE '".$id."%' OR personas.apellido2 LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('administradores', 'personas.id_persona = administradores.id_persona');
		$this->db->select('personas.id_persona,personas.identificacion,personas.tipo_id,personas.nombres,personas.apellido1,personas.apellido2,personas.telefono,personas.email,personas.direccion,personas.barrio');
		
		$query = $this->db->get('personas');

		return $query->result();
		
	}


	public function modificar_administrador($id_persona,$administrador,$administrador2,$usuario){

		$this->db->trans_start();
		$this->db->where('id_persona',$id_persona);
		$this->db->update('personas', $administrador);

		$this->db->where('id_persona',$id_persona);
		$this->db->update('administradores', $administrador2);

		$this->db->where('id_persona',$id_persona);
		$this->db->where('id_rol','1');
		$this->db->update('usuarios', $usuario);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}
	}


	public function eliminar_administrador($id_persona,$senal = FALSE){

		if ($senal == "2") {
			
	       	$this->db->trans_start();
	       	$this->db->where('id_persona',$id_persona);
	       	$this->db->where('id_rol','1');
			$this->db->delete('usuarios');

			$this->db->where('id_persona',$id_persona);
			$this->db->delete('administradores');
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
			$this->db->delete('usuarios');

			$this->db->where('id_persona',$id_persona);
			$this->db->delete('administradores');

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


	public function validar_sesion($id_persona){

		$id_persona_sesion = $this->session->userdata('id_persona');

		if ($id_persona == $id_persona_sesion) {
			
			return false;
		}
		else{

			return true;
		}
	}


	//==================  FUNCIONES PARA VALIDAR PERSONA EXISTENTE ==================


	public function validar_existencia_rol($identificacion,$rol){

		if ($rol == "acudientes") {
			
			$this->db->where('identificacion',$identificacion);
			$this->db->join('acudientes', 'personas.id_persona = acudientes.id_persona');
			$query = $this->db->get('personas');

			if ($query->num_rows() > 0) {
				return false;
			}
			else{
				return true;
			}
		}
		elseif ($rol == "estudiantes") {
			
			$this->db->where('identificacion',$identificacion);
			$this->db->join('estudiantes', 'personas.id_persona = estudiantes.id_persona');
			$query = $this->db->get('personas');

			if ($query->num_rows() > 0) {
				return false;

			}
			else{
				return true;
			}
		}
		elseif ($rol == "profesores") {
			
			$this->db->where('identificacion',$identificacion);
			$this->db->join('profesores', 'personas.id_persona = profesores.id_persona');
			$query = $this->db->get('personas');

			if ($query->num_rows() > 0) {
				return false;

			}
			else{
				return true;
			}
		}
		elseif ($rol == "administradores") {
			
			$this->db->where('identificacion',$identificacion);
			$this->db->join('administradores', 'personas.id_persona = administradores.id_persona');
			$query = $this->db->get('personas');

			if ($query->num_rows() > 0) {
				return false;

			}
			else{
				return true;
			}
		}


	}


	public function obtener_informacion_persona($id,$senal = FALSE){

		if ($senal == "2") {
			
			$this->db->where('id_persona',$id);
			$query = $this->db->get('personas');

			if ($query->num_rows() > 0) {
			
	        	return $query->result_array();
			}
			else{
				return false;
			}
		}
		else{
			$this->db->where('identificacion',$id);
			$query = $this->db->get('personas');

			if ($query->num_rows() > 0) {
			
	        	return $query->result_array();
			}
			else{
				return false;
			}
		}	

	}


	public function comprobar_estado_rol($id,$rol){

		if ($rol == "acudientes") {

			$this->db->where('identificacion',$id);
			$this->db->join('acudientes', 'personas.id_persona = acudientes.id_persona');
			$query = $this->db->get('personas');

			if ($query->num_rows() > 0) {
			
				$row = $query->result_array();
				$estado = $row[0]['estado_acudiente'];
				if ($estado == "Activo") {
					return false;
				}
				else{
					return true;
				}
			}
			else{
				return false;
			}
		}	
		elseif ($rol == "estudiantes") {

			$this->db->where('identificacion',$id);
			$this->db->join('estudiantes', 'personas.id_persona = estudiantes.id_persona');
			$query = $this->db->get('personas');

			if ($query->num_rows() > 0) {
			
				$row = $query->result_array();
				$estado = $row[0]['estado_estudiante'];
				if ($estado == "Inscrito" || $estado == "Matriculado") {
					return false;
				}
				else{
					return true;
				}
			}
			else{
				return false;
			}
			
		}

	}


	public function insertar_administrador_rol($administrador2,$usuario){

		//NUEVA TRANSACCION
		$this->db->trans_start();
		$this->db->insert('administradores', $administrador2);
		$this->db->insert('usuarios', $usuario);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}

	}


	//Funcion para actualizar los usuarios que tenga creados una persona
	public function actualizar_usuarios_persona($id_persona,$identificacion,$nombres,$apellido1,$apellido2){

		$usuarios = $this->administradores_model->obtener_usuarios_persona($id_persona);

		if ($usuarios != false) {

			//NUEVA TRANSACCION
			$this->db->trans_start();

				for ($i=0; $i < count($usuarios); $i++) {

					$id_usuario = $usuarios[$i]['id_usuario'];
					$id_rol = $usuarios[$i]['id_rol'];

					if ($id_rol == "2") {
						
						//aqui creamos el username de un estudiante
						$user = mb_strtolower(substr($nombres, 0, 2));
						$name = mb_strtolower(str_replace(" ", "", $apellido1));
						$username = $user.$name."es".$id_persona;
					}
					elseif ($id_rol == "3") {
						
						//aqui creamos el username de un profesor
						$user = mb_strtolower(substr($nombres, 0, 2));
						$name = mb_strtolower(str_replace(" ", "", $apellido1));
						$username = $user.$name.$id_persona;
					}
					elseif ($id_rol == "4") {
						
						//aqui creamos el username de un acudiente
						$user = mb_strtolower(substr($nombres, 0, 2));
						$name = mb_strtolower(str_replace(" ", "", $apellido1));
						$username = $user.$name."ac".$id_persona;
					}

					//array para actualizar en la tabla usuarios
					$usuario = array(
					'username'   =>$username,
					'password'   =>sha1($identificacion));

					$this->db->where('id_usuario',$id_usuario);
					$this->db->update('usuarios', $usuario);
					
				}

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE){

				return false;
			}
			else{

				return true;
			}

		}
		else{

			return false;
		}

	}


	//Funcion para obtener los usuarios que tenga creados una persona
	public function obtener_usuarios_persona($id_persona){

		$this->db->where('id_persona',$id_persona);
		$this->db->where("id_rol != '1'");
		$query = $this->db->get('usuarios');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
		}
		else{
			return false;
		}

	}


}