$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	buscar_datos_institucion();

	// este metodo permite enviar la inf del formulario
	$("#form_datos_institucion").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		var formData = new FormData($("#form_datos_institucion")[0]);

		if($("#form_datos_institucion").valid()==true){

			$.ajax({

				url:$("#form_datos_institucion").attr("action"),
				type:$("#form_datos_institucion").attr("method"),
				data:formData,   //captura la info de la cajas de texto
				cache:false,
				contentType:false,
				processData:false,
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Información Guardada Satisfactoriamente', 'Success Alert', {timeOut: 5000});
						//$("#form_datos_institucion")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.success('Información No Guardada', 'Success Alert', {timeOut: 5000});
						

					}
					else{

						toastr.success('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					
					buscar_datos_institucion();
						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 5000});
			
		}

	});


	$("#form_escudo_institucion").submit(function (event) {

		event.preventDefault(); 
		var formData = new FormData($("#form_escudo_institucion")[0]);

		if($("#form_escudo_institucion").valid()==true){

			$.ajax({

				url:$("#form_escudo_institucion").attr("action"),
				type:$("#form_escudo_institucion").attr("method"),
				data:formData,
				cache:false,
				contentType:false,
				processData:false,
				success:function(respuesta) {

					if (respuesta==="registroguardado") {
						
						toastr.success('Imagen Guardada Satisfactoriamente', 'Success Alert', {timeOut: 5000});

					}
					else if(respuesta==="registronoguardado"){
						
						toastr.success('Imagen No Guardada', 'Success Alert', {timeOut: 5000});
						
					}
					else{

						toastr.success('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
						
						
				}

			});

		}else{

			toastr.success('Debe Seleccionar Una Imagen', 'Success Alert', {timeOut: 5000});
			
		}

	});



	$("#form_datos_institucion").validate({

    	rules:{

			nombre_institucion:{
				required: true,
				maxlength: 100,
				lettersonly: true	

			},

			niveles_educacion:{
				required: true,
				maxlength: 200
	

			},

			resolucion:{
				required: true,
				maxlength: 100
					

			},

			dane:{
				required: true,
				maxlength: 45
					

			},

			nit:{
				required: true,
				maxlength: 45
					

			},

			direccion:{
				required: true,
				maxlength: 45
					

			},

			telefono:{
				required: true,
				maxlength: 45,
				digits: true	

			},

			email:{
				required: true,
				email: true,
				maxlength: 45
					

			},

			rector:{
				required: true,
				maxlength: 100,
				lettersonly: true	

			}


		}


	});


	$("#form_escudo_institucion").validate({

    	rules:{

			escudo:{
				required: true

			}

		}

	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");




}


function buscar_datos_institucion(){

	$.ajax({
		url:base_url+"configuraciones_controller/buscar_datos_institucion",
		type:"post",
		success:function(respuesta) {
				

				if(respuesta==="noexiste"){

					//toastr.success('Datos No Registrado', 'Success Alert', {timeOut: 5000});
					
				}
				else{

					var registros = eval(respuesta);
					for (var i = 0; i < registros.length; i++) {

						nombre_institucion = registros[i]["nombre_institucion"];
						niveles_educacion = registros[i]["niveles_educacion"];
						resolucion = registros[i]["resolucion"];
						dane = registros[i]["dane"];
						nit = registros[i]["nit"];
						direccion = registros[i]["direccion"];
						telefono = registros[i]["telefono"];
						email = registros[i]["email"];
						rector = registros[i]["rector"];
						escudo = registros[i]["escudo"];

						$("#nombre_institucion").val(nombre_institucion);
	        			$("#niveles_educacion").val(niveles_educacion);
	        			$("#resolucion").val(resolucion);
	        			$("#dane").val(dane);
	        			$("#nit").val(nit);
	        			$("#direccion_i").val(direccion);
	        			$("#telefono_i").val(telefono);
	        			$("#email_i").val(email);
	        			$("#rector").val(rector);

					};
				}	
				
		
		}

	});
}