$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){


	mostrardesempenos("",1,5);


	$("body").on("click","#lista_desempenos a",function(event){
		event.preventDefault();
		$("#modal_actualizar_desempeno").modal();
		id_desempenosele = $(this).attr("href");
		nombre_desempenosele = $(this).parent().parent().children("td:eq(2)").text();
		rango_inicialsele = $(this).parent().parent().children("td:eq(3)").text();  //como estoy en la etiqueta a me dirijo a su padre que es td,a su padre que tr y los hijos de tr que son los td 
		rango_finalsele = $(this).parent().parent().children("td:eq(4)").text();
		
		$("#id_desempenosele").val(id_desempenosele);
        $("#nombre_desempenosele").val(nombre_desempenosele);
        $("#rango_inicialsele").val(rango_inicialsele);
        $("#rango_finalsele").val(rango_finalsele);

	});


	$("#btn_actualizar_desempeno").click(function(event){

    	if($("#form_desempenos_actualizar").valid()==true){
       		actualizar_desempeno();
       	
       	}
       	else{
			toastr.warning('Formulario Incorrecto.', 'Success Alert', {timeOut: 3000});
		}
		
       
    });


    $("#modal_actualizar_desempeno").on('hidden.bs.modal', function () {
        $("#form_desempenos_actualizar")[0].reset();
        var validator = $("#form_desempenos_actualizar").validate();
        validator.resetForm();
    });


    $("#form_desempenos_actualizar").validate({

    	rules:{

			rango_inicial:{
				required: true,
				number: true	

			},

			rango_final:{
				required: true,
				number: true	

			}

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-záéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}


function mostrardesempenos(valor,pagina,cantidad){

	$.ajax({
		url:base_url+"configuraciones_controller/mostrardesempenos",
		type:"post",
		data:{id_buscar:valor,numero_pagina:pagina,cantidad:cantidad},
		success:function(respuesta) {
				//toastr.error(''+respuesta, 'Success Alert', {timeOut: 5000});
				//------------------------CUANDO OBTENGO UN JSON OBJETCH ----//
				registros = JSON.parse(respuesta);  //AQUI PARSEAMOS EN JSON TIPO OBJETO CLAVE-VALOR

				html ="";

				if (registros.desempenos.length > 0) {

					for (var i = 0; i < registros.desempenos.length; i++) {
						html +="<tr><td>"+[i+1]+"</td><td style='display:none'>"+registros.desempenos[i].id_desempeno+"</td><td>"+registros.desempenos[i].nombre_desempeno+"</td><td>"+registros.desempenos[i].rango_inicial+"</td><td>"+registros.desempenos[i].rango_final+"</td><td><a class='btn btn-success' href="+registros.desempenos[i].id_desempeno+" title='Actualizar Información De Este Nivel De Desempeño'><i class='fa fa-edit'></i></a></td></tr>";
					};

					$("#lista_desempenos tbody").html(html);
				}
				else{

					html ="<tr><td colspan='4'><p style='text-align:center'>No Hay Datos Disponibles..</p></td></tr>";
					$("#lista_desempenos tbody").html(html);
				}

			}

	});

}


function actualizar_desempeno(){

	$.ajax({
		url:base_url+"configuraciones_controller/modificar_desempeno",
		type:"post",
        data:$("#form_desempenos_actualizar").serialize(),
		success:function(respuesta) {
				
				$("#modal_actualizar_desempeno").modal('hide');

				if (respuesta==="registroactualizado") {
					
					toastr.success('Nivel De Desempeño Actualizado Satisfactoriamente.', 'Success Alert', {timeOut: 3000});

				}
				else if(respuesta==="registronoactualizado"){
					
					toastr.error('Nivel De Desempeño No Actualizado.', 'Success Alert', {timeOut: 3000});
					
				}
				else if(respuesta==="notasregistradas"){
						
					toastr.warning('No Se Puede Modificar Este Nivel De Desempeño; Actualmente Existen Notas Registradas.', 'Success Alert', {timeOut: 3000});	

				}
				else if(respuesta==="notasactividadesregistradas"){
						
					toastr.warning('No Se Puede Modificar Este Nivel De Desempeño; Actualmente Existen Notas Registradas Por Actividades.', 'Success Alert', {timeOut: 3000});	

				}
				else{

					toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
				}

				$("#form_desempenos_actualizar")[0].reset();

				mostrardesempenos("",1,5);

		}


	});

}