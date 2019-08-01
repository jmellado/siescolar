<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Importar_notas_model extends CI_Model {


	public function modificar_nota($ano_lectivo,$file_data,$id_curso,$id_grado,$id_asignatura,$period,$estado_nota){

		//NUEVA TRANSACCION
		$this->db->trans_start();

			for ($i=0; $i < count($file_data); $i++) { 
				
				$id_estudiante = $file_data[$i]['id_estudiante'];
				$nota = $file_data[$i]['nota'];

		        $notas = array(
		        $period         => $nota,
		        'estado_nota'   => $estado_nota);

		        $this->db->where('ano_lectivo',$ano_lectivo);
		        $this->db->where('id_estudiante',$id_estudiante);
		        $this->db->where('id_grado',$id_grado);
				$this->db->where('id_asignatura',$id_asignatura);
				$this->db->update('notas', $notas);

				$nota_final = $this->importar_notas_model->calcularNota_final($ano_lectivo,$id_estudiante,$id_grado,$id_asignatura);
				$id_desempeno = $this->importar_notas_model->obtener_desempeno($nota_final,$ano_lectivo);

				$NotasDesempeño = array(
		        'nota_final'    => $nota_final,
		        'definitiva'    => $nota_final,
		        'id_desempeno'  => $id_desempeno);

		        $this->db->where('ano_lectivo',$ano_lectivo);
		        $this->db->where('id_estudiante',$id_estudiante);
		        $this->db->where('id_grado',$id_grado);
				$this->db->where('id_asignatura',$id_asignatura);
				$this->db->update('notas', $NotasDesempeño);

			}


		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}

	}


	public function convertir_periodo($periodo){

		if ($periodo == "Primero") {

			$period = "p1";
		}
		elseif ($periodo == "Segundo") {

			$period = "p2";
		}
		elseif ($periodo == "Tercero") {

			$period = "p3";
		}
		elseif ($periodo == "Cuarto") {

			$period = "p4";
		}

		return $period;
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


	public function validar_notas($ano_lectivo,$file_data){

		$desempenos = $this->importar_notas_model->obtener_Desempenos($ano_lectivo);

		$superior_i = $desempenos[0]['rango_inicial'];
		$superior_f = $desempenos[0]['rango_final'];
		$bajo_i = $desempenos[3]['rango_inicial'];
		$bajo_f = $desempenos[3]['rango_final'];

		$notas_validas = array();
		$notas_novalidas = array();

		$notas = $file_data;

		for ($i=0; $i < count($notas); $i++) { 

			if ($notas[$i]['nota'] >= $bajo_i && $notas[$i]['nota'] <= $superior_f) {
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


	//llenar el combo con todos los cursos de una respectiva jornada
	public function llenar_cursos($jornada){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cursos.jornada',$jornada);
		$this->db->where('cursos.ano_lectivo',$ano_lectivo);

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


	//Esta funcion permite validar si el archivo cuenta con la estructura indicada(nombres de columnas).
	public function validar_estructura($nombre_archivotmp){

		$file = fopen($nombre_archivotmp, "r");

		while (($datos = fgetcsv($file, 1000, ",")) !== FALSE) {
	
			if ($datos[0] == "id_curso" && $datos[1] == "id_estudiante" && $datos[2] == "id_asignatura" && 
				$datos[3] == "periodo" && $datos[4] == "nota") {
			
				return true;
			}
			else{

				return false;
			}

		}

		fclose($file);

	}


	// Esta funcion permite validar si el archivo se encuentra vacio, sin contar los nombres de las columnas
	public function validar_archivo_vacio($nombre_archivotmp){

		$file = fopen($nombre_archivotmp, "r");
		$i = 0;

		while (($datos = fgetcsv($file, 1000, ",")) !== FALSE) {

			if ($i != 0) {
				
				if ($datos[0] == "") {
				
					return false;
				}
				else{

					return true;
				}

			}

			$i++;
		}

		fclose($file);

	}


	// Esta funcion permite validar si el archivo importado corresponde al curso, asignatura y periodo seleccionados.
	public function validar_archivo($file_data,$id_curso,$id_asignatura,$periodo){

		$id_curs = $file_data[0]['id_curso'];
		$id_asig = $file_data[0]['id_asignatura'];
		$peri = $file_data[0]['periodo'];

		if ($id_curso == $id_curs && $id_asignatura == $id_asig && $periodo == $peri) {
			
			return true;
		}
		else{

			return false;
		}

	}

}