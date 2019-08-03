<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exportar_notas_controller extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('exportar_notas_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
		//$this->load->library('excel');
	}


	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'exportar_notas/exportar_notas_vista');
	}


	public function exportar(){

		$this->form_validation->set_rules('jornada', 'Jornada', 'required|max_length[30]');
		$this->form_validation->set_rules('id_curso', 'Curso', 'required|numeric');
        $this->form_validation->set_rules('id_asignatura', 'Asignatura', 'required|numeric');
        $this->form_validation->set_rules('periodo', 'Periodo', 'required|max_length[8]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$periodo = $this->input->post('periodo');
        	$jornada = $this->input->post('jornada');
			$id_curso = $this->input->post('id_curso');
			$id_asignatura = $this->input->post('id_asignatura');
			$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

			$curs = $this->exportar_notas_model->obtener_informacion_curso($id_curso);
			$nombre_curso = $curs[0]['nombre_grado'].'-'.$curs[0]['nombre_grupo'];
			$ano_lectivo = $curs[0]['ano_lectivo'];

			$estudiantes = $this->exportar_notas_model->EstudiantesMatriculadosPorCurso($id_curso);
			$total_estudiantes = count($estudiantes);

			$asignatura = $this->exportar_notas_model->obtener_informacion_asignatura($id_asignatura);
			$nombre_asignatura = $asignatura[0]['nombre_asignatura'];

			$nombre_archivo = "PlanillaDeNotas_".$nombre_curso."_".$jornada."_".$nombre_asignatura."_".$periodo.".xls";

			//calculamos la ultima fila
			$fila = $total_estudiantes + 1;
			

			//Cargamos la librería de excel.
			$this->load->library('excel');

			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Planilla De Notas');

			//Contador de filas
        	$contador = 1;

        	//Le aplicamos ancho a las columnas.
	        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
	        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
	        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
	        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
	        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
	        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
	        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);

	        //Le aplicamos altura a la fila de la cabecera.
	        $this->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

	        //Le aplicamos negrita a los títulos de la cabecera.
	        $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("D{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("E{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("F{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("G{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("H{$contador}")->getFont()->setBold(true);


	        //Estilos
	        $centrar1 = array(
	        	'alignment' => array(
	        		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	    			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
	    		)
	        );

	        $centrar2 = array(
	        	'alignment' => array(
	    			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
	    		)
	        );

	        $borde = array(
	        	'borders' => array(
	    			'allborders'   => array(
	    				'style' => PHPExcel_Style_Border::BORDER_THIN, 
	    			)
	    		)
	        );

	        $color = array(
	        	'fill' => array(
	        		'type' => PHPExcel_Style_Fill::FILL_SOLID,
	    			'color' => array('rgb' => 'a9d08e')
	    		)
	        );


	        //le aplicamos centrado vertical y horizontal a las columnas.
	        $this->excel->getActiveSheet()->getStyle("A1:A{$fila}")->applyFromArray($centrar1);
	        $this->excel->getActiveSheet()->getStyle("B1:B{$fila}")->applyFromArray($centrar1);
	        $this->excel->getActiveSheet()->getStyle("C1:C{$fila}")->applyFromArray($centrar1);
	        $this->excel->getActiveSheet()->getStyle("D1")->applyFromArray($centrar2);
	        $this->excel->getActiveSheet()->getStyle("E1:E{$fila}")->applyFromArray($centrar1);
	        $this->excel->getActiveSheet()->getStyle("F1")->applyFromArray($centrar2);
	        $this->excel->getActiveSheet()->getStyle("G1:G{$fila}")->applyFromArray($centrar1);
	        $this->excel->getActiveSheet()->getStyle("H1:H{$fila}")->applyFromArray($centrar1);

	        //le aplicamos borde a la cabecera y filas.
	        $this->excel->getActiveSheet()->getStyle("A1:H{$fila}")->applyFromArray($borde);

	        //le aplicamos color a la cabecera.
	        $this->excel->getActiveSheet()->getStyle("A1:H1")->applyFromArray($color);

	        //Definimos los títulos de la cabecera.
	        $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'id_curso');
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'curso');
	        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'id_estudiante');
	        $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'estudiante');
	        $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'id_asignatura');
	        $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'asignatura');
	        $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'periodo');
	        $this->excel->getActiveSheet()->setCellValue("H{$contador}", 'nota');

	        //Definimos la informacion a mostrar.

	        for ($i=0; $i < $total_estudiantes; $i++) { 
	        	
	        	//Incrementamos una fila más, para ir a la siguiente.
           		$contador++;

           		$id_estudiante = $estudiantes[$i]['id_estudiante'];
	        	$nombre_estudiante = $estudiantes[$i]['apellido1']." ".$estudiantes[$i]['apellido2']." ".$estudiantes[$i]['nombres'];

	        	//Informacion de las filas.
	        	$this->excel->getActiveSheet()->setCellValue("A{$contador}", $id_curso);
	        	$this->excel->getActiveSheet()->setCellValue("B{$contador}", $nombre_curso.' '.$jornada);
	        	$this->excel->getActiveSheet()->setCellValue("C{$contador}", $id_estudiante);
	        	$this->excel->getActiveSheet()->setCellValue("D{$contador}", $nombre_estudiante);
	        	$this->excel->getActiveSheet()->setCellValue("E{$contador}", $id_asignatura);
	        	$this->excel->getActiveSheet()->setCellValue("F{$contador}", $nombre_asignatura);
	        	$this->excel->getActiveSheet()->setCellValue("G{$contador}", $periodo);
	        	$this->excel->getActiveSheet()->setCellValue("H{$contador}", "");

	        }
	        

	        //le aplicamos proteccion a la hoja de excel.
			$this->excel->getActiveSheet()->getProtection()->setPassword('siescolar12345');
			$this->excel->getActiveSheet()->getProtection()->setSheet(true);
			$this->excel->getActiveSheet()->getProtection()->setSort(true);
			$this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
			$this->excel->getActiveSheet()->getProtection()->setFormatCells(true);

			//le quitamos la proteccion a un rango de celdas(columna nota).
			$this->excel->getActiveSheet()->getStyle("H2:H{$fila}")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

	        header('Content-Type: application/vnd.ms-excel');
	        header('Content-Disposition: attachment;filename="'.$nombre_archivo.'"');
	        header('Cache-Control: max-age=0');

	        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        	//Hacemos una salida al navegador con el archivo Excel.
        	$objWriter->save('php://output');

        }

	}


	public function llenarcombo_cursos(){

    	$jornada = $this->input->post('jornada');

    	$consulta = $this->exportar_notas_model->llenar_cursos($jornada);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas(){

    	$id_curso =$this->input->post('id_curso');
    	$id_grado = $this->exportar_notas_model->obtener_gradoPorcurso($id_curso);

    	$consulta = $this->exportar_notas_model->llenar_asignaturas($id_grado);
    	echo json_encode($consulta);
    }


}