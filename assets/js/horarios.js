$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	id_curso = $("#id_cursoH").val();
	llenarcombo_cursosH($("#jornadaH").val());


	$("#jornadaH").change(function(){
    	jornada = $(this).val();
    	llenarcombo_cursosH(jornada);
    });


    $("#id_cursoH").change(function(){
    	id_curso = $(this).val();
    	llenarcombo_asignaturas_pensum(id_curso);
    	mostrarhorarios("",1,5,id_curso);
    });


    $("#id_asignaturaH").change(function(){
    	id_asignatura = $(this).val();
    	desmarcar_checkbox_dias();
    });


    // este metodo permite enviar la inf del formulario
	$("#form_horarios").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejecute la accion del boton del formulario
		if($("#form_horarios").valid()==true){
			if(validarDias()==true){
				$.ajax({

					url:$("#form_horarios").attr("action"),
					type:$("#form_horarios").attr("method"),
					data:$("#form_horarios").serialize(),   //captura la info de la cajas de texto
					success:function(respuesta) {

						//alert(""+respuesta);
						if (respuesta==="registroguardado") {
							
							toastr.success('Horario Actualizado Satisfactoriamente.', 'Success Alert', {timeOut: 5000});
							desmarcar_checkbox_dias();

						}
						else if(respuesta==="registronoguardado"){
							
							toastr.error('Horario No Actualizado.', 'Success Alert', {timeOut: 5000});
							

						}
						else if(respuesta==="errorintensidad_horaria"){
							
							toastr.warning('El Número De Horas Súpera la Intensidad Horaria Permitida.', 'Success Alert', {timeOut: 3000});
							

						}
						else if(respuesta==="errorhoras_registradas"){
							
							toastr.warning('El Número De Horas Registradas Súpera la Intensidad Horaria Permitida.', 'Success Alert', {timeOut: 3000});
							

						}
						else{

							toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 5000});
							
						}
						mostrarhorarios("",1,5,id_curso);
							
					}

				});
			}
			else{
				toastr.warning('Debe Seleccionar Mínimo Un Dia De La Semana.', 'Success Alert', {timeOut: 3000});
			}

		}else{

			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
			
		}

	});


	$("#form_horarios").validate({

    	rules:{

			jornada:{
				required: true,
				maxlength: 30

			},

			id_curso:{
				required: true,
				digits: true

			},

			id_asignatura:{
				required: true,
				digits: true	

			}


		}


	});





}


function llenarcombo_cursosH(jornada){

	$.ajax({
		url:base_url+"horarios_controller/llenarcombo_cursos",
		type:"post",
		data:{jornada:jornada},
		success:function(respuesta) {
				//toastr.success(''+respuesta, 'Success Alert', {timeOut: 5000});
				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					html +="<option value="+registros[i]["id_curso"]+">"+registros[i]["nombre_grado"]+["-"]+registros[i]["nombre_grupo"]+[" "]+registros[i]["jornada"]+"</option>";
					
				};
				
				$("#cursos_horarios1 select").html(html);
		}

	});

}


function llenarcombo_asignaturas_pensum(id_curso){

	$.ajax({
		url:base_url+"horarios_controller/llenarcombo_asignaturas_pensum",
		type:"post",
		data:{id_curso:id_curso},
		success:function(respuesta) {

				var registros = eval(respuesta);
			
				html = "<option value=''></option>";
				html += "<option value='1'>--- Borrar Asignatura ---</option>";
				for (var i = 0; i < registros.length; i++) {

					html +="<option value="+registros[i]["id_asignatura"]+">"+registros[i]["nombre_asignatura"]+"</option>";
					
				};
				
				$("#asignaturas_horarios1 select").html(html);
		}

	});
}


function mostrarhorarios(valor,pagina,cantidad,id_curso){

	$.ajax({
		url:base_url+"horarios_controller/mostrarhorarios",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad,id_curso:id_curso},
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


function validarDias(){

   	var dias = document.getElementsByName("dia[]");
   	var cont = 0; 

   	//alert("total:"+dias.length);

   	for(i = 0; i < dias.length; i++){

   		if(dias[i].checked){

   			cont = cont + 1;
   		}
   	}

   	//alert("total chek:"+cont);

   	if(cont > 0){

		return true;
	}
	else{

		return false;
	}

}


function desmarcar_checkbox_dias(){

	var dias = document.getElementsByName("dia[]");
   	
   	for(i = 0; i < dias.length; i++){

   		dias[i].checked=0;

   	}

   
}