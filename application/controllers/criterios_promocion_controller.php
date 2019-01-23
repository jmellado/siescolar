<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Criterios_promocion_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('criterios_promocion_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$this->template->load('roles/rol_administrador_vista', 'criterios_promocion/criterios_promocion_vista');
	}


	public function llenarcombo_criterios(){

    	$consulta = $this->criterios_promocion_model->llenar_criterios();
    	echo json_encode($consulta);
    }


    public function llenarcombo_grados(){

    	$consulta = $this->criterios_promocion_model->llenar_grados();
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas(){

    	$id_grado =$this->input->post('id_grado');

    	$consulta = $this->criterios_promocion_model->llenar_asignaturas($id_grado);
    	echo json_encode($consulta);
    }


    public function insertar(){

        $this->form_validation->set_rules('id_grado', 'Grado', 'required|numeric');
        $this->form_validation->set_rules('id_criterio', 'Criterio', 'required|numeric');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de criterios_asignados + 1 
        	$ultimo_id = $this->criterios_promocion_model->obtener_ultimo_id();

        	//obtengo el año actual 
        	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

        	$id_grado = $this->input->post('id_grado');
        	$id_criterio = $this->input->post('id_criterio');
        	$numero_areas_asignaturas = $this->input->post('numero_areas_asignaturas');
        	$porcentaje_inasistencias = $this->input->post('porcentaje_inasistencias');
        	$asignatura_especifica = $this->input->post('asignatura_especifica');

        	if ($id_criterio == 1) {
	        	$porcentaje_inasistencias = NULL;
	        	$asignatura_especifica = NULL;
	        }
	        elseif ($id_criterio == 2) {
	        	$numero_areas_asignaturas = NULL;
	        	$asignatura_especifica = NULL;
	        }
	        elseif ($id_criterio == 3) {
	        	$numero_areas_asignaturas = NULL;
	        	$porcentaje_inasistencias = NULL;
	        }

        	//array para insertar en la tabla criterios_asignados
        	$criterio_asignado = array(
        	'id_criterio_asignado' =>$ultimo_id,
        	'ano_lectivo' =>$ano_lectivo,	
			'id_grado' =>$id_grado,
			'id_criterio' =>$id_criterio,
			'numero_areas_asignaturas' =>$numero_areas_asignaturas,
			'porcentaje_inasistencias' =>$porcentaje_inasistencias,
			'asignatura_especifica' =>$asignatura_especifica);

			if ($this->criterios_promocion_model->validar_existencia($ano_lectivo,$id_grado,$id_criterio,$asignatura_especifica)){

				$respuesta=$this->criterios_promocion_model->insertar_criterio_promocion($criterio_asignado);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "criterioyaexiste";
			}

        }

	}


	public function mostrarcriterios_promocion(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'criterios_promocion' => $this->criterios_promocion_model->buscar_criterios_promocion($id,$inicio,$cantidad),

		    'totalregistros' => count($this->criterios_promocion_model->buscar_criterios_promocion($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function modificar(){

    	$id_criterio_asignado = $this->input->post('id_criterio_asignado');
    	$codigo_criterio = $this->input->post('codigo_criterio');
    	$numero_areas_asignaturas = $this->input->post('numero_areas_asignaturas');
        $porcentaje_inasistencias = $this->input->post('porcentaje_inasistencias');
        $asignatura_especifica = $this->input->post('asignatura_especifica');

        $crit = $this->criterios_promocion_model->obtener_informacion_criterio_asignado($id_criterio_asignado);
	  	$ano_lectivo = $crit[0]['ano_lectivo'];
	  	$id_grado = $crit[0]['id_grado'];
	  	$id_criterio = $crit[0]['id_criterio'];

        if ($codigo_criterio == 1) {
        	
	    	$criterio_asignado = array(
	    	'id_criterio_asignado' 		=>$id_criterio_asignado,
			'numero_areas_asignaturas' 	=>$numero_areas_asignaturas);
        }
        elseif ($codigo_criterio == 2) {

        	$criterio_asignado = array(
	    	'id_criterio_asignado' 		=>$id_criterio_asignado,
			'porcentaje_inasistencias' 	=>$porcentaje_inasistencias);
        }
        elseif ($codigo_criterio == 3) {
        	
        	$criterio_asignado = array(
	    	'id_criterio_asignado' 		=>$id_criterio_asignado,
			'asignatura_especifica' 	=>$asignatura_especifica);
        }

        if(is_numeric($id_criterio_asignado)){

        	if ($this->funciones_globales_model->ValidarEstado_AnoLectivo($ano_lectivo)){

	        	if($this->criterios_promocion_model->validar_asignatura_especifica($ano_lectivo,$id_grado,$id_criterio,$asignatura_especifica)){

	        		$respuesta=$this->criterios_promocion_model->modificar_criterio_promocion($id_criterio_asignado,$criterio_asignado);

	        		if($respuesta==true){

	        			echo "registroactualizado";

	        		}else{

	        			echo "registronoactualizado";

	        		}

	        	}
	        	else{

	        		echo "criterioyaexiste";
	        	}

	        }
	        else{

	        	echo "anolectivocerrado";
	        }

        }else{
            
            echo "digite valor numerico para identificar un Área";
        }


    }


    public function eliminar(){

	  	$id_criterio_asignado =$this->input->post('id_criterio_asignado');

	  	$crit = $this->criterios_promocion_model->obtener_informacion_criterio_asignado($id_criterio_asignado);
	  	$ano_lectivo = $crit[0]['ano_lectivo']; 

        if(is_numeric($id_criterio_asignado)){

        	if ($this->funciones_globales_model->ValidarEstado_AnoLectivo($ano_lectivo)){

		        $respuesta=$this->criterios_promocion_model->eliminar_criterio_promocion($id_criterio_asignado);
		        
	          	if($respuesta==true){
	              
	              	echo "registroeliminado";
	          	}else{
	              
	              	echo "registronoeliminado";
	          	}

	        }
	        else{

	        	echo "anolectivocerrado";
	        }
	        
        }else{
          
          	echo "digite valor numerico para identificar un Criterio";
        }
    }


}