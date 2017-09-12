<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notas_model extends CI_Model {


	public function modificar_nota($data,$id_estudiante,$id_asignatura){

		$this->db->where('id_estudiante',$id_estudiante);
		$this->db->where('id_asignatura',$id_asignatura);

		if ($this->db->update('notas', $data))

			return true;
		else
			return false;

	}


	public function validar_fechaIngresoNotas($periodo,$fecha_actual){

		$sql= "SELECT nombre_actividad FROM cronogramas WHERE nombre_actividad ='". $periodo."' AND '".$fecha_actual."' >= fecha_inicial AND '".$fecha_actual."' <= fecha_final";

		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) 
			return true;
		else
			return false;
		
	}



	public function buscar_nota($id,$inicio = FALSE,$cantidad = FALSE,$id_grado = FALSE,$id_grupo = FALSE,$id_asignatura = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$id_salon = $this->notas_model->obtener_id_salon($id_grado,$id_grupo);


		$this->db->where('matriculas.id_salon',$id_salon);
		$this->db->where('notas.id_asignatura',$id_asignatura);
		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		

		if ($inicio !== FALSE && $cantidad !== FALSE && $id_grado !== FALSE && $id_grupo !== FALSE && $id_asignatura != FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('estudiantes', 'matriculas.id_estudiante = estudiantes.id_persona');
		$this->db->join('notas', 'matriculas.id_estudiante = notas.id_estudiante');

		//$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,notas.p1,notas.p2,notas.p3,notas.p4,notas.nota_final,notas.fallas');
		$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,IFNULL(notas.p1,"") as p1,IFNULL(notas.p2,"") as p2,IFNULL(notas.p3,"") as p3,IFNULL(notas.p4,"") as p4,notas.nota_final,notas.fallas', false);
		
		$query = $this->db->get('matriculas');

		return $query->result();
	
	}


	public function obtener_id_salon($id_grado,$id_grupo){

		$this->db->where('id_grado',$id_grado);
		$this->db->where('id_grupo',$id_grupo);
		$query = $this->db->get('salones_grupo');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['id_salon'];
		}
		else{
			return false;
		}

	}



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













}

