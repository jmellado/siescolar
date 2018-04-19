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


    public function index_estudiante()
    {

        if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'estudiante')
        {
            redirect(base_url().'login_controller');
        }

        $this->template->load('roles/rol_estudiante_vista', 'notificaciones/notificaciones_usuarios_vista');
    }


    public function index_acudiente()
    {

        if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'acudiente')
        {
            redirect(base_url().'login_controller');
        }

        $this->template->load('roles/rol_acudiente_vista', 'notificaciones/notificaciones_usuarios_vista');
    }


	public function insertar(){

		$this->form_validation->set_rules('rol_destinatario', 'Destinatario', 'required');
        $this->form_validation->set_rules('titulo', 'Titulo', 'required|alpha_spaces');
        $this->form_validation->set_rules('contenido', 'Contenido', 'required|alpha_spaces');
        $this->form_validation->set_rules('tipo', 'Tipo', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$fecha = $this->notificaciones_model->obtener_fecha_actual();

        	//obtengo el ultimo id de notificaciones + 1 
        	$ultimo_id = $this->notificaciones_model->obtener_ultimo_id();
        	$categoria_notificacion = "Mensajes";
        	$remitente = $this->input->post('remitente');
        	$titulo = ucwords(strtolower($this->input->post('titulo')));
        	$tipo_notificacion = $this->input->post('tipo');
        	$contenido = ucwords(strtolower($this->input->post('contenido')));
        	$rol_destinatario = $this->input->post('rol_destinatario');
        	$fecha_envio = $fecha;
        	$estado_lectura = "0";

        	$estudiantes = $this->notificaciones_model->obtener_estudiantes();
        	$acudientes = $this->notificaciones_model->obtener_acudientes();
        	$profesores = $this->notificaciones_model->obtener_profesores();

        	if ($rol_destinatario == "1") {     //Estudiantes y Acudientes

        		if ($estudiantes != false && $acudientes != false) {
        		
	        		$respuesta = $this->notificaciones_model->insertar_notificacion($ultimo_id,$categoria_notificacion,$remitente,$titulo,$tipo_notificacion,$contenido,$rol_destinatario,$fecha_envio,$estado_lectura);

	        		if($respuesta == true){

						echo "registroguardado";

                        //*Enviar Notificacion Via Firebase A Los Acudientes Conectados En La App Movil *
                        $respuesta_firebase = $this->notificaciones_model->enviar_notificacionFirebase($titulo,$contenido);
					}
					else{

						echo "registronoguardado";
					}
				}
				else{
					echo "no-e-a";
				}

        		
        	}
        	elseif ($rol_destinatario == "2") {   //Profesores


        		if ($profesores != false) {
        			
        			$respuesta = $this->notificaciones_model->insertar_notificacion($ultimo_id,$categoria_notificacion,$remitente,$titulo,$tipo_notificacion,$contenido,$rol_destinatario,$fecha_envio,$estado_lectura);

        			if($respuesta==true){

						echo "registroguardado";
					}
					else{

						echo "registronoguardado";
					}

        		}
        		else{

        			echo "no-p";
        		}

        		
        	}
        	elseif ($rol_destinatario == "3") {   //Estudiantes, Acudientes y Profesores

        		if ($estudiantes != false && $acudientes != false && $profesores != false) {

        			$respuesta = $this->notificaciones_model->insertar_notificacion($ultimo_id,$categoria_notificacion,$remitente,$titulo,$tipo_notificacion,$contenido,$rol_destinatario,$fecha_envio,$estado_lectura);

        			if($respuesta==true){

						echo "registroguardado";

                        //*Enviar Notificacion Via Firebase A Los Acudientes Conectados En La App Movil *
                        $respuesta_firebase = $this->notificaciones_model->enviar_notificacionFirebase($titulo,$contenido);
					}
					else{

						echo "registronoguardado";
					}
        		}
        		elseif ($estudiantes != false && $acudientes != false && $profesores == false) {
        			
        			$respuesta = $this->notificaciones_model->insertar_notificacion($ultimo_id,$categoria_notificacion,$remitente,$titulo,$tipo_notificacion,$contenido,$rol_destinatario,$fecha_envio,$estado_lectura);

        			if($respuesta==true){

						echo "registroguardado-ea";

                        //*Enviar Notificacion Via Firebase A Los Acudientes Conectados En La App Movil *
                        $respuesta_firebase = $this->notificaciones_model->enviar_notificacionFirebase($titulo,$contenido);
					}
					else{

						echo "registronoguardado";
					}
        		}
        		elseif ($estudiantes == false && $acudientes == false && $profesores != false) {
        			
        			$respuesta = $this->notificaciones_model->insertar_notificacion($ultimo_id,$categoria_notificacion,$remitente,$titulo,$tipo_notificacion,$contenido,$rol_destinatario,$fecha_envio,$estado_lectura);

        			if($respuesta==true){

						echo "registroguardado-p";
					}
					else{

						echo "registronoguardado";
					}
        		}
        		else{

        			echo "no-e-a-p";
        		}
        		
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

    	$codigo_notificacion = $this->input->post('codigo_notificacion');
    	$titulo = ucwords(strtolower($this->input->post('titulo')));
    	$tipo_notificacion = $this->input->post('tipo');
    	$contenido = ucwords(strtolower($this->input->post('contenido')));
    	$estado_lectura = "0";

    	//array para insertar en la tabla notificaciones----------
    	$notificacion = array(
    	'codigo_notificacion' =>$codigo_notificacion,	
		'titulo' =>$titulo,
		'tipo_notificacion' =>$tipo_notificacion,
		'contenido' =>$contenido,
		'estado_lectura' =>$estado_lectura);


        if(is_numeric($codigo_notificacion)){

        	$respuesta=$this->notificaciones_model->modificar_notificacion($codigo_notificacion,$notificacion);

			if($respuesta==true){

				echo "Mensaje Actualizado";

            }else{

				echo "El Mensaje No Se Pudo Actualizar";

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
		$id_persona =$this->input->post('id_persona');
		
		$data = array(

			'notificaciones' => $this->notificaciones_model->buscar_notificacion_usuarios($id,$rol,$id_persona,$inicio,$cantidad),

		    'totalregistros' => count($this->notificaciones_model->buscar_notificacion_usuarios($id,$rol,$id_persona)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function total_notificaciones(){

    	$rol =$this->input->post('rol');
    	$id_persona =$this->input->post('id_persona'); 

    	$data = array(

		    'totalnotificaciones' => count($this->notificaciones_model->total_notificaciones($rol,$id_persona))

		);
	    echo json_encode($data);
    	
    }


    public function vistaprevia_notificaciones(){

    	$rol =$this->input->post('rol');
    	$id_persona =$this->input->post('id_persona'); 
    	$estado = $this->notificaciones_model->actualizar_estado_notificacion($rol,$id_persona);

    	if($estado){

    		$data = array(

				'notificaciones' => $this->notificaciones_model->vistaprevia_notificaciones($rol,$id_persona)

			);
		    echo json_encode($data);

    	}
    	else{

    		echo "error1";
    	}

    	
    	
    }


}