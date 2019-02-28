<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notas_controller extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->model('notas_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
	
	}


	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$this->template->load('roles/rol_administrador_vista', 'notas/notas_vista');
	}


	public function index_profesor()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}

		$this->template->load('roles/rol_profesor_vista', 'notas/notas_profesor_vista');
	}


	public function insertar(){

		$this->form_validation->set_rules('periodo', 'Periodo', 'required|max_length[8]');
		$this->form_validation->set_rules('id_curso', 'Curso', 'required|numeric');
        $this->form_validation->set_rules('id_asignatura', 'Asignatura', 'required|numeric');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

			//$p1 = $this->input->post('p2');
			//var_dump($p1);

			$periodo = $this->input->post('periodo');
			$id_curso = $this->input->post('id_curso');
			$id_asignatura = $this->input->post('id_asignatura');
			$estudiantes = $this->input->post('id_estudiante');
			$p1 = $this->input->post('p1');
			$p2 = $this->input->post('p2');
			$p3 = $this->input->post('p3');
			$p4 = $this->input->post('p4');
			$fallas = $this->input->post('fallas');
			$estado_nota = "activo";
			$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

			if($estudiantes != ""){

				if ($this->notas_model->validar_notas($ano_lectivo,$periodo,$p1,$p2,$p3,$p4)){

					$respuesta = $this->notas_model->modificar_nota($ano_lectivo,$estudiantes,$id_curso,$id_asignatura,$p1,$p2,$p3,$p4,$fallas,$estado_nota);

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

		    }else{

		    	echo "nohayestudiantes";
		    }

		}

	}


	public function mostrarnotas(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;

		$id_curso = $this->input->post('id_curso');
		$id_asignatura = $this->input->post('id_asignatura');
		
		$data = array(

			'notas' => $this->notas_model->buscar_nota($id,$inicio,$cantidad,$id_curso,$id_asignatura),

		    'totalregistros' => count($this->notas_model->buscar_nota($id,$inicio,$cantidad,$id_curso,$id_asignatura)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function buscar_profesor(){

		$id = $this->input->post('id'); 
		
		$consulta = $this->notas_model->buscar_profesor($id);

		if($consulta==false){
			echo "profesornoexiste";
		}
		else{

			echo json_encode($consulta);	
						
		}
	    
	}


	public function llenarcombo_cursos_profesor(){

		$id_profesor = $this->input->post('id_persona');

    	$consulta = $this->notas_model->llenar_cursos_profesor($id_profesor);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas_profesor(){

    	$id_profesor = $this->input->post('id_persona');
		$id_curso = $this->input->post('id_curso');
		//$id_grupo = $this->input->post('id_grupo');

    	$consulta = $this->notas_model->llenar_asignaturas_profesor($id_profesor,$id_curso);
    	echo json_encode($consulta);
    }


    public function validar_fechaIngresoNotas(){

    	$periodo = $this->input->post('periodo');
		$fecha_actual = $this->input->post('fecha_actual');

		$consulta = $this->notas_model->validar_fechaIngresoNotas($periodo,$fecha_actual);

		if($consulta){

			echo "si";
			
		}
		else{
			echo "no";
		}

    }

}