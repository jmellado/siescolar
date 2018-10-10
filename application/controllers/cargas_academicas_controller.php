<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cargas_academicas_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('cargas_academicas_model');
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

		$this->template->load('roles/rol_administrador_vista', 'cargas_academicas/cargas_academicas_vista');
	}

	public function index_profesor()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_profesor_vista', 'cargas_academicas/cargas_academicasprofesor_vista');
	}

	public function insertar(){

		$this->form_validation->set_rules('id_profesor', 'profesor', 'required|numeric');
        $this->form_validation->set_rules('id_curso', 'grado', 'required|numeric');
        $this->form_validation->set_rules('id_asignatura', 'asignatura', 'required|numeric');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de cargas academicas + 1 
        	$ultimo_id = $this->cargas_academicas_model->obtener_ultimo_id();

        	$id_profesor = $this->input->post('id_profesor');
        	$id_curso = $this->input->post('id_curso');
        	$id_asignatura = $this->input->post('id_asignatura');
        	$ano_lectivo = $this->input->post('ano_lectivo');

        	//array para insertar en la tabla cargas academicas----------
        	$cargas_academicas = array(
        	'id_carga_academica' =>$ultimo_id,
        	'id_profesor' =>$id_profesor,	
			'id_curso' =>$id_curso,
			'id_asignatura' =>$id_asignatura,
			'ano_lectivo' =>$ano_lectivo);

			if ($this->cargas_academicas_model->validar_existencia($id_curso,$id_asignatura,$ano_lectivo)){

				$respuesta=$this->cargas_academicas_model->insertar_cargas_academicas($cargas_academicas);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "cargas_academicasyaexiste";
			}

        }

	}

	public function mostrarcargas_academicas(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'cargas_academicas' => $this->cargas_academicas_model->buscar_cargas_academicas($id,$inicio,$cantidad),

		    'totalregistros' => count($this->cargas_academicas_model->buscar_cargas_academicas($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id_carga_academica =$this->input->post('id_carga_academica');

	  	$carg = $this->cargas_academicas_model->obtener_informacion_carga($id_carga_academica);
	  	$ano_lectivo = $carg[0]['ano_lectivo']; 

        if(is_numeric($id_carga_academica)){

			if ($this->funciones_globales_model->ValidarEstado_AnoLectivo($ano_lectivo)){

		        $respuesta=$this->cargas_academicas_model->eliminar_cargas_academicas($id_carga_academica);
		        
	          	if($respuesta==true){
	              
	              	echo "Carga Académica Eliminada Correctamente.";
	          	}else{
	              
	              	echo "No Se Pudo Eliminar.";
	          	}
	        }
	        else{

	        	echo "No Se Puede Eliminar Esta Carga Académica; El Año Lectivo En La Que Fue Registrada, Se Encuentra Cerrado.";
	        }  	
          
        }else{
          
          	echo "digite valor numerico para identificar una carga_academica";
        }
    }

    public function modificar(){

    	$id_carga_academica = $this->input->post('id_carga_academica');
    	$id_profesor = $this->input->post('id_profesor');
    	$id_curso = $this->input->post('id_curso');
    	$id_asignatura = $this->input->post('id_asignatura');
    	$ano_lectivo = $this->input->post('ano_lectivo');

    	//array para insertar en la tabla cargas_academicas----------
        $cargas_academicas = array(
        'id_carga_academica' =>$id_carga_academica,
        'id_profesor' =>$id_profesor,	
		'id_curso' =>$id_curso,
		'id_asignatura' =>$id_asignatura,
		'ano_lectivo' =>$ano_lectivo);

		$carg = $this->cargas_academicas_model->obtener_informacion_carga($id_carga_academica);

		$curso_buscado = $carg[0]['id_curso'];
		$asignatura_buscada = $carg[0]['id_asignatura'];
		$ano_lectivo_buscado = $carg[0]['ano_lectivo'];

        if(is_numeric($id_carga_academica)){

        	if ($this->funciones_globales_model->ValidarEstado_AnoLectivo($ano_lectivo)){

	        	if ($curso_buscado == $id_curso && $asignatura_buscada == $id_asignatura && $ano_lectivo_buscado == $ano_lectivo){

		        	$respuesta=$this->cargas_academicas_model->modificar_cargas_academicas($id_carga_academica,$cargas_academicas);

					 if($respuesta==true){

						echo "registroactualizado";

		             }else{

						echo "registronoactualizado";

		             }
		        }
		        else{

		        	if($this->cargas_academicas_model->validar_existencia($id_curso,$id_asignatura,$ano_lectivo)){

		        		$respuesta=$this->cargas_academicas_model->modificar_cargas_academicas($id_carga_academica,$cargas_academicas);

		        		if($respuesta==true){

		        			echo "registroactualizado";

		        		}else{

		        			echo "registronoactualizado";
		        		}



		        	}else{

		        		echo "cargas_academicasyaexiste";

		        	}

					
				}
			}
			else{
				echo "anolectivocerrado";
			}    
                
        }else{
            
            echo "digite valor numerico para identificar una carga_academica";
        }




    }

   
    public function llenarcombo_asignaturas(){

    	$id_curso =$this->input->post('id_curso');
    	$id_grado = $this->cargas_academicas_model->obtener_gradoPorcurso($id_curso);

    	$consulta = $this->cargas_academicas_model->llenar_asignaturas($id_grado);
    	echo json_encode($consulta);
    }
    

    public function llenarcombo_profesores(){

    	$consulta = $this->cargas_academicas_model->llenar_profesores();
    	echo json_encode($consulta);
    }


    public function llenarcombo_cursos(){

    	$consulta = $this->cargas_academicas_model->llenar_cursos();
    	echo json_encode($consulta);
    }
    

    //Esta funcion me permite obtener la carga academica asignada a un profesor en el respectivo año lectivo
    public function mostrarcargas_academicasprofesor(){

		$id =$this->input->post('id_buscar'); 
		$id_profesor = $this->input->post('id_persona');
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'cargas_academicas' => $this->cargas_academicas_model->buscar_cargas_academicasprofesor($id,$id_profesor,$inicio,$cantidad),

		    'totalregistros' => count($this->cargas_academicas_model->buscar_cargas_academicasprofesor($id,$id_profesor)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


}