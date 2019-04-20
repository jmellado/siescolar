<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acudientes_model extends CI_Model {


	public function insertar_acudiente($acudiente,$acudiente2,$usuario){

		//NUEVA TRANSACCION
		$this->db->trans_start();
		$this->db->insert('personas', $acudiente);
		$this->db->insert('acudientes', $acudiente2);
		$this->db->insert('usuarios', $usuario);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}

	}


	public function insertar_acudiente_rol($acudiente2,$usuario){

		//NUEVA TRANSACCION
		$this->db->trans_start();
		
		$this->db->insert('acudientes', $acudiente2);
		$this->db->insert('usuarios', $usuario);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}

	}


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

	
	public function buscar_acudiente($id,$inicio = FALSE,$cantidad = FALSE){

		//$this->db->where('acudientes.estado_acudiente',"Activo");

		$this->db->where("(personas.identificacion LIKE '".$id."%' OR personas.nombres LIKE '".$id."%' OR personas.apellido1 LIKE '".$id."%' OR personas.apellido2 LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('acudientes', 'personas.id_persona = acudientes.id_persona');
		$this->db->select('personas.id_persona,personas.identificacion,personas.tipo_id,personas.nombres,personas.apellido1,personas.apellido2,personas.telefono,personas.email,personas.direccion,personas.barrio,acudientes.ocupacion,acudientes.telefono_trabajo,acudientes.direccion_trabajo,acudientes.estado_acudiente');
		
		$query = $this->db->get('personas');

		return $query->result();
		
	}

	public function eliminar_acudiente($id_persona,$senal){

		if ($senal == "2") {
			
	       	$this->db->trans_start();
	       	$this->db->where('id_persona',$id_persona);
	       	$this->db->where('id_rol','4');
			$this->db->delete('usuarios');

			$this->db->where('id_persona',$id_persona);
			$this->db->delete('acudientes');
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
			$this->db->delete('acudientes');

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

    
	public function modificar_acudiente($id_persona,$acudiente,$acudiente2,$usuario){

		$this->db->trans_start();
		$this->db->where('id_persona',$id_persona);
		$this->db->update('personas', $acudiente);

		$this->db->where('id_persona',$id_persona);
		$this->db->update('acudientes', $acudiente2);

		$this->db->where('id_persona',$id_persona);
		$this->db->where('id_rol','4');
		$this->db->update('usuarios', $usuario);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_persona');
		$query = $this->db->get('personas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_persona'];
        return $data['query'];
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


	public function ValidarExistencia_AcudienteEnMatriculas($id_acudiente){

		$this->db->where('id_acudiente',$id_acudiente);
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
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


	//Funcion para actualizar los usuarios que tenga creados una persona
	public function actualizar_usuarios_persona($id_persona,$identificacion,$nombres,$apellido1,$apellido2){

		$usuarios = $this->acudientes_model->obtener_usuarios_persona($id_persona);

		if ($usuarios != false) {

			//NUEVA TRANSACCION
			$this->db->trans_start();

				for ($i=0; $i < count($usuarios); $i++) {

					$id_usuario = $usuarios[$i]['id_usuario'];
					$id_rol = $usuarios[$i]['id_rol'];

					if ($id_rol == "1") {
						
						//aqui creamos el username de un administrador
						$user = mb_strtolower(substr($nombres, 0, 2));
						$name = mb_strtolower($apellido1);
						$username = $user.$name."ad".$id_persona;
					}
					elseif ($id_rol == "2") {
						
						//aqui creamos el username de un estudiante
						$user = mb_strtolower(substr($nombres, 0, 2));
						$name = mb_strtolower($apellido1);
						$username = $user.$name."es".$id_persona;
					}
					elseif ($id_rol == "3") {
						
						//aqui creamos el username de un profesor
						$user = mb_strtolower(substr($nombres, 0, 2));
						$name = mb_strtolower($apellido1);
						$username = $user.$name.$id_persona;
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
		$this->db->where("id_rol != '4'");
		$query = $this->db->get('usuarios');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
		}
		else{
			return false;
		}

	}

}