$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_anos_lectivosAST();


	$("#btn_consultar_asistencia").click(function(event){

    	if($("#form_asistencias").valid()==true){

    		ano_lectivo = $("#ano_lectivoAST").val();
    		mes = $("#mesAST").val();
    		asistencia = $("#asistenciaAST").val();

    		mostrardiv_asistencias();
    		mostrarasistencias("",1,5,ano_lectivo,mes,asistencia);

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


	$("#ano_lectivoAST").change(function(){
    	ocultardiv_asistencias();
    	$("#lista_asistencias tbody").html("");
    });


    $("#mesAST").change(function(){
    	ocultardiv_asistencias();
    	$("#lista_asistencias tbody").html("");
    });


    $("#asistenciaAST").change(function(){
    	ocultardiv_asistencias();
    	$("#lista_asistencias tbody").html("");
    });


    $("#form_asistencias").validate({

    	rules:{


    		ano_lectivo:{
				required: true,
				digits: true	

			},

			mes:{
				required: true,
				maxlength: 2,
				digits: true	

			},

			asistencia:{
				required: true,
				maxlength: 20,
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


function mostrarasistencias(valor,pagina,cantidad,ano_lectivo,mes,asistencia){

	$.ajax({
		url:base_url+"asistencias_a_controller/mostrar_consolidado_asistencias_mes",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,ano_lectivo:ano_lectivo,mes:mes,asistencia:asistencia},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.asistencias.length > 0) {

					for (var i = 0; i < registros.asistencias.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.asistencias[i].id_asistencia+"</td><td style='text-align:center'>"+registros.asistencias[i].mes+"</td><td style='text-align:center'>"+registros.asistencias[i].asistencia+"</td><td style='text-align:center'>"+registros.asistencias[i].total+"</td></tr>";
					};
					
					$("#lista_asistencias tbody").html(html);
				}
				else{
					html ="<tr><td colspan='4'><p style='text-align:center'>No Hay Asistencias Registradas..</p></td></tr>";
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