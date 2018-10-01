<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elecciones_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('elecciones_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
		$this->load->library('Pdf');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'elecciones/elecciones_vista');
	}


	public function candidatos()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'elecciones/candidatos_vista');
	}


	public function votantes()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'elecciones/votantes_vista');
	}


	public function insertar_eleccion(){

        $this->form_validation->set_rules('nombre_eleccion', 'Nombre', 'required|alpha_spaces');
        $this->form_validation->set_rules('descripcion_eleccion', 'Descripcion', 'required|alpha_spaces');
        $this->form_validation->set_rules('fecha_inicio', 'Fecha De Inicio', 'required');
        $this->form_validation->set_rules('hora_inicio', 'Hora De Inicio', 'required');
        $this->form_validation->set_rules('fecha_fin', 'Fecha Final', 'required');
        $this->form_validation->set_rules('hora_fin', 'Hora Final', 'required');
        $this->form_validation->set_rules('estado_eleccion', 'Estado', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de elecciones + 1 
        	$id_eleccion = $this->elecciones_model->obtener_ultimo_id();

        	$nombre_eleccion = ucwords(strtolower($this->input->post('nombre_eleccion')));
        	$descripcion = ucwords(strtolower($this->input->post('descripcion_eleccion')));
        	$fecha_inicio = $this->input->post('fecha_inicio');
        	$hora_inicio = $this->input->post('hora_inicio');
        	$fecha_fin = $this->input->post('fecha_fin');
        	$hora_fin = $this->input->post('hora_fin');
        	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
        	$estado_eleccion = $this->input->post('estado_eleccion');


        	//array para insertar en la tabla elecciones
        	$eleccion = array(
        	'id_eleccion' =>$id_eleccion,	
			'nombre_eleccion' =>$nombre_eleccion,
			'descripcion' =>$descripcion,
			'fecha_inicio' =>$fecha_inicio,
			'hora_inicio' =>$hora_inicio,
			'fecha_fin' =>$fecha_fin,
			'hora_fin' =>$hora_fin,
			'ano_lectivo' =>$ano_lectivo,
			'estado_eleccion' =>$estado_eleccion);

			$id_candidato_eleccion = $this->elecciones_model->obtener_ultimo_id_candidato_eleccion();

			//array para insertar el candidato voto en blanco en la tabla candidatos eleccion
        	$candidato_voto_blanco = array(
        	'id_candidato_eleccion' => $id_candidato_eleccion,
        	'id_eleccion' =>$id_eleccion,	
			'id_estudiante' =>"7",
			'numero' =>"00",
			'partido' =>"En Blanco",
			'estado_candidato' =>"Activo");

			if ($this->elecciones_model->validar_existencia($nombre_eleccion,$ano_lectivo)){

				$respuesta=$this->elecciones_model->insertar_eleccion($eleccion,$candidato_voto_blanco);

				if($respuesta==true){

					echo "registroguardado";

					if(!copy("./uploads/imagenes/elecciones/voto_blanco.png","./uploads/imagenes/elecciones/candidatos/".$id_candidato_eleccion.".jpg")){
						echo "Error Al Copiar La Imagen.";
					}
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "eleccionyaexiste";
			}


        }

    }


    public function mostrarelecciones(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'elecciones' => $this->elecciones_model->buscar_eleccion($id,$inicio,$cantidad),

		    'totalregistros' => count($this->elecciones_model->buscar_eleccion($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}



	public function eliminar_eleccion(){

	  	$id_eleccion =$this->input->post('id'); 

        if(is_numeric($id_eleccion)){

			if($this->elecciones_model->validar_eleccion_candidatos($id_eleccion)){

				if($this->elecciones_model->validar_eleccion_votantes($id_eleccion)){

			        $respuesta=$this->elecciones_model->eliminar_eleccion($id_eleccion);
			        
		          	if($respuesta==true){
		              
		              	echo "Elección Eliminada Correctamente.";
		          	}else{
		              
		              	echo "No Se Pudo Eliminar.";
		          	}
		        }
		        else{
		        	echo "No Se Puede Eliminar; Existen Votantes Registrados En Esta Elección.";
		        }
	        }
	        else{
	        	echo "No Se Puede Eliminar; Existen Candidatos Registrados En Esta Elección.";
	        }  	
          
        }else{
          
          	echo "digite valor numerico para identificar una eleccion";
        }
    }



    public function modificar_eleccion(){


    	$id_eleccion = $this->input->post('id_eleccion');
    	$nombre_eleccion = ucwords(strtolower($this->input->post('nombre_eleccion')));
    	$descripcion = ucwords(strtolower($this->input->post('descripcion_eleccion')));
    	$fecha_inicio = $this->input->post('fecha_inicio');
    	$hora_inicio = $this->input->post('hora_inicio');
    	$fecha_fin = $this->input->post('fecha_fin');
    	$hora_fin = $this->input->post('hora_fin');
    	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
    	$estado_eleccion = $this->input->post('estado_eleccion');

    	//array para modificar en la tabla elecciones
        $eleccion = array(
    	'id_eleccion' =>$id_eleccion,	
		'nombre_eleccion' =>$nombre_eleccion,
		'descripcion' =>$descripcion,
		'fecha_inicio' =>$fecha_inicio,
		'hora_inicio' =>$hora_inicio,
		'fecha_fin' =>$fecha_fin,
		'hora_fin' =>$hora_fin,
		'estado_eleccion' =>$estado_eleccion);

		$elecciones = $this->elecciones_model->obtener_informacion_eleccion($id_eleccion);
		$nombre_buscado = $elecciones[0]['nombre_eleccion'];
		
        if(is_numeric($id_eleccion)){

        	if ($nombre_buscado == $nombre_eleccion){

	        	$respuesta=$this->elecciones_model->modificar_eleccion($id_eleccion,$eleccion);

				 if($respuesta==true){

					echo "registroactualizado";

	             }else{

					echo "registronoactualizado";

	             }
	        }
	        else{

	        	if($this->elecciones_model->validar_existencia($nombre_eleccion,$ano_lectivo)){

	        		$respuesta=$this->elecciones_model->modificar_eleccion($id_eleccion,$eleccion);

	        		if($respuesta==true){

	        			echo "registroactualizado";

	        		}else{

	        			echo "registronoactualizado";
	        		}



	        	}else{

	        		echo "eleccionyaexiste";

	        	}

				
			}    
                
         
        }else{
            
            echo "digite valor numerico para identificar una eleccion";
        }




    }

    //****************************************************** FUNCIONES PARA CANDIDATOS ***************************************************

    public function insertar_candidato(){

        $this->form_validation->set_rules('id_eleccion', 'Eleccion', 'required');
        $this->form_validation->set_rules('id_candidato', 'Candidato', 'required');
        $this->form_validation->set_rules('partido', 'Partipo', 'required');
        $this->form_validation->set_rules('numero', 'Número Tarjetón', 'required|numeric');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$id_candidato_eleccion = $this->elecciones_model->obtener_ultimo_id_candidato_eleccion();
        	$id_eleccion = $this->input->post('id_eleccion');
        	$id_candidato = $this->input->post('id_candidato');
        	$partido = ucwords(strtolower($this->input->post('partido')));
        	$numero = $this->input->post('numero');
        	$foto_candidato = "foto_candidato";
        	$estado_candidato = "Activo";


        	//array para insertar en la tabla candidatos
        	$candidato = array(
        	'id_candidato_eleccion' => $id_candidato_eleccion,
        	'id_eleccion' =>$id_eleccion,	
			'id_estudiante' =>$id_candidato,
			'numero' =>$numero,
			'partido' =>$partido,
			'estado_candidato' =>$estado_candidato);
        	
			if ($this->elecciones_model->validar_existencia_candidato($id_candidato,$id_eleccion)){

				if ($this->elecciones_model->validar_existencia_numerocandidato($id_eleccion,$numero)){

					$respuesta=$this->elecciones_model->insertar_candidato($candidato);

					if($respuesta==true){

						echo "registroguardado";
						$respuesta=$this->elecciones_model->subir_foto_candidato($id_candidato_eleccion,$foto_candidato);
						echo $respuesta;

					}
					else{

						echo "registronoguardado";
					}
				}
				else{
					echo "numeroyaexiste";
				}

			}
			else{

				echo "candidatoyaexiste";
			}


        }

    }


    public function mostrarcandidatos(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'candidatos' => $this->elecciones_model->buscar_candidato($id,$inicio,$cantidad),

		    'totalregistros' => count($this->elecciones_model->buscar_candidato($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function eliminar_candidato(){

	  	$id_candidato_eleccion =$this->input->post('id');
	  	$id_eleccion =$this->input->post('id_eleccion');  

        if(is_numeric($id_candidato_eleccion)){

			if($this->elecciones_model->validar_votos_candidato($id_candidato_eleccion)){

				if($this->elecciones_model->validar_votos_eleccion($id_eleccion)){

			        $respuesta=$this->elecciones_model->eliminar_candidato($id_candidato_eleccion);
			        
		          	if($respuesta==true){
		              
		              	echo "Candidato Eliminado Correctamente.";

		              	if (!unlink("./uploads/imagenes/elecciones/candidatos/".$id_candidato_eleccion.".jpg")) {
		              		echo "Error Al Borrar La Imagen.";
		              	}

		          	}else{
		              
		              	echo "No Se Pudo Eliminar.";
		          	}
		        }
		        else{
		        	echo "No Se Puede Eliminar; Las Votaciones Para La Elección En La Cual El Candidato Es Aspirante Ya Iniciaron.";
		        }
	        }
	        else{
	        	echo "No Se Puede Eliminar; Existen Votos Registrados Para Este Candidato.";
	        }  	
          
        }else{
          
          	echo "digite valor numerico para identificar un candidao a elección";
        }
    }


	public function modificar_candidato(){


    	$id_candidato_eleccion = $this->input->post('id_candidato_eleccion');
    	$partido = ucwords(strtolower($this->input->post('partido')));
        $numero = $this->input->post('numero');
        $foto_candidato = "foto_candidato";

    	//array para modificar en la tabla candidatos
        $candidato = array(
        'numero' =>$numero,
    	'partido' =>$partido);

		$candidatos = $this->elecciones_model->obtener_informacion_candidato($id_candidato_eleccion);
		$numero_buscado = $candidatos[0]['numero'];
		$eleccion_buscada = $candidatos[0]['id_eleccion'];
		
        if(is_numeric($id_candidato_eleccion)){

        	if ($numero_buscado == $numero){

	        	$respuesta=$this->elecciones_model->modificar_candidato($id_candidato_eleccion,$candidato);

				 if($respuesta==true){

					echo "registroactualizado";

					if ($_FILES['foto_candidato']['name'] != ""){

						$respuesta=$this->elecciones_model->subir_foto_candidato($id_candidato_eleccion,$foto_candidato);
						echo $respuesta;
					}

	             }else{

					echo "registronoactualizado";

	             }
	        }
	        else{

	        	if ($this->elecciones_model->validar_existencia_numerocandidato($eleccion_buscada,$numero)){

	        		$respuesta=$this->elecciones_model->modificar_candidato($id_candidato_eleccion,$candidato);

	        		if($respuesta==true){

	        			echo "registroactualizado";

	        			if ($_FILES['foto_candidato']['name'] != ""){

							$respuesta=$this->elecciones_model->subir_foto_candidato($id_candidato_eleccion,$foto_candidato);
							echo $respuesta;
						}

	        		}else{

	        			echo "registronoactualizado";
	        		}


	        	}else{

	        		echo "numeroyaexiste";

	        	}

				
			}    
                
         
        }else{
            
            echo "digite valor numerico para identificar un candidato a eleccion";
        }

    }


    public function llenarcombo_elecciones(){

    	$consulta = $this->elecciones_model->llenar_elecciones();
    	echo json_encode($consulta);
    }


    public function mostrarestudiantes_matriculados(){

    	$id =$this->input->post('id_buscar'); 
    	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		
		$data = array(

			'estudiantes' => $this->elecciones_model->buscar_estudiantes_matriculados($id,$ano_lectivo)

		);
	    echo json_encode($data);


	}


	//****************************************************** FUNCIONES PARA VOTANTES ***************************************************

	public function insertar_votante(){

        $this->form_validation->set_rules('id_eleccion', 'Eleccion', 'required');
        $this->form_validation->set_rules('id_curso', 'Cursos', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$id_eleccion = $this->input->post('id_eleccion');
        	$cursos = $this->input->post('id_curso');

        	if($this->elecciones_model->validar_votos_eleccion($id_eleccion)){

	        	if ($cursos != "") {
	        		
	        		$respuesta=$this->elecciones_model->insertar_votante($id_eleccion,$cursos);

					if($respuesta==true){

						echo "registroguardado";
					}
					else{

						echo "registronoguardado";
					}
	        	}
	        	else{

	        		echo "nohaycursos";
	        	}

	        }
	        else{

	        	echo "registrodenegado";
	        }


        }

    }


    public function mostrarvotantes(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'votantes' => $this->elecciones_model->buscar_votante($id,$inicio,$cantidad),

		    'totalregistros' => count($this->elecciones_model->buscar_votante($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function eliminar_votante(){

	  	$id_eleccion =$this->input->post('id'); 

        if(is_numeric($id_eleccion)){

			if($this->elecciones_model->validar_votos_eleccion($id_eleccion)){

		        $respuesta=$this->elecciones_model->eliminar_votante($id_eleccion);
		        
	          	if($respuesta==true){
	              
	              	echo "Elección Eliminada Correctamente.";
	          	}else{
	              
	              	echo "No Se Pudo Eliminar.";
	          	}
	        }
	        else{
	        	echo "No Se Puede Eliminar; Existen Votos Registrados Para Esta Elección.";
	        }  	
          
        }else{
          
          	echo "digite valor numerico para identificar una elección";
        }
    }


    public function mostrarcursos_votantes(){

		$id = $this->input->post('id_buscar'); 
		
		$data = array(

			'votantes' => $this->elecciones_model->buscar_curso_votante($id)

		);
	    echo json_encode($data);

	}


	public function eliminarcurso_votante(){

	  	$id_eleccion =$this->input->post('id');
	  	$id_curso =$this->input->post('id_curso');

        if(is_numeric($id_eleccion)){

			if($this->elecciones_model->validar_votos_eleccion($id_eleccion)){

		        $respuesta=$this->elecciones_model->eliminarcurso_votante($id_eleccion,$id_curso);
		        
	          	if($respuesta==true){
	              
	              	echo "Curso Votante Eliminado Correctamente.";
	          	}else{
	              
	              	echo "No Se Pudo Eliminar.";
	          	}
	        }
	        else{
	        	echo "No Se Puede Eliminar; Existen Votos Registrados Para Esta Elección.";
	        }  	
          
        }else{
          
          	echo "digite valor numerico para identificar una elección";
        }
    }


	public function llenarcombo_cursos(){

    	$consulta = $this->elecciones_model->llenar_cursos();
    	echo json_encode($consulta);
    }


    public function generar_listadovotantes(){

    	if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$id_eleccion = $this->input->get('id_eleccion');

		if(!$this->elecciones_model->validar_eleccion_votantes($id_eleccion)){

			$elecciones = $this->elecciones_model->obtener_informacion_eleccion($id_eleccion);
			$nombre_eleccion = $elecciones[0]['nombre_eleccion'];

			$col = $this->elecciones_model->datos_institucion();
			$nombre_institucion = $col[0]['nombre_institucion'];
			$niveles_educacion = $col[0]['niveles_educacion'];
			$resolucion = $col[0]['resolucion'];
			$dane = $col[0]['dane'];
			$nit = $col[0]['nit'];
			$escudo = $col[0]['escudo'];

			$cursos_votantes = $this->elecciones_model->cursos_votantes_eleccion($id_eleccion);
			$total_cursos_votantes = count($this->elecciones_model->cursos_votantes_eleccion($id_eleccion));

			// create new PDF document
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Siescolar');
	        $pdf->SetTitle('Listado Votantes Elección: '.$nombre_eleccion);
	        $pdf->SetSubject('Listado SIESCOLAR');
	        $pdf->SetKeywords('SIESCOLAR, PDF, example, test, guide');

	        // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
	       	//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 128), array(0, 64, 128));
	        //$pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
	 
			// datos por defecto de cabecera
	        //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	        //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	        // remove default header/footer
	        $pdf->SetPrintHeader(false);
	 		$pdf->SetPrintFooter(false);

			// establecer la fuente monoespaciada predeterminada
	        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	 
			// establecer margenes
	        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	        //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	 
			// establecer saltos automáticos de página
	        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	 
			// relación utilizada para ajustar la conversión de los píxeles, establecer el factor de escala de la imagen
	        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	        // ---------------------------------------------------------
			// establecer el modo de fuente por defecto
	        $pdf->setFontSubsetting(true);
	 
			// Establecer el tipo de letra
			//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
			// Helvetica para reducir el tamaño del archivo.
	        //$pdf->SetFont('freemono', 'B', 14, '', true);

	        for ($i=0; $i < $total_cursos_votantes; $i++) {

	        	// Añadir una página
		        $pdf->AddPage();

		        //==============================================Page header========================================================

		        // Logo
		        //$image_file = K_PATH_IMAGES.'logo_example.jpg';
		        $image_file = 'uploads/imagenes/colegio/'.$escudo;
		        $pdf->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		        $pdf->SetFont('helvetica', 'B', 12);

		        // Title
		        //$pdf->Cell(0, 0, '<<TCPDF Example 003>>', 1, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->SetFont('helvetica', '', 12);
		        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->ln(3);
		        //===================================================================================================================

		        
		        $pdf->SetFont('helvetica', 'B', 12);
		        $pdf->Write(0, '   LISTADO DE VOTANTES', '', 0, 'C', true, 0, false, false, 0);
		        $pdf->Write(0, '   ELECCIÓN DE '.strtoupper($nombre_eleccion).'', '', 0, 'C', true, 0, false, false, 0);

		        $pdf->SetFont('helvetica', '', 10, '', true);
		 
				//fijar efecto de sombra en el texto
		        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

		        // Establecemos el contenido para imprimir
		        //**********************************************************************************************************
				//preparamos y maquetamos el contenido a crear
				//**********************************************************************************************************

				$tbl = '';
				$tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
				$tbl .= '<tr>
		        			<td align="center"><b>CURSO:</b> '.$cursos_votantes[$i]['nombre_grado'].' '.$cursos_votantes[$i]['nombre_grupo'].' '.$cursos_votantes[$i]['jornada'].' 
		        			</td>
		        		</tr>';

		        $tbl .= '<tr>
		        			<td align="center" width="22"><b>#</b></td>
		        			<td align="center" width="333"><b>NOMBRES Y APELLIDOS</b></td>
		        			<td align="center" width="226"><b>CÓDIGO DE VOTACIÓN</b></td>
		        			<td align="center" width="49"></td>
		        		</tr>';

		        $id_curso = $cursos_votantes[$i]['id_curso'];
		        $estudiantes_votantes = $this->elecciones_model->estudiantes_votantes_eleccion($id_eleccion,$id_curso);
				$total_estudiantes_votantes = count($this->elecciones_model->estudiantes_votantes_eleccion($id_eleccion,$id_curso));

				for ($j=0; $j < $total_estudiantes_votantes; $j++) {

					$cont = $j + 1;

					$tbl .= '<tr nobr="true">

								<td align="center" width="22">'.$cont.'</td>
			        			<td align="center" width="333">'.$estudiantes_votantes[$j]['nombres'].' '.$estudiantes_votantes[$j]['apellido1'].' '.$estudiantes_votantes[$j]['apellido2'].'</td>
			        			<td align="center" width="226">'.$estudiantes_votantes[$j]['codigo_voto'].'</td>
			        			<td width="49"></td>

							</tr>';
				}

				$tbl .= '</table>';


				// Imprimimos el texto con writeHTMLCell()
			    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);


			    //SI HAY UN SALTO DE PAGINA, CREAMOS EL ENCABEZADO Y LAS 2 PRIMERAS FILAS
		        if ($pdf->getAutoPageBreak()) {
		        	
		        	$pdf->SetY(-280);

		        	//==================================Page header - Salto De Pagina=======================================
			        // Logo
			        $image_file = 'uploads/imagenes/colegio/'.$escudo;
			        $pdf->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
			        $pdf->SetFont('helvetica', 'B', 12);

			        // Title
			        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
			        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
			        $pdf->SetFont('helvetica', '', 12);
			        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
			        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
			        $pdf->ln(3);

			        $pdf->SetFont('helvetica', 'B', 12);
		        	$pdf->Write(0, '   LISTADO DE VOTANTES', '', 0, 'C', true, 0, false, false, 0);
		        	$pdf->Write(0, '   ELECCIÓN DE '.strtoupper($nombre_eleccion).'', '', 0, 'C', true, 0, false, false, 0);
		        	$pdf->SetFont('helvetica', '', 10, '', true);
			        //===================================================================================================================

			        $tbl = '';
			        $tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
			        $tbl .= '<tr>
			        			<td align="center"><b>CURSO:</b> '.$cursos_votantes[$i]['nombre_grado'].' '.$cursos_votantes[$i]['nombre_grupo'].' '.$cursos_votantes[$i]['jornada'].' 
			        			</td>
			        		</tr>';

			        $tbl .= '<tr>
			        			<td align="center" width="22"><b>#</b></td>
			        			<td align="center" width="333"><b>NOMBRES Y APELLIDOS</b></td>
			        			<td align="center" width="226"><b>CÓDIGO DE VOTACIÓN</b></td>
		        				<td align="center" width="49"><b></b></td>
			        		</tr>';
			        $tbl .= '</table>';

			        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

		        }

	        }


	        // ==============================================================================================0
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	        //$nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
	        $nombre_archivo = utf8_decode("Listado Votantes Eleccion ".$nombre_eleccion.".pdf");
	        $pdf->Output($nombre_archivo, 'I');

		}
		else{

			echo "<h1>No Existen Votantes Registrados Para Esta Elección</h1>";
		}
    }


    //****************************************************** FUNCIONES PARA LA VOTACION ***************************************************


    public function validar_ingreso_votacion(){

        $this->form_validation->set_rules('codigo_eleccion', 'Código De Ingreso', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$codigo_eleccion = $this->input->post('codigo_eleccion');

        	$consulta = $this->elecciones_model->obtener_informacion_porcodigo($codigo_eleccion);

        	if ($consulta != false) {
        		
        		$id_eleccion = $consulta[0]['id_eleccion'];
        		$estado_votante = $consulta[0]['estado_votante'];
        		$fecha = $this->elecciones_model->obtener_fecha_actual();

        		$fecha_actual = substr($fecha, 0,10);
        		$hora_actual = substr($fecha, 11,8);

        		if ($estado_votante == "no") {
        			
        			if ($this->elecciones_model->validar_fechaIngresoVotacion($id_eleccion,$fecha_actual,$hora_actual)) {
        				
        				echo "ok";
        			}
        			else{

        				echo "votacioncerrada";
        			}

        		}
        		else{

        			echo "yavoto";
        		}

        	}
        	else{

        		echo "noexiste";
        	}


        }

    }


    public function votacion(){

    	$codigo_eleccion = $this->input->get('codigo_eleccion');

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'votante')
		{
			redirect(base_url().'login_controller');
		}

		//Validanos nuevamente el codigo de ingreso 
		$consulta = $this->elecciones_model->obtener_informacion_porcodigo($codigo_eleccion);

    	if ($consulta != false) {
    		
    		$id_eleccion = $consulta[0]['id_eleccion'];
    		$estado_votante = $consulta[0]['estado_votante'];
    		$fecha = $this->elecciones_model->obtener_fecha_actual();

    		$fecha_actual = substr($fecha, 0,10);
    		$hora_actual = substr($fecha, 11,8);

    		if ($estado_votante == "no") {
    			
    			if ($this->elecciones_model->validar_fechaIngresoVotacion($id_eleccion,$fecha_actual,$hora_actual)) {
    				
    				$data['candidatos'] = $this->elecciones_model->candidatos_eleccion($id_eleccion);
    				$data['institucion'] = $this->elecciones_model->buscar_datos_institucion();
    				$data['codigo_eleccion'] = $codigo_eleccion;

    				$this->template->load('roles/rol_votante_vista', 'elecciones/votacion_vista',$data);
    			}
    			else{

    				redirect(base_url().'rol_votante/elecciones');
    			}

    		}
    		else{

    			redirect(base_url().'rol_votante/elecciones');
    		}

    	}
    	else{

    		redirect(base_url().'rol_votante/elecciones');
    	}

    }


    public function registrar_voto(){

		$candidato_elegido = $this->input->post('candidato_elegido');
		$codigo_eleccion = $this->input->post('codigo_eleccion');
		
		$respuesta=$this->elecciones_model->registrar_voto($candidato_elegido,$codigo_eleccion);

		if($respuesta==true){

			echo "registroguardado";
		}
		else{

			echo "registronoguardado";
		}

	}


	//********************************************** FUNCIONES PARA LOS RESULTADOS DE LAS ELECCIONES *******************************


	public function resultados()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'elecciones/resultados_vista');
	}


	public function mostrarresultados(){

		$id_eleccion = $this->input->post('id_eleccion'); 
		
		$data = array(

			'elecciones' => $this->elecciones_model->buscar_resultados($id_eleccion),

			'total_votantes' => count($this->elecciones_model->total_votantes_aptos($id_eleccion))

		);
	    echo json_encode($data);

	}




}