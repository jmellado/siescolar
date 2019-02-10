$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	id_persona = $("#id_persona").val();

	llenarcombo_cursos_profesorAST(id_persona);


	$("#btn_ingresar_asistencia").click(function(event){

    	if($("#form_asistencias").valid()==true){

    		id_curso = $("#id_cursoAST").val();
    		id_asignatura = $("#id_asignaturaAST").val();
    		fecha = $("#fechaAST").val();
    		periodo = $("#periodoAST").val();

    		$("#lista_estudiantes tbody").html("");
    		mostrardiv_asistencias();
    		mostrarestudiantes("",1,5,id_curso);

    		$("#id_profesorseleAST").val(id_persona);
	        $("#id_cursoseleAST").val(id_curso);
	        $("#id_asignaturaseleAST").val(id_asignatura);
	        $("#fechaseleAST").val(fecha);
	        $("#periodoseleAST").val(periodo);

       	}
       	else{
			toastr.warning('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });



	$("#form_asistencias_insertar").submit(function (event) {
		
		event.preventDefault();

		if(validarCampoAsistencia() == true){

			$.ajax({

				url:$("#form_asistencias_insertar").attr("action"),
				type:$("#form_asistencias_insertar").attr("method"),
				data:$("#form_asistencias_insertar").serialize(),
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Asistencias Registradas Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						limpiar_form_asistencias_insertar();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Asistencias No Registradas.', 'Success Alert', {timeOut: 3000});
						
					}
					else if(respuesta==="asistenciayaexiste"){
						
						toastr.warning('La Asistencia Ya Se Encuentra Registrada, Para El Curso, Asignatura, Período Y Fecha Seleccionados.', 'Success Alert', {timeOut: 3000});
							
					}
					else if(respuesta==="nohayestudiantes"){
						
						toastr.warning('No Hay Información Por Registrar.', 'Success Alert', {timeOut: 3000});
							
					}
					else if(respuesta==="periodocerrado"){
						
						toastr.warning('No Existen Fechas Para El Registro De Asistencias.', 'Success Alert', {timeOut: 3000});
							
					}
					else if(respuesta==="nohayhoras"){
						
						toastr.warning('La Asignatura No Tiene Horas De Clase Registradas Para La Fecha Seleccionada.', 'Success Alert', {timeOut: 3000});
							
					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}	
						
				}

			});

		}else{

			toastr.warning('Las Asistencias Ingresadas Son Incorrectas.', 'Success Alert', {timeOut: 3000});

		}

	});


    $("#id_cursoAST").change(function(){
    	ocultardiv_asistencias();

    	id_curso = $("#id_cursoAST").val();
    	llenarcombo_asignaturas_profesorAST(id_persona,id_curso);
    });

    $("#fechaAST").change(function(){
    	ocultardiv_asistencias();
    });

    $("#id_asignaturaAST").change(function(){
    	ocultardiv_asistencias();
    });

    $("#periodoAST").change(function(){
    	ocultardiv_asistencias();
    });


    $("#form_asistencias").validate({

    	rules:{


			id_curso:{
				required: true,
				maxlength: 15	

			},

			id_asignatura:{
				required: true,
				maxlength: 15	

			},

			periodo:{
				required: true,
				maxlength: 8,
				lettersonly: true	

			},

			fecha:{
				required: true,
				date: true
				
			}


		}


	});






}


function llenarcombo_cursos_profesorAST(valor){

	$.ajax({
		url:base_url+"asistencias_controller/llenarcombo_cursos_profesor",
		type:"post",
		data:{id_persona:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_asistencias1 select").html(html);
		}

	});
}


function llenarcombo_asignaturas_profesorAST(valor,valor2){

	$.ajax({
		url:base_url+"asistencias_controller/llenarcombo_asignaturas_profesor",
		type:"post",
		data:{id_persona:valor,id_curso:valor2},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
					
				};
				
				$("#asignaturas_asistencias1 select").html(html);
		}

	});
}


function mostrarestudiantes(valor,pagina,cantidad,id_curso){

	$.ajax({
		url:base_url+"asistencias_controller/mostrarestudiantes",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_curso:id_curso},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.estudiantes.length > 0) {

					for (var i = 0; i < registros.estudiantes.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'><input type='text' name='id_estudiante[]' id='id_estudiante' value='"+registros.estudiantes[i].id_estudiante+"' size='2'></td><td>"+registros.estudiantes[i].identificacion+"</td><td>"+registros.estudiantes[i].apellido1+" "+registros.estudiantes[i].apellido2+" "+registros.estudiantes[i].nombres+"</td><td style='display:none'>"+registros.estudiantes[i].id_curso+"</td><td>"+registros.estudiantes[i].nombre_grado+" "+registros.estudiantes[i].nombre_grupo+" "+registros.estudiantes[i].jornada+"</td><td align='center'><select class='form-control' name='asistencia[]' id='asistencia' style='width: 140px;'><option></option><option value='Asistió'>Asistió</option><option value='Faltó'>Faltó</option><option value='Tardanza'>Tardanza</option><option value='Falta Justificada'>Falta Justificada</option><option value='Tardanza Justificada'>Tardanza Justificada</option></select></td></tr>";
					};
					
					$("#lista_estudiantes tbody").html(html);
				}
				else{
					html ="<tr><td colspan='5'><p style='text-align:center'>No Hay Estudiantes Matriculados..</p></td></tr>";
					$("#lista_estudiantes tbody").html(html);
				}	

			}

	});

}


function mostrardiv_asistencias(){

	div = document.getElementById('div-asistencias');
    div.style.display = '';

}

function ocultardiv_asistencias(){

	div = document.getElementById('div-asistencias');
    div.style.display = 'none';
}


function validarCampoAsistencia(){

	var resn=[];
    var resy=[];
    var vacio = "";

   	var asistencias = document.getElementsByName("asistencia[]");

   	for(i = 0; i < asistencias.length; i++){

   		if(asistencias[i].value != vacio){

   			resy.push("si")
   		}
   		else{
   			resn.push("no");
   		}


   	}

   	if(resy.length == asistencias.length){

		//alert("ok");
		return true;
	}
	else{
		//alert("no");
		return false;
	}

}


function limpiar_form_asistencias_insertar(){

	$("#form_asistencias_insertar")[0].reset();
	$("#id_profesorseleAST").val("");
	$("#id_cursoseleAST").val("");
	$("#id_asignaturaseleAST").val("");
	$("#fechaseleAST").val("");
	$("#periodoseleAST").val("");
	$("#lista_estudiantes tbody").html("");
	ocultardiv_asistencias();

}