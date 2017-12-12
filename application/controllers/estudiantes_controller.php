<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estudiantes_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('estudiantes_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'estudiantes/registrar');
	}

	public function index2()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'estudiantes/consultar');
	}


	public function insertar(){

		$this->form_validation->set_rules('identificacion', 'id de usuario', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('nombres', 'nombres', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1', 'primer apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2', 'segundo apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('sexo', 'sexo', 'required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('fecha_nacimiento', 'fecha de nacimiento', 'required');
        $this->form_validation->set_rules('lugar_nacimiento', 'lugar de nacimiento', 'required|alpha_spaces');
        $this->form_validation->set_rules('tipo_sangre', 'tipo de sangre', 'required');
        $this->form_validation->set_rules('eps', 'eps', 'required|alpha_spaces');
        $this->form_validation->set_rules('poblacion', 'poblacion', 'required|alpha_spaces');
        $this->form_validation->set_rules('email', 'correo', 'required|alpha_spaces');
        $this->form_validation->set_rules('direccion', 'dieccion', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'telefono', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('barrio', 'barrio', 'required|alpha_spaces');
        $this->form_validation->set_rules('institucion_procedencia', 'institucion procedencia', 'required|alpha_spaces');
        $this->form_validation->set_rules('discapacidad', 'discapacidad', 'required|alpha_spaces');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();
        }
        else{
        	//obtengo el ultimo id de persona + 1 
        	 $ultimo_id = $this->estudiantes_model->obtener_ultimo_id();

        	 //obtengo el ultimo id de padres + 1 
        	 $ultimo_id_padres = $this->estudiantes_model->obtener_ultimo_id_padres();

        	 //array para insertar en la tabla personas----------
        	$estudiante = array(
        	'id_persona' =>$ultimo_id,	
			'identificacion' =>$this->input->post('identificacion'),
			'tipo_id' =>$this->input->post('tipo_id'),
			'fecha_expedicion' =>$this->input->post('fecha_expedicion'),
			'departamento_expedicion' =>$this->input->post('departamento_expedicion'),
			'municipio_expedicion' =>$this->input->post('municipio_expedicion'),
			'nombres' =>ucwords($this->input->post('nombres')),
			'apellido1' =>ucwords($this->input->post('apellido1')),
			'apellido2' =>ucwords($this->input->post('apellido2')),
			'sexo' =>$this->input->post('sexo'),
			'fecha_nacimiento' =>$this->input->post('fecha_nacimiento'),
			'lugar_nacimiento' =>$this->input->post('lugar_nacimiento'),
			'tipo_sangre' =>$this->input->post('tipo_sangre'),
			'eps' =>ucwords($this->input->post('eps')),
			'poblacion' =>$this->input->post('poblacion'),
			'telefono' =>$this->input->post('telefono'),
			'email' =>$this->input->post('correo'),
			'direccion' =>$this->input->post('direccion'),
			'barrio' =>ucwords($this->input->post('barrio')) );

        	//array para insertar en la tabla estudiantes
			$estudiante2 = array(
			'id_persona' =>$ultimo_id,
			'institucion_procedencia' =>ucwords($this->input->post('institucion_procedencia')),
			'discapacidad' =>$this->input->post('discapacidad'));

			//aqui creamos el username de un estudiante
			$user = strtolower(substr($this->input->post('nombres'), 0, 2));
			$name = strtolower($this->input->post('apellido1'));
			$username = $user.$name.$ultimo_id;

			//array para insertar en la tabla usuarios
			$usuario = array(
			'id_usuario' =>$ultimo_id,
			'id_persona' =>$ultimo_id,
			'id_rol' => 2,
			'username' =>$username,
			'password' =>sha1($this->input->post('identificacion')),
			'acceso' =>1);

			//array de los padres - para insertar en la tabla padres
			$padres = array(
			'id_padres' =>$ultimo_id_padres,
			'id_estudiante' =>$ultimo_id,
			'identificacion_padre' =>$this->input->post('identificacion_padre'),
			'nombres_padre' =>ucwords($this->input->post('nombres_padre')),
			'apellidos_padre' =>ucwords($this->input->post('apellidos_padre')),
			'ocupacion_padre' =>ucwords($this->input->post('ocupacion_padre')),
			'telefono_padre' =>$this->input->post('telefono_padre'),
			'telefono_trabajo_padre' =>$this->input->post('telefono_trabajo_padre'),
			'direccion_trabajo_padre' =>ucwords($this->input->post('direccion_trabajo_padre')),
			'identificacion_madre' =>$this->input->post('identificacion_madre'),
			'nombres_madre' =>ucwords($this->input->post('nombres_madre')),
			'apellidos_madre' =>ucwords($this->input->post('apellidos_madre')),
			'ocupacion_madre' =>ucwords($this->input->post('ocupacion_madre')),
			'telefono_madre' =>$this->input->post('telefono_madre'),
			'telefono_trabajo_madre' =>$this->input->post('telefono_trabajo_madre'),
			'direccion_trabajo_madre' =>ucwords($this->input->post('direccion_trabajo_madre')));


			if ($this->estudiantes_model->validar_existencia($this->input->post('identificacion'))){

				$respuesta=$this->estudiantes_model->insertar_estudiante($estudiante,$estudiante2,$usuario,$padres);
				

				if($respuesta==true){

					echo "registroguardado";

				}
				else{
					echo "registronoguardado";
				}


			}
			else{

				echo "estudianteyaexiste";
			}



        }
        

	}

	public function mostrarestudiantes(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		//---------FORMA PARA JSON ARRAY---------
		//$consulta = $data['buscado'] = $this->estudiantes_model->buscar_estudiante($id);
		
		//---------FORMA PARA JSON OBJECTH---------
		$data = array(

			'estudiantes' => $this->estudiantes_model->buscar_estudiante($id,$inicio,$cantidad),

		    'totalregistros' => count($this->estudiantes_model->buscar_estudiante($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function modificar(){

		//array para actualizar en la tabla personas----------
		$estudiante = array(
    	'id_persona' =>$this->input->post('id_persona'),	
		'identificacion' =>$this->input->post('identificacion'),
		'tipo_id' =>$this->input->post('tipo_id'),
		'fecha_expedicion' =>$this->input->post('fecha_expedicion'),
		'departamento_expedicion' =>$this->input->post('departamento_expedicion'),
		'municipio_expedicion' =>$this->input->post('municipio_expedicion'),
		'nombres' =>ucwords($this->input->post('nombres')),
		'apellido1' =>ucwords($this->input->post('apellido1')),
		'apellido2' =>ucwords($this->input->post('apellido2')),
		'sexo' =>$this->input->post('sexo'),
		'fecha_nacimiento' =>$this->input->post('fecha_nacimiento'),
		'lugar_nacimiento' =>$this->input->post('lugar_nacimiento'),
		'tipo_sangre' =>$this->input->post('tipo_sangre'),
		'eps' =>ucwords($this->input->post('eps')),
		'poblacion' =>$this->input->post('poblacion'),
		'telefono' =>$this->input->post('telefono'),
		'email' =>$this->input->post('correo'),
		'direccion' =>$this->input->post('direccion'),
		'barrio' =>ucwords($this->input->post('barrio')) );

		//array para actualizar en la tabla estudiantes----------
		$estudiante2 = array(
		'id_persona' =>$this->input->post('id_persona'),
		'institucion_procedencia' =>ucwords($this->input->post('institucion_procedencia')),
		'discapacidad' =>$this->input->post('discapacidad'));

		//aqui creamos el username de un estudiante
		$id_persona = $this->input->post('id_persona');
		$user = strtolower(substr($this->input->post('nombres'), 0, 2));
		$name = strtolower($this->input->post('apellido1'));
		$username = $user.$name.$id_persona;

		//array para actualizar en la tabla usuarios----------	
		$usuario = array(
		'id_usuario' =>$this->input->post('id_persona'),
		'id_persona' =>$this->input->post('id_persona'),
		'id_rol' => 2,
		'username' =>$username,
		'password' =>sha1($this->input->post('identificacion')),
		'acceso' =>1);

		//array de los padres - para insertar en la tabla padres
		$padres = array(
		'id_estudiante' =>$this->input->post('id_persona'),
		'identificacion_padre' =>$this->input->post('identificacion_padre'),
		'nombres_padre' =>ucwords($this->input->post('nombres_padre')),
		'apellidos_padre' =>ucwords($this->input->post('apellidos_padre')),
		'ocupacion_padre' =>ucwords($this->input->post('ocupacion_padre')),
		'telefono_padre' =>$this->input->post('telefono_padre'),
		'telefono_trabajo_padre' =>$this->input->post('telefono_trabajo_padre'),
		'direccion_trabajo_padre' =>ucwords($this->input->post('direccion_trabajo_padre')),
		'identificacion_madre' =>$this->input->post('identificacion_madre'),
		'nombres_madre' =>ucwords($this->input->post('nombres_madre')),
		'apellidos_madre' =>ucwords($this->input->post('apellidos_madre')),
		'ocupacion_madre' =>ucwords($this->input->post('ocupacion_madre')),
		'telefono_madre' =>$this->input->post('telefono_madre'),
		'telefono_trabajo_madre' =>$this->input->post('telefono_trabajo_madre'),
		'direccion_trabajo_madre' =>ucwords($this->input->post('direccion_trabajo_madre')));
		


    	$id = $this->input->post('identificacion');
        if(is_numeric($id)){
          
                $respuesta=$this->estudiantes_model->modificar_estudiante($this->input->post('id_persona'),$estudiante);
                $respuesta2=$this->estudiantes_model->modificar_estudiante2($this->input->post('id_persona'),$estudiante2); 
                $respuesta3=$this->estudiantes_model->modificar_usuario($this->input->post('id_persona'),$usuario);
                $respuesta4=$this->estudiantes_model->modificar_padres($this->input->post('id_persona'),$padres);    
                if($respuesta==true && $respuesta2==true && $respuesta3==true){
                    
                    echo "registro actualizado";
                }else{
                   
                	echo "registro no se pudo actualizar";
                }
                //redirect(base_url());
         
        }else{
            
            echo "digite valor numerico para la cedula";
        }
    }

    public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			
	        $respuesta=$this->estudiantes_model->eliminar_estudiante($id);
	        	
          	if($respuesta==true){
              
              	echo "eliminado correctamente";
          	}else{
              
              	echo "no se pudo eliminar";
          	}
          //redirect(base_url());
        }else{
          
          	echo "digite valor numerico para la cedula";
        }
    }

    public function llenarcombo_departamentos(){

    	$consulta = $this->estudiantes_model->llenar_departamentos();
    	echo json_encode($consulta);
    }

    public function llenarcombo_municipios(){

    	$id =$this->input->post('id');
    	$consulta = $this->estudiantes_model->llenar_municipios($id);
    	echo json_encode($consulta);
    }





	
}