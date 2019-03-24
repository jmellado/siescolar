$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_anos_lectivosPJ();

	$("#btn_consultar_PJ").click(function(event){

    	if($("#form_porjornada").valid()==true){

    		ano_lectivo = $("#ano_lectivoPJ").val();
    		jornada = $("#jornadaPJ").val();

    		mostrardiv_porjornada();
    		mostrarporjornada("",1,5,ano_lectivo,jornada);

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#ano_lectivoPJ").change(function(){
    	ocultardiv_porjornada();
    	$("#lista_porjornada tbody").html("");
    });


    $("#jornadaPJ").change(function(){
    	ocultardiv_porjornada();
    	$("#lista_porjornada tbody").html("");
    });


    $("#btn_imprimir_PJ").click(function(){

    	ano_lectivo = $("#ano_lectivoPJ").val();
    	jornada = $("#jornadaPJ").val();

    	window.open(base_url+'informes_promocion_controller/generar_porjornada'+'?ano_lectivo='+ano_lectivo+'&jornada='+jornada, '_blank');
       
    });


    $("#form_porjornada").validate({

    	rules:{

    		ano_lectivo:{
				required: true,
				digits: true	

			},

			jornada:{
				required: true,
				maxlength: 6

			}


		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function llenarcombo_anos_lectivosPJ(){

	$.ajax({
		url:base_url+"informes_promocion_controller/llenarcombo_anos_lectivos",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_ano_lectivo"]+">"+registros[i]["nombre_ano_lectivo"]+"</option>";
				};
				
				$("#ano_lectivoPJ1 select").html(html);
		}

	});
}


function mostrarporjornada(valor,pagina,cantidad,ano_lectivo,jornada){

	$.ajax({
		url:base_url+"informes_promocion_controller/mostrarporjornada",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,ano_lectivo:ano_lectivo,jornada:jornada},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.porjornada.length > 0) {

					for (var i = 0; i < registros.porjornada.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.porjornada[i].id_promocion+"</td><td>"+registros.porjornada[i].jornada+"</td><td>"+registros.porjornada[i].situacion_academica+"</td><td>"+registros.porjornada[i].total+"</td></tr>";
					};
					
					$("#lista_porjornada tbody").html(html);
				}
				else{
					html ="<tr><td colspan='4'><p style='text-align:center'>No Se Encontraron Resultados..</p></td></tr>";
					$("#lista_porjornada tbody").html(html);
				}	

			}

	});

}


function mostrardiv_porjornada(){

	div = document.getElementById('div-porjornada');
    div.style.display = '';

}

function ocultardiv_porjornada(){

	div = document.getElementById('div-porjornada');
    div.style.display = 'none';
}