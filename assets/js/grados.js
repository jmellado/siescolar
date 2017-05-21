$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){


	// este metodo permite enviar la inf del formulario
	$("#form_grados").submit(function (event) {
		//validar()
		event.preventDefault(); //evita que se ejcute la ccion del boton del formulario
		if($("#form_grados").valid()==true){

			$.ajax({

				url:$("#form_grados").attr("action"),
				type:$("#form_grados").attr("method"),
				data:$("#form_grados").serialize(),   //captura la info de la cajas de texto
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="registroguardado") {
						
						toastr.success('registro guardado satisfactoriamente', 'Success Alert', {timeOut: 5000});
						$("#form_grados")[0].reset();


					}
					else if(respuesta==="registronoguardado"){
						
						toastr.success('registro no guardado', 'Success Alert', {timeOut: 5000});
						

					}
					else if(respuesta==="estudiante ya existe"){
						
						toastr.success('ya esta registrado', 'Success Alert', {timeOut: 5000});
							

					}
					else{

						toastr.success('error:'+respuesta, 'Success Alert', {timeOut: 5000});
						
					}
					//mostrarestudiantes("",1,5);

						
						
				}

			});

		}else{

			toastr.success('Formulario incorrecto', 'Success Alert', {timeOut: 5000});
			//alert($("#form_estudiantes").validate().numberOfInvalids()+"errores");
		}

	});


	$("#btn_agregar_grado").click(function(){

		$("#modal_agregar_grado").modal();
       
    });






	$("#form_grados").validate({

    	rules:{

			nombre_grado:{
				required: true,
				maxlength: 15
				//lettersonly: true	

			},

			ciclo_grado:{
				required: true,
				maxlength: 45,
				//lettersonly: true	

			},

			jornada:{
				required: true,
				maxlength: 30,
				//lettersonly: true	

			},

			ano_lectivo:{
				required: true,
				maxlength: 4,
				digits: true	

			},

			estado_grado:{
				required: true,
				maxlength: 8,
				lettersonly: true
				
			}

		}


	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
  	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Solo Valores Alfabeticos");


}