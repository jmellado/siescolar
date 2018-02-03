<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbox_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('inbox_model');
		$this->load->library('form_validation');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_profesor_vista', 'inbox/inbox_vista');
	}


	public function mostrarestudiantes(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;

		$id_curso = $this->input->post('id_curso');
		
		$data = array(

			'estudiantes' => $this->inbox_model->buscar_estudiante($id,$id_curso,$inicio,$cantidad),

		    'totalregistros' => count($this->inbox_model->buscar_estudiante($id,$id_curso,$inicio,$cantidad)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function insertar_mensajes(){

		$this->form_validation->set_rules('remitente', 'Remitente', 'required');
        $this->form_validation->set_rules('titulo', 'Titulo', 'required|alpha_spaces');
        $this->form_validation->set_rules('contenido', 'Contenido', 'required|alpha_spaces');
        $this->form_validation->set_rules('total_destinatario', 'Destinatario', 'required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$fecha = $this->inbox_model->obtener_fecha_actual();

        	//obtengo el ultimo id de notificaciones + 1 
        	$ultimo_id = $this->inbox_model->obtener_ultimo_id();
        	$categoria_notificacion = "Mensajes";
        	$remitente = $this->input->post('remitente');
        	$titulo = ucwords(strtolower($this->input->post('titulo')));
        	$tipo_notificacion = $this->input->post('tipo');
        	$contenido = ucwords(strtolower($this->input->post('contenido')));
        	$destinatario = $this->input->post('destinatario');
        	$rol_destinatario = "4";
        	$id_asignatura = $this->input->post('id_asignatura_destinatario');
        	$fecha_envio = $fecha;
        	$estado_lectura = "0";

        	if ($destinatario != "") {
        		
        		$respuesta = $this->inbox_model->insertar_mensajes($ultimo_id,$categoria_notificacion,$remitente,$titulo,$tipo_notificacion,$contenido,$destinatario,$rol_destinatario,$id_asignatura,$fecha_envio,$estado_lectura);

        		if($respuesta == true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}


        	}
        	else{

        		echo "nohaydestinatarios";
        	}



        }

    }


    public function insertar_tareas(){

		$this->form_validation->set_rules('remitente', 'Remitente', 'required');
        $this->form_validation->set_rules('titulo', 'Titulo', 'required|alpha_spaces');
        $this->form_validation->set_rules('contenido', 'Contenido', 'required|alpha_spaces');
        $this->form_validation->set_rules('total_destinatario', 'Destinatario', 'required');
        $this->form_validation->set_rules('fecha_limite', 'Fecha Limite', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$fecha = $this->inbox_model->obtener_fecha_actual();

        	//obtengo el ultimo id de notificaciones + 1 
        	$ultimo_id = $this->inbox_model->obtener_ultimo_id();
        	$categoria_notificacion = "Tareas";
        	$remitente = $this->input->post('remitente');
        	$titulo = ucwords(strtolower($this->input->post('titulo')));
        	$contenido = ucwords(strtolower($this->input->post('contenido')));
        	$destinatario = $this->input->post('destinatario');
        	$rol_destinatario = "4";
        	$id_asignatura = $this->input->post('id_asignatura_destinatario');
        	$fecha_limite = $this->input->post('fecha_limite');
        	$fecha_envio = $fecha;
        	$estado_lectura = "0";

        	if ($destinatario != "") {
        		
        		$respuesta = $this->inbox_model->insertar_tareas($ultimo_id,$categoria_notificacion,$remitente,$titulo,$contenido,$destinatario,$rol_destinatario,$id_asignatura,$fecha_limite,$fecha_envio,$estado_lectura);

        		if($respuesta == true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}


        	}
        	else{

        		echo "nohaydestinatarios";
        	}



        }

    }  


    public function insertar_eventos(){

		$this->form_validation->set_rules('remitente', 'Remitente', 'required');
        $this->form_validation->set_rules('titulo', 'Titulo', 'required|alpha_spaces');
        $this->form_validation->set_rules('contenido', 'Contenido', 'required|alpha_spaces');
        $this->form_validation->set_rules('total_destinatario', 'Destinatario', 'required');
        $this->form_validation->set_rules('fecha_inicio', 'Fecha De Inicio', 'required');
        $this->form_validation->set_rules('hora_inicio', 'Hora De Inicio', 'required');
        $this->form_validation->set_rules('fecha_fin', 'Fecha Final', 'required');
        $this->form_validation->set_rules('hora_fin', 'Hora Final', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$fecha = $this->inbox_model->obtener_fecha_actual();

        	//obtengo el ultimo id de notificaciones + 1 
        	$ultimo_id = $this->inbox_model->obtener_ultimo_id();
        	$categoria_notificacion = "Eventos";
        	$remitente = $this->input->post('remitente');
        	$titulo = ucwords(strtolower($this->input->post('titulo')));
        	$contenido = ucwords(strtolower($this->input->post('contenido')));
        	$destinatario = $this->input->post('destinatario');
        	$rol_destinatario = "4";
        	$id_asignatura = $this->input->post('id_asignatura_destinatario');
        	$fecha_inicio = $this->input->post('fecha_inicio');
        	$hora_inicio = $this->input->post('hora_inicio');
        	$fecha_fin = $this->input->post('fecha_fin');
        	$hora_fin = $this->input->post('hora_fin');
        	$fecha_envio = $fecha;
        	$estado_lectura = "0";

        	if ($destinatario != "") {
        		
        		$respuesta = $this->inbox_model->insertar_eventos($ultimo_id,$categoria_notificacion,$remitente,$titulo,$contenido,$destinatario,$rol_destinatario,$id_asignatura,$fecha_inicio,$hora_inicio,$fecha_fin,$hora_fin,$fecha_envio,$estado_lectura);

        		if($respuesta == true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}


        	}
        	else{

        		echo "nohaydestinatarios";
        	}



        }

    }


}