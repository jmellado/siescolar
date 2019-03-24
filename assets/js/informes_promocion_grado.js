$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_anos_lectivosPG();

	$("#btn_consultar_PG").click(function(event){

    	if($("#form_porgrado").valid()==true){

    		ano_lectivo = $("#ano_lectivoPG").val();
    		id_grado = $("#id_gradoPG").val();

    		mostrardiv_porgrado();
    		mostrarporgrado("",1,5,ano_lectivo,id_grado);

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#ano_lectivoPG").change(function(){
    	ocultardiv_porgrado();
    	$("#lista_porgrado tbody").html("");

    	ano_lectivo = $(this).val();
    	llenarcombo_gradosPG(ano_lectivo);
    });


    $("#id_gradoPG").change(function(){
    	ocultardiv_porgrado();
    	$("#lista_porgrado tbody").html("");
    });


    $("#btn_imprimir_PG").click(function(){

    	ano_lectivo = $("#ano_lectivoPG").val();
    	id_grado = $("#id_gradoPG").val();

    	window.open(base_url+'informes_promocion_controller/generar_porgrado'+'?ano_lectivo='+ano_lectivo+'&id_grado='+id_grado, '_blank');
       
    });


    $("#form_porgrado").validate({

    	rules:{

    		ano_lectivo:{
				required: true,
				digits: true	

			},

			id_grado:{
				required: true,
				digits: true

			}


		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function llenarcombo_anos_lectivosPG(){

	$.ajax({
		url:base_url+"informes_promocion_controller/llenarcombo_anos_lectivos",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_ano_lectivo"]+">"+registros[i]["nombre_ano_lectivo"]+"</option>";
				};
				
				$("#ano_lectivoPG1 select").html(html);
		}

	});
}


function llenarcombo_gradosPG(ano_lectivo){

	$.ajax({
		url:base_url+"informes_promocion_controller/llenarcombo_grados",
		type:"post",
		data:{ano_lectivo:ano_lectivo},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value='0'>Todos</option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_grado"]+">"+registros[i]["nombre_grado"]+"</option>";
				};
				
				$("#gradoPG1 select").html(html);
		}

	});
}


function mostrarporgrado(valor,pagina,cantidad,ano_lectivo,id_grado){

	$.ajax({
		url:base_url+"informes_promocion_controller/mostrarporgrado",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,ano_lectivo:ano_lectivo,id_grado:id_grado},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.porgrado.length > 0) {

					for (var i = 0; i < registros.porgrado.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.porgrado[i].id_promocion+"</td><td>"+registros.porgrado[i].nombre_grado+"</td><td>"+registros.porgrado[i].situacion_academica+"</td><td>"+registros.porgrado[i].total+"</td></tr>";
					};
					
					$("#lista_porgrado tbody").html(html);
				}
				else{
					html ="<tr><td colspan='4'><p style='text-align:center'>No Se Encontraron Resultados..</p></td></tr>";
					$("#lista_porgrado tbody").html(html);
				}	

			}

	});

}


function mostrardiv_porgrado(){

	div = document.getElementById('div-porgrado');
    div.style.display = '';

}

function ocultardiv_porgrado(){

	div = document.getElementById('div-porgrado');
    div.style.display = 'none';
}