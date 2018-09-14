<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matriculas_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('matriculas_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'matriculas/matriculas_vista');
	}

	public function insertar(){

        $this->form_validation->set_rules('id_persona', 'id persona', 'required|numeric');
        $this->form_validation->set_rules('id_curso', 'curso', 'required|numeric');
        $this->form_validation->set_rules('id_acudiente', 'Acudiente', 'required|numeric');
        $this->form_validation->set_rules('parentesco', 'Parentesco', 'required');
        $this->form_validation->set_rules('jornada', 'jornada', 'required|alpha_spaces');
        $this->form_validation->set_rules('observaciones', 'observaciones', 'required|alpha_spaces');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de matriculas + 1 
        	$ultimo_id = $this->matriculas_model->obtener_ultimo_id();

        	//obtengo la fecha actual 
        	$fecha_actual = $this->funciones_globales_model->obtener_fecha_actual_corta();
        	 
        	//obtengo la año actual 
        	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

        	$id_estudiante = $this->input->post('id_persona');
        	$id_curso = $this->input->post('id_curso');
        	$jornada = $this->input->post('jornada');
        	$id_acudiente = $this->input->post('id_acudiente');
        	$parentesco = $this->input->post('parentesco');
        	$observaciones = $this->input->post('observaciones');
        	$estado = 'Activo';

        	//array para insertar en la tabla grados----------
        	$matricula = array(
        	'id_matricula' =>$ultimo_id,	
			'fecha_matricula' =>$fecha_actual,
			'ano_lectivo' =>$ano_lectivo,
			'id_estudiante' =>$id_estudiante,
			'id_curso' =>$id_curso,
			'jornada' =>$jornada,
			'id_acudiente' =>$id_acudiente,
			'parentesco' =>$parentesco,
			'observaciones' =>ucwords(strtolower($observaciones)),
			'estado_matricula' =>$estado);

			//array para insertar en la tabla estudiantes_acudientes
			$est_acud = array(
        	'id_estudiante' =>$id_estudiante,	
			'id_acudiente' =>$id_acudiente,
			'parentesco' =>$parentesco,
			'ano_lectivo' =>$ano_lectivo);

			if ($this->matriculas_model->validar_existencia($id_estudiante,$ano_lectivo)){

				$respuesta=$this->matriculas_model->insertar_matricula($matricula,$est_acud);

				if($respuesta==true){

					echo "registroguardado";

					//*******************************matricular materias********************************************
					$id_grado = $this->matriculas_model->obtener_gradoPorcurso($id_curso);

					$asignaturas_grados = $this->matriculas_model->obtener_asignaturasPorgrados($id_grado);

					if ($asignaturas_grados != false) {

						for ($i=0; $i < count($asignaturas_grados) ; $i++) { 


							$resp = $this->matriculas_model->insertar_asignaturasPorestudiantes($ano_lectivo,$id_estudiante,$id_grado,$asignaturas_grados[$i]['id_asignatura']);

							if($resp == false){
								echo "no se pudo registrar en la tabla notas";
							}
							
						}
					}
					//*************************************************************************************************

				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "matricula ya existe";
			}

        }

	}

	public function mostrarmatriculas(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'matriculas' => $this->matriculas_model->buscar_matricula($id,$inicio,$cantidad),

		    'totalregistros' => count($this->matriculas_model->buscar_matricula($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

        	//Obtenemos id_estudiante y ano_lectivo con ese id de matricula********************************************
			$matri=$this->matriculas_model->obtener_informacion_matricula($id);
			$id_estudiante = $matri[0]['id_estudiante'];
			$ano_lectivo = $matri[0]['ano_lectivo'];

			//eliminanos las materias registradas de ese estudiante en la tabla notas********************************************
			if(!$this->matriculas_model->eliminar_asignaturasPorestudiantes($ano_lectivo,$id_estudiante)){
				echo "No se pudo eliminar en la tabla notas";
			}

			
	        $respuesta=$this->matriculas_model->eliminar_matricula($id,$id_estudiante,$ano_lectivo);
	        
          	if($respuesta==true){
              
              	echo "Matrícula Eliminada Correctamente.";
          	}else{
              
              	echo "No Se Pudo Eliminar.";
          	}
          
        }else{
          
          	echo "digite valor numerico para identificar una matricula";
        }
    }

    public function modificar(){

    	$id_matricula = $this->input->post('id_matricula');
    	$fecha_matricula = $this->input->post('fecha_matricula');
    	$ano_lectivo = $this->input->post('ano_lectivo');
    	$id_estudiante = $this->input->post('id_persona');
    	$id_curso = $this->input->post('id_curso');
    	$jornada = $this->input->post('jornada');
    	$id_acudiente = $this->input->post('id_acudiente');
        $parentesco = $this->input->post('parentesco');
    	$observaciones = $this->input->post('observaciones');
        $estado = 'Activo';

    	//array para insertar en la tabla matriculas----------
        $matricula = array(
        'id_matricula' =>$id_matricula,	
		'fecha_matricula' =>$fecha_matricula,
		'ano_lectivo' =>$ano_lectivo,
		'id_estudiante' =>$id_estudiante,
		'id_curso' =>$id_curso,
		'jornada' =>$jornada,
		'id_acudiente' =>$id_acudiente,
		'parentesco' =>$parentesco,
		'observaciones' =>ucwords(strtolower($observaciones)),
		'estado_matricula' =>$estado);

        //array para insertar en la tabla estudiantes_acudientes
		$est_acud = array(
    	'id_estudiante' =>$id_estudiante,	
		'id_acudiente' =>$id_acudiente,
		'parentesco' =>$parentesco,
		'ano_lectivo' =>$ano_lectivo);

        if(is_numeric($id_matricula)){

	    	$respuesta=$this->matriculas_model->modificar_matricula($id_matricula,$matricula,$est_acud,$id_estudiante,$ano_lectivo);

	        if($respuesta==true){

	        	echo "registroactualizado";

	        	//******************************eliminar materias********************************************
				if(!$this->matriculas_model->eliminar_asignaturasPorestudiantes($ano_lectivo,$id_estudiante)){
					echo "No se pudo eliminar en la tabla notas";
				}

				//*******************************matricular materias********************************************
				$id_grado = $this->matriculas_model->obtener_gradoPorcurso($id_curso);

				$asignaturas_grados = $this->matriculas_model->obtener_asignaturasPorgrados($id_grado);

				if ($asignaturas_grados != false) {
					
					for ($i=0; $i < count($asignaturas_grados) ; $i++) { 

						$resp = $this->matriculas_model->insertar_asignaturasPorestudiantes($ano_lectivo,$id_estudiante,$id_grado,$asignaturas_grados[$i]['id_asignatura']);

						if($resp == false){
							echo "no se pudo registrar en la tabla notas";
						}
							
					}
				}	
				//*************************************************************************************************

	        }else{

	        	echo "registronoactualizado";
	        }

         
        }else{
            
            echo "digite valor numerico para identificar una matricula";
        }




    }


    public function buscar_estudiante(){

		$id = $this->input->post('id'); 
		//obtengo la fecha actual 
       	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		
		$consulta = $this->matriculas_model->buscar_estudiante($id);
		if($consulta==false){
			echo "estudiantenoexiste";
		}
		else{

			if($this->matriculas_model->validar_existencia_por_identificacion($id,$ano_lectivo)){

				if($this->matriculas_model->comprobar_NuevoAntiguo($id)){

					echo json_encode($consulta);
				}
				else{
					echo "estudianteantiguo";
				}	
						
			}else{

				echo "matricula ya existe";
			}
			
		}
	    
	}


    public function llenarcombo_cursos(){

    	$jornada = $this->input->post('jornada');

    	$consulta = $this->matriculas_model->llenar_cursos($jornada);
    	echo json_encode($consulta);
    }


    public function llenarcombo_acudientes(){

    	$consulta = $this->matriculas_model->llenar_acudientes();
    	echo json_encode($consulta);
    }


    public function llenarcombo_cursos_actualizar(){

    	$jornada = $this->input->post('jornada');
    	$ano_lectivo = $this->input->post('ano_lectivo');

    	$consulta = $this->matriculas_model->llenar_cursos_actualizar($jornada,$ano_lectivo);
    	echo json_encode($consulta);
    }


    //****************************************** FUNCIONES PARA MATRICULAR ESTUDIANTES ANTIGUOS ***************************************

    public function buscar_estudianteA(){

		$id = $this->input->post('id'); 
		//obtengo la fecha actual 
       	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		
		$consulta = $this->matriculas_model->buscar_estudiante($id);
		if($consulta==false){
			echo "estudiantenoexiste";
		}
		else{

			if($this->matriculas_model->validar_existencia_por_identificacion($id,$ano_lectivo)){

				if(!$this->matriculas_model->comprobar_NuevoAntiguo($id)){

					//echo json_encode($consulta);

					$ultima_matricula = $this->matriculas_model->UltimaMatricula($id);
					$matricula = $this->matriculas_model->obtener_informacion_matricula($ultima_matricula);
					$id_curso = $matricula[0]['id_curso'];
					$estado_matricula = $matricula[0]['estado_matricula'];

					$id_grado = $this->matriculas_model->obtener_gradoPorcurso($id_curso);
					$grado = $this->matriculas_model->obtener_informacion_grado($id_grado);
					$nombre_grado = $grado[0]['nombre_grado'];

					if ($estado_matricula == "Aprobado") {

						$data = array(

							'datos' => $consulta,

							'proximo_grado' => $this->matriculas_model->obtener_proximo_grado($nombre_grado),

						    'estadomatricula' => $estado_matricula
						);

						echo json_encode($data);
						
					}
					else{

						$data = array(

							'datos' => $consulta,

							'proximo_grado' => $nombre_grado,

						    'estadomatricula' => $estado_matricula
						);

						echo json_encode($data);

					}
				}
				else{

					echo "estudiantenuevo";
				}	
						
			}else{

				echo "matricula ya existe";
			}
			
		}
	    
	}


	public function llenarcombo_cursosA(){

    	$jornada = $this->input->post('jornada');
    	$nombre_grado = $this->input->post('nombre_grado');

    	$consulta = $this->matriculas_model->llenar_cursosA($jornada,$nombre_grado);
    	echo json_encode($consulta);
    }


    //********************************* FUNCIONES PARA EL CONSOLIDADO DE MATRICULAS ****************************************


    public function consolidar_matriculas()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'matriculas/consolidar_matriculas_vista');
	}


	public function consolidar(){

		$PeriodosRegistrados = $this->matriculas_model->PeriodosRegistrados();
		$PeriodosActivos = $this->matriculas_model->PeriodosActivos();

		if ($PeriodosRegistrados > 0) {
			
			if ($PeriodosActivos == 0) {

				$respuesta = $this->matriculas_model->modificar_estado_matricula();

				if($respuesta==true){
	              
	              	echo "consolidadorealizado";
	          	}else{
	              
	              	echo "consolidadonorealizado";
	          	}

			}
			else{

				echo "consolidadodenegado";
			}
		}
		else{

			echo "nohayperiodos";
		}
	}


}