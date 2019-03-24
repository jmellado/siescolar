$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_anos_lectivosPC();

	$("#btn_consultar_PC").click(function(event){

    	if($("#form_porcurso").valid()==true){

    		ano_lectivo = $("#ano_lectivoPC").val();
    		id_curso = $("#id_cursoPC").val();

    		mostrardiv_porcurso();
    		mostrarporcurso("",1,5,ano_lectivo,id_curso);

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#ano_lectivoPC").change(function(){
    	ocultardiv_porcurso();
    	$("#lista_porcurso tbody").html("");

    	ano_lectivo = $(this).val();
    	llenarcombo_cursosPC(ano_lectivo);
    });


    $("#id_cursoPC").change(function(){
    	ocultardiv_porcurso();
    	$("#lista_porcurso tbody").html("");
    });


    $("#btn_imprimir_PC").click(function(){

    	ano_lectivo = $("#ano_lectivoPC").val();
    	id_curso = $("#id_cursoPC").val();

    	window.open(base_url+'informes_promocion_controller/generar_porcurso'+'?ano_lectivo='+ano_lectivo+'&id_curso='+id_curso, '_blank');
       
    });


    $("#form_porcurso").validate({

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


function llenarcombo_anos_lectivosPC(){

	$.ajax({
		url:base_url+"informes_promocion_controller/llenarcombo_anos_lectivos",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_ano_lectivo"]+">"+registros[i]["nombre_ano_lectivo"]+"</option>";
				};
				
				$("#ano_lectivoPC1 select").html(html);
		}

	});
}


function llenarcombo_cursosPC(ano_lectivo){

	$.ajax({
		url:base_url+"informes_promocion_controller/llenarcombo_cursos",
		type:"post",
		data:{ano_lectivo:ano_lectivo},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value='0'>Todos</option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+[" "]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
				};
				
				$("#cursoPC1 select").html(html);
		}

	});
}


function mostrarporcurso(valor,pagina,cantidad,ano_lectivo,id_curso){

	$.ajax({
		url:base_url+"informes_promocion_controller/mostrarporcurso",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,ano_lectivo:ano_lectivo,id_curso:id_curso},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.porcurso.length > 0) {

					for (var i = 0; i < registros.porcurso.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.porcurso[i].id_promocion+"</td><td>"+registros.porcurso[i].nombre_grado+" "+registros.porcurso[i].nombre_grupo+" "+registros.porcurso[i].jornada+"</td><td>"+registros.porcurso[i].situacion_academica+"</td><td>"+registros.porcurso[i].total+"</td></tr>";
					};
					
					$("#lista_porcurso tbody").html(html);
				}
				else{
					html ="<tr><td colspan='4'><p style='text-align:center'>No Se Encontraron Resultados..</p></td></tr>";
					$("#lista_porcurso tbody").html(html);
				}	

			}

	});

}


function mostrardiv_porcurso(){

	div = document.getElementById('div-porcurso');
    div.style.display = '';

}

function ocultardiv_porcurso(){

	div = document.getElementById('div-porcurso');
    div.style.display = 'none';
}