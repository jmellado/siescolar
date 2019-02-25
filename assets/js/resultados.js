$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_anos_lectivosR();

	$("#ano_lectivoR").change(function(){
    	ano_lectivo = $(this).val();
    	limpiar_lista_candidatos();
    	llenarcombo_eleccionesR(ano_lectivo);
    });

	$("#id_eleccionR").change(function(){
    	id_eleccion = $(this).val();
    	mostrarresultados(id_eleccion);
    });

}


function llenarcombo_anos_lectivosR(){

	$.ajax({
		url:base_url+"elecciones_controller/llenarcombo_anos_lectivosR",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_ano_lectivo"]+">"+registros[i]["nombre_ano_lectivo"]+"</option>";
				};
				
				$("#ano_lectivoR1 select").html(html);
		}

	});
}


function llenarcombo_eleccionesR(ano_lectivo){

	$.ajax({
		url:base_url+"elecciones_controller/llenarcombo_eleccionesR",
		type:"post",
		data:{ano_lectivo:ano_lectivo},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_eleccion"]+">"+registros[i]["nombre_eleccion"]+"</option>";
				};
				
				$("#eleccionR1 select").html(html);
		}

	});
}


function mostrarresultados(id_eleccion){

	$.ajax({
		url:base_url+"elecciones_controller/mostrarresultados",
		type:"post",
		data:{id_eleccion:id_eleccion},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";
				total_votos = 0;

				if (registros.elecciones.length > 0) {

					for (var i = 0; i < registros.elecciones.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.elecciones[i].id_eleccion+"</td><td><img src='"+base_url+"uploads/imagenes/elecciones/candidatos/"+registros.elecciones[i].id_candidato_eleccion+".jpg' alt='Foto Candidato' class='img-responsive' style='width: 120px; height: 160px; text-align: center;'/></td><td><h1>"+registros.elecciones[i].numero+"</h1></td><td><h2>"+registros.elecciones[i].nombres+" "+registros.elecciones[i].apellido1+" "+registros.elecciones[i].apellido2+"</h2></td><td><h1>"+registros.elecciones[i].votos+"</h1></td></tr>";
						total_votos = parseInt(total_votos) + parseInt(registros.elecciones[i].votos);
					};
					
					htmll ="<tr><td colspan='5'><h4><b>TOTAL DE VOTOS:</b> "+total_votos+"&nbsp;&nbsp;&nbsp;<b>ABSTENCIÓN:</b> "+parseInt(registros.total_votantes - total_votos)+"</h4></td></tr>";
					$("#lista_candidatos_eleccionR tbody").html(html);
					$("#lista_candidatos_eleccionR tfoot").html(htmll);
				}
				else{
					html ="<tr><td colspan='5'><p style='text-align:center'>No Hay Candidatos..</p></td></tr>";
					htmll ="<tr><td colspan='5'></td></tr>";
					$("#lista_candidatos_eleccionR tbody").html(html);
					$("#lista_candidatos_eleccionR tfoot").html(htmll);
				}

			}

	});

}


function limpiar_lista_candidatos(){

	htmll ="<tr><td colspan='5'></td></tr>";

	$("#lista_candidatos_eleccionR tbody").html("");
    $("#lista_candidatos_eleccionR tfoot").html(htmll);

}