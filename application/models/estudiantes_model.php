<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estudiantes_model extends CI_Model {

	
	public function insertar_estudiante($estudiante,$estudiante2,$usuario,$padre,$madre,$e_p,$estado){

		//NUEVA TRANSACCION
		$this->db->trans_start();
		$this->db->insert('personas', $estudiante);
		$this->db->insert('estudiantes', $estudiante2);
		$this->db->insert('usuarios', $usuario);
		$this->db->insert('padres', $padre);
		$this->db->insert('madres', $madre);
		$this->db->insert('estudiantes_padres', $e_p);
		$this->db->insert('historial_estados', $estado);
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


	public function buscar_estudiante($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('personas.nombres',$id,'after');
		$this->db->or_like('personas.apellido1',$id,'after');
		$this->db->or_like('personas.apellido2',$id,'after');
		$this->db->or_like('personas.identificacion',$id,'after');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('estudiantes', 'personas.id_persona = estudiantes.id_persona');  //nada mas add is line
		$this->db->join('departamentos', 'personas.departamento_expedicion = departamentos.id_departamento');  //nada mas add is line
		$this->db->join('municipios', 'personas.municipio_expedicion = municipios.id_municipio');  //nada mas add is line
		$this->db->join('departamentos as d', 'personas.departamento_nacimiento = d.id_departamento');  //nada mas add is line
		$this->db->join('municipios as m', 'personas.municipio_nacimiento = m.id_municipio');  //nada mas add is line

		$this->db->join('estudiantes_padres as e_p', 'estudiantes.id_persona = e_p.id_estudiante');
		$this->db->join('padres', 'e_p.id_padre = padres.id_padre');
		$this->db->join('madres', 'e_p.id_madre = madres.id_madre');

		$query = $this->db->get('personas');

		
		return $query->result();
		
	}


	public function modificar_estudiante($id_persona,$id_padre,$id_madre,$estudiante,$estudiante2,$usuario,$padre,$madre){

		$this->db->trans_start();
		$this->db->where('id_persona',$id_persona);
		$this->db->update('personas', $estudiante);

		$this->db->where('id_persona',$id_persona);
		$this->db->update('estudiantes', $estudiante2);

		$this->db->where('id_persona',$id_persona);
		$this->db->update('usuarios', $usuario);

		$this->db->where('id_padre',$id_padre);
		$this->db->update('padres', $padre);

		$this->db->where('id_madre',$id_madre);
		$this->db->update('madres', $madre);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}
	}


	public function eliminar_estudiante($id_persona){

       	$this->db->trans_start();
       	$this->db->where('id_persona',$id_persona);
		$this->db->delete('usuarios');

		$this->db->where('id_persona',$id_persona);
		$this->db->delete('estudiantes');

		$this->db->where('id_estudiante',$id_persona);
		$this->db->delete('estudiantes_padres');

		$this->db->where('id_persona',$id_persona);
		$this->db->delete('historial_estados');

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


    public function obtener_ultimo_id(){

		$this->db->select_max('id_persona');
		$query = $this->db->get('personas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_persona'];
        return $data['query'];
	}


	public function obtener_ultimo_id_padres(){

		$this->db->select_max('id_padre');
		$query = $this->db->get('padres');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_padre'];
        return $data['query'];
	}


	public function obtener_ultimo_id_madres(){

		$this->db->select_max('id_madre');
		$query = $this->db->get('madres');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_madre'];
        return $data['query'];
	}


	public function obtener_identificacion($id_persona){

		$this->db->where('id_persona',$id_persona);
		$query = $this->db->get('personas');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['identificacion'];
		}
		else{
			return false;
		}

	}


	public function llenar_departamentos(){

		$query = $this->db->get('departamentos');
		return $query->result();
	}
	

	public function llenar_municipios($id){

		$this->db->where('id_departamento',$id);
		$query = $this->db->get('municipios');
		return $query->result();
	}


	public function ValidarExistencia_EstudianteEnMatriculas($id_estudiante){

		$this->db->where('id_estudiante',$id_estudiante);
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}
	
}