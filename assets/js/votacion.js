$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){


	$("#form_ingresar_eleccion").submit(function (event) {
		
		event.preventDefault(); 
		if($("#codigo_eleccion").val()!=""){

			$.ajax({

				url:$("#form_ingresar_eleccion").attr("action"),
				type:$("#form_ingresar_eleccion").attr("method"),
				data:$("#form_ingresar_eleccion").serialize(),   
				success:function(respuesta) {

					//alert(""+respuesta);
					if (respuesta==="ok") {
						
						codigo_eleccion = $("#codigo_eleccion").val();
						window.location= base_url+"elecciones_controller/votacion"+"?codigo_eleccion="+codigo_eleccion;

					}
					else if(respuesta==="yavoto"){
						
						toastr.error('Usted Ya Realizo Su Voto.', 'Success Alert', {timeOut: 3000});
						
					}
					else if(respuesta==="noexiste"){
						
						toastr.warning('El Código Ingresado No Existe.', 'Success Alert', {timeOut: 3000});
							
					}
					else if(respuesta==="votacioncerrada"){
						
						toastr.warning('La Votación Se Encuentra Cerrada.', 'Success Alert', {timeOut: 3000});
							
					}
					else{

						toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
						
					}	
						
				}

			});

		}else{

			toastr.warning('Favor Digite Un Código De Votación.'+hora_actual, 'Success Alert', {timeOut: 3000});
		}

	});


	$("body").on("click","#lista_candidatos_eleccion button",function(event){
		event.preventDefault();
		candidato_elegido = $(this).attr("value");
		codigo_eleccion = $(this).parent().parent().children("td:eq(4)").text();

		if(confirm("Esta Seguro De Realizar Su Voto.?")){
			registrar_voto(candidato_elegido,codigo_eleccion);

		}

	});



}


function registrar_voto(candidato_elegido,codigo_eleccion){

	$.ajax({
		url:base_url+"elecciones_controller/registrar_voto",
		type:"post",
        data:{candidato_elegido:candidato_elegido,codigo_eleccion:codigo_eleccion},
		success:function(respuesta) {
				
			if (respuesta==="registroguardado") {
				
				toastr.success('Voto Registrado Satisfactoriamente, Gracias Por Elegir.', 'Success Alert', {timeOut: 8000});
				window.location= base_url+"rol_votante/elecciones";

			}
			else if(respuesta==="registronoguardado"){
				
				toastr.error('Voto No Registrado.', 'Success Alert', {timeOut: 3000});
				
			}
			else{

				toastr.error('error:'+respuesta, 'Success Alert', {timeOut: 3000});
			}	

		}


	});

}