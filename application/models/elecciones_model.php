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


	//***************************************************** FUNCIONES PARA  VOTANTES *******************************************************

	public function insertar_votante($id_eleccion,$cursos){

		
		//NUEVA TRANSACCION
		$this->db->trans_start();

		for ($i=0; $i < count($cursos) ; $i++) {

			if ($this->elecciones_model->validar_existencia_curso_votante($id_eleccion,$cursos[$i])) {
				
				$estudiantes = $this->elecciones_model->EstudiantesMatriculadosCurso($cursos[$i]);

				if ($estudiantes != false) {
					
					for ($j=0; $j < count($estudiantes) ; $j++) {

						$codigo_voto = $id_eleccion.substr($estudiantes[$j]['nombres'], 1, 2).$i.$j.$id_eleccion.substr($estudiantes[$j]['apellido1'], 1, 2);

						$votante = array(
							'id_eleccion' => $id_eleccion,
							'id_curso' => $cursos[$i],
							'id_estudiante' => $estudiantes[$j]['id_estudiante'],
							'codigo_voto' => $codigo_voto,
							'estado_votante' => "no"
						);

						$this->db->insert('listado_votantes', $votante);

					}


				}



			}


		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}



	}


	public function buscar_votante($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->where("(elecciones.nombre_eleccion LIKE '".$id."%')", NULL, FALSE);

		$this->db->order_by('elecciones.id_eleccion', 'asc');
		$this->db->group_by("elecciones.id_eleccion"); 

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('elecciones', 'listado_votantes.id_eleccion = elecciones.id_eleccion');
		$this->db->select('listado_votantes.id_eleccion,elecciones.nombre_eleccion,elecciones.descripcion');
		
		$query = $this->db->get('listado_votantes');

		return $query->result();
		
	}


	public function llenar_cursos(){

		$this->load->model('funciones_globales_model');
		$id_ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cursos.ano_lectivo',$id_ano_lectivo);
		
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('salones', 'cursos.id_salon = salones.id_salon');

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,cursos.id_salon,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');

		$query = $this->db->get('cursos');

		return $query->result();
	}


	public function validar_existencia_curso_votante($id_eleccion,$id_curso){

		$this->db->where('id_eleccion',$id_eleccion);
		$this->db->where('id_curso',$id_curso);
		$query = $this->db->get('listado_votantes');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function EstudiantesMatriculadosCurso($id_curso){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.id_curso',$id_curso);

		$this->db->order_by('personas.apellido1', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('matriculas');

		return $query->result_array();

	}


	public function eliminar_votante($id_eleccion){

     	$this->db->where('id_eleccion',$id_eleccion);
		$consulta = $this->db->delete('listado_votantes');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }


    public function validar_votos_eleccion($id_eleccion){

		$this->db->where('id_eleccion',$id_eleccion);

		$this->db->select('sum(IFNULL(votos, 0)) as votos',false);

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


	public function buscar_curso_votante($id_eleccion){


		$this->db->where('listado_votantes.id_eleccion',$id_eleccion);

		$this->db->order_by('listado_votantes.id_curso', 'asc');
		$this->db->group_by("listado_votantes.id_curso");  

		$this->db->join('elecciones', 'listado_votantes.id_eleccion = elecciones.id_eleccion');
		$this->db->join('cursos', 'listado_votantes.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_curso = grupos.id_grupo');

		$this->db->select('listado_votantes.id_eleccion,listado_votantes.id_curso,listado_votantes.id_estudiante,elecciones.nombre_eleccion,grados.nombre_grado,grupos.nombre_grupo');
		
		$query = $this->db->get('listado_votantes');

		return $query->result();
		
	}


	public function eliminarcurso_votante($id_eleccion,$id_curso){

     	$this->db->where('id_eleccion',$id_eleccion);
     	$this->db->where('id_curso',$id_curso);
		$consulta = $this->db->delete('listado_votantes');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }


    //****************************************************** FUNCIONES PARA LA VOTACION ***************************************************


    public function obtener_informacion_porcodigo($codigo_voto){

		$this->db->where('codigo_voto',$codigo_voto);
		$query = $this->db->get('listado_votantes');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
		}
		else{
			return false;
		}

	}


	public function obtener_fecha_actual(){

		$CI = & get_instance();
		$CI->load->helper('date');

		$fecha_horaGMT = now();  //Obtenemos la fecha actual en formato GMT

		$esVerano = date('I', $fecha_horaGMT); //Obtenemos TRUE si es horario de verano
		$zona_horaria = 'UM5'; //zona horaria de bogota

		$fechaLocal = gmt_to_local($fecha_horaGMT, $zona_horaria, $esVerano); //Convertimos la fecha GMT a local a partir del código de zona horaria

		$fechaLocal_Formateada = mdate("%Y-%m-%d %H:%i:%s %a", $fechaLocal); //Formato español (dd/mm/yyyy HH:mm:ss)

		return $fechaLocal_Formateada; 

	}


	public function validar_fechaIngresoVotacion($id_eleccion,$fecha_actual,$hora_actual){

		$estado_eleccion = "Activo";

		$sql= "SELECT nombre_eleccion FROM elecciones WHERE id_eleccion ='". $id_eleccion."' AND estado_eleccion ='".$estado_eleccion."' AND '".$fecha_actual."' >= fecha_inicio AND '".$fecha_actual."' <= fecha_fin AND '".$hora_actual."' >= hora_inicio AND '".$hora_actual."' <= hora_fin";

		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) 
			return true;
		else
			return false;
		
	}


	public function candidatos_eleccion($id_eleccion){

		$this->db->where('candidatos_eleccion.id_eleccion',$id_eleccion);

		$this->db->order_by('candidatos_eleccion.numero', 'asc');

		$this->db->join('elecciones', 'candidatos_eleccion.id_eleccion = elecciones.id_eleccion');
		$this->db->join('personas', 'candidatos_eleccion.id_estudiante = personas.id_persona');
		$this->db->join('anos_lectivos', 'elecciones.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->select('candidatos_eleccion.id_candidato_eleccion,candidatos_eleccion.id_eleccion,elecciones.nombre_eleccion,candidatos_eleccion.id_estudiante,personas.nombres,personas.apellido1,personas.apellido2,candidatos_eleccion.partido,candidatos_eleccion.numero,candidatos_eleccion.estado_candidato,elecciones.ano_lectivo,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('candidatos_eleccion');

		return $query->result();
		
	}


	public function buscar_datos_institucion(){

		$query = $this->db->get('datos_institucion');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else{
			return false;
		}

	}


	public function registrar_voto($candidato_elegido,$codigo_voto){

		
		//NUEVA TRANSACCION
		$this->db->trans_start();

			$ele = $this->elecciones_model->obtener_informacion_candidato($candidato_elegido);
			$votos = $ele[0]['votos'] + 1;

			$fecha = $this->elecciones_model->obtener_fecha_actual();
    		$fecha_voto = substr($fecha, 0,19);

    		$candidato = array('votos' => $votos);
    		$this->db->where('id_candidato_eleccion',$candidato_elegido);
			$this->db->update('candidatos_eleccion', $candidato);

			$votante = array('fecha_voto' => $fecha_voto, 'estado_votante' => "si");
    		$this->db->where('codigo_voto',$codigo_voto);
			$this->db->update('listado_votantes', $votante);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}

	}


	//********************************************** FUNCIONES PARA LOS RESULTADOS DE LAS ELECCIONES *******************************


	public function buscar_resultados($id_eleccion){

		$this->db->where('candidatos_eleccion.id_eleccion',$id_eleccion);

		$this->db->order_by('candidatos_eleccion.votos', 'desc');
		$this->db->order_by('candidatos_eleccion.numero', 'asc');

		$this->db->join('elecciones', 'candidatos_eleccion.id_eleccion = elecciones.id_eleccion');
		$this->db->join('personas', 'candidatos_eleccion.id_estudiante = personas.id_persona');
		$this->db->join('anos_lectivos', 'elecciones.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->select('candidatos_eleccion.id_candidato_eleccion,candidatos_eleccion.id_eleccion,elecciones.nombre_eleccion,candidatos_eleccion.id_estudiante,personas.nombres,personas.apellido1,personas.apellido2,candidatos_eleccion.partido,candidatos_eleccion.numero,IF(candidatos_eleccion.votos = "","0", candidatos_eleccion.votos) as votos,candidatos_eleccion.estado_candidato,elecciones.ano_lectivo,anos_lectivos.nombre_ano_lectivo',false);
		
		$query = $this->db->get('candidatos_eleccion');

		return $query->result();
		
	}


}