<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuraciones_model extends CI_Model {


	public function insertar_datos_institucion($institucion){
		if ($this->db->insert('datos_institucion', $institucion)) 
			return true;
		else
			return false;
	}

	public function validar_existencia(){

		$query = $this->db->get('datos_institucion');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function modificar_datos_institucion($institucion){

		if ($this->db->update('datos_institucion', $institucion))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id');
		$query = $this->db->get('datos_institucion');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id'];
        return $data['query'];
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


	public function llenar_paises(){

		$query = $this->db->get('paises');
		return $query->result();
	}


	public function llenar_departamentos($id){

		$this->db->where('id_pais',$id);
		$query = $this->db->get('departamentos');
		return $query->result();
	}
	

	public function llenar_municipios($id){

		$this->db->where('id_departamento',$id);
		$query = $this->db->get('municipios');
		return $query->result();
	}


	//**************************** FUNCIONES PERIODOS DE EVALUACION ****************************************
	public function validar_existencia_actividad($nombre,$ano_lectivo){

		$this->db->where('nombre_actividad',$nombre);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('cronogramas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function obtener_ultimo_idactividad(){

		$this->db->select_max('id_actividad');
		$query = $this->db->get('cronogramas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_actividad'];
        return $data['query'];
	}


	public function insertar_periodo($actividad){
		if ($this->db->insert('cronogramas', $actividad)) 
			return true;
		else
			return false;
	}


	public function buscar_periodo($id,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cronogramas.ano_lectivo',$ano_lectivo);

		$this->db->where("(cronogramas.nombre_actividad LIKE '".$id."%' OR cronogramas.estado_actividad LIKE '".$id."%')", NULL, FALSE);

		$this->db->_protect_identifiers = FALSE;
		$this->db->order_by('FIELD(cronogramas.nombre_actividad, "Primero","Segundo","Tercero","Cuarto")');
		$this->db->_protect_identifiers = TRUE;

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->select('cronogramas.id_actividad,cronogramas.nombre_actividad,cronogramas.fecha_inicial,cronogramas.fecha_final,cronogramas.estado_actividad,');
		
		$query = $this->db->get('cronogramas');

		return $query->result();
		
	}


	public function modificar_periodo($id_actividad,$actividad){

	
		$this->db->where('id_actividad',$id_actividad);

		if ($this->db->update('cronogramas', $actividad))

			return true;
		else
			return false;
	}


	public function activar_periodo($id_actividad){

		$actividad = array('estado_actividad' => "Activo");
		$this->db->where('id_actividad',$id_actividad);

		if ($this->db->update('cronogramas', $actividad))

			return true;
		else
			return false;
	}


	public function cerrar_periodo($id_actividad){

		$actividad = array('estado_actividad' => "Cerrado");
		$this->db->where('id_actividad',$id_actividad);

		if ($this->db->update('cronogramas', $actividad))

			return true;
		else
			return false;
	}


	public function Verificar_PeriodosActivos(){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->where('estado_actividad',"Activo");
		$query = $this->db->get('cronogramas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function Verificar_EstadoPeriodo($id_actividad){

		$this->db->where('id_actividad',$id_actividad);
		$query = $this->db->get('cronogramas');

		if ($query->num_rows() > 0) {
			
			$row = $query->result_array();
        	$estado_actividad = $row[0]['estado_actividad'];

        	if ($estado_actividad == "Inactivo") {
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


	public function obtener_nombre_periodo($id_actividad){

		$this->db->where('id_actividad',$id_actividad);
		$query = $this->db->get('cronogramas');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	$nombre_actividad = $row[0]['nombre_actividad'];

        	return $nombre_actividad;
		}
		else{
			return false;
		}

	}


	//Esta funcion me permite verificar si los estudiantes matriculados tienen asignaturas pendientes por calificaciones en un periodo determinado.
	public function Verificar_NotasEstudiantesMatriculados($id_actividad){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$periodo = $this->configuraciones_model->obtener_nombre_periodo($id_actividad);

		//array sencillo para almacenar los estudiantes pendientes por calificaciones
		$estudiantes_pendientes = array();

		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->where('estado_matricula',"Activo");
		$query = $this->db->get('matriculas');

		$estudiantes = $query->result_array();
		
		for ($i=0; $i < count($estudiantes); $i++) {

			$id_estudiante = $estudiantes[$i]['id_estudiante'];

			$asignaturas_sinnotas=$this->configuraciones_model->Verificar_NotasEstudiante($id_estudiante,$periodo,$ano_lectivo);

			if (count($asignaturas_sinnotas) > 0) {

				$estudiantes_pendientes[] = $id_estudiante;
			}
			
		}

		if (count($estudiantes_pendientes) > 0) {

			return false;
		}
		else{

			return true;
		}	

	}


	//Esta funcion permite verificar si un estudiante tienes asignaturas pendientes por notas
	public function Verificar_NotasEstudiante($id_estudiante,$periodo,$ano_lectivo){

		//array sencillo para las asignaturas sin notas de un estudiante
		$asignaturas_sinnotas = array();

		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.ano_lectivo',$ano_lectivo);

		$this->db->select('notas.id_estudiante,notas.id_asignatura,notas.p1,notas.p2,notas.p3,notas.p4');

		$query = $this->db->get('notas');

		$NotasAsignaturas = $query->result_array();
		
		for ($i=0; $i < count($NotasAsignaturas); $i++) {

			if ($periodo == "Primero") {

				if ($NotasAsignaturas[$i]['p1'] == NULL) {
					$asignaturas_sinnotas[] = $NotasAsignaturas[$i]['p1'];
				}
			}
			if ($periodo == "Segundo") {

				if ($NotasAsignaturas[$i]['p2'] == NULL) {
					$asignaturas_sinnotas[] = $NotasAsignaturas[$i]['p2'];
				}
			}
			if ($periodo == "Tercero") {

				if ($NotasAsignaturas[$i]['p3'] == NULL) {
					$asignaturas_sinnotas[] = $NotasAsignaturas[$i]['p3'];
				}
			}
			if ($periodo == "Cuarto") {

				if ($NotasAsignaturas[$i]['p4'] == NULL) {
					$asignaturas_sinnotas[] = $NotasAsignaturas[$i]['p4'];
				}
			}

		}

		return $asignaturas_sinnotas;

	}


	//verificar si existen estudiantes matriculados en un respectivo año lectivo
	public function Verificar_Existencia_Estudiantes_Matriculados(){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return true;
		}
		else{
			return false;
		}

	}



	//Esta funcion me permite verificar si los estudiantes matriculados tienen asignaturas pendientes por asignacion de logros en un periodo determinado.
	public function Verificar_LogrosEstudiantesMatriculados($id_actividad){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$periodo = $this->configuraciones_model->obtener_nombre_periodo($id_actividad);

		//array sencillo para almacenar los estudiantes pendientes por asignacion de logros
		$estudiantes_pendientes = array();

		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->where('estado_matricula',"Activo");
		$query = $this->db->get('matriculas');

		$estudiantes = $query->result_array();
		
		for ($i=0; $i < count($estudiantes); $i++) {

			$id_estudiante = $estudiantes[$i]['id_estudiante'];

			$asignaturas_sinlogros=$this->configuraciones_model->Verificar_LogrosEstudiante($id_estudiante,$periodo,$ano_lectivo);

			if (count($asignaturas_sinlogros) > 0) {

				$estudiantes_pendientes[] = $id_estudiante;
			}
			
		}

		if (count($estudiantes_pendientes) > 0) {

			return false;
		}
		else{

			return true;
		}	

	}


	//Esta funcion permite verificar si un estudiante tienes asignaturas pendientes por asignacion de logros
	public function Verificar_LogrosEstudiante($id_estudiante,$periodo,$ano_lectivo){

		//array sencillo para las asignaturas sin logros de un estudiante
		$asignaturas_sinlogros = array();

		$this->db->where('logros_asignados.id_estudiante',$id_estudiante);
		$this->db->where('logros_asignados.periodo',$periodo);
		$this->db->where('logros_asignados.ano_lectivo',$ano_lectivo);

		$this->db->select('logros_asignados.id_estudiante,logros_asignados.id_asignatura,logros_asignados.id_logro1,logros_asignados.id_logro2,logros_asignados.id_logro3,logros_asignados.id_logro4');

		$query = $this->db->get('logros_asignados');

		$LogrosAsignaturas = $query->result_array();

		if (count($LogrosAsignaturas) > 0) {

			$total_asignaturas = $this->configuraciones_model->Total_AsignaturasMatriculadas($id_estudiante,$ano_lectivo);

			if (count($LogrosAsignaturas) == $total_asignaturas) {
				
				for ($i=0; $i < count($LogrosAsignaturas); $i++) {

					if ($LogrosAsignaturas[$i]['id_logro1'] == NULL) {
						$asignaturas_sinlogros[] = $LogrosAsignaturas[$i]['id_logro1'];
					}

				}

				return $asignaturas_sinlogros;
			}
			else{

				$asignaturas_sinlogros[] = 1;

				return $asignaturas_sinlogros;

			}
		}
		else{

			$asignaturas_sinlogros[] = 1;

			return $asignaturas_sinlogros;
		}

	}


	//esta funcion permite obtener el total de asignaturas matriculadas por estudiante.
	public function Total_AsignaturasMatriculadas($id_estudiante,$ano_lectivo){

		$this->db->where('notas.id_estudiante',$id_estudiante);
		$this->db->where('notas.ano_lectivo',$ano_lectivo);

		$this->db->select('notas.id_estudiante,notas.id_asignatura,notas.p1,notas.p2,notas.p3,notas.p4');

		$query = $this->db->get('notas');
		$total_asignaturas = count($query->result_array());
	
		return $total_asignaturas;

	}


	//**************************** FUNCIONES AÑO LECTIVO ****************************************

	public function validar_existencia_anolectivo($nombre_ano_lectivo){

		$this->db->where('nombre_ano_lectivo',$nombre_ano_lectivo);
		$query = $this->db->get('anos_lectivos');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function obtener_ultimo_idanolectivo(){

		$this->db->select_max('id_ano_lectivo');
		$query = $this->db->get('anos_lectivos');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_ano_lectivo'];
        return $data['query'];
	}


	public function insertar_anolectivo($anolectivo){
		if ($this->db->insert('anos_lectivos', $anolectivo)) 
			return true;
		else
			return false;
	}


	public function buscar_anolectivo($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('nombre_ano_lectivo',$id,'after');
		$this->db->or_like('fecha_inicio',$id,'after');
		$this->db->or_like('fecha_fin',$id,'after');
		$this->db->or_like('estado_ano_lectivo',$id,'after');
		$this->db->or_like('seleccionado',$id,'after');

		$this->db->order_by('nombre_ano_lectivo', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->select('id_ano_lectivo,nombre_ano_lectivo,fecha_inicio,fecha_fin,estado_ano_lectivo,seleccionado');
		
		$query = $this->db->get('anos_lectivos');

		return $query->result();
		
	}


	public function llenar_anolectivo(){

		$this->db->select_max('nombre_ano_lectivo');
		$query = $this->db->get('anos_lectivos');

		$row = $query->result_array();
		$nuevo_anolectivo = 1 + $row[0]['nombre_ano_lectivo'];

		//Utilizo un array para enviar el nuevo anolectivo en forma de result() o result_array()
		$array_anolectivo[] = array('nombre_ano_lectivo' => $nuevo_anolectivo);

		return $array_anolectivo;
	}


	public function modificar_anolectivo($id_ano_lectivo,$anolectivo){

		$this->db->where('id_ano_lectivo',$id_ano_lectivo);

		if ($this->db->update('anos_lectivos', $anolectivo))

			return true;
		else
			return false;
	}


	public function seleccionar_anolectivo($id_ano_lectivo){

		$seleccionado = array('seleccionado' => "Si");
		$noseleccionado = array('seleccionado' => "No");

		$this->db->trans_start();
		$this->db->where('seleccionado',"Si");
		$this->db->update('anos_lectivos', $noseleccionado);

		$this->db->where('id_ano_lectivo',$id_ano_lectivo);
		$this->db->update('anos_lectivos', $seleccionado);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}

    }


    //Esta Funcion me permite obtener el numero total de anoslectivos con estado activo
    public function anoslectivosActivos(){

    	$this->db->where('estado_ano_lectivo',"Activo");
		$query = $this->db->get('anos_lectivos');

		if ($query->num_rows() > 0) {
			return count($query->result());
		}
		else{
			return false;
		}

	}


	// Esta Funcion me permite obtener el estado de un anolectivo
	public function estado_anolectivo($id_ano_lectivo){

		$this->db->where('id_ano_lectivo',$id_ano_lectivo);
		$query = $this->db->get('anos_lectivos');

		if ($query->num_rows() > 0) {

			$row = $query->result_array();
			$estado = $row[0]['estado_ano_lectivo'];

			return $estado;
		}
		else{
			return false;
		}

	}


	public function CrearDesempeños($ano_lectivo){

		//NUEVA TRANSACCION
		$this->db->trans_start();

			//array para insertar en la tabla desempeños
        	$desempeño1 = array(
			'nombre_desempeno'	=> "Superior",
			'rango_inicial'     => "4.6",
			'rango_final'       => "5.0",
			'ano_lectivo' 		=> $ano_lectivo);

			$desempeño2 = array(
			'nombre_desempeno'	=> "Alto",
			'rango_inicial'     => "4.0",
			'rango_final'       => "4.5",
			'ano_lectivo' 		=> $ano_lectivo);

			$desempeño3 = array(
			'nombre_desempeno'	=> "Básico",
			'rango_inicial'     => "3.0",
			'rango_final'       => "3.9",
			'ano_lectivo' 		=> $ano_lectivo);

			$desempeño4 = array(
			'nombre_desempeno'	=> "Bajo",
			'rango_inicial'     => "0.0",
			'rango_final'       => "2.9",
			'ano_lectivo' 		=> $ano_lectivo);

			$this->db->insert('desempenos', $desempeño1);
			$this->db->insert('desempenos', $desempeño2);
			$this->db->insert('desempenos', $desempeño3);
			$this->db->insert('desempenos', $desempeño4);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}

	}


    public function cerrar_anolectivo($id_ano_lectivo){

    	$cerrado = array('estado_ano_lectivo' => "Cerrado");

		$this->db->where('id_ano_lectivo',$id_ano_lectivo);

		if ($this->db->update('anos_lectivos', $cerrado))

			return true;
		else
			return false;
	}


	public function Validar_SituacionAcademica($id_ano_lectivo){

		$this->db->where('ano_lectivo',$id_ano_lectivo);
		$this->db->where('estado_matricula',"Activo");
		$this->db->where('situacion_academica',"No Definida");

		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {

			return false;
		}
		else{
			return true;
		}

	}


	//**************************** FUNCIONES ESCALA DE DESEMPEÑO ****************************************


	public function buscar_desempeno($id,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('desempenos.ano_lectivo',$ano_lectivo);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->select('desempenos.id_desempeno,desempenos.nombre_desempeno,desempenos.rango_inicial,desempenos.rango_final');
		
		$query = $this->db->get('desempenos');

		return $query->result();
		
	}


	public function modificar_desempeno($id_desempeno,$desempeno){

		$this->db->where('id_desempeno',$id_desempeno);

		if ($this->db->update('desempenos', $desempeno))

			return true;
		else
			return false;
	}


	//Permite validar si existen notas registradas en la tabla notas
	public function validar_existencia_notas($ano_lectivo){

		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->where('nota_final IS NOT NULL');

		$query = $this->db->get('notas');

		if ($query->num_rows() > 0) {

			return false;
		}
		else{

			return true;
		}

	}


	//Permite validar si existen notas registradas en la tabla notas_actividades
	public function validar_existencia_notas_actividades($ano_lectivo){

		$this->db->where('actividades.ano_lectivo',$ano_lectivo);
		$this->db->where('notas_actividades.nota IS NOT NULL');

		$this->db->join('notas_actividades', 'actividades.id_actividad = notas_actividades.id_actividad');

		$query = $this->db->get('actividades');

		if ($query->num_rows() > 0) {

			return false;
		}
		else{

			return true;
		}

	}

}