<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignar_logros_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('asignar_logros_model');
		$this->load->model('funciones_globales_model');
		$this->load->model('grados_model');
		$this->load->model('asignaturas_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}

	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'asignar_logros/asignar_logros_vista');
	}


	public function buscar_profesor(){

		$id = $this->input->post('id'); 
		
		$consulta = $this->asignar_logros_model->buscar_profesor($id);

		if($consulta==false){
			echo "profesornoexiste";
		}
		else{

			echo json_encode($consulta);	
						
		}
	    
	}


	public function llenarcombo_grados_profesor(){

		$id_profesor = $this->input->post('id_persona');

    	$consulta = $this->asignar_logros_model->llenar_grados_profesor($id_profesor);
    	echo json_encode($consulta);
    }


    public function llenarcombo_grupos_profesor(){

		$id_profesor = $this->input->post('id_persona');
		$id_grado = $this->input->post('id_grado');

    	$consulta = $this->asignar_logros_model->llenar_grupos_profesor($id_profesor,$id_grado);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas_profesor(){

    	$id_profesor = $this->input->post('id_persona');
		$id_grado = $this->input->post('id_grado');
		$id_grupo = $this->input->post('id_grupo');

    	$consulta = $this->asignar_logros_model->llenar_asignaturas_profesor($id_profesor,$id_grado,$id_grupo);
    	echo json_encode($consulta);
    }


    public function validar_fechaIngresoLogros(){

    	$periodo = $this->input->post('periodo');
		$fecha_actual = $this->input->post('fecha_actual');

		$consulta = $this->asignar_logros_model->validar_fechaIngresoLogros($periodo,$fecha_actual);

		if($consulta){

			echo "si";
			
		}
		else{
			echo "no";
		}

    }


    public function llenarcombo_logros(){

    	$periodo = $this->input->post('periodo');
    	$id_profesor = $this->input->post('id_persona');
		$id_grado = $this->input->post('id_grado');
		$id_asignatura = $this->input->post('id_asignatura');

    	$consulta = $this->asignar_logros_model->llenar_logros($periodo,$id_profesor,$id_grado,$id_asignatura);
    	echo json_encode($consulta);
    }


    public function mostrarplanillas(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;

		$id_grado = $this->input->post('id_grado');
		$id_grupo =	$this->input->post('id_grupo');
		$id_asignatura = $this->input->post('id_asignatura');
		
		$data = array(

			'notas' => $this->asignar_logros_model->buscar_nota($id,$inicio,$cantidad,$id_grado,$id_grupo,$id_asignatura),

		    'totalregistros' => count($this->asignar_logros_model->buscar_nota($id,$inicio,$cantidad,$id_grado,$id_grupo,$id_asignatura)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function insertar(){

		//$items1 = $this->input->post('id_persona');
		//$items2 = $this->input->post('p1');

		//var_dump($items1);
		//var_dump($items2);
		if($this->input->post('id_persona')!=""){

			$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
			$estado = "activo";

			//$data = array();

			for ($i=0; $i < count($this->input->post('id_persona')) ; $i++) {

				$id_estudiante = $this->input->post('id_persona')[$i];
				$periodo = $this->input->post('periodo');
				$id_grado = $this->input->post('id_grado');
				$id_asignatura = $this->input->post('id_asignatura');
				$id_logro1 = $this->input->post('id_logro1')[$i];
				$id_logro2 = $this->input->post('id_logro2')[$i];
				$id_logro3 = $this->input->post('id_logro3')[$i];
				$id_logro4 = $this->input->post('id_logro4')[$i];

				//$nota_final = $this->notas_model->calcularNota_final($p1,$p2,$p3,$p4);
				//$desempeno = $this->notas_model->obtener_desempeno($nota_final);

				/*if ($p1==""){
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
		        }*/

				//$data[]
				$data = array(

	            	'ano_lectivo' => $ano_lectivo,
	                'id_estudiante' => $id_estudiante,
	                'periodo' => $periodo,
	                'id_grado' => $id_grado,
	                'id_asignatura' => $id_asignatura,
	                'id_logro1' => $id_logro1,
	                'id_logro2' => $id_logro2,
	                'id_logro3' => $id_logro3,
	                'id_logro4' => $id_logro4
	                
	            );

				$estado = $this->asignar_logros_model->validar_existencia($ano_lectivo,$id_estudiante,$periodo,$id_grado,$id_asignatura);

				if($estado){

					$respuesta = $this->asignar_logros_model->insertar_logros($data);

		            if($respuesta == false){
						echo "error al ingresar logros";
					}
				}
				else{
					
					$respuesta = $this->asignar_logros_model->modificar_logros($data,$ano_lectivo,$id_estudiante,$periodo,$id_grado,$id_asignatura);

		            if($respuesta == false){
						echo "error al modificar logros";
					}

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

	    	echo "No Hay Informacion Por Registrar";
	    }

	}


	

}