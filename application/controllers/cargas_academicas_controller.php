<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cargas_academicas_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('cargas_academicas_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		//$this->load->view('estudiantes/registrar2');
		$this->template->load('roles/rol_administrador_vista', 'cargas_academicas/cargas_academicas_vista');
	}

	public function insertar(){

		$this->form_validation->set_rules('id_profesor', 'profesor', 'required|numeric');
        $this->form_validation->set_rules('id_grado', 'grado', 'required|numeric');
        $this->form_validation->set_rules('id_asignatura', 'asignatura', 'required|numeric');
        $this->form_validation->set_rules('id_grupo', 'grupo', 'required|numeric');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de cargas academicas + 1 
        	 $ultimo_id = $this->cargas_academicas_model->obtener_ultimo_id();

        	  //array para insertar en la tabla cargas academicas----------
        	$cargas_academicas = array(
        	'id_carga_academica' =>$ultimo_id,
        	'id_profesor' =>$this->input->post('id_profesor'),	
			'id_grado' =>$this->input->post('id_grado'),
			'id_asignatura' =>$this->input->post('id_asignatura'),
			'id_grupo' =>$this->input->post('id_grupo'),
			'ano_lectivo' =>$this->input->post('ano_lectivo'));

			if ($this->cargas_academicas_model->validar_existencia($this->input->post('id_grado'),$this->input->post('id_asignatura'),$this->input->post('id_grupo'),$this->input->post('ano_lectivo'))){

				$respuesta=$this->cargas_academicas_model->insertar_cargas_academicas($cargas_academicas);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "cargas_academicas ya existe";
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

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			
	        $respuesta=$this->cargas_academicas_model->eliminar_cargas_academicas($id);
	        
          	if($respuesta==true){
              
              	echo "eliminado correctamente";
          	}else{
              
              	echo "no se pudo eliminar";
          	}
          
        }else{
          
          	echo "digite valor numerico para identificar una carga_academica";
        }
    }

    public function modificar(){

    	//array para insertar en la tabla cargas_academicas----------
        $cargas_academicas = array(
        'id_carga_academica' =>$this->input->post('id_carga_academica'),
        'id_profesor' =>$this->input->post('id_profesor'),	
		'id_grado' =>$this->input->post('id_grado'),
		'id_asignatura' =>$this->input->post('id_asignatura'),
		'id_grupo' =>$this->input->post('id_grupo'),
		'ano_lectivo' =>$this->input->post('ano_lectivo'));

		$id = $this->input->post('id_carga_academica');
		$row = $this->cargas_academicas_model->obtener_cargas_academicas($id);

		$grado_buscado = $row[0]['id_grado'];
		$asignatura_buscada = $row[0]['id_asignatura'];
		$grupo_buscado = $row[0]['id_grupo'];
		$ano_lectivo_buscado = $row[0]['ano_lectivo'];

        if(is_numeric($id)){

        	if ($grado_buscado == $this->input->post('id_grado') && $asignatura_buscada == $this->input->post('id_asignatura') && $grupo_buscado == $this->input->post('id_grupo') && $ano_lectivo_buscado == $this->input->post('ano_lectivo')){

	        	$respuesta=$this->cargas_academicas_model->modificar_cargas_academicas($this->input->post('id_carga_academica'),$cargas_academicas);

				 if($respuesta==true){

					echo "registro actualizado";

	             }else{

					echo "registro no se pudo actualizar";

	             }
	        }
	        else{

	        	if($this->cargas_academicas_model->validar_existencia($this->input->post('id_grado'),$this->input->post('id_asignatura'),$this->input->post('id_grupo'),$this->input->post('ano_lectivo'))){

	        		$respuesta=$this->cargas_academicas_model->modificar_cargas_academicas($this->input->post('id_carga_academica'),$cargas_academicas);

	        		if($respuesta==true){

	        			echo "registro actualizado";

	        		}else{

	        			echo "registro no se pudo actualizar";
	        		}



	        	}else{

	        		echo "Carga Academica Ya Asignada";

	        	}

				
			}    
                
         
        }else{
            
            echo "digite valor numerico para identificar una carga_academica";
        }




    }

   
    public function llenarcombo_asignaturas(){

    	$id =$this->input->post('id');
    	$consulta = $this->cargas_academicas_model->llenar_asignaturas($id);
    	echo json_encode($consulta);
    }
    

    public function llenarcombo_profesores(){

    	$consulta = $this->cargas_academicas_model->llenar_profesores();
    	echo json_encode($consulta);
    }


}