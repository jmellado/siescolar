<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seguimientos_disciplinarios_model extends CI_Model {


	public function llenar_cursos_profesor($id_profesor){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cargas_academicas.id_profesor',$id_profesor);
		$this->db->where('cargas_academicas.ano_lectivo',$ano_lectivo);

		$this->db->join('cursos', 'cargas_academicas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');

		$this->db->select('DISTINCT(cargas_academicas.id_curso),grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');

		$query = $this->db->get('cargas_academicas');
		return $query->result();
	}


	public function llenar_asignaturas_profesor($id_profesor,$id_curso){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cargas_academicas.id_profesor',$id_profesor);
		$this->db->where('cargas_academicas.id_curso',$id_curso);
		$this->db->where('cargas_academicas.ano_lectivo',$ano_lectivo);
		
		$this->db->join('asignaturas', 'cargas_academicas.id_asignatura = asignaturas.id_asignatura');

		$this->db->select('DISTINCT(cargas_academicas.id_asignatura),asignaturas.nombre_asignatura');

		$query = $this->db->get('cargas_academicas');
		return $query->result();
	}


	public function EstudiantesMatriculadosPorCurso($id_curso){

		$this->db->where('matriculas.id_curso',$id_curso);

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('matriculas');

		return $query->result();

	}


	public function llenar_tipos_causales(){

		$query = $this->db->get('tipos_causales');
		return $query->result();
	}


	public function llenar_causales($id_tipo_causal){

		$this->db->where('causales.id_tipo_causal',$id_tipo_causal);

		$query = $this->db->get('causales');

		return $query->result();

	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_seguimiento');
		$query = $this->db->get('seguimientos_disciplinarios');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_seguimiento'];
        return $data['query'];
	}


	public function obtener_fecha_actual(){

		$CI = & get_instance();
		$CI->load->helper('date');

		$fecha_horaGMT = now();  //Obtenemos la fecha actual en formato GMT

		$esVerano = date('I', $fecha_horaGMT); //Obtenemos TRUE si es horario de verano
		$zona_horaria = 'UM5'; //zona horaria de bogota

		$fechaLocal = gmt_to_local($fecha_horaGMT, $zona_horaria, $esVerano); //Convertimos la fecha GMT a local a partir del código de zona horaria

		$fechaLocal_Formateada = mdate("%Y/%m/%d %h:%i:%s %a", $fechaLocal); //Formato español (dd/mm/yyyy HH:mm:ss)

		return $fechaLocal_Formateada; 

	}


	public function insertar_seguimiento($seguimiento){
		if ($this->db->insert('seguimientos_disciplinarios', $seguimiento)) 
			return true;
		else
			return false;
	}


	public function buscar_seguimiento($id,$id_profesor,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('seguimientos_disciplinarios.id_profesor',$id_profesor);
		$this->db->where('seguimientos_disciplinarios.ano_lectivo',$ano_lectivo);
		
		$this->db->where("(personas.nombres LIKE '".$id."%' OR personas.apellido1 LIKE '".$id."%' OR personas.apellido2 LIKE '".$id."%' OR grados.nombre_grado LIKE '".$id."%' OR tipos_causales.tipo_causal LIKE '".$id."%' OR seguimientos_disciplinarios.fecha_causal LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('personas', 'seguimientos_disciplinarios.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'seguimientos_disciplinarios.id_curso = cursos.id_curso');
		$this->db->join('asignaturas', 'seguimientos_disciplinarios.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('tipos_causales', 'seguimientos_disciplinarios.id_tipo_causal = tipos_causales.id_tipo_causal');
		$this->db->join('causales', 'seguimientos_disciplinarios.id_causal = causales.id_causal');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');

		$this->db->select('seguimientos_disciplinarios.id_seguimiento,seguimientos_disciplinarios.id_curso,seguimientos_disciplinarios.id_asignatura,seguimientos_disciplinarios.id_estudiante,seguimientos_disciplinarios.id_tipo_causal,seguimientos_disciplinarios.id_causal,seguimientos_disciplinarios.descripcion_situacion,seguimientos_disciplinarios.fecha_causal,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,asignaturas.nombre_asignatura,personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,tipos_causales.tipo_causal,causales.causal');
		
		$query = $this->db->get('seguimientos_disciplinarios');

		return $query->result();
	
	}


	public function modificar_seguimiento($id_seguimiento,$seguimiento){

		$this->db->where('id_seguimiento',$id_seguimiento);

		if ($this->db->update('seguimientos_disciplinarios', $seguimiento))

			return true;
		else
			return false;
	}




}