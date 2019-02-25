$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_anos_lectivosAB();


	$("#ano_lectivoAB").change(function(){
    	ano_lectivo = $(this).val();
    	$("#lista_abstencion tbody").html("");
    	llenarcombo_eleccionesAB(ano_lectivo);
    });

	$("#id_eleccionAB").change(function(){
    	id_eleccion = $(this).val();
    	mostrarabstencion(id_eleccion);
    });

}


function llenarcombo_anos_lectivosAB(){

	$.ajax({
		url:base_url+"elecciones_controller/llenarcombo_anos_lectivosAB",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_ano_lectivo"]+">"+registros[i]["nombre_ano_lectivo"]+"</option>";
				};
				
				$("#ano_lectivoAB1 select").html(html);
		}

	});
}


function llenarcombo_eleccionesAB(ano_lectivo){

	$.ajax({
		url:base_url+"elecciones_controller/llenarcombo_eleccionesAB",
		type:"post",
		data:{ano_lectivo:ano_lectivo},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_eleccion"]+">"+registros[i]["nombre_eleccion"]+"</option>";
				};
				
				$("#eleccionAB1 select").html(html);
		}

	});
}


function mostrarabstencion(id_eleccion){

	$.ajax({
		url:base_url+"elecciones_controller/mostrarabstencion",
		type:"post",
		data:{id_eleccion:id_eleccion},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.elecciones.length > 0) {

					for (var i = 0; i < registros.elecciones.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.elecciones[i].id_eleccion+"</td><td>"+registros.elecciones[i].identificacion+"</td><td>"+registros.elecciones[i].nombres+" "+registros.elecciones[i].apellido1+" "+registros.elecciones[i].apellido2+"</td><td>"+registros.elecciones[i].nombre_grado+" "+registros.elecciones[i].nombre_grupo+" "+registros.elecciones[i].jornada+"</td></tr>";
					};
					
					$("#lista_abstencion tbody").html(html);
				}
				else{
					html ="<tr><td colspan='4'><p style='text-align:center'>No Hay Abstención..</p></td></tr>";
					$("#lista_abstencion tbody").html(html);
				}

			}

	});

}