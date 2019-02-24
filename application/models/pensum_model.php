<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pensum_model extends CI_Model {


	public function insertar_pensum($pensum){
		if ($this->db->insert('pensum', $pensum)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($id_grado,$id_asignatura,$ano_lectivo){

		$this->db->where('id_grado',$id_grado);
		$this->db->where('id_asignatura',$id_asignatura);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('pensum');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_pensum($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('grados.nombre_grado',$id,'after');
		$this->db->or_like('asignaturas.nombre_asignatura',$id,'after');
		$this->db->or_like('pensum.intensidad_horaria',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');
		$this->db->or_like('pensum.estado_pensum',$id,'after');

		$this->db->order_by('pensum.ano_lectivo', 'desc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');
		$this->db->order_by('pensum.estado_pensum', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('grados', 'pensum.id_grado = grados.id_grado');
		$this->db->join('asignaturas', 'pensum.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('anos_lectivos', 'pensum.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('pensum.id_pensum,pensum.id_grado,pensum.id_asignatura,pensum.intensidad_horaria,pensum.ano_lectivo,pensum.estado_pensum,grados.nombre_grado,asignaturas.nombre_asignatura,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('pensum');

		return $query->result();
		
	}

	public function eliminar_pensum($id){

     	$this->db->where('id_pensum',$id);
		$consulta = $this->db->delete('pensum');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    public function modificar_pensum($id,$pensum){

	
		$this->db->where('id_pensum',$id);

		if ($this->db->update('pensum', $pensum))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_pensum');
		$query = $this->db->get('pensum');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_pensum'];
        return $data['query'];
	}


	public function obtener_id_grado($id){

		$this->db->where('id_pensum',$id);
		$query = $this->db->get('pensum');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['id_grado'];
		}
		else{
			return false;
		}

	}


	public function obtener_id_asignatura($id){

		$this->db->where('id_pensum',$id);
		$query = $this->db->get('pensum');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['id_asignatura'];
		}
		else{
			return false;
		}

	}


	public function obtener_ano_lectivo($id){

		$this->db->where('id_pensum',$id);
		$query = $this->db->get('pensum');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['ano_lectivo'];
		}
		else{
			return false;
		}

	}


	public function llenar_asignaturas(){

		$this->load->model('funciones_globales_model');
		$id_ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('ano_lectivo',$id_ano_lectivo);
		$this->db->where('estado_asignatura','Activo');

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');
		
		$query = $this->db->get('asignaturas');
		return $query->result();
	}


	// Esta Funcion Me Permite Validar Si El Pensum Ya Fue Asociado, Para Ello Verifico En La Tabla Notas,
	// Si El Grado Del Pensum Esta Registrado
	public function ValidarExistencia_PensumEnNotas($id_grado,$id_pensum = FALSE){

		if ($id_pensum !== FALSE) {
			$id_grado = $this->pensum_model->obtener_GradoDelPensum($id_pensum);
		}

		$this->db->where('id_grado',$id_grado);
		$query = $this->db->get('notas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function obtener_GradoDelPensum($id_pensum){

		$this->db->where('id_pensum',$id_pensum);
		$query = $this->db->get('pensum');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['id_grado'];
		}
		else{
			return false;
		}

	}


	public function obtener_anio_pensum($id_pensum){

		$this->db->where('id_pensum',$id_pensum);
		$query = $this->db->get('pensum');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['ano_lectivo'];
		}
		else{
			
			return false;
		}

	}


	//================== Funciones Para Adicionar Asignaturas ===================


	public function EstudiantesMatriculadosPorGrado($id_grado,$ano_lectivo){

		$this->db->where('cursos.id_grado',$id_grado);
		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.estado_matricula',"Activo");

		$this->db->order_by('grupos.nombre_grupo', 'asc');
		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'matriculas.id_curso = cursos.id_curso');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');

		$this->db->select('matriculas.id_estudiante,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('matriculas');

		return $query->result_array();

	}


	//Esta Funcion permite asociar una asignatura a los estudiantes matriculados en un grado, para el posterior registro de notas.
	public function insertar_asignaturaPorestudiantes($id_grado,$id_asignatura,$ano_lectivo){

		$estudiantes = $this->pensum_model->EstudiantesMatriculadosPorGrado($id_grado,$ano_lectivo);

		if ($estudiantes != false) {
			
			//NUEVA TRANSACCION
			$this->db->trans_start();

				for ($i=0; $i < count($estudiantes); $i++) { 
					
					//array para insertar en la tabla notas
		        	$notas = array(
		        	'ano_lectivo' =>$ano_lectivo,
					'id_estudiante' =>$estudiantes[$i]['id_estudiante'],
					'id_grado' =>$id_grado,
					'id_asignatura' =>$id_asignatura);

					$this->db->insert('notas', $notas);
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


	public function validar_existencia_notas($ano_lectivo){

		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->where("(p1 != '' OR p1 is NOT NULL)");
		$query = $this->db->get('notas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


}