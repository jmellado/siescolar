<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nivelaciones_model extends CI_Model {


	public function llenar_cursos(){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

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
	public function llenar_asignaturas($id_grado){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('pensum.id_grado',$id_grado);
		$this->db->where('pensum.ano_lectivo',$ano_lectivo);

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');

		$this->db->join('asignaturas', 'pensum.id_asignatura = asignaturas.id_asignatura');
		$this->db->select('pensum.id_asignatura,asignaturas.nombre_asignatura');

		$query = $this->db->get('pensum');
		return $query->result();
	}


	public function llenar_profesores($id_curso,$id_asignatura){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

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


	public function llenar_estudiantes($id_curso,$id_asignatura,$periodo){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);

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
			$id_grado = $this->nivelaciones_model->obtener_gradoPorcurso($id_curso);

			$NotaAsignatura = $this->nivelaciones_model->Consultar_NotaAsignatura($ano_lectivo,$id_estudiante,$id_grado,$id_asignatura,$periodo);

			if ($NotaAsignatura == true) {
			 	
			 	$listado_estudiantes[] = $estudiantes[$i];
			} 
			
		}

		return $listado_estudiantes;

	}


	//Esta funcion permite consultar por estudiante la calificacion de una asignatura en un determinado periodo
	public function Consultar_NotaAsignatura($ano_lectivo,$id_estudiante,$id_grado,$id_asignatura,$periodo){

		//array sencillo para las asignaturas aprobadas y reprobadas
		$asignaturas_aprobadas = array();
		$asignaturas_reprobadas = array();

		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.id_grado',$id_grado);
		$this->db->where('notas.id_asignatura',$id_asignatura);

		$this->db->select('notas.id_estudiante,notas.id_grado,notas.id_asignatura,IFNULL(notas.p1, 0.0) as p1,IFNULL(notas.p2, 0.0) as p2,IFNULL(notas.p3, 0.0) as p3,IFNULL(notas.p4, 0.0) as p4',false);

		$query = $this->db->get('notas');

		$NotaAsignatura = $query->result_array();
		
		if ($periodo == "Primero") {

			if ($NotaAsignatura[0]['p1'] >= 3.0 && $NotaAsignatura[0]['p1'] <= 5.0) {
				$asignaturas_aprobadas[] = $NotaAsignatura[0]['p1'];
			}
			else{
				$asignaturas_reprobadas[] = $NotaAsignatura[0]['p1'];
			}	
		}
		if ($periodo == "Segundo") {

			if ($NotaAsignatura[0]['p2'] >= 3.0 && $NotaAsignatura[0]['p2'] <= 5.0) {
				$asignaturas_aprobadas[] = $NotaAsignatura[0]['p2'];
			}
			else{
				$asignaturas_reprobadas[] = $NotaAsignatura[0]['p2'];
			}
		}	
		if ($periodo == "Tercero") {

			if ($NotaAsignatura[0]['p3'] >= 3.0 && $NotaAsignatura[0]['p3'] <= 5.0) {
				$asignaturas_aprobadas[] = $NotaAsignatura[0]['p3'];
			}
			else{
				$asignaturas_reprobadas[] = $NotaAsignatura[0]['p3'];
			}	
		}
		if ($periodo == "Cuarto") {

			if ($NotaAsignatura[0]['p4'] >= 3.0 && $NotaAsignatura[0]['p4'] <= 5.0) {
				$asignaturas_aprobadas[] = $NotaAsignatura[0]['p4'];
			}
			else{
				$asignaturas_reprobadas[] = $NotaAsignatura[0]['p4'];
			}
		}

		if (count($asignaturas_aprobadas) > 0) {

			return false;
		}
		else{

			return true;
		}
		

	}


	//Esta funcion me permite por cada estudiante obtener la calificacion de una asignatura en un determinado periodo
	public function buscar_notas($id_estudiante,$periodo,$id_grado,$id_asignatura){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->where('id_estudiante',$id_estudiante);
		$this->db->where('id_grado',$id_grado);
		$this->db->where('id_asignatura',$id_asignatura);

		$this->db->select('IFNULL(p1, 0.0) as p1,IFNULL(p2, 0.0) as p2,IFNULL(p3, 0.0) as p3,IFNULL(p4, 0.0) as p4',false);

		$query = $this->db->get('notas');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else{
			return false;
		}

	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_nivelacion');
		$query = $this->db->get('nivelaciones');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_nivelacion'];
        return $data['query'];
	}


	public function insertar_nivelacion($id_nivelacion,$ano_lectivo,$id_estudiante,$id_curso,$id_asignatura,$id_profesor,$periodo,$calificacion,$nota_nivelacion,$observaciones,$fecha_nivelacion,$fecha_registro){

		//NUEVA TRANSACCION
		$this->db->trans_start();

			$nivelacion = array(
        	'id_nivelacion' =>$id_nivelacion,	
			'ano_lectivo' =>$ano_lectivo,
			'id_estudiante' =>$id_estudiante,
			'id_curso' =>$id_curso,
			'id_asignatura' =>$id_asignatura,
			'id_profesor' =>$id_profesor,
			'periodo' =>$periodo,
			'nota' =>$calificacion,
			'nivelacion' =>$nota_nivelacion,
			'observaciones' =>$observaciones,
			'fecha_nivelacion' =>$fecha_nivelacion,
			'fecha_registro' =>$fecha_registro);

			$peri = $this->nivelaciones_model->convertir_periodo($periodo);
			$id_grado = $this->nivelaciones_model->obtener_gradoPorcurso($id_curso);
			$nota_periodo = array($peri => $nota_nivelacion);
			
			$this->db->insert('nivelaciones', $nivelacion);

			$this->db->where('ano_lectivo',$ano_lectivo);
			$this->db->where('id_estudiante',$id_estudiante);
			$this->db->where('id_grado',$id_grado);
			$this->db->where('id_asignatura',$id_asignatura);
			$this->db->update('notas', $nota_periodo);

			$nota_final = $this->nivelaciones_model->calcularNota_final($ano_lectivo,$id_estudiante,$id_grado,$id_asignatura);
			$desempeno = $this->nivelaciones_model->obtener_desempeno($nota_final,$ano_lectivo);
			$NotaDesempeño = array('nota_final' => $nota_final, 'id_desempeno' => $desempeno);

			$this->db->where('ano_lectivo',$ano_lectivo);
			$this->db->where('id_estudiante',$id_estudiante);
			$this->db->where('id_grado',$id_grado);
			$this->db->where('id_asignatura',$id_asignatura);
			$this->db->update('notas', $NotaDesempeño);

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
		$this->db->or_like('est.apellido1',$id,'after');
		$this->db->or_like('est.apellido2',$id,'after');
		$this->db->or_like('grados.nombre_grado',$id,'after');
		$this->db->or_like('grupos.nombre_grupo',$id,'after');
		$this->db->or_like('cursos.jornada',$id,'after');
		$this->db->or_like('nivelaciones.periodo',$id,'after');
		$this->db->or_like('asignaturas.nombre_asignatura',$id,'after');
		$this->db->or_like('nivelaciones.fecha_nivelacion',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');

		$this->db->order_by('nivelaciones.ano_lectivo', 'desc');
		$this->db->order_by('nivelaciones.fecha_registro', 'desc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('cursos', 'nivelaciones.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('asignaturas', 'nivelaciones.id_asignatura = asignaturas.id_asignatura');
		$this->db->join('personas as est', 'nivelaciones.id_estudiante = est.id_persona');
		$this->db->join('personas as pf', 'nivelaciones.id_profesor = pf.id_persona');
		$this->db->join('anos_lectivos', 'nivelaciones.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('nivelaciones.id_nivelacion,nivelaciones.ano_lectivo,nivelaciones.id_estudiante,nivelaciones.id_curso,nivelaciones.id_asignatura,nivelaciones.id_profesor,nivelaciones.periodo,nivelaciones.nota,nivelaciones.nivelacion,nivelaciones.observaciones,nivelaciones.fecha_nivelacion,nivelaciones.fecha_registro,est.identificacion as identificacionest,est.nombres as nombresest,est.apellido1 as apellido1est,est.apellido2 as apellido2est,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,asignaturas.nombre_asignatura,pf.nombres as nombrespf,pf.apellido1 as apellido1pf,pf.apellido2 as apellido2pf,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('nivelaciones');

		return $query->result();
		
	}


	public function convertir_periodo($periodo){

		if ($periodo == "Primero") {

			$peri = "p1";
		}
		elseif ($periodo == "Segundo") {

			$peri = "p2";
		}
		elseif ($periodo == "Tercero") {

			$peri = "p3";
		}
		elseif ($periodo == "Cuarto") {

			$peri = "p4";
		}

		return $peri;
	}


	public function calcularNota_final($ano_lectivo,$id_estudiante,$id_grado,$id_asignatura){

		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->where('id_estudiante',$id_estudiante);
		$this->db->where('id_grado',$id_grado);
		$this->db->where('id_asignatura',$id_asignatura);

		$this->db->select('p1,p2,p3,p4');

		$query = $this->db->get('notas');
		$notas = $query->result_array();

		$n1 = $notas[0]['p1'];
		$n2 = $notas[0]['p2'];
		$n3 = $notas[0]['p3'];
		$n4 = $notas[0]['p4'];

		if($n1 == NULL && $n2 == NULL && $n3 == NULL && $n4 == NULL ){
        $def =NULL;
        }elseif ($n2 == NULL && $n3 == NULL && $n4 == NULL  ){
            $def = $n1;
        }elseif($n1 == NULL && $n3 == NULL && $n4 == NULL ){
            $def= $n2;
        }elseif($n1 == NULL && $n2 == NULL && $n4 == NULL ){
            $def= $n3;
        }elseif($n1 == NULL && $n2 == NULL && $n3 == NULL ){
            $def= $n4;
        }elseif($n3 == NULL && $n4 == NULL ){
            $def= ($n1+$n2)/2;
        }elseif($n2 == NULL && $n4 == NULL ){
            $def= ($n1+$n3)/2;
        }elseif($n1 == NULL && $n4 == NULL ){
            $def= ($n2+$n3)/2;
        }elseif($n2 == NULL && $n3 == NULL ){
            $def= ($n1+$n4)/2;
        }elseif($n1 == NULL && $n3 == NULL ){
            $def= ($n2+$n4)/2;
        }elseif($n1 == NULL && $n2 == NULL ){
            $def= ($n4+$n3)/2;
        }elseif($n4 == NULL ){
            $def= ($n1+$n2+$n3)/3;
        }elseif($n3 == NULL ){
            $def= ($n1+$n2+$n4)/3;
        }elseif($n2 == NULL ){
            $def= ($n1+$n3+$n4)/3;
        }elseif($n1 == NULL ){
            $def= ($n2+$n3+$n4)/3;
        }else{
            $def= ($n1 + $n2 + $n3 + $n4)/4;
        }
        return $def;

	}


	public function obtener_desempeno($nota_final,$ano_lectivo){

		$sql= "SELECT id_desempeno FROM desempenos WHERE '".$nota_final."' >= rango_inicial AND '".$nota_final."' <= rango_final AND '".$ano_lectivo."' = ano_lectivo";

		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['id_desempeno'];
		}
		else{
			return false;
		}

	}



}