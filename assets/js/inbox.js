$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	
	id_persona = $("#id_persona").val();

	$("#btn_buscar_destinatario_m").click(function(){

		$("#modal_agregar_destinatario_m").modal();
		llenarcombo_cursos_profesorI(id_persona);
       
    });

    $("#id_cursoI").change(function(){
    	id_curso = $(this).val();
    	id_persona = $("#id_persona").val();
 
    	llenarcombo_asignaturas_profesorI(id_persona,id_curso);

    	mostrarestudiantesI("","","","");
    	$("#paginacion_estudianteI").hide();
    	$("#check_todos").prop('checked',0);
    });

    $("#id_asignaturaI").change(function(){
    	
    	if ($(this).val() == "") {
	    	mostrarestudiantesI("","","","");
	    	$("#check_todos").prop('checked',0);
	    	$("#paginacion_estudianteI").hide();
	    }
	    else{

	    	id_curso = $("#id_cursoI").val();
	    	mostrarestudiantesI("",1,5,id_curso);
	    }
    });

    /*$("#btn_buscar_notificacion").click(function(event){
		
       mostrarnotificaciones("",1,5);
    });*/

    $("#buscar_estudianteI").keyup(function(event){

    	buscar = $("#buscar_estudianteI").val();
		//valorcantidad = $("#cantidad_estudianteI").val();
		id_curso = $("#id_cursoI").val();
		$("#check_todos").prop('checked',0);
		$("#paginacion_estudianteI").hide();
		mostrarestudiantesI(buscar,1,5,id_curso);
		
    });

    /*$("#cantidad_estudianteI").change(function(){
    	valorcantidad = $(this).val();
    	buscar = $("#buscar_estudianteI").val();
    	id_curso = $("#id_cursoI").val();
    	$("#paginacion_estudianteI").hide();
    	mostrarestudiantesI(buscar,1,valorcantidad,id_curso);
    });*/

    //Resetear Formulario Al Cerrar El Modal
    $("#modal_agregar_destinatario_m").on('hidden.bs.modal', function () {
        
        $("#id_cursoI").val("");
        $("#id_asignaturaI").val("");
        $("#buscar_estudianteI").val("");
        $("#check_todos").prop('checked',0);
        $("#paginacion_estudianteI").hide();
        mostrarestudiantesI("","","","");
    });


    $("#check_todos").change(function () {
    	
      $("input:checkbox").prop('checked', $(this).prop("checked"));
  	});



	$("#form_mensajes").validate({

    	rules:{

    		total_destinatario:{
				required: true	

			},

			titulo:{
				required: true,
				maxlength: 100
				//lettersonly: true	

			},

			contenido:{
				required: true,
				maxlength: 300
					

			},

			tipo:{
				required: true
		

			}

		}


	});

	$("#form_tareas").validate({

    	rules:{

    		total_destinatario:{
				required: true	

			},

			titulo:{
				required: true,
				maxlength: 100
				//lettersonly: true	

			},

			contenido:{
				required: true,
				maxlength: 300
					

			},

			fecha_limite:{
				required: true,
				date: true
		

			}

		}


	});

	$("#form_eventos").validate({

    	rules:{

    		total_destinatario:{
				required: true	

			},

			titulo:{
				required: true,
				maxlength: 100
				//lettersonly: true	

			},

			contenido:{
				required: true,
				maxlength: 300
					

			},

			fecha_inicio:{
				required: true,
				date: true
		

			},

			hora_inicio:{
				required: true
		

			},

			fecha_fin:{
				required: true,
				date: true
		

			},

			hora_fin:{
				required: true
		

			}

			//time: "required time"

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");
	/*$.validator.addMethod("time", function(value, element) {  
	return this.optional(element) || /^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])(:([0-5]?[0-9]))?$/i.test(value);  
	}, "Please enter a valid time.");*/


}


function llenarcombo_cursos_profesorI(valor){

	$.ajax({
		url:base_url+"notas_controller/llenarcombo_cursos_profesor",
		type:"post",
		data:{id_persona:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_inbox1 select").html(html);
		}

	});
}


function llenarcombo_asignaturas_profesorI(valor,valor2){

	$.ajax({
		url:base_url+"notas_controller/llenarcombo_asignaturas_profesor",
		type:"post",
		data:{id_persona:valor,id_curso:valor2},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
					
				};
				
				$("#asignaturas_inbox1 select").html(html);
		}

	});
}


function mostrarestudiantesI(valor,pagina,cantidad,id_curso){

	$.ajax({
		url:base_url+"inbox_controller/mostrarestudiantes",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_curso:id_curso},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				for (var i = 0; i < registros.estudiantes.length; i++) {
					html +="<tr><td><input type='checkbox' name='acudiente[]' value='"+registros.estudiantes[i].id_acudiente+"'></td><td>"+[i+1]+"</td><td>"+registros.estudiantes[i].nombres+"</td><td>"+registros.estudiantes[i].apellido1+"</td><td>"+registros.estudiantes[i].apellido2+"</td><td style='display:none'><a class='btn btn-success' href="+registros.estudiantes[i].id_acudiente+"><i class='fa fa-edit'></i></a></td><td style='display:none'><button type='button' class='btn btn-danger' value="+registros.estudiantes[i].id_acudiente+"><i class='fa fa-trash'></i></button></td></tr>";
				};
				
				$("#lista_estudiantesI tbody").html(html);

				linkseleccionado = Number(pagina);
				//total de registros
			    totalregistros = registros.totalregistros;
				//cantidad de registros por pagina
				cantidadregistros = registros.cantidad;
				//numero de links o paginas dependiendo de la cantidad de registros y el numero a mostrar
				numerolinks = Math.ceil(totalregistros/cantidadregistros);

				paginador="<ul class='pagination'>";

				if(linkseleccionado>1)
				{
					paginador+="<li><a href='1'>&laquo;</a></li>";
					paginador+="<li><a href='"+(linkseleccionado-1)+"' '>&lsaquo;</a></li>";

				}
				else
				{
					paginador+="<li class='disabled'><a href='#'>&laquo;</a></li>";
					paginador+="<li class='disabled'><a href='#'>&lsaquo;</a></li>";
				}
				//muestro de los enlaces 
				//cantidad de link hacia atras y adelante
	 			cant = 2;
	 			//inicio de donde se va a mostrar los links
				pagInicio = (linkseleccionado > cant) ? (linkseleccionado - cant) : 1;
				//condicion en la cual establecemos el fin de los links
				if (numerolinks > cant)
				{
					//conocer los links que hay entre el seleccionado y el final
					pagRestantes = numerolinks - linkseleccionado;
					//defino el fin de los links
					pagFin = (pagRestantes > cant) ? (linkseleccionado + cant) :numerolinks;
				}
				else 
				{
					pagFin = numerolinks;
				}

				for (var i = pagInicio; i <= pagFin; i++) {
					if (i == linkseleccionado)
						paginador +="<li class='active'><a href='javascript:void(0)'>"+i+"</a></li>";
					else
						paginador +="<li><a href='"+i+"'>"+i+"</a></li>";
				}
				//condicion para mostrar el boton sigueinte y ultimo
				if(linkseleccionado<numerolinks)
				{
					paginador+="<li><a href='"+(linkseleccionado+1)+"' >&rsaquo;</a></li>";
					paginador+="<li><a href='"+numerolinks+"'>&raquo;</a></li>";

				}
				else
				{
					paginador+="<li class='disabled'><a href='#'>&rsaquo;</a></li>";
					paginador+="<li class='disabled'><a href='#'>&raquo;</a></li>";
				}
				
				paginador +="</ul>";
				$(".paginacion_estudianteI").html(paginador);

			}

	});

}