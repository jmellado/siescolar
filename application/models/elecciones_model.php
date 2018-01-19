<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elecciones_model extends CI_Model {


	public function insertar_eleccion($eleccion){
		if ($this->db->insert('elecciones', $eleccion)) 
			return true;
		else
			return false;
	}


	public function validar_existencia($nombre_eleccion,$ano_lectivo){

		$this->db->where('nombre_eleccion',$nombre_eleccion);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('elecciones');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function buscar_eleccion($id,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('elecciones.ano_lectivo',$ano_lectivo);

		$this->db->where("(elecciones.nombre_eleccion LIKE '".$id."%' OR elecciones.estado_eleccion LIKE '".$id."%' OR elecciones.fecha_inicio LIKE '".$id."%' OR elecciones.fecha_fin LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('anos_lectivos', 'elecciones.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->select('elecciones.id_eleccion,elecciones.nombre_eleccion,elecciones.descripcion,elecciones.fecha_inicio,elecciones.hora_inicio,elecciones.fecha_fin,elecciones.hora_fin,elecciones.ano_lectivo,elecciones.estado_eleccion,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('elecciones');

		return $query->result();
		
	}


	public function eliminar_eleccion($id_eleccion){

     	$this->db->where('id_eleccion',$id_eleccion);
		$consulta = $this->db->delete('elecciones');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }


    public function modificar_eleccion($id_eleccion,$eleccion){

	
		$this->db->where('id_eleccion',$id_eleccion);

		if ($this->db->update('elecciones', $eleccion))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_eleccion');
		$query = $this->db->get('elecciones');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_eleccion'];
        return $data['query'];
	}


	public function obtener_informacion_eleccion($id_eleccion){

		$this->db->where('id_eleccion',$id_eleccion);
		$query = $this->db->get('elecciones');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
		}
		else{
			return false;
		}

	}


	public function validar_eleccion_candidatos($id_eleccion){

		$this->db->where('id_eleccion',$id_eleccion);
		$query = $this->db->get('candidatos_eleccion');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	//***************************************************** FUNCIONES PARA  CANDIDATOS *******************************************************


	public function insertar_candidato($candidato){
		if ($this->db->insert('candidatos_eleccion', $candidato)) 
			return true;
		else
			return false;
	}


	public function validar_existencia_candidato($id_candidato,$id_eleccion){

		$this->db->where('id_eleccion',$id_eleccion);
		$this->db->where('id_estudiante',$id_candidato);
		$query = $this->db->get('candidatos_eleccion');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function validar_existencia_numerocandidato($id_eleccion,$numero){

		$this->db->where('id_eleccion',$id_eleccion);
		$this->db->where('numero',$numero);
		$query = $this->db->get('candidatos_eleccion');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function buscar_candidato($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->where("(elecciones.nombre_eleccion LIKE '".$id."%' OR personas.nombres LIKE '".$id."%' OR personas.apellido1 LIKE '".$id."%' OR personas.apellido2 LIKE '".$id."%' OR candidatos_eleccion.partido LIKE '".$id."%' OR candidatos_eleccion.numero LIKE '".$id."%' OR candidatos_eleccion.estado_candidato LIKE '".$id."%')", NULL, FALSE);

		$this->db->order_by('candidatos_eleccion.id_eleccion', 'asc');
		$this->db->order_by('candidatos_eleccion.partido', 'asc');
		$this->db->order_by('candidatos_eleccion.numero', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('elecciones', 'candidatos_eleccion.id_eleccion = elecciones.id_eleccion');
		$this->db->join('personas', 'candidatos_eleccion.id_estudiante = personas.id_persona');
		$this->db->select('candidatos_eleccion.id_candidato_eleccion,candidatos_eleccion.id_eleccion,elecciones.nombre_eleccion,candidatos_eleccion.id_estudiante,personas.nombres,personas.apellido1,personas.apellido2,candidatos_eleccion.partido,candidatos_eleccion.numero,candidatos_eleccion.estado_candidato');
		
		$query = $this->db->get('candidatos_eleccion');

		return $query->result();
		
	}


	public function llenar_elecciones(){

		$this->load->model('funciones_globales_model');
		$id_ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('ano_lectivo',$id_ano_lectivo);
		$this->db->where('estado_eleccion','Activo');
		$query = $this->db->get('elecciones');
		return $query->result();
	}


	public function buscar_estudiantes_matriculados($id,$ano_lectivo){

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);

		$this->db->where("(personas.identificacion LIKE '".$id."%' OR personas.nombres LIKE '".$id."%' OR personas.apellido1 LIKE '".$id."%' OR personas.apellido2 LIKE '".$id."%')", NULL, FALSE);

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'matriculas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('anos_lectivos', 'matriculas.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('matriculas.id_matricula,matriculas.fecha_matricula,matriculas.ano_lectivo,matriculas.id_estudiante,matriculas.id_curso,grados.nombre_grado,grupos.nombre_grupo,matriculas.jornada,matriculas.id_acudiente,matriculas.parentesco,matriculas.observaciones,matriculas.estado_matricula,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('matriculas');

		return $query->result();
		
	}


	public function modificar_candidato($id_candidato_eleccion,$candidato){

	
		$this->db->where('id_candidato_eleccion',$id_candidato_eleccion);

		if ($this->db->update('candidatos_eleccion', $candidato))

			return true;
		else
			return false;
	}


	public function eliminar_candidato($id_candidato_eleccion){

     	$this->db->where('id_candidato_eleccion',$id_candidato_eleccion);
		$consulta = $this->db->delete('candidatos_eleccion');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }


	public function obtener_informacion_candidato($id_candidato_eleccion){

		$this->db->where('id_candidato_eleccion',$id_candidato_eleccion);
		$query = $this->db->get('candidatos_eleccion');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
		}
		else{
			return false;
		}

	}


	public function validar_votos_candidato($id_candidato_eleccion){

		$this->db->where('id_candidato_eleccion',$id_candidato_eleccion);
		$query = $this->db->get('candidatos_eleccion');

		if ($query->num_rows() > 0) {
			$row = $query->result_array();

			if ($row[0]['votos'] > 0) {
				return false;
			}
			else{
				return true;
			}
		}
		else{
			
			return false;
			
		}

	}


}