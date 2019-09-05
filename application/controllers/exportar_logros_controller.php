<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exportar_logros_controller extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('exportar_logros_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
	}


	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'exportar_logros/exportar_logros_vista');
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
        	$period = $this->exportar_logros_model->convertir_periodo($periodo);
        	$jornada = $this->input->post('jornada');
			$id_curso = $this->input->post('id_curso');
			$id_grado = $this->exportar_logros_model->obtener_gradoPorcurso($id_curso);
			$id_asignatura = $this->input->post('id_asignatura');
			$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

			$curs = $this->exportar_logros_model->obtener_informacion_curso($id_curso);
			$nombre_curso = $curs[0]['nombre_grado'].'-'.$curs[0]['nombre_grupo'];
			$ano_lectivo = $curs[0]['ano_lectivo'];

			$estudiantes = $this->exportar_logros_model->EstudiantesMatriculadosPorCurso($id_curso);
			$total_estudiantes = count($estudiantes);

			$asignatura = $this->exportar_logros_model->obtener_informacion_asignatura($id_asignatura);
			$nombre_asignatura = $asignatura[0]['nombre_asignatura'];

			$nombre_archivo = "PlanillaDeLogros_".$nombre_curso."_".$jornada."_".$nombre_asignatura."_".$periodo.".xlsx";

			//calculamos la ultima fila
			$fila = $total_estudiantes + 1;
			

			//Cargamos la librería de excel.
			$this->load->library('excel');

			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Planilla De Logros');

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
	        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
	        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
	        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
	        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);

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
	        $this->excel->getActiveSheet()->getStyle("I{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("J{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("K{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("L{$contador}")->getFont()->setBold(true);


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
	        $this->excel->getActiveSheet()->getStyle("I1:I{$fila}")->applyFromArray($centrar1);
	        $this->excel->getActiveSheet()->getStyle("J1:J{$fila}")->applyFromArray($centrar1);
	        $this->excel->getActiveSheet()->getStyle("K1:K{$fila}")->applyFromArray($centrar1);
	        $this->excel->getActiveSheet()->getStyle("L1:L{$fila}")->applyFromArray($centrar1);

	        //le aplicamos borde a la cabecera y filas.
	        $this->excel->getActiveSheet()->getStyle("A1:L{$fila}")->applyFromArray($borde);

	        //le aplicamos color a la cabecera.
	        $this->excel->getActiveSheet()->getStyle("A1:L1")->applyFromArray($color);

	        //Definimos los títulos de la cabecera.
	        $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'id_curso');
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'curso');
	        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'id_estudiante');
	        $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'estudiante');
	        $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'id_asignatura');
	        $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'asignatura');
	        $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'periodo');
	        $this->excel->getActiveSheet()->setCellValue("H{$contador}", 'nota');
	        $this->excel->getActiveSheet()->setCellValue("I{$contador}", 'id_logro1');
	        $this->excel->getActiveSheet()->setCellValue("J{$contador}", 'id_logro2');
	        $this->excel->getActiveSheet()->setCellValue("K{$contador}", 'id_logro3');
	        $this->excel->getActiveSheet()->setCellValue("L{$contador}", 'id_logro4');

	        //Definimos la informacion a mostrar.

	        for ($i=0; $i < $total_estudiantes; $i++) { 
	        	
	        	//Incrementamos una fila más, para ir a la siguiente.
           		$contador++;

           		$id_estudiante = $estudiantes[$i]['id_estudiante'];
	        	$nombre_estudiante = $estudiantes[$i]['apellido1']." ".$estudiantes[$i]['apellido2']." ".$estudiantes[$i]['nombres'];
	        	$nota = $this->exportar_logros_model->obtener_NotaPorAsignatura($ano_lectivo,$id_estudiante,$id_grado,$id_asignatura,$period);

	        	//Informacion de las filas.
	        	$this->excel->getActiveSheet()->setCellValue("A{$contador}", $id_curso);
	        	$this->excel->getActiveSheet()->setCellValue("B{$contador}", $nombre_curso.' '.$jornada);
	        	$this->excel->getActiveSheet()->setCellValue("C{$contador}", $id_estudiante);
	        	$this->excel->getActiveSheet()->setCellValue("D{$contador}", $nombre_estudiante);
	        	$this->excel->getActiveSheet()->setCellValue("E{$contador}", $id_asignatura);
	        	$this->excel->getActiveSheet()->setCellValue("F{$contador}", $nombre_asignatura);
	        	$this->excel->getActiveSheet()->setCellValue("G{$contador}", $periodo);
	        	$this->excel->getActiveSheet()->setCellValue("H{$contador}", $nota);
	        	$this->excel->getActiveSheet()->setCellValue("I{$contador}", "");
	        	$this->excel->getActiveSheet()->setCellValue("J{$contador}", "");
	        	$this->excel->getActiveSheet()->setCellValue("K{$contador}", "");
	        	$this->excel->getActiveSheet()->setCellValue("L{$contador}", "");

	        }
	        

	        //le aplicamos proteccion a la hoja de excel.
			$this->excel->getActiveSheet()->getProtection()->setPassword('siescolar12345');
			$this->excel->getActiveSheet()->getProtection()->setSheet(true);
			$this->excel->getActiveSheet()->getProtection()->setSort(true);
			$this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
			$this->excel->getActiveSheet()->getProtection()->setFormatCells(true);

			//le quitamos la proteccion a un rango de celdas(columna id_logro1,id_logro2,id_logro3,id_logro4).
			$this->excel->getActiveSheet()->getStyle("I2:L{$fila}")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);


			//AGREGAMOS NUEVA HOJA DE EXCEL

			$logros = $this->exportar_logros_model->obtener_logros($periodo,$id_curso,$id_grado,$id_asignatura,$ano_lectivo);
			$total_logros = count($logros);

			//calculamos la ultima fila
			$fila2 = $total_logros + 1;

			$hoja2 = $this->excel->createSheet();
			$hoja2->setTitle('Lista De Logros');

			//Contador de filas
        	$contador2 = 1;

        	//Le aplicamos ancho a las columnas.
	        $hoja2->getColumnDimension('A')->setWidth(15);
	        $hoja2->getColumnDimension('B')->setWidth(80);

	        //Le aplicamos altura a la fila de la cabecera.
	        $hoja2->getRowDimension('1')->setRowHeight(30);

	        //Le aplicamos negrita a los títulos de la cabecera.
	        $hoja2->getStyle("A{$contador2}")->getFont()->setBold(true);
	        $hoja2->getStyle("B{$contador2}")->getFont()->setBold(true);


	        //Estilos
	        $centrar3 = array(
	        	'alignment' => array(
	        		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	    			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
	    		)
	        );

	        $centrar4 = array(
	        	'alignment' => array(
	    			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
	    		)
	        );

	        $borde2 = array(
	        	'borders' => array(
	    			'allborders'   => array(
	    				'style' => PHPExcel_Style_Border::BORDER_THIN, 
	    			)
	    		)
	        );

	        $color2 = array(
	        	'fill' => array(
	        		'type' => PHPExcel_Style_Fill::FILL_SOLID,
	    			'color' => array('rgb' => 'a9d08e')
	    		)
	        );


	        //le aplicamos centrado vertical y horizontal a las columnas.
	        $hoja2->getStyle("A1:A{$fila2}")->applyFromArray($centrar3);
	        $hoja2->getStyle("B1")->applyFromArray($centrar3);

	        //le aplicamos borde a la cabecera y filas.
	        $hoja2->getStyle("A1:B{$fila2}")->applyFromArray($borde2);

	        //le aplicamos color a la cabecera.
	        $hoja2->getStyle("A1:B1")->applyFromArray($color2);

	        //le aplicamos autoajuste de texto a las filas
	        $hoja2->getStyle("A2:B{$fila2}")->getAlignment()->setWrapText(true);

	        //Definimos los títulos de la cabecera.
	        $hoja2->setCellValue("A{$contador2}", 'id_logro');
	        $hoja2->setCellValue("B{$contador2}", 'logro');

	        //Definimos la informacion a mostrar.

	        for ($i=0; $i < $total_logros; $i++) { 
	        	
	        	//Incrementamos una fila más, para ir a la siguiente.
           		$contador2++;

           		$id_logro = $logros[$i]['id_logro'];
	        	$descripcion_logro = $logros[$i]['descripcion_logro'];

	        	//Informacion de las filas.
	        	$hoja2->setCellValue("A{$contador2}", $id_logro);
	        	$hoja2->setCellValue("B{$contador2}", $descripcion_logro);

	        }


	        //creamos un rango de celdas con el nombre logros
			$this->excel->addNamedRange( 
		        new PHPExcel_NamedRange(
		            'logros', 
		            $this->excel->getSheetByName('Lista De Logros'), 
		            'A2:A'.$fila2
		        ) 
		    );

		    //le aplicamos proteccion a la hoja de excel.
			$hoja2->getProtection()->setPassword('siescolar12345');
			$hoja2->getProtection()->setSheet(true);
			$hoja2->getProtection()->setSort(true);
			$hoja2->getProtection()->setInsertRows(true);
			$hoja2->getProtection()->setFormatCells(true);


			//AGREGAMOS VALIDACIONES A LA HOJA 1

			$this->excel->setActiveSheetIndex(0);  //marcar como activa la hoja 1

			//cargamos la lista desplegable
			$validacion = $this->excel->getActiveSheet()->getCell('I2')->getDataValidation();
		    $validacion->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		    $validacion->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_STOP );
		    $validacion->setAllowBlank(false);
		    $validacion->setShowInputMessage(true);
		    $validacion->setShowErrorMessage(true);
		    $validacion->setShowDropDown(true);
		    $validacion->setErrorTitle('Error');
		    $validacion->setError('El código de logro ingresado es incorrecto.');
		    $validacion->setPromptTitle('Código de Logro');
		    $validacion->setPrompt('Seleccione un código de logro de la lista.');
		    $validacion->setFormula1('=logros');

		    //clonamos la regla de validacion a otras celdas
		    for ($i=2; $i <= $fila; $i++) { 
		    	$this->excel->getActiveSheet()->getCell('I'.$i)->setDataValidation(clone $validacion);
		    	$this->excel->getActiveSheet()->getCell('J'.$i)->setDataValidation(clone $validacion);
		    	$this->excel->getActiveSheet()->getCell('K'.$i)->setDataValidation(clone $validacion);
		    	$this->excel->getActiveSheet()->getCell('L'.$i)->setDataValidation(clone $validacion);
		    }


	        //header('Content-Type: application/vnd.ms-excel');
	        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	        header('Content-Disposition: attachment;filename="'.$nombre_archivo.'"');
	        header('Cache-Control: max-age=0');

	        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');

        	//Hacemos una salida al navegador con el archivo Excel.
        	$objWriter->save('php://output');

        }

	}


	public function llenarcombo_cursos(){

    	$jornada = $this->input->post('jornada');

    	$consulta = $this->exportar_logros_model->llenar_cursos($jornada);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas(){

    	$id_curso =$this->input->post('id_curso');
    	$id_grado = $this->exportar_logros_model->obtener_gradoPorcurso($id_curso);

    	$consulta = $this->exportar_logros_model->llenar_asignaturas($id_grado);
    	echo json_encode($consulta);
    }


}