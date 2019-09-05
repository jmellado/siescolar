<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Importar_logros_model extends CI_Model {


	public function insertar_logros($ano_lectivo,$file_data,$id_curso,$id_grado,$id_asignatura,$periodo){

		//NUEVA TRANSACCION
		$this->db->trans_start();

			for ($i=0; $i < count($file_data); $i++) { 

				$id_estudiante = $file_data[$i]['id_estudiante'];
				$id_logro1 = $file_data[$i]['id_logro1'];
				$id_logro2 = $file_data[$i]['id_logro2'];
				$id_logro3 = $file_data[$i]['id_logro3'];
				$id_logro4 = $file_data[$i]['id_logro4'];

				if ($id_logro1 == "") {
					$id_logro1 = NULL;
				}
				if ($id_logro2 == "") {
					$id_logro2 = NULL;
				}
				if ($id_logro3 == "") {
					$id_logro3 = NULL;
				}
				if ($id_logro4 == "") {
					$id_logro4 = NULL;
				}

				$estado = $this->importar_logros_model->validar_existencia_logros_asignados($ano_lectivo,$id_estudiante,
					$periodo,$id_grado,$id_asignatura);

				if ($estado) {
					
					$data = array(
		        	'ano_lectivo'   => $ano_lectivo,
		            'id_estudiante' => $id_estudiante,
		            'periodo'       => $periodo,
		            'id_grado'      => $id_grado,
		            'id_asignatura' => $id_asignatura,
		            'id_logro1'     => $id_logro1,
		            'id_logro2'     => $id_logro2,
		            'id_logro3'     => $id_logro3,
		            'id_logro4'     => $id_logro4);

		            $this->db->insert('logros_asignados', $data);

				}
				else{

					$data = array(
		            'id_logro1'     => $id_logro1,
		            'id_logro2'     => $id_logro2,
		            'id_logro3'     => $id_logro3,
		            'id_logro4'     => $id_logro4);

		            $this->db->where('ano_lectivo',$ano_lectivo);
					$this->db->where('id_estudiante',$id_estudiante);
					$this->db->where('periodo',$periodo);
					$this->db->where('id_grado',$id_grado);
					$this->db->where('id_asignatura',$id_asignatura);
					$this->db->update('logros_asignados', $data);

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


	// Esta funcion permite validar si un estudiante tiene logros asignados
	public function validar_existencia_logros_asignados($ano_lectivo,$id_estudiante,$periodo,$id_grado,$id_asignatura){

		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->where('id_estudiante',$id_estudiante);
		$this->db->where('periodo',$periodo);
		$this->db->where('id_grado',$id_grado);
		$this->db->where('id_asignatura',$id_asignatura);
		$query = $this->db->get('logros_asignados');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
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

		$inputFileType = PHPExcel_IOFactory::identify($nombre_archivotmp);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($nombre_archivotmp);
		$sheet = $objPHPExcel->getSheet(0);

		$datos = $sheet->rangeToArray('A1:L1', NULL, TRUE, FALSE);
		$datos = $datos[0];

		if ($datos[0] == "id_curso" && $datos[2] == "id_estudiante" && $datos[4] == "id_asignatura" && 
			$datos[6] == "periodo" && $datos[7] == "nota" && $datos[8] == "id_logro1" && $datos[9] == "id_logro2" &&
			$datos[10] == "id_logro3" && $datos[11] == "id_logro4") {
		
			return true;
		}
		else{

			return false;
		}

	}


	// Esta funcion permite validar si el archivo se encuentra vacio, sin contar los nombres de las columnas
	public function validar_archivo_vacio($nombre_archivotmp){

		$inputFileType = PHPExcel_IOFactory::identify($nombre_archivotmp);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($nombre_archivotmp);
		$sheet = $objPHPExcel->getSheet(0);

		$datos = $sheet->rangeToArray('A2:L2', NULL, TRUE, FALSE);
		$datos = $datos[0];

		if ($datos[0] == "") {
		
			return false;
		}
		else{

			return true;
		}

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


	public function validar_notas($ano_lectivo,$file_data){

		$desempenos = $this->importar_logros_model->obtener_Desempenos($ano_lectivo);

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


	// Esta funcion permite validar que los logros asignados existan y que se asigne minimo un logro
	public function validar_logros($ano_lectivo,$file_data,$id_curso,$id_grado,$id_asignatura,$periodo){

		$logros_ingresados = array();
		$logros_novalidos = array();

		for ($i=0; $i < count($file_data); $i++) {

			$id_logro1 = $file_data[$i]['id_logro1'];
			$id_logro2 = $file_data[$i]['id_logro2'];
			$id_logro3 = $file_data[$i]['id_logro3'];
			$id_logro4 = $file_data[$i]['id_logro4'];

			if ($id_logro1 != "") {
			 	
			 	$logros_ingresados[] = $id_logro1;
			} 
			if (!$this->importar_logros_model->validar_existencia_logro($id_logro1,$periodo,$id_grado,$id_asignatura,
				$ano_lectivo)) {
				$logros_novalidos[] = $id_logro1;
			}
			if (!$this->importar_logros_model->validar_existencia_logro($id_logro2,$periodo,$id_grado,$id_asignatura,
				$ano_lectivo)) {
				$logros_novalidos[] = $id_logro2;
			}
			if (!$this->importar_logros_model->validar_existencia_logro($id_logro3,$periodo,$id_grado,$id_asignatura,
				$ano_lectivo)) {
				$logros_novalidos[] = $id_logro3;
			}
			if (!$this->importar_logros_model->validar_existencia_logro($id_logro4,$periodo,$id_grado,$id_asignatura,
				$ano_lectivo)) {
				$logros_novalidos[] = $id_logro4;
			}
			
		}

		if (count($logros_ingresados) == count($file_data) && count($logros_novalidos) == 0) {

			return true;
		}
		else{

			return false;
		}

	}


	// Estas funcion permite validar si el id_logro existe, esta registrado.
	public function validar_existencia_logro($id_logro,$periodo,$id_grado,$id_asignatura,$ano_lectivo){

		if ($id_logro == "") {
			
			return true;
		}
		else{

			$this->db->where('id_logro',$id_logro);
			$this->db->where('periodo',$periodo);
			$this->db->where('id_grado',$id_grado);
			$this->db->where('id_asignatura',$id_asignatura);
			$this->db->where('ano_lectivo',$ano_lectivo);
			$query = $this->db->get('logros');

			if ($query->num_rows() > 0) {
				return true;
			}
			else{
				return false;
			}

		}

	}


	// Esta funcion permite convertir un rango de celdas(excel) en un array asociativo
	public function get_array($nombre_archivotmp){

		$inputFileType = PHPExcel_IOFactory::identify($nombre_archivotmp);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($nombre_archivotmp);
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();

		$encabezados = $sheet->rangeToArray('A1:' . $highestColumn . '1', NULL, TRUE, FALSE);
		$encabezados = $encabezados[0];
		$total_encabezados = count($encabezados);

		$registros = array();

		for ($i=2; $i <= $highestRow; $i++) {

			$rowData = $sheet->rangeToArray('A' . $i . ':' . $highestColumn . $i, NULL, TRUE, FALSE);
			$rowData = $rowData[0];

			for ($j=0; $j < $total_encabezados; $j++) {

				$registro[$encabezados[$j]] = $rowData[$j]; 
			 	
			}

			$registros[] = $registro; 
			
		}

		return $registros;

	}

}