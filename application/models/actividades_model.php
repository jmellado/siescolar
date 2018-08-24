<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actividades_model extends CI_Model {


	public function insertar_actividad($actividad){
		if ($this->db->insert('actividades', $actividad)) 
			return true;
		else
			return false;
	}


	public function buscar_actividad($id,$id_profesor,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('actividades.id_profesor',$id_profesor);
		$this->db->where('actividades.ano_lectivo',$ano_lectivo);
		
		$this->db->where("(grados.nombre_grado LIKE '".$id."%' OR grupos.nombre_grupo LIKE '".$id."%' OR actividades.descripcion_actividad LIKE '".$id."%' OR actividades.periodo LIKE '".$id."%' OR asignaturas.nombre_asignatura LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('cursos', 'actividades.id_curso = cursos.id_curso');
		$this->db->join('asignaturas', 'actividades.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('actividades.id_actividad,actividades.descripcion_actividad,actividades.id_curso,actividades.id_asignatura,actividades.periodo,actividades.fecha_registro,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,asignaturas.nombre_asignatura');
		
		$query = $this->db->get('actividades');

		return $query->result();
	
	}


	public function eliminar_actividad($id_actividad){

     	$this->db->where('id_actividad',$id_actividad);
		$consulta = $this->db->delete('actividades');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }


    public function modificar_actividad($id_actividad,$actividad){

		$this->db->where('id_actividad',$id_actividad);

		if ($this->db->update('actividades', $actividad))

			return true;
		else
			return false;
	}


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


	public function obtener_ultimo_id(){

		$this->db->select_max('id_actividad');
		$query = $this->db->get('actividades');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_actividad'];
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


	public function EstudiantesMatriculadosPorCurso($id_curso){

		$this->db->where('matriculas.id_curso',$id_curso);

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('matriculas');

		return $query->result_array();

	}


	//Esta Funcion permite registrar los estudiantes en una determinada actividad, para el posterior registro de notas.
	public function insertar_estudiantesPoractividad($id_actividad,$id_curso){

		$estudiantes = $this->actividades_model->EstudiantesMatriculadosPorCurso($id_curso);

		if ($estudiantes != false) {
			
			//NUEVA TRANSACCION
			$this->db->trans_start();

				for ($i=0; $i < count($estudiantes); $i++) { 
					
					//array para insertar en la tabla notas_actividades
		        	$notas_actividades = array(
					'id_estudiante' =>$estudiantes[$i]['id_estudiante'],
					'id_actividad' =>$id_actividad);

					$this->db->insert('notas_actividades', $notas_actividades);
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
			return true;
		}

	}



	//===================== Funciones Para La Calificacion De Actividades =======================


	public function buscar_actividadCA($id,$id_profesor,$periodo,$id_curso,$id_asignatura,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('actividades.id_profesor',$id_profesor);
		$this->db->where('actividades.ano_lectivo',$ano_lectivo);
		$this->db->where('actividades.periodo',$periodo);
		$this->db->where('actividades.id_curso',$id_curso);
		$this->db->where('actividades.id_asignatura',$id_asignatura);
		
		//$this->db->where("(grados.nombre_grado LIKE '".$id."%' OR grupos.nombre_grupo LIKE '".$id."%' OR actividades.descripcion_actividad LIKE '".$id."%' OR actividades.periodo LIKE '".$id."%' OR asignaturas.nombre_asignatura LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('cursos', 'actividades.id_curso = cursos.id_curso');
		$this->db->join('asignaturas', 'actividades.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('actividades.id_actividad,actividades.descripcion_actividad,actividades.id_curso,actividades.id_asignatura,actividades.periodo,actividades.fecha_registro,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,asignaturas.nombre_asignatura');
		
		$query = $this->db->get('actividades');

		return $query->result();
	
	}





}