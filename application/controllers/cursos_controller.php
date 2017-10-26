<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cursos_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('cursos_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'cursos/cursos_vista');
	}

	public function insertar(){

        $this->form_validation->set_rules('id_salon', 'salon', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('id_grado', 'grado', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('id_grupo', 'grupo', 'required|numeric|max_length[10]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de cursos + 1 
        	$ultimo_id = $this->cursos_model->obtener_ultimo_id();

        	$id_curso = $ultimo_id;
        	$id_grado = $this->input->post('id_grado');
        	$id_grupo = $this->input->post('id_grupo');
        	$id_salon = $this->input->post('id_salon');
        	$director = $this->input->post('director');
        	$cupo_maximo = $this->input->post('cupo_maximo');
        	$jornada = $this->input->post('jornada');
        	$ano_lectivo = $this->input->post('ano_lectivo');

        	//array para insertar en la tabla cursos----------
        	$curso = array(
        	'id_curso' =>$ultimo_id,	
			'id_grado' =>$id_grado,
			'id_grupo' =>$id_grupo,
			'id_salon' =>$id_salon,
			'director' =>$director,
			'cupo_maximo' =>$cupo_maximo,
			'jornada' =>$jornada,
			'ano_lectivo' =>$ano_lectivo);

			if ($this->cursos_model->validar_existencia($id_curso)){

				if ($this->cursos_model->validar_grado_grupo($id_grado,$id_grupo,$jornada,$ano_lectivo)){

					if ($this->cursos_model->validar_salon($id_salon,$jornada,$ano_lectivo)){

						if($this->cursos_model->validar_director($director,$jornada,$ano_lectivo)){

							$respuesta=$this->cursos_model->insertar_curso($curso);

							if($respuesta==true){

								echo "registroguardado";
							}
							else{

								echo "registronoguardado";
							}
						}
						else{

							echo "director ya existe";
						}
					}
					else{
						echo "salon ya existe";
					}	
				}
				else{
					echo "gradogrupo ya existe";
				}	

			}
			else{

				echo "curso ya existe";
			}

        }

	}

	public function mostrarcursos(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'cursos' => $this->cursos_model->buscar_curso($id,$inicio,$cantidad),

		    'totalregistros' => count($this->cursos_model->buscar_curso($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id_curso =$this->input->post('id'); 

	  	//Obtengo el total de estudiantes matriculados en este curso
		$total_curso_matricula = $this->cursos_model->total_cursos_matricula($id_curso);

        if(is_numeric($id_curso)){

        	if($total_curso_matricula == 0){
			
		        $respuesta=$this->cursos_model->eliminar_curso($id_curso);
		        
	          	if($respuesta==true){
	              
	              	echo "eliminado correctamente";
	          	}else{
	              
	              	echo "no se pudo eliminar";
	          	}
	        }
	        else{
	        	echo "No se Puede Eliminar Este Curso.Actualmente Tiene Alumnos Matriculados.";
	        }	
          
        }else{
          
          	echo "digite valor numerico para identificar un salon";
        }
    }

    public function modificar(){

    	$id_curso = $this->input->post('id_curso');
    	$id_grado = $this->input->post('id_grado');
    	$id_grupo = $this->input->post('id_grupo');
    	$id_salon = $this->input->post('id_salon');
    	$director = $this->input->post('director');
    	$cupo_maximo = $this->input->post('cupo_maximo');
    	$jornada = $this->input->post('jornada');
    	$ano_lectivo = $this->input->post('ano_lectivo');

    	//array para insertar en la tabla cursos----------
    	$curso = array(
    	'id_curso' =>$id_curso,	
		'id_grado' =>$id_grado,
		'id_grupo' =>$id_grupo,
		'id_salon' =>$id_salon,
		'director' =>$director,
		'cupo_maximo' =>$cupo_maximo,
		'jornada' =>$jornada,
		'ano_lectivo' =>$ano_lectivo);

    	//datos de la Bd para comparar con los recibidos del formulario
		$curs = $this->cursos_model->obtener_informacion_curso($id_curso);
		$grado_buscado = $curs[0]['id_grado'];
		$grupo_buscado = $curs[0]['id_grupo'];
		$salon_buscado = $curs[0]['id_salon'];
		$director_buscado = $curs[0]['director'];
		$cupo_buscado = $curs[0]['cupo_maximo'];
		$jornada_buscada = $curs[0]['jornada'];
		$ano_lectivo_buscado = $curs[0]['ano_lectivo'];

		//Obtengo el total de estudiantes matriculados en este curso
		$total_curso_matricula = $this->cursos_model->total_cursos_matricula($id_curso);

        if(is_numeric($id_curso)){

        	if ($director_buscado == $director && $salon_buscado == $id_salon){

        		if($cupo_maximo >= $total_curso_matricula){

		        	$respuesta=$this->cursos_model->modificar_curso($id_curso,$curso);

					 if($respuesta==true){

						echo "registro actualizado";

		             }else{

						echo "registro no se pudo actualizar";

		             }
        		}
        		else{

        			echo "El Cupo Ingresado No Satisface Los Alumnos Actualmente Matriculados En Este Curso.";
        		}

	        }
	        else{

	        	if ($salon_buscado == $id_salon){

					if($this->cursos_model->validar_director($director,$jornada,$ano_lectivo)){

						if($cupo_maximo >= $total_curso_matricula){

				        	$respuesta=$this->cursos_model->modificar_curso($id_curso,$salon_grupo);

							 if($respuesta==true){

								echo "registro actualizado";

				             }else{
								echo "registro no se pudo actualizar";
				             }
		        		}
		        		else{
		        			echo "El Cupo Ingresado No Satisface Los Alumnos Actualmente Matriculados En Este Curso.";
		        		}

					}
					else{
						echo "El Director Seleccionado Ya Tiene Asignado Un Curso";
					}
					

				}else{ 

					if ($director_buscado == $director) {

						if ($this->cursos_model->validar_salon($id_salon,$jornada,$ano_lectivo)){

							if($cupo_maximo >= $total_curso_matricula){

					        	$respuesta=$this->cursos_model->modificar_curso($id_curso,$salon_grupo);

								 if($respuesta==true){

									echo "registro actualizado";

					             }else{

									echo "registro no se pudo actualizar";

					             }
			        		}
			        		else{
			        			echo "El Cupo Ingresado No Satisface Los Alumnos Actualmente Matriculados En Este Curso.";
			        		}

							
						}
						else{
							echo "El Aula Seleccionda Ya Fue Asignada";
						}
									
					}
					else{

						if ($this->cursos_model->validar_salon($id_salon,$jornada,$ano_lectivo)){

							if($this->cursos_model->validar_director($director,$jornada,$ano_lectivo)){

								if($cupo_maximo >= $total_curso_matricula){

						        	$respuesta=$this->cursos_model->modificar_curso($id_curso,$salon_grupo);

									 if($respuesta==true){

										echo "registro actualizado";

						             }else{

										echo "registro no se pudo actualizar";

						             }
				        		}
				        		else{

				        			echo "El Cupo Ingresado No Satisface Los Alumnos Actualmente Matriculados En Este Curso.";
				        		}

							}
							else{

								echo "El Director Seleccionado Ya Tiene Asignado Un Curso";

							}
						}
						else{

							echo "El Aula Seleccionda Ya Fue Asignada";

						}

					}
				}	
			}					
			

        }else{
            
            echo "digite valor numerico para identificar un curso";
        }




    }

    public function llenarcombo_directores(){

    	$consulta = $this->cursos_model->llenar_directores();
    	echo json_encode($consulta);
    }

    

}