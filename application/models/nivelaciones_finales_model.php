<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nivelaciones_finales_model extends CI_Model {


	public function llenar_anos_lectivos(){

		$query = $this->db->get('anos_lectivos');
		return $query->result();
	}

	
	public function llenar_cursos($ano_lectivo){

		$this->db->where('cursos.ano_lectivo',$ano_lectivo);

		$this->db->order_by('cursos.jornada', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');

		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');
		
		$query = $this->db->get('cursos');
		return $query->result();
	}


	//Esta funcion me permite obtener las asignaturas por grado de la tabla pensum.
	public function llenar_asignaturas($id_grado,$ano_lectivo){

		$this->db->where('pensum.id_grado',$id_grado);
		$this->db->where('pensum.ano_lectivo',$ano_lectivo);

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->join('asignaturas', 'pensum.id_asignatura = asignaturas.id_asignatura');
		$this->db->select('pensum.id_asignatura,asignaturas.nombre_asignatura');

		$query = $this->db->get('pensum');
		return $query->result();
	}


	public function llenar_profesores($id_curso,$id_asignatura,$ano_lectivo){

		$this->db->where('cargas_academicas.id_curso',$id_curso);
		$this->db->where('cargas_academicas.id_asignatura',$id_asignatura);
		$this->db->where('cargas_academicas.ano_lectivo',$ano_lectivo);

		$this->db->join('personas', 'cargas_academicas.id_profesor = personas.id_persona');
		$this->db->join('profesores', 'personas.id_persona = profesores.id_persona');

		$this->db->select('personas.id_persona,personas.nombres,personas.apellido1,personas.apellido2');

		$query = $this->db->get('cargas_academicas');
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


	public function llenar_estudiantes($id_curso,$id_asignatura,$ano_lectivo){

		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.estado_matricula',"Activo");

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('matriculas');

		$estudiantes = $query->result_array();
		$listado_estudiantes = array();

		for ($i=0; $i < count($estudiantes); $i++) {

			$id_estudiante = $estudiantes[$i]['id_estudiante'];
			$id_grado = $this->nivelaciones_finales_model->obtener_gradoPorcurso($id_curso);

			$NotaAsignatura = $this->nivelaciones_finales_model->Consultar_NotaAsignatura($ano_lectivo,$id_estudiante,$id_grado,$id_asignatura);

			if ($NotaAsignatura == true) {
			 	
			 	$listado_estudiantes[] = $estudiantes[$i];
			} 
			
		}

		return $listado_estudiantes;

	}


	//Esta funcion permite consultar por estudiante la calificacion definitiva de una asignatura
	public function Consultar_NotaAsignatura($ano_lectivo,$id_estudiante,$id_grado,$id_asignatura){

		//array sencillo para las asignaturas aprobadas y reprobadas
		$asignaturas_aprobadas = array();
		$asignaturas_reprobadas = array();

		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.id_grado',$id_grado);
		$this->db->where('notas.id_asignatura',$id_asignatura);

		$this->db->select('notas.id_estudiante,notas.id_grado,notas.id_asignatura,IFNULL(notas.definitiva, 0.0) as definitiva',false);

		$query = $this->db->get('notas');

		$NotaAsignatura = $query->result_array();

		$DesempenoBajo = $this->nivelaciones_finales_model->obtener_DesempenoBajo($ano_lectivo);
		$minino = $DesempenoBajo[0]['rango_inicial'];
		$maximo = $DesempenoBajo[0]['rango_final'];
		
		if ($NotaAsignatura[0]['definitiva'] >= $minino && $NotaAsignatura[0]['definitiva'] <= $maximo) {

			$asignaturas_reprobadas[] = $NotaAsignatura[0]['definitiva'];
		}
		else{

			$asignaturas_aprobadas[] = $NotaAsignatura[0]['definitiva'];
		}


		if (count($asignaturas_aprobadas) > 0) {

			return false;
		}
		else{

			return true;
		}
		

	}


	//Esta funcion me permite por cada estudiante obtener la calificacion definitiva de una asignatura
	public function buscar_notas($id_estudiante,$id_grado,$id_asignatura,$ano_lectivo){

		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->where('id_estudiante',$id_estudiante);
		$this->db->where('id_grado',$id_grado);
		$this->db->where('id_asignatura',$id_asignatura);

		$this->db->select('IFNULL(definitiva, "Sin Nota") as definitiva',false);

		$query = $this->db->get('notas');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else{
			return false;
		}

	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_nivelacion_final');
		$query = $this->db->get('nivelaciones_finales');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_nivelacion_final'];
        return $data['query'];
	}


	public function insertar_nivelacion($id_nivelacion_final,$ano_lectivo,$id_estudiante,$id_curso,$id_asignatura,$id_profesor,$calificacion,$nota_nivelacion,$observaciones,$fecha_nivelacion,$fecha_registro){

		//NUEVA TRANSACCION
		$this->db->trans_start();

			$nivelacion = array(
        	'id_nivelacion_final' =>$id_nivelacion_final,	
			'ano_lectivo' =>$ano_lectivo,
			'id_estudiante' =>$id_estudiante,
			'id_curso' =>$id_curso,
			'id_asignatura' =>$id_asignatura,
			'id_profesor' =>$id_profesor,
			'nota' =>$calificacion,
			'nivelacion' =>$nota_nivelacion,
			'observaciones' =>$observaciones,
			'fecha_nivelacion' =>$fecha_nivelacion,
			'fecha_registro' =>$fecha_registro);

			$id_grado = $this->nivelaciones_finales_model->obtener_gradoPorcurso($id_curso);
			$nota_definitiva = array('nivelacion' => $nota_nivelacion,'definitiva' => $nota_nivelacion);
			
			$this->db->insert('nivelaciones_finales', $nivelacion);

			$this->db->where('ano_lectivo',$ano_lectivo);
			$this->db->where('id_estudiante',$id_estudiante);
			$this->db->where('id_grado',$id_grado);
			$this->db->where('id_asignatura',$id_asignatura);
			$this->db->update('notas', $nota_definitiva);

			$desempeno = $this->nivelaciones_finales_model->obtener_desempeno($nota_nivelacion,$ano_lectivo);
			$Desempeño = array('id_desempeno' => $desempeno);

			$this->db->where('ano_lectivo',$ano_lectivo);
			$this->db->where('id_estudiante',$id_estudiante);
			$this->db->where('id_grado',$id_grado);
			$this->db->where('id_asignatura',$id_asignatura);
			$this->db->update('notas', $Desempeño);

			$situacion = $this->nivelaciones_finales_model->actualizar_situacion_academica($ano_lectivo,$id_estudiante,$id_curso,$id_grado);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}

	}


	public function buscar_nivelacion($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('est.identificacion',$id,'after');
		$this->db->or_like('est.nombres',$id,'after');
		$this->db->or_like('est.apellido1',$id,'after');
		$this->db->or_like('est.apellido2',$id,'after');
		$this->db->or_like('grados.nombre_grado',$id,'after');
		$this->db->or_like('grupos.nombre_grupo',$id,'after');
		$this->db->or_like('cursos.jornada',$id,'after');
		$this->db->or_like('asignaturas.nombre_asignatura',$id,'after');
		$this->db->or_like('nivelaciones_finales.fecha_nivelacion',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",est.identificacion,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",est.apellido1,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,anos_lectivos.nombre_ano_lectivo)',$id,'after');

		$this->db->order_by('nivelaciones_finales.ano_lectivo', 'desc');
		$this->db->order_by('nivelaciones_finales.fecha_registro', 'desc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('cursos', 'nivelaciones_finales.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('asignaturas', 'nivelaciones_finales.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('personas as est', 'nivelaciones_finales.id_estudiante = est.id_persona');
		$this->db->join('personas as pf', 'nivelaciones_finales.id_profesor = pf.id_persona');
		$this->db->join('anos_lectivos', 'nivelaciones_finales.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('nivelaciones_finales.id_nivelacion_final,nivelaciones_finales.ano_lectivo,nivelaciones_finales.id_estudiante,nivelaciones_finales.id_curso,nivelaciones_finales.id_asignatura,nivelaciones_finales.id_profesor,nivelaciones_finales.nota,nivelaciones_finales.nivelacion,nivelaciones_finales.observaciones,nivelaciones_finales.fecha_nivelacion,nivelaciones_finales.fecha_registro,est.identificacion as identificacionest,est.nombres as nombresest,est.apellido1 as apellido1est,est.apellido2 as apellido2est,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,asignaturas.nombre_asignatura,pf.nombres as nombrespf,pf.apellido1 as apellido1pf,pf.apellido2 as apellido2pf,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('nivelaciones_finales');

		return $query->result();
		
	}


	public function obtener_desempeno($nota_nivelacion,$ano_lectivo){

		$sql= "SELECT id_desempeno FROM desempenos WHERE '".$nota_nivelacion."' >= rango_inicial AND '".$nota_nivelacion."' <= rango_final AND '".$ano_lectivo."' = ano_lectivo";

		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['id_desempeno'];
		}
		else{
			return false;
		}

	}


	public function obtener_DesempenoBajo($ano_lectivo){

		$this->db->where('desempenos.ano_lectivo',$ano_lectivo);
		$this->db->where('desempenos.nombre_desempeno','Bajo');

		$this->db->select('desempenos.id_desempeno,desempenos.nombre_desempeno,desempenos.rango_inicial,desempenos.rango_final,desempenos.ano_lectivo');

		$query = $this->db->get('desempenos');

		if ($query->num_rows() > 0) {
		
        	return $query->result_array();
		}
		else{
			return false;
		}

	}


	//Esta funcion permite actualizar la situacion academica de un estudiante, en el momento que se le
	//registran nivelaciones finales de una respectiva asignatura.
	public function actualizar_situacion_academica($ano_lectivo,$id_estudiante,$id_curso,$id_grado){

		$this->load->model('promocion_model');
		$situacion_academica = $this->promocion_model->calcular_situacion_academica($ano_lectivo,$id_estudiante,$id_curso,$id_grado);
		$AsigReprob = $this->promocion_model->calcular_asignaturas_reprobadas($ano_lectivo,$id_estudiante,$id_grado);
		$AreasReprob = $this->promocion_model->calcular_areas_reprobadas($ano_lectivo,$id_estudiante,$id_grado);
		$fallas = $this->promocion_model->calcular_inasistencias($ano_lectivo,$id_estudiante,$id_curso,$id_grado);

		$this->load->model('funciones_globales_model');
		$fecha_registro = $this->funciones_globales_model->obtener_fecha_actual2();

		$matriculas = array('situacion_academica' => $situacion_academica[0]);

		$promocion = array(
		'ano_lectivo'              => $ano_lectivo,
		'id_estudiante'            => $id_estudiante,
		'id_curso'                 => $id_curso,
		'asignaturas_reprobadas'   => $AsigReprob,
		'areas_reprobadas'         => $AreasReprob,
		'inasistencias'            => $fallas[0],
		'porcentaje_inasistencias' => $fallas[1],
		'situacion_academica'      => $situacion_academica[0],
		'causa'                    => $situacion_academica[1],
		'fecha_registro'           => $fecha_registro);

		$this->db->trans_start();

			$this->db->where('ano_lectivo',$ano_lectivo);
			$this->db->where('id_estudiante',$id_estudiante);
			$this->db->where('id_curso',$id_curso);
			$this->db->update('matriculas', $matriculas);

			$this->db->where('ano_lectivo',$ano_lectivo);
			$this->db->where('id_estudiante',$id_estudiante);
			$this->db->where('id_curso',$id_curso);
			$this->db->update('promocion', $promocion);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}

	}


	//Funcion para validar si al estudiante se le proceso la promocion
	public function validar_situacion_academica($ano_lectivo,$id_estudiante,$id_curso){

		$this->db->where('promocion.ano_lectivo',$ano_lectivo);
		$this->db->where('promocion.id_estudiante',$id_estudiante);
		$this->db->where('promocion.id_curso',$id_curso);
		$this->db->where('promocion.situacion_academica','No Definida');

		$query = $this->db->get('promocion');

		if ($query->num_rows() > 0) {
		
        	return false;
		}
		else{

			return true;
		}

	}


	//Funcion para validar la nota de la nivelacion
	public function validar_nivelacion($ano_lectivo,$nivelacion){

		$desempenos = $this->nivelaciones_finales_model->obtener_Desempenos($ano_lectivo);

		$superior_i = $desempenos[0]['rango_inicial'];
		$superior_f = $desempenos[0]['rango_final'];
		$bajo_i = $desempenos[3]['rango_inicial'];
		$bajo_f = $desempenos[3]['rango_final'];

		if ($nivelacion >= $bajo_i && $nivelacion <= $superior_f) {
			
			return true;
		}
		else{
			
			return false;
		}

	}


	public function obtener_Desempenos($ano_lectivo){

		$this->db->where('desempenos.ano_lectivo',$ano_lectivo);

		$this->db->select('desempenos.id_desempeno,desempenos.nombre_desempeno,desempenos.rango_inicial,desempenos.rango_final,desempenos.ano_lectivo');

		$query = $this->db->get('desempenos');

		if ($query->num_rows() > 0) {
		
        	return $query->result_array();
		}
		else{
			return false;
		}

	}



}