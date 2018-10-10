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

		//$items1 = $this->input->post('id_persona');
		//$items2 = $this->input->post('p1');

		//var_dump($items1);
		//var_dump($items2);
		if($this->input->post('id_persona')!=""){

			$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
			$id_asignatura = $this->input->post('id_asignatura');
			$estado = "activo";

			//$data = array();

			for ($i=0; $i < count($this->input->post('id_persona')) ; $i++) {

				$id_estudiante = $this->input->post('id_persona')[$i];
				$p1 = $this->input->post('p1')[$i];
				$p2 = $this->input->post('p2')[$i];
				$p3 = $this->input->post('p3')[$i];
				$p4 = $this->input->post('p4')[$i];
				$fallas = $this->input->post('fallas')[$i];

				$nota_final = $this->notas_model->calcularNota_final($p1,$p2,$p3,$p4);
				$desempeno = $this->notas_model->obtener_desempeno($nota_final,$ano_lectivo);

				if ($p1==""){
		            $p1=NULL;
		        }
		        if ($p2==""){
		            $p2=NULL;
		        }
		        if ($p3==""){
		            $p3=NULL;
		        }
		        if ($p4==""){
		            $p4=NULL;
		        }

				//$data[]
				$data = array(

	            	'ano_lectivo' => $ano_lectivo,
	                'id_estudiante' => $id_estudiante,
	                'id_asignatura' => $id_asignatura,
	                'p1' => $p1,
	                'p2' => $p2,
	                'p3' => $p3,
	                'p4' => $p4,
	                'nota_final' => $nota_final,
	                'id_desempeno' => $desempeno,
	                'fallas' => $fallas,
	                'estado_nota' => $estado
	                
	            );

	            //asi para guardar de uno en uno sin el update_batch
	            $respuesta = $this->notas_model->modificar_nota($data,$id_estudiante,$id_asignatura);

	            if($respuesta == false){
					echo "error al ingresar notas";
				}

			}

			// $respuesta = $this->notas_model->modificar_nota($data);

			if($respuesta == true){

	        	echo "registroguardado";
	        }
	        else{
	        	echo "registronoguardado";
	        }

	    }else{

	    	echo "nohayestudiantes";
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

    	$consulta = $this->notas_model->llenar_grados_profesor($id_profesor);
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