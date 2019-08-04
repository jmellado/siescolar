<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Importar_notas_controller extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('importar_notas_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
		$this->load->library('csvimport');
	}


	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'importar_notas/importar_notas_vista');
	}


	public function importar(){

		$this->form_validation->set_rules('id_curso', 'Curso', 'required|numeric');
        $this->form_validation->set_rules('id_asignatura', 'Asignatura', 'required|numeric');
        $this->form_validation->set_rules('periodo', 'Periodo', 'required|max_length[8]');
        $this->form_validation->set_rules('separador', 'Separador', 'required|max_length[1]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$nombre_archivo = $_FILES['archivo']['name'];
        	$nombre_archivotmp = $_FILES['archivo']['tmp_name'];

        	$periodo = $this->input->post('periodo');
        	$period = $this->importar_notas_model->convertir_periodo($periodo);
			$id_curso = $this->input->post('id_curso');
			$id_grado = $this->importar_notas_model->obtener_gradoPorcurso($id_curso);
			$id_asignatura = $this->input->post('id_asignatura');
			$separador = $this->input->post('separador');
			$estado_nota = "activo";
			$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

			if($nombre_archivotmp != ""){

				if ($this->importar_notas_model->validar_estructura($nombre_archivotmp,$separador)){

					if ($this->importar_notas_model->validar_archivo_vacio($nombre_archivotmp,$separador)){


						$file_data = $this->csvimport->get_array($nombre_archivotmp,FALSE,FALSE,FALSE,$separador);


						if ($this->importar_notas_model->validar_archivo($file_data,$id_curso,$id_asignatura,$periodo)){

							if ($this->importar_notas_model->validar_notas($ano_lectivo,$file_data)){

								$respuesta = $this->importar_notas_model->modificar_nota($ano_lectivo,$file_data,$id_curso,$id_grado,$id_asignatura,$period,$estado_nota);

								if($respuesta == true){

						        	echo "registroguardado";
						        }
						        else{
						        	echo "registronoguardado";
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

    	$consulta = $this->importar_notas_model->llenar_cursos($jornada);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas(){

    	$id_curso =$this->input->post('id_curso');
    	$id_grado = $this->importar_notas_model->obtener_gradoPorcurso($id_curso);

    	$consulta = $this->importar_notas_model->llenar_asignaturas($id_grado);
    	echo json_encode($consulta);
    }


}