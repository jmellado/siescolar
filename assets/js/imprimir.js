$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){


	llenarcombo_cursosB($("#jornadaB").val());


	$("#jornadaB").change(function(){
    	jornada = $(this).val();
    	llenarcombo_cursosB(jornada);
    });


    $("#btn_generar_boletin").click(function(event){

    	if($("#form_boletines").valid()==true){

    		periodo = $("#periodoB").val();
    		jornada = $("#jornadaB").val();
    		id_curso = $("#id_cursoB").val();
    		//window.location.href =base_url+"imprimir_controller/generar_boletin";
    		window.open(base_url+'imprimir_controller/generar_boletin'+'?periodo='+periodo+'&id_curso='+id_curso+'&jornada='+jornada, '_blank');

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#form_boletines").validate({

    	rules:{

    		periodo:{
				required: true,
				maxlength: 8,
				lettersonly: true	

			},

			id_curso:{
				required: true,
				maxlength: 15	

			},

			jornada:{
				required: true,
				maxlength: 30,

			}


		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


	//*********************************************** FUNCIONES PARA IMPRIMIR PLANILLAS *************************************************

	llenarcombo_cursosPA($("#jornadaPA").val());


	$("#jornadaPA").change(function(){
    	jornada = $(this).val();
    	llenarcombo_cursosPA(jornada);
    });


    $("#btn_generar_planillaA").click(function(event){

    	if($("#form_planillasA").valid()==true){

    		jornada = $("#jornadaPA").val();
    		id_curso = $("#id_cursoPA").val();
    		window.open(base_url+'imprimir_controller/generar_planilla_asistencia'+'?id_curso='+id_curso+'&jornada='+jornada, '_blank');

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#form_planillasA").validate({

    	rules:{


			id_curso:{
				required: true,
				maxlength: 15	

			},

			jornada:{
				required: true,
				maxlength: 30,

			}


		}


	});


	//**************************************** FUNCIONES PARA IMPRIMIR CONSTANCIAS *********************************


	$("#btn_buscar_estudianteC").click(function(event){
    	
    	if($("#identificacionC").val()==""){

    		toastr.warning('Favor Digite Un Numero De Identificación.', 'Success Alert', {timeOut: 3000});

       	}
       	else{

       		id = $("#identificacionC").val();
       		buscar_estudianteC(id);
		}
		
       
    });


    $("#identificacionC").keyup(function(event){

       	if(event.keyCode == 13) {

       		if($("#identificacionC").val()==""){
	        	toastr.warning('Favor Digite Un Numero De Identificación.', 'Success Alert', {timeOut: 3000});
	       	}
	       	else{
	       		id = $("#identificacionC").val();
       			buscar_estudianteC(id);
	       	}
    	}
		
    });


    $("#btn_generar_constancia").click(function(event){

    	if($("#form_constancias").valid()==true){

    		id_persona = $("#id_personaC").val();
    		//window.location.href =base_url+"imprimir_controller/generar_boletin";
    		window.open(base_url+'imprimir_controller/generar_constancia'+'?id_persona='+id_persona, '_blank');

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#form_constancias").validate({

    	rules:{

    		id_persona:{
				required: true	

			},

			nombres:{
				required: true	

			},

			apellido1:{
				required: true

			},

			apellido2:{
				required: true

			}


		}


	});


	//**************************************** FUNCIONES PARA IMPRIMIR CERTIFICADOS *********************************


	$("#btn_buscar_estudianteCT").click(function(event){
    	
    	if($("#identificacionCT").val()==""){

    		toastr.warning('Favor Digite Un Numero De Identificación.', 'Success Alert', {timeOut: 3000});

       	}
       	else{

       		id = $("#identificacionCT").val();
       		buscar_estudianteCT(id);
		}
		
       
    });


    $("#identificacionCT").keyup(function(event){

       	if(event.keyCode == 13) {

       		if($("#identificacionCT").val()==""){
	        	toastr.warning('Favor Digite Un Numero De Identificación.', 'Success Alert', {timeOut: 3000});
	       	}
	       	else{
	       		id = $("#identificacionCT").val();
       			buscar_estudianteCT(id);
	       	}
    	}
		
    });


    $("#btn_generar_certificado").click(function(event){

    	if($("#form_certificados").valid()==true){

    		id_persona = $("#id_personaCT").val();
    		ano_lectivo = $("#ano_lectivoCT").val();
    		//window.location.href =base_url+"imprimir_controller/generar_boletin";
    		window.open(base_url+'imprimir_controller/generar_certificado'+'?id_persona='+id_persona+'&ano_lectivo='+ano_lectivo, '_blank');

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#form_certificados").validate({

    	rules:{

    		id_persona:{
				required: true	

			},

			nombres:{
				required: true	

			},

			apellido1:{
				required: true

			},

			apellido2:{
				required: true

			},

			ano_lectivo:{
				required: true,
				digits: true	

			},


		}


	});


	//**************************************** FUNCIONES PARA IMPRIMIR CARNETS *********************************


	llenarcombo_cursosC($("#jornadaC").val());


	$("#jornadaC").change(function(){
    	jornada = $(this).val();
    	llenarcombo_cursosC(jornada);
    });


    $("#btn_generar_carnet").click(function(event){

    	if($("#form_carnet").valid()==true){

    		jornada = $("#jornadaC").val();
    		id_curso = $("#id_cursoC").val();
    		window.open(base_url+'imprimir_controller/generar_carnet'+'?id_curso='+id_curso+'&jornada='+jornada, '_blank');

       	}
       	else{
			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#form_carnet").validate({

    	rules:{


			id_curso:{
				required: true,
				maxlength: 15	

			},

			jornada:{
				required: true,
				maxlength: 30,

			}


		}


	});


}



function llenarcombo_cursosB(jornada){

	$.ajax({
		url:base_url+"imprimir_controller/llenarcombo_cursos",
		type:"post",
		data:{jornada:jornada},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_boletin1 select").html(html);
		}

	});

}


//*********************************************** FUNCIONES PARA IMPRIMIR PLANILLAS *************************************************


function llenarcombo_cursosPA(jornada){

	$.ajax({
		url:base_url+"imprimir_controller/llenarcombo_cursos",
		type:"post",
		data:{jornada:jornada},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_planillaA1 select").html(html);
		}

	});

}


//************************************* FUNCIONES PARA IMPRIMIR CONSTANCIAS ********************************


function validaC(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}


function buscar_estudianteC(valor){

	$.ajax({
		url:base_url+"imprimir_controller/buscar_estudianteC",
		type:"post",
		data:{id:valor},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});

				if(respuesta==="estudiantenoexiste"){

					toastr.error('Estudiante No Registrado.', 'Success Alert', {timeOut: 3000});
					$("#form_constancias")[0].reset();
					$("#id_personaC").val("");
					bloquear_boton();
				}
				else if(respuesta==="estudiantenomatriculado"){

					toastr.warning('El Estudiante No Se Encuentra Matriculado.', 'Success Alert', {timeOut: 3000});
					$("#form_constancias")[0].reset();
					$("#id_personaC").val("");
					bloquear_boton();
				}
				else{

					var registros = eval(respuesta);
					for (var i = 0; i < registros.length; i++) {

						id_persona = registros[i]["id_persona"];
						nombres = registros[i]["nombres"];
						apellido1 = registros[i]["apellido1"];
						apellido2 = registros[i]["apellido2"];

						$("#id_personaC").val(id_persona);
	        			$("#nombresC").val(nombres);
	        			$("#apellido1C").val(apellido1);
	        			$("#apellido2C").val(apellido2);

	        			desbloquear_boton();
						
					};
				}	


		}
	});

}


function bloquear_boton(){

    $("#btn_generar_constancia").attr("disabled", "disabled");
}

function desbloquear_boton(){

    $("#btn_generar_constancia").removeAttr("disabled");
}


//************************************* FUNCIONES PARA IMPRIMIR CERTIFICADOS ********************************


function validaCT(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}


function buscar_estudianteCT(valor){

	$.ajax({
		url:base_url+"imprimir_controller/buscar_estudianteCT",
		type:"post",
		data:{id:valor},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});

				if(respuesta==="estudiantenoexiste"){

					toastr.error('Estudiante No Registrado.', 'Success Alert', {timeOut: 3000});
					$("#form_certificados")[0].reset();
					$("#id_personaCT").val("");
					bloquear_botonCT();
				}
				else if(respuesta==="estudiantenomatriculado"){

					toastr.warning('El Estudiante No Tiene Matrículas Registradas.', 'Success Alert', {timeOut: 3000});
					$("#form_certificados")[0].reset();
					$("#id_personaCT").val("");
					bloquear_botonCT();
				}
				else{

					var registros = eval(respuesta);
					for (var i = 0; i < registros.length; i++) {

						id_persona = registros[i]["id_persona"];
						nombres = registros[i]["nombres"];
						apellido1 = registros[i]["apellido1"];
						apellido2 = registros[i]["apellido2"];

						$("#id_personaCT").val(id_persona);
	        			$("#nombresCT").val(nombres);
	        			$("#apellido1CT").val(apellido1);
	        			$("#apellido2CT").val(apellido2);

	        			llenarcombo_anos_lectivosCT();
	        			desbloquear_botonCT();
						
					};
				}	


		}
	});

}


function bloquear_botonCT(){

    $("#btn_generar_certificado").attr("disabled", "disabled");
    $("#ano_lectivoCT").attr("disabled", "disabled");
    $("#form_certificados").valid()==true;
}

function desbloquear_botonCT(){

    $("#btn_generar_certificado").removeAttr("disabled");
    $("#ano_lectivoCT").removeAttr("disabled");

}


function llenarcombo_anos_lectivosCT(){

	$.ajax({
		url:base_url+"imprimir_controller/llenarcombo_anos_lectivosCT",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_ano_lectivo"]+">"+registros[i]["nombre_ano_lectivo"]+"</option>";
				};
				
				$("#ano_lectivoCT1 select").html(html);
		}

	});
}


//**************************************** FUNCIONES PARA IMPRIMIR CARNETS *********************************


function llenarcombo_cursosC(jornada){

	$.ajax({
		url:base_url+"imprimir_controller/llenarcombo_cursos",
		type:"post",
		data:{jornada:jornada},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_carnet1 select").html(html);
		}

	});

}