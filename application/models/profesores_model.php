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

		$this->db->like('personas.identificacion',$id,'after');
		$this->db->or_like('personas.apellido1',$id,'after');
		$this->db->or_like('personas.apellido2',$id,'after');
		$this->db->or_like('personas.nombres',$id,'after');
		$this->db->or_like('personas.sexo',$id,'after');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('profesores', 'personas.id_persona = profesores.id_persona');  //nada mas add is line
		$this->db->join('paises', 'personas.pais_expedicion = paises.id_pais');
		$this->db->join('departamentos', 'personas.departamento_expedicion = departamentos.id_departamento');
		$this->db->join('municipios', 'personas.municipio_expedicion = municipios.id_municipio');

		$this->db->join('paises as p', 'personas.pais_nacimiento = p.id_pais');
		$this->db->join('departamentos as d', 'personas.departamento_nacimiento = d.id_departamento');
		$this->db->join('municipios as m', 'personas.municipio_nacimiento = m.id_municipio');

		$this->db->join('paises as pr', 'personas.pais_residencia = pr.id_pais');
		$this->db->join('departamentos as dr', 'personas.departamento_residencia = dr.id_departamento');
		$this->db->join('municipios as mr', 'personas.municipio_residencia = mr.id_municipio');

		$query = $this->db->get('personas');


		return $query->result();

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


	public function ValidarExistencia_ProfesorEnCargasAcademicas($id_profesor){

		$this->db->where('id_profesor',$id_profesor);
		$query = $this->db->get('cargas_academicas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function llenar_paises(){

		$query = $this->db->get('paises');
		return $query->result();
	}


	public function llenar_departamentos($id){

		$this->db->where('id_pais',$id);
		$query = $this->db->get('departamentos');
		return $query->result();
	}
	

	public function llenar_municipios($id){

		$this->db->where('id_departamento',$id);
		$query = $this->db->get('municipios');
		return $query->result();
	}
	
}