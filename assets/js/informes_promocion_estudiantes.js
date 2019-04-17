$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_anos_lectivosPE();

	$("#btn_consultar_PE").click(function(event){

    	if($("#form_porestudiantes").valid()==true){

    		ano_lectivo = $("#ano_lectivoPE").val();
    		id_curso = $("#id_cursoPE").val();

    		mostrardiv_porestudiantes();
    		mostrarporestudiantes("",1,5,ano_lectivo,id_curso);

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#ano_lectivoPE").change(function(){
    	ocultardiv_porestudiantes();
    	$("#lista_porestudiantes tbody").html("");

    	ano_lectivo = $(this).val();
    	llenarcombo_cursosPE(ano_lectivo);
    });


    $("#id_cursoPE").change(function(){
    	ocultardiv_porestudiantes();
    	$("#lista_porestudiantes tbody").html("");
    });


    $("#btn_imprimir_PE").click(function(){

    	ano_lectivo = $("#ano_lectivoPE").val();
    	id_curso = $("#id_cursoPE").val();

    	window.open(base_url+'informes_promocion_controller/generar_porestudiantes'+'?ano_lectivo='+ano_lectivo+'&id_curso='+id_curso, '_blank');
       
    });


    $("#form_porestudiantes").validate({

    	rules:{

    		ano_lectivo:{
				required: true,
				digits: true	

			},

			id_curso:{
				required: true,
				digits: true

			}


		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function llenarcombo_anos_lectivosPE(){

	$.ajax({
		url:base_url+"informes_promocion_controller/llenarcombo_anos_lectivos",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_ano_lectivo"]+">"+registros[i]["nombre_ano_lectivo"]+"</option>";
				};
				
				$("#ano_lectivoPE1 select").html(html);
		}

	});
}


function llenarcombo_cursosPE(ano_lectivo){

	$.ajax({
		url:base_url+"informes_promocion_controller/llenarcombo_cursos2",
		type:"post",
		data:{ano_lectivo:ano_lectivo},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value='0'>Todos</option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+[" "]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
				};
				
				$("#cursoPE1 select").html(html);
		}

	});
}


function mostrarporestudiantes(valor,pagina,cantidad,ano_lectivo,id_curso){

	$.ajax({
		url:base_url+"informes_promocion_controller/mostrarporestudiantes",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,ano_lectivo:ano_lectivo,id_curso:id_curso},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.porestudiantes.length > 0) {

					for (var i = 0; i < registros.porestudiantes.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.porestudiantes[i].id_promocion+"</td><td>"+registros.porestudiantes[i].nombre_grado+" "+registros.porestudiantes[i].nombre_grupo+" "+registros.porestudiantes[i].jornada+"</td><td>"+registros.porestudiantes[i].apellido1+" "+registros.porestudiantes[i].apellido2+" "+registros.porestudiantes[i].nombres+"</td><td>"+registros.porestudiantes[i].situacion_academica+"</td></tr>";
					};
					
					$("#lista_porestudiantes tbody").html(html);
				}
				else{
					html ="<tr><td colspan='4'><p style='text-align:center'>No Se Encontraron Resultados..</p></td></tr>";
					$("#lista_porestudiantes tbody").html(html);
				}	

			}

	});

}


function mostrardiv_porestudiantes(){

	div = document.getElementById('div-porestudiantes');
    div.style.display = '';

}

function ocultardiv_porestudiantes(){

	div = document.getElementById('div-porestudiantes');
    div.style.display = 'none';
}