<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salones_grupos_model extends CI_Model {


	public function insertar_salon_grupo($salon_grupo){
		if ($this->db->insert('salones_grupo', $salon_grupo)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($id_salon){

		$this->db->where('id_salon',$id_salon);
		$query = $this->db->get('salones_grupo');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function validar_grado_grupo($id_grado,$id_grupo){

		$this->db->where('id_grado',$id_grado);
		$this->db->where('id_grupo',$id_grupo);
		$query = $this->db->get('salones_grupo');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_salon_grupo($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('salones.nombre_salon',$id,'after');
		$this->db->or_like('grados.nombre_grado',$id,'after');
		$this->db->or_like('grupos.nombre_grupo',$id);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}
		
		$this->db->join('salones', 'salones_grupo.id_salon = salones.id_salon');  //nada mas add is line  relacion con tabla salones
		$this->db->join('grados', 'salones_grupo.id_grado = grados.id_grado');  //nada mas add is line    relacion con tabla grados
		$this->db->join('grupos', 'salones_grupo.id_grupo = grupos.id_grupo');  //nada mas add is line    relacion con tabla grupos

		$this->db->select('salones_grupo.id_salon,salones_grupo.id_grado,salones_grupo.id_grupo,salones.nombre_salon,grados.nombre_grado,grupos.nombre_grupo'); //---------------------------- seleccion solo de campos a utilizar

		$query = $this->db->get('salones_grupo');

		return $query->result();
		
	}

	public function eliminar_salon_grupo($id){

     	$this->db->where('id_salon',$id);
		$consulta = $this->db->delete('salones_grupo');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    public function modificar_salon_grupo($id,$salon_grupo){

	
		$this->db->where('id_salon',$id);

		if ($this->db->update('salones_grupo', $salon_grupo))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_salon');
		$query = $this->db->get('salones_grupo');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_salon'];
        return $data['query'];
	}







}