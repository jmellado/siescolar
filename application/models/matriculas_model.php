<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matriculas_model extends CI_Model {


	public function insertar_matricula($matricula,$est_acud,$estado,$historial,$promocion,$id_estudiante){

		$this->db->trans_start();
		$this->db->insert('matriculas', $matricula);
		$this->db->insert('estudiantes_acudientes', $est_acud);

		$this->db->where('id_persona',$id_estudiante);
		$this->db->update('estudiantes', $estado);

		$this->db->insert('historial_estados', $historial);

		$this->db->insert('promocion', $promocion);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}
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

	public function validar_existencia_pensum($id_curso,$ano_lectivo){

		$id_grado = $this->matriculas_model->obtener_gradoDelcurso($id_curso);

		$this->db->where('id_grado',$id_grado);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('pensum');

		if ($query->num_rows() > 0) {
			return true;
		}
		else{
			return false;
		}

	}

	public function buscar_matricula($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('personas.identificacion',$id,'after');
		$this->db->or_like('personas.nombres',$id,'after');
		$this->db->or_like('personas.apellido1',$id,'after');
		$this->db->or_like('personas.apellido2',$id,'after');
		$this->db->or_like('grados.nombre_grado',$id,'after');
		$this->db->or_like('grupos.nombre_grupo',$id,'after');
		$this->db->or_like('matriculas.jornada',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');
		$this->db->or_like('matriculas.fecha_matricula',$id,'after');
		$this->db->or_like('matriculas.estado_matricula',$id,'after');
		$this->db->or_like('matriculas.situacion_academica',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",personas.nombres,personas.apellido1,personas.apellido2)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",personas.apellido1,personas.apellido2)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",grados.nombre_grado,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",grados.nombre_grado,grupos.nombre_grupo,anos_lectivos.nombre_ano_lectivo)',$id,'after');
		$this->db->or_like('CONCAT_WS(" ",grados.nombre_grado,grupos.nombre_grupo,matriculas.jornada,anos_lectivos.nombre_ano_lectivo)',$id,'after');

		$this->db->order_by('matriculas.ano_lectivo', 'desc');
		$this->db->order_by('matriculas.jornada', 'asc');
		$this->db->order_by('grados_educacion.nivel_educacion', 'asc');
		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');
		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'matriculas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('anos_lectivos', 'matriculas.ano_lectivo = anos_lectivos.id_ano_lectivo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('matriculas.id_matricula,matriculas.fecha_matricula,matriculas.ano_lectivo,matriculas.id_estudiante,matriculas.id_curso,grados.nombre_grado,grupos.nombre_grupo,matriculas.jornada,matriculas.id_acudiente,matriculas.parentesco,matriculas.observaciones,matriculas.estado_matricula,matriculas.situacion_academica,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('matriculas');

		return $query->result();
		
	}

	public function eliminar_matricula($id,$id_estudiante,$ano_lectivo,$estado){

       	$this->db->trans_start();
		$this->db->where('id_matricula',$id);
		$this->db->delete('matriculas');

		$this->db->where('id_estudiante',$id_estudiante);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->delete('estudiantes_acudientes');

		$this->db->where('id_persona',$id_estudiante);
		$this->db->update('estudiantes', $estado);

		$this->db->where('id_persona',$id_estudiante);
		$this->db->where('estado',"Matriculado");
		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->delete('historial_estados');

		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->where('id_estudiante',$id_estudiante);
		$this->db->delete('promocion');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}
    }

    public function modificar_matricula($id,$matricula,$est_acud,$id_estudiante,$ano_lectivo){

		$this->db->trans_start();
		$this->db->where('id_matricula',$id);
		$this->db->update('matriculas', $matricula);

		$this->db->where('id_estudiante',$id_estudiante);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->update('estudiantes_acudientes', $est_acud);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_matricula');
		$query = $this->db->get('matriculas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_matricula'];
        return $data['query'];
	}


	public function obtener_fecha_estado($id_estudiante,$ano_lectivo){

		$this->db->where('id_persona',$id_estudiante);
		$this->db->where('estado',"Inscrito");
		$this->db->where('ano_lectivo',$ano_lectivo);

		$query = $this->db->get('historial_estados');

		if ($query->num_rows() > 0) {
			$row = $query->result_array();
			$fecha_estado = $row[0]['fecha_estado'];

			return $fecha_estado;
		}
		else{
			return false;
		}

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
		$this->db->join('salones', 'cursos.id_salon = salones.id_salon');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,cursos.id_salon,grados.nombre_grado,grupos.nombre_grupo,cursos.cupo_maximo');

		$query = $this->db->get('cursos');
		$row = $query->result_array();
		$total = $query->num_rows();
		$listaArray = array();

		for ($i=0; $i < $total ; $i++) { 
			
			$id_curso = $row[$i]['id_curso'];
			$cupo_maximo = $row[$i]['cupo_maximo'];
			$total_curso_matricula = $this->matriculas_model->total_cursos_matricula($id_curso);

			if ($total_curso_matricula < $cupo_maximo) {
			
				$this->db->where('id_curso',$id_curso);

				$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
				$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');

				$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,cursos.id_salon,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');

				$query2 = $this->db->get('cursos');

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
	public function total_cursos_matricula($id_curso){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('id_curso',$id_curso);
		$this->db->where('ano_lectivo',$ano_lectivo);

		$query = $this->db->get('matriculas');

		return count($query->result());

	}


	//Esta Funcion me permite obtener el grado por el salon registrado en la tabla matricula
	public function obtener_gradoPorcurso($id_curso){

		$this->db->where('matriculas.id_curso',$id_curso);

		$this->db->join('cursos', 'matriculas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');

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


	//Esta Funcion me permite obtener el id_grado del curso seleccionado
	public function obtener_gradoDelcurso($id_curso){

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
	public function insertar_asignaturasPorestudiantes($ano_lectivo,$id_estudiante,$id_grado,$id_asignatura){

		$sql= "INSERT INTO notas(ano_lectivo, id_estudiante, id_grado, id_asignatura) VALUES('". $ano_lectivo."','". $id_estudiante ."','". $id_grado ."','".$id_asignatura."')";

		if ($this->db->query($sql)) 
			return true;
		else
			return false;

	}


	//esta funcion me permite obtener informacion informacion de una matricula
	public function obtener_informacion_matricula($id_matricula){

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

    //Esta funcion me permite obtener los acudientes activos
    public function llenar_acudientes(){

    	$this->db->where('acudientes.estado_acudiente',"Activo");

    	$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('acudientes', 'personas.id_persona = acudientes.id_persona');
		$query = $this->db->get('personas');
		return $query->result();
	}

	
	public function llenar_cursos_actualizar($jornada,$ano_lectivo){

		$this->db->where('cursos.jornada',$jornada);
		$this->db->where('cursos.ano_lectivo',$ano_lectivo);
		
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('salones', 'cursos.id_salon = salones.id_salon');

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,cursos.id_salon,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');

		$query = $this->db->get('cursos');
		return $query->result_array();

	}


	public function llenar_anos_lectivos_actualizar(){

		$query = $this->db->get('anos_lectivos');
		return $query->result();
	}


	//****************************************** FUNCIONES PARA MATRICULAR ESTUDIANTES ANTIGUOS ***************************************

	//Esta Funcion Permite Comprobar Si El Estudiante Es Nuevo O Antiguo.
	public function comprobar_NuevoAntiguo($identificacion){

		$this->db->where('personas.identificacion',$identificacion);

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	//Esta Funcion Permite Obtener La Ultima Matricula De Un Estudiante.
	public function UltimaMatricula($identificacion){

		$this->db->where('personas.identificacion',$identificacion);

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select_max('id_matricula');

		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			$row = $query->result_array();
			return $row[0]['id_matricula'];
		}
		else{
			return false;
		}

	}


	public function obtener_informacion_grado($id_grado){

		$this->db->where('id_grado',$id_grado);
		$query = $this->db->get('grados');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else{
			return false;
		}

	}

	// Esta Funcion Permite Obtener El Proximo Grado A Cursar Por Un Estudiante.
	public function obtener_proximo_grado($nombre_grado){

		$this->db->where('nombre_grado',$nombre_grado);
		$query = $this->db->get('grados_educacion');

		if ($query->num_rows() > 0) {

			$consulta = $query->result_array();
			$id_grado_educacion = $consulta[0]['id_grado_educacion'];

			if ($id_grado_educacion == "14") {
				
				$id_grado_educacion_proximo = "1";

				$this->db->where('id_grado_educacion',$id_grado_educacion_proximo);
				$query2 = $this->db->get('grados_educacion');

				if ($query2->num_rows() > 0) {

					$row1 = $query2->result_array();
					return $row1[0]['nombre_grado'];
				}
				else{
					return false;
				}


			}
			else {
				
				$id_grado_educacion_proximo = $id_grado_educacion + 1;

				$this->db->where('id_grado_educacion',$id_grado_educacion_proximo);
				$query2 = $this->db->get('grados_educacion');

				if ($query2->num_rows() > 0) {

					$row2 = $query2->result_array();
					return $row2[0]['nombre_grado'];
				}
				else{
					return false;
				}
			}

			
		}
		else{
			return false;
		}

	}

  	//Esta Funcion Permite Obtener Los Cursos Que Puede Cursar Un Estudiante Antiguo, Dependiendo Del Estado Su Ultima Matricula.
	public function llenar_cursosA($jornada,$nombre_grado){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cursos.jornada',$jornada);
		$this->db->where('cursos.ano_lectivo',$ano_lectivo);
		$this->db->where('grados.nombre_grado',$nombre_grado);

		$this->db->order_by('grupos.nombre_grupo', 'asc');
		
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('salones', 'cursos.id_salon = salones.id_salon');

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,cursos.id_salon,grados.nombre_grado,grupos.nombre_grupo,cursos.cupo_maximo');

		$query = $this->db->get('cursos');
		$row = $query->result_array();
		$total = $query->num_rows();
		$listaArray = array();

		for ($i=0; $i < $total ; $i++) { 
			
			$id_curso = $row[$i]['id_curso'];
			$cupo_maximo = $row[$i]['cupo_maximo'];
			$total_curso_matricula = $this->matriculas_model->total_cursos_matricula($id_curso);

			if ($total_curso_matricula < $cupo_maximo) {
			
				$this->db->where('id_curso',$id_curso);

				$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
				$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');

				$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,cursos.id_salon,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');

				$query2 = $this->db->get('cursos');

				$listaArray[] =$query2->row();

			}
		}

		return $listaArray;
	}


	//********************************* FUNCIONES PARA EL CONSOLIDADO DE MATRICULAS ****************************************


	//Esta funcion me permite obtener todos los estudiantes matriculados en un respectivo año lectivo
	public function buscar_estudiantes_matriculados($ano_lectivo,$id_curso){

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.id_curso',$id_curso);

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'matriculas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('anos_lectivos', 'matriculas.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('matriculas.id_matricula,matriculas.fecha_matricula,matriculas.ano_lectivo,matriculas.id_estudiante,matriculas.id_curso,grados.nombre_grado,grupos.nombre_grupo,matriculas.jornada,matriculas.id_acudiente,matriculas.parentesco,matriculas.observaciones,matriculas.estado_matricula,matriculas.situacion_academica,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('matriculas');

		return $query->result_array();
		
	}


	//Esta funcion me permite calcular el estado de la matricula de un estudiante.
	// Calculando su promedio general, el numero de asignaturas aprobadas y reprobadas
	public function calcular_estado_matricula($ano_lectivo,$id_estudiante){

		//array sencillo para las asignaturas aprobadas y reprobadas
		$asignaturas_aprobadas = array();
		$asignaturas_reprobadas = array();
		$totalnotas = 0;

		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);

		$this->db->select('notas.id_estudiante,notas.id_grado,notas.id_asignatura,IFNULL(notas.nota_final, 0.0) as nota_final',false);

		$query = $this->db->get('notas');

		$NotasAsignaturas = $query->result_array();

		for ($i=0; $i < count($NotasAsignaturas); $i++) {

			$totalnotas = $totalnotas + $NotasAsignaturas[$i]['nota_final'];

			if ($NotasAsignaturas[$i]['nota_final'] >= 3.0 && $NotasAsignaturas[$i]['nota_final'] <= 5.0) {
				
				$asignaturas_aprobadas[] = $NotasAsignaturas[$i]['nota_final'];
			}
			else{

				$asignaturas_reprobadas[] = $NotasAsignaturas[$i]['nota_final'];
			}
			
		}

		$promedio = $totalnotas / count($NotasAsignaturas);

		if ($promedio >= 3.0 && $promedio <= 5.0) {

			return "Aprobado";
		}
		else{

			if (count($asignaturas_reprobadas) > 2) {

				return "Reprobado";
			}
			else{

				return "Nivelacion";
			}
		}
	}


	// Esta funcion me permite actualizar el estado o situacion_academica de la matricula en la tabla matriculas.
	public function modificar_estado_matricula($jornada,$id_curso){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$estudiantes = $this->matriculas_model->buscar_estudiantes_matriculados($ano_lectivo,$id_curso);

		//NUEVA TRANSACCION
		$this->db->trans_start();

			for ($i=0; $i < count($estudiantes); $i++) { 
				
				$id_estudiante = $estudiantes[$i]['id_estudiante'];
				$estado_matricula = $this->matriculas_model->calcular_estado_matricula($ano_lectivo,$id_estudiante);

				$matriculas = array('situacion_academica' => $estado_matricula);

				$this->db->where('ano_lectivo',$ano_lectivo);
				$this->db->where('id_estudiante',$id_estudiante);
				$this->db->update('matriculas', $matriculas);
			}


		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}
	}


	//Esta Funcion me permite obtener el numero total de periodos de evaluacion con estado activo
    public function PeriodosActivos(){

    	$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		
    	$this->db->where('id_categoria',"1");
    	$this->db->where('ano_lectivo',$ano_lectivo);
    	$this->db->where('estado_actividad',"Activo");

		$query = $this->db->get('cronogramas');

		if ($query->num_rows() > 0) {
			return count($query->result());
		}
		else{
			return 0;
		}

	}


	//Esta Funcion me permite obtener el numero total de periodos de evaluacion registrados o creados
    public function PeriodosRegistrados(){

    	$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		
    	$this->db->where('id_categoria',"1");
    	$this->db->where('ano_lectivo',$ano_lectivo);

		$query = $this->db->get('cronogramas');

		if ($query->num_rows() > 0) {
			return count($query->result());
		}
		else{
			return 0;
		}

	}



	//Esta Funcion me permite obtener el numero total de periodos de evaluacion con estado cerrado
    public function PeriodosCerrados(){

    	$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		
    	$this->db->where('id_categoria',"1");
    	$this->db->where('ano_lectivo',$ano_lectivo);
    	$this->db->where('estado_actividad',"Cerrado");

		$query = $this->db->get('cronogramas');

		if ($query->num_rows() > 0) {
			return count($query->result());
		}
		else{
			return 0;
		}

	}


	//llenar el combo con todos los cursos de una respectiva jornada
	public function llenar_cursosCM($jornada){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cursos.jornada',$jornada);
		$this->db->where('cursos.ano_lectivo',$ano_lectivo);

		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');

		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');
		
		$query = $this->db->get('cursos');
		return $query->result();
	}



	//******************* FUNCIONES PARA IMPRIMIR FICHAS DE MATRICULAS *********************


	public function obtener_informacion_colegio(){

		$query = $this->db->get('datos_institucion');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
        	
		}
		else{
			return false;
		}

	}


	public function validar_existencia_matricula($id_matricula){

		$this->db->where('id_matricula',$id_matricula);
		
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return true;
		}
		else{
			return false;
		}

	}


	public function obtener_informacion_matricula_ficha($id_matricula){

		$this->db->where('matriculas.id_matricula',$id_matricula);

		$this->db->join('personas as est', 'matriculas.id_estudiante = est.id_persona');
		$this->db->join('cursos', 'matriculas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('anos_lectivos', 'matriculas.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->join('personas as acu', 'matriculas.id_acudiente = acu.id_persona');
		$this->db->join('acudientes as acud', 'acu.id_persona = acud.id_persona');

		$this->db->join('municipios', 'est.municipio_nacimiento = municipios.id_municipio');

		$this->db->join('estudiantes_padres as e_p', 'est.id_persona = e_p.id_estudiante');
		$this->db->join('padres', 'e_p.id_padre = padres.id_padre');
		$this->db->join('madres', 'e_p.id_madre = madres.id_madre');

		$this->db->select('matriculas.id_matricula,matriculas.fecha_matricula,matriculas.ano_lectivo,matriculas.id_estudiante,matriculas.id_curso,matriculas.jornada,matriculas.id_acudiente,matriculas.parentesco,matriculas.observaciones,est.identificacion as identificacionest,est.tipo_id as tipo_idest,est.nombres as nombresest,est.apellido1 as apellido1est,est.apellido2 as apellido2est,est.sexo as sexoest,est.fecha_nacimiento as fecha_nacimientoest,est.eps as epsest,est.tipo_sangre as tipo_sangreest,est.telefono as telefonoest,est.direccion as direccionest,est.barrio as barrioest,municipios.nombre_municipio,acu.identificacion as identificacionacu,acu.nombres as nombresacu,acu.apellido1 as apellido1acu,acu.apellido2 as apellido2acu,acu.telefono as telefonoacu,acu.direccion as direccionacu,acu.barrio as barrioacu,acud.ocupacion as ocupacionacu,acud.telefono_trabajo as telefono_trabajoacu,padres.identificacion_p,padres.nombres_p,padres.apellido1_p,padres.apellido2_p,padres.telefono_p,padres.direccion_p,padres.barrio_p,padres.ocupacion_p,padres.telefono_trabajo_p,madres.identificacion_m,madres.nombres_m,madres.apellido1_m,madres.apellido2_m,madres.telefono_m,madres.direccion_m,madres.direccion_m,madres.barrio_m,madres.ocupacion_m,madres.telefono_trabajo_m,grados.nombre_grado,grupos.nombre_grupo,anos_lectivos.nombre_ano_lectivo,municipios.nombre_municipio as nombre_municipioest');

		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else{
			return false;
		}


	}



	//******************* FUNCIONES PARA CONSULTAR LA SITUACION ACADEMICA *********************


	//llenar el combo con todos los cursos de una respectiva jornada
	public function llenar_cursosSA($jornada){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cursos.jornada',$jornada);
		$this->db->where('cursos.ano_lectivo',$ano_lectivo);

		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');

		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');
		
		$query = $this->db->get('cursos');
		return $query->result();
	}


	//Esta funcion me permite obtener todos los estudiantes matriculados en un respectivo curso y año lectivo
	public function buscar_estudiantes_matriculados_curso($ano_lectivo,$id_curso){

		$this->db->where('matriculas.ano_lectivo',$ano_lectivo);
		$this->db->where('matriculas.id_curso',$id_curso);

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'matriculas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('anos_lectivos', 'matriculas.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('matriculas.id_matricula,matriculas.fecha_matricula,matriculas.ano_lectivo,matriculas.id_estudiante,matriculas.id_curso,grados.nombre_grado,grupos.nombre_grupo,matriculas.jornada,matriculas.id_acudiente,matriculas.parentesco,matriculas.observaciones,matriculas.estado_matricula,matriculas.situacion_academica,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('matriculas');

		return $query->result_array();
		
	}


	// Esta funcion me permite consultar la situacion academica de los estudiantes de un respectivo curso y año lectivo 
	public function buscar_situacionacademica($jornada,$id_curso){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$estudiantes = $this->matriculas_model->buscar_estudiantes_matriculados_curso($ano_lectivo,$id_curso);

		$listado_estudiantes = array();

		for ($i=0; $i < count($estudiantes); $i++) { 
			
			$id_estudiante = $estudiantes[$i]['id_estudiante'];
			$estado_matricula = $this->matriculas_model->calcular_estado_matricula($ano_lectivo,$id_estudiante);
			$total = $this->matriculas_model->calcular_asignaturasreprobadas_fallas($ano_lectivo,$id_estudiante);

			$estudiant = array(

				'id_matricula' 			=> $estudiantes[$i]['id_matricula'],
				'id_estudiante' 		=> $estudiantes[$i]['id_estudiante'],
				'identificacion' 		=> $estudiantes[$i]['identificacion'],
				'nombres' 				=> $estudiantes[$i]['nombres'],
				'apellido1' 			=> $estudiantes[$i]['apellido1'],
				'apellido2' 			=> $estudiantes[$i]['apellido2'],
				'id_curso' 				=> $estudiantes[$i]['id_curso'],
				'nombre_grado' 			=> $estudiantes[$i]['nombre_grado'],
				'nombre_grupo' 			=> $estudiantes[$i]['nombre_grupo'],
				'jornada' 				=> $estudiantes[$i]['jornada'],
				'asig_reprobadas' 		=> $total[0],
				'total_fallas' 			=> $total[1],
				'estado_matricula' 		=> $estado_matricula,
				'ano_lectivo' 			=> $estudiantes[$i]['ano_lectivo'],
				'nombre_ano_lectivo' 	=> $estudiantes[$i]['nombre_ano_lectivo']
			);

			$listado_estudiantes[] = $estudiant;

		}

		return $listado_estudiantes;
		
	}


	//Esta funcion me permite calcular el total de asignaturas reprobadas y fallas por estudiante.
	public function calcular_asignaturasreprobadas_fallas($ano_lectivo,$id_estudiante){

		//array sencillo para las asignaturas aprobadas y reprobadas
		$asignaturas_aprobadas = array();
		$asignaturas_reprobadas = array();
		$totalfallas = 0;

		$this->db->where('notas.ano_lectivo',$ano_lectivo);
		$this->db->where('notas.id_estudiante',$id_estudiante);

		$this->db->select('notas.id_estudiante,notas.id_grado,notas.id_asignatura,IFNULL(notas.nota_final, 0.0) as nota_final,IF(notas.fallas = "","0", notas.fallas) as fallas',false);

		$query = $this->db->get('notas');

		$NotasAsignaturas = $query->result_array();

		for ($i=0; $i < count($NotasAsignaturas); $i++) {

			$totalfallas = $totalfallas + $NotasAsignaturas[$i]['fallas'];

			if ($NotasAsignaturas[$i]['nota_final'] >= 3.0 && $NotasAsignaturas[$i]['nota_final'] <= 5.0) {
				
				$asignaturas_aprobadas[] = $NotasAsignaturas[$i]['nota_final'];
			}
			else{

				$asignaturas_reprobadas[] = $NotasAsignaturas[$i]['nota_final'];
			}
			
		}

		$data = array(

			count($asignaturas_reprobadas),
			$totalfallas
		);

		return $data;
	}


	//******************* FUNCIONES PARA RETIRAR ESTUDIANTES *********************
	

	//llenar el combo con todos los cursos de una respectiva jornada
	public function llenar_cursosRT($jornada){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cursos.jornada',$jornada);
		$this->db->where('cursos.ano_lectivo',$ano_lectivo);

		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		$this->db->order_by('grupos.nombre_grupo', 'asc');

		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');
		
		$query = $this->db->get('cursos');
		return $query->result();
	}


	public function llenar_estudiantesRT($id_curso){

		$this->db->where('matriculas.id_curso',$id_curso);
		$this->db->where('matriculas.estado_matricula',"Activo");

		$this->db->order_by('personas.apellido1', 'asc');
		$this->db->order_by('personas.apellido2', 'asc');
		$this->db->order_by('personas.nombres', 'asc');

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select('matriculas.id_estudiante,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('matriculas');

		return $query->result_array();

	}


	public function obtener_ultimo_idretiro(){

		$this->db->select_max('id_retiro');
		$query = $this->db->get('retiros');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_retiro'];
        return $data['query'];
	}


	public function insertar_retiro($retiro,$estado,$historial,$estado_matricula,$id_estudiante,$id_curso,$ano_lectivo){

		$this->db->trans_start();
		$this->db->insert('retiros', $retiro);

		$this->db->where('id_persona',$id_estudiante);
		$this->db->update('estudiantes', $estado);

		$this->db->insert('historial_estados', $historial);

		$this->db->where('id_estudiante',$id_estudiante);
		$this->db->where('id_curso',$id_curso);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->update('matriculas', $estado_matricula);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}
	}


	public function buscar_retiro($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('est.identificacion',$id,'after');
		$this->db->or_like('est.nombres',$id,'after');
		$this->db->or_like('est.apellido1',$id,'after');
		$this->db->or_like('est.apellido2',$id,'after');
		$this->db->or_like('grados.nombre_grado',$id,'after');
		$this->db->or_like('grupos.nombre_grupo',$id,'after');
		$this->db->or_like('cursos.jornada',$id,'after');
		$this->db->or_like('retiros.fecha_retiro',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');

		$this->db->order_by('retiros.ano_lectivo', 'desc');
		$this->db->order_by('retiros.fecha_registro', 'desc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('cursos', 'retiros.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('personas as est', 'retiros.id_estudiante = est.id_persona');
		$this->db->join('anos_lectivos', 'retiros.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('retiros.id_retiro,retiros.ano_lectivo,retiros.id_estudiante,retiros.id_curso,retiros.observaciones,retiros.fecha_retiro,retiros.fecha_registro,est.identificacion as identificacionest,est.nombres as nombresest,est.apellido1 as apellido1est,est.apellido2 as apellido2est,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('retiros');

		return $query->result();
		
	}

}