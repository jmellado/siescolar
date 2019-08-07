$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_anos_lectivosAST();


	$("#btn_consultar_asistencia").click(function(event){

    	if($("#form_asistencias").valid()==true){

    		ano_lectivo = $("#ano_lectivoAST").val();
    		id_curso = $("#id_cursoAST").val();
    		id_asignatura = $("#id_asignaturaAST").val();
    		id_estudiante = $("#id_estudianteAST").val();
    		periodo = $("#periodoAST").val();

    		mostrardiv_asistencias();
    		mostrarasistencias("",1,5,ano_lectivo,id_curso,id_asignatura,id_estudiante,periodo);

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


	$("#ano_lectivoAST").change(function(){
    	ocultardiv_asistencias();
    	$("#cursos_asistencias1 select").html("");
    	$("#asignaturas_asistencias1 select").html("");
    	$("#estudiantes_asistencias1 select").html("");
    	$("#lista_asistencias tbody").html("");

    	ano_lectivo = $(this).val();
    	llenarcombo_cursosAST(ano_lectivo);
    });


    $("#id_cursoAST").change(function(){
    	ocultardiv_asistencias();
    	$("#asignaturas_asistencias1 select").html("");
    	$("#estudiantes_asistencias1 select").html("");
    	$("#lista_asistencias tbody").html("");

    	id_curso = $(this).val();
    	ano_lectivo = $("#ano_lectivoAST").val();
    	llenarcombo_asignaturasAST(id_curso,ano_lectivo);
    });


    $("#id_asignaturaAST").change(function(){
    	ocultardiv_asistencias();
    	$("#estudiantes_asistencias1 select").html("");
    	$("#lista_asistencias tbody").html("");

    	id_curso = $("#id_cursoAST").val();
    	llenarcombo_estudiantesAST(id_curso);
    });


    $("#id_estudianteAST").change(function(){
    	ocultardiv_asistencias();
    	$("#lista_asistencias tbody").html("");
    });


    $("#periodoAST").change(function(){
    	ocultardiv_asistencias();
    	$("#lista_asistencias tbody").html("");
    });


    $("#form_asistencias").validate({

    	rules:{


    		ano_lectivo:{
				required: true,
				digits: true	

			},

			id_curso:{
				required: true,
				digits: true	

			},

			id_asignatura:{
				required: true,
				digits: true	

			},

			id_estudiante:{
				required: true,
				digits: true	

			},

			periodo:{
				required: true,
				maxlength: 8,
				lettersonly: true	

			}


		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function llenarcombo_anos_lectivosAST(){

	$.ajax({
		url:base_url+"asistencias_a_controller/llenarcombo_anos_lectivos",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_ano_lectivo"]+">"+registros[i]["nombre_ano_lectivo"]+"</option>";
				};
				
				$("#ano_lectivo_asistencias1 select").html(html);
		}

	});
}


function llenarcombo_cursosAST(ano_lectivo){

	$.ajax({
		url:base_url+"asistencias_a_controller/llenarcombo_cursos",
		type:"post",
		data:{ano_lectivo:ano_lectivo},
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


function llenarcombo_asignaturasAST(id_curso,ano_lectivo){

	$.ajax({
		url:base_url+"asistencias_a_controller/llenarcombo_asignaturas",
		type:"post",
		data:{id_curso:id_curso,ano_lectivo:ano_lectivo},
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


function llenarcombo_estudiantesAST(id_curso){

	$.ajax({
		url:base_url+"asistencias_a_controller/llenarcombo_estudiantes",
		type:"post",
		data:{id_curso:id_curso},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_estudiante"]+">"+registros[i]["nombres"]+[" "]+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+"</option>";
					
				};
				
				$("#estudiantes_asistencias1 select").html(html);
		}

	});
}


function mostrarasistencias(valor,pagina,cantidad,ano_lectivo,id_curso,id_asignatura,id_estudiante,periodo){

	$.ajax({
		url:base_url+"asistencias_a_controller/mostrarasistencias_estudiante",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,ano_lectivo:ano_lectivo,id_curso:id_curso,id_asignatura:id_asignatura,id_estudiante:id_estudiante,periodo:periodo},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.asistencias.length > 0) {

					for (var i = 0; i < registros.asistencias.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.asistencias[i].id_asistencia+"</td><td style='display:none'><input type='text' name='id_estudiante' id='id_estudiante' value='"+registros.asistencias[i].id_estudiante+"' size='2'></td><td style='display:none'>"+registros.asistencias[i].id_curso+"</td><td style='display:none'>"+registros.asistencias[i].id_asignatura+"</td><td>"+registros.asistencias[i].nombre_asignatura+"</td><td style='text-align:center'>"+registros.asistencias[i].asistencia+"</td><td style='text-align:center'>"+registros.asistencias[i].horas+"</td><td style='text-align:center'>"+registros.asistencias[i].fecha+"</td></tr>";
					};
					
					$("#lista_asistencias tbody").html(html);
				}
				else{
					html ="<tr><td colspan='5'><p style='text-align:center'>No Hay Asistencias Registradas..</p></td></tr>";
					$("#lista_asistencias tbody").html(html);
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