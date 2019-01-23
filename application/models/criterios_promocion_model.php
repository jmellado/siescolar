<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Criterios_promocion_model extends CI_Model {


	public function insertar_criterio_promocion($criterio_asignado){
		if ($this->db->insert('criterios_asignados', $criterio_asignado)) 
			return true;
		else
			return false;
	}


	public function validar_existencia($ano_lectivo,$id_grado,$id_criterio,$asignatura_especifica){

		if ($asignatura_especifica != "") {
			
			$this->db->where('ano_lectivo',$ano_lectivo);
			$this->db->where('id_grado',$id_grado);
			$this->db->where('id_criterio',$id_criterio);
			$this->db->where('asignatura_especifica',$asignatura_especifica);
			$query = $this->db->get('criterios_asignados');

			if ($query->num_rows() > 0) {
				return false;
			}
			else{
				return true;
			}

		}
		else{

			$this->db->where('ano_lectivo',$ano_lectivo);
			$this->db->where('id_grado',$id_grado);
			$this->db->where('id_criterio',$id_criterio);
			$query = $this->db->get('criterios_asignados');

			if ($query->num_rows() > 0) {
				return false;
			}
			else{
				return true;
			}
		}

	}


	public function validar_asignatura_especifica($ano_lectivo,$id_grado,$id_criterio,$asignatura_especifica){

		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->where('id_grado',$id_grado);
		$this->db->where('id_criterio',$id_criterio);
		$this->db->where('asignatura_especifica',$asignatura_especifica);
		$query = $this->db->get('criterios_asignados');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}	

	}


	public function buscar_criterios_promocion($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('criterios.nombre_criterio',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');
		$this->db->or_like('grados.nombre_grado',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",grados.nombre_grado,anos_lectivos.nombre_ano_lectivo)',$id,'after');

		$this->db->order_by('criterios_asignados.ano_lectivo', 'desc');
		$this->db->order_by('grados_educacion.nivel_educacion', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('criterios.codigo_criterio', 'asc');
		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('grados', 'criterios_asignados.id_grado = grados.id_grado');
		$this->db->join('criterios', 'criterios_asignados.id_criterio = criterios.id_criterio');
		$this->db->join('asignaturas', 'criterios_asignados.asignatura_especifica = asignaturas.id_asignatura','left');
		$this->db->join('anos_lectivos', 'criterios_asignados.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('criterios_asignados.id_criterio_asignado,criterios_asignados.ano_lectivo,criterios_asignados.id_grado,criterios_asignados.id_criterio,IFNULL(criterios_asignados.numero_areas_asignaturas,"") as numero_areas_asignaturas,IFNULL(criterios_asignados.porcentaje_inasistencias,"") as porcentaje_inasistencias,IFNULL(criterios_asignados.asignatura_especifica,"") as asignatura_especifica,criterios.nombre_criterio,criterios.codigo_criterio,grados.nombre_grado,IFNULL(asignaturas.nombre_asignatura,"") as nombre_asignatura,anos_lectivos.nombre_ano_lectivo',false);
		
		$query = $this->db->get('criterios_asignados');

		return $query->result();
		
	}


	public function eliminar_criterio_promocion($id_criterio_asignado){

     	$this->db->where('id_criterio_asignado',$id_criterio_asignado);
		$consulta = $this->db->delete('criterios_asignados');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }


	public function modificar_criterio_promocion($id_criterio_asignado,$criterio_asignado){

		$this->db->where('id_criterio_asignado',$id_criterio_asignado);

		if ($this->db->update('criterios_asignados', $criterio_asignado))

			return true;
		else
			return false;
	}


	public function llenar_criterios(){

		$this->db->order_by('codigo_criterio', 'asc');

		$query = $this->db->get('criterios');
		return $query->result();
	}


	public function llenar_grados(){

		$this->load->model('funciones_globales_model');
		$id_ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('ano_lectivo',$id_ano_lectivo);
		$this->db->where('estado_grado','Activo');

		$this->db->order_by('grados_educacion.nivel_educacion', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');

		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$query = $this->db->get('grados');
		return $query->result();
	}


	//Esta funcion me permite obtener las asignaturas por grado de la tabla pensum.
	public function llenar_asignaturas($id_grado){

		$this->db->where('id_grado',$id_grado);

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->join('asignaturas', 'pensum.id_asignatura = asignaturas.id_asignatura');
		$this->db->select('pensum.id_asignatura,asignaturas.nombre_asignatura');

		$query = $this->db->get('pensum');
		return $query->result();
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_criterio_asignado');
		$query = $this->db->get('criterios_asignados');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_criterio_asignado'];
        return $data['query'];
	}


	public function obtener_informacion_criterio_asignado($id_criterio_asignado){

		$this->db->where('id_criterio_asignado',$id_criterio_asignado);
		$query = $this->db->get('criterios_asignados');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
		}
		else{
			return false;
		}

	}



}