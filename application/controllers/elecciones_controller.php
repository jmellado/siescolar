<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elecciones_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('elecciones_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'elecciones/elecciones_vista');
	}


	public function candidatos()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'elecciones/candidatos_vista');
	}


	public function votantes()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'elecciones/votantes_vista');
	}


	public function insertar_eleccion(){

        $this->form_validation->set_rules('nombre_eleccion', 'Nombre', 'required|alpha_spaces');
        $this->form_validation->set_rules('descripcion_eleccion', 'Descripcion', 'required|alpha_spaces');
        $this->form_validation->set_rules('fecha_inicio', 'Fecha De Inicio', 'required');
        $this->form_validation->set_rules('hora_inicio', 'Hora De Inicio', 'required');
        $this->form_validation->set_rules('fecha_fin', 'Fecha Final', 'required');
        $this->form_validation->set_rules('hora_fin', 'Hora Final', 'required');
        $this->form_validation->set_rules('estado_eleccion', 'Estado', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de elecciones + 1 
        	$id_eleccion = $this->elecciones_model->obtener_ultimo_id();

        	$nombre_eleccion = ucwords(strtolower($this->input->post('nombre_eleccion')));
        	$descripcion = ucwords(strtolower($this->input->post('descripcion_eleccion')));
        	$fecha_inicio = $this->input->post('fecha_inicio');
        	$hora_inicio = $this->input->post('hora_inicio');
        	$fecha_fin = $this->input->post('fecha_fin');
        	$hora_fin = $this->input->post('hora_fin');
        	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
        	$estado_eleccion = $this->input->post('estado_eleccion');


        	//array para insertar en la tabla elecciones
        	$eleccion = array(
        	'id_eleccion' =>$id_eleccion,	
			'nombre_eleccion' =>$nombre_eleccion,
			'descripcion' =>$descripcion,
			'fecha_inicio' =>$fecha_inicio,
			'hora_inicio' =>$hora_inicio,
			'fecha_fin' =>$fecha_fin,
			'hora_fin' =>$hora_fin,
			'ano_lectivo' =>$ano_lectivo,
			'estado_eleccion' =>$estado_eleccion);

			if ($this->elecciones_model->validar_existencia($nombre_eleccion,$ano_lectivo)){

				$respuesta=$this->elecciones_model->insertar_eleccion($eleccion);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "eleccionyaexiste";
			}


        }

    }


    public function mostrarelecciones(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'elecciones' => $this->elecciones_model->buscar_eleccion($id,$inicio,$cantidad),

		    'totalregistros' => count($this->elecciones_model->buscar_eleccion($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}



	public function eliminar_eleccion(){

	  	$id_eleccion =$this->input->post('id'); 

        if(is_numeric($id_eleccion)){

			if($this->elecciones_model->validar_eleccion_candidatos($id_eleccion)){

		        $respuesta=$this->elecciones_model->eliminar_eleccion($id_eleccion);
		        
	          	if($respuesta==true){
	              
	              	echo "Elección Eliminada Correctamente.";
	          	}else{
	              
	              	echo "No Se Pudo Eliminar.";
	          	}
	        }
	        else{
	        	echo "No Se Puede Eliminar; Existen Candidatos Registrados En Esta Elección.";
	        }  	
          
        }else{
          
          	echo "digite valor numerico para identificar una eleccion";
        }
    }



    public function modificar_eleccion(){


    	$id_eleccion = $this->input->post('id_eleccion');
    	$nombre_eleccion = ucwords(strtolower($this->input->post('nombre_eleccion')));
    	$descripcion = ucwords(strtolower($this->input->post('descripcion_eleccion')));
    	$fecha_inicio = $this->input->post('fecha_inicio');
    	$hora_inicio = $this->input->post('hora_inicio');
    	$fecha_fin = $this->input->post('fecha_fin');
    	$hora_fin = $this->input->post('hora_fin');
    	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
    	$estado_eleccion = $this->input->post('estado_eleccion');

    	//array para modificar en la tabla elecciones
        $eleccion = array(
    	'id_eleccion' =>$id_eleccion,	
		'nombre_eleccion' =>$nombre_eleccion,
		'descripcion' =>$descripcion,
		'fecha_inicio' =>$fecha_inicio,
		'hora_inicio' =>$hora_inicio,
		'fecha_fin' =>$fecha_fin,
		'hora_fin' =>$hora_fin,
		'estado_eleccion' =>$estado_eleccion);

		$elecciones = $this->elecciones_model->obtener_informacion_eleccion($id_eleccion);
		$nombre_buscado = $elecciones[0]['nombre_eleccion'];
		
        if(is_numeric($id_eleccion)){

        	if ($nombre_buscado == $nombre_eleccion){

	        	$respuesta=$this->elecciones_model->modificar_eleccion($id_eleccion,$eleccion);

				 if($respuesta==true){

					echo "registroactualizado";

	             }else{

					echo "registronoactualizado";

	             }
	        }
	        else{

	        	if($this->elecciones_model->validar_existencia($nombre_eleccion,$ano_lectivo)){

	        		$respuesta=$this->elecciones_model->modificar_eleccion($id_eleccion,$eleccion);

	        		if($respuesta==true){

	        			echo "registroactualizado";

	        		}else{

	        			echo "registronoactualizado";
	        		}



	        	}else{

	        		echo "eleccionyaexiste";

	        	}

				
			}    
                
         
        }else{
            
            echo "digite valor numerico para identificar una eleccion";
        }




    }

    //****************************************************** FUNCIONES PARA CANDIDATOS ***************************************************

    public function insertar_candidato(){

        $this->form_validation->set_rules('id_eleccion', 'Eleccion', 'required');
        $this->form_validation->set_rules('id_candidato', 'Candidato', 'required');
        $this->form_validation->set_rules('partido', 'Partipo', 'required');
        $this->form_validation->set_rules('numero', 'Número Tarjetón', 'required|numeric');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$id_eleccion = $this->input->post('id_eleccion');
        	$id_candidato = $this->input->post('id_candidato');
        	$partido = ucwords(strtolower($this->input->post('partido')));
        	$numero = $this->input->post('numero');
        	$estado_candidato = "Activo";


        	//array para insertar en la tabla candidatos
        	$candidato = array(
        	'id_eleccion' =>$id_eleccion,	
			'id_estudiante' =>$id_candidato,
			'numero' =>$numero,
			'partido' =>$partido,
			'estado_candidato' =>$estado_candidato);
        	
			if ($this->elecciones_model->validar_existencia_candidato($id_candidato,$id_eleccion)){

				if ($this->elecciones_model->validar_existencia_numerocandidato($id_eleccion,$numero)){

					$respuesta=$this->elecciones_model->insertar_candidato($candidato);

					if($respuesta==true){

						echo "registroguardado";
					}
					else{

						echo "registronoguardado";
					}
				}
				else{
					echo "numeroyaexiste";
				}

			}
			else{

				echo "candidatoyaexiste";
			}


        }

    }


    public function mostrarcandidatos(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'candidatos' => $this->elecciones_model->buscar_candidato($id,$inicio,$cantidad),

		    'totalregistros' => count($this->elecciones_model->buscar_candidato($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function eliminar_candidato(){

	  	$id_candidato_eleccion =$this->input->post('id'); 

        if(is_numeric($id_candidato_eleccion)){

			if($this->elecciones_model->validar_votos_candidato($id_candidato_eleccion)){

		        $respuesta=$this->elecciones_model->eliminar_candidato($id_candidato_eleccion);
		        
	          	if($respuesta==true){
	              
	              	echo "Candidato Eliminado Correctamente.";
	          	}else{
	              
	              	echo "No Se Pudo Eliminar.";
	          	}
	        }
	        else{
	        	echo "No Se Puede Eliminar; Existen Votos Registrados Para Este Candidato.";
	        }  	
          
        }else{
          
          	echo "digite valor numerico para identificar un candidao a elección";
        }
    }


	public function modificar_candidato(){


    	$id_candidato_eleccion = $this->input->post('id_candidato_eleccion');
    	$partido = ucwords(strtolower($this->input->post('partido')));
        $numero = $this->input->post('numero');

    	//array para modificar en la tabla candidatos
        $candidato = array(
        'numero' =>$numero,
    	'partido' =>$partido);

		$candidatos = $this->elecciones_model->obtener_informacion_candidato($id_candidato_eleccion);
		$numero_buscado = $candidatos[0]['numero'];
		$eleccion_buscada = $candidatos[0]['id_eleccion'];
		
        if(is_numeric($id_candidato_eleccion)){

        	if ($numero_buscado == $numero){

	        	$respuesta=$this->elecciones_model->modificar_candidato($id_candidato_eleccion,$candidato);

				 if($respuesta==true){

					echo "registroactualizado";

	             }else{

					echo "registronoactualizado";

	             }
	        }
	        else{

	        	if ($this->elecciones_model->validar_existencia_numerocandidato($eleccion_buscada,$numero)){

	        		$respuesta=$this->elecciones_model->modificar_candidato($id_candidato_eleccion,$candidato);

	        		if($respuesta==true){

	        			echo "registroactualizado";

	        		}else{

	        			echo "registronoactualizado";
	        		}


	        	}else{

	        		echo "numeroyaexiste";

	        	}

				
			}    
                
         
        }else{
            
            echo "digite valor numerico para identificar un candidato a eleccion";
        }

    }


    public function llenarcombo_elecciones(){

    	$consulta = $this->elecciones_model->llenar_elecciones();
    	echo json_encode($consulta);
    }


    public function mostrarestudiantes_matriculados(){

    	$id =$this->input->post('id_buscar'); 
    	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		
		$data = array(

			'estudiantes' => $this->elecciones_model->buscar_estudiantes_matriculados($id,$ano_lectivo)

		);
	    echo json_encode($data);


	}


	//****************************************************** FUNCIONES PARA VOTANTES ***************************************************

	public function insertar_votante(){

        $this->form_validation->set_rules('id_eleccion', 'Eleccion', 'required');
        $this->form_validation->set_rules('id_curso', 'Cursos', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$id_eleccion = $this->input->post('id_eleccion');
        	$cursos = $this->input->post('id_curso');

        	if ($cursos != "") {
        		
        		$respuesta=$this->elecciones_model->insertar_votante($id_eleccion,$cursos);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}
        	}
        	else{

        		echo "nohaycursos";
        	}


        }

    }


    public function mostrarvotantes(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'votantes' => $this->elecciones_model->buscar_votante($id,$inicio,$cantidad),

		    'totalregistros' => count($this->elecciones_model->buscar_votante($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function eliminar_votante(){

	  	$id_eleccion =$this->input->post('id'); 

        if(is_numeric($id_eleccion)){

			if($this->elecciones_model->validar_votos_eleccion($id_eleccion)){

		        $respuesta=$this->elecciones_model->eliminar_votante($id_eleccion);
		        
	          	if($respuesta==true){
	              
	              	echo "Elección Eliminada Correctamente.";
	          	}else{
	              
	              	echo "No Se Pudo Eliminar.";
	          	}
	        }
	        else{
	        	echo "No Se Puede Eliminar; Existen Votos Registrados Para Esta Eleccion.";
	        }  	
          
        }else{
          
          	echo "digite valor numerico para identificar una elección";
        }
    }


    public function mostrarcursos_votantes(){

		$id = $this->input->post('id_buscar'); 
		
		$data = array(

			'votantes' => $this->elecciones_model->buscar_curso_votante($id)

		);
	    echo json_encode($data);

	}


	public function eliminarcurso_votante(){

	  	$id_eleccion =$this->input->post('id');
	  	$id_curso =$this->input->post('id_curso');

        if(is_numeric($id_eleccion)){

			if($this->elecciones_model->validar_votos_eleccion($id_eleccion)){

		        $respuesta=$this->elecciones_model->eliminarcurso_votante($id_eleccion,$id_curso);
		        
	          	if($respuesta==true){
	              
	              	echo "Curso Votante Eliminado Correctamente.";
	          	}else{
	              
	              	echo "No Se Pudo Eliminar.";
	          	}
	        }
	        else{
	        	echo "No Se Puede Eliminar; Existen Votos Registrados Para Esta Eleccion.";
	        }  	
          
        }else{
          
          	echo "digite valor numerico para identificar una elección";
        }
    }


	public function llenarcombo_cursos(){

    	$consulta = $this->elecciones_model->llenar_cursos();
    	echo json_encode($consulta);
    }

}