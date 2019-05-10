$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){


	$("#btn_consultar_horario").click(function(event){

    	if($("#form_horario").valid()==true){

    		id_profesor = $("#id_persona").val();
    		jornada = $("#jornada").val();

    		mostrardiv_horario();
    		mostrarhorarios(id_profesor,jornada);

       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#jornada").change(function(){
    	ocultardiv_horario();
    	$("#lista_horarios tbody").html("");
    });


    $("#form_horario").validate({

    	rules:{

			jornada:{
				required: true,
				maxlength: 6

			}


		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function mostrarhorarios(id_profesor){

	$.ajax({
		url:base_url+"horarios_controller/mostrarhorarios_profesor",
		type:"post",
		data:{id_profesor:id_profesor,jornada:jornada},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.horarios.length > 0) {

					for (var i = 0; i < registros.horarios.length; i++) {
						html +="<tr><td style='display:none'>"+[i+1]+"</td><td>"+registros.horarios[i].hora+"</td><td><b>"+registros.horarios[i].lunes_asig+"</b><br>"+registros.horarios[i].lunes_curso+"</td><td><b>"+registros.horarios[i].martes_asig+"</b><br>"+registros.horarios[i].martes_curso+"</td><td><b>"+registros.horarios[i].miercoles_asig+"</b><br>"+registros.horarios[i].miercoles_curso+"</td><td><b>"+registros.horarios[i].jueves_asig+"</b><br>"+registros.horarios[i].jueves_curso+"</td><td><b>"+registros.horarios[i].viernes_asig+"</b><br>"+registros.horarios[i].viernes_curso+"</td><td><b>"+registros.horarios[i].sabado_asig+"</b><br>"+registros.horarios[i].sabado_curso+"</td><td><b>"+registros.horarios[i].domingo_asig+"</b><br>"+registros.horarios[i].domingo_curso+"</td></tr>";
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


function mostrardiv_horario(){

	div = document.getElementById('div-horario');
    div.style.display = '';

}

function ocultardiv_horario(){

	div = document.getElementById('div-horario');
    div.style.display = 'none';
}