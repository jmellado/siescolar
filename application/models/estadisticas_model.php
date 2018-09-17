<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas_model extends CI_Model {

	public function llenar_anos_lectivosE(){

		$query = $this->db->get('anos_lectivos');
		return $query->result();
	}


	public function buscar_cincuentamejores($periodo,$jornada,$ano_lectivo){

		$this->db->where('matriculas.jornada',$jornada);
		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);

		$query = $this->db->get('matriculas');

		$estudiantes = $query->result_array();
		
		$total_estudiantes = count($query->result());
		$listado_estudiantes = array();
		$aux = array();

		for ($i=0; $i < $total_estudiantes; $i++) {

			$id_estudiante = $estudiantes[$i]['id_estudiante'];
			$id_curso = $estudiantes[$i]['id_curso'];

			$cu = $this->estadisticas_model->obtener_informacion_curso($id_curso);
			$id_grado = $cu[0]['id_grado'];

			$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
			$this->db->where('matriculas.id_estudiante',$id_estudiante);
			$this->db->where('notas.ano_lectivo',$ano_lectivo);
			$this->db->where('notas.id_estudiante',$id_estudiante);
			$this->db->where('notas.id_grado',$id_grado);
			
			$this->db->join('notas', 'matriculas.id_estudiante = notas.id_estudiante');
			$this->db->join('personas', 'notas.id_estudiante = personas.id_persona');
			$this->db->join('anos_lectivos', 'notas.ano_lectivo = anos_lectivos.id_ano_lectivo');
			$this->db->join('cursos', 'matriculas.id_curso = cursos.id_curso');
			$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
			$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');

			if ($periodo == "Primero") {
				
				$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,ROUND(AVG(IFNULL(notas.p1, 0.0)),1) as promedio,anos_lectivos.nombre_ano_lectivo,matriculas.jornada,matriculas.id_curso,grados.nombre_grado,grupos.nombre_grupo',false);
			}
			if ($periodo == "Segundo") {
				
				$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,ROUND(AVG(IFNULL(notas.p2, 0.0)),1) as promedio,anos_lectivos.nombre_ano_lectivo,matriculas.jornada,matriculas.id_curso,grados.nombre_grado,grupos.nombre_grupo',false);
			}
			if ($periodo == "Tercero") {
				
				$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,ROUND(AVG(IFNULL(notas.p3, 0.0)),1) as promedio,anos_lectivos.nombre_ano_lectivo,matriculas.jornada,matriculas.id_curso,grados.nombre_grado,grupos.nombre_grupo',false);
			}
			if ($periodo == "Cuarto") {
				
				$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,ROUND(AVG(IFNULL(notas.p4, 0.0)),1) as promedio,anos_lectivos.nombre_ano_lectivo,matriculas.jornada,matriculas.id_curso,grados.nombre_grado,grupos.nombre_grupo',false);
			}

			$query2 = $this->db->get('matriculas');

			$listado_estudiantes[] =$query2->row_array();
			
		}


		foreach ($listado_estudiantes as $key => $row) {
				//array auxiliar con los promedios de todos los estudiantes de un curso
				$aux[$key] = $row['promedio'];
		}

		//Ordenamos el array, descendentemente por el promedio de notas de cada estudiante matriculado en un respectivo curso, luego retornamos ese array
		array_multisort($aux, SORT_DESC, $listado_estudiantes);

		//Extraemos los 50 primeros elementos del array
		$listado_estudiantes = array_slice($listado_estudiantes, 0, 50);

		return $listado_estudiantes;
	
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


}