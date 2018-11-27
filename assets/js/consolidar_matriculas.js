$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	llenarcombo_cursosCM($("#jornadaCM").val());


	$("#btn_consolidar_matriculas").click(function(event){

       	if($("#form_consolidar_matriculas").valid()==true){

       		jornada = $("#jornadaCM").val();
    		id_curso = $("#id_cursoCM").val();

    		if(confirm("Esta Seguro De Realizar El Proceso De Consolidación De Matrículas.?")){

    			consolidar_matriculas(jornada,id_curso);
    		}

       	}
       	else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 3000});
		}
		
    });


    $("#jornadaCM").change(function(){
    	
    	jornada = $("#jornadaCM").val();
    	llenarcombo_cursosCM(jornada);
    });


    $("#form_consolidar_matriculas").validate({

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


function consolidar_matriculas(){

	$.ajax({
		url:base_url+"matriculas_controller/consolidar",
		type:"post",
		data:{jornada:jornada,id_curso:id_curso},
		success:function(respuesta) {
				

				if (respuesta==="consolidadorealizado") {
					
					toastr.success('Consolidado De Matrículas Realizado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="consolidadonorealizado"){
					
					toastr.error('Consolidado De Matrículas No Realizado.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="consolidadodenegado"){
					
					toastr.warning('Consolidado De Matrículas No Realizado; Todos Los Períodos De Evaluación Deben Estar Cerrados.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="nohay4periodoscerrados"){
					
					toastr.warning('Consolidado De Matrículas No Realizado; Deben Existir Cuatro Períodos De Evaluación En Estado Cerrado.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="nohayperiodos"){
					
					toastr.warning('Consolidado De Matrículas No Realizado; No Existen Períodos De Evaluación Registrados.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="nohay4periodos"){
					
					toastr.warning('Consolidado De Matrículas No Realizado; Deben Existir Cuatro Períodos De Evaluación Registrados.', 'Success Alert', {timeOut: 3000});

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

		}


	});



}


function llenarcombo_cursosCM(jornada){

	$.ajax({
		url:base_url+"matriculas_controller/llenarcombo_cursosCM",
		type:"post",
		data:{jornada:jornada},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_consolidar1 select").html(html);
		}

	});

}