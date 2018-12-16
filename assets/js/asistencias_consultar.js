$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	id_persona = $("#id_persona").val();

	llenarcombo_cursos_profesorAST(id_persona);


	$("#btn_consultar_asistencia").click(function(event){

    	if($("#form_asistencias").valid()==true){

    		id_curso = $("#id_cursoAST").val();
    		id_asignatura = $("#id_asignaturaAST").val();
    		fecha = $("#fechaAST").val();
    		periodo = $("#periodoAST").val();

    		$("#lista_asistencias tbody").html("");
    		mostrardiv_asistencias();
    		mostrarasistencias("",1,5,id_persona,id_curso,id_asignatura,periodo,fecha);

       	}
       	else{
			toastr.warning('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
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


function mostrarasistencias(valor,pagina,cantidad,id_persona,id_curso,id_asignatura,periodo,fecha){

	$.ajax({
		url:base_url+"asistencias_controller/mostrarasistencias",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_profesor:id_persona,id_curso:id_curso,id_asignatura:id_asignatura,periodo:periodo,fecha:fecha},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.asistencias.length > 0) {

					for (var i = 0; i < registros.asistencias.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'><input type='text' name='id_estudiante[]' id='id_estudiante' value='"+registros.asistencias[i].id_estudiante+"' size='2'></td><td>"+registros.asistencias[i].identificacion+"</td><td>"+registros.asistencias[i].apellido1+" "+registros.asistencias[i].apellido2+" "+registros.asistencias[i].nombres+"</td><td style='display:none'>"+registros.asistencias[i].id_curso+"</td><td>"+registros.asistencias[i].nombre_grado+" "+registros.asistencias[i].nombre_grupo+" "+registros.asistencias[i].jornada+"</td><td>"+registros.asistencias[i].asistencia+"</td></tr>";
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



