$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	// este metodo permite enviar la inf del formulario
	$("#form_cambiarpassword").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_cambiarpassword").valid()==true){

			$.ajax({

				url:$("#form_cambiarpassword").attr("action"),
				type:$("#form_cambiarpassword").attr("method"),
				data:$("#form_cambiarpassword").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="passactualizada") {
						
						toastr.success('Contraseña Actualizada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						$("#form_cambiarpassword")[0].reset();


					}
					else if(respuesta==="passnoactualizada"){
						
						toastr.error('Contraseña No Actualizada.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="passerror"){
						
						toastr.warning('La Contraseña Actual No Es Correcta.', 'Success Alert', {timeOut: 3000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}
			
						
				}

			});

		}else{

			toastr.warning('Formulario Incorrecto', 'Success Alert', {timeOut: 3000});
			
		}

	});


	$("#form_cambiarpassword").validate({

    	rules:{

			actual_password:{
				required: true,
				maxlength: 40	

			},

			nueva_password:{
				required: true,
				maxlength: 40,
				minlength: 10,	

			},

			confirmar_password:{
				required: true,
				maxlength: 40,
				minlength: 10,
				equalTo: "#nueva_password"
				
			}

		},

		messages: {

			confirmar_password: {
				equalTo: "Las contraseñas no coinciden."
				//equalTo: "La confirmación de la contraseña no coincide con la nueva contraseña."
			}
			
		}

	});



}