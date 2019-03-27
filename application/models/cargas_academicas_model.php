<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cargas_academicas_model extends CI_Model {


	public function insertar_cargas_academicas($cargas_academicas){
		if ($this->db->insert('cargas_academicas', $cargas_academicas)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($id_curso,$id_asignatura,$ano_lectivo){

		$this->db->where('id_curso',$id_curso);
		$this->db->where('id_asignatura',$id_asignatura);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('cargas_academicas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_cargas_academicas($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('personas.nombres',$id,'after');
		$this->db->or_like('personas.apellido1',$id,'after');
		$this->db->or_like('grados.nombre_grado',$id,'after');
		$this->db->or_like('asignaturas.nombre_asignatura',$id,'after');
		$this->db->or_like('grupos.nombre_grupo',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');
		$this->db->or_like('cursos.jornada',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",personas.nombres,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",personas.apellido1,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",personas.apellido2,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",personas.nombres,personas.apellido1,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",personas.nombres,personas.apellido1,personas.apellido2,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,asignaturas.nombre_asignatura,anos_lectivos.nombre_ano_lectivo)',$id,'after');

		$this->db->order_by('cargas_academicas.ano_lectivo', 'desc');
		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');
		$this->db->order_by('grados_educacion.nivel_educacion', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');
		$this->db->order_by('cursos.jornada', 'asc');
		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('personas', 'cargas_academicas.id_profesor = personas.id_persona');
		$this->db->join('cursos', 'cargas_academicas.id_curso = cursos.id_curso');
		$this->db->join('asignaturas', 'cargas_academicas.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('anos_lectivos', 'cargas_academicas.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('cargas_academicas.id_carga_academica,cargas_academicas.id_profesor,cargas_academicas.id_curso,cargas_academicas.id_asignatura,cargas_academicas.ano_lectivo,personas.nombres,personas.apellido1,personas.apellido2,grados.nombre_grado,grupos.nombre_grupo,asignaturas.nombre_asignatura,anos_lectivos.nombre_ano_lectivo,cursos.jornada');
		
		$query = $this->db->get('cargas_academicas');

		return $query->result();
		
	}

	public function eliminar_cargas_academicas($id_carga_academica){

     	$this->db->where('id_carga_academica',$id_carga_academica);
		$consulta = $this->db->delete('cargas_academicas');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    public function modificar_cargas_academicas($id_carga_academica,$cargas_academicas){

	
		$this->db->where('id_carga_academica',$id_carga_academica);

		if ($this->db->update('cargas_academicas', $cargas_academicas))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_carga_academica');
		$query = $this->db->get('cargas_academicas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_carga_academica'];
        return $data['query'];
	}


	public function obtener_informacion_carga($id_carga_academica){

		$this->db->where('id_carga_academica',$id_carga_academica);
		$query = $this->db->get('cargas_academicas');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
		}
		else{
			return false;
		}

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


	public function llenar_profesores(){

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('profesores', 'personas.id_persona = profesores.id_persona');

		$this->db->select('personas.id_persona,personas.nombres,personas.apellido1,personas.apellido2');

		$query = $this->db->get('personas');
		return $query->result();
	}


	public function llenar_cursos(){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cursos.ano_lectivo',$ano_lectivo);

		$this->db->order_by('cursos.jornada', 'asc');
		$this->db->order_by('grados_educacion.nivel_educacion', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');

		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');
		
		$query = $this->db->get('cursos');
		return $query->result();
	}


	//Esta Funcion me permite obtener el id_grado del curso seleccionado
	public function obtener_gradoPorcurso($id_curso){

		$this->db->where('cursos.id_curso',$id_curso);

		$this->db->select('cursos.id_grado');

		$query = $this->db->get('cursos');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['id_grado'];
		}
		else{
			return false;
		}

	}


	//Esta funcion me permite obtener la carga academica asignada a un profesor en el respectivo año lectivo
	public function buscar_cargas_academicasprofesor($id,$id_profesor,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('id_profesor',$id_profesor);
		$this->db->where('cargas_academicas.ano_lectivo',$ano_lectivo);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('cursos', 'cargas_academicas.id_curso = cursos.id_curso');

		$query = $this->db->get('cargas_academicas');
		
		$carga_academica = $query->result_array();
		$listado_cargas = array();

		for ($i=0; $i < count($carga_academica) ; $i++) { 
			
			$id_curso = $carga_academica[$i]['id_curso'];
			$id_grado = $carga_academica[$i]['id_grado'];
			$id_asignatura = $carga_academica[$i]['id_asignatura'];

			$this->db->where('cargas_academicas.id_profesor',$id_profesor);
			$this->db->where('cargas_academicas.id_curso',$id_curso);
			$this->db->where('cargas_academicas.ano_lectivo',$ano_lectivo);
			$this->db->where('pensum.id_grado',$id_grado);
			$this->db->where('pensum.id_asignatura',$id_asignatura);
			$this->db->where('pensum.ano_lectivo',$ano_lectivo);

			$this->db->join('personas', 'cargas_academicas.id_profesor = personas.id_persona');
			$this->db->join('cursos', 'cargas_academicas.id_curso = cursos.id_curso');
			$this->db->join('asignaturas', 'cargas_academicas.id_asignatura = asignaturas.id_asignatura');
			$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
			$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
			$this->db->join('anos_lectivos', 'cargas_academicas.ano_lectivo = anos_lectivos.id_ano_lectivo');
			$this->db->join('pensum', 'cargas_academicas.id_asignatura = pensum.id_asignatura');

			$this->db->select('cargas_academicas.id_carga_academica,cargas_academicas.id_profesor,cargas_academicas.id_curso,cargas_academicas.id_asignatura,cargas_academicas.ano_lectivo,personas.nombres,personas.apellido1,personas.apellido2,grados.nombre_grado,grupos.nombre_grupo,asignaturas.nombre_asignatura,anos_lectivos.nombre_ano_lectivo,cursos.jornada,pensum.intensidad_horaria');
		
			$query2 = $this->db->get('cargas_academicas');

			$listado_cargas[] = $query2->row();

		}

		return $listado_cargas;
		
	}


	//valido si existen estudiantes matriculados en un respectivo curso
	public function validar_existencia_estudiantes($id_curso){

		$this->db->where('id_curso',$id_curso);
		$this->db->where('estado_matricula',"Activo");
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}



}