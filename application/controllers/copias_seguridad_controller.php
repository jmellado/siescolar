<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Copias_seguridad_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database('default');
		$this->load->dbutil();
	}


	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'copias_seguridad/copias_seguridad_vista');
	}


	public function generar(){

    	//$db_name = $this->db->database;

    	date_default_timezone_set('America/Bogota');
    	$fecha = date("Y-m-d-H-i-s");
    	$filename = 'bd_siescolar_'.$fecha.'.sql';
    	$zipname = 'backupsiescolar_'.$fecha.'.zip';

    	$tables = array('administradores', 'anos_lectivos', 'areas', 'asignaturas', 'asistencias', 'datos_institucion', 'documentos', 'historial_estados', 'horarios', 'notificaciones', 'personas', 'roles', 'usuarios', 'estudiantes', 'padres', 'madres', 'estudiantes_padres', 'profesores', 'acudientes', 'estudiantes_acudientes', 'niveles_educacion', 'grados_educacion', 'grados', 'grupos', 'salones', 'cursos', 'matriculas', 'pensum', 'cargas_academicas', 'desempenos', 'notas', 'nivelaciones', 'nivelaciones_finales', 'retiros', 'reingresos', 'logros', 'logros_asignados', 'actividades', 'notas_actividades', 'tipos_causales', 'causales', 'acciones_pedagogicas', 'seguimientos_disciplinarios', 'elecciones', 'candidatos_eleccion', 'listado_votantes', 'categorias', 'cronogramas', 'paises', 'departamentos', 'municipios', 'conceptos_pagos', 'pagos', 'criterios', 'criterios_asignados', 'promocion');

    	//$this->load->dbutil();

    	$prefs = array(
    				'tables' => $tables,
    				'format' => 'zip',
    				'filename' => $filename,
    				'add_drop' => FALSE
    			);

    	$backup =& $this->dbutil->backup($prefs);

    	//$this->load->helper('file');
		//write_file('./uploads/documentos/'.$zipname, $backup);

		$this->load->helper('download');
		force_download($zipname, $backup);

    }

}