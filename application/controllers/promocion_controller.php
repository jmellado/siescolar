<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promocion_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('promocion_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$this->template->load('roles/rol_administrador_vista', 'promocion/promocion_vista');
	}


	public function llenarcombo_cursos(){

    	$jornada = $this->input->post('jornada');

    	$consulta = $this->promocion_model->llenar_cursos($jornada);
    	echo json_encode($consulta);
    }


    public function procesar_promocion(){

		$jornada = $this->input->post('jornada'); 
		$id_curso = $this->input->post('id_curso');

		$PeriodosRegistrados = $this->promocion_model->PeriodosRegistrados();
		$PeriodosActivos = $this->promocion_model->PeriodosActivos();
		$PeriodosCerrados = $this->promocion_model->PeriodosCerrados();

		if ($PeriodosRegistrados > 0) {

			if ($PeriodosRegistrados == 4) {
			
				if ($PeriodosActivos == 0) {

					if ($PeriodosCerrados == 4) {

						if ($this->promocion_model->validar_existencia_estudiantes($id_curso)) {

							if ($this->promocion_model->validar_existencia_criterios($id_curso)) {

								$respuesta = $this->promocion_model->modificar_estado_matricula($jornada,$id_curso);

								if($respuesta==true){
					              
					              	echo "promocionrealizada";
					          	}else{
					              
					              	echo "promocionnorealizada";
					          	}

					        }
					        else{

					        	echo "nohaycriterios";
					        }

					    }
					    else{

					    	echo "nohayestudiantes";
					    }
			        }
			        else{

			        	echo "nohay4periodoscerrados";
			        }

				}
				else{

					echo "promociondenegada";
				}
			}
			else{

				echo "nohay4periodos";
			}
		}
		else{

			echo "nohayperiodos";
		}

	}


	public function mostrarpromocion(){

		$jornada = $this->input->post('jornada'); 
		$id_curso = $this->input->post('id_curso');
		
		$data = array(

			'promocion' => $this->promocion_model->buscar_promocion($jornada,$id_curso),

		    'totalregistros' => count($this->promocion_model->buscar_promocion($jornada,$id_curso))


		);
	    echo json_encode($data);


	}

}