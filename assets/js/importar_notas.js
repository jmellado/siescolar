$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_cursosI($("#jornadaI").val());


	$("#form_importar_notas").submit(function (event) {
		
		event.preventDefault();
		var formData = new FormData($("#form_importar_notas")[0]);

		if($("#form_importar_notas").valid()==true){

			$.ajax({

				url:$("#form_importar_notas").attr("action"),
				type:$("#form_importar_notas").attr("method"),
				data:formData,
				cache:false,
				contentType:false,
				processData:false,   
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Archivo Importado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						$("#form_importar_notas")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Archivo No Importado.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="ingresararchivo"){
						
						toastr.warning('Por Favor Debe Seleccionar Un Archivo.', 'Success Alert', {timeOut: 3000});
							

					}
					else if(respuesta==="estructuraincorrecta"){
						
						toastr.warning('La Estructura Del Archivo Es Incorrecta.', 'Success Alert', {timeOut: 3000});
							

					}
					else if(respuesta==="archivovacio"){
						
						toastr.warning('El Archivo Se Encuentra Vacio.', 'Success Alert', {timeOut: 3000});
							

					}
					else if(respuesta==="archivonoaplica"){
						
						toastr.warning('El Archivo No Aplica Para El Curso, Asignatura y Período Seleccionados.', 'Success Alert', {timeOut: 3000});
							

					}
					else if(respuesta==="notasincorrectas"){
						
						toastr.warning('Las Notas Ingresadas Son Incorrectas.', 'Success Alert', {timeOut: 3000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}

						
						
				}

			});

		}else{

			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
			
		}

	});


    $("#jornadaI").change(function(){
    	jornada = $(this).val();
    	$("#cursos_importar1 select").html("");
    	$("#asignaturas_importar1 select").html("");
    	llenarcombo_cursosI(jornada);
    });


    $("#id_cursoI").change(function(){
    	id_curso = $(this).val();
    	$("#asignaturas_importar1 select").html("");
    	llenarcombo_asignaturasI(id_curso);
    });


	$("#form_importar_notas").validate({

    	rules:{

    		jornada:{
				required: true,
				maxlength: 30,

			},

			id_curso:{
				required: true,
				digits: true	

			},

			id_asignatura:{
				required: true,
				digits: true	

			},

			periodo:{
				required: true,
				maxlength: 8,
				lettersonly: true	

			},

			separador:{
				required: true,
				maxlength: 1,

			}

		}

	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function llenarcombo_cursosI(jornada){

	$.ajax({
		url:base_url+"importar_notas_controller/llenarcombo_cursos",
		type:"post",
		data:{jornada:jornada},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_importar1 select").html(html);
		}

	});

}


function llenarcombo_asignaturasI(id_curso){

	$.ajax({
		url:base_url+"importar_notas_controller/llenarcombo_asignaturas",
		type:"post",
		data:{id_curso:id_curso},
		success:function(respuesta) {
				//alert(""+respuesta);
				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
				};
				
				$("#asignaturas_importar1 select").html(html);
		}

	});

}