<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Horarios_controller extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('horarios_model');
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
		
		$this->template->load('roles/rol_administrador_vista', 'horarios/horarios_vista');
	}


	public function llenarcombo_cursos(){

    	$jornada = $this->input->post('jornada');

    	$consulta = $this->horarios_model->llenar_cursos($jornada);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas_pensum(){

		$id_curso = $this->input->post('id_curso');

    	$consulta = $this->horarios_model->llenar_asignaturas_pensum($id_curso);
    	echo json_encode($consulta);
    }


    public function mostrarhorarios(){

		$id =$this->input->post('id_buscar');
		$id_curso = $this->input->post('id_curso'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'horarios' => $this->horarios_model->buscar_horario($id,$id_curso,$inicio,$cantidad),

		    'totalregistros' => count($this->horarios_model->buscar_horario($id,$id_curso)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function insertar(){

        $this->form_validation->set_rules('jornada', 'Jornada', 'required');
        $this->form_validation->set_rules('id_curso', 'Curso', 'required|numeric');
        $this->form_validation->set_rules('id_asignatura', 'Asignatura', 'required|numeric');
        $this->form_validation->set_rules('dia', 'Dia', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$jornada = $this->input->post('jornada');
        	$id_curso = $this->input->post('id_curso');
        	$id_asignatura = $this->input->post('id_asignatura');
        	$dias = $this->input->post('dia');

			if ($this->horarios_model->validar_intensidad_horaria($id_curso,$id_asignatura,$dias)){

				if ($this->horarios_model->validar_horas_registradas($id_curso,$id_asignatura,$dias)){

					$respuesta = $this->horarios_model->modificar_horario($id_curso,$id_asignatura,$dias);

					if($respuesta == true){

						echo "registroguardado";

					}
					else{

						echo "registronoguardado";
					}
				}
				else{
					echo "errorhoras_registradas";
				}
			}
			else{
				echo "errorintensidad_horaria";
			}


        }

	}


	//================== FUNCIONES PARA MOSTRAR EL HORARIO DE UN ESTUDIANTE ==================


	public function horario_estudiante()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'estudiante')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_estudiante_vista', 'horarios/horarios_estudiante_vista');
	}


	public function mostrarhorarios_estudiante(){

		$id_estudiante = $this->input->post('id_estudiante');  
        $ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

        $matricula = $this->horarios_model->obtener_informacion_matricula($ano_lectivo,$id_estudiante);
        $id_curso = $matricula[0]['id_curso'];
		
		$data = array(

			'horarios' => $this->horarios_model->buscar_horario_estudiante($id_curso),

		    'totalregistros' => count($this->horarios_model->buscar_horario_estudiante($id_curso))


		);
	    echo json_encode($data);


	}



}