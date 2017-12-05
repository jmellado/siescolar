<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notificaciones_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('notificaciones_model');
		$this->load->library('form_validation');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$this->template->load('roles/rol_administrador_vista', 'notificaciones/notificaciones_vista');
	}


	public function index_profesor()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}

		$this->template->load('roles/rol_profesor_vista', 'notificaciones/notificaciones_usuarios_vista');
	}


	public function insertar(){

        $this->form_validation->set_rules('asunto', 'asunto', 'required|alpha_spaces');
        $this->form_validation->set_rules('mensaje', 'mensaje', 'required|alpha_spaces');
        $this->form_validation->set_rules('fecha_evento', 'fecha evento', 'required');
        $this->form_validation->set_rules('hora_evento', 'hora', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$fecha = $this->notificaciones_model->obtener_fecha_actual();

        	//obtengo el ultimo id de notificaciones + 1 
        	$ultimo_id = $this->notificaciones_model->obtener_ultimo_id();
        	$autor = "Siescolar";
        	$asunto = ucwords(strtolower($this->input->post('asunto')));
        	$mensaje = ucwords(strtolower($this->input->post('mensaje')));
        	$destinatario = $this->input->post('destinatario');
        	$fecha_evento = $this->input->post('fecha_evento');
        	$hora_evento = $this->input->post('hora_evento');
        	$fecha_envio = $fecha;
        	$estado = "0";

        	  //array para insertar en la tabla notificaciones----------
        	$notificacion = array(
        	'id_notificacion' =>$ultimo_id,
        	'autor' =>$autor,	
			'asunto' =>$asunto,
			'mensaje' =>$mensaje,
			'destinatario' =>$destinatario,
			'fecha_evento' =>$fecha_evento,
			'hora_evento' =>$hora_evento,
			'fecha_envio' =>$fecha,
			'estado' =>$estado);

			if ($this->notificaciones_model->validar_existencia($asunto)){

				$respuesta=$this->notificaciones_model->insertar_notificacion($notificacion);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "asunto ya existe";
			}

        }

	}

	public function mostrarnotificaciones(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'notificaciones' => $this->notificaciones_model->buscar_notificacion($id,$inicio,$cantidad),

		    'totalregistros' => count($this->notificaciones_model->buscar_notificacion($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			
	        $respuesta=$this->notificaciones_model->eliminar_notificacion($id);
	        
          	if($respuesta==true){
              
              	echo "Eliminado Correctamente";
          	}else{
              
              	echo "No Se Pudo Eliminar";
          	}
          
        }else{
          
          	echo "digite valor numerico para identificar una notificacion";
        }
    }


    public function modificar(){

    	$id_notificacion = $this->input->post('id_notificacion');
    	$asunto = ucwords(strtolower($this->input->post('asunto')));
    	$mensaje = ucwords(strtolower($this->input->post('mensaje')));
    	$destinatario = $this->input->post('destinatario');
    	$fecha_evento = $this->input->post('fecha_evento');
    	$hora_evento = $this->input->post('hora_evento');
    	$estado = "0";

    	//array para insertar en la tabla notificaciones----------
    	$notificacion = array(
    	'id_notificacion' =>$id_notificacion,	
		'asunto' =>$asunto,
		'mensaje' =>$mensaje,
		'destinatario' =>$destinatario,
		'fecha_evento' =>$fecha_evento,
		'hora_evento' =>$hora_evento,
		'estado' =>$estado);


		$notif = $this->notificaciones_model->obtener_informacion_notificacion($id_notificacion);
		$asunto_buscado = $notif[0]['asunto'];

        if(is_numeric($id_notificacion)){

        	if ($asunto_buscado == $asunto){

	        	$respuesta=$this->notificaciones_model->modificar_notificacion($id_notificacion,$notificacion);

				 if($respuesta==true){

					echo "Mensaje Actualizado";

	             }else{

					echo "El Mensaje No Se Pudo Actualizar";

	             }
	        }
	        else{

	        	if($this->notificaciones_model->validar_existencia($asunto)){

	        		$respuesta=$this->notificaciones_model->modificar_notificacion($id_notificacion,$notificacion);

	        		if($respuesta==true){

	        			echo "Mensaje Actualizado";

	        		}else{

	        			echo "El Mensaje No Se Pudo Actualizar";
	        		}



	        	}else{

	        		echo "Ya Fue Enviado Un Mensaje Con El Mismo Asunto";

	        	}

				
			}    
                
         
        }else{
            
            echo "digite valor numerico para identificar una notificacion";
        }




    }


    public function mostrarnotificaciones_usuarios(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		$rol =$this->input->post('rol');
		
		$data = array(

			'notificaciones' => $this->notificaciones_model->buscar_notificacion_usuarios($id,$rol,$inicio,$cantidad),

		    'totalregistros' => count($this->notificaciones_model->buscar_notificacion_usuarios($id,$rol)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function total_notificaciones(){

    	$rol =$this->input->post('rol'); 

    	$data = array(

		    'totalnotificaciones' => count($this->notificaciones_model->total_notificaciones($rol))

		);
	    echo json_encode($data);
    	
    }


    public function vistaprevia_notificaciones(){

    	$rol =$this->input->post('rol'); 
    	$estado = $this->notificaciones_model->actualizar_estado_notificacion();

    	if($estado){

    		$data = array(

				'notificaciones' => $this->notificaciones_model->vistaprevia_notificaciones($rol)

			);
		    echo json_encode($data);

    	}
    	else{

    		echo "error1";
    	}

    	
    	
    }


}