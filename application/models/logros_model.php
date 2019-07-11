<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logros_model extends CI_Model {


	public function insertar_logro($logro){
		if ($this->db->insert('logros', $logro)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($nombre,$id_profesor,$ano_lectivo){

		$this->db->where('nombre_logro',$nombre);
		$this->db->where('id_profesor',$id_profesor);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('logros');

		if ($query->num_rows() > 0) {
			return true;
		}
		else{
			return true;
		}

	}

	public function buscar_logro($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('logros.nombre_logro',$id,'after');
		$this->db->or_like('grados.nombre_grado',$id,'after');
		$this->db->or_like('logros.periodo',$id,'after');
		$this->db->or_like('personas.nombres',$id,'after');
		$this->db->or_like('personas.apellido1',$id,'after');
		$this->db->or_like('asignaturas.nombre_asignatura',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",personas.nombres,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",personas.apellido1,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",personas.apellido2,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",personas.nombres,personas.apellido1,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",personas.nombres,personas.apellido1,personas.apellido2,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",personas.nombres,personas.apellido1,grados.nombre_grado,asignaturas.nombre_asignatura,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",personas.nombres,personas.apellido1,grados.nombre_grado,asignaturas.nombre_asignatura,logros.periodo,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",grados.nombre_grado,asignaturas.nombre_asignatura,anos_lectivos.nombre_ano_lectivo)',$id,'after');

		$this->db->order_by('logros.ano_lectivo', 'desc');
		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');
		$this->db->order_by('grados_educacion.nivel_educacion', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->_protect_identifiers = FALSE;
		$this->db->order_by('FIELD(logros.periodo, "Primero","Segundo","Tercero","Cuarto")');
		$this->db->_protect_identifiers = TRUE;

		$this->db->order_by('logros.secuencia', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('anos_lectivos', 'logros.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->join('personas', 'logros.id_profesor = personas.id_persona');
		$this->db->join('grados', 'logros.id_grado = grados.id_grado');
		$this->db->join('asignaturas', 'logros.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('logros.id_logro,logros.nombre_logro,logros.descripcion_logro,logros.periodo,logros.id_profesor,personas.nombres,personas.apellido1,logros.id_grado,grados.nombre_grado,logros.id_asignatura,asignaturas.nombre_asignatura,logros.ano_lectivo,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('logros');

		return $query->result();
		
	}

	//Esta funcion me permite obtener los logros ingresados por un profesor en el respectivo año lectivo
	public function buscar_logro_profesor($id,$id_profesor,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('id_profesor',$id_profesor);
		$this->db->where('logros.ano_lectivo',$ano_lectivo);

		$this->db->where("(logros.nombre_logro LIKE '".$id."%' OR grados.nombre_grado LIKE '".$id."%' OR logros.periodo LIKE '".$id."%' OR asignaturas.nombre_asignatura LIKE '".$id."%' OR anos_lectivos.nombre_ano_lectivo LIKE '".$id."%' OR CONCAT_WS(' ',grados.nombre_grado,asignaturas.nombre_asignatura,logros.periodo) LIKE '".$id."%')", NULL, FALSE);

		$this->db->order_by('grados_educacion.nivel_educacion', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->_protect_identifiers = FALSE;
		$this->db->order_by('FIELD(logros.periodo, "Primero","Segundo","Tercero","Cuarto")');
		$this->db->_protect_identifiers = TRUE;

		$this->db->order_by('logros.secuencia', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('anos_lectivos', 'logros.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->join('personas', 'logros.id_profesor = personas.id_persona');
		$this->db->join('grados', 'logros.id_grado = grados.id_grado');
		$this->db->join('asignaturas', 'logros.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('logros.id_logro,logros.nombre_logro,logros.descripcion_logro,logros.periodo,logros.id_profesor,personas.nombres,personas.apellido1,logros.id_grado,grados.nombre_grado,logros.id_asignatura,asignaturas.nombre_asignatura,logros.ano_lectivo,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('logros');

		return $query->result();
		
	}

	public function eliminar_logro($id){

     	$this->db->where('id_logro',$id);
		$consulta = $this->db->delete('logros');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    public function modificar_logro($id,$logro){

	
		$this->db->where('id_logro',$id);

		if ($this->db->update('logros', $logro))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_logro');
		$query = $this->db->get('logros');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_logro'];
        return $data['query'];
	}


	public function obtener_ultima_secuencia($periodo,$id_profesor,$id_grado,$id_asignatura,$ano_lectivo){

		$this->db->where('periodo',$periodo);
		$this->db->where('id_profesor',$id_profesor);
		$this->db->where('id_grado',$id_grado);
		$this->db->where('id_asignatura',$id_asignatura);
		$this->db->where('ano_lectivo',$ano_lectivo);

		$this->db->select_max('secuencia');
		$query = $this->db->get('logros');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['secuencia'];
        return $data['query'];
	}


	public function obtener_secuencia_logro($id){

		$this->db->where('id_logro',$id);
		$query = $this->db->get('logros');

		if ($query->num_rows() > 0) {
		
        	return $query->result_array();
		}
		else{
			return false;
		}

	}


	public function obtener_ano_lectivo($id){

		$this->db->where('id_logro',$id);
		$query = $this->db->get('logros');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['ano_lectivo'];
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

		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');

		$this->db->join('cursos', 'cargas_academicas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('DISTINCT(cursos.id_grado),grados.nombre_grado');

		$query = $this->db->get('cargas_academicas');
		return $query->result();
	}


	public function llenar_asignaturas_profesor($id_profesor,$id_grado){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cargas_academicas.id_profesor',$id_profesor);
		$this->db->where('cursos.id_grado',$id_grado);
		$this->db->where('cargas_academicas.ano_lectivo',$ano_lectivo);

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');
		
		$this->db->join('asignaturas', 'cargas_academicas.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('cursos', 'cargas_academicas.id_curso = cursos.id_curso');

		$this->db->select('DISTINCT(cargas_academicas.id_asignatura),asignaturas.nombre_asignatura');

		$query = $this->db->get('cargas_academicas');
		return $query->result();
	}


	// Esta funcion permite validar si el logro se encuentra asignado
	public function ValidarExistencia_LogroAsignado($id_logro){
		
		$this->db->where("(id_logro1 = '".$id_logro."' OR id_logro2 = '".$id_logro."' OR id_logro3 = '".$id_logro."' OR id_logro4 = '".$id_logro."')");

		$query = $this->db->get('logros_asignados');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}








}