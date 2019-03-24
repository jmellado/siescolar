<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informes_promocion_model extends CI_Model {


	public function llenar_anos_lectivos(){

		$query = $this->db->get('anos_lectivos');
		return $query->result();
	}


	public function obtener_informacion_anolectivo($ano_lectivo){

		$this->db->where('id_ano_lectivo',$ano_lectivo);
		$query = $this->db->get('anos_lectivos');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
		}
		else{
			return false;
		}

	}


	//============ Por Jornada =============


	public function buscar_porjornada($ano_lectivo,$jornada){

		if ($jornada == "Todas") {

			$this->db->where('promocion.ano_lectivo',$ano_lectivo);
		}
		else{

			$this->db->where('promocion.ano_lectivo',$ano_lectivo);
			$this->db->where('cursos.jornada',$jornada);
		}

		$this->db->group_by("cursos.jornada");
		$this->db->group_by("promocion.situacion_academica");

		$this->db->order_by('cursos.jornada', 'asc');
		$this->db->order_by('promocion.situacion_academica', 'asc');

		$this->db->join('cursos', 'promocion.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('anos_lectivos', 'promocion.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('promocion.id_promocion,promocion.ano_lectivo,cursos.jornada,promocion.situacion_academica,COUNT(*) as total',false);

		$query = $this->db->get('promocion');

		return $query->result_array();

	}


	//============ Por Grado =============


	public function llenar_grados($ano_lectivo){

		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->where('estado_grado','Activo');

		$this->db->order_by('grados_educacion.nivel_educacion', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');

		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$query = $this->db->get('grados');
		return $query->result();
	}


	public function buscar_porgrado($ano_lectivo,$id_grado){

		if ($id_grado == "0") {

			$this->db->where('promocion.ano_lectivo',$ano_lectivo);
		}
		else{

			$this->db->where('promocion.ano_lectivo',$ano_lectivo);
			$this->db->where('cursos.id_grado',$id_grado);
		}

		$this->db->group_by("cursos.id_grado");
		$this->db->group_by("promocion.situacion_academica");

		$this->db->order_by('grados_educacion.nivel_educacion', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('promocion.situacion_academica', 'asc');

		$this->db->join('cursos', 'promocion.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('anos_lectivos', 'promocion.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('promocion.id_promocion,promocion.ano_lectivo,cursos.id_grado,grados.nombre_grado,promocion.situacion_academica,COUNT(*) as total',false);

		$query = $this->db->get('promocion');

		return $query->result_array();

	}


	//============ Por Curso =============


	public function llenar_cursos($ano_lectivo){

		$this->db->where('cursos.ano_lectivo',$ano_lectivo);

		$this->db->order_by('grados_educacion.nivel_educacion', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');
		$this->db->order_by('cursos.jornada', 'asc');

		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');
		
		$query = $this->db->get('cursos');
		return $query->result();
	}


	public function buscar_porcurso($ano_lectivo,$id_curso){

		if ($id_curso == "0") {

			$this->db->where('promocion.ano_lectivo',$ano_lectivo);
		}
		else{

			$this->db->where('promocion.ano_lectivo',$ano_lectivo);
			$this->db->where('promocion.id_curso',$id_curso);
		}

		$this->db->group_by("promocion.id_curso");
		$this->db->group_by("promocion.situacion_academica");

		$this->db->order_by('grados_educacion.nivel_educacion', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');
		$this->db->order_by('cursos.jornada', 'asc');
		$this->db->order_by('promocion.situacion_academica', 'asc');

		$this->db->join('cursos', 'promocion.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('anos_lectivos', 'promocion.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('promocion.id_promocion,promocion.ano_lectivo,promocion.id_curso,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,promocion.situacion_academica,COUNT(*) as total',false);

		$query = $this->db->get('promocion');

		return $query->result_array();

	}


}