<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matriculas_model extends CI_Model {


	public function insertar_matricula($matricula){
		if ($this->db->insert('matriculas', $matricula)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($id_persona,$ano_lectivo){

		$this->db->where('id_estudiante',$id_persona);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_matricula($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('personas.identificacion',$id,'after');
		$this->db->or_like('personas.nombres',$id,'after');
		$this->db->or_like('personas.apellido1',$id,'after');
		$this->db->or_like('grados.nombre_grado',$id,'after');
		$this->db->or_like('grupos.nombre_grupo',$id,'after');
		$this->db->or_like('matriculas.jornada',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('salones_grupo', 'matriculas.id_salon = salones_grupo.id_salon');
		$this->db->join('grados', 'salones_grupo.id_grado = grados.id_grado');
		$this->db->join('grupos', 'salones_grupo.id_grupo = grupos.id_grupo');
		$this->db->join('anos_lectivos', 'matriculas.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('matriculas.id_matricula,matriculas.fecha_matricula,matriculas.ano_lectivo,matriculas.id_estudiante,matriculas.id_salon,grados.nombre_grado,grupos.nombre_grupo,matriculas.jornada,matriculas.observaciones,matriculas.estado_matricula,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('matriculas');

		return $query->result();
		
	}

	public function eliminar_matricula($id){

     	$this->db->where('id_matricula',$id);
		$consulta = $this->db->delete('matriculas');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    public function modificar_matricula($id,$matricula){

	
		$this->db->where('id_matricula',$id);

		if ($this->db->update('matriculas', $matricula))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_matricula');
		$query = $this->db->get('matriculas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_matricula'];
        return $data['query'];
	}


	public function buscar_estudiante($id){

		$this->db->where('personas.identificacion',$id);

		$this->db->join('estudiantes', 'personas.id_persona = estudiantes.id_persona');

		$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('personas');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else{
			return false;
		}

	}


	public function llenar_salones_grupo(){
		
		$this->db->join('grados', 'salones_grupo.id_grado = grados.id_grado');
		$this->db->join('grupos', 'salones_grupo.id_grupo = grupos.id_grupo');
		$this->db->join('salones', 'salones_grupo.id_salon = salones.id_salon');

		$this->db->select('salones_grupo.id_salon,salones_grupo.id_grado,salones_grupo.id_grupo,grados.nombre_grado,grupos.nombre_grupo,salones.cupo_maximo');

		$query = $this->db->get('salones_grupo');
		$row = $query->result_array();
		$total = $query->num_rows();
		$listaArray = array();

		for ($i=0; $i < $total ; $i++) { 
			
			$id_salon = $row[$i]['id_salon'];
			$cupo_maximo = $row[$i]['cupo_maximo'];
			$total_salon_matricula = $this->matriculas_model->total_salones_matricula($id_salon);

			if ($total_salon_matricula < $cupo_maximo) {
			
				$this->db->where('id_salon',$id_salon);

				$this->db->join('grados', 'salones_grupo.id_grado = grados.id_grado');
				$this->db->join('grupos', 'salones_grupo.id_grupo = grupos.id_grupo');

				$this->db->select('salones_grupo.id_salon,salones_grupo.id_grado,salones_grupo.id_grupo,grados.nombre_grado,grupos.nombre_grupo,');

				$query2 = $this->db->get('salones_grupo');

				$listaArray[] =$query2->row();

			}
		}

		return $listaArray;
	}


	public function validar_existencia_por_identificacion($identificacion,$ano_lectivo){

		$this->db->where('personas.identificacion',$identificacion);
		$this->db->where('ano_lectivo',$ano_lectivo);

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	//Esta funcion me permite obtener el total de matriculas por salon de un respectivo año
	public function total_salones_matricula($id_salon){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('id_salon',$id_salon);
		$this->db->where('ano_lectivo',$ano_lectivo);

		$query = $this->db->get('matriculas');

		return count($query->result());

	}


	//Esta Funcion me permite obtener el grado por el salon registrado en la tabla matricula
	public function obtener_gradoPorsalon($id_salon){

		$this->db->where('matriculas.id_salon',$id_salon);

		$this->db->join('salones_grupo', 'matriculas.id_salon = salones_grupo.id_salon');
		$this->db->join('grados', 'salones_grupo.id_grado = grados.id_grado');

		$this->db->select('grados.id_grado');

		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['id_grado'];
		}
		else{
			return false;
		}

	}


	//Esta funcion me permite obtener las materias a cursar por un determinado grado dependiendo del pensum
	public function obtener_asignaturasPorgrados($id_grado){

		$this->db->where('id_grado',$id_grado);

		$this->db->select('pensum.id_asignatura');

		$query = $this->db->get('pensum');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
		}
		else{
			return false;
		}
		
	}


	//Esta Funcion me permite registrar las materias a cursar, por un estudiante, en la tabla notas
	public function insertar_asignaturasPorestudiantes($ano_lectivo,$id_estudiante,$id_asignatura){

		$sql= "INSERT INTO notas(ano_lectivo, id_estudiante, id_asignatura) VALUES('". $ano_lectivo."', '". $id_estudiante ."','".$id_asignatura."')";

		if ($this->db->query($sql)) 
			return true;
		else
			return false;

	}


	//esta funcion me permite obtener un estudiante por este id de matricula
	public function obtener_estudiantePormatricula($id_matricula){

		$this->db->where('id_matricula',$id_matricula);
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else{
			return false;
		}

	}


	//esta funcion me permite eliminar las materias ya registradas a cursar por un estudiante en la tabla notas
	public function eliminar_asignaturasPorestudiantes($ano_lectivo,$id_estudiante){

     	$this->db->where('ano_lectivo',$ano_lectivo);
     	$this->db->where('id_estudiante',$id_estudiante);
		$consulta = $this->db->delete('notas');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }


	



}