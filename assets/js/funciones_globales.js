$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_anos_lectivos();
	llenarcombo_salones();
	llenarcombo_grados();
	llenarcombo_grupos();

}




//------------------------------FUNCIONES GlOBALES PARA LAS DIFERENTES GESTION--------------------------------------------------------



function llenarcombo_salones(){

	$.ajax({
		url:base_url+"funciones_globales_controller/llenarcombo_salones",
		type:"post",
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_salon"]+">"+registros[i]["nombre_salon"]+"</option>";
				};
				
				$("#salon1 select").html(html);
		}

	});
}

function llenarcombo_grados(){

	$.ajax({
		url:base_url+"funciones_globales_controller/llenarcombo_grados",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_grado"]+">"+registros[i]["nombre_grado"]+"</option>";
				};
				
				$("#grado1 select").html(html);
		}

	});
}

function llenarcombo_grupos(){

	$.ajax({
		url:base_url+"funciones_globales_controller/llenarcombo_grupos",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_grupo"]+">"+registros[i]["nombre_grupo"]+"</option>";
				};
				
				$("#grupo1 select").html(html);
		}

	});
}

/*function llenarcombo_anos_lectivos(){

	$.ajax({
		url:base_url+"funciones_globales_controller/llenarcombo_anos_lectivos",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
				var anio = obtener_anio_actual();

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {

					if(registros[i]["nombre_ano_lectivo"]==anio){
						html +="<option value="+registros[i]["id_ano_lectivo"]+" selected>"+registros[i]["nombre_ano_lectivo"]+"</option>";
					}
					else{
						html +="<option value="+registros[i]["id_ano_lectivo"]+">"+registros[i]["nombre_ano_lectivo"]+"</option>";
					}
				};
				
				$("#ano_lectivo1 select").html(html);
		}

	});
}*/

function obtener_anio_actual(){

	var f = new Date();
	anio=f.getFullYear();

	return anio;
}


function llenarcombo_anos_lectivos(){

	$.ajax({
		url:base_url+"funciones_globales_controller/llenarcombo_anos_lectivos",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_ano_lectivo"]+" selected>"+registros[i]["nombre_ano_lectivo"]+"</option>";
				};
				
				$("#ano_lectivo1 select").html(html);
		}

	});
}