$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_cursosPP($("#jornadaPP").val());


	$("#btn_procesar_promocion").click(function(event){

       	if($("#form_procesar_promocion").valid()==true){

       		jornada = $("#jornadaPP").val();
    		id_curso = $("#id_cursoPP").val();

    		if(confirm("Esta Seguro De Procesar La Promoción Para El Curso Seleccionado.?")){

    			procesar_promocion(jornada,id_curso);
    		}

       	}
       	else{

			toastr.warning('Formulario Incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
    });


    $("#jornadaPP").change(function(){
    	
    	jornada = $("#jornadaPP").val();
    	llenarcombo_cursosPP(jornada);
    });


    $("#form_procesar_promocion").validate({

    	rules:{


			id_curso:{
				required: true,
				digits: true	

			},

			jornada:{
				required: true,
				maxlength: 30,

			}


		}


	});


}


function procesar_promocion(){

	$.ajax({
		url:base_url+"promocion_controller/procesar_promocion",
		type:"post",
		data:{jornada:jornada,id_curso:id_curso},
		success:function(respuesta) {
				

				if (respuesta==="promocionrealizada") {
					
					toastr.success('Proceso De Promoción Realizado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="promocionnorealizada"){
					
					toastr.error('Proceso De Promoción No Realizado.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="promociondenegada"){
					
					toastr.warning('Proceso De Promoción No Realizado; Todos Los Períodos De Evaluación Deben Estar Cerrados.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="nohayestudiantes"){
					
					toastr.warning('Proceso De Promoción No Realizado; En El Curso Seleccionado No Existen Estudiantes Matriculados.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="nohaycriterios"){
					
					toastr.warning('Proceso De Promoción No Realizado; El Curso Seleccionado No Tiene Criterios De Promoción Asignados.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="nohay4periodoscerrados"){
					
					toastr.warning('Proceso De Promoción No Realizado; Deben Existir Cuatro Períodos De Evaluación En Estado Cerrado.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="nohayperiodos"){
					
					toastr.warning('Proceso De Promoción No Realizado; No Existen Períodos De Evaluación Registrados.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="nohay4periodos"){
					
					toastr.warning('Proceso De Promoción No Realizado; Deben Existir Cuatro Períodos De Evaluación Registrados.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

		}


	});



}


function llenarcombo_cursosPP(jornada){

	$.ajax({
		url:base_url+"promocion_controller/llenarcombo_cursos",
		type:"post",
		data:{jornada:jornada},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_procesar1 select").html(html);
		}

	});

}