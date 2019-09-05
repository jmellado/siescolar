<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Importar_logros_controller extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('importar_logros_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
		$this->load->library('excel');
	}


	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'importar_logros/importar_logros_vista');
	}


	public function importar(){

		$this->form_validation->set_rules('id_curso', 'Curso', 'required|numeric');
        $this->form_validation->set_rules('id_asignatura', 'Asignatura', 'required|numeric');
        $this->form_validation->set_rules('periodo', 'Periodo', 'required|max_length[8]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$nombre_archivo = $_FILES['archivo']['name'];
        	$nombre_archivotmp = $_FILES['archivo']['tmp_name'];

        	$periodo = $this->input->post('periodo');
			$id_curso = $this->input->post('id_curso');
			$id_grado = $this->importar_logros_model->obtener_gradoPorcurso($id_curso);
			$id_asignatura = $this->input->post('id_asignatura');
			$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

			if($nombre_archivotmp != ""){

				if ($this->importar_logros_model->validar_estructura($nombre_archivotmp)){

					if ($this->importar_logros_model->validar_archivo_vacio($nombre_archivotmp)){


						$file_data = $this->importar_logros_model->get_array($nombre_archivotmp);


						if ($this->importar_logros_model->validar_archivo($file_data,$id_curso,$id_asignatura,$periodo)){

							if ($this->importar_logros_model->validar_notas($ano_lectivo,$file_data)){

								if ($this->importar_logros_model->validar_logros($ano_lectivo,$file_data,$id_curso,
									$id_grado,$id_asignatura,$periodo)){

									$respuesta = $this->importar_logros_model->insertar_logros($ano_lectivo,$file_data,
										$id_curso,$id_grado,$id_asignatura,$periodo);

									if($respuesta == true){

							        	echo "registroguardado";
							        }
							        else{
							        	echo "registronoguardado";
							        }

							    }
							    else{

							    	echo "logrosincorrectos";
							    }
						        
						    }
						    else{

						    	echo "notasincorrectas";
						    }

						}
						else{

							echo "archivonoaplica";
						}

					}
					else{

						echo "archivovacio";
					}

				}
				else{

					echo "estructuraincorrecta";
				}

		    }else{

		    	echo "ingresararchivo";
		    }

        }

	}


	public function llenarcombo_cursos(){

    	$jornada = $this->input->post('jornada');

    	$consulta = $this->importar_logros_model->llenar_cursos($jornada);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas(){

    	$id_curso =$this->input->post('id_curso');
    	$id_grado = $this->importar_logros_model->obtener_gradoPorcurso($id_curso);

    	$consulta = $this->importar_logros_model->llenar_asignaturas($id_grado);
    	echo json_encode($consulta);
    }


}