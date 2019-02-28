<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notas_model extends CI_Model {


	public function modificar_nota($ano_lectivo,$estudiantes,$id_curso,$id_asignatura,$pe1,$pe2,$pe3,$pe4,$fallast,$estado_nota){

		//NUEVA TRANSACCION
		$this->db->trans_start();

			for ($i=0; $i < count($estudiantes); $i++) { 
				
				$id_estudiante = $estudiantes[$i];
				$p1 = $pe1[$i];
				$p2 = $pe2[$i];
				$p3 = $pe3[$i];
				$p4 = $pe4[$i];
				$fallas = $fallast[$i];

				$nota_final = $this->notas_model->calcularNota_final($p1,$p2,$p3,$p4);
				$id_desempeno = $this->notas_model->obtener_desempeno($nota_final,$ano_lectivo);
				$id_grado = $this->notas_model->obtener_gradoPorcurso($id_curso);

				if ($p1==""){
		            $p1=NULL;
		        }
		        if ($p2==""){
		            $p2=NULL;
		        }
		        if ($p3==""){
		            $p3=NULL;
		        }
		        if ($p4==""){
		            $p4=NULL;
		        }

		        $notas = array(
		        'ano_lectivo'   => $ano_lectivo,
		        'id_estudiante' => $id_estudiante,
		        'id_asignatura' => $id_asignatura,
		        'p1'            => $p1,
		        'p2'            => $p2,
		        'p3'            => $p3,
		        'p4'            => $p4,
		        'nota_final'    => $nota_final,
		        'definitiva'    => $nota_final,
		        'id_desempeno'  => $id_desempeno,
		        'fallas'        => $fallas,
		        'estado_nota'   => $estado_nota);

		        $this->db->where('ano_lectivo',$ano_lectivo);
		        $this->db->where('id_estudiante',$id_estudiante);
		        $this->db->where('id_grado',$id_grado);
				$this->db->where('id_asignatura',$id_asignatura);
				$this->db->update('notas', $notas);

			}


		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}

	}


	public function validar_fechaIngresoNotas($periodo,$fecha_actual){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		$estado_actividad = "Activo";

		$sql= "SELECT nombre_actividad FROM cronogramas WHERE nombre_actividad ='". $periodo."' AND ano_lectivo ='".$ano_lectivo."' AND estado_actividad ='".$estado_actividad."' AND '".$fecha_actual."' >= fecha_inicial AND '".$fecha_actual."' <= fecha_final";

		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) 
			return true;
		else
			return false;
		
	}



	public function buscar_nota($id,$inicio = FALSE,$cantidad = FALSE,$id_curso = FALSE,$id_asignatura = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('notas.id_asignatura',$id_asignatura);
		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.estado_matricula',"Activo");
		

		/*if ($inicio !== FALSE && $cantidad !== FALSE && $id_curso !== FALSE && $id_asignatura != FALSE) {
			$this->db->limit($cantidad,$inicio);
		}*/

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('estudiantes', 'matriculas.id_estudiante = estudiantes.id_persona');
		$this->db->join('notas', 'matriculas.id_estudiante = notas.id_estudiante');

		$this->db->select('matriculas.id_estudiante,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,IFNULL(notas.p1,"") as p1,IFNULL(notas.p2,"") as p2,IFNULL(notas.p3,"") as p3,IFNULL(notas.p4,"") as p4,IFNULL(notas.nota_final,"") as nota_final,notas.fallas', false);
		
		$query = $this->db->get('matriculas');

		return $query->result();
	
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


	public function llenar_cursos_profesor($id_profesor){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cargas_academicas.id_profesor',$id_profesor);
		$this->db->where('cargas_academicas.ano_lectivo',$ano_lectivo);

		$this->db->order_by('cursos.jornada', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');

		$this->db->join('cursos', 'cargas_academicas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('DISTINCT(cargas_academicas.id_curso),grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');

		$query = $this->db->get('cargas_academicas');
		return $query->result();
	}


	public function llenar_asignaturas_profesor($id_profesor,$id_curso){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cargas_academicas.id_profesor',$id_profesor);
		$this->db->where('cargas_academicas.id_curso',$id_curso);
		$this->db->where('cargas_academicas.ano_lectivo',$ano_lectivo);

		$this->db->order_by('asignaturas.nombre_asignatura', 'asc');
		
		$this->db->join('asignaturas', 'cargas_academicas.id_asignatura = asignaturas.id_asignatura');

		$this->db->select('DISTINCT(cargas_academicas.id_asignatura),asignaturas.nombre_asignatura');

		$query = $this->db->get('cargas_academicas');
		return $query->result();
	}


	public function calcularNota_final($n1,$n2,$n3,$n4){

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
        return round($def, 1);

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


	public function validar_notas($ano_lectivo,$periodo,$p1,$p2,$p3,$p4){

		$desempenos = $this->notas_model->obtener_Desempenos($ano_lectivo);

		$superior_i = $desempenos[0]['rango_inicial'];
		$superior_f = $desempenos[0]['rango_final'];
		$bajo_i = $desempenos[3]['rango_inicial'];
		$bajo_f = $desempenos[3]['rango_final'];

		$notas_validas = array();
		$notas_novalidas = array();

		if ($periodo == "Primero") {
			$notas = $p1;
		}
		elseif ($periodo == "Segundo") {
			$notas = $p2;
		}
		elseif ($periodo == "Tercero") {
			$notas = $p3;
		}
		elseif ($periodo == "Cuarto") {
			$notas = $p4;
		}

		for ($i=0; $i < count($notas); $i++) { 

			if ($notas[$i] >= $bajo_i && $notas[$i] <= $superior_f) {
				$notas_validas[] = $notas[$i];
			}
			else{
				$notas_novalidas[] = $notas[$i];
			}
		}

		if (count($notas_validas) == count($notas)) {

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


}

