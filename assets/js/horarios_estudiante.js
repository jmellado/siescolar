$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	id_estudiante = $("#id_persona").val();
	mostrarhorarios(id_estudiante);

}


function mostrarhorarios(id_estudiante){

	$.ajax({
		url:base_url+"horarios_controller/mostrarhorarios_estudiante",
		type:"post",
		data:{id_estudiante:id_estudiante},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.horarios.length > 0) {

					for (var i = 0; i < registros.horarios.length; i++) {
						html +="<tr><td style='display:none'>"+[i+1]+"</td><td style='display:none'>"+registros.horarios[i].id_horario+"</td><td style='display:none'>"+registros.horarios[i].id_curso+"</td><td>"+registros.horarios[i].hora+"</td><td style='display:none'>"+registros.horarios[i].lunes+"</td><td style='display:none'>"+registros.horarios[i].martes+"</td><td style='display:none'>"+registros.horarios[i].miercoles+"</td><td style='display:none'>"+registros.horarios[i].jueves+"</td><td style='display:none'>"+registros.horarios[i].viernes+"</td><td style='display:none'>"+registros.horarios[i].sabado+"</td><td style='display:none'>"+registros.horarios[i].domingo+"</td><td>"+registros.horarios[i].asiglunes+"</td><td>"+registros.horarios[i].asigmartes+"</td><td>"+registros.horarios[i].asigmiercoles+"</td><td>"+registros.horarios[i].asigjueves+"</td><td>"+registros.horarios[i].asigviernes+"</td><td>"+registros.horarios[i].asigsabado+"</td><td>"+registros.horarios[i].asigdomingo+"</td><td style='display:none'><a class='btn btn-success' href="+registros.horarios[i].id_horario+" title='Actualizar Información De La Actividad'><i class='fa fa-edit'></i></a></td><td style='display:none'><button type='button' class='btn btn-danger' value="+registros.horarios[i].id_horario+" title='Eliminar Actividad'><i class='fa fa-trash'></i></button></td></tr>";
					};
					
					$("#lista_horarios tbody").html(html);
				}
				else{
					//html ="<tr><td colspan='8'><p style='text-align:center'>No Hay Horario Registrado..</p></td></tr>";
					html ="<tr><td>1</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					html +="<tr><td>2</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					html +="<tr><td>3</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					html +="<tr><td>4</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					html +="<tr><td>5</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					html +="<tr><td>6</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					html +="<tr><td>7</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					html +="<tr><td>8</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					html +="<tr><td>9</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					html +="<tr><td>10</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					$("#lista_horarios tbody").html(html);
				}	

			}

	});

}