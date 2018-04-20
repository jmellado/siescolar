<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grados_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('grados_model');
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
		$this->template->load('roles/rol_administrador_vista', 'grados/grados_vista');
	}

	public function insertar(){

        $this->form_validation->set_rules('nombre_grado', 'nombre', 'required|alpha_spaces');
        $this->form_validation->set_rules('nivel_educacion', 'nivel de educación', 'required|alpha_spaces');
        $this->form_validation->set_rules('ano_lectivo', 'año lectivo', 'required|min_length[1]|max_length[4]');
        $this->form_validation->set_rules('estado_grado', 'estado', 'required|alpha_spaces');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de grados + 1 
        	$ultimo_id = $this->grados_model->obtener_ultimo_id();

        	//array para insertar en la tabla grados----------
        	$grado = array(
        	'id_grado' =>$ultimo_id,	
			'nombre_grado' =>ucwords($this->input->post('nombre_grado')),
			'nivel_educacion' =>$this->input->post('nivel_educacion'),
			'ano_lectivo' =>$this->input->post('ano_lectivo'),
			'estado_grado' =>$this->input->post('estado_grado'));

			if ($this->grados_model->validar_existencia($this->input->post('nombre_grado'),$this->input->post('ano_lectivo'))){

				$respuesta=$this->grados_model->insertar_grado($grado);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "gradoyaexiste";
			}

        }

	}

	public function mostrargrados(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'grados' => $this->grados_model->buscar_grado($id,$inicio,$cantidad),

		    'totalregistros' => count($this->grados_model->buscar_grado($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			if ($this->grados_model->ValidarExistencia_GradoEnCursos($id)){

				if ($this->grados_model->ValidarExistencia_GradoEnPensum($id)){

			        $respuesta=$this->grados_model->eliminar_grado($id);
			        
		          	if($respuesta==true){
		              
		              	echo "Grado Eliminado Correctamente.";
		          	}else{
		              
		              	echo "No Se Pudo Eliminar.";
		          	}
		        }
		        else{
		        	echo "No Se Puede Eliminar Este Grado; Actualmente Se Encuentra Asociado A Un Pensum.";
		        }
	        }
	        else{
	        	echo "No Se Puede Eliminar Este Grado; Actualmente Se Encuentra Asociado A Un Curso.";
	        }
          
        }else{
          
          	echo "digite valor numerico para identificar un grado";
        }
    }

    public function modificar(){

    	//array para insertar en la tabla grados----------
        $grado = array(
        'id_grado' =>$this->input->post('id_grado'),	
		'nombre_grado' =>ucwords($this->input->post('nombre_grado')),
		'nivel_educacion' =>$this->input->post('nivel_educacion'),
		'ano_lectivo' =>$this->input->post('ano_lectivo'),
		'estado_grado' =>$this->input->post('estado_grado'));

		$id = $this->input->post('id_grado');
		$nombre_buscado = $this->grados_model->obtener_nombre_grado($id);
		$ano_lectivo_buscado = $this->grados_model->obtener_ano_lectivo($id);

        if(is_numeric($id)){

        	if ($this->grados_model->ValidarExistencia_GradoEnCursos($id)){

        		if ($this->grados_model->ValidarExistencia_GradoEnPensum($id)){

		        	if ($nombre_buscado == $this->input->post('nombre_grado') && $ano_lectivo_buscado == $this->input->post('ano_lectivo')){

			        	$respuesta=$this->grados_model->modificar_grado($this->input->post('id_grado'),$grado);

						 if($respuesta==true){

							echo "registroactualizado";

			             }else{

							echo "registronoactualizado";

			             }
			        }
			        else{

			        	if($this->grados_model->validar_existencia($this->input->post('nombre_grado'),$this->input->post('ano_lectivo'))){

			        		$respuesta=$this->grados_model->modificar_grado($this->input->post('id_grado'),$grado);

			        		if($respuesta==true){

			        			echo "registroactualizado";

			        		}else{

			        			echo "registronoactualizado";
			        		}



			        	}else{

			        		echo "gradoyaexiste";

			        	}

						
					}
				}
				else{
					echo "gradoenpensum";
				}
			}
			else{
				echo "gradoencursos";
			}    
                
         
        }else{
            
            echo "digite valor numerico para identificar un grado";
        }




    }


    public function llenarcombo_niveles_educacion(){

    	$consulta = $this->grados_model->llenar_niveles();
    	echo json_encode($consulta);
    }


    public function llenarcombo_grados_educacion(){

    	$id_nivel = $this->input->post('id_nivel');
    	$consulta = $this->grados_model->llenar_gradoseducacion($id_nivel);
    	echo json_encode($consulta);
    }

    

}