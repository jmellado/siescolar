<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estudiantes_model extends CI_Model {

	public function insertar_estudiante($estudiante,$estudiante2,$estudiante3){
		if ($this->db->insert('personas', $estudiante) && $this->db->insert('estudiantes', $estudiante2) && $this->db->insert('usuarios', $estudiante3)) 
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

	public function buscar_estudiante($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('nombres',$id,'after');
		$this->db->or_like('apellido1',$id,'after');
		$this->db->or_like('apellido2',$id);
		$this->db->or_like('identificacion',$id);
		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}
		$this->db->join('estudiantes', 'personas.id_persona = estudiantes.id_persona');  //nada mas add is line
		$this->db->join('departamentos', 'personas.departamento_expedicion = departamentos.id_departamento');  //nada mas add is line
		$this->db->join('municipios', 'personas.municipio_expedicion = municipios.id_municipio');  //nada mas add is line
		$query = $this->db->get('personas');

		//if ($query->num_rows() > 0) {
			return $query->result();
		//}
		//else{
			//return false;
		//}

	}

	public function modificar_estudiante($id,$estudiante){

		//$this->db->where('identificacion',$id);
		$this->db->where('id_persona',$id);

		if ($this->db->update('personas', $estudiante))

			return true;
		else
			return false;
	}

	public function modificar_estudiante2($id,$estudiante2){

		//$this->db->where('identificacion',$id);
		$this->db->where('id_persona',$id);

		if ($this->db->update('estudiantes', $estudiante2))

			return true;
		else
			return false;
	}

	public function modificar_estudiante3($id,$estudiante3){

		//$this->db->where('identificacion',$id);
		$this->db->where('id_persona',$id);

		if ($this->db->update('usuarios', $estudiante3))

			return true;
		else
			return false;
	}

	public function eliminar_estudiante($id){

     	$this->db->where('id_persona',$id);
		$consulta = $this->db->delete('usuarios');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    /*public function eliminar_estudiante2($id){

     	$this->db->where('id_persona',$id);
		$consulta = $this->db->delete('estudiantes');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }
    public function eliminar_estudiante3($id){

     	$this->db->where('id_persona',$id);
		$consulta = $this->db->delete('personas');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }*/


    public function obtener_ultimo_id(){

		$this->db->select_max('id_persona');
		$query = $this->db->get('personas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_persona'];
        return $data['query'];
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




	
	
}