<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cursos_model extends CI_Model {


	public function insertar_curso($curso){
		if ($this->db->insert('cursos', $curso)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($id_curso){

		$this->db->where('id_curso',$id_curso);
		$query = $this->db->get('cursos');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function validar_salon($id_salon,$jornada,$ano_lectivo){

		$this->db->where('id_salon',$id_salon);
		$this->db->where('jornada',$jornada);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('cursos');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function validar_director($director,$jornada,$ano_lectivo){

		$this->db->where('director',$director);
		$this->db->where('jornada',$jornada);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('cursos');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function validar_grado_grupo($id_grado,$id_grupo,$jornada,$ano_lectivo){

		$this->db->where('id_grado',$id_grado);
		$this->db->where('id_grupo',$id_grupo);
		$this->db->where('jornada',$jornada);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('cursos');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_curso($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('grados.nombre_grado',$id,'after');
		$this->db->or_like('grupos.nombre_grupo',$id,'after');
		$this->db->or_like('salones.nombre_salon',$id,'after');
		$this->db->or_like('personas.nombres',$id,'after');
		$this->db->or_like('personas.apellido1',$id,'after');
		$this->db->or_like('cursos.cupo_maximo',$id,'after');
		$this->db->or_like('cursos.jornada',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');

		$this->db->order_by('cursos.ano_lectivo', 'desc');
		$this->db->order_by('cursos.jornada', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}
		
		$this->db->join('salones', 'cursos.id_salon = salones.id_salon');  //nada mas add is line  relacion con tabla salones
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');  //nada mas add is line    relacion con tabla grados
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');  //nada mas add is line    relacion con tabla grupos
		$this->db->join('personas', 'cursos.director = personas.id_persona');
		$this->db->join('anos_lectivos', 'cursos.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,cursos.id_salon,cursos.director,cursos.cupo_maximo,cursos.jornada,cursos.ano_lectivo,grados.nombre_grado,grupos.nombre_grupo,salones.nombre_salon,personas.nombres,personas.apellido1,anos_lectivos.nombre_ano_lectivo'); //---------------------------- seleccion solo de campos a utilizar

		$query = $this->db->get('cursos');

		return $query->result();
		
	}

	public function eliminar_curso($id_curso){

       	//NUEVA TRANSACCION
		$this->db->trans_start();
		$this->db->where('id_curso',$id_curso);
		$this->db->delete('horarios');

		$this->db->where('id_curso',$id_curso);
		$this->db->delete('cursos');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}
    }

    public function modificar_curso($id_curso,$curso){

	
		$this->db->where('id_curso',$id_curso);

		if ($this->db->update('cursos', $curso))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_curso');
		$query = $this->db->get('cursos');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_curso'];
        return $data['query'];
	}


	public function llenar_directores(){

		$this->db->where('profesores.estado_profesor','Activo');

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('profesores', 'personas.id_persona = profesores.id_persona');
		$query = $this->db->get('personas');
		return $query->result();
	}


	public function obtener_informacion_curso($id_curso){

		$this->db->where('id_curso',$id_curso);
		$query = $this->db->get('cursos');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
		}
		else{
			return false;
		}

	}


	//Esta funcion me permite obtener el total de matriculas por curso de un respectivo año
	public function total_cursos_matricula($id_curso){

		$infocurso = $this->cursos_model->obtener_informacion_curso($id_curso);
		$ano_lectivo = $infocurso[0]['ano_lectivo'];

		$this->db->where('id_curso',$id_curso);
		$this->db->where('ano_lectivo',$ano_lectivo);

		$query = $this->db->get('matriculas');

		return count($query->result());

	}


	//Esta funcion permite crear la base del horario para cualquier curso.
	public function CrearHorarioCurso($id_curso,$ano_lectivo){


		//NUEVA TRANSACCION
		$this->db->trans_start();

			for ($i=0; $i < 10; $i++) {

				$hora = $i + 1;

				//array para insertar en la tabla horarios
	        	$horario = array(
				'id_curso'    => $id_curso,
				'hora'        => $hora,
				'ano_lectivo' => $ano_lectivo);

				$this->db->insert('horarios', $horario);
			}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}


	}


	public function llenar_salones_actualizar($ano_lectivo){
		
		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->where('estado_salon','Activo');
		$this->db->where('disponibilidad','si');
		$query = $this->db->get('salones');
		return $query->result();
	}


}