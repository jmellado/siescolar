<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imprimir_model extends CI_Model {



	//Esta funcion me permite obtener los estudiantes matriculados en un determinado curso y su respectivo promedio de notas por periodo
	public function EstudiantesPorCursos($id_curso,$periodo){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$cu = $this->imprimir_model->obtener_informacion_curso($id_curso);
		$id_grado = $cu[0]['id_grado'];

		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);

		$query = $this->db->get('matriculas');

		$estudiantes = $query->result_array();
		//$total_estudiantes = $query->num_rows();
		$total_estudiantes = count($query->result());
		$listado_estudiantes = array();
		$aux = array();

		for ($i=0; $i < $total_estudiantes; $i++) {

			$id_estudiante = $estudiantes[$i]['id_estudiante'];

			$this->db->where('notas.ano_lectivo',$ano_lectivo);
			$this->db->where('notas.id_estudiante',$id_estudiante);
			$this->db->where('notas.id_grado',$id_grado);
			
			$this->db->join('personas', 'notas.id_estudiante = personas.id_persona');
			$this->db->join('anos_lectivos', 'notas.ano_lectivo = anos_lectivos.id_ano_lectivo');

			if ($periodo == "Primero") {
				# code...
				$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,AVG(IFNULL(notas.p1, 0.0)) as promedio,anos_lectivos.nombre_ano_lectivo',false);
			}
			if ($periodo == "Segundo") {
				# code...
				$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,AVG(IFNULL(notas.p2, 0.0)) as promedio,anos_lectivos.nombre_ano_lectivo',false);
			}
			if ($periodo == "Tercero") {
				# code...
				$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,AVG(IFNULL(notas.p3, 0.0)) as promedio,anos_lectivos.nombre_ano_lectivo',false);
			}
			if ($periodo == "Cuarto") {
				# code...
				$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,AVG(IFNULL(notas.p4, 0.0)) as promedio,anos_lectivos.nombre_ano_lectivo',false);
			}

			$query2 = $this->db->get('notas');

			$listado_estudiantes[] =$query2->row_array();
			
		}


		foreach ($listado_estudiantes as $key => $row) {
				//array auxiliar con los promedios de todos los estudiantes de un curso
				$aux[$key] = $row['promedio'];
		}

		//Ordenamos el array, descendentemente por el promedio de notas de cada estudiante matriculado en un respectivo curso, luego retornamos ese array
		array_multisort($aux, SORT_DESC, $listado_estudiantes);

		return $listado_estudiantes;
		
	
	}



	//Esta funcion me permite obtener las notas y los logros asignados de las asignaturas dadas por un estudiante 
	public function Notas_Logros($id_curso,$periodo,$id_estudiante){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$cu = $this->imprimir_model->obtener_informacion_curso($id_curso);
		$id_grado = $cu[0]['id_grado'];

		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('logros_asignados.id_estudiante',$id_estudiante);
		$this->db->where('logros_asignados.periodo',$periodo);
		$this->db->where('pensum.id_grado',$id_grado);

		$this->db->join('asignaturas', 'notas.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('logros_asignados', 'notas.id_asignatura = logros_asignados.id_asignatura');

		$this->db->join('logros as l1', 'logros_asignados.id_logro1 = l1.id_logro');
		$this->db->join('logros as l2', 'logros_asignados.id_logro2 = l2.id_logro');
		$this->db->join('logros as l3', 'logros_asignados.id_logro3 = l3.id_logro');
		$this->db->join('logros as l4', 'logros_asignados.id_logro4 = l4.id_logro');
	
		$this->db->join('pensum', 'notas.id_asignatura = pensum.id_asignatura');
		$this->db->join('desempenos', 'notas.id_desempeno = desempenos.id_desempeno');

		$this->db->select('notas.id_asignatura,asignaturas.nombre_asignatura,notas.p1,notas.p2,notas.p3,notas.p4,notas.nota_final,logros_asignados.id_logro1,logros_asignados.id_logro2,logros_asignados.id_logro3,logros_asignados.id_logro4,l1.descripcion_logro as dl1,l2.descripcion_logro as dl2,l3.descripcion_logro as dl3,l4.descripcion_logro as dl4,pensum.intensidad_horaria,desempenos.nombre_desempeno');
		
		$query = $this->db->get('notas');

		return $query->result_array();
	
	}



	public function obtener_informacion_curso($id_curso){

		$this->db->where('cursos.id_curso',$id_curso);

		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('personas', 'cursos.director = personas.id_persona');
		$this->db->join('anos_lectivos', 'cursos.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$query = $this->db->get('cursos');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
		}
		else{
			return false;
		}

	}


	public function obtener_informacion_colegio(){

		$query = $this->db->get('datos_institucion');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
		}
		else{
			return false;
		}

	}


	//llenar el combo con todos los cursos de una respectiva jornada
	public function llenar_cursos($jornada){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cursos.jornada',$jornada);
		$this->db->where('cursos.ano_lectivo',$ano_lectivo);

		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');

		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');
		
		$query = $this->db->get('cursos');
		return $query->result();
	}


	//valido si existen estudiantes matriculados en un respectivo curso
	public function validar_existencia_estudiantes($id_curso){

		$this->db->where('id_curso',$id_curso);
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return true;
		}
		else{
			return false;
		}

	}


	//************************************************** FUNCIONES PARA IMPRIMIR PLANILLAS *************************************************


	public function EstudiantesMatriculadosPorCurso($id_curso){

		$this->db->where('matriculas.id_curso',$id_curso);

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('matriculas');

		return $query->result_array();

	}


}