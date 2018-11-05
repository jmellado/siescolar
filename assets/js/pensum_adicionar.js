$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){


	// este metodo permite enviar la inf del formulario
	$("#form_adicionar").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_adicionar").valid()==true){

			$.ajax({

				url:$("#form_adicionar").attr("action"),
				type:$("#form_adicionar").attr("method"),
				data:$("#form_adicionar").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('Asignatura Registrada Satisfactoriamente.', 'Success Alert', {timeOut: 3000});
						$("#form_adicionar")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.error('Asignatura No Registrada.', 'Success Alert', {timeOut: 3000});
						

					}
					else if(respuesta==="pensumyaexiste"){
						
						toastr.warning('Asignatura Ya Registrada En Este Pensum.', 'Success Alert', {timeOut: 3000});
							

					}
					else if(respuesta==="pensumnoennotas"){
						
						toastr.warning('No Se Puede Adicionar Esta Asignatura; Actualmente El Pensum No Esta Asociado A Un Estudiante Y Puede Gestionarlo.', 'Success Alert', {timeOut: 5000});
							

					}
					else if(respuesta==="notasingresadas"){
						
						toastr.warning('No Se Puede Adicionar Esta Asignatura; Actualmente Existen Notas Ingresadas En El Primer Período.', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}

						
						
				}

			});

		}else{

			toastr.success('Formulario Incorrecto', 'Success Alert', {timeOut: 3000});
			
		}

	});


	$("#form_adicionar").validate({

    	rules:{

			id_grado:{
				required: true,
				maxlength: 15	

			},

			id_asignatura:{
				required: true,
				maxlength: 15	

			},

			intensidad_horaria:{
				required: true,
				maxlength: 2	

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			}

		}


	});




}