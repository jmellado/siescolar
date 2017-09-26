<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class asignar_logros_model extends CI_Model {



	public function buscar_profesor($id){

		$this->db->where('personas.identificacion',$id);

		$this->db->join('profesores', 'personas.id_persona = profesores.id_persona');

		$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('personas');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else{
			return false;
		}

	}


	public function llenar_grados_profesor($id_profesor){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cargas_academicas.id_profesor',$id_profesor);
		$this->db->where('cargas_academicas.ano_lectivo',$ano_lectivo);

		$this->db->join('grados', 'cargas_academicas.id_grado = grados.id_grado');

		$this->db->select('DISTINCT(cargas_academicas.id_grado),grados.nombre_grado');

		$query = $this->db->get('cargas_academicas');
		return $query->result();
	}


	public function llenar_grupos_profesor($id_profesor,$id_grado){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cargas_academicas.id_profesor',$id_profesor);
		$this->db->where('cargas_academicas.id_grado',$id_grado);
		$this->db->where('cargas_academicas.ano_lectivo',$ano_lectivo);

		$this->db->join('grupos', 'cargas_academicas.id_grupo = grupos.id_grupo');

		$this->db->select('DISTINCT(cargas_academicas.id_grupo),grupos.nombre_grupo');

		$query = $this->db->get('cargas_academicas');
		return $query->result();
	}


	public function llenar_asignaturas_profesor($id_profesor,$id_grado,$id_grupo){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cargas_academicas.id_profesor',$id_profesor);
		$this->db->where('cargas_academicas.id_grado',$id_grado);
		$this->db->where('cargas_academicas.id_grupo',$id_grupo);
		$this->db->where('cargas_academicas.ano_lectivo',$ano_lectivo);
		
		$this->db->join('asignaturas', 'cargas_academicas.id_asignatura = asignaturas.id_asignatura');

		$this->db->select('DISTINCT(cargas_academicas.id_asignatura),asignaturas.nombre_asignatura');

		$query = $this->db->get('cargas_academicas');
		return $query->result();
	}


	public function validar_fechaIngresoLogros($periodo,$fecha_actual){

		$sql= "SELECT nombre_actividad FROM cronogramas WHERE nombre_actividad ='". $periodo."' AND '".$fecha_actual."' >= fecha_inicial AND '".$fecha_actual."' <= fecha_final";

		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) 
			return true;
		else
			return false;
		
	}


	public function llenar_logros($periodo,$id_profesor,$id_grado,$id_asignatura){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('logros.periodo',$periodo);
		$this->db->where('logros.id_profesor',$id_profesor);
		$this->db->where('logros.id_grado',$id_grado);
		$this->db->where('logros.id_asignatura',$id_asignatura);
		$this->db->where('logros.ano_lectivo',$ano_lectivo);
		
		$this->db->select('logros.id_logro,logros.nombre_logro,logros.descripcion_logro');

		$query = $this->db->get('logros');
		return $query->result();
	}




}