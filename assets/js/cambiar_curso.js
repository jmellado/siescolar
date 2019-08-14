$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_cursosCC($("#jornadaCC").val());


	$("#form_cambiar_curso").submit(function (event) {

		event.preventDefault();
		if($("#form_cambiar_curso").valid()==true){

			if(confirm("Esta Seguro Que Desea Hacer El Cambio De Curso Para Este Estudiante.?")){

				$.ajax({

					url:$("#form_cambiar_curso").attr("action"),
					type:$("#form_cambiar_curso").attr("method"),
					data:$("#form_cambiar_curso").serialize(),
					success:function(respuesta) {

						
						if (respuesta==="cambiocursorealizado") {
							
							toastr.success('Cambio De Curso Realizado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
							$("#form_cambiar_curso")[0].reset();
							$("#estudiantes_cambiar1 select").html("");
							$("#cursos_destino_cambiar1 select").html("");

						}
						else if(respuesta==="cambiocursonorealizado"){
							
							toastr.error('Cambio De Curso No Realizado.', 'Success Alert', {timeOut: 3000});
							

						}
						else if(respuesta==="cursosincupo"){
							
							toastr.warning('El Curso De Destino Seleccionado Está Sin Cupo.', 'Success Alert', {timeOut: 3000});
								

						}
						else{

							toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
							
						}

							
							
					}

				});

			}

		}else{

			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}

	});


    $("#jornadaCC").change(function(){
    	jornada = $(this).val();
    	$("#cursos_cambiar1 select").html("");
    	$("#estudiantes_cambiar1 select").html("");
    	llenarcombo_cursosCC(jornada);
    });


    $("#id_cursoCC").change(function(){
    	id_curso = $(this).val();
    	$("#estudiantes_cambiar1 select").html("");
    	llenarcombo_estudiantesCC(id_curso);

    	jornada = $("#jornada_destinoCC").val();
    	$("#cursos_destino_cambiar1 select").html("");
    	llenarcombo_cursos_destinoCC(jornada,id_curso);
    });


    $("#jornada_destinoCC").change(function(){
    	jornada = $(this).val();
    	id_curso = $("#id_cursoCC").val();
    	$("#cursos_destino_cambiar1 select").html("");
    	llenarcombo_cursos_destinoCC(jornada,id_curso);
    });


	$("#form_cambiar_curso").validate({

    	rules:{

    		jornada:{
				required: true,
				maxlength: 6,

			},

			id_curso:{
				required: true,
				digits: true	

			},

			id_estudiante:{
				required: true,
				digits: true	

			},

			jornada_destino:{
				required: true,
				maxlength: 6,

			},

			id_curso_destino:{
				required: true,
				digits: true	

			}

		}

	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function llenarcombo_cursosCC(jornada){

	$.ajax({
		url:base_url+"matriculas_controller/llenarcombo_cursosCC",
		type:"post",
		data:{jornada:jornada},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_cambiar1 select").html(html);
		}

	});

}


function llenarcombo_estudiantesCC(id_curso){

	$.ajax({
		url:base_url+"matriculas_controller/llenarcombo_estudiantesCC",
		type:"post",
		data:{id_curso:id_curso},
		success:function(respuesta) {
				//alert(""+respuesta);
				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_estudiante"]+">"+registros[i]["apellido1"]+[" "]+registros[i]["apellido2"]+[" "]+registros[i]["nombres"]+"</option>";
				};
				
				$("#estudiantes_cambiar1 select").html(html);
		}

	});
	
}


function llenarcombo_cursos_destinoCC(jornada){

	$.ajax({
		url:base_url+"matriculas_controller/llenarcombo_cursos_destinoCC",
		type:"post",
		data:{jornada:jornada,id_curso:id_curso},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_destino_cambiar1 select").html(html);
		}

	});

}