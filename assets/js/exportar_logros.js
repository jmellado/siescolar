$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_cursosE($("#jornadaE").val());


	$("#btn_exportar_archivo").click(function(event){

    	if($("#form_exportar_logros").valid()==true){

    		$("#form_exportar_logros").submit();
       	}
       	else{

			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
    });


    $("#jornadaE").change(function(){
    	jornada = $(this).val();
    	$("#cursos_exportar1 select").html("");
    	$("#asignaturas_exportar1 select").html("");
    	llenarcombo_cursosE(jornada);
    });


    $("#id_cursoE").change(function(){
    	id_curso = $(this).val();
    	$("#asignaturas_exportar1 select").html("");
    	llenarcombo_asignaturasE(id_curso);
    });


	$("#form_exportar_logros").validate({

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

			}

		}

	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function llenarcombo_cursosE(jornada){

	$.ajax({
		url:base_url+"exportar_logros_controller/llenarcombo_cursos",
		type:"post",
		data:{jornada:jornada},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_exportar1 select").html(html);
		}

	});

}


function llenarcombo_asignaturasE(id_curso){

	$.ajax({
		url:base_url+"exportar_logros_controller/llenarcombo_asignaturas",
		type:"post",
		data:{id_curso:id_curso},
		success:function(respuesta) {
				//alert(""+respuesta);
				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
				};
				
				$("#asignaturas_exportar1 select").html(html);
		}

	});
	
}