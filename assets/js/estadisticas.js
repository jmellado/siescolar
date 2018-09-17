$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_anos_lectivosE();

	//================================= Funciones Cincuenta Mejores =================================

	$("#btn_consultar_CM").click(function(event){

    	if($("#form_cincuentamejores").valid()==true){

    		periodo = $("#periodoCM").val();
    		jornada = $("#jornadaCM").val();
    		ano_lectivo = $("#ano_lectivoCM").val();
    		mostrardiv_cincuentamejores();
    		mostrarcincuentamejores("",1,5,periodo,jornada,ano_lectivo);

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#periodoCM").change(function(){
    	ocultardiv_cincuentamejores();
    });

    $("#jornadaCM").change(function(){
    	ocultardiv_cincuentamejores();
    });

    $("#ano_lectivoCM").change(function(){
    	ocultardiv_cincuentamejores();
    });


	$("#form_cincuentamejores").validate({

    	rules:{

    		periodo:{
				required: true,
				maxlength: 8,
				lettersonly: true	

			},

			jornada:{
				required: true,
				maxlength: 6

			},

			ano_lectivo:{
				required: true,
				digits: true,
				maxlength: 30	

			},


		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


	//================================= Funciones Promedio Cursos =================================

	$("#btn_consultar_PC").click(function(event){

    	if($("#form_promediocursos").valid()==true){

    		periodo = $("#periodoPC").val();
    		jornada = $("#jornadaPC").val();
    		ano_lectivo = $("#ano_lectivoPC").val();
    		mostrardiv_promediocursos();
    		mostrarpromediocursos("",1,5,periodo,jornada,ano_lectivo);

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#periodoPC").change(function(){
    	ocultardiv_promediocursos();
    });

    $("#jornadaPC").change(function(){
    	ocultardiv_promediocursos();
    });

    $("#ano_lectivoPC").change(function(){
    	ocultardiv_promediocursos();
    });


	$("#form_promediocursos").validate({

    	rules:{

    		periodo:{
				required: true,
				maxlength: 8,
				lettersonly: true	

			},

			jornada:{
				required: true,
				maxlength: 6

			},

			ano_lectivo:{
				required: true,
				digits: true,
				maxlength: 30	

			},


		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


	//================================= Funciones Promedio Grados =================================


	$("#btn_consultar_PG").click(function(event){

    	if($("#form_promediogrados").valid()==true){

    		periodo = $("#periodoPG").val();
    		jornada = $("#jornadaPG").val();
    		ano_lectivo = $("#ano_lectivoPG").val();
    		mostrardiv_promediogrados();
    		mostrarpromediogrados("",1,5,periodo,jornada,ano_lectivo);

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#periodoPG").change(function(){
    	ocultardiv_promediogrados();
    });

    $("#jornadaPG").change(function(){
    	ocultardiv_promediogrados();
    });

    $("#ano_lectivoPG").change(function(){
    	ocultardiv_promediogrados();
    });


	$("#form_promediogrados").validate({

    	rules:{

    		periodo:{
				required: true,
				maxlength: 8,
				lettersonly: true	

			},

			jornada:{
				required: true,
				maxlength: 6

			},

			ano_lectivo:{
				required: true,
				digits: true,
				maxlength: 30	

			},


		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


	//================================= Funciones En Riesgo =================================


	$("#btn_consultar_ER").click(function(event){

    	if($("#form_enriesgo").valid()==true){

    		periodo = $("#periodoER").val();
    		jornada = $("#jornadaER").val();
    		ano_lectivo = $("#ano_lectivoER").val();
    		mostrardiv_enriesgo();
    		mostrarenriesgo("",1,5,periodo,jornada,ano_lectivo);

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#periodoER").change(function(){
    	ocultardiv_enriesgo();
    });

    $("#jornadaER").change(function(){
    	ocultardiv_enriesgo();
    });

    $("#ano_lectivoER").change(function(){
    	ocultardiv_enriesgo();
    });


	$("#form_enriesgo").validate({

    	rules:{

    		periodo:{
				required: true,
				maxlength: 8,
				lettersonly: true	

			},

			jornada:{
				required: true,
				maxlength: 6

			},

			ano_lectivo:{
				required: true,
				digits: true,
				maxlength: 30	

			},


		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");



}


function llenarcombo_anos_lectivosE(){

	$.ajax({
		url:base_url+"estadisticas_controller/llenarcombo_anos_lectivosE",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_ano_lectivo"]+">"+registros[i]["nombre_ano_lectivo"]+"</option>";
				};
				
				$("#ano_lectivoE1 select").html(html);
		}

	});
}


//================================= Funciones Cincuenta Mejores =================================


function mostrarcincuentamejores(valor,pagina,cantidad,periodo,jornada,ano_lectivo){

	$.ajax({
		url:base_url+"estadisticas_controller/mostrarcincuentamejores",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,periodo:periodo,jornada:jornada,ano_lectivo:ano_lectivo},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.cincuentamejores.length > 0) {

					for (var i = 0; i < registros.cincuentamejores.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.cincuentamejores[i].id_persona+"</td><td>"+registros.cincuentamejores[i].identificacion+"</td><td>"+registros.cincuentamejores[i].apellido1+" "+registros.cincuentamejores[i].apellido2+" "+registros.cincuentamejores[i].nombres+"</td><td style='display:none'>"+registros.cincuentamejores[i].id_curso+"</td><td>"+registros.cincuentamejores[i].nombre_grado+" "+registros.cincuentamejores[i].nombre_grupo+" "+registros.cincuentamejores[i].jornada+"</td><td>"+registros.cincuentamejores[i].promedio+"</td></tr>";
					};
					
					$("#lista_cincuentamejores tbody").html(html);
				}
				else{
					html ="<tr><td colspan='5'><p style='text-align:center'>No Hay Estudiantes Matriculados..</p></td></tr>";
					$("#lista_cincuentamejores tbody").html(html);
				}	

			}

	});

}


function mostrardiv_cincuentamejores(){

	div = document.getElementById('div-cincuentamejores');
    div.style.display = '';

}

function ocultardiv_cincuentamejores(){

	div = document.getElementById('div-cincuentamejores');
    div.style.display = 'none';
}


//================================= Funciones Promedio Cursos =================================


function mostrarpromediocursos(valor,pagina,cantidad,periodo,jornada,ano_lectivo){

	$.ajax({
		url:base_url+"estadisticas_controller/mostrarpromediocursos",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,periodo:periodo,jornada:jornada,ano_lectivo:ano_lectivo},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.promediocursos.length > 0) {

					for (var i = 0; i < registros.promediocursos.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.promediocursos[i].id_curso+"</td><td>"+registros.promediocursos[i].nombre_grado+" "+registros.promediocursos[i].nombre_grupo+" "+registros.promediocursos[i].jornada+"</td><td>"+registros.promediocursos[i].promedio+"</td></tr>";
					};
					
					$("#lista_promediocursos tbody").html(html);
				}
				else{
					html ="<tr><td colspan='3'><p style='text-align:center'>No Hay Cursos Registrados..</p></td></tr>";
					$("#lista_promediocursos tbody").html(html);
				}	

			}

	});

}


function mostrardiv_promediocursos(){

	div = document.getElementById('div-promediocursos');
    div.style.display = '';

}

function ocultardiv_promediocursos(){

	div = document.getElementById('div-promediocursos');
    div.style.display = 'none';
}


//================================= Funciones Promedio Grados =================================


function mostrarpromediogrados(valor,pagina,cantidad,periodo,jornada,ano_lectivo){

	$.ajax({
		url:base_url+"estadisticas_controller/mostrarpromediogrados",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,periodo:periodo,jornada:jornada,ano_lectivo:ano_lectivo},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.promediogrados.length > 0) {

					for (var i = 0; i < registros.promediogrados.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.promediogrados[i].id_grado+"</td><td>"+registros.promediogrados[i].nombre_grado+"</td><td>"+registros.promediogrados[i].promedio+"</td></tr>";
					};
					
					$("#lista_promediogrados tbody").html(html);
				}
				else{
					html ="<tr><td colspan='3'><p style='text-align:center'>No Hay Grados Registrados..</p></td></tr>";
					$("#lista_promediogrados tbody").html(html);
				}	

			}

	});

}


function mostrardiv_promediogrados(){

	div = document.getElementById('div-promediogrados');
    div.style.display = '';

}

function ocultardiv_promediogrados(){

	div = document.getElementById('div-promediogrados');
    div.style.display = 'none';
}


//================================= Funciones En Riesgo =================================


function mostrarenriesgo(valor,pagina,cantidad,periodo,jornada,ano_lectivo){

	$.ajax({
		url:base_url+"estadisticas_controller/mostrarenriesgo",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,periodo:periodo,jornada:jornada,ano_lectivo:ano_lectivo},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.enriesgo.length > 0) {

					for (var i = 0; i < registros.enriesgo.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.enriesgo[i].id_persona+"</td><td>"+registros.enriesgo[i].identificacion+"</td><td>"+registros.enriesgo[i].apellido1+" "+registros.enriesgo[i].apellido2+" "+registros.enriesgo[i].nombres+"</td><td style='display:none'>"+registros.enriesgo[i].id_curso+"</td><td>"+registros.enriesgo[i].nombre_grado+" "+registros.enriesgo[i].nombre_grupo+" "+registros.enriesgo[i].jornada+"</td><td>"+registros.enriesgo[i].promedio+"</td></tr>";
					};
					
					$("#lista_enriesgo tbody").html(html);
				}
				else{
					html ="<tr><td colspan='5'><p style='text-align:center'>No Hay Estudiantes..</p></td></tr>";
					$("#lista_enriesgo tbody").html(html);
				}	

			}

	});

}


function mostrardiv_enriesgo(){

	div = document.getElementById('div-enriesgo');
    div.style.display = '';

}

function ocultardiv_enriesgo(){

	div = document.getElementById('div-enriesgo');
    div.style.display = 'none';
}