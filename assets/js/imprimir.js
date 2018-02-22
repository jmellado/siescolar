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
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


	//*********************************************** FUNCIONES PARA IMPRIMIR PLANILLAS *************************************************

	llenarcombo_cursosA($("#jornadaA").val());


	$("#jornadaA").change(function(){
    	jornada = $(this).val();
    	llenarcombo_cursosA(jornada);
    });


    $("#btn_generar_planillaA").click(function(event){

    	if($("#form_planillasA").valid()==true){

    		jornada = $("#jornadaA").val();
    		id_curso = $("#id_cursoA").val();
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


function llenarcombo_cursosA(jornada){

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