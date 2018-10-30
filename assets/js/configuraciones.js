$(document).on("ready",inicio); //al momento de cargar nuestra vista html se inicie la funcion incio

function inicio(){

	buscar_datos_institucion();
	llenarcombo_paisesU(null);

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
				maxlength: 100
				//lettersonly: true	

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

			direccion:{
				required: true,
				maxlength: 45
					

			},

			barrio:{
				required: true,
				maxlength: 45	

			},

			pais_ubicacion:{
				required: true
				
				
			},

			departamento_ubicacion:{
				required: true
				
				
			},

			municipio_ubicacion:{
				required: true
				
				
			},

			ultimo_grado:{
				required: true,
				maxlength: 10	

			},

			responsable:{
				required: true,
				maxlength: 100
				//lettersonly: true	

			},

			cargo_responsable:{
				required: true
				
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


	$("#pais_ubicacion").change(function(){
    	id_pais = $(this).val();
    	llenarcombo_departamentosU(id_pais,null);
    	$("#municipio_ubicacion1 select").html("");
    });

    $("#departamento_ubicacion").change(function(){
    	id_departamento = $(this).val();
    	llenarcombo_municipiosU(id_departamento,null);
    });


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
						ultimo_grado = registros[i]["ultimo_grado"];
						telefono = registros[i]["telefono"];
						email = registros[i]["email"];
						direccion = registros[i]["direccion"];
						barrio = registros[i]["barrio"];
						pais_ubicacion = registros[i]["pais_ubicacion"];
						departamento_ubicacion = registros[i]["departamento_ubicacion"];
						municipio_ubicacion = registros[i]["municipio_ubicacion"];
						corregimiento_ubicacion = registros[i]["corregimiento_ubicacion"];
						responsable = registros[i]["responsable"];
						cargo_responsable = registros[i]["cargo_responsable"];
						escudo = registros[i]["escudo"];

						$("#nombre_institucion").val(nombre_institucion);
	        			$("#niveles_educacion").val(niveles_educacion);
	        			$("#resolucion").val(resolucion);
	        			$("#dane").val(dane);
	        			$("#nit").val(nit);
	        			$("#ultimo_grado").val(ultimo_grado);
	        			$("#telefono_i").val(telefono);
	        			$("#email_i").val(email);
	        			$("#direccion_i").val(direccion);
	        			$("#barrio_i").val(barrio);
	        			$("#pais_ubicacion").val(pais_ubicacion);
	        			$("#departamento_ubicacion").val(departamento_ubicacion);
	        			$("#municipio_ubicacion").val(municipio_ubicacion);
	        			$("#corregimiento_ubicacion").val(corregimiento_ubicacion);
	        			$("#responsable").val(responsable);
	        			$("#cargo_responsable").val(cargo_responsable);

	        			llenarcombo_paisesU(pais_ubicacion);
	        			llenarcombo_departamentosU(pais_ubicacion,departamento_ubicacion);
	        			llenarcombo_municipiosU(departamento_ubicacion,municipio_ubicacion);

					};
				}	
				
		
		}

	});
}


function llenarcombo_paisesU(valor){

	$.ajax({
		url:base_url+"configuraciones_controller/llenarcombo_paises",
		type:"post",
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					if(registros[i]["id_pais"]==valor){
						html +="<option value="+registros[i]["id_pais"]+" selected>"+registros[i]["nombre_pais"]+"</option>";
					}
					else{
						html +="<option value="+registros[i]["id_pais"]+">"+registros[i]["nombre_pais"]+"</option>";
					}
				};
				
				$("#pais_ubicacion1 select").html(html);
		}

	});
}


function llenarcombo_departamentosU(valor,valor2){

	$.ajax({
		url:base_url+"configuraciones_controller/llenarcombo_departamentos",
		type:"post",
		data:{id:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "<option value=''></option>";
				for (var i = 0; i < registros.length; i++) {
					
					if(registros[i]["id_departamento"]==valor2){
						html +="<option value="+registros[i]["id_departamento"]+" selected>"+registros[i]["nombre_departamento"]+"</option>";
					}
					else{
						html +="<option value="+registros[i]["id_departamento"]+">"+registros[i]["nombre_departamento"]+"</option>";
					}
				};
				
				$("#departamento_ubicacion1 select").html(html);
		}

	});
}


function llenarcombo_municipiosU(valor,valor2){

	$.ajax({
		url:base_url+"configuraciones_controller/llenarcombo_municipios",
		type:"post",
		data:{id:valor},
		success:function(respuesta) {

				var registros = eval(respuesta);

				html = "";
				for (var i = 0; i < registros.length; i++) {
					
					if(registros[i]["id_municipio"]==valor2){
						html +="<option value="+registros[i]["id_municipio"]+" selected>"+registros[i]["nombre_municipio"]+"</option>";
					}
					else{
						html +="<option value="+registros[i]["id_municipio"]+">"+registros[i]["nombre_municipio"]+"</option>";
					}
				};
				$("#municipio_ubicacion1 select").html(html);
		}

	});


}